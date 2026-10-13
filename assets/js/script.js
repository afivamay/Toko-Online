let products = [];
let cart = [];
let orders = JSON.parse(localStorage.getItem('tokokita_orders') || '[]');
let activeCategory = 'Semua';
let searchKeyword = '';

document.addEventListener('DOMContentLoaded', initApp);

async function initApp() {
    try {
        const response = await fetch('data/products.json');
        if (!response.ok) throw new Error('Data produk tidak dapat dimuat.');
        const seedProducts = await response.json();

        const savedProducts = localStorage.getItem('tokokita_products');
        products = savedProducts ? JSON.parse(savedProducts) : seedProducts;

        renderCategories();
        renderProducts();
        renderOrders();
        renderAdmin();
        updateCartUI();
        switchTab('shop');
    } catch (error) {
        console.error(error);
        showToast('Gagal memuat data produk. Pastikan project dijalankan melalui server PHP.', 'error');
    }
}

function saveProducts() {
    localStorage.setItem('tokokita_products', JSON.stringify(products));
}

function formatRupiah(value) {
    return `Rp ${Number(value || 0).toLocaleString('id-ID')}`;
}

function escapeHTML(value) {
    return String(value ?? '').replace(/[&<>"']/g, char => ({
        '&':'&amp;', '<':'&lt;', '>':'&gt;', '"':'&quot;', "'":'&#039;'
    }[char]));
}

/* =========================
   NAVBAR / TAB
========================= */
function switchTab(tab) {
    const views = {
        shop: document.getElementById('view-shop'),
        orders: document.getElementById('view-orders'),
        admin: document.getElementById('view-admin')
    };

    Object.values(views).forEach(view => {
        if (view) view.classList.add('hidden');
    });

    if (views[tab]) views[tab].classList.remove('hidden');

    document.querySelectorAll('.nav-btn').forEach(btn => {
        btn.classList.remove('text-blue-600', 'bg-white', 'shadow-sm');
        btn.classList.add('text-slate-600');
    });

    const activeButton = document.getElementById(`nav-${tab}`);
    if (activeButton) {
        activeButton.classList.remove('text-slate-600');
        activeButton.classList.add('text-blue-600', 'bg-white', 'shadow-sm');
    }

    if (tab === 'orders') renderOrders();
    if (tab === 'admin') renderAdmin();
}

function toggleMobileNav() {
    const nav = document.getElementById('mobileNav');
    if (nav) nav.classList.toggle('hidden');
}

/* =========================
   PRODUK
========================= */
function renderCategories() {
    const container = document.getElementById('categoryFilters');
    if (!container) return;

    const categories = ['Semua', ...new Set(products.map(p => p.category))];

    container.innerHTML = categories.map(category => `
        <button onclick="setCategory('${escapeHTML(category)}')"
            class="category-btn px-4 py-2 text-xs font-bold rounded-lg border transition-all ${
                category === activeCategory
                ? 'bg-blue-600 text-white border-blue-600'
                : 'bg-white text-slate-600 border-slate-200 hover:border-blue-400'
            }">
            ${escapeHTML(category)}
        </button>
    `).join('');
}

function setCategory(category) {
    activeCategory = category;
    renderCategories();
    renderProducts();
}

function handleSearch() {
    searchKeyword = document.getElementById('searchInput')?.value.trim().toLowerCase() || '';
    renderProducts();
}

function handleSearchMobile() {
    searchKeyword = document.getElementById('searchInputMobile')?.value.trim().toLowerCase() || '';
    const desktopSearch = document.getElementById('searchInput');
    if (desktopSearch) desktopSearch.value = searchKeyword;
    renderProducts();
}

function getFilteredProducts() {
    let result = [...products];

    if (activeCategory !== 'Semua') {
        result = result.filter(p => p.category === activeCategory);
    }

    if (searchKeyword) {
        result = result.filter(p =>
            p.nama.toLowerCase().includes(searchKeyword) ||
            p.category.toLowerCase().includes(searchKeyword) ||
            p.description.toLowerCase().includes(searchKeyword)
        );
    }

    const sort = document.getElementById('sortSelect')?.value || 'default';

    if (sort === 'price-asc') result.sort((a,b) => a.harga - b.harga);
    if (sort === 'price-desc') result.sort((a,b) => b.harga - a.harga);
    if (sort === 'rating') result.sort((a,b) => b.rating - a.rating);

    return result;
}

