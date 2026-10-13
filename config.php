<?php
// Konfigurasi database (opsional). Versi demo ini menggunakan data/products.json
// dan localStorage, sehingga halaman tetap dapat berjalan tanpa MySQL.
$host = "localhost";
$user = "root";
$pass = "";
$db   = "toko_online";

$conn = @new mysqli($host, $user, $pass, $db);
?>
