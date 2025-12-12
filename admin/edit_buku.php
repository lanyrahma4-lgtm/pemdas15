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

$query = $conn->query("SELECT * FROM buku WHERE id = $id");
if ($query->num_rows === 0) {
    die("Buku tidak ditemukan!");
}
$buku = $query->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $kategori_id   = mysqli_real_escape_string($conn, $_POST['kategori_id']);
    $judul         = mysqli_real_escape_string($conn, $_POST['judul']);
    $penulis       = mysqli_real_escape_string($conn, $_POST['penulis']);
    $penerbit      = mysqli_real_escape_string($conn, $_POST['penerbit']);
    $tanggal       = mysqli_real_escape_string($conn, $_POST['tanggal_terbit']);
    $deskripsi     = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $jumlah        = (int) $_POST['jumlah'];

    $sql = "
        UPDATE buku SET 
            kategori_id = '$kategori_id',
            judul = '$judul',
            penulis = '$penulis',
            penerbit = '$penerbit',
            tanggal_terbit = '$tanggal',
            deskripsi = '$deskripsi',
            jumlah = '$jumlah'
        WHERE id = $id
    ";

    if ($conn->query($sql)) {
        header("Location: data-buku.php?msg=updated");
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
    <title>Edit Buku - SIMPER</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="admin-layout">
    <?php include('partials/sidebar.php'); ?>

    <main class="admin-main-content">
        <header class="admin-header">
            <h2>Edit Buku</h2>
            <div class="welcome-text">
                Selamat Pagi, Pegawai <strong><?= htmlspecialchars($admin_nama); ?></strong>
            </div>
        </header>

        <div class="form-section data-table-section" style="max-width: 650px; margin: 30px auto;">

            <form action="" method="POST">
                <h3 style="margin-bottom: 20px; color: var(--color-primary);">Edit Buku</h3>

                <div class="form-group">
                    <label for="kategori_id">Kategori:</label>
                    <select name="kategori_id" id="kategori_id" required>
                        <option value="">-- Pilih Kategori --</option>

                        <?php
                            $q = $conn->query("SELECT * FROM kategori ORDER BY nama ASC");
                            while($row = $q->fetch_assoc()) {
                                $selected = ($row['id'] == $buku['kategori_id']) ? 'selected' : '';
                                echo "<option value='".$row['id']."' $selected>".$row['nama']."</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="judul">Judul Buku:</label>
                    <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($buku['judul']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="penulis">Penulis:</label>
                    <input type="text" id="penulis" name="penulis" value="<?= htmlspecialchars($buku['penulis']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="penerbit">Penerbit:</label>
                    <input type="text" id="penerbit" name="penerbit" value="<?= htmlspecialchars($buku['penerbit']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_terbit">Tanggal Terbit:</label>
                    <input type="date" id="tanggal_terbit" name="tanggal_terbit"
                           value="<?= htmlspecialchars($buku['tanggal_terbit']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" required><?= htmlspecialchars($buku['deskripsi']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah Buku:</label>
                    <input type="number" id="jumlah" name="jumlah" min="1" value="<?= $buku['jumlah']; ?>" required>
                </div>

                <div class="form-actions" style="margin-top: 20px; text-align: center;">
                    <button type="submit" class="login-btn" style="width: 150px;">Update</button>
                </div>

            </form>
        </div>
    </main>

</div>

</body>
</html>