function renderProducts() {
    const grid = document.getElementById('productGrid');
    const empty = document.getElementById('noProductsState');
    if (!grid) return;

    const filtered = getFilteredProducts();

    if (filtered.length === 0) {
        grid.innerHTML = '';
        empty?.classList.remove('hidden');
        return;
    }

    empty?.classList.add('hidden');

    grid.innerHTML = filtered.map(product => `
        <article class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl transition-all group">
            <div class="relative h-52 overflow-hidden bg-slate-100">
                <img src="${escapeHTML(product.image)}"
                     alt="${escapeHTML(product.nama)}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                     onerror="this.src='https://placehold.co/800x600?text=Gambar+Produk'">
                <span class="absolute top-3 left-3 px-2.5 py-1 bg-white/90 backdrop-blur rounded-lg text-[10px] font-bold text-slate-600">
                    ${escapeHTML(product.category)}
                </span>
                ${product.stock < 5 ? '<span class="absolute top-3 right-3 px-2.5 py-1 bg-red-500 text-white rounded-lg text-[10px] font-bold">Stok Terbatas</span>' : ''}
            </div>
            <div class="p-4">
                <h3 class="font-bold text-slate-800 line-clamp-1">${escapeHTML(product.nama)}</h3>
                <div class="flex items-center gap-1 mt-1 text-xs text-amber-500">
                    <i class="fa-solid fa-star"></i>
                    <span class="font-semibold">${product.rating}</span>
                    <span class="text-slate-400">• Stok ${product.stock}</span>
                </div>
                <p class="text-blue-600 font-extrabold text-lg mt-3">${formatRupiah(product.harga)}</p>
                <div class="grid grid-cols-2 gap-2 mt-4">
                    <button onclick="openProductDetail(${product.id})"
                        class="py-2.5 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50">
                        Detail
                    </button>
                    <button onclick="addProductToCart(${product.id})"
                        ${product.stock <= 0 ? 'disabled' : ''}
                        class="py-2.5 rounded-xl bg-blue-600 text-white text-xs font-bold hover:bg-blue-700 disabled:bg-slate-300 disabled:cursor-not-allowed">
                        ${product.stock <= 0 ? 'Habis' : 'Tambah'}
                    </button>
                </div>
            </div>
        </article>
    `).join('');
}

function addProductToCart(id) {
    const product = products.find(p => p.id === id);
    if (!product) return;

    const item = cart.find(i => i.id === id);
    if (item && item.qty >= product.stock) {
        showToast('Jumlah melebihi stok produk.', 'error');
        return;
    }

    if (item) item.qty += 1;
    else cart.push({ id: product.id, nama: product.nama, harga: product.harga, qty: 1 });

    updateCartUI();
    showToast(`${product.nama} berhasil ditambahkan ke keranjang!`, 'success');
}

function addToCart(id, nama, harga) {
    addProductToCart(Number(id));
}

function openProductDetail(id) {
    const product = products.find(p => p.id === id);
    const modal = document.getElementById('productDetailModal');
    const content = document.getElementById('productDetailContent');
    if (!product || !modal || !content) return;

    content.innerHTML = `
        <div class="h-72 md:h-full bg-slate-100">
            <img src="${escapeHTML(product.image)}" alt="${escapeHTML(product.nama)}"
                 class="w-full h-full object-cover"
                 onerror="this.src='https://placehold.co/800x600?text=Gambar+Produk'">
        </div>
        <div class="p-6 flex flex-col justify-center">
            <span class="text-xs font-bold uppercase tracking-wider text-blue-600">${escapeHTML(product.category)}</span>
            <h3 class="text-2xl font-extrabold text-slate-800 mt-2">${escapeHTML(product.nama)}</h3>
            <div class="flex items-center gap-1 mt-2 text-amber-500 text-sm">
                <i class="fa-solid fa-star"></i> ${product.rating}
            </div>
            <p class="text-2xl font-extrabold text-blue-600 mt-5">${formatRupiah(product.harga)}</p>
            <p class="text-sm text-slate-500 leading-relaxed mt-4">${escapeHTML(product.description)}</p>
            <p class="text-xs text-slate-400 mt-4">Stok tersedia: ${product.stock}</p>
            <button onclick="addProductToCart(${product.id}); closeProductDetailModal()"
                ${product.stock <= 0 ? 'disabled' : ''}
                class="mt-6 w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold disabled:bg-slate-300">
                Tambah ke Keranjang
            </button>
        </div>
    `;

    modal.classList.remove('hidden');
}

