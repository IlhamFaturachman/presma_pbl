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
    <title>Daftar Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/header.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/admin/mahasiswa.css">
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
                <h4>Daftar Mahasiswa</h4>
                <div class="row mb-3">
                    <div class="col-md-6 offset-md-6 d-flex justify-content-end">
                        <!-- Kolom untuk form pencarian -->
                        <div class="search-box d-flex w-50">
                            <input type="text" class="form-control" placeholder="Cari Mahasiswa" id="searchInput">
                        </div>
                        <!-- Kolom untuk tombol Tambah Pengguna -->
                        <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#tambahMahasiswaModal">
                            <i class="bi bi-plus-lg"></i> Tambah Mahasiswa
                        </button>
                    </div>
                </div>
                <table class="table table-striped" id="mahasiswaTable">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>email</th>
                            <th>No Telp</th>
                            <th>Angkatan</th>
                            <th>Kelas</th>
                            <th>
                                Program Studi
                                <!-- Dropdown untuk Prodi -->
                                <div class="dropdown-container">
                                    <button class="dropdown-image" type="button" id="dropdownProdiButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="/presma_pbl/public/assets/img/dropdown.png" alt="Program Studi" class="img-fluid" width="20">
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownProdiButton">
                                        <li><a class="dropdown-item" href="#" onclick="filterByProdi('All')">All</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="filterByProdi('Teknik Informatika')">Teknik Informatika</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="filterByProdi('Sistem Informasi Bisnis')">Sistem Informasi Bisnis</a></li>
                                    </ul>
                                </div>
                            </th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody id="mahasiswaBody">
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

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/component/admin/mahasiswa/modalEditMahasiswa.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/component/admin/mahasiswa/modalTambahMahasiswa.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/component/admin/mahasiswa/modalDeleteMahasiswa.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/presma_pbl/public/assets/js/sidebar.js"></script>
    <script>
    window.allMahasiswa =
        <?php echo json_encode($mahasiswa, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
    </script>
    <script src="/presma_pbl/public/assets/js/admin/listMahasiswa.js"></script>

</body>

</html>