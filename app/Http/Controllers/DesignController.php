<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Design;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class DesignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::where('is_customizable', true)->get(); // Giả sử có trường is_customizable

        return view('design.index', compact('products'));
    }

    public function myDesigns()
    {
        $designs = Design::where('user_id', Auth::id())
            ->with('product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('design.list', compact('designs'));
    }

    public function save(Request $request)
{
    $request->validate([
        'product_id'            => 'required|exists:products,id',
        'design_data'           => 'required',
        'preview_rendered'      => 'nullable',
        'preview_rendered_back' => 'nullable',
        'direct_order'          => 'nullable|boolean',
    ]);

    \Log::info('Design save called', [
        'all_data' => $request->all(),
        'direct_order' => $request->boolean('direct_order'),
        'user_id' => Auth::id()
    ]);

    $product = Product::findOrFail($request->product_id);

    /*
    |--------------------------------------------------------------------------
    | SAVE RENDERED IMAGE
    |--------------------------------------------------------------------------
    */

    $previewPath = null;
    $previewPathBack = null;

    if ($request->preview_rendered) {
        $image = $request->preview_rendered;
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $fileName = 'designs/' . Str::uuid() . '.png';
        Storage::disk('public')->put($fileName, base64_decode($image));
        $previewPath = $fileName;
    }

    if ($request->preview_rendered_back) {
        $imageBack = $request->preview_rendered_back;
        $imageBack = str_replace('data:image/png;base64,', '', $imageBack);
        $imageBack = str_replace(' ', '+', $imageBack);
        $fileNameBack = 'designs/' . Str::uuid() . '.png';
        Storage::disk('public')->put($fileNameBack, base64_decode($imageBack));
        $previewPathBack = $fileNameBack;
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE DESIGN
    |--------------------------------------------------------------------------
    */

    $design = Design::create([
        'user_id'             => Auth::id(),
        'product_id'          => $request->product_id,
        'design_data'         => json_decode($request->design_data, true),
        'preview_image'       => $previewPath,
        'preview_image_front' => $previewPath,
        'preview_image_back'  => $previewPathBack ?? $previewPath,
    ]);

    /*
    |--------------------------------------------------------------------------
    | CREATE CART
    |--------------------------------------------------------------------------
    */

    $cart = Cart::firstOrCreate([
        'user_id' => Auth::id()
    ]);

    /*
    |--------------------------------------------------------------------------
    | CREATE CART ITEM
    |--------------------------------------------------------------------------
    */

    $cartItem = CartItem::create([
        'cart_id'   => $cart->id,
        'product_id'=> $product->id,
        'design_id' => $design->id,
        'quantity'  => 1,
    ]);

    // Refresh cart to ensure relationships are loaded
    $cart->refresh();

    /*
    |--------------------------------------------------------------------------
    | DIRECT ORDER
    |--------------------------------------------------------------------------
    */

    if ($request->boolean('direct_order')) {
        \Log::info('Direct order redirect', ['cart_item_id' => $cartItem->id, 'selected_items' => [$cartItem->id]]);

        // Store selected items in session for checkout
        session(['direct_order_items' => [$cartItem->id]]);

        return redirect()
            ->route('orders.checkout')
            ->with(
                'success',
                'Thiết kế đã được thêm vào giỏ hàng.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | NORMAL CART
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('cart.index')
        ->with(
            'success',
            'Thiết kế đã được lưu và thêm vào giỏ hàng'
        );
}

    public function show($id)
    {
        $design = Design::with('product')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        return view('design.show', compact('design'));
    }
}
