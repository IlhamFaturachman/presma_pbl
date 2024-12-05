<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Prestasi yang Dibimbing</title>
  <link rel="stylesheet" href="/presma_pbl/public/assets/css/dosenCSS/prestasiDibimbing.css">
  <link rel="stylesheet" href="/presma_pbl/public/assets/css/header.css">
  <link rel="stylesheet" href="/presma_pbl/public/assets/css/sidebar.css">
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
                    <h4>Daftar Prestasi yang Dibimbing</h4>
                    <div class="search-box">
                        <input type="text" class="form-control" placeholder="Pencarian" id="searchInput">
                    </div>
                </div>

                <table class="table table-striped" id="rankingTable">
                    <thead>
                        <tr>
                            <th>Kategori Prestasi</th>
                            <th>Peringkat</th>
                            <th>Nama Pembimbing</th>
                            <th>Skala</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="rankingBody">
                        <tr>
                            <td>Lomba Menembak</td>
                            <td>Juara 1</td>
                            <td>Ir. Gilang S.T., M.T</td>
                            <td>Nasional</td>
                            <td><span class="status pending">Menunggu Validasi</span></td>
                            <td><button class="btn btn-detail">Detail</button></td>
                        </tr>
                        <tr>
                            <td>XXL Freshman Cypher</td>
                            <td>Juara Harapan 3</td>
                            <td>Ir. Gilang S.T., M.T</td>
                            <td>Nasional</td>
                            <td><span class="status verified">Terverifikasi</span></td>
                            <td><button class="btn btn-detail">Detail</button></td>
                        </tr>
                        <tr>
                            <td>Complexcon Best Suite</td>
                            <td>Juara 2</td>
                            <td>Ir. Gilang S.T., M.T</td>
                            <td>Internasional</td>
                            <td><span class="status rejected">Ditolak</span></td>
                            <td><button class="btn btn-info">Info</button></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
                    <button class="page-btn">Prev</button>
                    <button class="page-btn">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">10</button>
                    <button class="page-btn">Next</button>
                </div>
            </section>
        </div>
    </div>

    <script src="/presma_pbl/public/assets/js/dosen/prestasiDibimbing.js"></script>
</body>
</html>
