<x-client-layout title="Sản phẩm">
    <div class="max-w-[1440px] mx-auto px-8 py-8">
        <div class="grid grid-cols-12 gap-6">
            <!-- Sidebar -->
            <div class="col-span-12 lg:col-span-3">
                <div class="bg-surface rounded-3xl p-6 shadow-sm">
                    @include('products.sidebar')
                </div>
            </div>
            <!-- Products Grid -->
            <div class="col-span-12 lg:col-span-9">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-primary">Sản phẩm</h1>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-outline">Sắp xếp:</span>
                        <select class="bg-surface border-none text-sm px-3 py-2 rounded-lg focus:ring-1 focus:ring-primary-container">
                            <option>Mới nhất</option>
                            <option>Giá thấp đến cao</option>
                            <option>Giá cao đến thấp</option>
                            <option>Tên A-Z</option>
                        </select>
                    </div>
                </div>

                <!-- Products -->
                @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                    @foreach($products as $product)
                    <div class="bg-surface rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow group">
                        <div class="relative">
                            <img src="{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png') }}"
                                class="w-full h-64 object-cover group-hover:scale-105 transition-transform" alt="{{ $product->name }}">
                            <button type="button" onclick="toggleProductWishlist(event, {{ $product->id }})" class="wishlist-btn absolute top-3 right-3 w-8 h-8 rounded-full bg-surface/80 flex items-center justify-center text-outline hover:text-primary transition-colors hover:bg-primary/10" data-product-id="{{ $product->id }}">
                                <span class="material-symbols-outlined text-lg wishlist-icon">favorite_border</span>
                            </button>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2 py-1 bg-primary/10 text-primary text-xs rounded-full">{{ $product->category->name }}</span>
                                @if($product->is_customizable)
                                <span class="px-2 py-1 bg-tertiary/10 text-tertiary text-xs rounded-full flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">palette</span>
                                    Tùy chỉnh
                                </span>
                                @endif
                            </div>

                            <h5 class="text-lg font-bold text-primary mb-2">{{ Str::limit($product->name, 30) }}</h5>

                            <div class="flex items-center gap-1 mb-2">
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="material-symbols-outlined text-warning text-sm">star</span>
                                        @endfor
                                </div>
                                <span class="text-xs text-outline">(4.5)</span>
                            </div>

                            <p class="text-outline text-sm mb-4">{{ Str::limit($product->description, 60) }}</p>

                            <div class="flex justify-between items-center mb-4">
                                <span class="text-2xl font-bold text-primary">{{ number_format($product->price, 0, ',', '.') }} VND</span>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('products.show', $product->id) }}"
                                    class="flex-1 bg-outline text-white py-2 rounded-xl font-semibold hover:bg-outline-variant transition-colors flex items-center justify-center gap-1">
                                    <span class="material-symbols-outlined text-sm">visibility</span>
                                    Xem
                                </a>
                                <button onclick="openVariantModal({{ $product->id }}, '{{ $product->name }}')" class="flex-1 bg-primary text-white py-2 rounded-xl font-semibold hover:bg-primary-container transition-colors flex items-center justify-center gap-1">
                                    <span class="material-symbols-outlined text-sm">add_shopping_cart</span>
                                    Thêm
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-8">
                    {{ $products->links() }}
                </div>
                @else
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-outline text-6xl mb-4">inventory_2</span>
                    <h3 class="text-outline mb-2">Không tìm thấy sản phẩm</h3>
                    <p class="text-outline-variant">Hãy thử tìm kiếm với từ khóa khác</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <x-size-color />
</x-client-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check wishlist status for all product cards
        const wishlistButtons = document.querySelectorAll('.wishlist-btn');
        wishlistButtons.forEach(btn => {
            const productId = btn.getAttribute('data-product-id');
            checkProductWishlistStatus(productId, btn);
        });
    });

    function toggleProductWishlist(event, productId) {
        event.preventDefault();
        event.stopPropagation();

        const btn = event.currentTarget;
        const icon = btn.querySelector('.wishlist-icon');
        const isCurrentlyInWishlist = icon.textContent === 'favorite';

        if (isCurrentlyInWishlist) {
            // Remove from wishlist
            fetch(`${window.location.origin}/api/wishlist/check/${productId}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.wishlistId) {
                        removeProductFromWishlist(data.wishlistId, btn);
                    }
                });
        } else {
            addProductToWishlist(productId, btn);
        }
    }

    function addProductToWishlist(productId, btn) {
        fetch(`${window.location.origin}/wishlist/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || document.querySelector('[name="_token"]')?.value || '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    const icon = btn.querySelector('.wishlist-icon');
                    icon.textContent = 'favorite';
                    btn.classList.add('text-primary', 'bg-primary/20');
                    btn.classList.remove('text-outline', 'bg-surface/80');
                    showProductNotification('Sản phẩm đã được thêm vào wishlist');
                } else {
                    if (r.status === 401) {
                        showProductNotification('Vui lòng đăng nhập để thêm sản phẩm vào wishlist');
                        setTimeout(() => {
                            window.location.href = '{{ route("login") }}';
                        }, 2000);
                    } else {
                        showProductNotification(data.message || 'Có lỗi xảy ra');
                    }
                }
            })
            .catch(err => {
                console.error('Error:', err);
                showProductNotification('Có lỗi xảy ra khi thêm vào wishlist');
            });
    }

    function removeProductFromWishlist(wishlistId, btn) {
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
                    const icon = btn.querySelector('.wishlist-icon');
                    icon.textContent = 'favorite_border';
                    btn.classList.remove('text-primary', 'bg-primary/20');
                    btn.classList.add('text-outline', 'bg-surface/80');
                    showProductNotification('Sản phẩm đã được xóa khỏi wishlist');
                } else {
                    if (r.status === 401) {
                        showProductNotification('Vui lòng đăng nhập để xóa sản phẩm khỏi wishlist');
                        setTimeout(() => {
                            window.location.href = '{{ route("login") }}';
                        }, 2000);
                    } else {
                        showProductNotification(data.message || 'Có lỗi xảy ra');
                    }
                }
            })
            .catch(err => {
                console.error('Error:', err);
                showProductNotification('Có lỗi xảy ra khi xóa khỏi wishlist');
            });
    }

    function checkProductWishlistStatus(productId, btn) {
        fetch(`${window.location.origin}/api/wishlist/check/${productId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(r => r.json())
            .then(data => {
                const icon = btn.querySelector('.wishlist-icon');
                if (data.inWishlist) {
                    icon.textContent = 'favorite';
                    btn.classList.add('text-primary', 'bg-primary/20');
                    btn.classList.remove('text-outline', 'bg-surface/80');
                } else {
                    icon.textContent = 'favorite_border';
                    btn.classList.remove('text-primary', 'bg-primary/20');
                    btn.classList.add('text-outline', 'bg-surface/80');
                }
            })
            .catch(err => console.error('Error:', err));
    }

    function showProductNotification(message) {
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