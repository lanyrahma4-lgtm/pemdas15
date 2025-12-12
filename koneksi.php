<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "pemdas15";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


// config.php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); // Wajib ada

// UBAH INI SESUAI FOLDER ANDA
$base_url = "http://localhost/pemdas15"; 
?>
