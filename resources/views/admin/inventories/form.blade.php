<x-admin-layout title="{{ $inventory->exists ? 'Chỉnh sửa kho' : 'Thêm kho mới' }}">
@php
$breadcrumbs = [
['title' => 'Kho', 'url' => route('admin.inventories.index')],
['title' => $inventory->exists ? 'Chỉnh sửa' : 'Thêm mới', 'url' => null]
];
@endphp

<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-bold text-on-background">{{ $inventory->exists ? 'Chỉnh sửa kho' : 'Thêm kho mới' }}</h1>
        <p class="text-sm text-on-surface-variant mt-1">Quản lý tồn kho, nhà cung cấp và chi phí.</p>
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

    <form method="POST" action="{{ $inventory->exists ? route('admin.inventories.update', $inventory) : route('admin.inventories.store') }}" class="space-y-6 rounded-3xl bg-white border border-outline-variant/10 p-8 shadow-sm">
        @csrf
        @if($inventory->exists)
            @method('PUT')
        @endif

        <div class="grid gap-6 lg:grid-cols-2">
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Sản phẩm</span>
                <select name="product_id" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none">
                    <option value="">Chọn sản phẩm</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" @selected(old('product_id', $inventory->product_id) == $product->id)>{{ $product->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Nhà cung cấp</span>
                <select name="supplier_id" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none">
                    <option value="">Chọn nhà cung cấp</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" @selected(old('supplier_id', $inventory->supplier_id) == $supplier->id)>{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </label>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Số lượng</span>
                <input name="quantity" type="number" value="{{ old('quantity', $inventory->quantity) }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Giá vốn</span>
                <input name="cost_price" type="number" step="0.01" value="{{ old('cost_price', $inventory->cost_price) }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Vị trí kho</span>
                <input name="location" value="{{ old('location', $inventory->location) }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
            <div></div>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.inventories.index') }}" class="rounded-3xl bg-surface-container px-6 py-3 text-sm font-semibold text-on-surface hover:bg-surface-variant transition-colors">Hủy</a>
            <button type="submit" class="rounded-3xl bg-primary px-6 py-3 text-sm font-semibold text-white hover:bg-primary-container transition-colors">Lưu</button>
        </div>
    </form>
</div>
</x-admin-layout>