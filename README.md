# TokoKita - versi diperbaiki

## Penyebab navbar sebelumnya tidak bisa diklik
`navbar.php` memanggil `switchTab()`, tetapi fungsi tersebut tidak ada di `assets/js/script.js`. Akibatnya klik navbar menghasilkan `ReferenceError`.

Selain itu, beberapa fungsi lain yang dipanggil HTML juga belum tersedia, seperti `renderProducts()`, `handleSearch()`, `toggleMobileNav()`, fungsi admin, dan fungsi riwayat pesanan.

## Data produk
Data awal ada di `data/products.json`. Gambar menggunakan URL eksternal dari Unsplash.

## Cara menjalankan
Gunakan XAMPP/Laragon/PHP built-in server, jangan membuka `index.php` dengan double-click.

Contoh XAMPP:
1. Letakkan folder `Toko` di `htdocs`.
2. Jalankan Apache.
3. Buka `http://localhost/Toko/`.

Data produk yang sudah diedit/ditambah dari Dashboard Admin disimpan di `localStorage` browser.
