<header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-slate-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 gap-4">
            
            <!-- Logo -->
            <div class="flex items-center gap-3 cursor-pointer" onclick="switchTab('shop')">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                    <i class="fa-solid font-bold fa-bag-shopping text-xl"></i>
                </div>
                <div>
                    <span class="text-xl font-extrabold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent"><?php echo $storeName; ?></span>
                    <span class="hidden sm:inline-block text-xs text-slate-400 block font-medium -mt-1">E-Commerce Store</span>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <nav class="hidden md:flex items-center gap-1 bg-slate-100 p-1 rounded-xl">
                <button type="button" id="nav-shop" onclick="switchTab('shop')" class="nav-btn px-4 py-2 text-sm font-semibold rounded-lg transition-all text-blue-600 bg-white shadow-sm">
                    <i class="fa-solid fa-store mr-2"></i>Katalog Produk
                </button>
                <button type="button" id="nav-orders" onclick="switchTab('orders')" class="nav-btn px-4 py-2 text-sm font-semibold rounded-lg transition-all text-slate-600 hover:text-slate-900">
                    <i class="fa-solid fa-receipt mr-2"></i>Riwayat Pesanan
                </button>
                <button type="button" id="nav-admin" onclick="switchTab('admin')" class="nav-btn px-4 py-2 text-sm font-semibold rounded-lg transition-all text-slate-600 hover:text-slate-900">
                    <i class="fa-solid fa-chart-line mr-2"></i>Dashboard Admin
                </button>
            </nav>

            <!-- Search Bar & Actions -->
            <div class="flex items-center gap-3">
                <div class="relative hidden sm:block w-48 lg:w-64">
                    <input type="text" id="searchInput" oninput="handleSearch()" placeholder="Cari produk..." 
                        class="w-full pl-9 pr-4 py-2 text-sm bg-slate-100 border border-transparent rounded-xl focus:outline-none focus:bg-white focus:border-blue-500 transition-all">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-sm"></i>
                </div>

                <button type="button" onclick="toggleMobileNav()" class="md:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-lg">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>

                <button onclick="toggleCartModal(true)" class="relative p-2.5 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-xl transition-all font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-cart-shopping text-lg"></i>
                    <span class="hidden sm:inline text-sm">Keranjang</span>
                    <span id="cartCountBadge" class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold border-2 border-white scale-0 transition-transform duration-200">0</span>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Dropdown -->
        <div id="mobileNav" class="hidden md:hidden py-3 border-t border-slate-100 flex flex-col gap-2">
            <input type="text" id="searchInputMobile" oninput="handleSearchMobile()" placeholder="Cari produk..." 
                class="w-full mb-2 pl-9 pr-4 py-2 text-sm bg-slate-100 border border-transparent rounded-xl focus:outline-none focus:bg-white focus:border-blue-500">
            <button onclick="switchTab('shop'); toggleMobileNav()" class="text-left px-4 py-2.5 text-sm font-semibold rounded-lg bg-slate-100 text-blue-600">
                <i class="fa-solid fa-store w-6"></i> Katalog Produk
            </button>
            <button onclick="switchTab('orders'); toggleMobileNav()" class="text-left px-4 py-2.5 text-sm font-semibold rounded-lg text-slate-600 hover:bg-slate-100">
                <i class="fa-solid fa-receipt w-6"></i> Riwayat Pesanan
            </button>
            <button onclick="switchTab('admin'); toggleMobileNav()" class="text-left px-4 py-2.5 text-sm font-semibold rounded-lg text-slate-600 hover:bg-slate-100">
                <i class="fa-solid fa-chart-line w-6"></i> Dashboard Admin
            </button>
        </div>
    </div>
</header>