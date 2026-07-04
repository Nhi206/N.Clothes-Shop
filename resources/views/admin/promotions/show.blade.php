<x-admin-layout title="Chi tiết khuyến mãi">
@php
$breadcrumbs = [
    ['title' => 'Khuyến mãi', 'url' => route('admin.promotions.index')],
    ['title' => 'Chi tiết', 'url' => null]
];
@endphp

<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-bold text-on-background">Chi tiết khuyến mãi</h1>
        <p class="text-sm text-on-surface-variant mt-1">Xem thông tin mã giảm giá và trạng thái áp dụng.</p>
    </div>

    <div class="rounded-3xl bg-white border border-outline-variant/10 p-8 shadow-sm">
        <div class="grid gap-6 lg:grid-cols-2">
            <div class="space-y-4">
                <div>
                    <h2 class="text-sm uppercase tracking-[0.3em] text-outline-variant">Mã</h2>
                    <p class="mt-2 text-lg font-semibold">{{ $promotion->code }}</p>
                </div>
                <div>
                    <h2 class="text-sm uppercase tracking-[0.3em] text-outline-variant">Loại giảm</h2>
                    <p class="mt-2 text-lg">{{ $promotion->discount_type == 'percent' ? 'Phần trăm' : 'Cố định' }}</p>
                </div>
                <div>
                    <h2 class="text-sm uppercase tracking-[0.3em] text-outline-variant">Giá trị</h2>
                    <p class="mt-2 text-lg">{{ $promotion->discount_value_formatted }}{{ $promotion->discount_type == 'percent' ? '%' : ' VND' }}</p>
                </div>
                <div>
                    <h2 class="text-sm uppercase tracking-[0.3em] text-outline-variant">Điều kiện đơn hàng</h2>
                    <p class="mt-2 text-lg">{{ $promotion->min_order_amount ? 'Đơn hàng từ ' . number_format($promotion->min_order_amount, 0, ',', '.') . 'đ trở lên' : 'Không yêu cầu' }}</p>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <h2 class="text-sm uppercase tracking-[0.3em] text-outline-variant">Ngày bắt đầu</h2>
                    <p class="mt-2 text-lg">{{ $promotion->start_date->format('d/m/Y') }}</p>
                </div>
                <div>
                    <h2 class="text-sm uppercase tracking-[0.3em] text-outline-variant">Ngày kết thúc</h2>
                    <p class="mt-2 text-lg">{{ $promotion->end_date->format('d/m/Y') }}</p>
                </div>
                <div>
                    <h2 class="text-sm uppercase tracking-[0.3em] text-outline-variant">Số lần sử dụng</h2>
                    <p class="mt-2 text-lg">{{ $promotion->usage_limit ?? 'Không giới hạn' }}</p>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <a href="{{ route('admin.promotions.index') }}" class="rounded-3xl bg-surface-container px-6 py-3 text-sm font-semibold text-on-surface hover:bg-surface-variant transition-colors">Quay lại</a>
        </div>
    </div>
</div>
</x-admin-layout>