<x-client-layout title="Trang chủ">
<!-- Main Content -->
<main class="mt-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3xl border-0 shadow-sm container mx-auto mb-4" role="alert">
            <span class="material-symbols-outlined me-2">check_circle</span>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3xl border-0 shadow-sm container mx-auto mb-4" role="alert">
            <span class="material-symbols-outlined me-2">error</span>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary/10 via-primary/5 to-secondary/10 py-20 overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%2300327d" fill-opacity="0.03"%3E%3Ccircle cx="30" cy="30" r="4"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>
        <div class="container relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-5xl md:text-6xl font-bold text-primary mb-6 leading-tight">
                    Thiết kế áo theo phong cách
                    <span class="text-secondary">của bạn</span>
                </h1>
                <p class="text-xl text-outline-variant mb-8 max-w-2xl mx-auto leading-relaxed">
                    Khám phá bộ sưu tập áo chất lượng cao với công nghệ thiết kế tùy chỉnh.
                    Từ ý tưởng đến sản phẩm hoàn hảo chỉ trong vài bước đơn giản.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('products.index') }}" class="bg-primary text-white px-8 py-4 rounded-2xl font-semibold hover:bg-primary-container transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl">
                        <span class="material-symbols-outlined">shopping_bag</span>
                        Khám phá sản phẩm
                    </a>
                    <a href="{{ route('design.index') }}" class="bg-secondary text-white px-8 py-4 rounded-2xl font-semibold hover:bg-secondary-container transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl">
                        <span class="material-symbols-outlined">palette</span>
                        Thiết kế ngay
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-surface">
        <div class="container">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Tại sao chọn N.clothes?</h2>
                <p class="text-lg text-outline-variant max-w-2xl mx-auto">
                    Chúng tôi mang đến trải nghiệm mua sắm và thiết kế áo độc đáo với công nghệ tiên tiến
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-surface-container rounded-3xl p-8 text-center shadow-sm hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="material-symbols-outlined text-3xl text-primary">palette</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-4">Thiết kế tùy chỉnh</h3>
                    <p class="text-outline-variant">
                        Công cụ thiết kế trực tuyến cho phép bạn tạo ra mẫu áo độc nhất vô nhị theo ý tưởng riêng
                    </p>
                </div>

                <div class="bg-surface-container rounded-3xl p-8 text-center shadow-sm hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-secondary/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="material-symbols-outlined text-3xl text-secondary">local_shipping</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-4">Giao hàng nhanh</h3>
                    <p class="text-outline-variant">
                        Giao hàng tận nơi trong 2-3 ngày với dịch vụ theo dõi đơn hàng real-time
                    </p>
                </div>

                <div class="bg-surface-container rounded-3xl p-8 text-center shadow-sm hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-tertiary/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="material-symbols-outlined text-3xl text-tertiary">verified</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-4">Chất lượng đảm bảo</h3>
                    <p class="text-outline-variant">
                        Sử dụng vải cao cấp, in ấn công nghệ mới nhất với độ bền màu vượt trội
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-20 bg-surface-container/30">
        <div class="container">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Danh mục sản phẩm</h2>
                <p class="text-lg text-outline-variant">Khám phá các loại áo phù hợp với phong cách của bạn</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @php
                    $categories = \App\Models\Category::take(4)->get();
                @endphp

                @forelse($categories as $category)
                    <a href="{{ route('products.category', $category->id) }}" class="group">
                        <div class="bg-surface rounded-3xl p-6 text-center shadow-sm hover:shadow-lg transition-all duration-300 hover:scale-105">
                            <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-primary/20 transition-colors">
                                <span class="material-symbols-outlined text-2xl text-primary">category</span>
                            </div>
                            <h3 class="font-semibold text-primary group-hover:text-primary-container transition-colors">{{ $category->name }}</h3>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <span class="material-symbols-outlined text-6xl text-outline-variant/50">category</span>
                        <p class="text-outline-variant mt-4">Chưa có danh mục nào</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('products.index') }}" class="bg-outline text-white px-8 py-3 rounded-2xl font-semibold hover:bg-outline-variant transition-colors inline-flex items-center gap-2">
                    <span class="material-symbols-outlined">arrow_forward</span>
                    Xem tất cả sản phẩm
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-20 bg-surface">
        <div class="container">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Sản phẩm nổi bật</h2>
                <p class="text-lg text-outline-variant">Những mẫu áo được yêu thích nhất trong tháng</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                @php
                    $featuredProducts = \App\Models\Product::with(['images', 'category'])->take(8)->get();
                @endphp

                @forelse($featuredProducts as $product)
                    <div class="bg-surface-container rounded-3xl overflow-hidden shadow-sm group hover:shadow-lg transition-shadow">
                        <div class="relative">
                            <img src="{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.jpg') }}"
                                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform" alt="{{ $product->name }}">
                            <button type="button" onclick="toggleHomeWishlist(event, {{ $product->id }})" class="home-wishlist-btn absolute top-3 right-3 w-8 h-8 rounded-full bg-surface/80 flex items-center justify-center text-outline hover:text-primary transition-colors hover:bg-primary/10" data-product-id="{{ $product->id }}">
                                <span class="material-symbols-outlined text-lg home-wishlist-icon">favorite_border</span>
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

                            <h5 class="text-lg font-bold text-primary mb-2">{{ Str::limit($product->name, 25) }}</h5>

                            <div class="flex items-center gap-1 mb-2">
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="material-symbols-outlined text-warning text-sm">star</span>
                                    @endfor
                                </div>
                                <span class="text-xs text-outline">(4.8)</span>
                            </div>

                            <p class="text-outline text-sm mb-4">{{ Str::limit($product->description, 50) }}</p>

                            <div class="flex justify-between items-center mb-4">
                                <span class="text-2xl font-bold text-primary">{{ number_format($product->price, 0, ',', '.') }} VND</span>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('products.show', $product->id) }}"
                                   class="flex-1 bg-outline text-white py-2 rounded-xl font-semibold hover:bg-outline-variant transition-colors flex items-center justify-center gap-1 text-sm">
                                    <span class="material-symbols-outlined text-sm">visibility</span>
                                    Xem
                                </a>
                                <button onclick="openVariantModal({{ $product->id }}, '{{ $product->name }}')" class="flex-1 bg-primary text-white py-2 rounded-xl font-semibold hover:bg-primary-container transition-colors flex items-center justify-center gap-1 text-sm">
                                    <span class="material-symbols-outlined text-sm">add_shopping_cart</span>
                                    Thêm
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <span class="material-symbols-outlined text-6xl text-outline-variant/50">inventory_2</span>
                        <p class="text-outline-variant mt-4">Chưa có sản phẩm nào</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- News / Blog Section -->
    <section class="py-20 bg-surface-container/30">
        <div class="container">
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-10">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-outline mb-2">Tin tức & Blog</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-primary">Cập nhật mới nhất từ N.clothes</h2>
                </div>
                <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 text-primary font-semibold hover:text-primary-container transition">
                    Xem tất cả bài viết
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                @php
                    $newsItems = \App\Models\News::latest()->take(3)->get();
                @endphp

                @forelse($newsItems as $news)
                    <article class="rounded-3xl border border-surface-container bg-white overflow-hidden shadow-sm hover:shadow-lg transition-shadow">
                        <div class="h-56 overflow-hidden">
                            <img src="{{ $news->image_url ?? '/images/no-image.png' }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $news->title }}">
                        </div>
                        <div class="p-6">
                            <div class="mb-4 flex items-center gap-2 text-xs uppercase tracking-[0.3em] text-outline">
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary">
                                    <span class="material-symbols-outlined text-base">article</span>
                                </span>
                                <span>{{ $news->created_at?->format('d/m/Y') ?? 'Mới' }}</span>
                            </div>
                            <h3 class="text-xl font-semibold text-primary mb-3">{{ Str::limit($news->title, 60) }}</h3>
                            <p class="text-outline-variant mb-6">{{ Str::limit($news->content, 110) }}</p>
                            <a href="#" class="inline-flex items-center gap-2 text-primary font-semibold hover:text-primary-container transition">
                                Đọc tiếp
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full rounded-3xl border border-surface-container bg-white p-12 text-center shadow-sm">
                        <p class="text-lg text-outline-variant">Không có bài viết nào để hiển thị. Hãy quay lại sau để xem tin tức mới nhất.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary to-primary-container">
        <div class="container">
            <div class="max-w-4xl mx-auto text-center text-white">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Sẵn sàng tạo ra mẫu áo của riêng bạn?</h2>
                <p class="text-xl mb-8 opacity-90">
                    Bắt đầu hành trình sáng tạo với công cụ thiết kế trực tuyến của chúng tôi.
                    Không cần kỹ năng thiết kế chuyên nghiệp!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('design.index') }}" class="bg-white text-primary px-8 py-4 rounded-2xl font-semibold hover:bg-surface transition-all duration-300 flex items-center justify-center gap-2 shadow-lg">
                        <span class="material-symbols-outlined">palette</span>
                        Bắt đầu thiết kế
                    </a>
                    <a href="{{ route('register') }}" class="bg-secondary text-white px-8 py-4 rounded-2xl font-semibold hover:bg-secondary-container transition-all duration-300 flex items-center justify-center gap-2 shadow-lg">
                        <span class="material-symbols-outlined">person_add</span>
                        Đăng ký tài khoản
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-surface-container/50">
        <div class="container">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl font-bold text-primary mb-2">{{ \App\Models\Product::count() }}</div>
                    <div class="text-outline-variant">Sản phẩm</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-secondary mb-2">{{ \App\Models\User::count() }}</div>
                    <div class="text-outline-variant">Khách hàng</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-tertiary mb-2">{{ \App\Models\Order::count() }}</div>
                    <div class="text-outline-variant">Đơn hàng</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-error mb-2">4.8</div>
                    <div class="text-outline-variant">Đánh giá</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trend Section -->
    <section class="py-20 bg-surface">
        <div class="container">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Xu hướng được săn đón</h2>
                <p class="text-lg text-outline-variant max-w-2xl mx-auto">Những phong cách áo thun và hoodie được khách hàng yêu thích nhất, cập nhật mỗi tuần.</p>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="rounded-[2rem] border border-surface-container bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="inline-flex h-16 w-16 items-center justify-center rounded-3xl bg-primary/10 text-primary mb-5">
                        <span class="material-symbols-outlined text-3xl">checkroom</span>
                    </div>
                    <h3 class="text-2xl font-semibold text-primary mb-3">Streetwear tối giản</h3>
                    <p class="text-outline-variant mb-6">Phù hợp cho mọi hoạt động, thiết kế tinh tế, dễ phối đồ và thoải mái trong từng chuyển động.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-primary font-semibold hover:text-primary-container transition">
                        Xem chi tiết
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>

                <div class="rounded-[2rem] border border-surface-container bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="inline-flex h-16 w-16 items-center justify-center rounded-3xl bg-secondary/10 text-secondary mb-5">
                        <span class="material-symbols-outlined text-3xl">dry_cleaning</span>
                    </div>
                    <h3 class="text-2xl font-semibold text-primary mb-3">Hoodie cá tính</h3>
                    <p class="text-outline-variant mb-6">Mẫu hoodie phong cách unisex, phù hợp với cả mùa lạnh và thời tiết chuyển mùa.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-primary font-semibold hover:text-primary-container transition">
                        Khám phá ngay
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>

                <div class="rounded-[2rem] border border-surface-container bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="inline-flex h-16 w-16 items-center justify-center rounded-3xl bg-tertiary/10 text-tertiary mb-5">
                        <span class="material-symbols-outlined text-3xl">stars</span>
                    </div>
                    <h3 class="text-2xl font-semibold text-primary mb-3">Limited Edition</h3>
                    <p class="text-outline-variant mb-6">Bộ sưu tập đặc biệt với thiết kế độc quyền, số lượng giới hạn cho phong cách cá nhân của bạn.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-primary font-semibold hover:text-primary-container transition">
                        Xem thêm
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-surface-container/30">
        <div class="container">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Khách hàng nói gì</h2>
                <p class="text-lg text-outline-variant max-w-2xl mx-auto">Lắng nghe phản hồi từ những người đã trải nghiệm áo và dịch vụ N.clothes.</p>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <div class="rounded-[2rem] bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="h-14 w-14 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-2xl">T</div>
                        <div>
                            <h3 class="text-lg font-semibold text-primary">Trang Minh</h3>
                            <p class="text-sm text-outline-variant">Khách hàng</p>
                        </div>
                    </div>
                    <p class="text-outline-variant leading-relaxed">"Áo nhận được đẹp, vừa vặn và giao hàng rất nhanh. Tôi rất hài lòng với dịch vụ thiết kế của N.clothes."</p>
                </div>
                <div class="rounded-[2rem] bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="h-14 w-14 rounded-2xl bg-secondary/10 text-secondary flex items-center justify-center text-2xl">H</div>
                        <div>
                            <h3 class="text-lg font-semibold text-primary">Hương Ly</h3>
                            <p class="text-sm text-outline-variant">Khách hàng</p>
                        </div>
                    </div>
                    <p class="text-outline-variant leading-relaxed">"Thiết kế dễ dùng, mình có thể tuỳ chỉnh màu sắc và chữ rất nhanh. Sản phẩm sau khi nhận giữ được form đẹp và màu bền."</p>
                </div>
                <div class="rounded-[2rem] bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="h-14 w-14 rounded-2xl bg-tertiary/10 text-tertiary flex items-center justify-center text-2xl">Đ</div>
                        <div>
                            <h3 class="text-lg font-semibold text-primary">Đức Anh</h3>
                            <p class="text-sm text-outline-variant">Khách hàng</p>
                        </div>
                    </div>
                    <p class="text-outline-variant leading-relaxed">"Đơn hàng được đóng gói rất cẩn thận, áo chất lượng và rất đẹp. Tôi sẽ tiếp tục ủng hộ N.clothes."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter CTA -->
    <section class="py-20 bg-gradient-to-r from-primary to-secondary-container text-white">
        <div class="container">
            <div class="rounded-[2rem] bg-white/5 p-10 shadow-xl backdrop-blur-xl border border-white/10">
                <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr] items-center">
                    <div>
                        <h2 class="text-4xl font-bold mb-4">Nhận thông tin khuyến mãi mới nhất</h2>
                        <p class="text-lg text-white/80 mb-8">Đăng ký để không bỏ lỡ bộ sưu tập mới, ưu đãi riêng và mã giảm giá đặc biệt.</p>
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-2xl bg-white px-8 py-4 text-primary font-semibold shadow-lg hover:bg-surface transition">
                            <span class="material-symbols-outlined">mail</span>
                            Đăng ký ngay
                        </a>
                    </div>
                    <div class="rounded-[2rem] bg-surface p-8 text-primary">
                        <h3 class="text-xl font-semibold mb-4">N.clothes</h3>
                        <p class="text-outline-variant mb-6">Trở thành thành viên, nhận ngay voucher chào mừng và cập nhật các mẫu mới thường xuyên.</p>
                        <div class="grid gap-4">
                            <div class="rounded-3xl bg-white/90 p-4">
                                <p class="text-sm font-semibold text-primary">+20% ưu đãi cho đơn hàng đầu tiên</p>
                            </div>
                            <div class="rounded-3xl bg-white/90 p-4">
                                <p class="text-sm font-semibold text-primary">Giao hàng nhanh, đổi trả dễ dàng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<x-size-color/>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check wishlist status for all home product cards
    const homeWishlistButtons = document.querySelectorAll('.home-wishlist-btn');
    homeWishlistButtons.forEach(btn => {
        const productId = btn.getAttribute('data-product-id');
        checkHomeWishlistStatus(productId, btn);
    });
});

