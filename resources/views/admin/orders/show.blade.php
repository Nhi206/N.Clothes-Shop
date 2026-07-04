<x-admin-layout title="Đơn hàng #{{ $order->id }}">
@php
$breadcrumbs = [
['title' => 'Đơn hàng', 'url' => route('admin.orders.index')],
['title' => '#' . $order->id, 'url' => null]
];
@endphp

<div class="space-y-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-on-background">Đơn hàng #{{ $order->id }}</h1>
            <p class="text-sm text-on-surface-variant mt-1">Chi tiết đơn hàng và cập nhật trạng thái.</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 rounded-full bg-surface-container-high px-5 py-3 text-sm font-semibold text-primary hover:bg-surface-variant">Quay lại danh sách</a>
    </div>

    <section class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-3xl bg-white border border-outline-variant/10 p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-on-background">Thông tin khách hàng</h2>
            <div class="mt-4 space-y-3 text-sm text-on-surface-variant">
                <p><strong>Tên:</strong> {{ optional($order->user)->name ?? 'Khách' }}</p>
                <p><strong>Email:</strong> {{ optional($order->user)->email ?? '-' }}</p>
                <p><strong>Địa chỉ:</strong> {{ optional($order->address)->address_detail ?? 'Không có' }}</p>
                <p><strong>Khuyến mãi:</strong> {{ optional($order->promotion)->code ?? 'Không sử dụng' }}</p>
            </div>
        </div>
        <div class="rounded-3xl bg-white border border-outline-variant/10 p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-on-background">Tóm tắt đơn hàng</h2>
            <div class="mt-4 space-y-3 text-sm text-on-surface-variant">
                <p><strong>Tổng tiền:</strong> <span class="text-lg font-bold text-primary">{{ number_format($order->total_amount ?? 0, 0, ',', '.') }}₫</span></p>
                <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Trạng thái:</strong> 
                    <span class="ml-2 inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : ($order->status === 'pending' ? 'bg-amber-100 text-amber-800' : ($order->status === 'cancelled' ? 'bg-rose-100 text-rose-700' : 'bg-slate-100 text-slate-700')) }}">{{ ucfirst($order->status) }}</span>
                </p>
            </div>
        </div>
    </section>

    <section class="rounded-3xl bg-white border border-outline-variant/10 p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-on-background">Cập nhật trạng thái</h2>
        <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="mt-4 grid gap-4 sm:grid-cols-[1fr_auto] items-end">
            @csrf
            @method('PUT')
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Trạng thái</span>
                <select name="status" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none">
                    <option value="pending" @selected(old('status', $order->status) === 'pending')>Chờ xử lý</option>
                    <option value="processing" @selected(old('status', $order->status) === 'processing')>Đang xử lý</option>
                    <option value="completed" @selected(old('status', $order->status) === 'completed')>Hoàn thành</option>
                        <option value="cancelled" @disabled($order->status === 'completed') @selected(old('status', $order->status) === 'cancelled')>Hủy</option>
                    <option value="refunded" @selected(old('status', $order->status) === 'refunded')>Hoàn tiền</option>
                </select>
                @error('status')
                    <p class="text-xs text-rose-600">{{ $message }}</p>
                @elseif($order->status === 'completed')
                    <p class="text-xs text-rose-600">Đơn hàng đã giao thành công không thể hủy.</p>
                @endif
            </label>
            <button type="submit" class="rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white hover:bg-primary-container">Cập nhật</button>
        </form>
    </section>

    <section class="rounded-3xl bg-white border border-outline-variant/10 p-6 shadow-sm">
<section class="rounded-3xl bg-white border border-outline-variant/10 p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-on-background">Sản phẩm trong đơn</h2>
        <div class="mt-4 space-y-4">
            @forelse($order->orderItems as $item)
                <div class="rounded-3xl border border-outline-variant/10 bg-surface-container p-4 text-sm">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            {{-- Sử dụng Nullsafe operator (?->) để truy cập an toàn --}}
                            <p class="font-semibold text-on-background">
                                {{ $item->variant?->product?->name ?? 'Sản phẩm đã bị xóa hoặc không tồn tại' }}
                            </p>
                            <p class="text-on-surface-variant">
                                SKU: {{ $item->variant?->sku ?? 'N/A' }} · 
                                Size: {{ $item->variant?->size ?? '-' }} · 
                                Màu: {{ $item->variant?->color ?? '-' }}
                            </p>
                        </div>
                        <p class="text-sm font-semibold text-primary">
                            {{ number_format($item->price ?? 0, 0, ',', '.') }}₫ x {{ $item->quantity }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-sm text-on-surface-variant">Không có sản phẩm nào trong đơn.</p>
            @endforelse
        </div>
    </section>
</div>
</x-admin-layout>