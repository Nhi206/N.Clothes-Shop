<x-client-layout title="{{ $category->name }}">
<div class="max-w-[1440px] mx-auto px-8 py-12">
<div class="grid grid-cols-12 gap-8">
    <!-- Sidebar -->
    <div class="col-span-12 lg:col-span-3">
        <div class="bg-surface rounded-3xl p-6 shadow-sm">
            @include('products.sidebar')
        </div>
    </div>
    <!-- Products Grid -->
    <div class="col-span-12 lg:col-span-9">
        <div class="space-y-8">
            
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-4xl">category</span>
                <h1 class="text-3xl font-bold text-primary">{{ $category->name }}</h1>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="bg-surface rounded-3xl overflow-hidden shadow-sm group">
                            <div class="relative">
                                <img src="{{ $product->images->first() ? asset($product->images->first()->image_url) : asset('images/no-image.png') }}"
                                     class="w-full h-64 object-cover group-hover:scale-105 transition-transform" alt="{{ $product->name }}">
                                <button class="absolute top-3 right-3 w-8 h-8 rounded-full bg-surface/80 flex items-center justify-center text-outline hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg">favorite</span>
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
                                    <button class="flex-1 bg-primary text-white py-2 rounded-xl font-semibold hover:bg-primary-container transition-colors flex items-center justify-center gap-1">
                                        <span class="material-symbols-outlined text-sm">add_shopping_cart</span>
                                        Thêm
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-center mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="bg-surface rounded-3xl p-12 text-center shadow-sm">
                    <div class="mb-6">
                        <span class="material-symbols-outlined text-outline text-7xl">inventory_2</span>
                    </div>
                    <h3 class="text-outline mb-4">Không có sản phẩm trong danh mục này</h3>
                    <p class="text-outline-variant mb-6">Hãy chọn danh mục khác để xem sản phẩm</p>
                    <a href="{{ route('products.index') }}" class="bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-primary-container transition-colors inline-flex items-center gap-2">
                        <span class="material-symbols-outlined">shopping_bag</span>
                        Xem tất cả sản phẩm
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
</div>
</x-client-layout>