<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

$admin_nama = $_SESSION['admin_nama'];
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['action'])
    && $_POST['action'] == 'kembalikan'
    && isset($_POST['id'])
) {

    $id_transaksi = (int)$_POST['id'];
    $q = $conn->query("SELECT tenggat FROM pinjam WHERE id = $id_transaksi");
    $data = $q->fetch_assoc();

    $tenggat = $data['tenggat'];
    $hari_ini = date('Y-m-d');

    $telat = (strtotime($hari_ini) - strtotime($tenggat)) / 86400;
    $denda = $telat > 0 ? $telat * 5000 : 0;

    $conn->query("
        UPDATE pinjam 
        SET status='Dikembalikan',
            tgl_kembali='$hari_ini',
            denda=$denda
        WHERE id=$id_transaksi
    ");

    header("Location: dataPeminjaman.php?success");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'hapus') {

    $id = (int) $_POST['id'];

    mysqli_query($conn, "DELETE FROM pinjam WHERE id = $id");

    header("Location: dataPeminjaman.php?delete=success");
    exit;
}


$sql = "
    SELECT p.id, a.nama AS nama_peminjam, b.judul AS judul_buku,
           p.tanggal_pinjam, p.tenggat, p.denda, p.status
    FROM pinjam p
    JOIN anggota a ON p.id_anggota = a.id
    JOIN buku b ON p.id_buku = b.id
    ORDER BY p.id DESC
";

$data_peminjaman = $conn->query($sql);

?>

</html>
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
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .modal-box {
            width: 420px;
            background: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.2s ease-in-out;
        }

        .modal-box h2 {
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }

        .form-add label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
            font-weight: 600;
        }

        .form-add input,
        .form-add select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #d0d0d0;
            outline: none;
            font-size: 14px;
        }

        .form-add input:focus,
        .form-add select:focus {
            border-color: #5b8df7;
            box-shadow: 0 0 3px rgba(91, 141, 247, 0.5);
        }

       
        .modal-actions {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }

        .btn-submit {
            background: #4CAF50;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-cancel {
            background: #e74c3c;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background: #44a047;
        }

        .btn-cancel:hover {
            background: #d8433c;
        }

        @keyframes fadeIn {
            from {
                transform: scale(0.95);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="admin-layout"> <?php include('partials/sidebar.php'); ?> <main class="admin-main-content">
            <header class="admin-header">
                <h2>Data Peminjaman Buku</h2>
                <div class="welcome-text">
                    Selamat Pagi, Pegawai <strong><?php echo htmlspecialchars($admin_nama); ?></strong>
                </div>
            </header> <?php if (!empty($message)): ?> <?php echo $message; ?> <?php endif; ?> <div class="data-table-section">
                <div class="table-header"> <input type="text" placeholder="Cari transaksi..." class="search-input"> <a href="#" class="add-btn" onclick="openAddModal()">Tambah Transaksi</a>
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
                            <?php
                            $no = 1;
                            while ($row = $data_peminjaman->fetch_assoc()):
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['nama_peminjam']) ?></td>
                                    <td><?= htmlspecialchars($row['judul_buku']) ?></td>
                                    <td><?= $row['tanggal_pinjam'] ?></td>
                                    <td><?= $row['tenggat'] ?></td>
                                    <td>Rp <?= number_format($row['denda'], 0, ',', '.') ?></td>
                                    <td><button
                                            type="button"
                                            class="add-btn"
                                            onclick="showConfirmationModal(<?php echo $row['id']; ?>)">
                                            Dipinjam
                                        </button>
                                    </td>
                                    <td>
                                        <button class="action-btn btn-edit" onclick="openEditModal(<?= $row['id'] ?>)">Edit</button>

                                        <button
                                            class="action-btn btn-hapus"
                                            onclick="hapusPeminjaman(<?= $row['id'] ?>)">
                                            hapus
                                        </button>

                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <form id="hapusForm" method="POST" style="display:none;">
                        <input type="hidden" name="action" value="hapus">
                        <input type="hidden" name="id" id="hapusId">
                    </form>

                </div>
                <div id="addModal" class="modal">
                    <div class="modal-box">
                        <h2>Tambah Peminjaman</h2>

                        <form action="peminjaman_add.php" method="POST" class="form-add">

                            <label>Nama Anggota</label>
                            <select name="id_anggota" required>
                                <option value="">-- Pilih Anggota --</option>
                                <?php
                                $anggota = $conn->query("SELECT * FROM anggota");
                                while ($a = $anggota->fetch_assoc()) {
                                    echo "<option value='{$a['id']}'>{$a['nama']}</option>";
                                }
                                ?>
                            </select>

                            <label>Judul Buku</label>
                            <select name="id_buku" required>
                                <option value="">-- Pilih Buku --</option>
                                <?php
                                $buku = $conn->query("SELECT * FROM buku");
                                while ($b = $buku->fetch_assoc()) {
                                    echo "<option value='{$b['id']}'>{$b['judul']}</option>";
                                }
                                ?>
                            </select>

                            <label>Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" required>

                            <label>Tenggat Pengembalian</label>
                            <input type="date" name="tenggat" required>

                            <div class="modal-actions">
                                <button type="submit" class="btn-submit">Tambah</button>
                                <button type="button" class="btn-cancel" onclick="closeAddModal()">Batal</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div id="editModal" class="modal">
                    <div class="modal-box">
                        <h2>Edit Peminjaman</h2>

                        <form action="update_peminjaman.php" method="POST" class="form-add">

                            <input type="hidden" name="id" id="edit_id">

                            <label>Nama Anggota</label>
                            <select name="id_anggota" id="edit_anggota" required>
                                <option value="">-- Pilih Anggota --</option>
                                <?php
                                $anggota = $conn->query("SELECT * FROM anggota");
                                while ($a = $anggota->fetch_assoc()) {
                                    echo "<option value='{$a['id']}'>{$a['nama']}</option>";
                                }
                                ?>
                            </select>

                            <label>Judul Buku</label>
                            <select name="id_buku" id="edit_buku" required>
                                <option value="">-- Pilih Buku --</option>
                                <?php
                                $buku = $conn->query("SELECT * FROM buku");
                                while ($b = $buku->fetch_assoc()) {
                                    echo "<option value='{$b['id']}'>{$b['judul']}</option>";
                                }
                                ?>
                            </select>

                            <label>Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" id="edit_pinjam" required>

                            <label>Tenggat Pengembalian</label>
                            <input type="date" name="tenggat" id="edit_tenggat" required>

                            <div class="modal-actions">
                                <button type="submit" class="btn-submit">Simpan</button>
                                <button type="button" class="btn-cancel" onclick="closeEditModal()">Batal</button>
                            </div>

                        </form>
                    </div>
                </div>


            </div>
        </main>
        <div id="confirmationModal" class="modal">
            <div class="modal-content">
                <p><strong>Apa anda yakin akan merubah status peminjaman menjadi Dikembalikan?</strong></p>
                <p>Tindakan ini akan mencatat tanggal pengembalian dan menghitung denda jika ada.</p>
                <form method="POST" action="data-peminjaman.php" id="kembalikanForm">
                    <input type="hidden" name="action" value="kembalikan"> <input type="hidden" name="id" id="transaksiIdInput"> <button type="submit" class="modal-btn btn-ya">Ya</button> <button type="button" class="modal-btn btn-tidak" onclick="closeConfirmationModal()">Tidak</button>
                </form>
            </div>
        </div>
        <script>
            function hapusPeminjaman(id) {
                if (confirm("Yakin ingin menghapus transaksi ini?")) {
                    document.getElementById('hapusId').value = id;
                    document.getElementById('hapusForm').submit();
                }
            }
        </script>
        <script>
            function openAddModal() {
                document.getElementById('addModal').style.display = 'flex';
            }

            function closeAddModal() {
                document.getElementById('addModal').style.display = 'none';
            }
        </script>
        <script>
            function openEditModal(id) {
                fetch("get_peminjaman.php?id=" + id)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById("edit_id").value = data.id;
                        document.getElementById("edit_anggota").value = data.id_anggota;
                        document.getElementById("edit_buku").value = data.id_buku;
                        document.getElementById("edit_pinjam").value = data.tanggal_pinjam;
                        document.getElementById("edit_tenggat").value = data.tenggat;

                        document.getElementById("editModal").style.display = "flex";
                    });
            }

            function closeEditModal() {
                document.getElementById("editModal").style.display = "none";
            }
        </script>


    </div>
</body>

</html>