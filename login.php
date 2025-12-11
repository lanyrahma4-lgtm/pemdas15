<?php
include('config.php'); // Ambil Base URL dan Kredensial Admin

// Logika PHP untuk proses Login
$login_message = '';
$email_raw = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_raw = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $email = filter_var($email_raw, FILTER_VALIDATE_EMAIL); // Wajib: filter_var()

    if (empty($email_raw) || empty($password)) {
        $login_message = '<p style="color: red; text-align: center;">Email dan Password harus diisi!</p>';
    } else if (!$email) {
        $login_message = '<p style="color: red; text-align: center;">Format email tidak valid!</p>';
    } else {
        // Cek Otentikasi
        if ($email_raw === $ADMIN_EMAIL && $password === $ADMIN_PASSWORD) {
            // Login Berhasil!
            // Harusnya di sini ada session_start() dan $_SESSION['user']
            header('Location: ' . $base_url . '/admin/dashboard.php'); // Redirect menggunakan Base URL
            exit;
        } else {
            $login_message = '<p style="color: red; text-align: center;">Email atau Password salah. (Hint: Gunakan ' . $ADMIN_EMAIL . ' dan ' . $ADMIN_PASSWORD . ')</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="login-page">

    <div class="login-container">
        <div class="login-left">
            <h2>Halo Selamat Datang</h2>
            <p>Silakan masukkan email dan password anda untuk memulai peminjaman.</p>
            <p style="font-size: 0.8em; margin-top: 20px;">Belum punya akun? Cek tombol dibawah ini.</p>
            <a href="<?php echo $base_url; ?>/register.php" class="logout-btn" style="background-color: white; color: var(--color-primary); border: none;">Daftar</a>
        </div>

        <div class="login-right">
            <h3>Login</h3>
            <?php echo $login_message; ?>

            <form id="login-form" method="POST" action="login.php">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email_raw); ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-btn">Masuk</button>
            </form>
        </div>
    </div>

    <script src="<?php echo $base_url; ?>/script.js"></script>
</body>
</html>