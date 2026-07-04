<!-- Sidebar -->
    <div class="col-span-12 lg:col-span-3">
        <div class="bg-surface-container rounded-3xl p-6 shadow-sm">
            <h5 class="text-lg font-bold text-primary mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined">filter_list</span>
                Bộ lọc
            </h5>

            <!-- Categories -->
            <div class="mb-6">
                <h6 class="font-bold text-primary uppercase tracking-widest text-xs mb-4">DANH MỤC</h6>
                <div class="space-y-2">
                    @foreach($categories as $category)
                        <a href="{{ route('products.category', $category->id) }}"
                           class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-surface-container-highest transition-colors {{ request('category') == $category->id ? 'bg-primary text-white' : 'text-outline' }}">
                            <span class="material-symbols-outlined text-sm">category</span>
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Search & Filters -->
            <form method="GET" action="{{ route('products.index') }}">
                <div class="mb-4">
                    <label class="block text-xs font-bold text-primary uppercase tracking-widest mb-2">TÌM KIẾM</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-sm">search</span>
                        <input type="text" name="search" class="bg-surface border-none text-sm pl-10 pr-4 py-2 rounded-lg focus:ring-1 focus:ring-primary-container w-full" placeholder="Tên sản phẩm..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold text-primary uppercase tracking-widest mb-2">GIÁ (VND)</label>
                    <div class="grid grid-cols-2 gap-2">
                        <input type="number" name="min_price" class="bg-surface border-none text-sm px-3 py-2 rounded-lg focus:ring-1 focus:ring-primary-container" placeholder="Từ" value="{{ request('min_price') }}">
                        <input type="number" name="max_price" class="bg-surface border-none text-sm px-3 py-2 rounded-lg focus:ring-1 focus:ring-primary-container" placeholder="Đến" value="{{ request('max_price') }}">
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary text-white py-2 rounded-xl font-semibold hover:bg-primary-container transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">filter_alt</span>
                    Áp dụng
                </button>
            </form>
        </div>
    </div>

    