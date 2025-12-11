<div id="pengembalian" class="page-content-item">
    <h2 class="card-header">Data Pengembalian Buku</h2>
    <div class="data-header">
        <input type="text" class="search-input" placeholder="Cari transaksi">
    </div>
    <div class="data-table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA PENGEMBALI</th>
                    <th>JUDUL BUKU</th>
                    <th>TANGGAL PENGEMBALIAN</th>
                    <th>DENDA</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Simulasi data
                $pengembalian = [
                    ['no' => 1, 'pengembali' => 'C. Dodo', 'judul' => 'Pemrograman Web', 'kembali' => '10/08/25', 'denda' => 'Rp 5.000'],
                ];
                foreach ($pengembalian as $row):
                ?>
                <tr>
                    <td><?php echo $row['no']; ?></td>
                    <td><?php echo $row['pengembali']; ?></td>
                    <td><?php echo $row['judul']; ?></td>
                    <td><?php echo $row['kembali']; ?></td>
                    <td><?php echo $row['denda']; ?></td>
                    <td>
                        <button class="action-btn btn-dikembalikan" onclick="konfirmasiKembali(this)">dikembalikan</button>
                        <button class="action-btn btn-delete">hapus</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="data-table-comment">dila 1 min. ago<br>ketika status sudah dikembalikan, sistem akan menghitung kembali stok buku di tabel buku</div>
    </div>
</div>