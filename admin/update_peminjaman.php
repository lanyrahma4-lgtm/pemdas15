<?php
include('../koneksi.php');

$id           = $_POST['id'];
$id_anggota   = $_POST['id_anggota'];
$id_buku      = $_POST['id_buku'];
$tanggal_pinjam = $_POST['tanggal_pinjam'];
$tenggat       = $_POST['tenggat'];

$query = $conn->query("
    UPDATE pinjam SET 
        id_anggota = '$id_anggota',
        id_buku = '$id_buku',
        tanggal_pinjam = '$tanggal_pinjam',
        tenggat = '$tenggat'
    WHERE id = '$id'
");

if ($query) {
    header("Location: dataPeminjaman.php?status=success");
} else {
    echo "Gagal update!";
}
?>
