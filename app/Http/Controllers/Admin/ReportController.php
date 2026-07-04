<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportController extends BaseController
{
    public function index()
    {
        $this->authorizeAdmin();

        // Revenue data
        $revenueByDay = Order::where('status', 'completed')
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(30)
            ->pluck('total', 'date');

        // Order statistics
        $ordersByStatus = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        // Top products
        $topProducts = DB::table('order_items')
            ->join('product_variants', 'order_items.variant_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->select('products.id', 'products.name', DB::raw('SUM(order_items.quantity) as sold'), DB::raw('SUM(order_items.price * order_items.quantity) as revenue'))
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('sold')
            ->limit(10)
            ->get();

        // User statistics
        $totalUsers = User::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalStaff = User::where('role', 'staff')->count();
        $totalAdmins = User::where('role', 'admin')->count();

        // Order statistics
        $totalOrders = Order::count();
        $completedOrders = Order::where('status', 'completed')->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        return view('admin.reports.index', compact(
            'revenueByDay',
            'ordersByStatus',
            'topProducts',
            'totalUsers',
            'totalCustomers',
            'totalStaff',
            'totalAdmins',
            'totalOrders',
            'completedOrders',
            'pendingOrders',
            'totalRevenue',
            'averageOrderValue'
        ));
    }
}
