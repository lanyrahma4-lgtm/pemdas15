// script.js
document.addEventListener('DOMContentLoaded', () => {
    // 1. Validasi client-side sederhana untuk formulir login (login.php)
    const loginForm = document.getElementById('login-form');

    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            const emailInput = document.getElementById('email').value;
            const passwordInput = document.getElementById('password').value;

            // Validasi: Pastikan field terisi
            if (!emailInput || !passwordInput) {
                event.preventDefault();
                alert('Email dan Password harus diisi!');
                return;
            }

            // Validasi format email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(emailInput)) {
                event.preventDefault();
                alert('Format email tidak valid!');
                return;
            }

            // Jika semua validasi client-side lolos, form akan disubmit ke PHP
        });
    }
});