<x-client-layout title="{{ $product->name }}">
<div class="max-w-[1440px] mx-auto px-8 py-12">
<div class="grid grid-cols-12 gap-8">
    
    <!-- Product Images & Info -->
    <div class="col-span-12 lg:col-span-8">
        <div class="bg-surface rounded-3xl overflow-hidden shadow-sm">
            <div class="grid grid-cols-12">
                <!-- Images -->
                <div class="col-span-12 md:col-span-6">
                    <div class="p-6">
                        <img src="{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('/images/no-image.png') }}"
                             class="w-full rounded-3xl object-cover" alt="{{ $product->name }}"
                             style="height: 400px;">
                    </div>
                </div>

                <!-- Info -->
                <div class="col-span-12 md:col-span-6">
                    <div class="p-6 flex flex-col h-full">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="px-3 py-1 bg-primary/10 text-primary text-xs rounded-full">{{ $product->category->name }}</span>
                                @if($product->is_customizable)
                                    <span class="px-3 py-1 bg-tertiary/10 text-tertiary text-xs rounded-full flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">palette</span>
                                        Có thể tùy chỉnh
                                    </span>
                                @endif
                            </div>

                            <h1 class="text-2xl font-bold text-primary mb-4">{{ $product->name }}</h1>

                            <div class="flex items-center gap-2 mb-4">
                                <div class="flex items-center gap-1">
                                    @php
                                        $avgRating = $product->getAverageRating();
                                        $ratingFloor = floor($avgRating);
                                    @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="material-symbols-outlined {{ $i <= $ratingFloor ? 'text-warning' : ($i - $avgRating < 1 ? 'text-warning' : 'text-outline') }} text-sm">
                                            {{ $i <= $ratingFloor ? 'star' : 'star' }}
                                        </span>
                                    @endfor
                                </div>
                                <span class="text-xs text-outline">({{ $product->getRoundedAverageRating() }}/5 - {{ $product->getReviewCount() }} đánh giá)</span>
                            </div>

                            <p class="text-outline mb-6">{{ $product->description }}</p>

                            <div class="mb-6">
                                <h3 class="text-xl font-bold text-primary mb-4">{{ number_format($product->price, 0, ',', '.') }} VND</h3>

                                @if($product->variants->count() > 0)
                                    <div class="mb-4">
                                        <label class="block text-xs font-bold text-primary uppercase tracking-widest mb-2">SIZE - COLOR</label>
                                        <select class="bg-surface border-none text-sm px-3 py-2 rounded-lg focus:ring-1 focus:ring-primary-container w-full">
                                            @foreach($product->variants as $variant)
                                                <option value="{{ $variant->id }}">{{ $variant->size }} - {{ $variant->color }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div class="mb-4">
                                    <label class="block text-xs font-bold text-primary uppercase tracking-widest mb-2">SỐ LƯỢNG</label>
                                    <div class="flex items-center gap-2">
                                        <button type="button" onclick="decreaseQuantity()" class="w-8 h-8 rounded-full border border-outline flex items-center justify-center text-outline hover:bg-primary hover:text-white hover:border-primary transition-colors">
                                            <span class="material-symbols-outlined text-sm">remove</span>
                                        </button>
                                        <input type="number" id="quantity" name="quantity" class="bg-surface border-none text-sm text-center px-3 py-2 rounded-lg focus:ring-1 focus:ring-primary-container w-20" value="1" min="1">
                                        <button type="button" onclick="increaseQuantity()" class="w-8 h-8 rounded-full border border-outline flex items-center justify-center text-outline hover:bg-primary hover:text-white hover:border-primary transition-colors">
                                            <span class="material-symbols-outlined text-sm">add</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <form id="addToCartForm" method="POST" action="{{ route('cart.add') }}" class="flex-1">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="variant_id" id="variant_id">
                                <input type="hidden" name="quantity" id="form_quantity" value="1">
                                <button type="submit" class="w-full bg-primary text-white py-3 rounded-xl font-semibold hover:bg-primary-container transition-colors flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-sm">add_shopping_cart</span>
                                    Thêm vào giỏ
                                </button>
                            </form>
                            <button type="button" onclick="toggleWishlist({{ $product->id }})" id="wishlistBtn" class="w-12 h-12 rounded-xl border border-outline flex items-center justify-center text-outline hover:bg-primary hover:text-white hover:border-primary transition-colors">
                                <span class="material-symbols-outlined text-lg" id="wishlistIcon">favorite</span>
                            </button>
                            <button type="button" class="w-12 h-12 rounded-xl border border-outline flex items-center justify-center text-outline hover:bg-primary hover:text-white hover:border-primary transition-colors" onclick="shareProduct('{{ $product->name }}', '{{ route('products.show', $product->id) }}')">
                                <span class="material-symbols-outlined text-lg">share</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="col-span-12 lg:col-span-4">
        <div class="bg-surface-container rounded-3xl p-6 shadow-sm">
            <h5 class="text-lg font-bold text-primary mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined">recommend</span>
                Sản phẩm liên quan
            </h5>

            <div class="space-y-3">
                @foreach($relatedProducts as $related)
                    <a href="{{ route('products.show', $related->id) }}" class="flex gap-3 p-3 rounded-xl hover:bg-surface-container-highest transition-colors">
                        <img src="{{ $related->images->first() ? asset($related->images->first()->image_url) : asset('images/no-image.png') }}"
                             class="w-16 h-16 rounded-xl object-cover" alt="{{ $related->name }}">
                        <div class="flex-1">
                            <h6 class="text-sm font-semibold text-primary mb-1">{{ Str::limit($related->name, 25) }}</h6>
                            <p class="text-outline text-xs">{{ number_format($related->price, 0, ',', '.') }} VND</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Reviews Section -->
<div class="mt-12">
    <div class="bg-surface rounded-3xl p-6 shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h4 class="text-xl font-bold text-primary flex items-center gap-2">
                <span class="material-symbols-outlined">reviews</span>
                Đánh giá sản phẩm
            </h4>
            @auth
                <button class="bg-primary text-white px-4 py-2 rounded-xl font-semibold hover:bg-primary-container transition-colors flex items-center gap-2" onclick="document.getElementById('reviewModal').classList.remove('hidden')">
                    <span class="material-symbols-outlined text-sm">add</span>
                    Viết đánh giá
                </button>
            @endauth
        </div>

        @if($product->reviews->count() > 0)
            <div class="space-y-4">
                @foreach($product->reviews as $review)
                    <div class="border border-outline-variant/20 rounded-3xl p-4 flex justify-between items-start">
                        <div class="flex items-start gap-3 flex-1">
                            <img src="https://via.placeholder.com/40x40?text={{ substr($review->user->name, 0, 1) }}"
                                 class="w-10 h-10 rounded-full" alt="Avatar">
                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-2">
                                    <h6 class="font-semibold text-primary">{{ $review->user->name }}</h6>
                                    <span class="text-xs text-outline">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="flex items-center gap-1 mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="material-symbols-outlined {{ $i <= $review->rating ? 'text-warning' : 'text-outline' }} text-sm">star</span>
                                    @endfor
                                </div>
                                <p class="text-outline">{{ $review->comment }}</p>
                            </div>
                        </div>
                        @auth
                            @if(Auth::id() === $review->user_id)
                                <div class="flex gap-2 ml-4">
                                    <button onclick="editReview({{ $review->id }}, {{ $review->rating }}, '{{ addslashes($review->comment) }}')" class="text-primary hover:bg-primary/10 p-2 rounded-lg transition-colors">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </button>
                                    <button onclick="deleteReview({{ $product->id }}, {{ $review->id }})" class="text-error hover:bg-error/10 p-2 rounded-lg transition-colors">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </div>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <span class="material-symbols-outlined text-outline text-5xl mb-4">reviews</span>
                <p class="text-outline">Chưa có đánh giá nào</p>
            </div>
        @endif
    </div>
</div>

<!-- Review Modal -->
@auth
<div id="reviewModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
    <div class="bg-surface rounded-3xl p-6 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-6">
            <h5 class="text-lg font-bold text-primary flex items-center gap-2">
                <span class="material-symbols-outlined">edit</span>
                <span id="modalTitle">Viết đánh giá</span>
            </h5>
            <button onclick="closeReviewModal()" class="text-outline hover:text-primary">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="reviewForm" action="{{ route('reviews.store', $product->id) }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-widest mb-2">ĐÁNH GIÁ <span class="text-error">*</span></label>
                    <div class="flex gap-1" id="starRating">
                        @for($i = 1; $i <= 5; $i++)
                            <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" class="hidden" required>
                            <label for="star{{ $i }}" class="cursor-pointer star-label" data-star="{{ $i }}">
                                <span class="material-symbols-outlined text-outline hover:text-warning text-3xl transition-colors">star</span>
                            </label>
                        @endfor
                    </div>
                    <span class="text-xs text-error mt-1 hidden" id="ratingError">Vui lòng chọn đánh giá</span>
                </div>
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-widest mb-2">BÌNH LUẬN</label>
                    <textarea id="commentInput" name="comment" class="bg-surface border border-outline-variant rounded-lg text-sm px-3 py-2 focus:ring-1 focus:ring-primary-container focus:border-transparent w-full" rows="4" placeholder="Chia sẻ trải nghiệm của bạn..."></textarea>
                    <span class="text-xs text-outline mt-1 block">Tối đa 1000 ký tự</span>
                </div>
            </div>
            <div class="flex gap-2 mt-6">
                <button type="button" onclick="closeReviewModal()" class="flex-1 bg-outline text-white py-2 rounded-xl font-semibold hover:bg-outline-variant transition-colors">Hủy</button>
                <button type="submit" class="flex-1 bg-primary text-white py-2 rounded-xl font-semibold hover:bg-primary-container transition-colors">Gửi đánh giá</button>
            </div>
        </form>
    </div>
</div>
@endauth
</div>
</x-client-layout>

<script>
function increaseQuantity() {
    const input = document.getElementById('quantity');
    input.value = parseInt(input.value) + 1;
    document.getElementById('form_quantity').value = input.value;
}

function decreaseQuantity() {
    const input = document.getElementById('quantity');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        document.getElementById('form_quantity').value = input.value;
    }
}

