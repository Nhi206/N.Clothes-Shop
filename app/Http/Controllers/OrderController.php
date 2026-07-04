<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Address;
use App\Models\Promotion;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->with('orderItems.product.images')
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->with('orderItems.product.images', 'address', 'payment', 'shipment')
                      ->firstOrFail();

        return view('orders.show', compact('order'));
    }

    public function cancel($id)
    {
        $order = Order::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

        if (!in_array($order->status, ['pending', 'processing'], true)) {
            return back()->with('error', 'Chỉ có thể hủy đơn hàng đang ở trạng thái chờ xử lý hoặc đang xử lý.');
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('orders.show', $order)->with('success', 'Đơn hàng của bạn đã được hủy thành công.');
    }

    public function checkout(Request $request)
    {
        // Check for direct order items in session first
        $selectedItems = session('direct_order_items', $request->query('selected_items', $request->input('selected_items', [])));

        // Clear session after use
        if (session()->has('direct_order_items')) {
            session()->forget('direct_order_items');
        }

        $otpCode = session('payment_otp');
        $expiresAt = session('payment_otp_expires_at');
        $shouldResendOtp = $request->boolean('resend_otp');

        if ($shouldResendOtp || empty($otpCode) || empty($expiresAt) || now()->greaterThan($expiresAt)) {
            $otpCode = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            session()->put('payment_otp', $otpCode);
            session()->put('payment_otp_expires_at', now()->addMinutes(5));
        }

        $cart = Cart::where('user_id', Auth::id())->with('items.product.images', 'items.variant')->first();

        // If no selected items specified, redirect to cart
        if (empty($selectedItems)) {
            return redirect()->route('cart.index')->with('error', 'Vui lòng chọn sản phẩm trước khi thanh toán.');
        }

        // For direct orders, cart should exist with the newly created item
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống');
        }

        $selectedItemIds = array_filter($selectedItems, fn ($id) => is_numeric($id));
        $selectedCartItems = $cart->items->whereIn('id', $selectedItemIds);

        if ($selectedCartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Vui lòng chọn sản phẩm hợp lệ trước khi thanh toán.');
        }

        $cart->setRelation('items', $selectedCartItems);

        $subtotal = $selectedCartItems->sum(fn ($item) => $item->subtotal);
        $now = now();
        $promotions = Promotion::withCount('orders')
            ->where(function ($query) use ($now) {
                $query->whereNull('start_date')->orWhere('start_date', '<=', $now);
            })
            ->where(function ($query) use ($now) {
                $query->whereNull('end_date')->orWhere('end_date', '>=', $now);
            })
            ->get()
            ->filter(fn ($promotion) =>
                ($promotion->usage_limit === null || $promotion->orders_count < $promotion->usage_limit)
                && ($promotion->min_order_amount === null || $subtotal >= $promotion->min_order_amount)
            );

        return view('orders.checkout', compact('cart', 'promotions', 'selectedItemIds', 'otpCode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_detail' => 'required|string|min:10',
            'phone' => ['required', 'string', 'regex:/^\+?[0-9\s\-\.]{9,20}$/'],
            'payment_method' => 'required|in:cash,card,bank_transfer',
            'card_number' => 'nullable|required_if:payment_method,card|digits_between:13,19',
            'card_holder' => 'nullable|required_if:payment_method,card|string|max:100',
            'expiry_month' => 'nullable|required_if:payment_method,card|digits:2',
            'expiry_year' => 'nullable|required_if:payment_method,card|digits:2',
            'cvv' => 'nullable|required_if:payment_method,card|digits_between:3,4',
            'bank_provider' => 'nullable|required_if:payment_method,bank_transfer|string|max:100',
            'bank_account_name' => 'nullable|required_if:payment_method,bank_transfer|string|max:100',
            'bank_account_number' => 'nullable|required_if:payment_method,bank_transfer|digits_between:8,20',
            'otp_code' => ['nullable', 'required_if:payment_method,card,bank_transfer', 'digits:6'],
            'promo_code' => 'nullable|string',
            'selected_items' => 'required|array|min:1',
            'selected_items.*' => 'integer',
        ]);

        $paymentMethod = $request->payment_method;
        if (in_array($paymentMethod, ['card', 'bank_transfer'], true)) {
            $storedOtp = session('payment_otp');
            $expiresAt = session('payment_otp_expires_at');

            if (empty($storedOtp) || empty($expiresAt) || now()->greaterThan($expiresAt) || $request->otp_code !== $storedOtp) {
                session()->forget(['payment_otp', 'payment_otp_expires_at']);
                return back()->withInput()->withErrors(['otp_code' => 'Mã OTP không chính xác hoặc đã hết hạn.']);
            }

            session()->forget(['payment_otp', 'payment_otp_expires_at']);
        }

        $cart = Cart::where('user_id', Auth::id())->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống');
        }

        $selectedItemIds = array_filter($request->selected_items, fn ($id) => is_numeric($id));
        $selectedCartItems = $cart->items->whereIn('id', $selectedItemIds);

        if ($selectedCartItems->isEmpty()) {
            return back()->withInput()->withErrors(['selected_items' => 'Vui lòng chọn sản phẩm hợp lệ trước khi thanh toán.']);
        }

        $subtotal = $selectedCartItems->sum(function ($item) {
            return $item->subtotal;
        });

        $promotion = null;
        if ($request->filled('promo_code')) {
            $promotion = Promotion::where('code', $request->promo_code)->first();

            if (!$promotion
                || ($promotion->start_date && $promotion->start_date->isFuture())
                || ($promotion->end_date && $promotion->end_date->isPast())
                || ($promotion->usage_limit !== null && $promotion->orders()->count() >= $promotion->usage_limit)
                || ($promotion->min_order_amount !== null && $subtotal < $promotion->min_order_amount)
            ) {
                return back()->withInput()->withErrors(['promo_code' => 'Mã khuyến mãi không hợp lệ hoặc đơn hàng chưa đủ điều kiện áp dụng.']);
            }
        }

        $discount = 0;
        if ($promotion) {
            if ($promotion->discount_type === 'percent') {
                $discount = round($subtotal * ($promotion->discount_value / 100), 2);
            } else {
                $discount = min($promotion->discount_value, $subtotal);
            }
        }

        $totalAmount = max(0, $subtotal - $discount);
        $orderStatus = $paymentMethod === 'card' ? 'processing' : 'pending';

        DB::transaction(function () use ($request, $cart, $promotion, $totalAmount, $selectedCartItems, $selectedItemIds, $paymentMethod, $orderStatus) {
            $address = Address::create([
                'user_id' => Auth::id(),
                'address_detail' => $request->address_detail,
                'phone' => $request->phone,
                'is_default' => false,
            ]);

            // Tạo đơn hàng
            $order = Order::create([
                'user_id' => Auth::id(),
                'address_id' => $address->id,
                'promo_id' => $promotion?->id,
                'total_amount' => $totalAmount,
                'status' => $orderStatus,
            ]);

            // Tạo order items
            foreach ($selectedCartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'variant_id' => $item->variant_id,
                    'design_id' => $item->design_id,
                    'quantity' => $item->quantity,
                    'price' => $item->unit_price,
                ]);
            }

            $paymentStatus = 'pending';
            $transactionCode = null;
            $paidAt = null;

            if ($paymentMethod === 'card') {
                $paymentStatus = 'paid';
                $transactionCode = 'CARD-' . Str::upper(Str::random(8));
                $paidAt = now();
            } elseif ($paymentMethod === 'bank_transfer') {
                $paymentStatus = 'pending';
                $transactionCode = 'BANK-' . Str::upper(Str::random(8));
            } else {
                $paymentStatus = 'pending';
                $transactionCode = 'COD-' . Str::upper(Str::random(8));
            }

            // Tạo payment
            Payment::create([
                'order_id' => $order->id,
                'method' => $paymentMethod,
                'status' => $paymentStatus,
                'transaction_code' => $transactionCode,
                'paid_at' => $paidAt,
                'amount' => $order->total_amount,
                'bank_provider' => $request->bank_provider,
                'bank_account_name' => $request->bank_account_name,
                'bank_account_number' => $request->bank_account_number,
            ]);

            // Xóa các mặt hàng đã được đặt khỏi giỏ hàng
            $cart->items()->whereIn('id', $selectedItemIds)->delete();
        });

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được đặt thành công');
    }
}
