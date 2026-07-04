<x-client-layout title="Thiết kế của bạn">
    <div class="max-w-6xl mx-auto px-6 py-10">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-primary">Thiết kế đã tạo</h1>
                <p class="text-sm text-outline-variant">Xem lại các thiết kế bạn đã lưu và tiếp tục đặt hàng hoặc chỉnh sửa.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('design.index') }}" class="rounded-3xl border border-surface-container bg-surface px-4 py-3 text-sm font-semibold text-primary hover:bg-primary/5 transition">Tạo thiết kế mới</a>
            </div>
        </div>

        @if($designs->isEmpty())
            <div class="bg-surface rounded-3xl p-12 text-center shadow-sm">
                <span class="material-symbols-outlined text-primary text-5xl">palette</span>
                <h2 class="mt-6 text-2xl font-bold text-primary">Bạn chưa có thiết kế nào</h2>
                <p class="mt-2 text-sm text-outline-variant">Tạo thiết kế mới để lưu vào thư viện cá nhân của bạn.</p>
                <a href="{{ route('design.index') }}" class="mt-6 inline-flex items-center gap-2 rounded-3xl bg-primary px-6 py-3 text-sm font-semibold text-white hover:bg-primary-container transition">
                    <span class="material-symbols-outlined">add</span>
                    Tạo thiết kế mới
                </a>
            </div>
        @else
            <div class="grid gap-6 md:grid-cols-2">
                @foreach($designs as $design)
                        @php
                        $designData = $design->design_data ?? [];
                        $colorNames = [
                            '#ffffff' => 'Trắng',
                            '#ff0000' => 'Đỏ',
                            '#0000ff' => 'Xanh dương',
                            '#008000' => 'Xanh lá',
                            '#ffff00' => 'Vàng',
                            '#800080' => 'Tím',
                            '#ffa500' => 'Cam',
                            '#ffc0cb' => 'Hồng',
                            '#000000' => 'Đen',
                        ];
                        $fabricColor = $designData['fabricColor'] ?? null;
                        // Nếu màu có trong danh sách, hiển thị tên, nếu không hiển thị giá trị màu (hex)
                        $fabricColorName = 'Mặc định';
                        if ($fabricColor) {
                            $fabricColorName = $colorNames[$fabricColor] ?? strtoupper($fabricColor);
                        }
                    @endphp
                    <div class="rounded-3xl bg-white border border-outline-variant p-6 shadow-sm">
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-primary">{{ $designData['product_name'] ?? $design->product->name }}</h3>
                            <p class="text-sm text-outline-variant">{{ $design->created_at->format('d/m/Y H:i') }}</p>
                        </div>

                        <div class="mb-4 rounded-3xl overflow-hidden bg-slate-950 p-4">
                            @if($design->preview_image)
                                <div class="grid gap-2 md:grid-cols-2">
                                    <div class="rounded-3xl bg-slate-900 overflow-hidden p-2 text-center">
                                        <div class="mb-2 text-xs font-semibold text-white">Mặt trước</div>
                                        <img src="{{ asset('storage/' . ($design->preview_image_front ?? $design->preview_image)) }}" alt="Mặt trước" class="mx-auto h-40 w-full object-contain" />
                                    </div>
                                    <div class="rounded-3xl bg-slate-900 overflow-hidden p-2 text-center">
                                        <div class="mb-2 text-xs font-semibold text-white">Mặt sau</div>
                                        <img src="{{ asset('storage/' . ($design->preview_image_back ?? $design->preview_image)) }}" alt="Mặt sau" class="mx-auto h-40 w-full object-contain" />
                                    </div>
                                </div>
                            @else
                                <div class="flex h-60 items-center justify-center bg-slate-900 text-center text-slate-300 p-6">
                                    <span>Không có ảnh xem trước.</span>
                                </div>
                            @endif
                        </div>

                        <div class="space-y-2 text-sm text-outline-variant mb-4">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-primary">Màu áo:</span>
                                <span class="inline-flex items-center gap-2">
                                    <span class="h-3 w-3 rounded-full" style="background-color: {{ $designData['fabricColor'] ?? '#000000' }};"></span>
                                    <span>{{ $fabricColorName }}</span>
                                </span>
                            </div>
                            <p><span class="font-semibold text-primary">Size:</span> {{ $designData['size'] ?? 'S' }}</p>
                            <p><span class="font-semibold text-primary">Text:</span> {{ $designData['text'] ?? '—' }}</p>
                            <p><span class="font-semibold text-primary">Font:</span> {{ $designData['font_family'] ?? 'Inter' }}</p>
                            <p><span class="font-semibold text-primary">Màu chữ:</span> {{ $designData['text_color'] ?? '#ffffff' }}</p>
                            <p><span class="font-semibold text-primary">Kích thước logo:</span> {{ $designData['image_size'] ?? '100' }}%</p>
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row">
                            <a href="{{ route('design.show', $design->id) }}" class="flex-1 rounded-3xl bg-primary px-4 py-3 text-center text-sm font-semibold text-white hover:bg-primary-container transition">Xem chi tiết</a>
                            <a href="{{ route('design.index') }}" class="flex-1 rounded-3xl border border-outline-variant px-4 py-3 text-center text-sm font-semibold text-primary hover:bg-surface transition">Tạo lại</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-client-layout>
