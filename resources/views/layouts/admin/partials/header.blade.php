<!-- TopNavBar -->
<header class="fixed top-0 right-0 w-[calc(100%-16rem)] h-16 z-40 bg-[#faf8ff]/80 dark:bg-[#191b22]/80 backdrop-blur-md shadow-sm shadow-blue-900/5 flex items-center justify-between px-8 font-['Plus_Jakarta_Sans'] text-sm font-medium text-[#00327d] dark:text-[#c1d1ff]">
    <div class="flex items-center bg-surface-container-low px-4 py-2 rounded-full w-96 border border-outline-variant/10">
        <span class="material-symbols-outlined text-outline mr-2 text-xl">search</span>
        <input class="bg-transparent border-none focus:ring-0 text-sm w-full placeholder:text-outline-variant" placeholder="Tìm kiếm đơn hàng, khách hàng..." type="text" />
    </div>
    <div class="flex items-center gap-4">
        <button class="hover:bg-[#f3f3fc] dark:hover:bg-[#2a2d37] rounded-full p-2 transition-all duration-300 ease-in-out relative">
            <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
            <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full"></span>
        </button>
        <button class="hover:bg-[#f3f3fc] dark:hover:bg-[#2a2d37] rounded-full p-2 transition-all duration-300 ease-in-out">
            <span class="material-symbols-outlined" data-icon="help_outline">help_outline</span>
        </button>
        <div class="h-8 w-[1px] bg-outline-variant/20 mx-2"></div>
        <div class="flex items-center gap-3">
            <span class="font-bold">{{ auth()->user()->name ?? 'Admin User' }}</span>
            <div class="relative">
                <button class="flex items-center gap-2 hover:bg-[#f3f3fc] dark:hover:bg-[#2a2d37] rounded-full p-2 transition-all duration-300 ease-in-out" onclick="toggleUserMenu()">
                    <img class="w-8 h-8 rounded-full object-cover" alt="Administrator portrait" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAsfs9QFs6QZ9DaT6ZySHie4_Tahm_vfxpE9Pf-ykQPGUqJheO2iRe2cra5awHoJCR0Od9y5KeFIjYtqCxEDDV_XWHodRl2UVfHJnTfubSgw2udQoMtdicYKaL4oGp-z9kCZz3LW7aRyhgeOBmXxHV7_yzsuGqSro0SYXT_CMD5lAB_I5hTpFur8HjyeqDqAONtWXB-b4Ihhmp8nyfL6ec5oOaPaCgSarL9TDBaPQB24ZMyPw8o3wXpgjUjSBUdmp6zvHRiZRmP" />
                    <span class="material-symbols-outlined text-sm">expand_more</span>
                </button>
                <div id="userMenu" class="absolute right-0 top-full mt-2 w-48 bg-white dark:bg-[#191b22] rounded-3xl shadow-lg border border-outline-variant/10 hidden z-50">
                    <div class="p-2">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2 text-sm hover:bg-surface-container rounded-2xl transition-colors">
                            <span class="material-symbols-outlined text-lg">person</span>
                            <span>Profile</span>
                        </a>
                        <a href="{{ route('settings.edit') }}" class="flex items-center gap-3 px-3 py-2 text-sm hover:bg-surface-container rounded-2xl transition-colors">
                            <span class="material-symbols-outlined text-lg">settings</span>
                            <span>Settings</span>
                        </a>
                        <hr class="my-2 border-outline-variant/10">
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 px-3 py-2 text-sm hover:bg-surface-container rounded-2xl transition-colors w-full text-left">
                                <span class="material-symbols-outlined text-lg">logout</span>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    function toggleUserMenu() {
        const menu = document.getElementById('userMenu');
        menu.classList.toggle('hidden');
    }

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const menu = document.getElementById('userMenu');
        const button = event.target.closest('button[onclick="toggleUserMenu()"]');
        if (!button && !menu.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
</script>