<x-client-layout title="Đơn hàng của tôi">
<div class="max-w-[1440px] mx-auto px-8 py-12">
<div class="space-y-8">
    <h1 class="text-3xl font-bold text-primary">Đơn hàng của tôi</h1>

    @if($orders->count() > 0)
        <div class="bg-surface rounded-3xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="text-left p-6 text-outline font-semibold">Mã đơn</th>
                            <th class="text-left p-6 text-outline font-semibold">Ngày đặt</th>
                            <th class="text-left p-6 text-outline font-semibold">Tổng tiền</th>
                            <th class="text-left p-6 text-outline font-semibold">Trạng thái</th>
                            <th class="text-left p-6 text-outline font-semibold">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr class="border-t border-outline-variant/10">
                                <td class="p-6 font-semibold text-primary">#{{ $order->id }}</td>
                                <td class="p-6 text-outline">{{ $order->created_at->format('d/m/Y') }}</td>
                                <td class="p-6 font-semibold text-primary">{{ number_format($order->total_amount, 0, ',', '.') }} VND</td>
                                <td class="p-6">
                                    <span class="px-3 py-1 bg-primary/10 text-primary text-xs rounded-full">{{ $order->status }}</span>
                                </td>
                                <td class="p-6">
                                    <a href="{{ route('orders.show', $order->id) }}" class="bg-primary text-white px-4 py-2 rounded-xl font-semibold hover:bg-primary-container transition-colors inline-flex items-center gap-2">
                                        <span class="material-symbols-outlined text-sm">visibility</span>
                                        Xem chi tiết
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex justify-center mt-8">
            {{ $orders->links() }}
        </div>
    @else
        <div class="bg-surface rounded-3xl p-12 text-center shadow-sm">
            <div class="mb-6">
                <span class="material-symbols-outlined text-outline text-7xl">receipt_long</span>
            </div>
            <h3 class="text-outline mb-4">Bạn chưa có đơn hàng nào</h3>
            <p class="text-outline-variant mb-6">Hãy bắt đầu mua sắm để tạo đơn hàng đầu tiên</p>
            <a href="{{ route('products.index') }}" class="bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-primary-container transition-colors inline-flex items-center gap-2">
                <span class="material-symbols-outlined">shopping_bag</span>
                Mua sắm ngay
            </a>
        </div>
    @endif
</div>
</div>
</x-client-layout>