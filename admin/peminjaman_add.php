<?php
include('../koneksi.php');

$anggota = $_POST['id_anggota'];
$buku = $_POST['id_buku'];
$tgl_pinjam = $_POST['tanggal_pinjam'];
$tgl_kembali = $_POST['tenggat'];

$sql = "INSERT INTO pinjam (id_anggota, id_buku, tanggal_pinjam, tenggat, status)
        VALUES ('$anggota', '$buku', '$tgl_pinjam', '$tgl_kembali', 'Dipinjam')";

if ($conn->query($sql)) {
    header("Location: dataPeminjaman.php");
} else {
    echo "Error: " . $conn->error;
}
?>
