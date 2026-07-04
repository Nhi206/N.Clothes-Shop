<!-- SideNavBar -->
<aside class="h-screen w-64 fixed left-0 top-0 overflow-y-auto bg-[#f3f3fc] dark:bg-[#191b22] border-none flex flex-col py-6 font-['Plus_Jakarta_Sans'] tracking-tight leading-relaxed z-50">
    <div class="px-8 mb-10 flex items-center gap-3">
        <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
            <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">checkroom</span>
        </div>
        <div>
            <h1 class="text-xl font-bold text-[#00327d] dark:text-white tracking-tighter">N.clothes</h1>
            <p class="text-[10px] uppercase tracking-widest text-on-surface-variant/60">Digital Tailor Admin</p>
        </div>
    </div>
    <nav class="flex-1 space-y-1">
        @php
        $currentRoute = request()->route()->getName();
        @endphp

        <a class="flex items-center text-[#4a5980] dark:text-slate-400 hover:text-[#00327d] px-8 py-3 transition-colors hover:bg-[#e2e2eb] dark:hover:bg-[#2a2d37] transition-all active:scale-95 duration-200 {{ str_contains($currentRoute, 'dashboard') ? 'bg-[#e2e2eb] dark:bg-[#2a2d37] text-[#00327d] dark:text-white' : '' }}" href="{{ route('admin.dashboard') }}">
            <span class="material-symbols-outlined mr-4" data-icon="dashboard">dashboard</span>
            <span>Dashboard</span>
        </a>
        <a class="flex items-center text-[#4a5980] dark:text-slate-400 hover:text-[#00327d] px-8 py-3 transition-colors hover:bg-[#e2e2eb] dark:hover:bg-[#2a2d37] transition-all active:scale-95 duration-200 {{ str_contains($currentRoute, 'orders') ? 'bg-[#e2e2eb] dark:bg-[#2a2d37] text-[#00327d] dark:text-white' : '' }}" href="{{ route('admin.orders.index') }}">
            <span class="material-symbols-outlined mr-4" data-icon="shopping_bag">shopping_bag</span>
            <span>Đơn hàng</span>
        </a>
        <a class="flex items-center text-[#4a5980] dark:text-slate-400 hover:text-[#00327d] px-8 py-3 transition-colors hover:bg-[#e2e2eb] dark:hover:bg-[#2a2d37] transition-all active:scale-95 duration-200 {{ str_contains($currentRoute, 'products') ? 'bg-[#e2e2eb] dark:bg-[#2a2d37] text-[#00327d] dark:text-white' : '' }}" href="{{ route('admin.products.index') }}">
            <span class="material-symbols-outlined mr-4" data-icon="inventory_2">inventory_2</span>
            <span>Sản phẩm</span>
        </a>
        <a class="flex items-center text-[#4a5980] dark:text-slate-400 hover:text-[#00327d] px-8 py-3 transition-colors hover:bg-[#e2e2eb] dark:hover:bg-[#2a2d37] transition-all active:scale-95 duration-200 {{ str_contains($currentRoute, 'categories') ? 'bg-[#e2e2eb] dark:bg-[#2a2d37] text-[#00327d] dark:text-white' : '' }}" href="{{ route('admin.categories.index') }}">
            <span class="material-symbols-outlined mr-4" data-icon="category">category</span>
            <span>Danh mục</span>
        </a>
        <a class="flex items-center text-[#4a5980] dark:text-slate-400 hover:text-[#00327d] px-8 py-3 transition-colors hover:bg-[#e2e2eb] dark:hover:bg-[#2a2d37] transition-all active:scale-95 duration-200 {{ str_contains($currentRoute, 'promotions') ? 'bg-[#e2e2eb] dark:bg-[#2a2d37] text-[#00327d] dark:text-white' : '' }}" href="{{ route('admin.promotions.index') }}">
            <span class="material-symbols-outlined mr-4">local_offer</span>
            <span>Khuyến mãi</span>
        </a>
        <a class="flex items-center text-[#4a5980] dark:text-slate-400 hover:text-[#00327d] px-8 py-3 transition-colors hover:bg-[#e2e2eb] dark:hover:bg-[#2a2d37] transition-all active:scale-95 duration-200 {{ str_contains($currentRoute, 'suppliers') ? 'bg-[#e2e2eb] dark:bg-[#2a2d37] text-[#00327d] dark:text-white' : '' }}" href="{{ route('admin.suppliers.index') }}">
            <span class="material-symbols-outlined mr-4">handshake</span>
            <span>Nhà cung cấp</span>
        </a>
        <a class="flex items-center text-[#4a5980] dark:text-slate-400 hover:text-[#00327d] px-8 py-3 transition-colors hover:bg-[#e2e2eb] dark:hover:bg-[#2a2d37] transition-all active:scale-95 duration-200 {{ str_contains($currentRoute, 'inventories') ? 'bg-[#e2e2eb] dark:bg-[#2a2d37] text-[#00327d] dark:text-white' : '' }}" href="{{ route('admin.inventories.index') }}">
            <span class="material-symbols-outlined mr-4">inventory_2</span>
            <span>Kho</span>
        </a>
        <!-- CHỨC NĂNG PHÂN QUYỀN (Chỉ dành cho Admin) -->
        @if(auth()->user()->role === 'admin')
        <div class="px-8 py-2 text-[10px] uppercase tracking-widest text-on-surface-variant/40 font-bold">
            Quản trị hệ thống
        </div>

        <a class="flex items-center text-[#4a5980] dark:text-slate-400 hover:text-[#00327d] px-8 py-3 transition-colors hover:bg-[#e2e2eb] dark:hover:bg-[#2a2d37] transition-all active:scale-95 duration-200 {{ str_contains($currentRoute, 'users') ? 'bg-[#e2e2eb] ...' : '' }}" href="{{ route('admin.users.index') }}">
            <span class="material-symbols-outlined mr-4">group</span>
            <span>Tài khoản</span>
        </a>

        <a class="flex items-center text-[#4a5980] dark:text-slate-400 hover:text-[#00327d] px-8 py-3 transition-colors hover:bg-[#e2e2eb] dark:hover:bg-[#2a2d37] transition-all active:scale-95 duration-200 {{ str_contains($currentRoute, 'reports') ? 'bg-[#e2e2eb] ...' : '' }}" href="{{ route('admin.reports.index') }}">
            <span class="material-symbols-outlined mr-4">insights</span>
            <span>Báo cáo</span>
        </a>

        @endif
    </nav>
</aside>