document.getElementById('quantity').addEventListener('input', function() {
    document.getElementById('form_quantity').value = this.value;
});

document.addEventListener('DOMContentLoaded', function() {
    const variantSelect = document.querySelector('select');
    if (variantSelect) {
        variantSelect.addEventListener('change', function() {
            document.getElementById('variant_id').value = this.value;
        });
    }

    checkWishlistStatus({{ $product->id }});
});

function toggleWishlist(productId) {
    const btn = document.getElementById('wishlistBtn');
    const icon = document.getElementById('wishlistIcon');
    const isCurrentlyInWishlist = icon.textContent === 'favorite';

    if (isCurrentlyInWishlist) {
        fetch(`${window.location.origin}/api/wishlist/check/${productId}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.inWishlist && data.wishlistId) {
                removeFromWishlist(data.wishlistId, btn);
            }
        });
    } else {
        addToWishlist(productId, btn);
    }
}

function addToWishlist(productId, btn) {
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
            const icon = document.getElementById('wishlistIcon');
            const btn = document.getElementById('wishlistBtn');
            icon.textContent = 'favorite';
            btn.classList.add('text-primary', 'border-primary', 'bg-primary/10');
            btn.classList.remove('text-outline', 'border-outline');
            showNotification('Sản phẩm đã được thêm vào wishlist');
            updateWishlistCount();
        } else {
            if (r.status === 401) {
                showNotification('Vui lòng đăng nhập để thêm sản phẩm vào wishlist');
                // Optionally redirect to login
                // window.location.href = '/login';
            } else {
                showNotification(data.message || 'Có lỗi xảy ra');
            }
        }
    })
    .catch(err => {
        console.error('Error:', err);
        showNotification('Có lỗi xảy ra khi thêm vào wishlist');
    });
}

function checkWishlistStatus(productId) {
    fetch(`${window.location.origin}/api/wishlist/check/${productId}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(r => r.json())
    .then(data => {
        const icon = document.getElementById('wishlistIcon');
        const btn = document.getElementById('wishlistBtn');
        if (data.inWishlist) {
            icon.textContent = 'favorite';
            btn.classList.add('text-primary', 'border-primary', 'bg-primary/10');
            btn.classList.remove('text-outline', 'border-outline');
        } else {
            icon.textContent = 'favorite_border';
            btn.classList.remove('text-primary', 'border-primary', 'bg-primary/10');
            btn.classList.add('text-outline', 'border-outline');
        }
    })
    .catch(err => console.error('Error:', err));
}

function updateWishlistCount() {
    if (typeof updateHeaderWishlistCount !== 'undefined') {
        updateHeaderWishlistCount();
    }
}

function removeFromWishlist(wishlistId, btn) {
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
            const icon = document.getElementById('wishlistIcon');
            const btn = document.getElementById('wishlistBtn');
            icon.textContent = 'favorite_border';
            btn.classList.remove('text-primary', 'border-primary', 'bg-primary/10');
            btn.classList.add('text-outline', 'border-outline');
            showNotification('Sản phẩm đã được xóa khỏi wishlist');
            updateWishlistCount();
        } else {
            if (r.status === 401) {
                showNotification('Vui lòng đăng nhập để xóa sản phẩm khỏi wishlist');
                setTimeout(() => {
                    window.location.href = '{{ route("login") }}';
                }, 2000);
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

function shareProduct(title, url) {
    if (navigator.share) {
        navigator.share({
            title: title,
            url: url
        });
    } else {
        const textarea = document.createElement('textarea');
        textarea.value = url;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
        showNotification('Đã sao chép đường dẫn vào bộ nhớ tạm');
    }
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

document.getElementById('addToCartForm').addEventListener('submit', function(e) {
    e.preventDefault();
    fetch(this.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || document.querySelector('[name="_token"]')?.value || '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams(new FormData(this))
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message);
            document.getElementById('quantity').value = '1';
            if (typeof updateHeaderCartCount !== 'undefined') {
                updateHeaderCartCount();
            }
        }
    })
    .catch(err => console.error('Error:', err));
});

// Review Functions
function closeReviewModal() {
    document.getElementById('reviewModal').classList.add('hidden');
    document.getElementById('reviewForm').reset();
    document.getElementById('modalTitle').textContent = 'Viết đánh giá';
    document.querySelectorAll('#starRating label').forEach(label => {
        label.querySelector('span').classList.remove('text-warning');
        label.querySelector('span').classList.add('text-outline');
    });
}

function editReview(reviewId, rating, comment) {
    document.getElementById('reviewModal').classList.remove('hidden');
    document.getElementById('modalTitle').textContent = 'Chỉnh sửa đánh giá';
    
    document.getElementById(`star${rating}`).checked = true;
    document.getElementById('commentInput').value = comment;
    
    // Update star display
    document.querySelectorAll('#starRating label').forEach(label => {
        const star = parseInt(label.dataset.star);
        if (star <= rating) {
            label.querySelector('span').classList.remove('text-outline');
            label.querySelector('span').classList.add('text-warning');
        } else {
            label.querySelector('span').classList.remove('text-warning');
            label.querySelector('span').classList.add('text-outline');
        }
    });
}

function deleteReview(productId, reviewId) {
    if (confirm('Bạn chắc chắn muốn xóa đánh giá này?')) {
        fetch(`${window.location.origin}/products/${productId}/reviews`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || document.querySelector('[name="_token"]')?.value || '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success || r.ok) {
                showNotification('Đánh giá đã được xóa');
                setTimeout(() => location.reload(), 1500);
            } else {
                showNotification('Có lỗi xảy ra khi xóa đánh giá');
            }
        })
        .catch(err => {
            console.error('Error:', err);
            location.reload();
        });
    }
}

