<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

$admin_nama = $_SESSION['admin_nama'];
if (isset($_GET['action']) && $_GET['action'] === 'hapus') {

    $id = intval($_GET['id']);

    $conn->query("DELETE FROM admin WHERE id=$id");

    header("Location: data-admin.php?msg=deleted");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Admin - Admin</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        .table-placeholder table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-placeholder th,
        .table-placeholder td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table-placeholder th {
            background-color: var(--color-background);
            color: var(--color-primary);
        }

        .action-btn {
            padding: 5px 10px;
            margin: 2px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
        }

        .btn-edit {
            background-color: #ffc107;
        }

        .btn-hapus {
            background-color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="admin-layout">
        <?php include('partials/sidebar.php'); ?>

        <main class="admin-main-content">
            <header class="admin-header">
                <h2>Data Admin</h2>
                <div class="welcome-text">
                    Selamat Pagi, Pegawai <strong><?php echo htmlspecialchars($admin_nama); ?></strong>
                </div>
            </header>

            <div class="data-table-section">
                <div class="table-header">
                    <input type="text" placeholder="Cari Admin..." style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                    <a href="<?php echo $base_url; ?>/admin/tambah-admin.php" class="add-btn">Tambah Admin</a>
                </div>

                <div class="table-placeholder" style="height: auto; min-height: 300px; padding: 0;">
                    <table>
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th>PASSWORD (Hashed)</th>
                                <th style="width: 150px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = $conn->query("SELECT * FROM admin ORDER BY id DESC");
                            $no = 1;

                            if ($query->num_rows > 0) {
                                while ($row = $query->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $no++ . "</td>";
                                    echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['password']) . "</td>"; 
                                    echo "<td>";
                                    echo "<a href='edit_admin.php?id=" . $row['id'] . "' class='action-btn btn-edit'>edit</a>";
                                    echo "<a href='data-admin.php?action=hapus&id=" . $row['id'] . "' class='action-btn btn-hapus' onclick='return confirm(\"Yakin hapus " . htmlspecialchars($row['nama']) . "?\")'>hapus</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>Belum ada data admin.</td></tr>";
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