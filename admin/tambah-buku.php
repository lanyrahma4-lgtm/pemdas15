<?php
include('../config.php'); 
$form_message = '';
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi sederhana
    $judul = $_POST['judul'] ?? ''; 
    $penulis = $_POST['penulis'] ?? '';
    
    // Simpan data
    
    echo '<script>alert("Buku ' . htmlspecialchars($judul) . ' berhasil ditambahkan!"); window.location.href = "' . $base_url . '/admin/data-buku.php";</script>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - SIMPER</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="admin-layout">
        <?php include('partials/sidebar.php'); ?>

        <main class="admin-main-content">
            <header class="admin-header">
                <h2>Tambah Buku</h2>
                <div class="welcome-text">Selamat Pagi, Pegawai **<?php echo htmlspecialchars($admin_name); ?>**</div>
            </header>
            
            <div class="form-section data-table-section">
                <form action="tambah-buku.php" method="POST">
                    <h3 style="margin-bottom: 20px; color: var(--color-primary);">Frame 16: Tambah Buku</h3>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label for="kategori">Kategori:</label>
                            <select id="kategori" name="kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Fiksi">Fiksi</option>
                                <option value="Teknologi">Teknologi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_terbit">Tanggal Terbit:</label>
                            <input type="date" id="tanggal_terbit" name="tanggal_terbit" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="judul">Judul Buku:</label>
                            <input type="text" id="judul" name="judul" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi:</label>
                            <textarea id="deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="penulis">Penulis:</label>
                            <input type="text" id="penulis" name="penulis" required>
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit:</label>
                            <input type="text" id="penerbit" name="penerbit" required>
                        </div>
                    </div>

                    <div class="form-actions" style="text-align: center; margin-top: 30px;">
                        <button type="submit" class="login-btn" style="width: 150px;">Tambah</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>