<?php
include('../config.php'); // Ambil Base URL
$current_page = basename($_SERVER['PHP_SELF']);
?>

<aside class="sidebar">
    <div class="logo">SIMPER</div>
    <ul class="sidebar-nav">
        <li>
            <a href="<?php echo $base_url; ?>/admin/dashboard.php" class="<?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                <span class="icon">🏠</span> Dashboard
            </a>
        </li>
        <li>
            <a href="<?php echo $base_url; ?>/admin/data-anggota.php" class="<?php echo ($current_page == 'data-anggota.php' || $current_page == 'tambah-anggota.php') ? 'active' : ''; ?>">
                <span class="icon">👤</span> Data Anggota
            </a>
        </li>
        <li>
            <a href="#">
                <span class="icon">📚</span> Data Buku
            </a>
        </li>
        <li>
            <a href="#">
                <span class="icon">➡️</span> Peminjaman
            </a>
        </li>
        <li>
            <a href="#">
                <span class="icon">↩️</span> Pengembalian
            </a>
        </li>
        <li>
            <a href="#">
                <span class="icon">⚙️</span> Settings
            </a>
        </li>
    </ul>
</aside>