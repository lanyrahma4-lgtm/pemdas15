<?php
session_start();

// Cek sesi login (aktifkan ini untuk proteksi halaman)
// if (!isset($_SESSION['user_id'])) {
//     header('Location: index.php');
//     exit;
// }

// Tentukan halaman yang diminta
$page = $_GET['page'] ?? 'dashboard';

// Tentukan judul halaman
$page_titles = [
    'dashboard' => 'Dashboard',
    'data-anggota' => 'Data Anggota',
    'peminjaman' => 'Data Peminjaman Buku',
    'pengembalian' => 'Data Pengembalian Buku',
    'data-admin' => 'Data Admin (Simulasi)',
    'data-buku' => 'Data Buku (Simulasi)'
];

$page_title = $page_titles[$page] ?? 'Halaman Tidak Ditemukan';
$active_page = $page;

// 1. Sertakan Header
include 'tamplates/header.php';

// 2. Sertakan Sidebar (dan Header Admin di dalamnya)
include 'templates/sidebar.php';

// 3. Sertakan Konten Halaman yang diminta
$content_file = "pages/{$page}.php";

if (file_exists($content_file)) {
    include $content_file;
} else {
    // Tampilkan pesan jika halaman tidak ditemukan
    echo "<div style='padding: 20px; color: red;'>Halaman <strong>" . htmlspecialchars($page_title) . "</strong> (" . htmlspecialchars($page) . ") belum diimplementasikan atau tidak ditemukan.</div>";
}

// 4. Sertakan Footer
include 'templates/footer.php';
?>