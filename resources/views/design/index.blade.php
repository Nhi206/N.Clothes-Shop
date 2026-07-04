<x-client-layout title="Thiết kế áo">
    <div class="max-w-[1440px] mx-auto px-6 py-10">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-8">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary text-4xl">palette</span>
                <div>
                    <h1 class="text-3xl font-bold text-primary">Custom Studio</h1>
                    <p class="text-sm text-outline-variant">Thiết kế theo phong cách riêng của bạn</p>
                </div>
            </div>
            <div class="inline-flex items-center gap-2 rounded-full border border-surface-container bg-surface px-4 py-2 text-sm text-outline-variant">
                <span class="font-semibold text-primary">Bespoke</span>
                <span>•</span>
                <span>Design tool</span>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('design.list') }}" class="rounded-3xl border border-surface-container bg-white px-4 py-3 text-sm font-semibold text-primary hover:bg-primary/5 transition">
                    Xem thiết kế đã tạo
                </a>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <aside class="col-span-12 xl:col-span-3 bg-surface rounded-3xl border border-outline-variant p-6 shadow-sm">
                <div class="mb-6">
                    <p class="text-xs uppercase tracking-[0.3em] text-outline-variant">Thiết kế sản phẩm</p>

                </div>

                <div class="space-y-6">
                    <div class="rounded-3xl bg-white p-5 border border-surface-container shadow-sm">
                        <p class="text-xs uppercase tracking-[0.3em] text-outline-variant mb-3">Chọn mẫu</p>
                        <div class="grid grid-cols-2 gap-3">
                            <button type="button" class="product-template-button rounded-3xl border border-surface-container bg-white py-4 text-sm font-semibold text-primary hover:border-primary transition" data-product-id="1" data-product-name="Áo thun basic" data-product-image="{{ asset('images/shirt-trang.png') }}">Áo thun basic</button>
                            <button type="button" class="product-template-button rounded-3xl border border-surface-container bg-white py-4 text-sm font-semibold text-primary hover:border-primary transition" data-product-id="1" data-product-name="Túi tote" data-product-image="{{ asset('images/tui-trang.png') }}" data-back-image="{{ asset('images/tui-trang.png') }}">Túi tote</button>
                            <button type="button" class="product-template-button rounded-3xl border border-surface-container bg-white py-4 text-sm font-semibold text-primary hover:border-primary transition" data-product-id="1" data-product-name="Áo sweater" data-product-image="{{ asset('images/sw-trang.png') }}" data-back-image="{{ asset('images/sw-trang.png') }}">Áo sweater</button>
                            <button type="button" class="product-template-button rounded-3xl border border-surface-container bg-white py-4 text-sm font-semibold text-primary hover:border-primary transition" data-product-id="1" data-product-name="Mũ lưỡi trai" data-product-image="{{ asset('images/luoi-trang.png') }}" data-back-image="{{ asset('images/luoi-trang.png') }}">Mũ lưỡi trai</button>
                            <button type="button" class="product-template-button rounded-3xl border border-surface-container bg-white py-4 text-sm font-semibold text-primary hover:border-primary transition" data-product-id="1" data-product-name="Áo hoodie" data-product-image="{{ asset('images/hoodie.jpg') }}" data-back-image="{{ asset('images/hoodie.jpg') }}">Áo hoodie</button>
                            <button type="button" class="product-template-button rounded-3xl border border-surface-container bg-white py-4 text-sm font-semibold text-primary hover:border-primary transition" data-product-id="1" data-product-name="Mũ bucket" data-product-image="{{ asset('images/bucket-trang.png') }}" data-back-image="{{ asset('images/bucket-trang.png') }}">Mũ bucket</button>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-white p-5 border border-surface-container shadow-sm">
                        <p class="text-xs uppercase tracking-[0.3em] text-outline-variant mb-3">Màu sản phẩm</p>
                        <div id="shirtColorPalette" class="grid grid-cols-4 gap-3">
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-slate-950 border border-outline-variant" data-color="#000000" data-image="{{ asset('images/shirt_den.png') }}" data-back-image="{{ asset('images/den.png') }}"></button>
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-white border border-outline-variant" data-color="#ffffff" data-image="{{ asset('images/shirt-trang.png') }}" data-back-image="{{ asset('images/trang.png') }}"></button>
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-red-500 border border-outline-variant" data-color="#ef4444" data-image="{{ asset('images/shirt-do.png') }}" data-back-image="{{ asset('images/do.png') }}"></button>
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-pink-500 border border-outline-variant" data-color="#ec4899" data-image="{{ asset('images/shirt-hong.png') }}" data-back-image="{{ asset('images/hong.png') }}"></button>
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-amber-500 border border-outline-variant" data-color="#f59e0b" data-image="{{ asset('images/shirt-vang.png') }}" data-back-image="{{ asset('images/vang.png') }}"></button>
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-blue-500 border border-outline-variant" data-color="#6a73e9" data-image="{{ asset('images/shirt-xanh.png') }}" data-back-image="{{ asset('images/xanh.png') }}"></button>
                        </div>
                        <div id="toteColorPalette" class="hidden grid grid-cols-3 gap-3">
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-slate-950 border border-outline-variant" data-color="#000000" data-image="{{ asset('images/tui-den.png') }}" data-back-image="{{ asset('images/tui-den.png') }}"></button>
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-white border border-outline-variant" data-color="#ffffff" data-image="{{ asset('images/tui-trang.png') }}" data-back-image="{{ asset('images/tui-trang.png') }}"></button>
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-[#e8d7b7] border border-outline-variant" data-color="#e8d7b7" data-image="{{ asset('images/tui-be.png') }}" data-back-image="{{ asset('images/tui-be.png') }}"></button>
                        </div>
                        <div id="bucketColorPalette" class="hidden grid grid-cols-2 gap-3">
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-slate-950 border border-outline-variant" data-color="#000000" data-image="{{ asset('images/bucket-den.png') }}" data-back-image="{{ asset('images/bucket-den.png') }}"></button>
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-white border border-outline-variant" data-color="#ffffff" data-image="{{ asset('images/bucket-trang.png') }}" data-back-image="{{ asset('images/bucket-trang.png') }}"></button>
                        </div>
                        <div id="capColorPalette" class="hidden grid grid-cols-4 gap-3">
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-slate-950 border border-outline-variant" data-color="#000000" data-image="{{ asset('images/luoi-den.png') }}" data-back-image="{{ asset('images/luoi-den.png') }}"></button>
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-red-500 border border-outline-variant" data-color="#ef4444" data-image="{{ asset('images/luoi-do.png') }}" data-back-image="{{ asset('images/luoi-do.png') }}"></button>
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-white border border-outline-variant" data-color="#ffffff" data-image="{{ asset('images/luoi-trang.png') }}" data-back-image="{{ asset('images/luoi-trang.png') }}"></button>
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-amber-500 border border-outline-variant" data-color="#f59e0b" data-image="{{ asset('images/luoi-cam.png') }}" data-back-image="{{ asset('images/luoi-cam.png') }}"></button>
                        </div>
                        <div id="sweaterColorPalette" class="hidden grid grid-cols-2 gap-3">
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-amber-500 border border-outline-variant" data-color="#f59e0b" data-image="{{ asset('images/sw-vang.png') }}" data-back-image="{{ asset('images/sw-vang.png') }}"></button>
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-white border border-outline-variant" data-color="#ffffff" data-image="{{ asset('images/sw-trang.png') }}" data-back-image="{{ asset('images/sw-trang.png') }}"></button>
                        </div>
                        <div id="hoodieColorPalette" class="hidden grid grid-cols-3 gap-3">
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-slate-950 border border-outline-variant" data-color="#000000" data-image="{{ asset('images/den-truoc.png') }}" data-back-image="{{ asset('images/den-sau.png') }}"></button>
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-red-500 border border-outline-variant" data-color="#ef4444" data-image="{{ asset('images/do-truoc.png') }}" data-back-image="{{ asset('images/do-sau.png') }}"></button>
                            <button type="button" class="fabric-color-button h-12 rounded-3xl bg-gray-400 border border-outline-variant" data-color="#9ca3af" data-image="{{ asset('images/xam-truoc.png') }}" data-back-image="{{ asset('images/xam-sau.png') }}"></button>
                        </div>
                    </div>

                    <div id="sizeSelector" class="rounded-3xl bg-white p-5 border border-surface-container shadow-sm">
                        <p class="text-xs uppercase tracking-[0.3em] text-outline-variant mb-3">Size</p>
                        <div class="grid grid-cols-2 gap-3">
                            <button type="button" class="size-button rounded-3xl border border-surface-container bg-white py-4 text-sm font-semibold text-primary">S</button>
                            <button type="button" class="size-button rounded-3xl border border-surface-container bg-white py-4 text-sm font-semibold text-primary">M</button>
                            <button type="button" class="size-button rounded-3xl border border-surface-container bg-white py-4 text-sm font-semibold text-primary">L</button>
                            <button type="button" class="size-button rounded-3xl border border-surface-container bg-white py-4 text-sm font-semibold text-primary">XL</button>
                        </div>
                    </div>
                </div>
            </aside>

            <section class="col-span-12 xl:col-span-5 bg-surface rounded-3xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-outline-variant">Product preview</p>
                        <h2 class="text-2xl font-bold text-primary">Your custom tee</h2>
                        <p id="selectedProductName" class="text-sm text-outline-variant mt-1"></p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" class="view-toggle-button rounded-full border border-primary bg-primary px-3 py-2 text-xs font-semibold text-white" data-view="front">Mặt trước</button>
                        <button type="button" class="view-toggle-button rounded-full border border-primary bg-white px-3 py-2 text-xs font-semibold text-primary" data-view="back">Mặt sau</button>
                    </div>
                </div>

                <div class="relative bg-white rounded-[2rem] p-8 shadow-[0_40px_80px_rgba(18,31,74,0.08)]">
                    <button id="resetButton" class="absolute top-4 right-4 bg-white/80 hover:bg-white p-3 rounded-full shadow-lg transition z-50">
                        <span class="material-symbols-outlined text-primary">refresh</span>
                    </button>

                    <div id="designCanvas" class="relative h-[520px] rounded-[2rem] border border-dashed border-outline-variant overflow-hidden bg-white flex items-center justify-center">
                        <div class="relative max-h-full max-w-full flex items-center justify-center p-6">
                            <!-- Lớp màu áo: Sẽ được JS tính toán lại width/height/top/left -->
                            <div id="shirtColorLayer" class="z-10 pointer-events-none" style="position: absolute;"></div>

                            <!-- Ảnh áo gốc: Layer nếp nhăn -->
                            <img id="canvasProductImage"
                                src="{{ asset('images/shirt-trang.png') }}"
                                alt="Design preview"
                                class="max-h-[480px] w-auto object-contain relative z-10 pointer-events-none"
                                style="mix-blend-mode: normal;">

                            <div id="canvasOverlay" class="absolute inset-0 flex flex-col items-center justify-center z-20">
                                <img id="canvasUploadPreview" src="" class="hidden max-h-[200px] object-contain mb-4">
                                <p id="canvasTextPreview" class="text-white text-3xl font-bold text-center leading-tight"></p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex gap-3 justify-center">
                        <button id="tryOnButton" type="button" class="rounded-3xl bg-primary text-white px-6 py-3 text-sm font-semibold hover:bg-primary-container transition flex items-center gap-2">
                            <span class="material-symbols-outlined">checkroom</span>
                            Mặc thử áo
                        </button>
                        <input
                            type="file"
                            id="personImageInput"
                            accept="image/*"
                            hidden>

                        <div id="tryOnModal"
                            class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 overflow-auto">

                            <div class="bg-white rounded-3xl max-w-3xl w-full my-auto shadow-2xl">
                                <div class="p-6 border-b border-outline-variant">
                                    <div class="flex items-center justify-between">
                                        <h3 class="font-bold text-xl text-primary flex items-center gap-2">
                                            <span class="material-symbols-outlined">checkroom</span>
                                            Kết quả mặc thử áo
                                        </h3>
                                        <button
                                            id="closeTryOnModal"
                                            type="button"
                                            class="text-outline-variant hover:text-primary transition">
                                            <span class="material-symbols-outlined">close</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="p-6">
                                    <img id="tryOnResultImage" class="w-full rounded-2xl object-cover max-h-[600px]" alt="Try-on result">
                                </div>

                                <div class="p-6 border-t border-outline-variant flex gap-3 justify-end">
                                    <button
                                        id="closeTryOnButton"
                                        type="button"
                                        class="px-6 py-3 rounded-3xl border border-outline-variant text-primary hover:bg-surface transition">
                                        Đóng
                                    </button>
                                    <button
                                        id="tryAgainButton"
                                        type="button"
                                        class="px-6 py-3 rounded-3xl bg-secondary text-white hover:bg-secondary-container transition flex items-center gap-2">
                                        <span class="material-symbols-outlined">refresh</span>
                                        Thử lại
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <aside class="col-span-12 xl:col-span-4 bg-surface rounded-3xl border border-outline-variant p-6 shadow-sm">
                <div class="mb-6">
                    <p class="text-xs uppercase tracking-[0.3em] text-outline-variant">Chèn chữ & logo</p>

                </div>

                <div class="space-y-6">
                    <div class="rounded-3xl bg-white p-5 border border-surface-container shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <p class="text-xs uppercase tracking-[0.3em] text-outline-variant">Add custom text</p>
                            <span id="selectedSizeLabel" class="text-xs text-primary font-semibold"></span>
                        </div>
                        <textarea id="designText" name="design_notes" rows="5" class="w-full rounded-3xl border border-outline-variant bg-surface px-4 py-4 text-sm text-on-surface outline-none focus:border-primary focus:ring-1 focus:ring-primary/20" placeholder="Nhập nội dung chữ..."></textarea>
                        <div class="grid grid-cols-2 gap-3 mt-4">
                            <div>
                                <label for="fontSelect" class="block text-xs uppercase tracking-[0.2em] text-outline-variant mb-2">Font</label>
                                <select id="fontSelect" class="w-full rounded-3xl border border-outline-variant bg-surface px-4 py-3 text-sm text-primary outline-none">
                                    <option value="'Inter', sans-serif">Inter</option>
                                    <option value="'Poppins', sans-serif">Poppins</option>
                                    <option value="'Montserrat', sans-serif">Montserrat</option>
                                    <option value="'Roboto', sans-serif">Roboto</option>
                                </select>
                            </div>
                            <div>
                                <label for="fontSize" class="block text-xs uppercase tracking-[0.2em] text-outline-variant mb-2">Font size</label>
                                <input id="fontSize" type="range" min="18" max="56" value="28" class="w-full" />
                                <div class="text-right text-sm text-outline-variant mt-1"><span id="fontSizeValue">28</span> px</div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="textColor" class="block text-xs uppercase tracking-[0.2em] text-outline-variant mb-2">Text color</label>
                            <input id="textColor" type="color" value="#ffffff" class="w-full h-12 rounded-3xl bg-white" />
                        </div>
                    </div>

                    <div class="rounded-3xl bg-white p-5 border border-surface-container shadow-sm">
                        <p class="text-xs uppercase tracking-[0.3em] text-outline-variant mb-3">Upload artwork</p>
                        <div id="dropZone" class="relative border-2 border-dashed border-outline-variant rounded-3xl p-8 text-center hover:border-primary transition cursor-pointer">
                            <input type="file" name="preview_image" id="previewImage" class="hidden" accept="image/png,image/jpeg,image/jpg,image/svg+xml">
                            <div class="flex flex-col items-center gap-3">
                                <span class="material-symbols-outlined text-outline-variant text-3xl">cloud_upload</span>
                                <div>
                                    <p class="text-sm font-semibold text-primary">Kéo thả hình ảnh vào đây</p>
                                    <p class="text-xs text-outline-variant">hoặc <label for="previewImage" class="text-primary underline cursor-pointer">chọn từ máy</label></p>
                                </div>
                                <p id="previewFileLabel" class="text-xs text-outline-variant mt-2"></p>
                            </div>
                        </div>
                        <div class="mt-5">
                            <label for="imageSize" class="block text-xs uppercase tracking-[0.2em] text-outline-variant mb-2">Kích thước ảnh</label>
                            <input id="imageSize" type="range" min="20" max="200" value="100" class="w-full" />
                            <div class="text-right text-sm text-outline-variant mt-1"><span id="imageSizeValue">100</span>%</div>
                        </div>
                    </div>

                    <form id="designForm" action="{{ route('design.save') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        <input type="hidden" name="product_id" id="selectedProductId">
                        <input type="hidden" name="design_data" id="designData">
                        <input type="hidden" name="preview_rendered" id="previewRendered">
                        <input type="hidden" name="preview_rendered_back" id="previewRenderedBack">
                        <button type="submit" class="w-full rounded-3xl bg-primary text-white py-4 text-sm font-semibold hover:bg-primary-container transition flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">shopping_cart_checkout</span>
                            Thêm vào giỏ hàng
                        </button>
                        <button type="submit" name="direct_order" value="1" class="w-full rounded-3xl bg-secondary text-white py-4 text-sm font-semibold hover:bg-secondary-container transition flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">local_shipping</span>
                            Đặt hàng ngay
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </div>

    <style>
        #shirtColorLayer {
            transition: background-color 0.3s ease;
            pointer-events: none;
        }

        #canvasProductImage {
            /* Tăng độ tương phản để nếp nhăn rõ hơn trên nền màu */
            filter: brightness(1.05) contrast(1.1);
        }

        #canvasOverlay {
            pointer-events: auto;
        }

        #canvasUploadPreview,
        #canvasTextPreview {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            cursor: move;
            user-select: none;
            pointer-events: auto;
        }

        #canvasTextPreview {
            white-space: pre-wrap;
            text-align: center;
            font-family: 'Inter', sans-serif;
        }

        #dropZone.dragover {
            border-color: #007bff;
            background-color: rgba(0, 123, 255, 0.1);
        }

        #tryOnModal {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Montserrat:wght@400;700&family=Poppins:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        // --- Elements ---
        const dropZone = document.getElementById('dropZone');
        const designDataInput = document.getElementById('designData');
        const previewImage = document.getElementById('previewImage');
        const previewFileLabel = document.getElementById('previewFileLabel');
        const canvasProductImage = document.getElementById('canvasProductImage');
        const shirtColorLayer = document.getElementById('shirtColorLayer');
        const canvasUploadPreview = document.getElementById('canvasUploadPreview');
        const canvasTextPreview = document.getElementById('canvasTextPreview');
        const selectedProductName = document.getElementById('selectedProductName');
        const selectedProductId = document.getElementById('selectedProductId');
        const designText = document.getElementById('designText');
        const fontSelect = document.getElementById('fontSelect');
        const fontSizeInput = document.getElementById('fontSize');
        const fontSizeValue = document.getElementById('fontSizeValue');
        const textColorInput = document.getElementById('textColor');
        const imageSizeInput = document.getElementById('imageSize');
        const imageSizeValue = document.getElementById('imageSizeValue');
        const resetButton = document.getElementById('resetButton');
        const fabricColorButtons = document.querySelectorAll('.fabric-color-button');
        const shirtColorPalette = document.getElementById('shirtColorPalette');
        const toteColorPalette = document.getElementById('toteColorPalette');
        const bucketColorPalette = document.getElementById('bucketColorPalette');
        const capColorPalette = document.getElementById('capColorPalette');
        const sweaterColorPalette = document.getElementById('sweaterColorPalette');
        const hoodieColorPalette = document.getElementById('hoodieColorPalette');
        const sizeSelector = document.getElementById('sizeSelector');
        const sizeButtons = document.querySelectorAll('.size-button');
        const productButtons = document.querySelectorAll('.product-template-button');
        const viewButtons = document.querySelectorAll('.view-toggle-button');
        const designForm = document.getElementById('designForm');

        // --- State ---
        const designState = {
            productId: null,
            productName: null,
            productImage: '{{ asset("images/shirt-trang.png") }}',
            fabricColor: '#ffffff',
            size: 'S',
            text: '',
            fontFamily: "'Inter', sans-serif",
            fontSize: 28,
            textColor: '#ffffff',
            previewImageUrl: null,
            textPosition: null,
            imagePosition: null,
            imageSize: 100,
            overlayImage: null,
            view: 'front',
            frontProductImage: '{{ asset("images/shirt-trang.png") }}',
            backProductImage: '{{ asset("images/trang.png") }}',
            frontText: '',
            backText: '',
            frontTextPosition: null,
            backTextPosition: null,
            frontPreviewImageUrl: null,
            backPreviewImageUrl: null,
            frontImagePosition: null,
            backImagePosition: null,
            frontImageSize: 100,
            backImageSize: 100,
        };

        function getCurrentProductImage() {
            if (designState.view === 'back') {
                return designState.backProductImage || designState.frontProductImage || designState.productImage;
            }
            return designState.frontProductImage || designState.productImage;
        }

        function getCurrentTextValue() {
            return designState.view === 'back' ? designState.backText : designState.frontText;
        }

        function getCurrentTextPosition() {
            return designState.view === 'back' ? designState.backTextPosition : designState.frontTextPosition;
        }

        function getCurrentPreviewImageUrl() {
            return designState.view === 'back' ? designState.backPreviewImageUrl : designState.frontPreviewImageUrl;
        }

        function getCurrentImagePosition() {
            return designState.view === 'back' ? designState.backImagePosition : designState.frontImagePosition;
        }

        function getCurrentImageSize() {
            return designState.view === 'back' ? designState.backImageSize : designState.frontImageSize;
        }

        function updateViewButtons() {
            viewButtons.forEach(button => {
                const isActive = button.dataset.view === designState.view;
                button.classList.toggle('bg-primary', isActive);
                button.classList.toggle('text-white', isActive);
                button.classList.toggle('border-primary', isActive);
                button.classList.toggle('bg-white', !isActive);
                button.classList.toggle('text-primary', !isActive);
                button.classList.toggle('border-outline-variant', !isActive);
            });
        }

        // --- Core Functions ---
        function updateColorLayer() {
            // Lấy tọa độ thực tế của ảnh áo (do dùng flex/contain nên ảnh có thể nhỏ hơn container)
            const imgWidth = canvasProductImage.offsetWidth;
            const imgHeight = canvasProductImage.offsetHeight;
            const imgLeft = canvasProductImage.offsetLeft;
            const imgTop = canvasProductImage.offsetTop;

            // Ép lớp màu phải nằm đè đúng vị trí ảnh áo
            shirtColorLayer.style.width = imgWidth + 'px';
            shirtColorLayer.style.height = imgHeight + 'px';
            shirtColorLayer.style.left = imgLeft + 'px';
            shirtColorLayer.style.top = imgTop + 'px';

            shirtColorLayer.style.display = 'none';
        }

        function updateColorPalette(productName = designState.productName) {
            const normalizedName = productName?.toLowerCase() || '';
            const isTote = normalizedName.includes('túi tote');
            const isBucket = normalizedName.includes('mũ bucket');
            const isCap = normalizedName.includes('mũ lưỡi trai');
            const isSweater = normalizedName.includes('áo sweater');
            const isHoodie = normalizedName.includes('áo hoodie');

            shirtColorPalette.classList.toggle('hidden', isTote || isBucket || isCap || isSweater || isHoodie);
            toteColorPalette.classList.toggle('hidden', !isTote);
            bucketColorPalette.classList.toggle('hidden', !isBucket);
            capColorPalette.classList.toggle('hidden', !isCap);
            sweaterColorPalette.classList.toggle('hidden', !isSweater);
            hoodieColorPalette.classList.toggle('hidden', !isHoodie);
            sizeSelector.classList.toggle('hidden', isTote || isBucket || isCap);

            const availableButtons = isTote ?
                toteColorPalette.querySelectorAll('.fabric-color-button') :
                isBucket ?
                bucketColorPalette.querySelectorAll('.fabric-color-button') :
                isCap ?
                capColorPalette.querySelectorAll('.fabric-color-button') :
                isSweater ?
                sweaterColorPalette.querySelectorAll('.fabric-color-button') :
                isHoodie ?
                hoodieColorPalette.querySelectorAll('.fabric-color-button') :
                shirtColorPalette.querySelectorAll('.fabric-color-button');

            fabricColorButtons.forEach(button => button.classList.remove('ring-2', 'ring-primary'));

            const matchingButton = Array.from(availableButtons).find(button => button.dataset.color === designState.fabricColor);
            const targetButton = matchingButton || availableButtons[0];

            if (targetButton) {
                targetButton.classList.add('ring-2', 'ring-primary');
                designState.fabricColor = targetButton.dataset.color;
                designState.frontProductImage = targetButton.dataset.image || designState.frontProductImage;
                designState.backProductImage = targetButton.dataset.backImage || designState.backProductImage || designState.frontProductImage;
            }
        }

        function updatePreview() {
            selectedProductName.textContent = designState.productName ? `Mẫu đã chọn: ${designState.productName}` : '';
            const currentProductImage = getCurrentProductImage();
            designState.productImage = currentProductImage;
            canvasProductImage.src = currentProductImage;
            canvasProductImage.style.mixBlendMode = 'normal';

            // Đảm bảo update màu khi ảnh đã load xong để lấy offset chính xác
            canvasProductImage.onload = updateColorLayer;
            if (canvasProductImage.complete) updateColorLayer();

            const currentTextValue = getCurrentTextValue();
            const currentTextPosition = getCurrentTextPosition();
            const currentPreviewImageUrl = getCurrentPreviewImageUrl();
            const currentImagePosition = getCurrentImagePosition();
            const currentImageSize = getCurrentImageSize();

            designState.text = currentTextValue;
            designState.previewImageUrl = currentPreviewImageUrl;
            designState.textPosition = currentTextPosition;
            designState.imagePosition = currentImagePosition;
            designState.imageSize = currentImageSize;

            designText.value = currentTextValue;
            canvasTextPreview.textContent = currentTextValue || '';
            canvasTextPreview.style.fontFamily = designState.fontFamily;
            canvasTextPreview.style.fontSize = `${designState.fontSize}px`;
            canvasTextPreview.style.color = designState.textColor;

            if (currentTextPosition) {
                canvasTextPreview.style.left = `${currentTextPosition.left}px`;
                canvasTextPreview.style.top = `${currentTextPosition.top}px`;
                canvasTextPreview.style.transform = 'none';
            } else {
                canvasTextPreview.style.left = '50%';
                canvasTextPreview.style.top = '50%';
                canvasTextPreview.style.transform = 'translate(-50%, -50%)';
            }

            canvasUploadPreview.src = currentPreviewImageUrl || '';
            canvasUploadPreview.classList.toggle('hidden', !currentPreviewImageUrl);
            if (currentPreviewImageUrl) {
                canvasUploadPreview.style.width = `${currentImageSize}%`;
                if (currentImagePosition) {
                    canvasUploadPreview.style.left = `${currentImagePosition.left}px`;
                    canvasUploadPreview.style.top = `${currentImagePosition.top}px`;
                    canvasUploadPreview.style.transform = 'none';
                } else {
                    canvasUploadPreview.style.left = '50%';
                    canvasUploadPreview.style.top = '50%';
                    canvasUploadPreview.style.transform = 'translate(-50%, -50%)';
                }
            }

            fontSizeValue.textContent = designState.fontSize;
            imageSizeValue.textContent = currentImageSize;

            selectedProductId.value = designState.productId;
            designDataInput.value = JSON.stringify(designState);
            updateViewButtons();
        }

        // --- Drag & Drop Logic (Image & Text) ---
        let isDragging = false,
            dragTarget = null,
            startX, startY;

        function startDrag(e, target, type) {
            isDragging = true;
            dragTarget = target;
            const rect = target.getBoundingClientRect();
            startX = e.clientX - rect.left;
            startY = e.clientY - rect.top;
            target.style.transform = 'none';
            e.preventDefault();
        }

        canvasUploadPreview.addEventListener('mousedown', (e) => startDrag(e, canvasUploadPreview, 'image'));
        canvasTextPreview.addEventListener('mousedown', (e) => startDrag(e, canvasTextPreview, 'text'));

        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            const parentRect = dragTarget.parentElement.getBoundingClientRect();
            let left = e.clientX - parentRect.left - startX;
            let top = e.clientY - parentRect.top - startY;

            dragTarget.style.left = `${left}px`;
            dragTarget.style.top = `${top}px`;

            if (dragTarget === canvasUploadPreview) {
                if (designState.view === 'back') {
                    designState.backImagePosition = {
                        left,
                        top
                    };
                } else {
                    designState.frontImagePosition = {
                        left,
                        top
                    };
                }
            } else {
                if (designState.view === 'back') {
                    designState.backTextPosition = {
                        left,
                        top
                    };
                } else {
                    designState.frontTextPosition = {
                        left,
                        top
                    };
                }
            }
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
        });

        // --- Events ---
        productButtons.forEach((btn, idx) => {
            btn.addEventListener('click', () => {
                productButtons.forEach(b => b.classList.remove('border-primary', 'bg-primary/10'));
                btn.classList.add('border-primary', 'bg-primary/10');
                designState.productId = btn.dataset.productId;
                designState.productName = btn.dataset.productName;
                designState.frontProductImage = btn.dataset.productImage;
                designState.backProductImage = btn.dataset.backImage || btn.dataset.productImage;
                updateColorPalette(designState.productName);
                updatePreview();
            });
            if (idx === 0) btn.click();
        });

        fabricColorButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                fabricColorButtons.forEach(b => b.classList.remove('ring-2', 'ring-primary'));
                btn.classList.add('ring-2', 'ring-primary');
                designState.fabricColor = btn.dataset.color;
                designState.frontProductImage = btn.dataset.image || designState.frontProductImage;
                designState.backProductImage = btn.dataset.backImage || designState.backProductImage || designState.frontProductImage;
                updatePreview();
            });
        });

        sizeButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                sizeButtons.forEach(b => b.classList.remove('border-primary', 'bg-primary/10'));
                btn.classList.add('border-primary', 'bg-primary/10');
                designState.size = btn.textContent.trim();
                document.getElementById('selectedSizeLabel').textContent = designState.size;
            });
        });

        viewButtons.forEach(button => {
            button.addEventListener('click', () => {
                designState.view = button.dataset.view;
                updatePreview();
            });
        });

        designText.addEventListener('input', () => {
            if (designState.view === 'back') {
                designState.backText = designText.value;
            } else {
                designState.frontText = designText.value;
            }
            designState.text = designText.value;
            updatePreview();
        });
        fontSelect.addEventListener('change', () => {
            designState.fontFamily = fontSelect.value;
            updatePreview();
        });
        fontSizeInput.addEventListener('input', () => {
            designState.fontSize = fontSizeInput.value;
            updatePreview();
        });
        textColorInput.addEventListener('input', () => {
            designState.textColor = textColorInput.value;
            updatePreview();
        });
        imageSizeInput.addEventListener('input', () => {
            if (designState.view === 'back') {
                designState.backImageSize = imageSizeInput.value;
            } else {
                designState.frontImageSize = imageSizeInput.value;
            }
            designState.imageSize = imageSizeInput.value;
            updatePreview();
        });

        previewImage.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                previewFileLabel.textContent = `Đã chọn: ${file.name}`;
                const objectUrl = URL.createObjectURL(file);
                if (designState.view === 'back') {
                    designState.backPreviewImageUrl = objectUrl;
                } else {
                    designState.frontPreviewImageUrl = objectUrl;
                }
                designState.previewImageUrl = objectUrl;
                updatePreview();
            }
        });

        // Dropzone logic
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });
        dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                previewFileLabel.textContent = `Đã chọn: ${file.name}`;
                const objectUrl = URL.createObjectURL(file);
                if (designState.view === 'back') {
                    designState.backPreviewImageUrl = objectUrl;
                } else {
                    designState.frontPreviewImageUrl = objectUrl;
                }
                designState.previewImageUrl = objectUrl;
                updatePreview();
            }
        });

        resetButton.addEventListener('click', () => location.reload());

        // Function to export shirt design without background
        async function exportShirtDesignImage() {
            const designCanvasEl = document.getElementById('designCanvas');
            const canvasRect = designCanvasEl.getBoundingClientRect();
            const outW = Math.round(canvasRect.width * 2);
            const outH = Math.round(canvasRect.height * 2);

            function createCanvas() {
                const canvas = document.createElement('canvas');
                canvas.width = outW;
                canvas.height = outH;
                return canvas;
            }

            function mapRectToCanvas(rect, ctxWidth, ctxHeight) {
                const ratioX = ctxWidth / canvasRect.width;
                const ratioY = ctxHeight / canvasRect.height;
                return {
                    x: (rect.left - canvasRect.left) * ratioX,
                    y: (rect.top - canvasRect.top) * ratioY,
                    w: rect.width * ratioX,
                    h: rect.height * ratioY,
                };
            }

            function mapPosition(position, ctxWidth, ctxHeight) {
                if (!position) {
                    return {
                        x: ctxWidth / 2,
                        y: ctxHeight / 2,
                    };
                }
                return {
                    x: position.left * (ctxWidth / canvasRect.width),
                    y: position.top * (ctxHeight / canvasRect.height),
                };
            }

            async function renderSide(viewKey) {
                const tempCanvas = createCanvas();
                const ctx = tempCanvas.getContext('2d');
                ctx.clearRect(0, 0, tempCanvas.width, tempCanvas.height);

                const productImageUrl = viewKey === 'back' ?
                    (designState.backProductImage || designState.frontProductImage || designState.productImage) :
                    (designState.frontProductImage || designState.productImage);

                const productEl = document.getElementById('canvasProductImage');
                const prodRect = productEl.getBoundingClientRect();
                const prodMapped = mapRectToCanvas(prodRect, tempCanvas.width, tempCanvas.height);

                const shirtImg = new Image();
                shirtImg.crossOrigin = 'anonymous';
                await new Promise((resolve, reject) => {
                    shirtImg.onload = resolve;
                    shirtImg.onerror = reject;
                    shirtImg.src = productImageUrl;
                });
                ctx.drawImage(shirtImg, prodMapped.x, prodMapped.y, prodMapped.w, prodMapped.h);

                const previewImageUrl = viewKey === 'back' ?
                    designState.backPreviewImageUrl :
                    designState.frontPreviewImageUrl;
                const imagePosition = viewKey === 'back' ?
                    designState.backImagePosition :
                    designState.frontImagePosition;
                const imageSizeValue = viewKey === 'back' ?
                    designState.backImageSize :
                    designState.frontImageSize;

                if (previewImageUrl) {
                    const imagePositionMapped = mapPosition(imagePosition, tempCanvas.width, tempCanvas.height);
                    const uploadImg = new Image();
                    uploadImg.crossOrigin = 'anonymous';
                    await new Promise((resolve, reject) => {
                        uploadImg.onload = resolve;
                        uploadImg.onerror = reject;
                        uploadImg.src = previewImageUrl;
                    });

                    const scaledWidth = (imageSizeValue / 100) * tempCanvas.width * 0.2;
                    ctx.drawImage(uploadImg, imagePositionMapped.x - scaledWidth / 2, imagePositionMapped.y - scaledWidth / 2, scaledWidth, scaledWidth);
                }

                const textValue = viewKey === 'back' ?
                    designState.backText :
                    designState.frontText;
                const textPosition = viewKey === 'back' ?
                    designState.backTextPosition :
                    designState.frontTextPosition;

                if (textValue && textValue.trim() !== '') {
                    const textPositionMapped = mapPosition(textPosition, tempCanvas.width, tempCanvas.height);
                    const fontFamily = designState.fontFamily || 'Inter';
                    const scaledFont = (designState.fontSize || 28) * (tempCanvas.width / canvasRect.width);

                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.font = `bold ${scaledFont}px ${fontFamily}`;
                    ctx.fillStyle = 'rgba(0,0,0,0.35)';
                    ctx.fillText(textValue, textPositionMapped.x + 2, textPositionMapped.y + 2);
                    ctx.fillStyle = designState.textColor || '#ffffff';
                    ctx.fillText(textValue, textPositionMapped.x, textPositionMapped.y);
                }

                return tempCanvas.toDataURL('image/png');
            }

            return {
                front: await renderSide('front'),
                back: await renderSide('back'),
            };
        }

        // Try on button
        const personInput = document.getElementById('personImageInput');

        document.getElementById('tryOnButton').addEventListener('click', () => {
            personInput.click();
        });

        personInput.addEventListener('change', async function() {
            const personFile = this.files[0];
            if (!personFile) return;

            const submitButton = document.getElementById('tryOnButton');
            submitButton.innerHTML = '<span class="material-symbols-outlined">hourglass_empty</span> Đang xử lý...';
            submitButton.disabled = true;

            try {
                const shirtImage = await exportShirtDesignImage();

                const formData = new FormData();
                formData.append('person_image', personFile);
                formData.append('shirt_image', shirtImage);

                const response = await fetch('/try-on', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const result = await response.json();

                if (result.success) {
                    document.getElementById('tryOnResultImage').src = result.image;
                    document.getElementById('tryOnModal').classList.remove('hidden');
                } else {
                    alert('Lỗi: ' + (result.error || 'Không thể xử lý mặc thử áo'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Lỗi: ' + error.message);
            } finally {
                submitButton.innerHTML = '<span class="material-symbols-outlined">checkroom</span> Mặc thử áo';
                submitButton.disabled = false;
            }
        });

        document.getElementById('closeTryOnModal').addEventListener('click', () => {
            document.getElementById('tryOnModal').classList.add('hidden');
        });

        document.getElementById('closeTryOnButton').addEventListener('click', () => {
            document.getElementById('tryOnModal').classList.add('hidden');
        });

        document.getElementById('tryAgainButton').addEventListener('click', () => {
            document.getElementById('tryOnModal').classList.add('hidden');
            personInput.click();
        });

        // --- Form submit ---
        designForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            // Validate required fields
            if (!designState.productId) {
                alert('Vui lòng chọn sản phẩm trước khi thêm vào giỏ hàng!');
                return;
            }

            console.log('Submitting design:', designState); // Debug log

            // Show loading
            const submitter = e.submitter || document.activeElement;
            const submitButton = submitter || e.target.querySelector('button[type="submit"]');
            const directOrder = submitter && submitter.name === 'direct_order' && submitter.value === '1';
            const originalText = submitButton ? submitButton.innerHTML : null;
            if (submitButton) {
                submitButton.innerHTML = '<span class="material-symbols-outlined">hourglass_empty</span> Đang xử lý...';
                submitButton.disabled = true;
            }

            document.getElementById('selectedProductId').value = designState.productId;
            document.getElementById('designData').value = JSON.stringify(designState);
            document.getElementById('previewRendered').value = '';
            document.getElementById('previewRenderedBack').value = '';

            if (directOrder) {
                // Ensure the direct_order button value is kept during async submit
                const hiddenDirectOrder = document.createElement('input');
                hiddenDirectOrder.type = 'hidden';
                hiddenDirectOrder.name = 'direct_order';
                hiddenDirectOrder.value = '1';
                this.appendChild(hiddenDirectOrder);
            }

            console.log('Form data:', {
                product_id: document.getElementById('selectedProductId').value,
                design_data: document.getElementById('designData').value,
                preview_rendered: document.getElementById('previewRendered').value,
                preview_rendered_back: document.getElementById('previewRenderedBack').value,
                direct_order: directOrder ? '1' : '0'
            }); // Debug log

            // Generate preview image using custom export function
            exportShirtDesignImage().then(imageData => {
                document.getElementById('previewRendered').value = imageData.front;
                document.getElementById('previewRenderedBack').value = imageData.back;
                this.submit();
            }).catch(error => {
                console.error('Error generating preview:', error);

                // Fallback: submit without preview if rendering fails
                document.getElementById('previewRendered').value = '';
                document.getElementById('previewRenderedBack').value = '';
                this.submit();
            });
        });

        // Initial update
        window.addEventListener('resize', updateColorLayer);
        updatePreview();
    </script>

</x-client-layout>