<x-client-layout title="Cài đặt tài khoản">
<div class="max-w-[1440px] mx-auto px-8 py-12">
    <div class="space-y-8">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-4xl">settings</span>
            <h1 class="text-3xl font-bold text-primary">Cài đặt tài khoản</h1>
        </div>
        <p class="text-outline">Quản lý cài đặt liên hệ và thông báo của bạn.</p>
    </div>

    <div class="grid grid-cols-12 gap-8 mt-8">
        <div class="col-span-12 lg:col-span-8">
            <div class="space-y-6">
                <div class="bg-surface rounded-3xl p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-primary">person</span>
                        <h2 class="text-xl font-bold text-primary">Thông tin liên hệ</h2>
                    </div>

                    <form method="post" action="{{ route('settings.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

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
                                Lưu cài đặt
                            </button>

                            @if (session('status') === 'settings-updated')
                                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-tertiary text-sm font-semibold">
                                    Cài đặt đã được cập nhật.
                                </div>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="bg-surface rounded-3xl p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-primary">notifications</span>
                        <h2 class="text-xl font-bold text-primary">Thông báo</h2>
                    </div>

                    <p class="text-outline text-sm mb-4">Cài đặt thông báo sẽ giúp bạn nhận được tin nhắn mới nhất từ hệ thống.</p>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between gap-4 rounded-3xl border border-surface-container p-4">
                            <div>
                                <h3 class="font-semibold text-on-surface">Nhận email thông báo</h3>
                                <p class="text-sm text-outline">Nhận thông báo về đơn hàng và khuyến mãi qua email.</p>
                            </div>
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="rounded border-surface-container text-primary focus:ring-primary" checked disabled>
                                <span class="text-sm text-outline">Đã bật</span>
                            </label>
                        </div>
                        <div class="flex items-center justify-between gap-4 rounded-3xl border border-surface-container p-4">
                            <div>
                                <h3 class="font-semibold text-on-surface">Báo động mua sắm</h3>
                                <p class="text-sm text-outline">Nhận thông báo khi có sản phẩm mới hoặc ưu đãi.</p>
                            </div>
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="rounded border-surface-container text-primary focus:ring-primary" disabled>
                                <span class="text-sm text-outline">Tắt</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-4">
            <div class="bg-surface rounded-3xl p-6 shadow-sm">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-primary">info</span>
                    <h2 class="text-xl font-bold text-primary">Tóm tắt tài khoản</h2>
                </div>

                <div class="space-y-4 text-sm text-outline">
                    <div>
                        <p class="font-semibold text-on-surface">Họ tên</p>
                        <p>{{ $user->name }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-on-surface">Email</p>
                        <p>{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-on-surface">Số điện thoại</p>
                        <p>{{ $user->phone ?? 'Chưa có' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-client-layout>
