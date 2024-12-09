<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// // Ambil informasi pengguna dari sesi
// $userId = $_SESSION['user']['id'];
// $userNameFromTableUsers = $_SESSION['user']['username'];
// $userName = $_SESSION['user']['name'];
// $userRole = $_SESSION['user']['role'];
// 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Prestasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/header.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/admin/prestasi.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/admin/modalDetailPres.css">
</head>

<body>

    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/header.php'; ?>

    <div class="content-wrapper d-flex">
        <!-- Sidebar -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/sidebar.php'; ?>

        <!-- Main Content -->
        <div id="content" class="content flex-grow-1 p-4">
            <section class="table-container">
                <h4>Daftar Prestasi</h4>
                <div class="row mb-3 align-items-center">
                    <div class="col-auto">
                        <!-- Dropdown filter status -->
                        <select id="filterStatus" class="form-select">
                            <option value="all">Semua Status</option>
                            <option value="Tervalidasi">Tervalidasi</option>
                            <option value="Menunggu divalidasi">Menunggu Validasi</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center">
                        <!-- Kolom untuk form pencarian -->
                        <div class="search-box me-3">
                            <input type="text" class="form-control" placeholder="Cari Prestasi" id="searchInput">
                        </div>
                        <!-- Kolom untuk tombol Tambah Pengguna -->
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#prestasiModal">
                            <i class="bi bi-plus-lg"></i> Tambah Prestasi
                        </button>
                    </div>
                </div>
                <table class="table table-striped" id="prestasiTable">
                    <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>Nama Lomba</th>
                            <th>Peringkat</th>
                            <th>
                                Tingkat
                                <!-- Dropdown untuk Tingkat -->
                                <div class="dropdown-container">
                                    <button class="dropdown-image" type="button" id="dropdownTingkatButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="/presma_pbl/public/assets/img/dropdown.png" alt="Tingkat" class="img-fluid" width="20">
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownTingkatButton">
                                        <li><a class="dropdown-item" href="#" onclick="filterByTingkat('All')">All</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="filterByTingkat('Internasional')">Internasional</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="filterByTingkat('Nasional')">Nasional</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="filterByTingkat('Lokal')">Lokal</a></li>
                                    </ul>
                                </div>
                            </th>
                            <th>Dosen Pembimbing</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody id="prestasiBody">
                        <!-- Data akan diisi secara dinamis -->
                    </tbody>
                </table>

                <!-- Pagination -->
                <ul class="pagination" id="pagination">
                    <!-- Pagination items akan diisi secara dinamis -->
                </ul>
            </section>
        </div>


    </div>
    </div>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/component/admin/prestasi/modalDetailPrestasi.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/component/admin/prestasi/modalValidasiPrestasi.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/presma_pbl/public/assets/js/sidebar.js"></script>
    <script>
    window.allPrestasi =
        <?php echo json_encode($prestasi, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
    </script>
    <script src="/presma_pbl/public/assets/js/admin/prestasi.js"></script>
</body>

</html>