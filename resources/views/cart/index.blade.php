<x-client-layout title="Giỏ hàng">
<div class="max-w-[1440px] mx-auto px-8 py-12">
<div class="space-y-8">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-primary flex items-center gap-2">
            <span class="material-symbols-outlined">shopping_cart</span>
            Giỏ hàng của bạn
        </h1>
        <span class="px-3 py-1 bg-primary text-white text-sm rounded-full">{{ $cart->items->count() }} sản phẩm</span>
    </div>

    @if($cart->items->count() > 0)
        <div class="bg-surface rounded-3xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="text-center p-6 text-outline font-semibold">
                                <input id="select-all-items" type="checkbox" class="w-5 h-5 text-primary border-outline focus:ring-primary" aria-label="Chọn tất cả">
                            </th>
                            <th class="text-left p-6 text-outline font-semibold">Sản phẩm</th>
                            <th class="text-center p-6 text-outline font-semibold">Size - Color</th>
                            <th class="text-center p-6 text-outline font-semibold">Số lượng</th>
                            <th class="text-right p-6 text-outline font-semibold">Đơn giá</th>
                            <th class="text-right p-6 text-outline font-semibold">Tổng</th>
                            <th class="text-center p-6 text-outline font-semibold">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart->items as $item)
                            @php
                                $product = $item->product;
                                $productImage = optional(optional($product)->images)->first();
                            @endphp
                            <tr class="border-t border-outline-variant/10">
                                <td class="p-6 text-center">
                                    <input type="checkbox" class="item-selector w-5 h-5 text-primary border-outline focus:ring-primary" data-item-id="{{ $item->id }}" data-subtotal="{{ $item->subtotal }}" aria-label="Chọn sản phẩm">
                                </td>
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $productImage ? asset($productImage->image_url) : asset('images/no-image.png') }}"
                                             class="w-16 h-16 rounded-xl object-cover"
                                             alt="{{ $product->name ?? 'Sản phẩm không xác định' }}">
                                        <div>
                                            <h6 class="font-semibold text-primary mb-1">{{ $product->name ?? 'Sản phẩm không xác định' }}</h6>
                                            <p class="text-outline text-sm">{{ Str::limit($product->description ?? '', 50) }}</p>
                                            @if($item->design_id)
                                                <span class="inline-flex items-center gap-1 mt-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold">Thiết kế cá nhân hóa</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6 text-center">
                                    @if($item->variant)
                                        <span class="px-3 py-1 bg-outline-variant/10 text-outline text-xs rounded-full">
                                            {{ $item->variant->size }} - {{ $item->variant->color }}
                                        </span>
                                    @elseif($item->design)
                                        @php
                                            $designData = $item->design->design_data;
                                            if (is_string($designData)) {
                                                $designData = json_decode($designData, true) ?: [];
                                            }
                                            $designSize = data_get($designData, 'size');
                                            $designColor = data_get($designData, 'fabric_color');
                                        @endphp
                                        <div class="space-y-1">
                                            @if($designSize)
                                                <span class="px-3 py-1 bg-outline-variant/10 text-outline text-xs rounded-full">{{ $designSize }}</span>
                                            @endif
                                            @if($designColor)
                                                <span class="inline-flex items-center gap-2 px-3 py-1 bg-outline-variant/10 text-outline text-xs rounded-full">
                                                    <span class="h-2 w-2 rounded-full" style="background-color: {{ $designColor }};"></span>
                                                    {{ $designColor }}
                                                </span>
                                            @endif
                                            @if(empty($designSize) && empty($designColor))
                                                <span class="text-outline">Đã thiết kế</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-outline">-</span>
                                    @endif
                                </td>
                                <td class="p-6 text-center">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <div class="flex items-center justify-center gap-2">
                                            <button type="button" class="w-8 h-8 rounded-full border border-outline flex items-center justify-center text-outline hover:bg-primary hover:text-white hover:border-primary transition-colors quantity-btn" data-action="decrease">
                                                <span class="material-symbols-outlined text-sm">remove</span>
                                            </button>
                                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                   class="bg-surface border-none text-sm text-center px-3 py-2 rounded-lg focus:ring-1 focus:ring-primary-container w-16 quantity-input" min="1">
                                            <button type="button" class="w-8 h-8 rounded-full border border-outline flex items-center justify-center text-outline hover:bg-primary hover:text-white hover:border-primary transition-colors quantity-btn" data-action="increase">
                                                <span class="material-symbols-outlined text-sm">add</span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td class="p-6 text-right">
                                    <span class="font-semibold text-primary">{{ number_format($item->unit_price, 0, ',', '.') }} VND</span>
                                </td>
                                <td class="p-6 text-right">
                                    <span class="font-semibold text-primary">{{ number_format($item->subtotal, 0, ',', '.') }} VND</span>
                                </td>
                                <td class="p-6 text-center">
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-error text-white px-4 py-2 rounded-xl font-semibold hover:bg-error-container transition-colors flex items-center gap-1 mx-auto">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                            Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Cart Summary -->
            <div class="bg-surface-container p-6">
                <div class="grid grid-cols-12 gap-6 items-center">
                    <div class="col-span-12 md:col-span-6">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="material-symbols-outlined text-primary">local_shipping</span>
                            <span class="text-outline">Miễn phí vận chuyển cho đơn hàng từ 500.000 VND</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <div class="flex flex-col gap-3 mb-4">
                            <div class="flex justify-between items-center">
                                <span class="text-outline">Tổng cộng ({{ $cart->items->count() }} sản phẩm):</span>
                                <span class="text-2xl font-bold text-primary">{{ number_format($cart->items->sum(function($item) { return $item->subtotal; }), 0, ',', '.') }} VND</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span id="selected-summary-label" class="text-outline">Tổng thanh toán:</span>
                                <span id="selected-summary-total" class="text-2xl font-bold text-primary">0 VND</span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-3 sm:flex-row">
                            <a href="{{ route('products.index') }}" class="bg-outline text-white px-4 py-2 rounded-xl font-semibold hover:bg-outline-variant transition-colors flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">arrow_back</span>
                                Tiếp tục mua sắm
                            </a>
                            <form id="checkout-selection-form" method="GET" action="{{ route('orders.checkout') }}" class="flex-1">
                                <div id="checkout-hidden-inputs"></div>
                                <button id="checkout-button" type="submit" disabled class="w-full bg-primary text-white py-2 rounded-xl font-semibold hover:bg-primary-container transition-colors flex items-center justify-center gap-2 disabled:cursor-not-allowed disabled:opacity-50">
                                    <span class="material-symbols-outlined text-sm">shopping_cart_checkout</span>
                                    Thanh toán
                                </button>
                            </form>
                        </div>
                        <p id="selected-count" class="mt-3 text-sm text-outline">Vui lòng chọn sản phẩm để tiếp tục thanh toán.</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-surface rounded-3xl p-12 text-center shadow-sm">
            <div class="mb-6">
                <span class="material-symbols-outlined text-outline text-7xl">shopping_cart</span>
            </div>
            <h3 class="text-outline mb-4">Giỏ hàng trống</h3>
            <p class="text-outline-variant mb-6">Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm</p>
            <a href="{{ route('products.index') }}" class="bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-primary-container transition-colors inline-flex items-center gap-2">
                <span class="material-symbols-outlined">shopping_bag</span>
                Mua sắm ngay
            </a>
        </div>
    @endif
