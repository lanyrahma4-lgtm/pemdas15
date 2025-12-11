<?php
include('config.php'); 

$login_message = '';
$email_raw = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_raw = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $email = filter_var($email_raw, FILTER_VALIDATE_EMAIL); // Validasi Email

    if (empty($email_raw) || empty($password)) {
        $login_message = '<p style="color: red; text-align: center;">Email dan Password harus diisi!</p>';
    } else if (!$email) {
        $login_message = '<p style="color: red; text-align: center;">Format email tidak valid!</p>';
    } else {
        if ($email_raw === $ADMIN_EMAIL && $password === $ADMIN_PASSWORD) {
            header('Location: ' . $base_url . '/admin/dashboard.php');
            exit;
        } else {
            $login_message = '<p style="color: red; text-align: center;">Email atau Password salah.</p>';
        }
    }
}
?>

<?php
// login.php (Updated UI)
// Simple PHP login page (dummy auth). Replace with DB logic as needed.
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Dummy credentials (replace with database lookup)
    if ($email === 'admin@polije.ac.id' && $password === '12345') {
        $_SESSION['user'] = $email;
        header('Location: admin/dashboard.php');
        exit;
    } else {
        $error = 'Email atau password salah.';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Perpustakaan - Polije</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    *{box-sizing:border-box;margin:0;padding:0}
    body{font-family:'Poppins',sans-serif;height:100vh;display:flex}

    /* thin blue line on the very left like the mockup */
    body::before{
      content:'';
      position:fixed;left:0;top:0;bottom:0;width:6px;background:#0b63d9;
    }

    .left{width:50%;position:relative;background:url('/assets/images/books.jpg') center/cover no-repeat;display:flex;align-items:center;padding:70px;color:#fff}
    .left::after{content:'';position:absolute;inset:0;background:rgba(0,0,0,.55)}
    .left-content{position:relative;z-index:2;max-width:520px}
    .logo{display:flex;align-items:center;gap:12px;margin-bottom:28px}
    .logo img{width:36px;height:36px;object-fit:contain}
    .logo span{font-weight:600}
    h1{font-size:44px;line-height:1;letter-spacing:0.5px;margin-bottom:18px}
    p.desc{color:rgba(255,255,255,.9);font-size:14px;max-width:420px}

    .right{width:50%;display:flex;align-items:center;justify-content:center;background:#fff}
    .form-wrap{width:66%;max-width:420px;padding:40px}

    label{display:block;font-size:13px;font-weight:600;color:#222;margin-bottom:8px}
    input[type=email],input[type=password]{width:100%;padding:14px;border-radius:28px;border:none;background:#dbe5ff;margin-bottom:20px;outline:none;font-size:14px}

    .btn{display:block;margin:24px auto 0;padding:10px 34px;border-radius:22px;border:none;background:#123aa6;color:#fff;font-weight:600;cursor:pointer}

    .error{color:#b00020;background:#ffebee;padding:10px;border-radius:8px;margin-bottom:12px;text-align:center}

    /* responsive */
    @media(max-width:900px){
      body{flex-direction:column}
      .left,.right{width:100%;height:50vh}
      .left{padding:32px}
      .form-wrap{width:90%}
      body::before{display:none}
    }
  </style>
</head>
<body>

  <div class="left">
    <div class="left-content">
      <div class="logo">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Lambang_Politeknik_Negeri_Jember.png/600px-Lambang_Politeknik_Negeri_Jember.png" alt="logo">
        <div>UPA Perpustakaan Polije</div>
      </div>

      <h1>Halo<br>Selamat Datang</h1>
      <p class="desc">Silahkan masukkan email dan password anda untuk memulai peminjaman.</p>
    </div>
  </div>

  <div class="right">
    <div class="form-wrap">
      <?php if($error): ?>
        <div class="error"><?=htmlspecialchars($error)?></div>
      <?php endif; ?>

      <form method="post" action="">
        <label for="email">Email:</label>
        <input id="email" type="email" name="email" placeholder="nama@contoh.com" required>

        <label for="password">Password:</label>
        <input id="password" type="password" name="password" placeholder="Masukkan password" required>

        <button class="btn" type="submit">Masuk</button>
      </form>
    </div>
  </div>

</body>
</html>