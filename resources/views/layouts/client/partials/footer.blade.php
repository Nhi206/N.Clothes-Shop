<!-- Footer -->
<footer class="bg-surface-container border-t border-outline-variant/20 mt-16">
    <div class="container mx-auto px-6 py-12">
        <div class="grid gap-8 lg:grid-cols-3">
            <div>
                <h3 class="text-lg font-semibold text-primary mb-4">N.clothes</h3>
                <p class="text-sm text-outline-variant max-w-lg">
                    Nơi thiết kế và mua sắm áo cá tính với phong cách hiện đại, chất lượng cao và dịch vụ giao hàng nhanh chóng.
                </p>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-outline mb-4">Liên kết nhanh</h4>
                <ul class="space-y-3 text-sm text-outline-variant">
                    <li><a href="{{ route('products.index') }}" class="hover:text-primary transition-colors">Sản phẩm</a></li>
                    <li><a href="{{ route('design.index') }}" class="hover:text-primary transition-colors">Thiết kế</a></li>
                    <li><a href="{{ route('orders.index') }}" class="hover:text-primary transition-colors">Đơn hàng</a></li>
                    <li><a href="{{ route('wishlist.index') }}" class="hover:text-primary transition-colors">Yêu thích</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-outline mb-4">Thông tin</h4>
                <ul class="space-y-3 text-sm text-outline-variant">
                    <li><a href="#" class="hover:text-primary transition-colors">Chính sách bảo mật</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Điều khoản sử dụng</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Hỗ trợ</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Tài liệu</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-12 border-t border-surface-container pt-6 text-sm text-outline-variant flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <p>&copy; {{ date('Y') }} N.clothes - Digital Tailor</p>
            <p class="flex items-center gap-2">
                <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                Hệ thống hoạt động • Cập nhật: {{ now()->format('d/m/Y H:i') }}
            </p>
        </div>
    </div>
</footer>