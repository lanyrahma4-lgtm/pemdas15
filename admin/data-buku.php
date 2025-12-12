<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

$admin_nama = $_SESSION['admin_nama'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku - Admin</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="admin-layout">
        <?php include('partials/sidebar.php'); ?>

        <main class="admin-main-content">
            <header class="admin-header">
                <h2>Data Buku</h2>
                <div class="welcome-text">
                    Selamat Pagi, Pegawai <strong><?php echo htmlspecialchars($admin_nama); ?></strong>
                </div>
            </header>

            <div class="data-table-section">
                <div class="table-header">
                    <input type="text" placeholder="Cari Buku..." style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                    <a href="<?php echo $base_url; ?>/admin/tambah-buku.php" class="add-btn">Tambah Buku</a>
                </div>

                <div class="table-placeholder" style="height: auto; min-height: 300px; padding: 0;">
                    <table>
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KATEGORI</th>
                                <th>JUDUL</th>
                                <th>PENULIS</th>
                                <th>PENERBIT</th>
                                <th>JUMLAH</th>
                                <th style="width: 180px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = $conn->query("
                                SELECT b.*, k.nama AS kategori 
                                FROM buku b
                                LEFT JOIN kategori k ON b.kategori_id = k.id
                                ORDER BY b.id DESC
                            ");

                            $no = 1;

                            if ($query->num_rows > 0) {
                                while ($row = $query->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $no++ . "</td>";
                                    echo "<td>" . htmlspecialchars($row['kategori']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['judul']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['penulis']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['penerbit']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['jumlah']) . "</td>";

                                    echo "<td>";
                                    echo "<a href='edit-buku.php?id=" . $row['id'] . "' class='action-btn btn-edit'>edit</a>";
                                    echo "<a href='hapus-buku.php?id=" . $row['id'] . "' class='action-btn btn-hapus' onclick='return confirm(\"Yakin hapus " . htmlspecialchars($row['judul']) . "?\")'>hapus</a>";
                                    echo "<a href='" . $base_url . "/admin/detail-buku.php?id=" . $row['id'] . "' class='action-btn btn-detail'>Detail</a>";
                                    echo "</td>";

                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>Belum ada data buku.</td></tr>";
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>