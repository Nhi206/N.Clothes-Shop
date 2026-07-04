<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function index()
    {
        $this->authorizeAdmin();

        $categories = Category::orderBy('name')->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $this->authorizeAdmin();

        return view('admin.categories.form', [
            'category' => new Category(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Tạo danh mục thành công.');
    }

    public function edit(string $id)
    {
        $this->authorizeAdmin();

        $category = Category::findOrFail($id);

        return view('admin.categories.form', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $this->authorizeAdmin();

        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => "required|string|max:255|unique:categories,name,{$category->id}",
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công.');
    }

    public function destroy(string $id)
    {
        $this->authorizeAdmin();

        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục thành công.');
    }
}
