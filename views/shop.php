<section id="view-shop" class="space-y-6 fade-in">
    <!-- Hero Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-600 to-indigo-700 text-white p-8 md:p-12 shadow-xl shadow-blue-500/10">
        <div class="relative z-10 max-w-2xl space-y-4">
            <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-semibold uppercase tracking-wider">Promo Minggu Ini</span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight">Belanja Hemat & Lengkap Untuk Kebutuhan Anda</h1>
            <p class="text-blue-100 text-sm sm:text-base">Dapatkan produk-produk elektronik & lifestyle pilihan berkualitas tinggi dengan garansi resmi dan pengiriman super cepat.</p>
        </div>
        <div class="absolute -right-10 -bottom-10 opacity-20 text-[200px] font-black pointer-events-none">
            <i class="fa-solid fa-bag-shopping"></i>
        </div>
    </div>

    <!-- Filter Categories & Sorting -->
    <div class="flex flex-col md:flex-row gap-4 items-start md:items-center justify-between border-b border-slate-200 pb-4">
        <div class="flex flex-wrap gap-2" id="categoryFilters"></div>

        <div class="flex items-center gap-2 self-end md:self-auto text-sm">
            <span class="text-slate-500 font-medium">Urutkan:</span>
            <select id="sortSelect" onchange="renderProducts()" class="bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-slate-700 focus:outline-none focus:border-blue-500 text-sm font-medium">
                <option value="default">Terbaru</option>
                <option value="price-asc">Harga: Low to High</option>
                <option value="price-desc">Harga: High to Low</option>
                <option value="rating">Rating Tertinggi</option>
            </select>
        </div>
    </div>

    <!-- Product Grid -->
    <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
    
    <!-- Empty State -->
    <div id="noProductsState" class="hidden text-center py-16 bg-white rounded-2xl border border-dashed border-slate-200">
        <i class="fa-solid fa-box-open text-5xl text-slate-300 mb-3"></i>
        <h3 class="text-lg font-bold text-slate-700">Produk Tidak Ditemukan</h3>
        <p class="text-slate-400 text-sm mt-1">Coba kata kunci lain atau ubah filter kategori Anda.</p>
    </div>
</section>