<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

$admin_nama = $_SESSION['admin_nama'];

if (!isset($_GET['id'])) {
    die("ID Admin tidak ditemukan");
}

$id = intval($_GET['id']);

$query = $conn->query("SELECT * FROM admin WHERE id = $id");

if ($query->num_rows == 0) {
    die("Admin tidak ditemukan");
}

$data = $query->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "
            UPDATE admin
            SET nama='$nama', email='$email', password='$hashedPassword'
            WHERE id=$id
        ";
    } else {
        $sql = "
            UPDATE admin
            SET nama='$nama', email='$email'
            WHERE id=$id
        ";
    }

    if ($conn->query($sql)) {
        header("Location: data-admin.php?msg=updated");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin - SIMPER</title>

    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>.error-msg { color: red; font-weight: 600; margin-bottom: 15px; text-align: center; }</style>
</head>
<body>
    <div class="admin-layout">
        <?php include('partials/sidebar.php'); ?>

        <main class="admin-main-content">
            <header class="admin-header">
                <h2>Edit Admin</h2>
                <div class="welcome-text">
                    Selamat Pagi, Pegawai <strong><?php echo htmlspecialchars($admin_nama); ?></strong>
                </div>
            </header>

            <div class="form-section data-table-section" style="max-width: 500px; margin: 30px auto;">
                <form action="edit_admin.php?id=<?php echo $id; ?>" method="POST">
                    <h3 style="margin-bottom: 20px; color: var(--color-primary);">Edit Admin</h3>
                    
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input 
                            type="text" 
                            id="nama" 
                            name="nama" 
                            required
                            value="<?php echo htmlspecialchars($data['nama']); ?>"
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            required
                            value="<?php echo htmlspecialchars($data['email']); ?>"
                        >
                    </div>

                    <div class="form-group">
                        <label for="password">
                            Password (kosongkan jika tidak diganti):
                        </label>
                        <input type="password" id="password" name="password">
                    </div>

                    <div class="form-actions" style="text-align: center; margin-top: 30px;">
                        <button type="submit" class="login-btn" style="width: 150px;">Simpan</button>
                    </div>
                </form>
            </div>

        </main>
    </div>
</body>
</html>
