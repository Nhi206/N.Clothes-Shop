<x-admin-layout title="{{ $promotion->exists ? 'Chỉnh sửa khuyến mãi' : 'Thêm khuyến mãi mới' }}">
@php
$breadcrumbs = [
['title' => 'Khuyến mãi', 'url' => route('admin.promotions.index')],
['title' => $promotion->exists ? 'Chỉnh sửa' : 'Thêm mới', 'url' => null]
];
@endphp

<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-bold text-on-background">{{ $promotion->exists ? 'Chỉnh sửa khuyến mãi' : 'Thêm khuyến mãi mới' }}</h1>
        <p class="text-sm text-on-surface-variant mt-1">Quản lý mã giảm giá và điều kiện áp dụng.</p>
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

    <form method="POST" action="{{ $promotion->exists ? route('admin.promotions.update', $promotion) : route('admin.promotions.store') }}" class="space-y-6 rounded-3xl bg-white border border-outline-variant/10 p-8 shadow-sm">
        @csrf
        @if($promotion->exists)
            @method('PUT')
        @endif

        <div class="grid gap-6 lg:grid-cols-2">
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Mã khuyến mãi</span>
                <input name="code" value="{{ old('code', $promotion->code) }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Loại giảm giá</span>
                <select name="discount_type" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none">
                    <option value="percent" @selected(old('discount_type', $promotion->discount_type) == 'percent')>Phần trăm</option>
                    <option value="fixed" @selected(old('discount_type', $promotion->discount_type) == 'fixed')>Cố định</option>
                </select>
            </label>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Giá trị giảm</span>
                <input name="discount_value" type="number" step="0.01" value="{{ old('discount_value', $promotion->discount_value_formatted) }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Số tiền tối thiểu đơn hàng</span>
                <input name="min_order_amount" type="number" step="0.01" value="{{ old('min_order_amount', $promotion->min_order_amount) }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" placeholder="0 nếu không yêu cầu" />
            </label>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Giới hạn sử dụng</span>
                <input name="usage_limit" type="number" value="{{ old('usage_limit', $promotion->usage_limit) }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Ngày bắt đầu</span>
                <input name="start_date" type="date" value="{{ old('start_date', $promotion->start_date ? $promotion->start_date->format('Y-m-d') : '') }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Ngày kết thúc</span>
                <input name="end_date" type="date" value="{{ old('end_date', $promotion->end_date ? $promotion->end_date->format('Y-m-d') : '') }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
            <div></div>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.promotions.index') }}" class="rounded-3xl bg-surface-container px-6 py-3 text-sm font-semibold text-on-surface hover:bg-surface-variant transition-colors">Hủy</a>
            <button type="submit" class="rounded-3xl bg-primary px-6 py-3 text-sm font-semibold text-white hover:bg-primary-container transition-colors">Lưu</button>
        </div>
    </form>
</div>
</x-admin-layout>