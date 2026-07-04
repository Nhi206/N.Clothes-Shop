<x-admin-layout title="Quản lý sản phẩm">
@php
$breadcrumbs = [
    ['title' => 'Sản phẩm', 'url' => null]
];
$title = 'Quản lý sản phẩm';
$description = 'Danh sách sản phẩm, trạng thái và danh mục.';
$actions = [
    ['type' => 'button', 'url' => route('admin.products.create'), 'label' => 'Thêm sản phẩm', 'icon' => 'add']
];
@endphp

<div class="space-y-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-on-background">Quản lý sản phẩm</h1>
            <p class="text-sm text-on-surface-variant mt-1">Danh sách sản phẩm, trạng thái và danh mục.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center rounded-3xl bg-primary px-5 py-3 text-sm font-semibold text-white hover:bg-primary-container transition">
            <span class="material-symbols-outlined mr-2">add</span>
            Thêm sản phẩm
        </a>
    </div>

    <form method="GET" action="{{ route('admin.products.index') }}" class="grid gap-3 sm:grid-cols-3">
        <input name="search" value="{{ request('search') }}" class="rounded-3xl border border-outline-variant/70 bg-white px-4 py-3 text-sm shadow-sm focus:border-primary focus:outline-none" placeholder="Tìm kiếm sản phẩm" />
        <select name="category_id" class="rounded-3xl border border-outline-variant/70 bg-white px-4 py-3 text-sm shadow-sm focus:border-primary focus:outline-none">
            <option value="">Tất cả danh mục</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="rounded-3xl bg-secondary px-5 py-3 text-sm font-semibold text-white hover:bg-secondary-container transition-colors">Lọc</button>
    </form>

    <div class="overflow-hidden rounded-3xl border border-outline-variant/10 bg-white shadow-sm">
        <table class="min-w-full text-left text-sm text-on-surface">
            <thead class="bg-surface-container-high text-on-surface-variant">
                <tr>
                    <th class="px-5 py-4 font-semibold uppercase">Tên</th>
                    <th class="px-5 py-4 font-semibold uppercase">Danh mục</th>
                    <th class="px-5 py-4 font-semibold uppercase">Thương hiệu</th>
                    <th class="px-5 py-4 font-semibold uppercase">Trạng thái</th>
                    <th class="px-5 py-4 font-semibold uppercase">Ngày tạo</th>
                    <th class="px-5 py-4 font-semibold uppercase">Hành động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/10">
                @forelse($products as $product)
                    <tr>
                        <td class="px-5 py-4">{{ $product->name }}</td>
                        <td class="px-5 py-4">{{ optional($product->category)->name ?? '-' }}</td>
                        <td class="px-5 py-4">{{ optional($product->brand)->name ?? '-' }}</td>
                        <td class="px-5 py-4 capitalize">{{ $product->status }}</td>
                        <td class="px-5 py-4">{{ $product->created_at->format('d/m/Y') }}</td>
                        <td class="px-5 py-4 space-x-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="rounded-full bg-surface-container-high px-4 py-2 text-xs font-semibold text-primary hover:bg-surface-variant">Sửa</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Xóa sản phẩm này?')" class="rounded-full bg-rose-50 px-4 py-2 text-xs font-semibold text-rose-700 hover:bg-rose-100">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-on-surface-variant">Không có sản phẩm nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $products->links() }}</div>
</div>
</x-admin-layout>
