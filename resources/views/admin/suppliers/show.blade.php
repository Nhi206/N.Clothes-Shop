<x-admin-layout title="Chi tiết nhà cung cấp">
@php
$breadcrumbs = [
    ['title' => 'Nhà cung cấp', 'url' => route('admin.suppliers.index')],
    ['title' => 'Chi tiết', 'url' => null]
];
@endphp

<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-bold text-on-background">Chi tiết nhà cung cấp</h1>
        <p class="text-sm text-on-surface-variant mt-1">Xem thông tin đối tác cung cấp.</p>
    </div>

    <div class="rounded-3xl bg-white border border-outline-variant/10 p-8 shadow-sm">
        <div class="space-y-6">
            <div>
                <h2 class="text-sm uppercase tracking-[0.3em] text-outline-variant">Tên</h2>
                <p class="mt-2 text-lg font-semibold">{{ $supplier->name }}</p>
            </div>
            <div>
                <h2 class="text-sm uppercase tracking-[0.3em] text-outline-variant">Liên hệ</h2>
                <p class="mt-2 text-lg">{{ $supplier->contact ?? '-' }}</p>
            </div>
            <div>
                <h2 class="text-sm uppercase tracking-[0.3em] text-outline-variant">Ngày tạo</h2>
                <p class="mt-2 text-lg">{{ $supplier->created_at->format('d/m/Y') }}</p>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <a href="{{ route('admin.suppliers.index') }}" class="rounded-3xl bg-surface-container px-6 py-3 text-sm font-semibold text-on-surface hover:bg-surface-variant transition-colors">Quay lại</a>
        </div>
    </div>
</div>
</x-admin-layout>