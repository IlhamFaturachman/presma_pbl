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
    <style>
        .info-card {
            background-color: #002b5b;
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .info-card h5 {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #003b6f;
        }

        .btn-danger {
            background-color: #d9534f;
        }

        .table-section h3 {
            color: #003b6f;
            font-weight: bold;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/header.php'; ?>

    <div class="d-flex">
        <!-- Sidebar -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/sidebar.php'; ?>

        <!-- Main Content -->
        <div id="content" class="p-4 w-100">
            <div class="card shadow">
                <div class="card-body">
                    <!-- Profil Pengguna -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="info-card">
                                <img src="/presma_pbl/public/assets/img/biodata.png" alt="Foto"
                                    class="img-fluid rounded-circle mb-2" width="100">
                                <h5><?= htmlspecialchars($userName) ?></h5>
                                <p class="mb-0">244107023001 / TI 2A</p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex gap-3 flex-wrap">
                                <a href="#" class="btn btn-primary flex-grow-1" id="btnTambah"
                                    data-modal-url="/presma_pbl/resources/views/layouts/mahasiswa/modalTambahPrestasi.php">
                                    <i class="bi bi-plus-circle"></i> Tambah Prestasi
                                </a>
                                <a href="#" class="btn btn-primary flex-grow-1">
                                    <i class="bi bi-award"></i> Prestasi
                                </a>
                                <a href="#" class="btn btn-primary flex-grow-1">
                                    <i class="bi bi-list-check"></i> Prestasi Ditambahkan
                                </a>
                                <a href="/logout" class="btn btn-danger flex-grow-1">
                                    <i class="bi bi-box-arrow-right"></i> Keluar
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Peringkat -->
                    <div class="table-section">
                        <h3>Peringkat Prestasi</h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Peringkat</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Program Studi</th>
                                        <th>Jumlah Prestasi</th>
                                        <th>Poin Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>🥇</td>
                                        <td>Gilang Purnomo</td>
                                        <td>Teknik Informatika</td>
                                        <td>20</td>
                                        <td>750</td>
                                    </tr>
                                    <tr>
                                        <td>🥈</td>
                                        <td>Gwido Putra Wijaya</td>
                                        <td>Sistem Informasi Bisnis</td>
                                        <td>17</td>
                                        <td>520</td>
                                    </tr>
                                    <tr>
                                        <td>🥉</td>
                                        <td>Ilham Faturachman</td>
                                        <td>Sistem Informasi Bisnis</td>
                                        <td>15</td>
                                        <td>505</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Placeholder untuk modal -->
                    <div id="modalContainer"></div>
                </div>
            </div>
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