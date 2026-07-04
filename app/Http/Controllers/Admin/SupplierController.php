<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends BaseController
{
    public function index()
    {
        $suppliers = Supplier::paginate(10);
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
        ]);

        Supplier::create($request->all());

        return redirect()->route('admin.suppliers.index')->with('success', 'Nhà cung cấp đã được tạo thành công.');
    }

    public function show(Supplier $supplier)
    {
        return view('admin.suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
        ]);

        $supplier->update($request->all());

        return redirect()->route('admin.suppliers.index')->with('success', 'Nhà cung cấp đã được cập nhật thành công.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('admin.suppliers.index')->with('success', 'Nhà cung cấp đã được xóa thành công.');
    }
}
