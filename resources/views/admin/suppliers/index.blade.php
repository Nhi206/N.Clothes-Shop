<x-admin-layout title="Quản lý nhà cung cấp">
@php
$breadcrumbs = [
    ['title' => 'Nhà cung cấp', 'url' => null]
];
$title = 'Quản lý nhà cung cấp';
$description = 'Danh sách nhà cung cấp và thông tin liên lạc.';
$actions = [
    ['type' => 'button', 'url' => route('admin.suppliers.create'), 'label' => 'Thêm nhà cung cấp', 'icon' => 'add']
];
@endphp

<div class="space-y-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-on-background">Quản lý nhà cung cấp</h1>
            <p class="text-sm text-on-surface-variant mt-1">Danh sách nhà cung cấp và thông tin liên lạc.</p>
        </div>
        <a href="{{ route('admin.suppliers.create') }}" class="inline-flex items-center justify-center rounded-3xl bg-primary px-5 py-3 text-sm font-semibold text-white hover:bg-primary-container transition">
            <span class="material-symbols-outlined mr-2">add</span>
            Thêm nhà cung cấp
        </a>
    </div>

    <div class="overflow-hidden rounded-3xl border border-outline-variant/10 bg-white shadow-sm">
        <table class="min-w-full text-left text-sm text-on-surface">
            <thead class="bg-surface-container-high text-on-surface-variant">
                <tr>
                    <th class="px-5 py-4 font-semibold uppercase">Tên</th>
                    <th class="px-5 py-4 font-semibold uppercase">Liên hệ</th>
                    <th class="px-5 py-4 font-semibold uppercase">Ngày tạo</th>
                    <th class="px-5 py-4 font-semibold uppercase">Hành động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/10">
                @forelse($suppliers as $supplier)
                    <tr>
                        <td class="px-5 py-4">{{ $supplier->name }}</td>
                        <td class="px-5 py-4">{{ $supplier->contact }}</td>
                        <td class="px-5 py-4">{{ $supplier->created_at->format('d/m/Y') }}</td>
                        <td class="px-5 py-4 space-x-2">
                            <a href="{{ route('admin.suppliers.edit', $supplier) }}" class="rounded-full bg-surface-container-high px-4 py-2 text-xs font-semibold text-primary hover:bg-surface-variant">Sửa</a>
                            <form action="{{ route('admin.suppliers.destroy', $supplier) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-full bg-error px-4 py-2 text-xs font-semibold text-white hover:bg-error-container" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-8 text-center text-outline-variant">Không có nhà cung cấp nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $suppliers->links() }}
</div>
</x-admin-layout>