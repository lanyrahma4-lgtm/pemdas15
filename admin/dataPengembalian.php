<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

$admin_nama = $_SESSION['admin_nama'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'hapus') {

    $id = intval($_POST['id']);

    $get = $conn->query("SELECT id_pinjam FROM kembali WHERE id = $id");

    if ($get && $get->num_rows > 0) {

        $row = $get->fetch_assoc();
        $id_pinjam = intval($row['id_pinjam']);
        $delete_kembali = $conn->query("DELETE FROM kembali WHERE id = $id");

        if ($delete_kembali) {

            $delete_pinjam = $conn->query("DELETE FROM pinjam WHERE id = $id_pinjam");


            header("Location: dataPengembalian.php?msg=deleted");
            exit;
        } else {
            echo "Error hapus data kembali: " . $conn->error;
        }
    } else {
        echo "Data tidak ditemukan!";
    }
}



$sql = "
SELECT 
    kembali.id AS kembali_id,
    pinjam.id AS pinjam_id,
    anggota.nama AS nama_peminjam,
    buku.judul AS judul_buku,
    pinjam.tanggal_pinjam,
    kembali.tanggal_kembali,
    pinjam.denda,
    kembali.status
FROM kembali
JOIN pinjam ON kembali.id_pinjam = pinjam.id
JOIN anggota ON pinjam.id_anggota = anggota.id
JOIN buku ON pinjam.id_buku = buku.id
ORDER BY kembali.id DESC
";

$result = $conn->query($sql);

$data_pengembalian = [];
$no = 1;

while ($row = $result->fetch_assoc()) {
    $data_pengembalian[] = [
        'no' => $no++,
        'nama_peminjam' => $row['nama_peminjam'],
        'judul_buku' => $row['judul_buku'],
        'tgl_pinjam' => $row['tanggal_pinjam'],
        'tgl_kembali' => $row['tanggal_kembali'],
        'denda' => $row['denda'],
        'status' => $row['status'],
        'id_kembali' => $row['kembali_id']
    ];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengembalian - Admin</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="admin-layout">
        <?php include('partials/sidebar.php'); ?>

        <main class="admin-main-content">
            <header class="admin-header">
                <h2>Data Pengembalian Buku</h2>
                <div class="welcome-text">
                    Selamat Pagi, Pegawai <strong><?php echo htmlspecialchars($admin_nama); ?></strong>
                </div>
            </header>

            <?php if (!empty($message)): ?>
                <?php echo $message; ?>
            <?php endif; ?>

            <div class="data-table-section">
                <div class="table-header">
                    <input type="text" placeholder="Cari transaksi..." class="search-input">
                </div>

                <div class="table-placeholder">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Denda</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_pengembalian as $row): ?>
                                <tr>
                                    <td><?php echo $row['no']; ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_peminjam']); ?></td>
                                    <td><?php echo htmlspecialchars($row['judul_buku']); ?></td>
                                    <td><?php echo $row['tgl_pinjam']; ?></td>
                                    <td><?php echo $row['tgl_kembali']; ?></td>
                                    <td><?php echo 'Rp ' . number_format($row['denda'], 0, ',', '.'); ?></td>
                                    <td>
                                        <span class="status-<?php echo strtolower(str_replace(' ', '-', $row['status'])); ?>">
                                            <?php echo $row['status']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <form method="POST" action="dataPengembalian.php" style="display:inline;">
                                            <input type="hidden" name="action" value="hapus">
                                            <input type="hidden" name="id" value="<?php echo $row['id_kembali']; ?>">

                                            <button
                                                type="submit"
                                                class="action-btn btn-hapus"
                                                onclick="return confirm('Yakin ingin menghapus riwayat pengembalian ini?');">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>


                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>