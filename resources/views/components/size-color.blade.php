<!-- Modal chọn biến thể -->
<div id="variantModal" class="hidden fixed inset-0 bg-black/50 z-[999] flex items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl transform transition-all">
        <div class="flex justify-between items-center mb-6">
            <h3 id="modalProductName" class="text-xl font-bold text-primary">Tên sản phẩm</h3>
            <button onclick="closeVariantModal()" class="text-outline hover:text-error">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        
        <form id="variantForm">
            <input type="hidden" id="modalProductId">
            
            <!-- Khu vực chọn Màu -->
            <div class="mb-6">
                <label class="block text-sm font-bold text-outline uppercase mb-3">Màu sắc</label>
                <div id="colorOptions" class="flex flex-wrap gap-3"></div>
            </div>

            <!-- Khu vực chọn Size -->
            <div class="mb-6">
                <label class="block text-sm font-bold text-outline uppercase mb-3">Kích thước</label>
                <div id="sizeOptions" class="flex flex-wrap gap-3"></div>
            </div>

            <div class="flex gap-3 mt-8">
                <button type="button" onclick="closeVariantModal()" class="flex-1 py-3 border border-outline/30 rounded-2xl font-semibold text-outline hover:bg-surface transition-colors">
                    Hủy
                </button>
                <button type="submit" class="flex-1 py-3 bg-primary text-white rounded-2xl font-semibold hover:bg-primary-container shadow-lg shadow-primary/20 transition-all">
                    Xác nhận thêm
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let currentVariants = [];

    async function openVariantModal(productId, productName) {
        const modal = document.getElementById('variantModal');
        document.getElementById('modalProductName').innerText = productName;
        document.getElementById('modalProductId').value = productId;
        
        document.getElementById('colorOptions').innerHTML = '<p class="text-sm">Đang tải...</p>';
        document.getElementById('sizeOptions').innerHTML = '';
        modal.classList.remove('hidden');

        try {
            const response = await fetch(`/api/products/${productId}/variants`);
            const data = await response.json();
            currentVariants = data.variants;
            renderVariantOptions(currentVariants);
        } catch (error) {
            console.error("Lỗi:", error);
            alert("Không thể tải thông tin sản phẩm!");
            closeVariantModal();
        }
    }

    function renderVariantOptions(variants) {
        const colorContainer = document.getElementById('colorOptions');
        const sizeContainer = document.getElementById('sizeOptions');
        
        const colors = [...new Set(variants.map(v => v.color))];
        const sizes = [...new Set(variants.map(v => v.size))];

        colorContainer.innerHTML = colors.map(color => `
            <label class="cursor-pointer">
                <input type="radio" name="color" value="${color}" class="peer hidden" required>
                <span class="px-4 py-2 border rounded-xl block peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary hover:border-primary transition-all">
                    ${color}
                </span>
            </label>
        `).join('');

        sizeContainer.innerHTML = sizes.map(size => `
            <label class="cursor-pointer">
                <input type="radio" name="size" value="${size}" class="peer hidden" required>
                <span class="px-4 py-2 border rounded-xl block peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary hover:border-primary transition-all">
                    ${size}
                </span>
            </label>
        `).join('');
    }

    function closeVariantModal() {
        document.getElementById('variantModal').classList.add('hidden');
    }

    document.getElementById('variantForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const productId = document.getElementById('modalProductId').value;
        const selectedColor = document.querySelector('input[name="color"]:checked')?.value;
        const selectedSize = document.querySelector('input[name="size"]:checked')?.value;

        const variant = currentVariants.find(v => v.color === selectedColor && v.size === selectedSize);

        if (!variant) {
            alert("Tùy chọn này hiện không khả dụng!");
            return;
        }

        fetch("{{ route('cart.add') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: 1,
                variant_id: variant.id
            })
        })
        .then(res => res.json())
        .then(data => {
            // Trigger einen custom event für andere Komponenten (wie den Warenkorb im Header)
            window.dispatchEvent(new CustomEvent('cart-updated', { detail: data }));
            if (typeof updateHeaderCartCount !== 'undefined') {
                updateHeaderCartCount();
            }
            // Show notification
            const notification = document.createElement('div');
            notification.className = 'fixed bottom-6 right-6 rounded-3xl border border-emerald-100 bg-emerald-50 px-6 py-4 text-sm text-emerald-900 shadow-lg flex items-center gap-3 z-50';
            notification.innerHTML = `
                <span class="material-symbols-outlined text-2xl">check_circle</span>
                <div>${data.message}</div>
            `;
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 3000);
            closeVariantModal();
        });
    });
</script>