<?php
// PASTIKAN session_start() adalah baris pertama di file PHP
session_start();
$error = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // --- 1. LOGIC UNTUK LOGIN (MASUK) ---
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($email === 'admin@polije.ac.id' && $password === '12345') {
            // Jika berhasil, buat sesi (simulasi)
            $_SESSION['user_id'] = 1;
            $_SESSION['username'] = 'Farid Fadilatul Karimah';

            // PENTING: Tambahkan pengecekan ini untuk memastikan redirection berjalan
            if (headers_sent()) {
                echo "Error: Headers already sent. Cannot redirect. Cek apakah ada spasi/text sebelum tag <?php di file index.php atau di file lain yang di-include.";
                exit;
            }

            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Email atau Password salah!";
        }
    } 
    
    // --- 2. LOGIC SIMULASI UNTUK DAFTAR (REGISTRASI) ---
    // Logika ini akan berjalan jika Anda mengganti tombol daftar menjadi form submit.
    // Saat ini, tombol daftar hanya menggunakan alert JS, jadi bagian ini hanya placeholder.
    if (isset($_POST['register'])) {
         // Di sini akan ada logic untuk menyimpan data ke database
         $success_message = "Registrasi berhasil! Silakan masuk menggunakan email dan password Anda.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Sistem Manajemen Perpustakaan Polije</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="stylesheet" href="aset/zstyle.css"> 
</head>
<body>

    <div id="login-page" class="container">
        <div class="login-left">
            <div class="login-content">
                <div class="login-logo">
                    <i class="fas fa-book-open fa-2x"></i>
                    <h1 style="color: white; margin-left: 10px;">UPA Perpustakaan Polije</h1>
                </div>
                <h2>Halo Selamat Datang</h2>
                <p>Silahkan masukkan email dan password anda untuk memulai peminjaman.</p>
                <p>Belum punya akun? Klik tombol dibawah ini.</p>
                <button id="btn-daftar" type="button" onclick="alert('Simulasi: Anda akan diarahkan ke halaman/form registrasi terpisah.')">Daftar</button>
            </div>
        </div>
        <div class="login-right">
            <h2>Masuk</h2>
            <?php if (!empty($success_message)): ?>
                 <p style="color: green; padding: 10px; background-color: #dfd; border: 1px solid green; border-radius: 4px;"><?php echo $success_message; ?></p>
            <?php endif; ?>
            <?php if (!empty($error)): ?>
                <p style="color: red; padding: 10px; background-color: #fdd; border: 1px solid red; border-radius: 4px;"><?php echo $error; ?></p>
            <?php endif; ?>
            <form class="login-form" method="POST" action="index.php">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" id="btn-masuk" name="login">Masuk</button>
            </form>
        </div>
    </div>

</body>
</html>