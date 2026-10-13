<section id="view-admin" class="hidden space-y-6 fade-in">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Dashboard Manajemen Toko</h2>
            <p class="text-slate-500 text-sm">Simulasi backend PHP/MySQL untuk kelola inventaris produk & analisis penjualan.</p>
        </div>
        <button type="button" onclick="openAddProductModal()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-all flex items-center justify-center gap-2">
            <i class="fa-solid fa-plus"></i> Tambah Produk Baru
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium">Total Produk</p>
                <h4 id="statTotalProducts" class="text-xl font-bold text-slate-800">0</h4>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium">Total Pendapatan</p>
                <h4 id="statTotalRevenue" class="text-xl font-bold text-slate-800">Rp 0</h4>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-cart-check"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium">Pesanan Selesai</p>
                <h4 id="statTotalOrders" class="text-xl font-bold text-slate-800">0</h4>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium">Stok Menipis (&lt;5)</p>
                <h4 id="statLowStock" class="text-xl font-bold text-slate-800">0</h4>
            </div>
        </div>
    </div>

    <!-- Product Table -->
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <h3 class="font-bold text-slate-700 text-sm">Daftar Inventaris Produk</h3>
            <span class="text-xs text-slate-400">Database Mockup: LocalStorage</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-100/80 text-slate-500 font-semibold border-b border-slate-200">
                        <th class="p-3 pl-4">Produk</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3">Stok</th>
                        <th class="p-3">Rating</th>
                        <th class="p-3 text-right pr-4">Aksi</th>
                    </tr>
                </thead>
                <tbody id="adminProductTable" class="divide-y divide-slate-100"></tbody>
            </table>
        </div>
    </div>
</section>