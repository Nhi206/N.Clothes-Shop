<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends BaseController
{
    public function index()
    {
        $promotions = Promotion::paginate(10);
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('admin.promotions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:promotions',
            'discount_type' => 'required|in:percent,fixed',
            'discount_value' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'usage_limit' => 'nullable|integer|min:0',
        ]);

        Promotion::create($request->all());

        return redirect()->route('admin.promotions.index')->with('success', 'Khuyến mãi đã được tạo thành công.');
    }

    public function show(Promotion $promotion)
    {
        return view('admin.promotions.show', compact('promotion'));
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'code' => 'required|unique:promotions,code,' . $promotion->id,
            'discount_type' => 'required|in:percent,fixed',
            'discount_value' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'usage_limit' => 'nullable|integer|min:0',
        ]);

        $promotion->update($request->all());

        return redirect()->route('admin.promotions.index')->with('success', 'Khuyến mãi đã được cập nhật thành công.');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect()->route('admin.promotions.index')->with('success', 'Khuyến mãi đã được xóa thành công.');
    }
}
