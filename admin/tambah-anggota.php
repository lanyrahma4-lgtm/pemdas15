<?php
include('../config.php'); 
$form_message = '';
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Implementasi elemen form wajib: input type text, select
    $nama = $_POST['nama'] ?? ''; 
    $nim = $_POST['nim'] ?? '';
    $prodi = $_POST['prodi'] ?? ''; 
    
    // Simpan data ke Database/File di sini

    // Peringatan Alert sesuai permintaan
    echo '<script>alert("Anggota ' . htmlspecialchars($nama) . ' berhasil ditambahkan!"); window.location.href = "' . $base_url . '/admin/data-anggota.php";</script>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota - SIMPER</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="admin-layout">
        <?php include('partials/sidebar.php'); ?>

        <main class="admin-main-content">
            <header class="admin-header">
                <h2>Tambah Anggota</h2>
                <div class="welcome-text">Selamat Pagi, Pegawai **<?php echo htmlspecialchars($admin_name); ?>**</div>
            </header>
            
            <div class="form-section data-table-section" style="max-width: 500px; margin: 30px auto;">
                <form action="tambah-anggota.php" method="POST">
                    <h3 style="margin-bottom: 20px; color: var(--color-primary);">Tambah Anggota</h3>
                    
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" id="nama" name="nama" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="nim">NIM:</label>
                        <input type="text" id="nim" name="nim" required>
                    </div>

                    <div class="form-group">
                        <label for="prodi">Prodi:</label>
                        <select id="prodi" name="prodi" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px;">
                            <option value="">-- Pilih Program Studi --</option>
                            <option value="TIF">Teknik Informatika</option>
                            <option value="TM">Teknik Mesin</option>
                            <option value="TE">Teknik Elektro</option>
                        </select>
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