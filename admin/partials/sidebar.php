<?php
include('../config.php'); 
$current_page = basename($_SERVER['PHP_SELF']);
// TAMBAH data-peminjaman.php dan data-pengembalian.php ke logic $is_data_base
$is_data_base = ($current_page == 'data-anggota.php' || $current_page == 'tambah-anggota.php' || $current_page == 'data-admin.php' || $current_page == 'tambah-admin.php' || $current_page == 'data-buku.php' || $current_page == 'tambah-buku.php' || $current_page == 'detail-buku.php'); 
// Tambahkan variabel baru untuk menu transaksi
$is_transaksi = ($current_page == 'data-peminjaman.php' || $current_page == 'data-pengembalian.php');
?>

<aside class="sidebar">
    <div class="logo">UPA Perpustakaan Polije</div>
    <ul class="sidebar-nav">
        <li>
            <a href="<?php echo $base_url; ?>/admin/dashboard.php" class="<?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">Dashboard</a>
        </li>
        <li class="has-submenu">
            <a href="#" class="<?php echo $is_data_base ? 'active' : ''; ?>">Data Base</a>
            <ul style="list-style: none; padding: 0;">
                <li><a href="<?php echo $base_url; ?>/admin/data-anggota.php" class="<?php echo ($current_page == 'data-anggota.php' || $current_page == 'tambah-anggota.php') ? 'active' : ''; ?>">Data Anggota</a></li>
                <li><a href="<?php echo $base_url; ?>/admin/data-admin.php" class="<?php echo ($current_page == 'data-admin.php' || $current_page == 'tambah-admin.php') ? 'active' : ''; ?>">Data Admin</a></li>
                <li><a href="<?php echo $base_url; ?>/admin/data-buku.php" class="<?php echo ($current_page == 'data-buku.php' || $current_page == 'tambah-buku.php' || $current_page == 'detail-buku.php') ? 'active' : ''; ?>">Data Buku</a></li>
            </ul>
        </li>
        
        <li class="has-submenu">
            <a href="#" class="<?php echo $is_transaksi ? 'active' : ''; ?>">Transaksi</a>
            <ul style="list-style: none; padding: 0;">
                 <li>
                    <a href="<?php echo $base_url; ?>/admin/dataPeminjaman.php" class="<?php echo ($current_page == 'dataPeminjaman.php') ? 'active' : ''; ?>">Peminjaman</a>
                </li>
                <li>
                    <a href="<?php echo $base_url; ?>/admin/dataPengembalian.php" class="<?php echo ($current_page == 'dataPengembalian.php') ? 'active' : ''; ?>">Pengembalian</a>
                </li>
            </ul>
        </li>
        <li><a href="<?php echo $base_url; ?>/logout.php">Logout</a></li>
    </ul>
</aside>