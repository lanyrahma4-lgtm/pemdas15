<?php
include('../config.php'); 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota - Admin</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        .table-placeholder table { width: 100%; border-collapse: collapse; }
        .table-placeholder th, .table-placeholder td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        .table-placeholder th { background-color: var(--color-background); color: var(--color-primary); }
        .action-btn { padding: 5px 10px; margin: 2px; border: none; border-radius: 4px; cursor: pointer; color: white; }
        .btn-edit { background-color: #ffc107; }
        .btn-hapus { background-color: #dc3545; }
    </style>
</head>
<body>
    <div class="admin-layout">
        <?php include('partials/sidebar.php'); ?>

        <main class="admin-main-content">
            <header class="admin-header">
                <h2>Data Anggota</h2>
                <div class="welcome-text">Selamat Pagi, Pegawai **<?php echo htmlspecialchars($admin_name); ?>**</div>
            </header>

            <div class="data-table-section">
                <div class="table-header">
                    <input type="text" placeholder="Cari Anggota..." style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                    <a href="<?php echo $base_url; ?>/admin/tambah-anggota.php" class="add-btn">Tambah Anggota</a>
                </div>
                
                <div class="table-placeholder" style="height: auto; min-height: 300px; padding: 0;">
                    <table>
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>NIM</th>
                                <th>PRODI</th>
                                <th>NOMOR TELEPON</th>
                                <th style="width: 150px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $anggota_dummy = [
                                ['id' => 1, 'nama' => 'Rahmat Hidayat', 'nim' => '32041234', 'prodi' => 'TIF', 'telp' => '0812xxxxxx'],
                                ['id' => 2, 'nama' => 'Siti Aisyah', 'nim' => '32045678', 'prodi' => 'TM', 'telp' => '0813xxxxxx'],
                                ['id' => 3, 'nama' => 'Budi Santoso', 'nim' => '32049012', 'prodi' => 'TE', 'telp' => '0814xxxxxx'],
                            ];
                            
                            foreach ($anggota_dummy as $index => $data) {
                                echo '<tr>';
                                echo '<td>' . ($index + 1) . '</td>';
                                echo '<td>' . htmlspecialchars($data['nama']) . '</td>';
                                echo '<td>' . htmlspecialchars($data['nim']) . '</td>';
                                echo '<td>' . htmlspecialchars($data['prodi']) . '</td>';
                                echo '<td>' . htmlspecialchars($data['telp']) . '</td>';
                                echo '<td>';
                                echo '<button class="action-btn btn-edit" onclick="alert(\'Edit Anggota ID ' . $data['id'] . '\')">edit</button>';
                                echo '<button class="action-btn btn-hapus" onclick="if(confirm(\'Yakin hapus ' . htmlspecialchars($data['nama']) . '?\')) { alert(\'Dihapus!\'); }">hapus</button>';
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