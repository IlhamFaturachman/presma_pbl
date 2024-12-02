<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil informasi pengguna dari sesi
$userId = $_SESSION['user']['id'];
$userName = $_SESSION['user']['name'];
$userRole = $_SESSION['user']['role'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/header.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/mahasiswaCSS/dashboard.css">
</head>

<body>

    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/header.php'; ?>

    <div class="d-flex">
        <!-- Sidebar -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="container my-5">
            <div class="row mb-4">
                <!-- Profil Mahasiswa -->
                <div class="col-md-6">
                    <div class="profile-container">
                        <div class="profile-image">
                            <img src="../../public/assets/img/Resume-rafiki.png" alt="Foto Profil">
                        </div>
                        <div class="profile-info">
                            <h4>Ilham Faturachman</h4>
                            <p>244107023001 / TI 2A</p>
                        </div>
                    </div>
                </div>

                <!-- Menu dan Statistik -->
                <div class="col-md-6">
                    <div class="menu-stat-section">
                        <div class="menu-grid">
                            <a href="#" class="menu-item menu-item-blue" id="btnTambah">
                                <div class="menu-icon">
                                    <img src="../../public/assets/img/tmb_presMhs.png" alt="Tambah">
                                </div>
                                <div class="menu-text-mhs">Tambah</div>
                            </a>

                            <a href="#" class="menu-item menu-item-blue">
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

                            <a href="#" class="menu-item menu-item-red">
                                <div class="menu-icon">
                                    <img src="../../public/assets/img/exit-run.png" alt="Keluar">
                                </div>
                                <div class="menu-text-mhs">Keluar</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Peringkat Prestasi -->
            <div class="ranking-table">
                <h4 class="mb-3">Peringkat Prestasi</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center-align">Peringkat</th>
                            <th class="text-center-align">Nama Mahasiswa</th>
                            <th class="text-center-align">Program Studi</th>
                            <th class="text-center-align">Jumlah Prestasi</th>
                            <th class="text-center-align">Poin Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center-align">🥇</td>
                            <td class="text-center-align">Gilang Purnomo</td>
                            <td class="text-center-align">Teknik Informatika</td>
                            <td class="text-center-align">20</td>
                            <td class="text-center-align">750</td>
                        </tr>
                        <tr>
                            <td class="text-center-align">🥈</td>
                            <td class="text-center-align">Gwido Putra Wijaya</td>
                            <td class="text-center-align">Sistem Informasi Bisnis</td>
                            <td class="text-center-align">17</td>
                            <td class="text-center-align">520</td>
                        </tr>
                        <tr>
                            <td class="text-center-align">🥉</td>
                            <td class="text-center-align">Ilham Faturachman</td>
                            <td class="text-center-align">Sistem Informasi Bisnis</td>
                            <td class="text-center-align">15</td>
                            <td class="text-center-align">505</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '#btnTambah', function(e) {
            e.preventDefault();
            const modalUrl = $(this).data('modal-url');
            $('#modalContainer').load(modalUrl, function() {
                const modal = new bootstrap.Modal(document.getElementById('addPrestasiModal'));
                modal.show();
            });
        });
    </script>
    <script src="/presma_pbl/public/assets/js/sidebar.js"></script>
</body>

</html>