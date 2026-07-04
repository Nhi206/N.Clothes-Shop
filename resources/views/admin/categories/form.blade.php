<x-admin-layout title="{{ $category->exists ? 'Chỉnh sửa danh mục' : 'Thêm danh mục mới' }}">
@php
$breadcrumbs = [
['title' => 'Danh mục', 'url' => route('admin.categories.index')],
['title' => $category->exists ? 'Chỉnh sửa' : 'Thêm mới', 'url' => null]
];
@endphp

<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-bold text-on-background">{{ $category->exists ? 'Chỉnh sửa danh mục' : 'Thêm danh mục mới' }}</h1>
        <p class="text-sm text-on-surface-variant mt-1">Quản lý tên danh mục sản phẩm.</p>
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

    <form method="POST" action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}" class="space-y-6 rounded-3xl bg-white border border-outline-variant/10 p-8 shadow-sm">
        @csrf
        @if($category->exists)
            @method('PUT')
        @endif

        <label class="space-y-2 text-sm font-medium text-on-surface">
            <span>Tên danh mục</span>
            <input name="name" value="{{ old('name', $category->name) }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
        </label>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-end">
            <a href="{{ route('admin.categories.index') }}" class="rounded-full border border-outline-variant/70 px-6 py-3 text-sm font-semibold text-on-surface-variant hover:bg-surface-container">Hủy</a>
            <button type="submit" class="rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white hover:bg-primary-container">{{ $category->exists ? 'Cập nhật' : 'Lưu' }}</button>
        </div>
    </form>
</div>
</x-admin-layout>
