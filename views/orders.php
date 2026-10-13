<section id="view-orders" class="hidden space-y-6 fade-in max-w-4xl mx-auto">
    <div class="flex items-center justify-between border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Riwayat Pesanan Saya</h2>
            <p class="text-slate-500 text-sm">Daftar transaksi dan status pesanan yang telah Anda buat.</p>
        </div>
        <button type="button" onclick="clearOrderHistory()" class="text-xs text-red-500 hover:text-red-700 font-semibold flex items-center gap-1">
            <i class="fa-solid fa-trash"></i> Hapus Riwayat
        </button>
    </div>

    <div id="orderList" class="space-y-4"></div>
</section>