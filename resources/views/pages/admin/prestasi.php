<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Prestasi Mahasiswa untuk Validasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/header.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/admin/prestasi.css">
</head>
<body>
    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/header.php'; ?>

    <div class="d-flex">
        <!-- Sidebar -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="content flex-grow-1 p-4">
            <section class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Daftar Prestasi</h4>
                    <div class="search-box">
                        <input type="text" class="form-control" placeholder="Pencarian" id="searchInput" onkeyup="searchTable()">
                    </div>
                </div>

                <table class="table table-striped" id="prestasiTable">
                    <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>
                                Program Studi
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
                            <th>Nama Lomba</th>
                            <th>
                                Tingkat
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
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="prestasiBody">
                        <!-- Data akan dimasukkan di sini secara dinamis -->
                    </tbody>
                </table>

                <!-- Pagination -->
                <ul class="pagination" id="pagination">
                    <!-- Pagination items will be inserted here dynamically -->
                </ul>
            </section>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/presma_pbl/public/assets/js/admin/prestasi.js"></script>
    <script src="/presma_pbl/public/assets/js/sidebar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
