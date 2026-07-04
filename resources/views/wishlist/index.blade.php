<x-client-layout title="Wishlist">
<div class="max-w-[1440px] mx-auto px-8 py-12">
<div class="space-y-8">
    <div class="flex items-center gap-2">
        <span class="material-symbols-outlined text-primary text-4xl">favorite</span>
        <h1 class="text-3xl font-bold text-primary">Wishlist của bạn</h1>
    </div>

    @if($wishlist->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($wishlist as $item)
                <div class="bg-surface rounded-3xl overflow-hidden shadow-sm group">
                    <div class="relative">
                        <img src="{{ $item->product->images->first() ? asset($item->product->images->first()->image_url) : asset('images/no-image.png') }}"
                             class="w-full h-64 object-cover group-hover:scale-105 transition-transform" alt="{{ $item->product->name }}">
                        <button type="button" onclick="removeFromWishlist({{ $item->id }}, this)" class="wishlist-btn absolute top-3 right-3 w-8 h-8 rounded-full bg-error text-white flex items-center justify-center hover:bg-error-container transition-colors">
                            <span class="material-symbols-outlined text-lg wishlist-icon">favorite</span>
                        </button>
                    </div>
                    <div class="p-6">
                        <h5 class="text-lg font-bold text-primary mb-2">{{ Str::limit($item->product->name, 30) }}</h5>
                        <p class="text-outline text-sm mb-4">{{ Str::limit($item->product->description, 100) }}</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-primary">{{ number_format($item->product->price, 0, ',', '.') }} VND</span>
                        </div>
                        <a href="{{ route('products.show', $item->product->id) }}"
                           class="w-full bg-primary text-white py-2 rounded-xl font-semibold hover:bg-primary-container transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">visibility</span>
                            Xem chi tiết
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-surface rounded-3xl p-12 text-center shadow-sm">
            <div class="mb-6">
                <span class="material-symbols-outlined text-outline text-7xl">favorite_border</span>
            </div>
            <h3 class="text-outline mb-4">Wishlist trống</h3>
            <p class="text-outline-variant mb-6">Hãy thêm sản phẩm yêu thích vào wishlist của bạn</p>
            <a href="{{ route('products.index') }}" class="bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-primary-container transition-colors inline-flex items-center gap-2">
                <span class="material-symbols-outlined">shopping_bag</span>
                Tiếp tục mua sắm
            </a>
        </div>
    @endif
</div>
</div>

<script>
function removeFromWishlist(wishlistId, btn) {
    if (!confirm('Bạn có chắc muốn xóa sản phẩm này khỏi wishlist?')) {
        return;
    }

    fetch(`${window.location.origin}/wishlist/${wishlistId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || document.querySelector('[name="_token"]')?.value || '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json'
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            // Remove the product card from the page
            const productCard = btn.closest('.bg-surface');
            productCard.remove();
            
            // Show notification
            showNotification('Sản phẩm đã được xóa khỏi wishlist');
            
            // Update header count
            if (typeof updateHeaderWishlistCount !== 'undefined') {
                updateHeaderWishlistCount();
            }
            
            // Check if wishlist is now empty
            const remainingCards = document.querySelectorAll('.bg-surface');
            if (remainingCards.length === 1) { // Only the empty state card remains
                location.reload(); // Reload to show empty state
            }
        } else {
            if (r.status === 401) {
                showNotification('Vui lòng đăng nhập để xóa sản phẩm khỏi wishlist');
            } else {
                showNotification(data.message || 'Có lỗi xảy ra');
            }
        }
    })
    .catch(err => {
        console.error('Error:', err);
        showNotification('Có lỗi xảy ra khi xóa khỏi wishlist');
    });
}

function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'fixed bottom-6 right-6 rounded-3xl border border-emerald-100 bg-emerald-50 px-6 py-4 text-sm text-emerald-900 shadow-lg flex items-center gap-3 z-50';
    notification.innerHTML = `
        <span class="material-symbols-outlined text-2xl">check_circle</span>
        <div>${message}</div>
    `;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);
}
</script>
</x-client-layout>