<?php
include('../config.php'); 
$admin_name = "Farid Thaufiqul Karimah";
$success_message = '';
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Wajib: Manipulasi String (contoh: uppercase nama)
    $nama = strtoupper($_POST['nama'] ?? ''); 
    
    // Logika penyimpanan data ke database
    
    $success_message = '<p style="color: green; font-weight: 600; margin-bottom: 15px;">Anggota ' . htmlspecialchars($nama) . ' berhasil ditambahkan!</p>';
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
                <div>
                    <h2>Tambah Anggota</h2>
                    <p class="welcome-text">Selamat Pagi, Pegawai **<?php echo htmlspecialchars($admin_name); ?>**</p>
                </div>
            </header>

            <div class="tab-navigation">
                <a href="<?php echo $base_url; ?>/admin/data-anggota.php" class="tab-nav-item">Data Anggota</a>
                <a href="<?php echo $base_url; ?>/admin/tambah-anggota.php" class="tab-nav-item active">Tambah Anggota</a>
            </div>
            
            <?php echo $success_message; ?>

            <div class="form-section">
                <form action="tambah-anggota.php" method="POST">
                    <h3 style="margin-bottom: 20px; color: var(--color-primary);">Data Diri Anggota</h3>
                    
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="nim_nis">NIM/NIS</label>
                        <input type="text" id="nim_nis" name="nim_nis" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="level">Tipe Anggota (Select)</label>
                        <select id="level" name="level" required>
                            <option value="">-- Pilih Tipe --</option>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="dosen">Dosen</option>
                            <option value="umum">Umum</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Status Keanggotaan (Radio Button)</label><br>
                        <input type="radio" id="aktif" name="status" value="aktif" checked> <label for="aktif" style="display: inline; font-weight: normal;">Aktif</label>
                        <input type="radio" id="nonaktif" name="status" value="nonaktif"> <label for="nonaktif" style="display: inline; font-weight: normal;">Nonaktif</label>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data Anggota</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script src="<?php echo $base_url; ?>/script.js"></script>
</body>
</html>