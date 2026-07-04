<!-- Navigation -->
<nav class="bg-white/95 border-b border-surface-container/80 backdrop-blur-xl shadow-sm fixed inset-x-0 top-0 z-50">
    <div class="container mx-auto px-6 py-3">
        <div class="flex items-center justify-between gap-4">
            <a class="flex items-center gap-3" href="{{ route('products.index') }}">
                <div class="w-12 h-12 rounded-3xl bg-primary flex items-center justify-center text-white shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined text-2xl">checkroom</span>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-outline-variant mb-1">Digital Tailor</p>
                    <h1 class="text-2xl font-bold text-primary">N.clothes</h1>
                </div>
            </a>

            <button class="navbar-toggler inline-flex items-center justify-center rounded-full border border-surface-container bg-white p-2 text-primary lg:hidden" type="button" data-bs-toggle="collapse" data-bs-target="#clientNavbar">
                <span class="material-symbols-outlined text-3xl">menu</span>
            </button>

            <div class="hidden lg:flex lg:items-center lg:justify-between lg:flex-1 lg:gap-6">
                <div class="flex items-center gap-4 text-sm font-medium text-outline-variant">
                    <a href="{{ route('home') }}" class="text-on-background hover:text-primary transition">Trang chủ</a>
                    <a href="{{ route('products.index') }}" class="text-on-background hover:text-primary transition">Sản phẩm</a>
                    <a href="{{ route('design.index') }}" class="text-on-background hover:text-primary transition">Thiết kế</a>
                    <a href="{{ route('news.index') }}" class="text-on-background hover:text-primary transition">Tin tức</a>
                    <a href="{{ route('orders.index') }}" class="text-on-background hover:text-primary transition">Đơn hàng</a>
                </div>

                <form action="{{ route('products.index') }}" method="GET" class="w-full max-w-[420px]">
                    <label for="search" class="sr-only">Tìm kiếm sản phẩm</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
                        <input id="search" name="search" value="{{ request('search') }}" type="text" placeholder="Tìm sản phẩm, thiết kế, danh mục..."
                            class="w-full rounded-full border border-surface-container bg-surface py-3 pl-12 pr-4 text-sm text-on-surface shadow-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20" />
                    </div>
                </form>

                <div class="flex items-center gap-3">
                    @guest
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-full border border-surface-container bg-white px-4 py-2 text-sm font-semibold text-primary shadow-sm transition hover:bg-primary/5">
                        <span class="material-symbols-outlined text-base">login</span>
                        Đăng nhập
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-primary px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-primary/20 transition hover:bg-primary-container">
                        <span class="material-symbols-outlined text-base">person_add</span>
                        Đăng ký
                    </a>
                    @else
                    <a href="{{ route('wishlist.index') }}" class="relative rounded-full bg-surface px-3 py-2 text-primary hover:bg-primary/10 transition" title="Yêu thích">
                        <span class="material-symbols-outlined">favorite</span>
                        <span id="wishlist-count" class="absolute -top-1 -right-1 bg-primary text-white text-xs rounded-full w-5 h-5 flex items-center justify-center" style="display: none;">0</span>
                    </a>
                    <a href="{{ route('cart.index') }}" class="relative rounded-full bg-surface px-3 py-2 text-primary hover:bg-primary/10 transition" title="Giỏ hàng">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        <span id="cart-count" class="absolute -top-1 -right-1 bg-primary text-white text-xs rounded-full w-5 h-5 flex items-center justify-center" style="display: none;">0</span>
                    </a>
                    <div class="dropdown">
                        <button onclick="toggleUserMenu(event)" class="inline-flex items-center gap-2 rounded-full border border-surface-container bg-white px-4 py-2 text-sm font-semibold text-primary shadow-sm transition hover:bg-primary/5" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="w-8 h-8 rounded-full object-cover" alt="User" src="https://lh3.googleusercontent.com/a/default-user=s64" onerror="this.src='https://via.placeholder.com/32x32?text=U'">
                            <span>{{ Auth::user()->name }}</span>
                            <span class="material-symbols-outlined text-base">expand_more</span>
                        </button>
                        <div id="userMenu" class="absolute right-0 top-full mt-2 w-48 bg-white white:bg-[#191b22] rounded-3xl shadow-lg border border-outline-variant/10 hidden z-50">
                            <div class="p-2">
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2 text-sm hover:bg-surface-container rounded-2xl transition-colors">
                                    <span class="material-symbols-outlined text-lg">person</span>
                                    <span>Profile</span>
                                </a>
                                <a href="{{ route('settings.edit') }}" class="flex items-center gap-3 px-3 py-2 text-sm hover:bg-surface-container rounded-2xl transition-colors">
                                    <span class="material-symbols-outlined text-lg">settings</span>
                                    <span>Settings</span>
                                </a>
                                <hr class="my-2 border-outline-variant/10">
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 px-3 py-2 text-sm hover:bg-surface-container rounded-2xl transition-colors w-full text-left">
                                        <span class="material-symbols-outlined text-lg">logout</span>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endguest
                </div>
            </div>
        </div>

        <div class="collapse navbar-collapse mt-3 lg:hidden" id="clientNavbar">
            <div class="flex flex-col gap-4">
                <form action="{{ route('products.index') }}" method="GET">
                    <label for="mobile-search" class="sr-only">Tìm kiếm sản phẩm</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
                        <input id="mobile-search" name="search" value="{{ request('search') }}" type="text" placeholder="Tìm sản phẩm, thiết kế, danh mục..."
                            class="w-full rounded-full border border-surface-container bg-surface py-3 pl-12 pr-4 text-sm text-on-surface shadow-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20" />
                    </div>
                </form>
                <div class="flex flex-col gap-2 text-sm font-medium text-outline-variant">
                    <a href="{{ route('products.index') }}" class="rounded-2xl border border-surface-container bg-surface px-4 py-3 hover:bg-primary/10 transition">Trang chủ</a>
                    <a href="{{ route('products.index') }}" class="rounded-2xl border border-surface-container bg-surface px-4 py-3 hover:bg-primary/10 transition">Sản phẩm</a>
                    <a href="{{ route('design.index') }}" class="rounded-2xl border border-surface-container bg-surface px-4 py-3 hover:bg-primary/10 transition">Thiết kế</a>
                    <a href="{{ route('news.index') }}" class="rounded-2xl border border-surface-container bg-surface px-4 py-3 hover:bg-primary/10 transition">Tin tức</a>
                    <a href="{{ route('orders.index') }}" class="rounded-2xl border border-surface-container bg-surface px-4 py-3 hover:bg-primary/10 transition">Đơn hàng</a>
                </div>
                <div class="flex flex-wrap items-center gap-2 text-sm text-outline-variant">
                    <a href="{{ route('products.index') }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 hover:bg-primary/10 transition">Áo thun</a>
                    <a href="{{ route('products.index') }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 hover:bg-primary/10 transition">Áo hoodie</a>
                    <a href="{{ route('products.index') }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 hover:bg-primary/10 transition">Áo khoác</a>
                    <a href="{{ route('products.index') }}" class="rounded-full border border-surface-container bg-surface px-4 py-2 hover:bg-primary/10 transition">Design tool</a>
                </div>
                <div class="rounded-full border border-surface-container bg-surface px-4 py-2 text-center text-sm">Miễn phí giao hàng cho đơn hàng trên 500.000₫</div>
            </div>
        </div>
    </div>
</nav>
<div class="h-[138px]"></div>
<script>
    function toggleUserMenu() {
        event.stopPropagation();
        const menu = document.getElementById('userMenu');
        menu.classList.toggle('hidden');
    }

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const menu = document.getElementById('userMenu');
        const button = event.target.closest('button[onclick="toggleUserMenu()"]');
        if (!button && !menu.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
</script>