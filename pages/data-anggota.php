<div id="data-anggota" class="page-content-item">
    <h2 class="card-header">Data Anggota</h2>
    <div class="data-header">
        <input type="text" class="search-input" placeholder="Cari anggota">
        <a href="dashboard.php?page=tambah-anggota" class="btn btn-primary">Tambah Anggota</a>
    </div>
    <div class="data-table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>NIM</th>
                    <th>PRODI</th>
                    <th>NOMOR TELEPON</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Simulasi data dari database
                $anggota = [
                    ['no' => 1, 'nama' => 'A. Budi', 'nim' => 'E4120001', 'prodi' => 'TI', 'telp' => '081xxx'],
                    ['no' => 2, 'nama' => 'B. Citra', 'nim' => 'E4120002', 'prodi' => 'MI', 'telp' => '082xxx'],
                ];
                foreach ($anggota as $row):
                ?>
                <tr>
                    <td><?php echo $row['no']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['nim']; ?></td>
                    <td><?php echo $row['prodi']; ?></td>
                    <td><?php echo $row['telp']; ?></td>
                    <td>
                        <button class="action-btn btn-edit">edit</button>
                        <button class="action-btn btn-delete">hapus</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <div class="data-table-comment">dila 1 hr. ago<br>disini tabel</div>
    </div>
</div>