function closeProductDetailModal() {
    document.getElementById('productDetailModal')?.classList.add('hidden');
}

/* =========================
   KERANJANG
========================= */
function updateCartUI() {
    const cartCountBadge = document.getElementById('cartCountBadge');
    const cartItemsContainer = document.getElementById('cartItemsContainer');
    const cartSubtotal = document.getElementById('cartSubtotal');
    const cartTax = document.getElementById('cartTax');
    const cartTotal = document.getElementById('cartTotal');
    const checkoutTotalText = document.getElementById('checkoutTotalText');
    const cartItemCountText = document.getElementById('cartItemCountText');
    const btnProceedCheckout = document.getElementById('btnProceedCheckout');

    if (!cartItemsContainer) return;

    const totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
    const subtotal = cart.reduce((sum, item) => sum + item.harga * item.qty, 0);
    const tax = subtotal * 0.1;
    const total = subtotal + tax;

    if (cartCountBadge) {
        cartCountBadge.innerText = totalQty;
        cartCountBadge.style.transform = totalQty > 0 ? 'scale(1)' : 'scale(0)';
    }

    if (cartItemCountText) cartItemCountText.innerText = `${totalQty} Item`;
    if (cartSubtotal) cartSubtotal.innerText = formatRupiah(subtotal);
    if (cartTax) cartTax.innerText = formatRupiah(tax);
    if (cartTotal) cartTotal.innerText = formatRupiah(total);
    if (checkoutTotalText) checkoutTotalText.innerText = formatRupiah(total);
    if (btnProceedCheckout) btnProceedCheckout.disabled = cart.length === 0;

    if (cart.length === 0) {
        cartItemsContainer.innerHTML = `
            <div class="h-full flex flex-col items-center justify-center text-center p-6 text-slate-400">
                <i class="fa-solid fa-basket-shopping text-6xl mb-3 text-slate-200"></i>
                <p class="font-bold text-slate-600">Keranjang Masih Kosong</p>
                <p class="text-xs mt-1">Yuk, pilih produk favoritmu sekarang!</p>
            </div>`;
        return;
    }

    cartItemsContainer.innerHTML = cart.map(item => `
        <div class="py-3 flex items-center justify-between gap-3 border-b border-slate-100">
            <div class="flex-grow min-w-0">
                <h4 class="font-bold text-xs text-slate-800 truncate">${escapeHTML(item.nama)}</h4>
                <p class="text-xs font-semibold text-blue-600 mt-0.5">${formatRupiah(item.harga)}</p>
                <div class="flex items-center gap-2 mt-2">
                    <button onclick="changeQty(${item.id}, -1)" class="w-6 h-6 rounded-md bg-slate-100 hover:bg-slate-200 font-bold">-</button>
                    <span class="text-xs font-bold w-4 text-center">${item.qty}</span>
                    <button onclick="changeQty(${item.id}, 1)" class="w-6 h-6 rounded-md bg-slate-100 hover:bg-slate-200 font-bold">+</button>
                </div>
            </div>
            <div class="text-right">
                <button onclick="removeFromCart(${item.id})" class="text-slate-300 hover:text-red-500 text-xs mb-2">
                    <i class="fa-solid fa-trash"></i>
                </button>
                <div class="text-xs font-extrabold text-slate-800">${formatRupiah(item.harga * item.qty)}</div>
            </div>
        </div>
    `).join('');
}

function changeQty(id, delta) {
    const item = cart.find(i => i.id === id);
    const product = products.find(p => p.id === id);
    if (!item || !product) return;

    const newQty = item.qty + delta;
    if (newQty > product.stock) {
        showToast('Jumlah sudah mencapai stok maksimum.', 'error');
        return;
    }

    if (newQty <= 0) cart = cart.filter(i => i.id !== id);
    else item.qty = newQty;

    updateCartUI();
}

function removeFromCart(id) {
    cart = cart.filter(i => i.id !== id);
    updateCartUI();
    showToast('Produk dihapus dari keranjang.', 'info');
}

