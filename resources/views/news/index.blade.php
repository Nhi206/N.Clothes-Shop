<x-client-layout title="Tin tức">
    <section class="bg-gradient-to-br from-primary/10 via-primary/5 to-secondary/10 py-20">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl text-center mx-auto mb-12">
                <p class="text-sm uppercase tracking-[0.4em] text-outline mb-4">Blog</p>
                <h1 class="text-4xl md:text-5xl font-bold text-primary mb-4">Cập nhật tin tức mới nhất</h1>
                <p class="text-lg text-outline-variant leading-relaxed">Đọc các bài viết mới nhất về xu hướng thời trang, ưu đãi và thiết kế áo thun cá nhân hóa.</p>
            </div>

            <div class="grid gap-6 xl:grid-cols-3">
                @forelse($newsItems as $news)
                    <article class="group rounded-[2rem] overflow-hidden border border-surface-container bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="h-64 overflow-hidden">
                            <img src="{{ $news->image_url ?? '/images/no-image.png' }}" alt="{{ $news->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                        </div>
                        <div class="p-6">
                            <div class="mb-4 flex items-center justify-between gap-3 text-sm text-outline-variant">
                                <span class="rounded-full bg-primary/10 px-3 py-1 font-semibold text-primary">Blog</span>
                                <span>{{ $news->created_at?->format('d/m/Y') ?? 'Mới' }}</span>
                            </div>
                            <h2 class="text-2xl font-semibold text-primary mb-3">{{ Str::limit($news->title, 65) }}</h2>
                            <p class="text-sm text-outline-variant mb-6 leading-relaxed">{{ Str::limit($news->content, 120) }}</p>
                            <div class="flex items-center justify-between gap-4">
                                <div class="text-sm text-outline-variant">{{ $news->author?->name ?? 'N.clothes' }}</div>
                                <a href="{{ route('news.show', $news) }}" class="inline-flex items-center gap-2 text-primary font-semibold hover:text-primary-container transition">
                                    Xem bài viết
                                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-[2rem] border border-surface-container bg-white p-12 text-center shadow-sm">
                        <p class="text-xl text-outline-variant">Hiện chưa có bài viết nào. Vui lòng quay lại sau.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12 flex justify-center">
                {{ $newsItems->links() }}
            </div>
        </div>
    </section>
</x-client-layout>
