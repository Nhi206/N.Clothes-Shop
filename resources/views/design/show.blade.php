<x-client-layout title="Xem thiết kế">
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
    $fabricColor = $designData['fabricColor'] ?? $designData['fabric_color'] ?? null;
    // Hiển thị tên màu nếu có mapping, nếu không hiển thị trực tiếp mã hex màu
    $fabricColorName = 'Mặc định';
    if ($fabricColor) {
        $fabricColorName = $colorNames[$fabricColor] ?? strtoupper($fabricColor);
    }

    $designText = $designData['text'] ?? $designData['design_text'] ?? null;
    $designFontFamily = $designData['fontFamily'] ?? $designData['font_family'] ?? 'Inter';
    $designFontSize = $designData['fontSize'] ?? $designData['font_size'] ?? 28;
    $designTextColor = $designData['textColor'] ?? $designData['text_color'] ?? '#ffffff';
@endphp
<div class="max-w-6xl mx-auto px-6 py-10">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-primary">Xem thiết kế của bạn</h1>
            <p class="text-sm text-outline-variant">Kiểm tra lại thông tin và nội dung trước khi đặt hàng.</p>
        </div>
        <a href="{{ route('design.list') }}" class="rounded-3xl border border-surface-container bg-surface px-4 py-3 text-sm font-semibold text-primary hover:bg-primary/5 transition">Quay lại danh sách thiết kế</a>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <section class="col-span-12 xl:col-span-8 bg-white rounded-3xl p-6 shadow-sm">
            <div class="mb-6">
                <p class="text-xs uppercase tracking-[0.3em] text-outline-variant">Thiết kế của bạn</p>
                <h2 class="text-2xl font-bold text-primary">{{ $design->product->name }}</h2>
            </div>

            <div class="rounded-[2rem] border border-outline-variant bg-slate-950 p-6 overflow-hidden">
                @if($design->preview_image)
                    <div class="grid gap-4 xl:grid-cols-2">
                        <div class="rounded-3xl bg-slate-900 p-4 text-center">
                            <div class="mb-3 text-sm font-semibold text-white">Mặt trước</div>
                            <img src="{{ asset('storage/' . ($design->preview_image_front ?? $design->preview_image)) }}" alt="Mặt trước" class="mx-auto max-h-[420px] w-full object-contain rounded-3xl shadow-lg" />
                        </div>
                        <div class="rounded-3xl bg-slate-900 p-4 text-center">
                            <div class="mb-3 text-sm font-semibold text-white">Mặt sau</div>
                            <img src="{{ asset('storage/' . ($design->preview_image_back ?? $design->preview_image)) }}" alt="Mặt sau" class="mx-auto max-h-[420px] w-full object-contain rounded-3xl shadow-lg" />
                        </div>
                    </div>
                    
                @else
                    <div class="flex h-[480px] items-center justify-center rounded-3xl bg-slate-800 text-center text-slate-300">
                        <span>Không có ảnh thiết kế. Vui lòng kiểm tra nội dung chữ hoặc tải lại file.</span>
                    </div>
                @endif
            </div>
        </section>

        <aside class="col-span-12 xl:col-span-4 bg-surface rounded-3xl border border-outline-variant p-6 shadow-sm">
            <div class="space-y-5">
                <div class="rounded-3xl bg-white p-5 border border-surface-container shadow-sm">
                    <h3 class="text-lg font-semibold text-primary mb-3">Chi tiết thiết kế</h3>
                    <div class="space-y-3 text-sm text-outline-variant">
                        <p><span class="font-semibold text-primary">Mẫu:</span> {{ $design->product->name }}</p>
                        <p><span class="font-semibold text-primary">Màu áo:</span> {{ $fabricColorName }}</p>
                        <p><span class="font-semibold text-primary">Size:</span> {{ $designData['size'] ?? 'S' }}</p>
                        <p><span class="font-semibold text-primary">Text:</span> {{ $designText ?? '—' }}</p>
                        <p><span class="font-semibold text-primary">Font:</span> {{ $designFontFamily }}</p>
                        <p><span class="font-semibold text-primary">Màu chữ:</span> {{ $designTextColor }}</p>
                    </div>
                </div>

                <div class="rounded-3xl bg-white p-5 border border-surface-container shadow-sm">
                    <h3 class="text-lg font-semibold text-primary mb-3">Lưu ý</h3>
                    <p class="text-sm text-outline-variant">Khi bạn đặt hàng sau khi thiết kế, file thiết kế sẽ được liên kết với đơn hàng. Sau khi đơn hàng hoàn tất và giao hàng thành công, file thiết kế sẽ được xóa khỏi hệ thống trong vòng 7 ngày.</p>
                </div>
            </div>
        </aside>
    </div>
</div>
</x-client-layout>