// Star rating interaction
document.addEventListener('DOMContentLoaded', function() {
    const starLabels = document.querySelectorAll('#starRating label');
    
    starLabels.forEach(label => {
        label.addEventListener('mouseover', function() {
            const hoverStar = parseInt(this.dataset.star);
            starLabels.forEach(l => {
                const star = parseInt(l.dataset.star);
                const span = l.querySelector('span');
                if (star <= hoverStar) {
                    span.classList.remove('text-outline');
                    span.classList.add('text-warning');
                } else {
                    span.classList.remove('text-warning');
                    span.classList.add('text-outline');
                }
            });
        });
        
        label.addEventListener('click', function() {
            const selectedStar = parseInt(this.dataset.star);
            starLabels.forEach(l => {
                const star = parseInt(l.dataset.star);
                const span = l.querySelector('span');
                if (star <= selectedStar) {
                    span.classList.remove('text-outline');
                    span.classList.add('text-warning');
                } else {
                    span.classList.remove('text-warning');
                    span.classList.add('text-outline');
                }
            });
        });
    });
    
    const starRatingDiv = document.getElementById('starRating');
    if (starRatingDiv) {
        starRatingDiv.addEventListener('mouseout', function() {
            const checked = document.querySelector('input[name="rating"]:checked');
            starLabels.forEach(label => {
                const span = label.querySelector('span');
                if (checked && parseInt(label.dataset.star) <= parseInt(checked.value)) {
                    span.classList.remove('text-outline');
                    span.classList.add('text-warning');
                } else {
                    span.classList.remove('text-warning');
                    span.classList.add('text-outline');
                }
            });
        });
    }
});

// Form validation before submit
document.getElementById('reviewForm').addEventListener('submit', function(e) {
    const rating = document.querySelector('input[name="rating"]:checked');
    if (!rating) {
        e.preventDefault();
        document.getElementById('ratingError').classList.remove('hidden');
        setTimeout(() => {
            document.getElementById('ratingError').classList.add('hidden');
        }, 3000);
    }
});
</script>