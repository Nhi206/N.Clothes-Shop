<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\User;

class DashboardController extends BaseController
{
    public function index()
    {
        $this->authorizeAdmin();

        $totalCustomers = User::where('role', 'customer')->count();
        $totalStaff = User::where('role', 'staff')->count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at', now())->count();
        $totalRevenue = Order::sum('total_amount');
        $activeCategories = Category::count();
        $activePromotions = Promotion::count();

        $latestOrders = Order::with('user')->latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'totalCustomers',
            'totalStaff',
            'totalProducts',
            'totalOrders',
            'todayOrders',
            'totalRevenue',
            'activeCategories',
            'activePromotions',
            'latestOrders'
        ));
    }
}
