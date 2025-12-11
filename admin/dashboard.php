<?php
include('../config.php'); 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="admin-layout">
        <?php include('partials/sidebar.php'); ?>

        <main class="admin-main-content">
            <header class="admin-header">
                <h2>Dashboard Anda</h2>
                <div class="welcome-text">Selamat Pagi, Pegawai **<?php echo htmlspecialchars($admin_name); ?>**</div>
            </header>

            <div class="dashboard-cards">
                <div class="card">
                    <p class="card-number"><?php echo $stats['anggota']; ?></p>
                    <p class="card-label">Anggota</p>
                </div>
                <div class="card">
                    <p class="card-number"><?php echo $stats['admin']; ?></p>
                    <p class="card-label">Admin</p>
                </div>
                <div class="card">
                    <p class="card-number"><?php echo $stats['buku']; ?></p>
                    <p class="card-label">Buku</p>
                </div>
            </div>

            <div class="chart-container">
                <h3>Grafik Peminjaman di Bulan: Agustus</h3>
                <div class="chart-placeholder">
                    Ini Grafik, Kalkulasinya Perbulan
                </div>
            </div>
        </main>
    </div>
</body>
</html>