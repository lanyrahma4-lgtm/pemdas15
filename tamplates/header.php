<?php
// Variabel untuk menentukan halaman aktif (akan diisi oleh file konten)
$page_title = $page_title ?? 'Dashboard';
$active_page = $active_page ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Perpustakaan Polije</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="aset/style.css">
</head>
<body>
    <div id="admin-layout">