<?php
include('../config.php'); 
// Mengambil ID dari URL
$book_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Data dummy (ganti ini dengan query database)
$book_data = [
    1 => ['judul' => 'Bumi', 'penerbit' => 'Gramedia', 'penulis' => 'Tere Liye', 'terbit' => '2014-01-01', 'stok' => 10, 'deskripsi' => 'Sebuah novel fiksi ilmiah fantasi.'],
    2 => ['judul' => 'PHP Dasar', 'penerbit' => 'Polije Press', 'penulis' => 'Farid', 'terbit' => '2025-01-01', 'stok' => 5, 'deskripsi' => 'Panduan lengkap dasar-dasar pemrograman PHP.'],
];

$detail = $book_data[$book_id] ?? null;

if (!$detail) {
    echo "<script>alert('Buku tidak ditemukan.'); window.location.href = '" . $base_url . "/admin/data-buku.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku - <?php echo htmlspecialchars($detail['judul']); ?></title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="admin-layout">
        <?php include('partials/sidebar.php'); ?>

        <main class="admin-main-content">
            <header class="admin-header">
                <h2>Detail Buku</h2>
                <div class="welcome-text">Selamat Pagi, Pegawai **<?php echo htmlspecialchars($admin_name); ?>**</div>
            </header>
            
            <div class="data-table-section" style="max-width: 700px; margin: 30px auto;">
                <h1 style="color: var(--color-primary); margin-bottom: 20px;"><?php echo htmlspecialchars($detail['judul']); ?></h1>
                
                <table style="width: 100%; border: none;">
                    <tr><td style="width: 30%; font-weight: 600;">Penerbit</td><td>: <?php echo htmlspecialchars($detail['penerbit']); ?></td></tr>
                    <tr><td style="width: 30%; font-weight: 600;">Penulis</td><td>: <?php echo htmlspecialchars($detail['penulis']); ?></td></tr>
                    <tr><td style="width: 30%; font-weight: 600;">Tanggal Terbit</td><td>: <?php echo htmlspecialchars($detail['terbit']); ?></td></tr>
                    <tr><td style="width: 30%; font-weight: 600;">Stok</td><td>: <?php echo htmlspecialchars($detail['stok']); ?></td></tr>
                </table>

                <h3 style="margin-top: 30px; margin-bottom: 10px; color: var(--color-primary);">Deskripsi</h3>
                <p><?php echo nl2br(htmlspecialchars($detail['deskripsi'])); ?></p>
            </div>
        </main>
    </div>
</body>
</html>