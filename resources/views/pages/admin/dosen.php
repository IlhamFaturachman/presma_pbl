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
    <title>Daftar Dosen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/header.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/admin/tambahPengguna.css">
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
                <h4>Daftar Dosen</h4>
                <div class="row mb-3">
                    <div class="col-md-6 offset-md-6 d-flex justify-content-end">
                        <!-- Kolom untuk form pencarian -->
                        <div class="search-box d-flex w-50">
                            <input type="text" class="form-control" placeholder="Cari Dosen" id="searchInput">
                        </div>
                        <!-- Kolom untuk tombol Tambah Pengguna -->
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahDosenModal">
                            <i class="bi bi-plus-lg"></i> Tambah Dosen
                        </button>
                    </div>
                </div>
                <table class="table table-striped" id="dosenTable">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>email</th>
                            <th>No Telp</th>
                            <th>Prodi</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody id="dosenBody">
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

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/component/admin/dosen/modalEditDosen.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/component/admin/dosen/modalTambahDosen.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/component/admin/dosen/modalDeleteDosen.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/presma_pbl/public/assets/js/sidebar.js"></script>
    <script>
    window.allDosen =
        <?php echo json_encode($dosen, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
    </script>
    <script src="/presma_pbl/public/assets/js/admin/listDosen.js"></script>

</body>

</html>