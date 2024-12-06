<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Prestasi Yang Dibimbing</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
                    <h4>Daftar Prestasi Yang Dibimbing</h4>
                    <div class="search-box">
                        <input type="text" class="form-control" placeholder="Pencarian" id="searchInput">
                    </div>
                </div>

                <table class="table table-striped" id="rankingTable">
                    <thead>
                        <tr>
                            <th>Nama Lomba</th>
                            <th>Tingkat Juara</th>
                            <th>Dosen Pembimbing</th>
                            <th>Tingkat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="rankingBody">
                        <!-- Data will be rendered dynamically -->
                    </tbody>
                </table>

                <!-- Pagination -->
                <ul class="pagination" id="pagination"></ul>
            </section>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/presma_pbl/public/assets/js/dosen/prestasiDibimbing.js"></script>
    <script src="/presma_pbl/public/assets/js/sidebar.js"></script>
</body>
</html>
