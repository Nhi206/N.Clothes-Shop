<x-admin-layout title="Quản lý khuyến mãi">
@php
$breadcrumbs = [
    ['title' => 'Khuyến mãi', 'url' => null]
];
$title = 'Quản lý khuyến mãi';
$description = 'Danh sách khuyến mãi và mã giảm giá.';
$actions = [
    ['type' => 'button', 'url' => route('admin.promotions.create'), 'label' => 'Thêm khuyến mãi', 'icon' => 'add']
];
@endphp

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-on-background">Quản lý khuyến mãi</h1>
            <p class="text-sm text-on-surface-variant mt-1">Danh sách khuyến mãi và mã giảm giá.</p>
        </div>
        <a href="{{ route('admin.promotions.create') }}" class="inline-flex items-center justify-center rounded-3xl bg-primary px-5 py-3 text-sm font-semibold text-white hover:bg-primary-container transition">
            <span class="material-symbols-outlined mr-2">add</span>
            Tạo mã khuyến mãi
        </a>
    </div>

    <form method="GET" action="{{ route('admin.promotions.index') }}" class="grid gap-3 sm:grid-cols-2">
        <input name="search" value="{{ request('search') }}" class="rounded-3xl border border-outline-variant/70 bg-white px-4 py-3 text-sm shadow-sm focus:border-primary focus:outline-none" placeholder="Tìm kiếm khuyến mãi" />
        <button type="submit" class="rounded-3xl bg-secondary px-5 py-3 text-sm font-semibold text-white hover:bg-secondary-container transition-colors">Tìm</button>
    </form>

    <div class="overflow-hidden rounded-3xl border border-outline-variant/10 bg-white shadow-sm">
        <table class="min-w-full text-left text-sm text-on-surface">
            <thead class="bg-surface-container-high text-on-surface-variant">
                <tr>
                    <th class="px-5 py-4 font-semibold uppercase">Mã</th>
                    <th class="px-5 py-4 font-semibold uppercase">Loại giảm</th>
                    <th class="px-5 py-4 font-semibold uppercase">Giá trị</th>
                    <th class="px-5 py-4 font-semibold uppercase">Điều kiện</th>
                    <th class="px-5 py-4 font-semibold uppercase">Ngày bắt đầu</th>
                    <th class="px-5 py-4 font-semibold uppercase">Ngày kết thúc</th>
                    <th class="px-5 py-4 font-semibold uppercase">Hành động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/10">
                @forelse($promotions as $promotion)
                    <tr>
                        <td class="px-5 py-4">{{ $promotion->code }}</td>
                        <td class="px-5 py-4">{{ $promotion->discount_type == 'percent' ? 'Phần trăm' : 'Cố định' }}</td>
                        <td class="px-5 py-4">{{ $promotion->discount_value_formatted }}{{ $promotion->discount_type == 'percent' ? '%' : ' VND' }}</td>
                        <td class="px-5 py-4">{{ $promotion->min_order_amount ? number_format($promotion->min_order_amount, 0, ',', '.') . 'đ' : 'Không yêu cầu' }}</td>
                        <td class="px-5 py-4">{{ $promotion->start_date->format('d/m/Y') }}</td>
                        <td class="px-5 py-4">{{ $promotion->end_date->format('d/m/Y') }}</td>
                        <td class="px-5 py-4 space-x-2">
                            <a href="{{ route('admin.promotions.edit', $promotion) }}" class="rounded-full bg-surface-container-high px-4 py-2 text-xs font-semibold text-primary hover:bg-surface-variant">Sửa</a>
                            <form action="{{ route('admin.promotions.destroy', $promotion) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-full bg-error px-4 py-2 text-xs font-semibold text-white hover:bg-error-container" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-outline-variant">Không có khuyến mãi nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $promotions->links() }}</div>
</div>
</x-admin-layout>