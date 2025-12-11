<?php
include('../config.php'); 
$admin_name = "Farid Thaufiqul Karimah";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota - SIMPER</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="admin-layout">
        <?php include('partials/sidebar.php'); ?>

        <main class="admin-main-content">
            <header class="admin-header">
                <div>
                    <h2>Data Anggota</h2>
                    <p class="welcome-text">Selamat Pagi, Pegawai **<?php echo htmlspecialchars($admin_name); ?>**</p>
                </div>
                <a href="<?php echo $base_url; ?>/admin/tambah-anggota.php" class="btn btn-primary">Tambah Anggota</a>
            </header>

            <div class="dashboard-cards" style="margin-bottom: 20px;">
                <div class="card anggota" style="flex: 0 0 150px;">
                    <div class="card-content">
                        <p class="card-number">1000</p>
                        <p class="card-label">Total Aktif</p>
                    </div>
                </div>
                <div class="card" style="flex: 1;">
                    <p style="color: var(--color-primary); font-weight: 600;">Pergerakan data anggota</p>
                    <div class="placeholder-area" style="height: 120px;">
                        Histogram pergerakan data anggota (360 x 180)
                    </div>
                </div>
            </div>
            
            <div class="tab-navigation">
                <a href="<?php echo $base_url; ?>/admin/data-anggota.php" class="tab-nav-item active">Data Semua Anggota</a>
                <a href="#" class="tab-nav-item">Status</a>
                <a href="#" class="tab-nav-item">Lain-lain</a>
            </div>

            <div class="form-section" style="padding: 20px;">
                <h3 style="margin-bottom: 15px; color: var(--color-primary);">Tabel Data Anggota</h3>
                <div class="placeholder-area" style="height: 300px; border: 1px solid #ccc;">
                    DISINI TABEL
                </div>
                
                <div style="margin-top: 20px; text-align: right;">
                    <button class="btn btn-secondary">Cetak</button>
                    <button class="btn btn-primary">Generate QR Code</button>
                </div>
            </div>
        </main>
    </div>
    <script src="<?php echo $base_url; ?>/script.js"></script>
</body>
</html>