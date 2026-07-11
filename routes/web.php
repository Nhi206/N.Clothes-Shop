<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatboxController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TryOnController;

Route::get('/', function () {
    return view('layouts.app');
});

require __DIR__.'/auth.php';

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

Route::middleware(['auth'])->group(function () {
    // Trang chủ
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Sản phẩm
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/categories/{id}', [ProductController::class, 'category'])->name('products.category');

    // Giỏ hàng
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Wishlist
    Route::get('/wishlist', [CartController::class, 'wishlist'])->name('wishlist.index');
    Route::post('/wishlist/{productId}', [CartController::class, 'addToWishlist'])->name('wishlist.add');
    Route::delete('/wishlist/{id}', [CartController::class, 'removeFromWishlist'])->name('wishlist.remove');
    Route::get('/api/wishlist/check/{productId}', [CartController::class, 'isInWishlist'])->name('wishlist.check');
    Route::get('/api/wishlist/count', [CartController::class, 'getWishlistCount'])->name('wishlist.count');
    Route::get('/api/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');

    // Đơn hàng
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    // Đánh giá
    Route::post('/products/{productId}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/products/{productId}/reviews', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/api/products/{productId}/reviews', [ReviewController::class, 'get'])->name('reviews.get');
    Route::get('/api/products/{productId}/reviews/user', [ReviewController::class, 'getUserReview'])->name('reviews.getUserReview');
    Route::get('/api/products/{productId}/reviews/rating', [ReviewController::class, 'getAverageRating'])->name('reviews.getAverageRating');
    Route::get('/api/products/{productId}/reviews/distribution', [ReviewController::class, 'getRatingDistribution'])->name('reviews.distribution');

    // Thiết kế
    Route::get('/designs', [DesignController::class, 'myDesigns'])->name('design.list');
    Route::get('/design', [DesignController::class, 'index'])->name('design.index');
    Route::post('/design', [DesignController::class, 'save'])->name('design.save');
    Route::get('/design/{id}', [DesignController::class, 'show'])->name('design.show');
    Route::post('/try-on', [TryOnController::class, 'tryOn'])->name('try-on.process');

    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // settings
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings.edit');
    Route::patch('/settings', [ProfileController::class, 'settingsUpdate'])->name('settings.update');

    // Tin tức
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', AdminUserController::class)->except(['show']);
    Route::resource('products', AdminProductController::class)->except(['show']);
    Route::resource('categories', AdminCategoryController::class)->except(['show']);
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update']);
    Route::resource('promotions', PromotionController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('inventories', InventoryController::class);
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
});

Route::get('/api/products/{id}/variants', function($id) {
    $variants = App\Models\ProductVariant::where('product_id', $id)->get();
    return response()->json(['variants' => $variants]);
});

Route::post('/api/chatbox/message', [ChatboxController::class, 'message'])->name('chatbox.message');

