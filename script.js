// script.js
document.addEventListener('DOMContentLoaded', () => {
    // 1. Fungsi filter sederhana untuk Halaman Katalog
    window.filterBooks = function() {
        const searchInput = document.getElementById('search-input').value.toLowerCase();
        const bookGrid = document.getElementById('book-grid');
        
        if (bookGrid) {
            const bookCards = bookGrid.querySelectorAll('.book-card');
            bookCards.forEach(card => {
                const title = card.querySelector('.book-title').textContent.toLowerCase();
                const author = card.querySelector('.book-author').textContent.toLowerCase();

                if (title.includes(searchInput) || author.includes(searchInput)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    }

    // 2. Validasi client-side sederhana untuk formulir login
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            const emailInput = document.getElementById('email').value;
            const passwordInput = document.getElementById('password').value;

            if (!emailInput || !passwordInput) {
                event.preventDefault();
                alert('Email dan Password harus diisi!');
                return;
            }
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(emailInput)) {
                event.preventDefault();
                alert('Format email tidak valid!');
                return;
            }
        });
    }
});