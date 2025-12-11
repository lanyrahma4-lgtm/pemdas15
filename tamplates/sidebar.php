<?php
// Ambil parameter halaman saat ini dari routing dashboard.php
$current_page = $active_page ?? 'dashboard';

// Fungsi helper untuk menentukan class active
function is_active($page, $current) {
    return $page === $current ? 'active' : '';
}
?>

        <div class="sidebar">
            <div class="sidebar-header">
                UPA Perpustakaan Polije
            </div>
            <div class="sidebar-nav">
                <a href="dashboard.php?page=dashboard" class="nav-link <?php echo is_active('dashboard', $current_page); ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>

                <?php
                // Tentukan apakah dropdown 'data-base' harus aktif
                $is_data_base_active = strpos($current_page, 'data-') !== false;
                ?>
                <a href="#" class="nav-link dropdown-toggle <?php echo $is_data_base_active ? 'active' : ''; ?>" data-dropdown="data-base">
                    <i class="fas fa-database"></i> Data Base
                </a>
                <div class="dropdown-menu" id="data-base" style="display: <?php echo $is_data_base_active ? 'block' : 'none'; ?>;">
                    <a href="dashboard.php?page=data-anggota" class="nav-link <?php echo is_active('data-anggota', $current_page); ?>">Data Anggota</a>
                    <a href="dashboard.php?page=data-admin" class="nav-link <?php echo is_active('data-admin', $current_page); ?>">Data Admin</a>
                    <a href="dashboard.php?page=data-buku" class="nav-link <?php echo is_active('data-buku', $current_page); ?>">Data Buku</a>
                </div>

                <a href="dashboard.php?page=peminjaman" class="nav-link <?php echo is_active('peminjaman', $current_page); ?>">
                    <i class="fas fa-sign-out-alt fa-rotate-180"></i> Peminjaman
                </a>
                <a href="dashboard.php?page=pengembalian" class="nav-link <?php echo is_active('pengembalian', $current_page); ?>">
                    <i class="fas fa-sign-in-alt"></i> Pengembalian
                </a>
            </div>
        </div>

        <div class="main-content">
            <div class="admin-header">
                <div style="font-size: 1.2rem; font-weight: bold;" id="page-title"><?php echo $page_title; ?></div>
                <div class="user-info">
                    Selamat Pagi, **<?php echo $_SESSION['username'] ?? 'Admin'; ?>**
                    <div class="user-avatar"></div>
                </div>
            </div>

            <div class="page-content">
                ```

#### c. `templates/footer.php`

```php
        </div>
    </div>
    <script src="aset/script.js"></script>
</body>
</html>