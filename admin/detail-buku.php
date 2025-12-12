<?php
include('../koneksi.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

$admin_nama = $_SESSION['admin_nama'];

if (!isset($_GET['id'])) {
    header("Location: data-buku.php");
    exit;
}

$id = intval($_GET['id']);

$sql = "
    SELECT b.*, k.nama 
    FROM buku b
    LEFT JOIN kategori k ON b.kategori_id = k.id
    WHERE b.id = $id
";
$query = $conn->query($sql);

if ($query->num_rows === 0) {
    die("Data buku tidak ditemukan!");
}

$buku = $query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku - SIMPER</title>

    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        .detail-box {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            max-width: 700px;
            margin: 25px auto;
        }

        .detail-row {
            margin-bottom: 15px;
        }

        .detail-row strong {
            color: #444;
            display: inline-block;
            width: 150px;
        }

        .detail-desc {
            background: #f8f8f8;
            padding: 15px;
            border-radius: 10px;
            line-height: 1.6;
        }
    </style>
</head>
<body>

<div class="admin-layout">
    <?php include('partials/sidebar.php'); ?>

    <main class="admin-main-content">
        <header class="admin-header">
            <h2>Detail Buku</h2>
            <div class="welcome-text">
                Selamat Pagi, Pegawai <strong><?= htmlspecialchars($admin_nama); ?></strong>
            </div>
        </header>

        <div class="detail-box">

            <h3 style="margin-bottom: 20px; color: var(--color-primary);">
                <?= htmlspecialchars($buku['judul']); ?>
            </h3>

            <div class="detail-row">
                <strong>Kategori:</strong> <?= htmlspecialchars($buku['nama'] ?? '-'); ?>
            </div>

            <div class="detail-row">
                <strong>Penulis:</strong> <?= htmlspecialchars($buku['penulis']); ?>
            </div>

            <div class="detail-row">
                <strong>Penerbit:</strong> <?= htmlspecialchars($buku['penerbit']); ?>
            </div>

            <div class="detail-row">
                <strong>Tanggal Terbit:</strong> <?= htmlspecialchars($buku['tanggal_terbit']); ?>
            </div>

            <div class="detail-row">
                <strong>Jumlah Buku:</strong> <?= htmlspecialchars($buku['jumlah']); ?>
            </div>

            <div class="detail-row">
                <strong>Deskripsi:</strong>
                <div class="detail-desc">
                    <?= nl2br(htmlspecialchars($buku['deskripsi'])); ?>
                </div>
            </div>

            <div style="margin-top: 25px; text-align:center;">
                <a href="<?= $base_url ?>/admin/data-buku.php" class="login-btn" style="padding: 10px 20px;">Kembali</a>
            </div>

        </div>

    </main>

</div>

</body>
</html>
