<x-admin-layout title="Quản lý kho">
@php
$breadcrumbs = [
    ['title' => 'Kho', 'url' => null]
];
$title = 'Quản lý kho';
$description = 'Theo dõi tồn kho, chi phí và nhà cung cấp.';
$actions = [
    ['type' => 'button', 'url' => route('admin.inventories.create'), 'label' => 'Thêm kho mới', 'icon' => 'add']
];
@endphp

<div class="space-y-6">
    

    <div class="overflow-hidden rounded-3xl border border-outline-variant/10 bg-white shadow-sm">
        <table class="min-w-full text-left text-sm text-on-surface">
            <thead class="bg-surface-container-high text-on-surface-variant">
                <tr>
                    <th class="px-5 py-4 font-semibold uppercase">Sản phẩm</th>
                    <th class="px-5 py-4 font-semibold uppercase">Tồn kho</th>
                    <th class="px-5 py-4 font-semibold uppercase">Nhà cung cấp</th>
                    <th class="px-5 py-4 font-semibold uppercase">Giá vốn</th>
                    <th class="px-5 py-4 font-semibold uppercase">Hành động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/10">
                @forelse($inventories as $inventory)
                    <tr>
                        <td class="px-5 py-4">{{ optional($inventory->product)->name ?? '-' }}</td>
                        <td class="px-5 py-4">{{ $inventory->quantity }}</td>
                        <td class="px-5 py-4">{{ optional($inventory->supplier)->name ?? '-' }}</td>
                        <td class="px-5 py-4">{{ $inventory->cost_price ? number_format($inventory->cost_price, 0, ',', '.') . ' VND' : '-' }}</td>
                        <td class="px-5 py-4 space-x-2">
                            <a href="{{ route('admin.inventories.edit', $inventory) }}" class="rounded-full bg-surface-container-high px-4 py-2 text-xs font-semibold text-primary hover:bg-surface-variant">Sửa</a>
                            <form action="{{ route('admin.inventories.destroy', $inventory) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-full bg-error px-4 py-2 text-xs font-semibold text-white hover:bg-error-container" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-outline-variant">Không có bản ghi kho nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $inventories->links() }}
</div>
</x-admin-layout>