<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil informasi pengguna dari sesi
$userId = $_SESSION['user']['id'];
$userNameFromTableUsers = $_SESSION['user']['username'];
$userName = $_SESSION['user']['name'];
$userRole = $_SESSION['user']['role'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/header.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/mahasiswa/dashboard.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/topThreeRank.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/component/modalTambahPres.css">
</head>

<body>

    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/header.php'; ?>

    <div class="d-flex">
        <!-- Sidebar -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/sidebar.php'; ?>

        <!-- Main Content -->

        <div class="content flex-grow-1 p-4" id="content">
            <section class="table-container">
                <div class="row mb-4">
                    <!-- Profil Mahasiswa -->
                    <div class="col-md-6">
                        <div class="profile-container">
                            <div class="profile-image">
                                <img src="../../public/assets/img/Resume-rafiki.png" alt="Foto Profil">
                            </div>
                            <div class="profile-info">
                                <h4><?php echo $userName; ?></h4>
                                <p><?php echo $userNameFromTableUsers; ?> / TI 2A</p>
                            </div>
                        </div>
                    </div>

                    <!-- Menu dan Statistik -->
                    <div class="col-md-6">
                        <div class="menu-stat-section p-0">
                            <div class="menu-grid">
                                <a href="#" class="menu-item menu-item-blue" data-bs-toggle="modal"
                                    data-bs-target="#prestasiModal">
                                    <div class="menu-icon">
                                        <img src="../../public/assets/img/tmb_presMhs.png" alt="Tambah">
                                    </div>
                                    <div class="menu-text-mhs">Tambah Prestasi</div>
                                </a>
                                <a href="#" class="menu-item menu-item-blue" id="btnPrestasi">
                                    <div class="menu-icon">
                                        <img src="../../public/assets/img/pres.png" alt="Prestasi">
                                    </div>
                                    <div class="menu-text-mhs">Prestasi</div>
                                </a>
                                <div class="menu-item menu-item-blue">
                                    <div class="menu-icon">
                                        <h2>10</h2>
                                    </div>
                                    <div class="menu-text-mhs">Prestasi Ditambahkan</div>
                                </div>
                                <a href="#" class="menu-item menu-item-red" id="btnLogout">
                                    <div class="menu-icon">
                                        <img src="../../public/assets/img/exit-run.png" alt="Keluar">
                                    </div>
                                    <div class="menu-text-mhs">Keluar</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Tabel Peringkat Prestasi -->
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/component/topThreeRanking.php'; ?>
            </section>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/component/mahasiswa/modalTambahPres.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '#btnPrestasi', function(e) {
            e.preventDefault();
            const modalUrl = $(this).data('modal-url');
            $('#modalContainer').load('/presma_pbl/listPres.php', function() {
                const modal = new bootstrap.Modal(document.getElementById('addPrestasiModal'));
                modal.show();
            });
        });

        // js modal Tambah
        $(document).on('click', '#btnTambah', function(e) {
            e.preventDefault();
            // Memuat modal dari file terpisah
            $('#modalContainer').load(
                '/presma_pbl/resources/views/component/mahasiswa/modalTambahPres.php',
                function() {
                    $('#prestasiModal').modal('show');
                });
        });

        // js modal Logout
        $(document).on('click', '#btnLogout', function(e) {
            e.preventDefault();
            // Memuat modal dari file terpisah
            $('#modalContainer').load('/presma_pbl/resources/views/component/modalValLogout.php',
                function() {
                    $('#logoutModal').modal('show');
                });
        });
    </script>
    <script src="/presma_pbl/public/assets/js/sidebar.js"></script>
    <script src="/presma_pbl/public/assets/js/topThreeRanking.js"></script>
</body>

</html>