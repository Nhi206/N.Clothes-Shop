<x-admin-layout title="Chi tiết kho">
@php
$breadcrumbs = [
    ['title' => 'Kho', 'url' => route('admin.inventories.index')],
    ['title' => 'Chi tiết', 'url' => null]
];
@endphp

<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-bold text-on-background">Chi tiết kho</h1>
        <p class="text-sm text-on-surface-variant mt-1">Xem thông tin tồn kho và nguồn cung cấp.</p>
    </div>

    <div class="rounded-3xl bg-white border border-outline-variant/10 p-8 shadow-sm">
        <div class="grid gap-6 lg:grid-cols-2">
            <div class="space-y-4">
                <div>
                    <h2 class="text-sm uppercase tracking-[0.3em] text-outline-variant">Sản phẩm</h2>
                    <p class="mt-2 text-lg font-semibold">{{ optional($inventory->product)->name ?? '-' }}</p>
                </div>
                <div>
                    <h2 class="text-sm uppercase tracking-[0.3em] text-outline-variant">Nhà cung cấp</h2>
                    <p class="mt-2 text-lg">{{ optional($inventory->supplier)->name ?? '-' }}</p>
                </div>
                <div>
                    <h2 class="text-sm uppercase tracking-[0.3em] text-outline-variant">Số lượng</h2>
                    <p class="mt-2 text-lg">{{ $inventory->quantity }}</p>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <h2 class="text-sm uppercase tracking-[0.3em] text-outline-variant">Giá vốn</h2>
                    <p class="mt-2 text-lg">{{ $inventory->cost_price ? number_format($inventory->cost_price, 0, ',', '.') . ' VND' : '-' }}</p>
                </div>
                <div>
                    <h2 class="text-sm uppercase tracking-[0.3em] text-outline-variant">Vị trí kho</h2>
                    <p class="mt-2 text-lg">{{ $inventory->location ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <a href="{{ route('admin.inventories.index') }}" class="rounded-3xl bg-surface-container px-6 py-3 text-sm font-semibold text-on-surface hover:bg-surface-variant transition-colors">Quay lại</a>
        </div>
    </div>
</div>
</x-admin-layout>