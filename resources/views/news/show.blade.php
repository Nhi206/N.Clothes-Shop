<x-client-layout title="{{ Str::limit($news->title, 40) }}">
    <section class="py-20 bg-surface-container/80">
        <div class="container mx-auto px-6 lg:max-w-4xl">
            <div class="mb-10">
                <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 text-primary font-semibold hover:text-primary-container transition mb-6">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Quay lại tin tức
                </a>
                <div class="rounded-[2rem] overflow-hidden border border-surface-container bg-white shadow-sm">
                    <div class="h-80 overflow-hidden">
                        <img src="{{ $news->image_url ?? '/images/no-image.png' }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-8">
                        <div class="mb-4 flex flex-wrap items-center gap-3 text-sm text-outline-variant">
                            <span class="rounded-full bg-primary/10 px-3 py-1 font-semibold text-primary">Tin tức</span>
                            <span>{{ $news->created_at?->format('d/m/Y') ?? 'Mới' }}</span>
                            <span>{{ $news->author?->name ?? 'N.clothes' }}</span>
                        </div>
                        <h1 class="text-4xl font-bold text-primary mb-6">{{ $news->title }}</h1>
                        <div class="space-y-6 text-outline-variant">
                            <p>{{ $news->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-client-layout>
