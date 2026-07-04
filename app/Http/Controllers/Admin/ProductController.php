<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index(Request $request)
    {
        $this->authorizeAdmin();

        $query = Product::with(['category', 'brand']);

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('admin.products.index', [
            'products' => $products,
            'categories' => Category::orderBy('name')->get(),
            'brands' => Brand::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        $this->authorizeAdmin();

        return view('admin.products.form', [
            'product' => new Product(),
            'categories' => Category::orderBy('name')->get(),
            'brands' => Brand::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'required|in:active,inactive,pending',
            'price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
        ]);

        $product = Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được tạo thành công.');
    }

    public function edit(string $id)
    {
        $this->authorizeAdmin();

        $product = Product::findOrFail($id);

        return view('admin.products.form', [
            'product' => $product,
            'categories' => Category::orderBy('name')->get(),
            'brands' => Brand::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $this->authorizeAdmin();

        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => "required|string|max:255|unique:products,name,{$product->id}",
            'description' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'required|in:active,inactive,pending',
            'price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    public function destroy(string $id)
    {
        $this->authorizeAdmin();

        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công.');
    }
}
