<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class InventoryController extends BaseController
{
    public function index()
    {
        $inventories = Inventory::with('product', 'supplier')->paginate(10);
        return view('admin.inventories.index', compact('inventories'));
    }

    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('admin.inventories.create', compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'location' => 'nullable|string|max:255',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'cost_price' => 'nullable|numeric|min:0',
        ]);

        Inventory::create($request->all());

        return redirect()->route('admin.inventories.index')->with('success', 'Kho đã được tạo thành công.');
    }

    public function show(Inventory $inventory)
    {
        return view('admin.inventories.show', compact('inventory'));
    }

    public function edit(Inventory $inventory)
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('admin.inventories.edit', compact('inventory', 'products', 'suppliers'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'location' => 'nullable|string|max:255',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'cost_price' => 'nullable|numeric|min:0',
        ]);

        $inventory->update($request->all());

        return redirect()->route('admin.inventories.index')->with('success', 'Kho đã được cập nhật thành công.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->route('admin.inventories.index')->with('success', 'Kho đã được xóa thành công.');
    }
}
