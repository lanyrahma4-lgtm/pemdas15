<?php
include('../koneksi.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

$admin_nama = $_SESSION['admin_nama'];

if (!isset($_GET['id'])) {
    header("Location: data-anggota.php?msg=noid");
    exit;
}

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM anggota WHERE id = '$id'");
if ($result->num_rows == 0) {
    header("Location: data-anggota.php?msg=notfound");
    exit;
}
$anggota = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $prodi = mysqli_real_escape_string($conn, $_POST['prodi']);
    $notlp = mysqli_real_escape_string($conn, $_POST['notlp']);

    $sql = "
        UPDATE anggota 
        SET nama='$nama', nim='$nim', prodi='$prodi', notlp='$notlp'
        WHERE id='$id'
    ";

    if ($conn->query($sql)) {
        header("Location: data-anggota.php?msg=updated");
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
    <title>Edit Anggota - SIMPER</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="admin-layout">
        <?php include('partials/sidebar.php'); ?>

        <main class="admin-main-content">
            <header class="admin-header">
                <h2>Edit Anggota</h2>
                <div class="welcome-text">
                    Selamat Pagi, Pegawai <strong><?php echo htmlspecialchars($admin_nama); ?></strong>
                </div>
            </header>

            <div class="form-section data-table-section" style="max-width: 500px; margin: 30px auto;">
                <form action="edit_anggota.php?id=<?php echo $id; ?>" method="POST">
                    <h3 style="margin-bottom: 20px; color: var(--color-primary);">Edit Anggota</h3>

                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" id="nama" name="nama" value="<?php echo $anggota['nama']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nim">NIM:</label>
                        <input type="text" id="nim" name="nim" value="<?php echo $anggota['nim']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="prodi">Prodi:</label>
                        <select id="prodi" name="prodi" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px;">
                            <option value="">-- Pilih Program Studi --</option>
                            <option value="TIF" <?php echo ($anggota['prodi'] == 'TIF') ? 'selected' : ''; ?>>Teknik Informatika</option>
                            <option value="TM" <?php echo ($anggota['prodi'] == 'TM') ? 'selected' : ''; ?>>Teknik Mesin</option>
                            <option value="TE" <?php echo ($anggota['prodi'] == 'TE') ? 'selected' : ''; ?>>Teknik Elektro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="notlp">Nomor Telepon:</label>
                        <input type="text" id="notlp" name="notlp" value="<?php echo $anggota['notlp']; ?>" required>
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