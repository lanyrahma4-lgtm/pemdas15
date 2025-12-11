<?php
// admin/data-pengembalian.php
// Pastikan file config.php berada satu tingkat di atas folder 'admin'
include('../config.php'); 

// --- Data Dummy Transaksi yang Sudah Dikembalikan ---
// Kita akan menampilkan data yang statusnya 'Dikembalikan' dan menambahkan Tanggal Pengembalian
$data_pengembalian = [
    [
        'no' => 3,
        'nama_peminjam' => 'Budi',
        'judul_buku' => 'Filosofi Teras',
        'tgl_pinjam' => '2025-11-10',
        'tgl_kembali' => '2025-11-17', // Data baru: Tanggal Pengembalian
        'denda' => 0,
        'status' => 'Dikembalikan'
    ],
    [
        'no' => 4,
        'nama_peminjam' => 'Sinta',
        'judul_buku' => 'The Lord of the Rings',
        'tgl_pinjam' => '2025-10-25',
        'tgl_kembali' => '2025-11-01',
        'denda' => 25000, 
        'status' => 'Dikembalikan'
    ],
    [
        'no' => 5,
        'nama_peminjam' => 'Joko',
        'judul_buku' => 'Kalkulus Lanjut',
        'tgl_pinjam' => '2025-11-28',
        'tgl_kembali' => '2025-12-05',
        'denda' => 0, 
        'status' => 'Dikembalikan'
    ],
];

// --- Menangani aksi 'Hapus' (jika diperlukan) ---
// Logika POST biasanya hanya untuk aksi yang mengubah database (Edit/Hapus)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'hapus' && isset($_POST['id'])) {
    
    $id_transaksi = (int)$_POST['id'];
    
    // Logika simulasi hapus data
    // $db->query("DELETE FROM pengembalian WHERE id = $id_transaksi");
    
    $message = '<div class="alert-success">🗑️ Transaksi Pengembalian No. **' . $id_transaksi . '** berhasil dihapus (simulasi).</div>';
    // Sebaiknya lakukan Redirect setelah POST
}

$admin_name = isset($admin_name) ? $admin_name : "Pegawai";
$message = isset($message) ? $message : ''; 
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
                <div class="welcome-text">Selamat Pagi, Pegawai **<?php echo htmlspecialchars($admin_name); ?>**</div>
            </header>

            <?php if (!empty($message)): ?>
                <?php echo $message; ?>
            <?php endif; ?>

            <div class="data-table-section">
                <div class="table-header">
                    <input type="text" placeholder="Cari transaksi..." class="search-input">
                    <a href="#" class="add-btn">Verifikasi Pengembalian</a>
                </div>

                <div class="table-placeholder">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th> <th>Denda</th>
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
                                <td>**<?php echo $row['tgl_kembali']; ?>**</td> 
                                <td><?php echo 'Rp ' . number_format($row['denda'], 0, ',', '.'); ?></td>
                                <td>
                                    <span class="status-<?php echo strtolower(str_replace(' ', '-', $row['status'])); ?>">
                                        <?php echo $row['status']; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="action-btn btn-edit">Detail</a>
                                    
                                    <form method="POST" action="dataPengembalian.php" style="display:inline;">
                                        <input type="hidden" name="action" value="hapus">
                                        <input type="hidden" name="id" value="<?php echo $row['no']; ?>">
                                        
                                        <button 
                                            type="submit" 
                                            class="action-btn btn-hapus" 
                                            onclick="return confirm('Yakin ingin menghapus riwayat pengembalian No <?php echo $row['no']; ?>?');"
                                        >
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