function toggleCartModal(open) {
    const modal = document.getElementById('cartModal');
    if (!modal) return;
    if (typeof open === 'boolean') modal.classList.toggle('hidden', !open);
    else modal.classList.toggle('hidden');
}

function openCheckoutModal() {
    if (!cart.length) {
        showToast('Keranjang kamu masih kosong!', 'error');
        return;
    }
    toggleCartModal(false);
    document.getElementById('checkoutModal')?.classList.remove('hidden');
}

function closeCheckoutModal() {
    document.getElementById('checkoutModal')?.classList.add('hidden');
}

/* =========================
   PESANAN
========================= */
function processOrder(e) {
    e?.preventDefault();
    if (!cart.length) return;

    const customer = {
        name: document.getElementById('custName')?.value.trim(),
        phone: document.getElementById('custPhone')?.value.trim(),
        payment: document.getElementById('custPayment')?.value,
        address: document.getElementById('custAddress')?.value.trim()
    };

    const subtotal = cart.reduce((sum, item) => sum + item.harga * item.qty, 0);
    const tax = subtotal * 0.1;
    const total = subtotal + tax;

    const order = {
        id: `ORD-${Date.now()}`,
        date: new Date().toISOString(),
        customer,
        items: cart.map(item => ({...item})),
        total
    };

    orders.unshift(order);
    localStorage.setItem('tokokita_orders', JSON.stringify(orders));

    cart.forEach(item => {
        const product = products.find(p => p.id === item.id);
        if (product) product.stock = Math.max(0, product.stock - item.qty);
    });
    saveProducts();

    cart = [];
    updateCartUI();
    renderProducts();
    renderCategories();
    renderOrders();
    renderAdmin();

    document.getElementById('checkoutForm')?.reset();
    closeCheckoutModal();
    showToast(`Pesanan ${order.id} berhasil dibuat!`, 'success');
    switchTab('orders');
}

function renderOrders() {
    const container = document.getElementById('orderList');
    if (!container) return;

    if (!orders.length) {
        container.innerHTML = `
            <div class="bg-white rounded-2xl border border-dashed border-slate-200 p-10 text-center">
                <i class="fa-solid fa-receipt text-4xl text-slate-300"></i>
                <h3 class="font-bold text-slate-700 mt-3">Belum Ada Pesanan</h3>
                <p class="text-sm text-slate-400 mt-1">Pesanan yang sudah checkout akan tampil di sini.</p>
            </div>`;
        return;
    }

    container.innerHTML = orders.map(order => `
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-100 pb-3">
                <div>
                    <h3 class="font-bold text-slate-800">${escapeHTML(order.id)}</h3>
                    <p class="text-xs text-slate-400">${new Date(order.date).toLocaleString('id-ID')}</p>
                </div>
                <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold">Selesai</span>
            </div>
            <div class="py-3 space-y-2">
                ${order.items.map(item => `
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-600">${escapeHTML(item.nama)} × ${item.qty}</span>
                        <span class="font-semibold">${formatRupiah(item.harga * item.qty)}</span>
                    </div>
                `).join('')}
            </div>
            <div class="border-t border-slate-100 pt-3 flex justify-between font-extrabold">
                <span>Total</span><span class="text-blue-600">${formatRupiah(order.total)}</span>
            </div>
        </div>
    `).join('');
}

function clearOrderHistory() {
    if (!orders.length) return;
    if (!confirm('Hapus semua riwayat pesanan?')) return;
    orders = [];
    localStorage.removeItem('tokokita_orders');
    renderOrders();
    renderAdmin();
    showToast('Riwayat pesanan berhasil dihapus.', 'info');
}

