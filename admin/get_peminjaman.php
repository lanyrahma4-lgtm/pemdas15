<?php
include('../koneksi.php');

$id = $_GET['id'];
$query = $conn->query("SELECT * FROM pinjam WHERE id = '$id'");
$data = $query->fetch_assoc();

echo json_encode($data);
?>
