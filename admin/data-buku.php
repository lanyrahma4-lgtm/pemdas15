<?php
include('../config.php'); 
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
                <div class="welcome-text">Selamat Pagi, Pegawai **<?php echo htmlspecialchars($admin_name); ?>**</div>
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
                            $buku_dummy = [
                                ['id' => 1, 'kategori' => 'Fiksi', 'judul' => 'Bumi', 'penulis' => 'Tere Liye', 'penerbit' => 'Gramedia', 'jumlah' => 10],
                                ['id' => 2, 'kategori' => 'Teknologi', 'judul' => 'PHP Dasar', 'penulis' => 'Farid', 'penerbit' => 'Polije Press', 'jumlah' => 5],
                            ];
                            
                            foreach ($buku_dummy as $index => $data) {
                                echo '<tr>';
                                echo '<td>' . ($index + 1) . '</td>';
                                echo '<td>' . htmlspecialchars($data['kategori']) . '</td>';
                                echo '<td>' . htmlspecialchars($data['judul']) . '</td>';
                                echo '<td>' . htmlspecialchars($data['penulis']) . '</td>';
                                echo '<td>' . htmlspecialchars($data['penerbit']) . '</td>';
                                echo '<td>' . htmlspecialchars($data['jumlah']) . '</td>';
                                echo '<td>';
                                echo '<button class="action-btn btn-edit" onclick="alert(\'Edit Buku ID ' . $data['id'] . '\')">edit</button>';
                                echo '<button class="action-btn btn-hapus" onclick="if(confirm(\'Yakin hapus ' . htmlspecialchars($data['judul']) . '?\')) { alert(\'Dihapus!\'); }">hapus</button>';
                                echo '<a href="' . $base_url . '/admin/detail-buku.php?id=' . $data['id'] . '" class="action-btn btn-detail">Detail</a>';
                                echo '</td>';
                                echo '</tr>';
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