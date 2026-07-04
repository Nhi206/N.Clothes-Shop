<x-admin-layout title="{{ $user->exists ? 'Chỉnh sửa người dùng' : 'Tạo người dùng mới' }}">
@php
$breadcrumbs = [
['title' => 'Người dùng', 'url' => route('admin.users.index')],
['title' => $user->exists ? 'Chỉnh sửa' : 'Thêm mới', 'url' => null]
];
@endphp

<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-bold text-on-background">{{ $user->exists ? 'Chỉnh sửa người dùng' : 'Tạo người dùng mới' }}</h1>
        <p class="text-sm text-on-surface-variant mt-1">Quản lý tài khoản khách hàng, nhân viên và admin.</p>
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

    <form method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}" class="space-y-6 rounded-3xl bg-white border border-outline-variant/10 p-8 shadow-sm">
        @csrf
        @if($user->exists)
            @method('PUT')
        @endif

        <div class="grid gap-6 lg:grid-cols-2">
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Name</span>
                <input name="name" value="{{ old('name', $user->name) }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Email</span>
                <input name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Số điện thoại</span>
                <input name="phone" value="{{ old('phone', $user->phone) }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Vai trò</span>
                <select name="role" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none">
                    @foreach($roles as $role)
                        <option value="{{ $role }}" @selected(old('role', $user->role) === $role)>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </label>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Mật khẩu</span>
                <input name="password" type="password" autocomplete="new-password" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
                @if($user->exists)
                    <p class="text-xs text-on-surface-variant">Để trống nếu không muốn thay đổi mật khẩu.</p>
                @endif
            </label>
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Xác nhận mật khẩu</span>
                <input name="password_confirmation" type="password" autocomplete="new-password" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none" />
            </label>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <label class="space-y-2 text-sm font-medium text-on-surface">
                <span>Trạng thái</span>
                <select name="status" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm shadow-sm focus:border-primary focus:outline-none">
                    <option value="active" @selected(old('status', $user->status) === 'active')>Active</option>
                    <option value="inactive" @selected(old('status', $user->status) === 'inactive')>Inactive</option>
                </select>
            </label>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-end">
            <a href="{{ route('admin.users.index') }}" class="rounded-full border border-outline-variant/70 px-6 py-3 text-sm font-semibold text-on-surface-variant hover:bg-surface-container">Hủy</a>
            <button type="submit" class="rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white hover:bg-primary-container">{{ $user->exists ? 'Cập nhật' : 'Tạo mới' }}</button>
        </div>
    </form>
</div>
</x-admin-layout>
