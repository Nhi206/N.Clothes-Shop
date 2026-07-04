<div>
    <h3 class="text-lg font-bold text-primary mb-2 flex items-center gap-2">
        <span class="material-symbols-outlined">person</span>
        Thông tin cá nhân
    </h3>
    <p class="text-outline text-sm mb-6">Cập nhật thông tin tài khoản và địa chỉ email của bạn.</p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-xs font-bold text-primary uppercase tracking-widest mb-2">Họ tên</label>
            <input id="name" name="name" type="text" class="bg-surface border-none text-sm px-3 py-2 rounded-lg focus:ring-1 focus:ring-primary-container w-full" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-xs font-bold text-primary uppercase tracking-widest mb-2">Email</label>
            <input id="email" name="email" type="email" class="bg-surface border-none text-sm px-3 py-2 rounded-lg focus:ring-1 focus:ring-primary-container w-full" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-warning/10 border border-warning/20 rounded-xl">
                    <p class="text-warning text-sm mb-2">Địa chỉ email của bạn chưa được xác minh.</p>
                    <button form="send-verification" class="text-primary hover:text-primary-container font-semibold text-sm underline">
                        Nhấp vào đây để gửi lại email xác minh.
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-tertiary text-sm mt-2 font-semibold">
                            Đã gửi liên kết xác minh mới đến địa chỉ email của bạn.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <label for="phone" class="block text-xs font-bold text-primary uppercase tracking-widest mb-2">Số điện thoại</label>
            <input id="phone" name="phone" type="text" class="bg-surface border-none text-sm px-3 py-2 rounded-lg focus:ring-1 focus:ring-primary-container w-full" value="{{ old('phone', $user->phone) }}" autocomplete="tel">
            @error('phone')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-primary text-white px-6 py-2 rounded-xl font-semibold hover:bg-primary-container transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">save</span>
                Lưu
            </button>

            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-tertiary text-sm font-semibold">
                    Đã lưu thành công.
                </div>
            @endif
        </div>
    </form>
</div>
