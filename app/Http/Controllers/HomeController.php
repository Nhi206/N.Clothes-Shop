<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy 8 sản phẩm mới nhất để hiển thị ở trang chủ
        $products = Product::latest()->take(8)->get();
        
        return view('layouts.app', compact('products'));
    }
}