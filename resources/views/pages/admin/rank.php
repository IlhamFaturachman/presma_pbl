<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peringkat Prestasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/header.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/admin/rank.css">
</head>

<body>
    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/header.php'; ?>

    <div class="d-flex">
        <!-- Sidebar -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/sidebar.php'; ?>

        <!-- Main Content -->
        <div id="content" class="content flex-grow-1 p-4">
            <section class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Peringkat Prestasi</h4>
                    <div class="search-box">
                        <input type="text" class="form-control" placeholder="Pencarian" id="searchInput">
                    </div>
                </div>

                <table class="table table-striped" id="rankingTable">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>Nama Mahasiswa</th>
                            <th>
                                Program Studi
                                <!-- Dropdown untuk Prodi -->
                                <div class="dropdown-container">
                                    <button class="dropdown-image" type="button" id="dropdownProdiButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="/presma_pbl/public/assets/img/dropdown.png" alt="Program Studi"
                                            class="img-fluid" width="20">
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownProdiButton">
                                        <li><a class="dropdown-item" href="#" onclick="filterByProdi('All')">All</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"
                                                onclick="filterByProdi('Teknik Informatika')">Teknik Informatika</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"
                                                onclick="filterByProdi('Sistem Informasi Bisnis')">Sistem Informasi
                                                Bisnis</a></li>
                                    </ul>
                                </div>
                            </th>
                            <th>Jumlah Prestasi</th>
                            <th>Poin Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="rankingBody">
                        <!-- Data will be inserted here dynamically -->
                    </tbody>
                </table>

                <!-- Pagination -->
                <ul class="pagination" id="pagination">
                    <!-- Pagination items will be inserted here dynamically -->
                </ul>
            </section>
        </div>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/component/admin/modalDetailrank.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/presma_pbl/public/assets/js/sidebar.js"></script>
    <script>
    window.allRank =
        <?php echo json_encode($rank, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
    </script>
    <script src="/presma_pbl/public/assets/js/admin/rank.js"></script>
</body>

</html>