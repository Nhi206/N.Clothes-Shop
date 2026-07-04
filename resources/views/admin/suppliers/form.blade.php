<x-admin-layout title="{{ $supplier->exists ? 'Chỉnh sửa nhà cung cấp' : 'Thêm nhà cung cấp mới' }}">
@php
$breadcrumbs = [
['title' => 'Nhà cung cấp', 'url' => route('admin.suppliers.index')],
['title' => $supplier->exists ? 'Chỉnh sửa' : 'Thêm mới', 'url' => null]
];
@endphp

<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-bold text-on-background">{{ $supplier->exists ? 'Chỉnh sửa nhà cung cấp' : 'Thêm nhà cung cấp mới' }}</h1>
        <p class="text-sm text-on-surface-variant mt-1">Quản lý thông tin đối tác cung cấp.</p>
    </div>

    @if($errors->any())
        <div class="rounded-3xl bg-rose-50 border border-rose-200 p-4 text-sm text-rose-900">
            <ul class="list-disc space-y-2 pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ $supplier->exists ? route('admin.suppliers.update', $supplier) : route('admin.suppliers.store') }}" class="space-y-6 rounded-3xl bg-white border border-outline-variant/10 p-8 shadow-sm">
        @csrf
        @if($supplier->exists)
            @method('PUT')
        @endif

        <div class="grid gap-6 lg:grid-cols-2">
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Tên nhà cung cấp</span>
                <input name="name" value="{{ old('name', $supplier->name) }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Thông tin liên hệ</span>
                <input name="contact" value="{{ old('contact', $supplier->contact) }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.suppliers.index') }}" class="rounded-3xl bg-surface-container px-6 py-3 text-sm font-semibold text-on-surface hover:bg-surface-variant transition-colors">Hủy</a>
            <button type="submit" class="rounded-3xl bg-primary px-6 py-3 text-sm font-semibold text-white hover:bg-primary-container transition-colors">Lưu</button>
        </div>
    </form>
</div>
</x-admin-layout>