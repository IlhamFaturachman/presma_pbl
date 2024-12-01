<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Prestasi Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/login.css">
</head>

<body>
    <div class="container-fluid d-flex p-0">
        <!-- Login Section -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="login-section">
                <h2>SILAHKAN LOGIN</h2>
                <form action="/auth/login" method="post">
                    <div class="mb-4">
                        <input type="text" id="username" name="username" class="form-control form-control-lg"
                            placeholder="Masukkan Username" required>
                    </div>
                    <div class="mb-4 position-relative">
                        <input type="password" id="password" name="password" class="form-control form-control-lg"
                            placeholder="Masukkan Password" required>
                        <i id="togglePassword" class="bi bi-eye toggle-password"></i>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Ingatkan Saya</label>
                        </div>
                        <a href="#" class="text-decoration-none text-primary">Lupa sandi?</a>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">MASUK</button>
                </form>
                <div class="footer-text">@2024 Sistem Pencatatan Prestasi Mahasiswa</div>
            </div>
        </div>
        <!-- Right Section -->
        <div class="col-lg-6 right-section">
            <div>
                <img src="../../public/assets/img/Logo JTI.png" alt="Logo JIT">
                <h3>Sistem Pencatatan Prestasi Mahasiswa</h3>
                <p>Jurusan Teknologi Informasi<br>Politeknik Negeri Malang</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/presma_pbl/public/assets/js/validateLogin.js"></script>
    <script>
    // Toggle Password Visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');

    togglePassword.addEventListener('click', function() {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Ganti ikon
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });
    </script>
</body>

</html>