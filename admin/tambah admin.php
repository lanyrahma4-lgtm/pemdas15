<?php
include('../config.php'); 
$form_message = '';
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? ''; 
    $email_raw = $_POST['email'] ?? '';
    $email = filter_var($email_raw, FILTER_VALIDATE_EMAIL); // Wajib filter_var()
    $password = $_POST['password'] ?? '';

    if (!$email) {
        $form_message = '<p class="error-msg">Format email tidak valid!</p>';
    } else {
        // Manipulasi String (Contoh: Kapitalisasi Nama)
        $nama_kapital = strtoupper($nama);
        
        // Simpan data ke Database/File di sini
        
        // Peringatan Alert sesuai permintaan
        echo '<script>alert("Admin ' . htmlspecialchars($nama_kapital) . ' berhasil ditambahkan!"); window.location.href = "' . $base_url . '/admin/data-admin.php";</script>';
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin - SIMPER</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>.error-msg { color: red; font-weight: 600; margin-bottom: 15px; text-align: center; }</style>
</head>
<body>
    <div class="admin-layout">
        <?php include('partials/sidebar.php'); ?>

        <main class="admin-main-content">
            <header class="admin-header">
                <h2>Tambah Admin</h2>
                <div class="welcome-text">Selamat Pagi, Pegawai **<?php echo htmlspecialchars($admin_name); ?>**</div>
            </header>
            
            <?php echo $form_message; ?>

            <div class="form-section data-table-section" style="max-width: 500px; margin: 30px auto;">
                <form action="tambah-admin.php" method="POST">
                    <h3 style="margin-bottom: 20px; color: var(--color-primary);">Tambah Admin</h3>
                    
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" id="nama" name="nama" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email_raw ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
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