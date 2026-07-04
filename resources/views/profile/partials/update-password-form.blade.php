<div>
    <h3 class="text-lg font-bold text-primary mb-2 flex items-center gap-2">
        <span class="material-symbols-outlined">lock</span>
        Đổi mật khẩu
    </h3>
    <p class="text-outline text-sm mb-6">Đảm bảo tài khoản của bạn sử dụng mật khẩu dài và ngẫu nhiên để bảo mật.</p>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-xs font-bold text-primary uppercase tracking-widest mb-2">Mật khẩu hiện tại</label>
            <input id="update_password_current_password" name="current_password" type="password" class="bg-surface border-none text-sm px-3 py-2 rounded-lg focus:ring-1 focus:ring-primary-container w-full" autocomplete="current-password">
            @error('current_password')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-xs font-bold text-primary uppercase tracking-widest mb-2">Mật khẩu mới</label>
            <input id="update_password_password" name="password" type="password" class="bg-surface border-none text-sm px-3 py-2 rounded-lg focus:ring-1 focus:ring-primary-container w-full" autocomplete="new-password">
            @error('password')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-bold text-primary uppercase tracking-widest mb-2">Xác nhận mật khẩu</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="bg-surface border-none text-sm px-3 py-2 rounded-lg focus:ring-1 focus:ring-primary-container w-full" autocomplete="new-password">
            @error('password_confirmation')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-primary text-white px-6 py-2 rounded-xl font-semibold hover:bg-primary-container transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">save</span>
                Lưu
            </button>

            @if (session('status') === 'password-updated')
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-tertiary text-sm font-semibold">
                    Đã cập nhật mật khẩu thành công.
                </div>
            @endif
        </div>
    </form>
</div>
