<?php
// Global Configuration
$pageTitle = "TokoKita - Toko Online Modern";
$storeName = "TokoKita";
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    
    <!-- CDN & Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom Stylesheet (Assets Folder) -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="flex flex-col min-h-full font-sans text-slate-800 bg-slate-50 antialiased selection:bg-blue-500 selection:text-white">

    <!-- Navbar Component -->
    <?php include_once 'includes/navbar.php'; ?>

    <!-- Main Content Views -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?php 
            include_once 'views/shop.php';
            include_once 'views/orders.php';
            include_once 'views/admin.php';
        ?>
    </main>

    <!-- Modal Components -->
    <?php 
        include_once 'views/cart-modal.php';
        include_once 'views/checkout-modal.php';
        include_once 'views/detail-modal.php';
        include_once 'views/admin-modal.php';
    ?>

    <!-- Toast Notification Container -->
    <div id="toastContainer" class="fixed bottom-5 right-5 z-50 flex flex-col gap-2 pointer-events-none"></div>

    <!-- Application Script (Assets Folder) -->
    <script src="assets/js/script.js"></script>
</body>
</html>