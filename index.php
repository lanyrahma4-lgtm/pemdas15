<?php
// index.php
include('config.php');
// Redirect langsung ke halaman login
header('Location: ' . $base_url . '/login.php');
exit;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPA Perpustakaan Polije - Cari Buku</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header-blue">
        <div class="container header-content">
            <div class="logo">UPA Perpustakaan Polije</div>
            <nav>
                <a href="#">Riwayat Peminjaman</a>
                <a href="login.php" class="logout-btn">Login / Logout</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="search-section">
            <div class="container">
                <h1>Cari dan Temukan Buku Favoritmu Disini</h1>
                <div class="search-box">
                    <form action="index.php" method="GET">
                        <input type="text" name="keyword" id="search-input" placeholder="Ketikkan nama buku/penulis/penerbit" onkeyup="filterBooks()" value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
                        <button type="submit" class="search-icon">&#x1F50D;</button>
                    </form>
                    
                    <?php
                        $search_keyword = isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '';
                        if (!empty($search_keyword)) {
                            echo "<p style='margin-top: 10px;'>Menampilkan hasil untuk: <strong>" . $search_keyword . "</strong></p>";
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="container book-container-wrapper">
            <div class="book-grid" id="book-grid">
                <?php
                // Data dummy buku
                $books = [
                    ['title' => 'Bumi', 'author' => 'Tere Liye', 'image' => 'buku_bumi.jpg'],
                    ['title' => 'Bulan', 'author' => 'Tere Liye', 'image' => 'buku_bumi.jpg'],
                    ['title' => 'Matahari', 'author' => 'Tere Liye', 'image' => 'buku_bumi.jpg'],
                    ['title' => 'Komet', 'author' => 'Tere Liye', 'image' => 'buku_bumi.jpg'],
                    ['title' => 'Ceros', 'author' => 'Tere Liye', 'image' => 'buku_bumi.jpg'],
                    ['title' => 'Bintang', 'author' => 'Tere Liye', 'image' => 'buku_bumi.jpg'],
                    ['title' => 'Selena', 'author' => 'Tere Liye', 'image' => 'buku_bumi.jpg'],
                    ['title' => 'Nebula', 'author' => 'Tere Liye', 'image' => 'buku_bumi.jpg'],
                ];

                foreach ($books as $book) {
                    echo '<div class="book-card">';
                    echo '<img src="' . htmlspecialchars($book['image']) . '" alt="Sampul Buku ' . htmlspecialchars($book['title']) . '">';
                    echo '<p class="book-title">' . htmlspecialchars($book['title']) . '</p>';
                    echo '<p class="book-author">' . htmlspecialchars($book['author']) . '</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </main>

    <script src="script.js"></script>
</body>
</html>