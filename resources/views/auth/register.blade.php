<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100">
        <div class="w-full max-w-md bg-white rounded-lg shadow-2xl p-8 border border-blue-100">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="text-3xl font-bold text-blue-600 mb-2">
                    N.CLOTHES
                </div>
                <p class="text-gray-600">Tạo tài khoản mới</p>
            </div>

            <!-- General Error Message -->
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="font-semibold text-red-800">Có lỗi xảy ra</p>
                            <p class="text-sm text-red-700 mt-1">Vui lòng kiểm tra lại thông tin của bạn</p>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Full Name -->
                <div>
                    <x-input-label for="name" :value="__('Họ và tên')" class="text-gray-700 font-semibold" />
                    <div class="relative mt-2">
                        <x-text-input id="name" 
                                       class="block w-full px-4 py-2 border rounded-lg transition {{ $errors->has('name') ? 'border-red-500 bg-red-50 focus:ring-2 focus:ring-red-500 focus:border-red-400' : 'border-blue-200 bg-blue-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-400' }}" 
                                       type="text" 
                                       name="name" 
                                       :value="old('name')" 
                                       required 
                                       autofocus 
                                       autocomplete="name"
                                       placeholder="Nhập họ và tên của bạn" />
                        @if ($errors->has('name'))
                            <svg class="absolute right-3 top-3 w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M13.828 10.172a4 4 0 00-5.656 0l-4.243 4.242a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.658 0l4.242-4.243a4 4 0 00-5.656-5.656l-1.1 1.1" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </div>
                    @if ($errors->has('name'))
                        <div class="mt-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 17.586l-3.293-3.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8z" clip-rule="evenodd"/>
                            </svg>
                            <x-input-error :messages="$errors->get('name')" class="text-red-600" />
                        </div>
                    @endif
                </div>

                <!-- Email Address -->
                <div class="mt-5">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
                    <div class="relative mt-2">
                        <x-text-input id="email" 
                                       class="block w-full px-4 py-2 border rounded-lg transition {{ $errors->has('email') ? 'border-red-500 bg-red-50 focus:ring-2 focus:ring-red-500 focus:border-red-400' : 'border-blue-200 bg-blue-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-400' }}" 
                                       type="email" 
                                       name="email" 
                                       :value="old('email')" 
                                       required 
                                       autocomplete="username"
                                       placeholder="your@email.com" />
                        @if ($errors->has('email'))
                            <svg class="absolute right-3 top-3 w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M13.828 10.172a4 4 0 00-5.656 0l-4.243 4.242a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.658 0l4.242-4.243a4 4 0 00-5.656-5.656l-1.1 1.1" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </div>
                    @if ($errors->has('email'))
                        <div class="mt-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 17.586l-3.293-3.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8z" clip-rule="evenodd"/>
                            </svg>
                            <x-input-error :messages="$errors->get('email')" class="text-red-600" />
                        </div>
                    @endif
                </div>

                <!-- Phone Number -->
                <div class="mt-5">
                    <x-input-label for="phone" :value="__('Số điện thoại')" class="text-gray-700 font-semibold" />
                    <div class="relative mt-2">
                        <x-text-input id="phone" 
                                       class="block w-full px-4 py-2 border rounded-lg transition {{ $errors->has('phone') ? 'border-red-500 bg-red-50 focus:ring-2 focus:ring-red-500 focus:border-red-400' : 'border-blue-200 bg-blue-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-400' }}" 
                                       type="tel" 
                                       name="phone" 
                                       :value="old('phone')"
                                       placeholder="0912345678" />
                        @if ($errors->has('phone'))
                            <svg class="absolute right-3 top-3 w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M13.828 10.172a4 4 0 00-5.656 0l-4.243 4.242a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.658 0l4.242-4.243a4 4 0 00-5.656-5.656l-1.1 1.1" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </div>
                    @if ($errors->has('phone'))
                        <div class="mt-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 17.586l-3.293-3.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8z" clip-rule="evenodd"/>
                            </svg>
                            <x-input-error :messages="$errors->get('phone')" class="text-red-600" />
                        </div>
                    @endif
                </div>

                <!-- Password -->
                <div class="mt-5">
                    <x-input-label for="password" :value="__('Mật khẩu')" class="text-gray-700 font-semibold" />
                    <div class="relative mt-2">
                        <x-text-input id="password" 
                                       class="block w-full px-4 py-2 border rounded-lg transition {{ $errors->has('password') ? 'border-red-500 bg-red-50 focus:ring-2 focus:ring-red-500 focus:border-red-400' : 'border-blue-200 bg-blue-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-400' }}"
                                       type="password"
                                       name="password"
                                       required 
                                       autocomplete="new-password"
                                       placeholder="Nhập mật khẩu (tối thiểu 8 ký tự)" />
                        @if ($errors->has('password'))
                            <svg class="absolute right-3 top-3 w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M13.828 10.172a4 4 0 00-5.656 0l-4.243 4.242a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.658 0l4.242-4.243a4 4 0 00-5.656-5.656l-1.1 1.1" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </div>
                    @if ($errors->has('password'))
                        <div class="mt-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 17.586l-3.293-3.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8z" clip-rule="evenodd"/>
                            </svg>
                            <x-input-error :messages="$errors->get('password')" class="text-red-600" />
                        </div>
                    @endif
                    @if (!$errors->has('password'))
                        <p class="text-xs text-gray-500 mt-1">Mật khẩu phải có ít nhất 8 ký tự</p>
                    @endif
                </div>

                <!-- Confirm Password -->
                <div class="mt-5">
                    <x-input-label for="password_confirmation" :value="__('Xác nhận mật khẩu')" class="text-gray-700 font-semibold" />
                    <div class="relative mt-2">
                        <x-text-input id="password_confirmation" 
                                       class="block w-full px-4 py-2 border rounded-lg transition {{ $errors->has('password_confirmation') ? 'border-red-500 bg-red-50 focus:ring-2 focus:ring-red-500 focus:border-red-400' : 'border-blue-200 bg-blue-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-400' }}"
                                       type="password"
                                       name="password_confirmation" 
                                       required 
                                       autocomplete="new-password"
                                       placeholder="Xác nhận mật khẩu của bạn" />
                        @if ($errors->has('password_confirmation'))
                            <svg class="absolute right-3 top-3 w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M13.828 10.172a4 4 0 00-5.656 0l-4.243 4.242a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.658 0l4.242-4.243a4 4 0 00-5.656-5.656l-1.1 1.1" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <div class="mt-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 17.586l-3.293-3.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8z" clip-rule="evenodd"/>
                            </svg>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="text-red-600" />
                        </div>
                    @endif
                </div>

                <!-- Register Button -->
                <div class="mt-7">
                    <x-primary-button class="w-full py-2 px-4 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-semibold rounded-lg transition shadow-lg flex justify-center items-center">
                        {{ __('Đăng ký') }}
                    </x-primary-button>
                </div>

                <!-- Login Link -->
                <div class="mt-6 text-center text-gray-600">
                    Đã có tài khoản?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold transition">
                        Đăng nhập tại đây
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
