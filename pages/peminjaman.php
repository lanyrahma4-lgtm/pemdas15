<div id="peminjaman" class="page-content-item">
    <h2 class="card-header">Data Peminjaman Buku</h2>
    <div class="data-header">
        <input type="text" class="search-input" placeholder="Cari transaksi">
        <a href="dashboard.php?page=tambah-pinjam" class="btn btn-primary">Tambah Peminjaman (Simulasi)</a>
    </div>
    <div class="data-table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA PEMINJAM</th>
                    <th>JUDUL BUKU</th>
                    <th>TANGGAL PINJAM</th>
                    <th>TENGGAT</th>
                    <th>DENDA</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Simulasi data
                $peminjaman = [
                    ['no' => 1, 'peminjam' => 'A. Budi', 'judul' => 'Sistem Basis Data', 'pinjam' => '01/08/25', 'tenggat' => '08/08/25', 'denda' => 'Rp 0', 'status' => 'Dipinjam'],
                ];
                foreach ($peminjaman as $row):
                ?>
                <tr>
                    <td><?php echo $row['no']; ?></td>
                    <td><?php echo $row['peminjam']; ?></td>
                    <td><?php echo $row['judul']; ?></td>
                    <td><?php echo $row['pinjam']; ?></td>
                    <td><?php echo $row['tenggat']; ?></td>
                    <td><?php echo $row['denda']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <button class="action-btn btn-dipinjam" onclick="konfirmasiPinjam(this)">Dipinjam</button>
                        <button class="action-btn btn-edit">edit</button>
                        <button class="action-btn btn-delete">hapus</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="data-table-comment">dila 4 min. ago<br>ketika tombol "dipinjam" bagian status ditekan maka akan muncul alert konfirmasi bahwa peminjaman telah berhasil</div>
    </div>
</div>