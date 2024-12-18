<!-- <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Ambil informasi pengguna dari sesi
        $userId = $_SESSION['user']['id'];
        $userName = $_SESSION['user']['name'];
        $userRole = $_SESSION['user']['role'];
        ?> -->

<header class="navbar navbar-light bg-light shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- Logo Section -->
        <img class="mg-0" src="../../public/assets/img/Logo JTI.png" alt="Logo JIT">

        <!-- User Actions -->
        <div class="d-flex align-items-center">
            <span class="navbar-brand mb-0">Hallo, <?php echo $userName; ?></span>

            <!-- Notification Button -->
            <button class="btn btn-light me-2">
                <i class="bi bi-bell"></i>
            </button>

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/auth/profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="/component/modalValLogout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>