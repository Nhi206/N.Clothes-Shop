<x-admin-layout title="Quản lý danh mục">
@php
$breadcrumbs = [
['title' => 'Danh mục', 'url' => null]
];
@endphp

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-on-background">Quản lý danh mục</h1>
            <p class="text-sm text-on-surface-variant mt-1">Tạo và cập nhật danh mục sản phẩm cho cửa hàng.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white shadow-sm shadow-primary/20 hover:bg-primary-container">Thêm danh mục</a>
    </div>

    <div class="overflow-hidden rounded-3xl border border-outline-variant/10 bg-white shadow-sm">
        <table class="min-w-full text-left text-sm text-on-surface">
            <thead class="bg-surface-container-high text-on-surface-variant">
                <tr>
                    <th class="px-5 py-4 font-semibold uppercase">Tên danh mục</th>
                    <th class="px-5 py-4 font-semibold uppercase">Ngày tạo</th>
                    <th class="px-5 py-4 font-semibold uppercase">Hành động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/10">
                @forelse($categories as $category)
                    <tr>
                        <td class="px-5 py-4">{{ $category->name }}</td>
                        <td class="px-5 py-4">{{ $category->created_at->format('d/m/Y') }}</td>
                        <td class="px-5 py-4 space-x-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="rounded-full bg-surface-container-high px-4 py-2 text-xs font-semibold text-primary hover:bg-surface-variant">Sửa</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Xóa danh mục này?')" class="rounded-full bg-rose-50 px-4 py-2 text-xs font-semibold text-rose-700 hover:bg-rose-100">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-5 py-8 text-center text-on-surface-variant">Không có danh mục nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $categories->links() }}</div>
</div>
</x-admin-layout>
