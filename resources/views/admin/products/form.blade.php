<x-admin-layout title="{{ $product->exists ? 'Chỉnh sửa sản phẩm' : 'Thêm sản phẩm mới' }}">
@php
$breadcrumbs = [
['title' => 'Sản phẩm', 'url' => route('admin.products.index')],
['title' => $product->exists ? 'Chỉnh sửa' : 'Thêm mới', 'url' => null]
];
@endphp

<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-bold text-on-background">{{ $product->exists ? 'Chỉnh sửa sản phẩm' : 'Thêm sản phẩm mới' }}</h1>
        <p class="text-sm text-on-surface-variant mt-1">Quản lý tiêu đề, danh mục, thương hiệu và trạng thái sản phẩm.</p>
    </div>

    @if($errors->any())
        <div class="rounded-3xl bg-rose-50 border border-rose-200 p-4 text-sm text-rose-900">
            <ul class="list-disc space-y-2 pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" class="space-y-6 rounded-3xl bg-white border border-outline-variant/10 p-8 shadow-sm">
        @csrf
        @if($product->exists)
            @method('PUT')
        @endif

        <div class="grid gap-6 lg:grid-cols-2">
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Tên sản phẩm</span>
                <input name="name" value="{{ old('name', $product->name) }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Danh mục</span>
                <select name="category_id" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none">
                    <option value="">Chọn danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </label>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Thương hiệu</span>
                <select name="brand_id" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none">
                    <option value="">Chọn thương hiệu</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id) == $brand->id)>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Trạng thái</span>
                <select name="status" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none">
                    <option value="active" @selected(old('status', $product->status) === 'active')>Active</option>
                    <option value="inactive" @selected(old('status', $product->status) === 'inactive')>Inactive</option>
                    <option value="pending" @selected(old('status', $product->status) === 'pending')>Pending</option>
                </select>
            </label>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Giá sản phẩm</span>
                <input name="price" type="number" step="0.01" value="{{ old('price', $product->price) }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Số lượng</span>
                <input name="quantity" type="number" value="{{ old('quantity', $product->quantity) }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
        </div>

        <label class="space-y-2 text-sm font-medium text-on-surface">
            <span>Mô tả</span>
            <textarea name="description" rows="5" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-4 text-sm shadow-sm focus:border-primary focus:outline-none">{{ old('description', $product->description) }}</textarea>
        </label>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-end">
            <a href="{{ route('admin.products.index') }}" class="rounded-full border border-outline-variant/70 px-6 py-3 text-sm font-semibold text-on-surface-variant hover:bg-surface-container">Hủy</a>
            <button type="submit" class="rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white hover:bg-primary-container">{{ $product->exists ? 'Cập nhật' : 'Lưu' }}</button>
        </div>
    </form>
</div>
</x-admin-layout>
