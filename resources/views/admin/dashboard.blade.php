includes('components.admin-layout', ['title' => 'Dashboard'])
<x-admin-layout title="Dashboard">
@php
$breadcrumbs = [
['title' => 'Dashboard', 'url' => null]
];
@endphp

<div class="space-y-8">
    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-3xl bg-surface-container-lowest border border-outline-variant/10 p-6 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-on-surface-variant mb-4">Khách hàng</p>
            <p class="text-4xl font-extrabold text-primary">{{ number_format($totalCustomers) }}</p>
            <p class="mt-3 text-sm text-on-surface-variant">Tổng khách hàng</p>
        </div>
        <div class="rounded-3xl bg-surface-container-lowest border border-outline-variant/10 p-6 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-on-surface-variant mb-4">Nhân viên</p>
            <p class="text-4xl font-extrabold text-primary">{{ number_format($totalStaff) }}</p>
            <p class="mt-3 text-sm text-on-surface-variant">Nhân viên đang hoạt động</p>
        </div>
        <div class="rounded-3xl bg-surface-container-lowest border border-outline-variant/10 p-6 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-on-surface-variant mb-4">Sản phẩm</p>
            <p class="text-4xl font-extrabold text-primary">{{ number_format($totalProducts) }}</p>
            <p class="mt-3 text-sm text-on-surface-variant">Sản phẩm đã đăng</p>
        </div>
        <div class="rounded-3xl bg-surface-container-lowest border border-outline-variant/10 p-6 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-on-surface-variant mb-4">Đơn hàng</p>
            <p class="text-4xl font-extrabold text-primary">{{ number_format($totalOrders) }}</p>
            <p class="mt-3 text-sm text-on-surface-variant">Tổng đơn hàng</p>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-[2fr_1fr]">
        <section class="rounded-3xl bg-surface-container-lowest border border-outline-variant/10 p-6 shadow-sm">
            <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-on-background">Tổng quan hoạt động</h2>
                    <p class="text-sm text-on-surface-variant mt-1">Theo dõi doanh thu, đơn hàng và sản phẩm mới nhất.</p>
                </div>
                <div class="inline-flex items-center gap-2 rounded-full bg-primary/5 px-4 py-2 text-sm font-semibold text-primary">
                    <span class="h-2.5 w-2.5 rounded-full bg-primary"></span>
                    Cập nhật lần cuối hôm nay
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-3xl bg-white p-5 shadow-sm border border-outline-variant/10">
                    <p class="text-sm text-on-surface-variant">Doanh thu</p>
                    <p class="mt-3 text-3xl font-extrabold text-primary">{{ number_format($totalRevenue, 0, ',', '.') }}₫</p>
                </div>
                <div class="rounded-3xl bg-white p-5 shadow-sm border border-outline-variant/10">
                    <p class="text-sm text-on-surface-variant">Đơn hàng hôm nay</p>
                    <p class="mt-3 text-3xl font-extrabold text-primary">{{ number_format($todayOrders) }}</p>
                </div>
            </div>
        </section>

        <section class="rounded-3xl bg-surface-container-lowest border border-outline-variant/10 p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-on-background">Danh mục & Khuyến mãi</h3>
            <div class="mt-6 space-y-4">
                <div class="rounded-3xl bg-white p-5 shadow-sm border border-outline-variant/10">
                    <p class="text-sm text-on-surface-variant">Danh mục</p>
                    <p class="mt-2 text-2xl font-extrabold text-primary">{{ number_format($activeCategories) }}</p>
                </div>
                <div class="rounded-3xl bg-white p-5 shadow-sm border border-outline-variant/10">
                    <p class="text-sm text-on-surface-variant">Khuyến mãi</p>
                    <p class="mt-2 text-2xl font-extrabold text-primary">{{ number_format($activePromotions) }}</p>
                </div>
            </div>
        </section>
    </div>

    <section class="rounded-3xl bg-surface-container-lowest border border-outline-variant/10 p-6 shadow-sm">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-on-background">Đơn hàng mới nhất</h2>
                <p class="text-sm text-on-surface-variant mt-1">Danh sách đơn hàng mới tạo gần đây.</p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 rounded-full bg-primary px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-primary/20 hover:bg-primary-container">Xem tất cả</a>
        </div>
        <div class="overflow-hidden rounded-3xl border border-outline-variant/10 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-outline-variant/10 text-left text-sm text-on-surface">
                <thead class="bg-surface-container-high text-on-surface-variant">
                    <tr>
                        <th class="px-5 py-4 font-semibold uppercase">Mã đơn</th>
                        <th class="px-5 py-4 font-semibold uppercase">Khách hàng</th>
                        <th class="px-5 py-4 font-semibold uppercase">Tổng tiền</th>
                        <th class="px-5 py-4 font-semibold uppercase">Trạng thái</th>
                        <th class="px-5 py-4 font-semibold uppercase">Ngày</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10 bg-white">
                    @forelse($latestOrders as $order)
                        <tr>
                            <td class="px-5 py-4 text-primary font-semibold">#{{ $order->id }}</td>
                            <td class="px-5 py-4">{{ optional($order->user)->name ?? 'Khách vãng lai' }}</td>
                            <td class="px-5 py-4">{{ number_format($order->total_amount ?? 0, 0, ',', '.') }}₫</td>
                            <td class="px-5 py-4">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : ($order->status === 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-700') }}">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td class="px-5 py-4">{{ $order->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-8 text-center text-on-surface-variant">Không có đơn hàng mới.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
</x-admin-layout>
