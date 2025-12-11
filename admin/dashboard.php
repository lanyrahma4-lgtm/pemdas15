<?php
include('../config.php'); // Ambil Base URL

// Simulasi data dari sesi/database
$admin_name = "Farid Thaufiqul Karimah"; 
$stats = [
    'anggota' => 200,
    'buku' => 700,
    'pinjam' => 300,
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIMPER</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="admin-layout">
        <?php include('partials/sidebar.php'); ?>

        <main class="admin-main-content">
            <header class="admin-header">
                <div>
                    <h2>Dashboard</h2>
                    <p class="welcome-text">Selamat Pagi, Pegawai **<?php echo htmlspecialchars($admin_name); ?>**</p>
                </div>
            </header>

            <div class="dashboard-cards">
                <div class="card anggota">
                    <div class="card-content">
                        <p class="card-number"><?php echo $stats['anggota']; ?></p>
                        <p class="card-label">Anggota Aktif</p>
                    </div>
                </div>
                <div class="card buku">
                    <div class="card-content">
                        <p class="card-number"><?php echo $stats['buku']; ?></p>
                        <p class="card-label">Total Buku</p>
                    </div>
                </div>
                <div class="card pinjam">
                    <div class="card-content">
                        <p class="card-number"><?php echo $stats['pinjam']; ?></p>
                        <p class="card-label">Peminjaman Hari Ini</p>
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px;">
                <h3>Grafik Pergerakan Data Anggota</h3>
                <div class="placeholder-area">
                    Histogram pergerakan data M/B (360 x 180)
                </div>
            </div>
        </main>
    </div>
    <script src="<?php echo $base_url; ?>/script.js"></script>
</body>
</html>