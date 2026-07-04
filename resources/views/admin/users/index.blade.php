<x-admin-layout title="Quản lý người dùng">
@php
$breadcrumbs = [
['title' => 'Người dùng', 'url' => null]
];
@endphp

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-on-background">Quản lý người dùng</h1>
            <p class="text-sm text-on-surface-variant mt-1">Tạo, chỉnh sửa, khóa và xóa tài khoản người dùng.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white shadow-sm shadow-primary/20 hover:bg-primary-container">Thêm tài khoản</a>
    </div>

    <form method="GET" action="{{ route('admin.users.index') }}" class="grid gap-3 sm:grid-cols-3">
        <input name="search" value="{{ request('search') }}" class="rounded-3xl border border-outline-variant/70 bg-white px-4 py-3 text-sm shadow-sm focus:border-primary focus:outline-none" placeholder="Tìm kiếm tên hoặc email" />
        <select name="role" class="rounded-3xl border border-outline-variant/70 bg-white px-4 py-3 text-sm shadow-sm focus:border-primary focus:outline-none">
            <option value="">Tất cả vai trò</option>
            @foreach($roles as $role)
                <option value="{{ $role }}" @selected(request('role') === $role)>{{ ucfirst($role) }}</option>
            @endforeach
        </select>
        <button type="submit" class="rounded-3xl bg-secondary px-5 py-3 text-sm font-semibold text-white hover:bg-secondary-container transition-colors">Lọc</button>
    </form>

    <div class="overflow-hidden rounded-3xl border border-outline-variant/10 bg-white shadow-sm">
        <table class="min-w-full text-left text-sm text-on-surface">
            <thead class="bg-surface-container-high text-on-surface-variant">
                <tr>
                    <th class="px-5 py-4 font-semibold uppercase">Tên</th>
                    <th class="px-5 py-4 font-semibold uppercase">Email</th>
                    <th class="px-5 py-4 font-semibold uppercase">Vai trò</th>
                    <th class="px-5 py-4 font-semibold uppercase">Trạng thái</th>
                    <th class="px-5 py-4 font-semibold uppercase">Ngày tạo</th>
                    <th class="px-5 py-4 font-semibold uppercase">Hành động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/10">
                @forelse($users as $user)
                    <tr>
                        <td class="px-5 py-4">{{ $user->name }}</td>
                        <td class="px-5 py-4">{{ $user->email }}</td>
                        <td class="px-5 py-4 capitalize">{{ $user->role }}</td>
                        <td class="px-5 py-4">
                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $user->status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">{{ $user->status ?? 'inactive' }}</span>
                        </td>
                        <td class="px-5 py-4">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="px-5 py-4 space-x-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="rounded-full bg-surface-container-high px-4 py-2 text-xs font-semibold text-primary hover:bg-surface-variant">Sửa</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Xóa tài khoản này?')" class="rounded-full bg-rose-50 px-4 py-2 text-xs font-semibold text-rose-700 hover:bg-rose-100">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-on-surface-variant">Không tìm thấy người dùng nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $users->links() }}</div>
</div>
</x-admin-layout>
