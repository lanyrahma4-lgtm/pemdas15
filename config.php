<?php 
include('config.php'); // WAJIB ada di baris pertama
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>UPA Perpustakaan Polije - Cari Buku</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header-blue">
        <div class="container header-content">
            <div class="logo">UPA Perpustakaan Polije</div>
            <nav>
                <a href="#">Riwayat Peminjaman</a>
                <a href="<?php echo $base_url; ?>/login.php" class="logout-btn">Login / Logout</a>
            </nav>
        </div>
    </header>
    <script src="<?php echo $base_url; ?>/script.js"></script>
</body>
</html>