function toggleHomeWishlist(event, productId) {
    event.preventDefault();
    event.stopPropagation();
    
    const btn = event.currentTarget;
    const icon = btn.querySelector('.home-wishlist-icon');
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
                removeHomeFromWishlist(data.wishlistId, btn);
            }
        });
    } else {
        addHomeToWishlist(productId, btn);
    }
}

function addHomeToWishlist(productId, btn) {
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
            const icon = btn.querySelector('.home-wishlist-icon');
            icon.textContent = 'favorite';
            btn.classList.add('text-primary', 'bg-primary/20');
            btn.classList.remove('text-outline', 'bg-surface/80');
            showHomeNotification('Sản phẩm đã được thêm vào wishlist');
        } else {
            if (r.status === 401) {
                showHomeNotification('Vui lòng đăng nhập để thêm sản phẩm vào wishlist');
                setTimeout(() => {
                    window.location.href = '{{ route("login") }}';
                }, 2000);
            } else {
                showHomeNotification(data.message || 'Có lỗi xảy ra');
            }
        }
    })
    .catch(err => {
        console.error('Error:', err);
        showHomeNotification('Có lỗi xảy ra khi thêm vào wishlist');
    });
}

function removeHomeFromWishlist(wishlistId, btn) {
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
            const icon = btn.querySelector('.home-wishlist-icon');
            icon.textContent = 'favorite_border';
            btn.classList.remove('text-primary', 'bg-primary/20');
            btn.classList.add('text-outline', 'bg-surface/80');
            showHomeNotification('Sản phẩm đã được xóa khỏi wishlist');
        } else {
            if (r.status === 401) {
                showHomeNotification('Vui lòng đăng nhập để xóa sản phẩm khỏi wishlist');
                setTimeout(() => {
                    window.location.href = '{{ route("login") }}';
                }, 2000);
            } else {
                showHomeNotification(data.message || 'Có lỗi xảy ra');
            }
        }
    })
    .catch(err => {
        console.error('Error:', err);
        showHomeNotification('Có lỗi xảy ra khi xóa khỏi wishlist');
    });
}

function checkHomeWishlistStatus(productId, btn) {
    fetch(`${window.location.origin}/api/wishlist/check/${productId}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(r => r.json())
    .then(data => {
        const icon = btn.querySelector('.home-wishlist-icon');
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

function showHomeNotification(message) {
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