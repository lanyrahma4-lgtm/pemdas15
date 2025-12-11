<?php
// admin/data-peminjaman.php
include('../config.php'); 

// Data dummy (akan diganti dengan data database)
$data_peminjaman = [
    [
        'no' => 1,
        'nama_peminjam' => 'Rizky',
        'judul_buku' => 'Bumi - Tere Liye',
        'tgl_pinjam' => '2025-11-20',
        'tenggat' => '2025-11-27',
        'denda' => 0,
        'status' => 'Dipinjam'
    ],
    [
        'no' => 2,
        'nama_peminjam' => 'Ahmad',
        'judul_buku' => 'Laskar Pelangi',
        'tgl_pinjam' => '2025-11-15',
        'tenggat' => '2025-11-22',
        'denda' => 5000, 
        'status' => 'Dipinjam'
    ],
    [
        'no' => 3,
        'nama_peminjam' => 'Budi',
        'judul_buku' => 'Filosofi Teras',
        'tgl_pinjam' => '2025-11-10',
        'tenggat' => '2025-11-17',
        'denda' => 10000, 
        'status' => 'Dikembalikan'
    ],
];

// --- Menangani aksi 'Dikembalikan' menggunakan metode POST yang aman ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'kembalikan' && isset($_POST['id'])) {
    
    // 1. Ambil ID
    $id_transaksi = (int)$_POST['id'];
    
    // 2. Logika update status database di sini...
    // PENTING: Implementasi nyata akan menggunakan SQL UPDATE
    // Contoh: $db->query("UPDATE peminjaman SET status='Dikembalikan', tgl_kembali=NOW() WHERE id = $id_transaksi");
    
    $message = '<div class="alert-success">✅ Transaksi No. **' . $id_transaksi . '** berhasil diubah statusnya menjadi Dikembalikan (simulasi).</div>';
    
    // header("Location: data-peminjaman.php?status=success");
    // exit(); 
}

$admin_name = isset($admin_name) ? $admin_name : "Pegawai";
$message = isset($message) ? $message : ''; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman - Admin</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
    .modal {
        display: none; 
        position: fixed; 
        z-index: 1000; 
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.6); 
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; 
        padding: 20px;
        border-radius: 8px;
        width: 80%; 
        max-width: 400px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .modal-btn {
        padding: 10px 20px;
        margin: 10px 5px;
        cursor: pointer;
        border: none;
        border-radius: 4px;
        color: white;
    }

    .btn-ya {
        background-color: #007bff; 
    }

    .btn-tidak {
        background-color: #dc3545; 
    }
    </style>
</head>
<body>
    <div class="admin-layout">
        <?php include('partials/sidebar.php'); ?>

        <main class="admin-main-content">
            <header class="admin-header">
                <h2>Data Peminjaman Buku</h2>
                <div class="welcome-text">Selamat Pagi, Pegawai **<?php echo htmlspecialchars($admin_name); ?>**</div>
            </header>

            <?php if (!empty($message)): ?>
                <?php echo $message; ?>
            <?php endif; ?>

            <div class="data-table-section">
                <div class="table-header">
                    <input type="text" placeholder="Cari transaksi..." class="search-input">
                    <a href="#" class="add-btn">Tambah Transaksi</a>
                </div>

                <div class="table-placeholder">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tenggat</th>
                                <th>Denda</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_peminjaman as $row): ?>
                            <tr>
                                <td><?php echo $row['no']; ?></td>
                                <td><?php echo htmlspecialchars($row['nama_peminjam']); ?></td>
                                <td><?php echo htmlspecialchars($row['judul_buku']); ?></td>
                                <td><?php echo $row['tgl_pinjam']; ?></td>
                                <td><?php echo $row['tenggat']; ?></td>
                                <td><?php echo 'Rp ' . number_format($row['denda'], 0, ',', '.'); ?></td>
                                <td>
                                    <span class="status-<?php echo strtolower(str_replace(' ', '-', $row['status'])); ?>">
                                        <?php echo $row['status']; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="action-btn btn-edit">Edit</a>
                                    <button class="action-btn btn-hapus" onclick="return confirm('Yakin ingin menghapus transaksi No <?php echo $row['no']; ?>?');">Hapus</button>
                                    
                                    <?php if ($row['status'] == 'Dipinjam'): ?>
                                        <button 
                                            type="button" 
                                            class="action-btn btn-detail" 
                                            onclick="showConfirmationModal(<?php echo $row['no']; ?>)"
                                        >
                                            Dikembalikan
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        
        <div id="confirmationModal" class="modal">
            <div class="modal-content">
                <p><strong>Apa anda yakin akan merubah status peminjaman menjadi Dikembalikan?</strong></p>
                <p>Tindakan ini akan mencatat tanggal pengembalian dan menghitung denda jika ada.</p>

                <form method="POST" action="dataeminjaman.php" id="kembalikanForm">
                    <input type="hidden" name="action" value="kembalikan">
                    <input type="hidden" name="id" id="transaksiIdInput">
                    
                    <button type="submit" class="modal-btn btn-ya">Ya</button>
                    <button type="button" class="modal-btn btn-tidak" onclick="closeConfirmationModal()">Tidak</button>
                </form>
            </div>
        </div>

        <script>
            var modal = document.getElementById('confirmationModal');
            var idInput = document.getElementById('transaksiIdInput');

            function showConfirmationModal(transaksiId) {
                idInput.value = transaksiId; 
                modal.style.display = "block";
            }

            function closeConfirmationModal() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    closeConfirmationModal();
                }
            }
        </script>
        
    </div>
</body>
</html>