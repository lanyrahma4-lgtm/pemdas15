/*
 * ======================================
 * File: assets/js/script.js
 * ======================================
 */

// 1. Fungsi konfirmasi Peminjaman (sesuai comment gambar)
function konfirmasiPinjam(buttonElement) {
    if (confirm("Konfirmasi: Peminjaman ini telah berhasil dilakukan?")) {
        alert("Peminjaman berhasil dikonfirmasi!");
        // Simulasi perubahan tampilan/status
        const row = buttonElement.closest('tr');
        const statusCell = row.cells[6]; // Asumsi kolom status peminjaman adalah index 6
        statusCell.textContent = 'Terkonfirmasi';
        buttonElement.style.display = 'none'; // Sembunyikan tombol 'Dipinjam'
    }
}

// 2. Fungsi konfirmasi Pengembalian (sesuai comment gambar)
function konfirmasiKembali(buttonElement) {
    if (confirm("Konfirmasi: Buku sudah dikembalikan? Sistem akan menghitung stok kembali.")) {
        alert("Pengembalian berhasil dikonfirmasi! Stok buku telah ditambahkan kembali.");
        // Simulasi perubahan tampilan/status
        buttonElement.textContent = 'Selesai';
        buttonElement.disabled = true;
        buttonElement.classList.remove('btn-dikembalikan');
        buttonElement.classList.add('btn-success');
    }
}

// 3. JS untuk Toggling Dropdown (Data Base)
document.addEventListener('DOMContentLoaded', () => {
     const dropdownToggle = document.querySelector('.dropdown-toggle[data-dropdown="data-base"]');
     if (dropdownToggle) {
         dropdownToggle.addEventListener('click', function(e) {
             e.preventDefault();
             const targetDropdown = document.getElementById(this.getAttribute('data-dropdown'));
             // Toggle display, jika block maka jadi none, jika tidak block maka jadi block
             targetDropdown.style.display = targetDropdown.style.display === 'block' ? 'none' : 'block';
         });
     }
 });