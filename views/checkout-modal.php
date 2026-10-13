<div id="checkoutModal" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl space-y-5 my-8">
        <div class="flex justify-between items-center border-b border-slate-100 pb-3">
            <h3 class="text-xl font-bold text-slate-800">Formulir Checkout</h3>
            <button type="button" onclick="closeCheckoutModal()" class="text-slate-400 hover:text-slate-600">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form id="checkoutForm" onsubmit="processOrder(event)" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Nama Lengkap</label>
                <input type="text" id="custName" required placeholder="Contoh: Budi Santoso" class="w-full px-3 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">No. WhatsApp</label>
                    <input type="tel" id="custPhone" required placeholder="08123456789" class="w-full px-3 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Metode Pembayaran</label>
                    <select id="custPayment" required class="w-full px-3 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="Transfer Bank (BCA/Mandiri)">Transfer Bank</option>
                        <option value="E-Wallet (Gopay/OVO/Dana)">E-Wallet</option>
                        <option value="COD (Bayar di Tempat)">COD (Bayar di Tempat)</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Alamat Lengkap Pengiriman</label>
                <textarea id="custAddress" required rows="3" placeholder="Jl. Merdeka No. 123, Kelurahan, Kecamatan, Kota..." class="w-full px-3 py-2 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
            </div>

            <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 flex justify-between items-center text-sm">
                <span class="text-slate-500">Total Tagihan:</span>
                <span id="checkoutTotalText" class="font-extrabold text-blue-600 text-base">Rp 0</span>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeCheckoutModal()" class="w-1/2 py-2.5 text-slate-600 hover:bg-slate-100 font-semibold text-sm rounded-xl transition-all">Batal</button>
                <button type="submit" class="w-1/2 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow-md transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-check"></i> Konfirmasi Bayar
                </button>
            </div>
        </form>
    </div>
</div>