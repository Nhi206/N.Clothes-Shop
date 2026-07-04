<x-admin-layout title="Báo cáo">
@php
$breadcrumbs = [
['title' => 'Báo cáo', 'url' => null]
];
@endphp

<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-bold text-on-background">Báo cáo quản trị</h1>
        <p class="text-sm text-on-surface-variant mt-1">Bảng báo cáo doanh thu, đơn hàng, người dùng và sản phẩm bán chạy.</p>
    </div>

    <!-- Key Statistics Cards -->
    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-5">
        <div class="rounded-3xl bg-surface-container-lowest border border-outline-variant/10 p-6 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-on-surface-variant mb-4">Tổng doanh thu</p>
            <p class="text-3xl font-extrabold text-primary">{{ number_format($totalRevenue, 0, ',', '.') }}₫</p>
        </div>
        <div class="rounded-3xl bg-surface-container-lowest border border-outline-variant/10 p-6 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-on-surface-variant mb-4">Tổng đơn hàng</p>
            <p class="text-3xl font-extrabold text-primary">{{ $totalOrders }}</p>
        </div>
        <div class="rounded-3xl bg-surface-container-lowest border border-outline-variant/10 p-6 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-on-surface-variant mb-4">Đơn hoàn thành</p>
            <p class="text-3xl font-extrabold text-primary">{{ $completedOrders }}</p>
        </div>
        <div class="rounded-3xl bg-surface-container-lowest border border-outline-variant/10 p-6 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-on-surface-variant mb-4">Giá trị trung bình</p>
            <p class="text-3xl font-extrabold text-primary">{{ number_format($averageOrderValue, 0, ',', '.') }}₫</p>
        </div>
        <div class="rounded-3xl bg-surface-container-lowest border border-outline-variant/10 p-6 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-on-surface-variant mb-4">Tổng người dùng</p>
            <p class="text-3xl font-extrabold text-primary">{{ $totalUsers }}</p>
        </div>
    </div>

    <!-- User Statistics -->
    <div class="grid gap-6 sm:grid-cols-4">
        <div class="rounded-3xl bg-white border border-outline-variant/10 p-6 shadow-sm">
            <p class="text-sm text-on-surface-variant">Khách hàng</p>
            <p class="text-2xl font-bold text-primary mt-2">{{ $totalCustomers }}</p>
        </div>
        <div class="rounded-3xl bg-white border border-outline-variant/10 p-6 shadow-sm">
            <p class="text-sm text-on-surface-variant">Nhân viên</p>
            <p class="text-2xl font-bold text-primary mt-2">{{ $totalStaff }}</p>
        </div>
        <div class="rounded-3xl bg-white border border-outline-variant/10 p-6 shadow-sm">
            <p class="text-sm text-on-surface-variant">Admin</p>
            <p class="text-2xl font-bold text-primary mt-2">{{ $totalAdmins }}</p>
        </div>
        <div class="rounded-3xl bg-white border border-outline-variant/10 p-6 shadow-sm">
            <p class="text-sm text-on-surface-variant">Đơn chờ xử lý</p>
            <p class="text-2xl font-bold text-amber-600 mt-2">{{ $pendingOrders }}</p>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-3">
        <div class="rounded-3xl bg-white border border-outline-variant/10 p-6 shadow-sm">
            <h2 class="text-sm font-semibold uppercase tracking-[0.3em] text-on-surface-variant">Doanh thu 30 ngày</h2>
            <div class="mt-5 space-y-3 text-sm text-on-surface-variant max-h-96 overflow-y-auto">
                @forelse($revenueByDay as $date => $total)
                    <div class="flex items-center justify-between rounded-3xl bg-surface-container p-4">
                        <span>{{ \Illuminate\Support\Carbon::parse($date)->format('d/m') }}</span>
                        <span class="font-semibold text-on-background">{{ number_format($total, 0, ',', '.') }}₫</span>
                    </div>
                @empty
                    <p>Không có dữ liệu doanh thu.</p>
                @endforelse
            </div>
        </div>

        <div class="rounded-3xl bg-white border border-outline-variant/10 p-6 shadow-sm">
            <h2 class="text-sm font-semibold uppercase tracking-[0.3em] text-on-surface-variant">Đơn hàng theo trạng thái</h2>
            <div class="mt-5 space-y-3 text-sm text-on-surface-variant">
                @forelse($ordersByStatus as $status => $count)
                    <div class="flex items-center justify-between rounded-3xl bg-surface-container p-4">
                        <span class="capitalize">{{ $status }}</span>
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary text-white font-bold text-xs">{{ $count }}</span>
                    </div>
                @empty
                    <p>Không có đơn hàng.</p>
                @endforelse
            </div>
        </div>

        <div class="rounded-3xl bg-white border border-outline-variant/10 p-6 shadow-sm">
            <h2 class="text-sm font-semibold uppercase tracking-[0.3em] text-on-surface-variant">Sản phẩm bán chạy top 10</h2>
            <div class="mt-5 space-y-3 text-sm text-on-surface-variant max-h-96 overflow-y-auto">
                @forelse($topProducts as $product)
                    <div class="rounded-3xl bg-surface-container p-4 space-y-1">
                        <p class="font-semibold text-on-background truncate">{{ $product->name }}</p>
                        <p class="text-xs">Bán: <span class="font-bold text-primary">{{ $product->sold }}</span> | Doanh thu: <span class="font-bold">{{ number_format($product->revenue, 0, ',', '.') }}₫</span></p>
                    </div>
                @empty
                    <p>Không có sản phẩm bán chạy.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
</x-admin-layout>
