<?php

namespace App\Http\Controllers\Admin;

use App\Models\Design;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function index(Request $request)
    {
        $this->authorizeAdmin();

        $query = Order::with('user', 'promotion');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('id', 'like', "%{$searchTerm}%")
                  ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                      $userQuery->where('name', 'like', "%{$searchTerm}%")
                                ->orWhere('email', 'like', "%{$searchTerm}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(string $id)
    {
        $this->authorizeAdmin();

        $order = Order::with(['user', 'address', 'promotion', 'orderItems.variant.product'])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, string $id)
    {
        $this->authorizeAdmin();

        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled,refunded',
        ]);

        if ($order->status === 'completed' && $validated['status'] === 'cancelled') {
            return redirect()->route('admin.orders.show', $order)
                ->withErrors(['status' => 'Đơn hàng đã giao thành công không thể hủy.']);
        }

        if ($order->status !== $validated['status']) {
            $order->update($validated);

            if ($validated['status'] === 'completed') {
                $designIds = $order->orderItems()->whereNotNull('design_id')->pluck('design_id')->unique();
                if ($designIds->isNotEmpty()) {
                    Design::whereIn('id', $designIds)->update(['expired_at' => now()->addDays(7)]);
                }
            }

            return redirect()->route('admin.orders.show', $order)->with('success', 'Trạng thái đơn hàng đã được cập nhật thành công.');
        }

        return redirect()->route('admin.orders.show', $order);
    }
}
