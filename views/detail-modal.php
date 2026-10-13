<div id="productDetailModal" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-2xl w-full overflow-hidden shadow-2xl relative animate-fade-in">
        <button type="button" onclick="closeProductDetailModal()" class="absolute top-4 right-4 z-10 w-9 h-9 bg-white/80 backdrop-blur rounded-full flex items-center justify-center text-slate-500 hover:text-slate-800 shadow">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>
        <div id="productDetailContent" class="grid grid-cols-1 md:grid-cols-2"></div>
    </div>
</div>