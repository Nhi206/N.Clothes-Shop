<x-client-layout title="Thanh toán">
    <div class="max-w-[1440px] mx-auto px-8 py-12">
        <div class="space-y-8 mb-8">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-4xl">shopping_cart_checkout</span>
                <h1 class="text-3xl font-bold text-primary">Thanh toán</h1>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-8">
            <!-- Form Đặt Hàng -->
            <div class="col-span-12 lg:col-span-8">
                <div class="bg-surface rounded-3xl p-6 shadow-sm">
                    <h4 class="text-xl font-bold text-primary mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined">local_shipping</span>
                        Thông tin giao hàng
                    </h4>

                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        @foreach($selectedItemIds as $selectedItemId)
                            <input type="hidden" name="selected_items[]" value="{{ $selectedItemId }}">
                        @endforeach

                        <!-- Nhập địa chỉ mới -->
                        <div class="mb-6">
                            <label class="block text-xs font-bold text-primary uppercase tracking-widest mb-4">NHẬP ĐỊA CHỈ GIAO HÀNG MỚI</label>
                            <div class="space-y-3">
                                <div class="border border-outline-variant/20 rounded-3xl p-4">
                                    <label class="block text-sm font-medium text-on-surface mb-2">Địa chỉ chi tiết</label>
                                    <textarea name="address_detail" rows="4" required class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm text-primary outline-none focus:border-primary focus:ring-1 focus:ring-primary/20">{{ old('address_detail') }}</textarea>
                                    @error('address_detail')
                                        <p class="mt-2 text-sm text-error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="border border-outline-variant/20 rounded-3xl p-4">
                                    <label class="block text-sm font-medium text-on-surface mb-2">Số điện thoại người nhận</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm text-primary outline-none focus:border-primary focus:ring-1 focus:ring-primary/20" placeholder="Ví dụ: +84901234567">
                                    @error('phone')
                                        <p class="mt-2 text-sm text-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Phương thức thanh toán -->
                        <div class="mb-8">
                            <label class="block text-xs font-bold text-primary uppercase tracking-widest mb-4">PHƯƠNG THỨC THANH TOÁN</label>
                            <div class="space-y-3">
                                <div class="border border-outline-variant/20 rounded-3xl p-4">
                                    <div class="flex items-center gap-3">
                                        <input class="w-4 h-4 text-primary border-outline focus:ring-primary" type="radio" name="payment_method" value="cash" id="cash" required {{ old('payment_method', 'cash') === 'cash' ? 'checked' : '' }}>
                                        <label class="flex items-center gap-3 cursor-pointer flex-1" for="cash">
                                            <span class="material-symbols-outlined text-tertiary">payments</span>
                                            <div>
                                                <div class="font-semibold text-primary">Thanh toán khi nhận hàng (COD)</div>
                                                <div class="text-outline text-sm">Thanh toán bằng tiền mặt khi nhận hàng</div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="border border-outline-variant/20 rounded-3xl p-4">
                                    <div class="flex items-center gap-3">
                                        <input class="w-4 h-4 text-primary border-outline focus:ring-primary" type="radio" name="payment_method" value="card" id="card" {{ old('payment_method') === 'card' ? 'checked' : '' }}>
                                        <label class="flex items-center gap-3 flex-1 cursor-pointer" for="card">
                                            <span class="material-symbols-outlined text-primary">credit_card</span>
                                            <div>
                                                <div class="font-semibold text-primary">Thẻ tín dụng / Ghi nợ</div>
                                                <div class="text-outline text-sm">Thanh toán trực tuyến an toàn qua cổng thẻ</div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="border border-outline-variant/20 rounded-3xl p-4">
                                    <div class="flex items-center gap-3">
                                        <input class="w-4 h-4 text-primary border-outline focus:ring-primary" type="radio" name="payment_method" value="bank_transfer" id="bank_transfer" {{ old('payment_method') === 'bank_transfer' ? 'checked' : '' }}>
                                        <label class="flex items-center gap-3 flex-1 cursor-pointer" for="bank_transfer">
                                            <span class="material-symbols-outlined text-primary">account_balance</span>
                                            <div>
                                                <div class="font-semibold text-primary">Chuyển khoản ngân hàng</div>
                                                <div class="text-outline text-sm">Thanh toán trực tuyến qua Internet Banking / Mobile Banking</div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div id="card-details" class="rounded-3xl border border-outline-variant/20 bg-surface p-4 mt-4 hidden">
                                    <div class="grid gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-on-surface mb-2">Số thẻ</label>
                                            <input type="text" name="card_number" value="{{ old('card_number') }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm text-primary outline-none focus:border-primary focus:ring-1 focus:ring-primary/20" placeholder="1234 5678 9012 3456">
                                            @error('card_number')<p class="mt-2 text-sm text-error">{{ $message }}</p>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-on-surface mb-2">Tên chủ thẻ</label>
                                            <input type="text" name="card_holder" value="{{ old('card_holder') }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm text-primary outline-none focus:border-primary focus:ring-1 focus:ring-primary/20" placeholder="Nguyen Van A">
                                            @error('card_holder')<p class="mt-2 text-sm text-error">{{ $message }}</p>@enderror
                                        </div>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-on-surface mb-2">Tháng hết hạn</label>
                                                <input type="text" name="expiry_month" value="{{ old('expiry_month') }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm text-primary outline-none focus:border-primary focus:ring-1 focus:ring-primary/20" placeholder="MM">
                                                @error('expiry_month')<p class="mt-2 text-sm text-error">{{ $message }}</p>@enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-on-surface mb-2">Năm hết hạn</label>
                                                <input type="text" name="expiry_year" value="{{ old('expiry_year') }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm text-primary outline-none focus:border-primary focus:ring-1 focus:ring-primary/20" placeholder="YY">
                                                @error('expiry_year')<p class="mt-2 text-sm text-error">{{ $message }}</p>@enderror
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-on-surface mb-2">CVV</label>
                                            <input type="text" name="cvv" value="{{ old('cvv') }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm text-primary outline-none focus:border-primary focus:ring-1 focus:ring-primary/20" placeholder="123">
                                            @error('cvv')<p class="mt-2 text-sm text-error">{{ $message }}</p>@enderror
                                        </div>
                                    </div>
                                </div>

                                <div id="bank-transfer-details" class="rounded-3xl border border-outline-variant/20 bg-surface p-4 mt-4 hidden">
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-on-surface mb-2">Ngân hàng</label>
                                            <select name="bank_provider" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm text-primary outline-none focus:border-primary focus:ring-1 focus:ring-primary/20">
                                                <option value="">Chọn ngân hàng</option>
                                                <option value="Vietcombank" @selected(old('bank_provider') === 'Vietcombank')>Vietcombank</option>
                                                <option value="VietinBank" @selected(old('bank_provider') === 'VietinBank')>VietinBank</option>
                                                <option value="BIDV" @selected(old('bank_provider') === 'BIDV')>BIDV</option>
                                                <option value="Sacombank" @selected(old('bank_provider') === 'Sacombank')>Sacombank</option>
                                                <option value="Techcombank" @selected(old('bank_provider') === 'Techcombank')>Techcombank</option>
                                                <option value="TPBank" @selected(old('bank_provider') === 'TPBank')>TPBank</option>
                                                <option value="ACB" @selected(old('bank_provider') === 'ACB')>ACB</option>
                                                <option value="MB" @selected(old('bank_provider') === 'MB')>MB</option>
                                                <option value="VPBank" @selected(old('bank_provider') === 'VPBank')>VPBank</option>
                                                <option value="Agribank" @selected(old('bank_provider') === 'Agribank')>Agribank</option>
                                            </select>
                                            @error('bank_provider')<p class="mt-2 text-sm text-error">{{ $message }}</p>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-on-surface mb-2">Tên chủ tài khoản</label>
                                            <input type="text" name="bank_account_name" value="{{ old('bank_account_name') }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm text-primary outline-none focus:border-primary focus:ring-1 focus:ring-primary/20" placeholder="Nguyen Van A">
                                            @error('bank_account_name')<p class="mt-2 text-sm text-error">{{ $message }}</p>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-on-surface mb-2">Số tài khoản</label>
                                            <input type="text" name="bank_account_number" value="{{ old('bank_account_number') }}" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm text-primary outline-none focus:border-primary focus:ring-1 focus:ring-primary/20" placeholder="0123456789">
                                            @error('bank_account_number')<p class="mt-2 text-sm text-error">{{ $message }}</p>@enderror
                                        </div>
                                        <div class="rounded-3xl border border-outline-variant/20 bg-surface-container p-4 text-sm text-primary">
                                            <p class="font-semibold mb-3">Thông tin chuyển khoản</p>
                                            <div class="space-y-2">
                                                <div class="flex items-start justify-between gap-3 rounded-2xl bg-white/70 px-3 py-2">
                                                    <span class="text-outline">Ngân hàng</span>
                                                    <span class="font-semibold text-primary">Vietcombank</span>
                                                </div>
                                                <div class="flex items-start justify-between gap-3 rounded-2xl bg-white/70 px-3 py-2">
                                                    <span class="text-outline">Số tài khoản</span>
                                                    <span class="font-semibold text-primary">0123456789</span>
                                                </div>
                                                <div class="flex items-start justify-between gap-3 rounded-2xl bg-white/70 px-3 py-2">
                                                    <span class="text-outline">Chủ tài khoản</span>
                                                    <span class="font-semibold text-primary">CTY TNHH ABC</span>
                                                </div>
                                                <div class="flex items-start justify-between gap-3 rounded-2xl bg-white/70 px-3 py-2">
                                                    <span class="text-outline">Nội dung</span>
                                                    <span class="font-semibold text-primary">DH{{ now()->format('Ymd') }}_{{ Auth::id() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="otp-section" class="rounded-3xl border border-outline-variant/20 bg-surface p-4 mt-4 hidden">
                                    <div class="flex items-center gap-3 mb-3">
                                        <span class="material-symbols-outlined text-primary">vpn_key</span>
                                        <div>
                                            <div class="font-semibold text-primary">Xác minh thanh toán bằng OTP</div>
                                            <div class="text-sm text-outline">Mã gồm 6 chữ số sẽ được dùng để xác nhận giao dịch trực tuyến.</div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-3 sm:flex-row">
                                        <input type="text" name="otp_code" id="otp_code" value="{{ old('otp_code') }}" inputmode="numeric" pattern="[0-9]*" maxlength="6" class="w-full rounded-3xl border border-outline-variant/70 bg-surface-container p-3 text-sm text-primary outline-none focus:border-primary focus:ring-1 focus:ring-primary/20" placeholder="Nhập mã OTP 6 chữ số">
                                        <button type="button" id="resend-otp" class="rounded-3xl border border-primary/20 px-4 py-3 text-sm font-semibold text-primary hover:bg-primary/5 transition-colors">Gửi lại mã</button>
                                    </div>
                                    <p class="mt-3 text-sm text-outline">Mã OTP demo hiện tại: <span id="display-otp" class="font-semibold text-primary">{{ $otpCode }}</span></p>
                                    @error('otp_code')<p class="mt-2 text-sm text-error">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>

                        <!-- Mã khuyến mãi -->
                        <div class="mb-8">
                            <label class="block text-xs font-bold text-primary uppercase tracking-widest mb-4">CHỌN MÃ KHUYẾN MÃI</label>
                            <div class="rounded-3xl border border-outline-variant/20 bg-surface p-4">
                                <select name="promo_code" class="w-full rounded-3xl border border-outline-variant/70 bg-white px-4 py-3 text-sm text-primary outline-none focus:border-primary focus:ring-1 focus:ring-primary/20">
                                    <option value="">Không chọn mã</option>
                                    @foreach($promotions as $promotion)
                                        <option value="{{ $promotion->code }}" @selected(old('promo_code') === $promotion->code)>
                                            {{ $promotion->code }} - {{ $promotion->discount_type === 'percent' ? $promotion->discount_value . '%' : 'Giảm ' . number_format($promotion->discount_value, 0, ',', '.') . 'đ' }}                                        @if($promotion->min_order_amount)
                                            (đơn hàng từ {{ number_format($promotion->min_order_amount, 0, ',', '.') }}đ trở lên)
                                        @endif                                        </option>
                                    @endforeach
                                </select>
                                <p id="promoConditionText" class="mt-3 text-sm text-outline-variant">Chọn mã khuyến mãi để xem điều kiện.</p>
                                @error('promo_code')
                                    <p class="mt-2 text-sm text-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Nút hành động -->
                        <div class="flex gap-4">
                            <a href="{{ route('cart.index') }}" class="bg-outline/10 text-outline px-6 py-3 rounded-2xl font-semibold hover:bg-outline/20 transition-colors flex items-center gap-2">
                                <span class="material-symbols-outlined text-lg">arrow_back</span>
                                Quay lại
                            </a>
                            <button type="submit" class="flex-1 bg-primary text-white py-3 rounded-2xl font-bold hover:bg-primary-container transition-all flex items-center justify-center gap-2 shadow-lg shadow-primary/20">
                                <span class="material-symbols-outlined">check_circle</span>
                                Xác nhận đặt hàng
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tóm tắt đơn hàng -->
            <div class="col-span-12 lg:col-span-4">
                <div class="bg-surface rounded-3xl p-6 shadow-sm sticky top-24 border border-outline-variant/10">
                    <h5 class="text-lg font-bold text-primary mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined">receipt</span>
                        Tóm tắt đơn hàng
                    </h5>

                    <!-- Danh sách sản phẩm trong giỏ -->
                    <div class="space-y-4 mb-6">
                        @foreach($cart->items as $item)
                            @php
                                $product = $item->product;
                                $firstImage = $product ? optional($product->images)->first() : null;
                                // Xử lý đường dẫn ảnh sạch
                                $path = $firstImage ? ltrim(str_replace('public/', '', $firstImage->image_url), '/') : null;
                                $imageUrl = $path ? asset($path) : asset('images/no-image.jpg');
                            @endphp
                            <div class="flex gap-4">
                                <div class="w-16 h-16 flex-shrink-0">
                                    <img src="{{ $imageUrl }}"
                                         class="w-full h-full rounded-2xl object-cover border border-outline-variant/10" 
                                         alt="{{ $product->name ?? 'Sản phẩm' }}">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h6 class="text-sm font-bold text-primary truncate mb-1">
                                        {{ $product->name ?? 'Sản phẩm không khả dụng' }}
                                    </h6>
                                    <div class="flex justify-between items-center">
                                        <span class="text-outline text-xs font-medium">SL: {{ $item->quantity }}</span>
                                        <span class="text-primary text-sm font-bold">
                                            {{ number_format($item->subtotal, 0, ',', '.') }}đ
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <hr class="border-outline-variant/20 mb-4">

                    <!-- Tổng cộng -->
                    <div class="space-y-2 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-outline">Tạm tính:</span>
                            <span class="font-semibold">{{ number_format($cart->items->sum(fn($i) => $i->subtotal), 0, ',', '.') }}đ</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-outline">Khuyến mãi:</span>
                            <span id="checkout-discount" class="font-semibold text-error">0đ</span>
                        </div>
                        <div class="flex justify-between text-sm text-tertiary">
                            <span>Vận chuyển:</span>
                            <span class="font-semibold text-tertiary">Miễn phí</span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="font-bold text-primary">Tổng tiền:</span>
                            <span id="checkout-total" class="text-2xl font-black text-primary">
                                {{ number_format($cart->items->sum(fn($i) => $i->subtotal), 0, ',', '.') }}đ
                            </span>
                        </div>
                    </div>

                    <!-- Tiện ích giao hàng -->
                    <div class="bg-tertiary/5 rounded-2xl p-4 mb-4 border border-tertiary/10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-tertiary/10 flex items-center justify-center text-tertiary">
                                <span class="material-symbols-outlined">local_shipping</span>
                            </div>
                            <div>
                                <div class="text-tertiary text-sm font-bold">Miễn phí vận chuyển</div>
                                <div class="text-outline text-xs">Giao nhanh từ 2 - 4 ngày làm việc</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-center gap-2 text-outline text-[11px] uppercase tracking-wider">
                        <span class="material-symbols-outlined text-sm">security</span>
                        Bảo mật thanh toán 256-bit SSL
                    </div>
                </div>
            </div>
        </div>
    </div>

@php
    $checkoutPromotions = $promotions->map(function ($promotion) {
        return [
            'code' => $promotion->code,
            'type' => $promotion->discount_type,
            'value' => (float) $promotion->discount_value,
            'min_order_amount' => $promotion->min_order_amount ? (float) $promotion->min_order_amount : null,
        ];
    })->all();
@endphp

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const promoSelect = document.querySelector('select[name="promo_code"]');
            const discountEl = document.getElementById('checkout-discount');
            const totalEl = document.getElementById('checkout-total');
            const subtotal = Number({{ $cart->items->sum(fn($i) => $i->subtotal) }});
            const promotions = @json($checkoutPromotions);

            const formatVnd = (value) => new Intl.NumberFormat('vi-VN').format(value) + 'đ';

            const promoConditionText = document.getElementById('promoConditionText');
            const cardDetails = document.getElementById('card-details');
            const bankDetails = document.getElementById('bank-transfer-details');
            const otpSection = document.getElementById('otp-section');
            const otpInput = document.getElementById('otp_code');
            const resendOtpButton = document.getElementById('resend-otp');
            const paymentRadios = document.querySelectorAll('input[name="payment_method"]');

            const updatePaymentDetails = () => {
                const selectedPayment = document.querySelector('input[name="payment_method"]:checked')?.value;
                const isOnlinePayment = selectedPayment === 'card' || selectedPayment === 'bank_transfer';

                cardDetails.classList.toggle('hidden', selectedPayment !== 'card');
                bankDetails.classList.toggle('hidden', selectedPayment !== 'bank_transfer');
                otpSection.classList.toggle('hidden', !isOnlinePayment);
                otpInput.disabled = !isOnlinePayment;
                otpInput.required = isOnlinePayment;

                if (!isOnlinePayment) {
                    otpInput.value = '';
                }
            };

            paymentRadios.forEach(radio => radio.addEventListener('change', updatePaymentDetails));
            resendOtpButton?.addEventListener('click', () => {
                window.location.href = `${window.location.pathname}?resend_otp=1`;
            });
            updatePaymentDetails();

            const updateSummary = (selectedCode) => {
                const promotion = promotions.find((promo) => promo.code === selectedCode);

                if (!promotion) {
                    discountEl.textContent = formatVnd(0);
                    totalEl.textContent = formatVnd(subtotal);
                    promoConditionText.textContent = 'Chọn mã khuyến mãi để xem điều kiện.';
                    return;
                }

                let discount = 0;
                if (promotion.type === 'percent') {
                    discount = Math.round(subtotal * (promotion.value / 100));
                } else {
                    discount = Math.min(promotion.value, subtotal);
                }

                discountEl.textContent = formatVnd(discount);
                totalEl.textContent = formatVnd(Math.max(subtotal - discount, 0));
                promoConditionText.textContent = promotion.min_order_amount
                    ? `Áp dụng cho đơn hàng từ ${formatVnd(promotion.min_order_amount)} trở lên.`
                    : 'Mã này không yêu cầu điều kiện đơn hàng.';
            };

            promoSelect.addEventListener('change', (event) => updateSummary(event.target.value));
            updateSummary(promoSelect.value);
        });
    </script>
</x-client-layout>