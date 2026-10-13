<div id="adminProductModal" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl space-y-4">
        <div class="flex justify-between items-center border-b border-slate-100 pb-3">
            <h3 id="adminModalTitle" class="text-xl font-bold text-slate-800">Tambah Produk Baru</h3>
            <button type="button" onclick="closeAdminProductModal()" class="text-slate-400 hover:text-slate-600">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form id="adminProductForm" onsubmit="saveAdminProduct(event)" class="space-y-3">
            <input type="hidden" id="editProductId">
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Nama Produk</label>
                <input type="text" id="prodName" required class="w-full px-3 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Kategori</label>
                    <input type="text" id="prodCategory" required placeholder="Elektronik / Pakaian" class="w-full px-3 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Harga (Rp)</label>
                    <input type="number" id="prodPrice" min="0" required class="w-full px-3 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Stok Awal</label>
                    <input type="number" id="prodStock" min="0" required class="w-full px-3 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Rating Initial (1-5)</label>
                    <input type="number" id="prodRating" min="1" max="5" step="0.1" value="4.5" required class="w-full px-3 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">URL Gambar Produk</label>
                <input type="url" id="prodImage" required placeholder="https://images.unsplash.com/..." class="w-full px-3 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Deskripsi Produk</label>
                <textarea id="prodDesc" rows="3" required class="w-full px-3 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
            </div>

            <div class="flex gap-3 pt-3">
                <button type="button" onclick="closeAdminProductModal()" class="w-1/2 py-2.5 text-slate-600 hover:bg-slate-100 font-semibold text-sm rounded-xl">Batal</button>
                <button type="submit" class="w-1/2 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-md transition-all">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>