/* =========================
   ADMIN
========================= */
function renderAdmin() {
    const table = document.getElementById('adminProductTable');
    if (!table) return;

    document.getElementById('statTotalProducts').innerText = products.length;
    document.getElementById('statTotalRevenue').innerText = formatRupiah(
        orders.reduce((sum, order) => sum + order.total, 0)
    );
    document.getElementById('statTotalOrders').innerText = orders.length;
    document.getElementById('statLowStock').innerText = products.filter(p => p.stock < 5).length;

    table.innerHTML = products.map(product => `
        <tr>
            <td class="p-3 pl-4">
                <div class="flex items-center gap-3">
                    <img src="${escapeHTML(product.image)}" class="w-10 h-10 rounded-lg object-cover bg-slate-100"
                         onerror="this.src='https://placehold.co/100x100?text=IMG'">
                    <span class="font-semibold text-slate-700">${escapeHTML(product.nama)}</span>
                </div>
            </td>
            <td class="p-3 text-slate-500">${escapeHTML(product.category)}</td>
            <td class="p-3 font-semibold">${formatRupiah(product.harga)}</td>
            <td class="p-3 ${product.stock < 5 ? 'text-red-500 font-bold' : ''}">${product.stock}</td>
            <td class="p-3">⭐ ${product.rating}</td>
            <td class="p-3 text-right pr-4">
                <button onclick="openEditProductModal(${product.id})" class="text-blue-600 hover:text-blue-800 mr-3" title="Edit">
                    <i class="fa-solid fa-pen"></i>
                </button>
                <button onclick="deleteProduct(${product.id})" class="text-red-500 hover:text-red-700" title="Hapus">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </td>
        </tr>
    `).join('');
}

function openAddProductModal() {
    const form = document.getElementById('adminProductForm');
    form?.reset();
    document.getElementById('editProductId').value = '';
    document.getElementById('adminModalTitle').innerText = 'Tambah Produk Baru';
    document.getElementById('prodRating').value = '4.5';
    document.getElementById('adminProductModal')?.classList.remove('hidden');
}

function openEditProductModal(id) {
    const product = products.find(p => p.id === id);
    if (!product) return;

    document.getElementById('editProductId').value = product.id;
    document.getElementById('prodName').value = product.nama;
    document.getElementById('prodCategory').value = product.category;
    document.getElementById('prodPrice').value = product.harga;
    document.getElementById('prodStock').value = product.stock;
    document.getElementById('prodRating').value = product.rating;
    document.getElementById('prodImage').value = product.image;
    document.getElementById('prodDesc').value = product.description;
    document.getElementById('adminModalTitle').innerText = 'Edit Produk';
    document.getElementById('adminProductModal')?.classList.remove('hidden');
}

function closeAdminProductModal() {
    document.getElementById('adminProductModal')?.classList.add('hidden');
}

function saveAdminProduct(e) {
    e?.preventDefault();

    const idValue = document.getElementById('editProductId').value;
    const data = {
        nama: document.getElementById('prodName').value.trim(),
        category: document.getElementById('prodCategory').value.trim(),
        harga: Number(document.getElementById('prodPrice').value),
        stock: Number(document.getElementById('prodStock').value),
        rating: Number(document.getElementById('prodRating').value),
        image: document.getElementById('prodImage').value.trim(),
        description: document.getElementById('prodDesc').value.trim()
    };

    if (idValue) {
        const index = products.findIndex(p => p.id === Number(idValue));
        if (index !== -1) products[index] = {...products[index], ...data};
        showToast('Produk berhasil diperbarui.', 'success');
    } else {
        const newId = products.length ? Math.max(...products.map(p => p.id)) + 1 : 1;
        products.push({id: newId, ...data});
        showToast('Produk berhasil ditambahkan.', 'success');
    }

    saveProducts();
    closeAdminProductModal();
    renderCategories();
    renderProducts();
    renderAdmin();
}

function deleteProduct(id) {
    const product = products.find(p => p.id === id);
    if (!product) return;
    if (!confirm(`Hapus produk "${product.nama}"?`)) return;

    products = products.filter(p => p.id !== id);
    saveProducts();
    renderCategories();
    renderProducts();
    renderAdmin();
    showToast('Produk berhasil dihapus.', 'info');
}

/* =========================
   TOAST
========================= */
function showToast(message, type = 'info') {
    const container = document.getElementById('toastContainer');
    if (!container) {
        alert(message);
        return;
    }

    const bg = type === 'success'
        ? 'bg-emerald-600'
        : type === 'error'
            ? 'bg-red-600'
            : 'bg-slate-800';

    const toast = document.createElement('div');
    toast.className = `${bg} text-white text-xs font-semibold px-4 py-3 rounded-xl shadow-lg`;
    toast.innerHTML = `<span>${escapeHTML(message)}</span>`;
    container.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}