</div>
</div>

<script>
// Quantity controls and checkout selection
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.quantity-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const action = this.dataset.action;
            const input = this.parentElement.querySelector('.quantity-input');
            let value = parseInt(input.value);

            if (action === 'increase') {
                value++;
            } else if (action === 'decrease' && value > 1) {
                value--;
            }

            input.value = value;
            this.closest('form').submit();
        });
    });

    const selectAllCheckbox = document.getElementById('select-all-items');
    const itemSelectors = Array.from(document.querySelectorAll('.item-selector'));
    const checkoutForm = document.getElementById('checkout-selection-form');
    const checkoutHiddenInputs = document.getElementById('checkout-hidden-inputs');
    const checkoutButton = document.getElementById('checkout-button');
    const selectedCount = document.getElementById('selected-count');
    const selectedTotalEl = document.getElementById('selected-summary-total');

    const formatVnd = (value) => new Intl.NumberFormat('vi-VN').format(value) + ' VND';

    const updateSelection = () => {
        const checkedItems = itemSelectors.filter(checkbox => checkbox.checked);
        const selectedIds = checkedItems.map(checkbox => checkbox.dataset.itemId);
        const selectedTotal = checkedItems.reduce((sum, checkbox) => sum + Number(checkbox.dataset.subtotal || 0), 0);

        checkoutHiddenInputs.innerHTML = '';

        selectedIds.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selected_items[]';
            input.value = id;
            checkoutHiddenInputs.appendChild(input);
        });

        checkoutButton.disabled = selectedIds.length === 0;
        selectAllCheckbox.checked = selectedIds.length === itemSelectors.length && itemSelectors.length > 0;
        selectedCount.textContent = selectedIds.length > 0
            ? `${selectedIds.length} sản phẩm đã chọn để thanh toán.`
            : 'Vui lòng chọn sản phẩm để tiếp tục thanh toán.';
        selectedTotalEl.textContent = formatVnd(selectedTotal);
    };

    itemSelectors.forEach(checkbox => checkbox.addEventListener('change', updateSelection));

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', event => {
            itemSelectors.forEach(checkbox => {
                checkbox.checked = event.target.checked;
            });
            updateSelection();
        });
    }

    if (checkoutForm) {
        checkoutForm.addEventListener('submit', event => {
            if (checkoutButton.disabled) {
                event.preventDefault();
                alert('Vui lòng chọn ít nhất một sản phẩm trước khi thanh toán.');
            }
        });
    }

    updateSelection();
});
</script>
</x-client-layout>