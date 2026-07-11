<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['add']);
    }

    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())
                    ->with(['items' => function ($query) {
                        $query->where('product_id', '>', 0);
                    }, 'items.product.images', 'items.variant'])
                    ->first();

        if (!$cart) {
            $cart = Cart::create(['user_id' => Auth::id()]);
        }

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        if (!Auth::check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng');
        }

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'nullable|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $validated['product_id'])
                            ->where('variant_id', $validated['variant_id'] ?? null)
                            ->first();

        if ($cartItem) {
            $cartItem->quantity += $validated['quantity'];
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $validated['product_id'],
                'variant_id' => $validated['variant_id'] ?? null,
                'quantity' => $validated['quantity'],
            ]);
        }

        $cartCount = CartItem::whereHas('cart', function($q) {
            $q->where('user_id', Auth::id());
        })->sum('quantity');

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được thêm vào giỏ hàng',
                'cart_count' => $cartCount,
            ]);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::where('id', $id)
                            ->whereHas('cart', function($q) {
                                $q->where('user_id', Auth::id());
                            })
                            ->firstOrFail();

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật');
    }

    public function remove($id)
    {
        $cartItem = CartItem::where('id', $id)
                            ->whereHas('cart', function($q) {
                                $q->where('user_id', Auth::id());
                            })
                            ->firstOrFail();

        $cartItem->delete();

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }

    public function wishlist()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->with('product.images')->get();

        return view('wishlist.index', compact('wishlist'));
    }

    public function addToWishlist($productId)
    {
        if (!Auth::check()) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vui lòng đăng nhập để thêm sản phẩm vào wishlist'
                ], 401);
            }
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thêm sản phẩm vào wishlist');
        }

        $product = Product::findOrFail($productId);

        $wishlistItem = Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được thêm vào wishlist',
                'wishlist_count' => Wishlist::where('user_id', Auth::id())->count()
            ]);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào wishlist');
    }

    public function removeFromWishlist($id)
    {
        if (!Auth::check()) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vui lòng đăng nhập để xóa sản phẩm khỏi wishlist'
                ], 401);
            }
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xóa sản phẩm khỏi wishlist');
        }

        $wishlist = Wishlist::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $wishlist->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được xóa khỏi wishlist',
                'wishlist_count' => Wishlist::where('user_id', Auth::id())->count()
            ]);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi wishlist');
    }

    public function isInWishlist($productId)
    {
        if (!Auth::check()) {
            return response()->json(['inWishlist' => false, 'wishlistId' => null]);
        }

        $wishlistItem = Wishlist::where('user_id', Auth::id())
                              ->where('product_id', $productId)
                              ->first();

        return response()->json([
            'inWishlist' => $wishlistItem !== null,
            'wishlistId' => $wishlistItem?->id
        ]);
    }

    public function getWishlistCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        $count = Wishlist::where('user_id', Auth::id())->count();
        return response()->json(['count' => $count]);
    }

    public function getCartCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        $count = CartItem::whereHas('cart', function($q) {
            $q->where('user_id', Auth::id());
        })->sum('quantity');
        
        return response()->json(['count' => $count]);
    }
    
}

