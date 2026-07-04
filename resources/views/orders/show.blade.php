<x-client-layout title="Chi tiết đơn hàng #{{ $order->id }}">
<div class="max-w-[1440px] mx-auto px-8 py-12">
<div class="space-y-8">
    <div class="flex items-center gap-2">
        <span class="material-symbols-outlined text-primary text-4xl">receipt_long</span>
        <h1 class="text-3xl font-bold text-primary">Chi tiết đơn hàng #{{ $order->id }}</h1>
    </div>
</div>

<div class="grid grid-cols-12 gap-8">
    <div class="col-span-12 lg:col-span-8">
        <div class="bg-surface rounded-3xl p-6 shadow-sm">
            <h3 class="text-xl font-bold text-primary mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined">shopping_bag</span>
                Sản phẩm
            </h3>
            <div class="space-y-4">
                @foreach($order->orderItems as $item)
                    @php
                        $product = $item->product;
                        $productImage = optional(optional($product)->images)->first();
                    @endphp
                    <div class="flex gap-4 p-4 border border-outline-variant/20 rounded-3xl">
                        <img src="{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.jpg') }}"
                             class="w-20 h-20 rounded-xl object-cover"
                             alt="{{ $product->name ?? 'Sản phẩm không xác định' }}">
                        <div class="flex-1">
                            <h5 class="font-semibold text-primary mb-2">{{ $product->name ?? 'Sản phẩm không xác định' }}</h5>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-outline">Số lượng:</span>
                                    <span class="font-semibold text-primary ml-2">{{ $item->quantity }}</span>
                                </div>
                                <div>
                                    <span class="text-outline">Giá:</span>
                                    <span class="font-semibold text-primary ml-2">{{ number_format($item->price, 0, ',', '.') }} VND</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-span-12 lg:col-span-4">
        <div class="bg-surface rounded-3xl p-6 shadow-sm">
            <h3 class="text-xl font-bold text-primary mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined">info</span>
                Thông tin đơn hàng
            </h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-outline">Ngày đặt:</span>
                    <span class="font-semibold text-primary">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-outline">Trạng thái:</span>
                    <span class="px-3 py-1 bg-primary/10 text-primary text-xs rounded-full">{{ $order->status }}</span>
                </div>
                @if($order->promotion)
                    <div class="flex justify-between items-center">
                        <span class="text-outline">Mã khuyến mãi:</span>
                        <span class="font-semibold text-primary">{{ $order->promotion->code }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-outline">Tiết kiệm:</span>
                        <span class="font-semibold text-primary">-{{ number_format($order->orderItems->sum(fn($item) => $item->price * $item->quantity) - $order->total_amount, 0, ',', '.') }}đ</span>
                    </div>
                @endif
                <div class="flex justify-between items-center">
                    <span class="text-outline">Tổng tiền:</span>
                    <span class="text-xl font-bold text-primary">{{ number_format($order->total_amount, 0, ',', '.') }} VND</span>
                </div>
                <hr class="border-outline-variant/20">
                <div class="flex justify-between items-center">
                    <span class="text-outline block mb-1">Địa chỉ giao hàng:</span>
                    <span class="font-semibold text-primary">{{ $order->address->address_detail }}</span>
                </div>
                @if($order->address->phone)
                    <div class="flex justify-between items-center">
                        <span class="text-outline">SĐT liên hệ:</span>
                        <span class="font-semibold text-primary">{{ $order->address->phone }}</span>
                    </div>
                @endif
                <div class="flex justify-between items-center">
                    <span class="text-outline">Thanh toán:</span>
                    <span class="font-semibold text-primary">{{ $order->payment?->method ?? 'Chưa rõ' }}</span>
                </div>
                @if($order->payment)
                    <div class="flex justify-between items-center">
                        <span class="text-outline">Trạng thái thanh toán:</span>
                        <span class="font-semibold text-primary">{{ $order->payment->status }}</span>
                    </div>
                    @if($order->payment->transaction_code)
                        <div class="flex justify-between items-center">
                            <span class="text-outline">Mã giao dịch:</span>
                            <span class="font-semibold text-primary">{{ $order->payment->transaction_code }}</span>
                        </div>
                    @endif
                    @if($order->payment->method === 'bank_transfer')
                        <div class="flex justify-between items-center">
                            <span class="text-outline">Ngân hàng người chuyển:</span>
                            <span class="font-semibold text-primary">{{ $order->payment->bank_provider }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-outline">Số tài khoản người chuyển:</span>
                            <span class="font-semibold text-primary">{{ $order->payment->bank_account_number }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-outline">Chủ tài khoản:</span>
                            <span class="font-semibold text-primary">{{ $order->payment->bank_account_name }}</span>
                        </div>
                    @endif
                    @if($order->payment->paid_at)
                        <div class="flex justify-between items-center">
                            <span class="text-outline">Ngày thanh toán:</span>
                            <span class="font-semibold text-primary">{{ $order->payment->paid_at->format('d/m/Y H:i') }}</span>
                        </div>
                    @endif
                @endif
                @if($order->shipment)
                    <div class="flex justify-between items-center">
                        <span class="text-outline">Vận chuyển:</span>
                        <span class="px-3 py-1 bg-tertiary/10 text-tertiary text-xs rounded-full">{{ $order->shipment->status }}</span>
                    </div>
                @endif

                @if(in_array($order->status, ['pending', 'processing'], true))
                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PATCH')
                        <button type="submit" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?')"
                                class="w-full rounded-3xl bg-rose-600 px-4 py-3 text-sm font-semibold text-white hover:bg-rose-700 transition-colors">
                            Hủy đơn hàng
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
</x-client-layout>