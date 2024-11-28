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
    <style>
    body,
    html {
        height: 100%;

        margin: 0;
        font-family: Arial, sans-serif;
    }

    .container-fluid {
        height: 100vh;
        display: flex;
    }

    .login-section {
        background-color: #f9f9f9;
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 500px;
        height: auto;
        min-height: 500px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin: 0 auto;
    }

    .login-section h2 {
        font-weight: bold;
        font-size: 28px;
        text-align: center;
        margin-bottom: 30px;
    }

    .btn-primary {
        background-color: #002F86;
        border-radius: 10px;
        padding: 15px;
        font-size: 18px;
    }

    .btn-primary:hover {
        background-color: #001E5A;
    }

    .form-control {
        border-radius: 8px;
    }

    .form-check-label,
    a {
        font-size: 14px;
    }

    .footer-text {
        font-size: 14px;
        color: #aaa;
        text-align: center;
        margin-top: 20px;
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #aaa;
        font-size: 20px;
    }

    .toggle-password:hover {
        color: #666;
    }

    .right-section {
        padding: 0px;
        background-color: #002F86;
        color: #fff;
        text-align: center;
        border-radius: 90px 0 0 90px;
        padding: 80px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .right-section img {
        max-width: 200px;
        margin-bottom: 20px;
    }

    .right-section h3 {
        font-weight: bold;
        font-size: 24px;
        margin-bottom: 5px;
    }

    .right-section p {
        font-size: 20px;
        line-height: 1.5;
    }

    /* Responsiveness */
    @media (max-width: 992px) {
        .right-section {
            display: none;
        }

        .container-fluid {
            flex-direction: column;
        }

        .login-section {
            margin: auto;
        }
    }
    </style>
</head>

<body>
    <div class="container-fluid d-flex p-0">
        <!-- Login Section -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="login-section">
                <h2>SILAHKAN LOGIN</h2>
                <form action="login_proses.php" method="post">
                    <div class="mb-4">
                        <input type="text" class="form-control form-control-lg" placeholder="Masukkan Username"
                            required>
                    </div>
                    <div class="mb-4 position-relative">
                        <input type="password" id="password" class="form-control form-control-lg"
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