<div id="cartModal" class="fixed inset-0 z-50 hidden bg-slate-900/40 backdrop-blur-sm flex justify-end transition-opacity">
    <div class="bg-white w-full max-w-md h-full shadow-2xl flex flex-col justify-between transform transition-transform">
        <div class="p-4 border-b border-slate-200 flex items-center justify-between bg-slate-50">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-bag-shopping text-blue-600 text-lg"></i>
                <h3 class="font-bold text-slate-800">Keranjang Belanja</h3>
                <span id="cartItemCountText" class="text-xs bg-blue-100 text-blue-700 font-bold px-2 py-0.5 rounded-full">0 Item</span>
            </div>
            <button type="button" onclick="toggleCartModal(false)" class="p-2 text-slate-400 hover:text-slate-600 rounded-lg">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <div id="cartItemsContainer" class="flex-grow overflow-y-auto p-4 divide-y divide-slate-100"></div>

        <div class="p-4 border-t border-slate-200 bg-slate-50 space-y-4">
            <div class="space-y-1.5">
                <div class="flex justify-between text-sm text-slate-500">
                    <span>Subtotal</span>
                    <span id="cartSubtotal">Rp 0</span>
                </div>
                <div class="flex justify-between text-sm text-slate-500">
                    <span>Pajak & Layanan (10%)</span>
                    <span id="cartTax">Rp 0</span>
                </div>
                <div class="flex justify-between text-base font-extrabold text-slate-800 pt-2 border-t border-slate-200">
                    <span>Total Pembayaran</span>
                    <span id="cartTotal" class="text-blue-600">Rp 0</span>
                </div>
            </div>

            <button type="button" id="btnProceedCheckout" onclick="openCheckoutModal()" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 transition-all flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                <span>Lanjut ke Checkout</span>
                <i class="fa-solid fa-arrow-right text-sm"></i>
            </button>
        </div>
    </div>
</div>