<x-admin-layout title="Quản lý đơn hàng">
@php
$breadcrumbs = [
['title' => 'Đơn hàng', 'url' => null]
];
@endphp

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-on-background">Quản lý đơn hàng</h1>
            <p class="text-sm text-on-surface-variant mt-1">Xem và cập nhật trạng thái đơn hàng của khách hàng.</p>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.orders.index') }}" class="grid gap-3 sm:grid-cols-4">
        <input name="search" value="{{ request('search') }}" class="rounded-3xl border border-outline-variant/70 bg-white px-4 py-3 text-sm shadow-sm focus:border-primary focus:outline-none" placeholder="Tìm mã đơn, tên khách..." />
        <select name="status" class="rounded-3xl border border-outline-variant/70 bg-white px-4 py-3 text-sm shadow-sm focus:border-primary focus:outline-none">
            <option value="">Tất cả trạng thái</option>
            <option value="pending" @selected(request('status') === 'pending')>Chờ xử lý</option>
            <option value="processing" @selected(request('status') === 'processing')>Đang xử lý</option>
            <option value="completed" @selected(request('status') === 'completed')>Hoàn thành</option>
            <option value="cancelled" @selected(request('status') === 'cancelled')>Hủy</option>
            <option value="refunded" @selected(request('status') === 'refunded')>Hoàn tiền</option>
        </select>
        <input name="date_from" type="date" value="{{ request('date_from') }}" class="rounded-3xl border border-outline-variant/70 bg-white px-4 py-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
        <button type="submit" class="rounded-3xl bg-secondary px-5 py-3 text-sm font-semibold text-white hover:bg-secondary-container transition-colors">Lọc</button>
    </form>
        <table class="min-w-full text-left text-sm text-on-surface">
            <thead class="bg-surface-container-high text-on-surface-variant">
                <tr>
                    <th class="px-5 py-4 font-semibold uppercase">Mã đơn</th>
                    <th class="px-5 py-4 font-semibold uppercase">Khách hàng</th>
                    <th class="px-5 py-4 font-semibold uppercase">Tổng tiền</th>
                    <th class="px-5 py-4 font-semibold uppercase">Trạng thái</th>
                    <th class="px-5 py-4 font-semibold uppercase">Ngày tạo</th>
                    <th class="px-5 py-4 font-semibold uppercase">Hành động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/10">
                @forelse($orders as $order)
                    <tr>
                        <td class="px-5 py-4 font-semibold text-primary">#{{ $order->id }}</td>
                        <td class="px-5 py-4">{{ optional($order->user)->name ?? 'Khách' }}</td>
                        <td class="px-5 py-4 font-semibold">{{ number_format($order->total_amount ?? 0, 0, ',', '.') }}₫</td>
                        <td class="px-5 py-4">
                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : ($order->status === 'pending' ? 'bg-amber-100 text-amber-800' : ($order->status === 'cancelled' ? 'bg-rose-100 text-rose-700' : 'bg-slate-100 text-slate-700')) }}">{{ ucfirst($order->status) }}</span>
                        </td>
                        <td class="px-5 py-4">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-5 py-4">
                            <a href="{{ route('admin.orders.show', $order) }}" class="rounded-full bg-primary px-4 py-2 text-xs font-semibold text-white hover:bg-primary-container transition-colors">Chi tiết</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-on-surface-variant">Không có đơn hàng.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $orders->links() }}</div>
</div>
</x-admin-layout>
