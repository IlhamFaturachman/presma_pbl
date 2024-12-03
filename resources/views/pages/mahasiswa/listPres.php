<!-- <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil informasi pengguna dari sesi
$userId = $_SESSION['user']['id'];
$userName = $_SESSION['user']['name'];
$userRole = $_SESSION['user']['role'];
?> -->

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
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/mahasiswa/listPres.css">
</head>

<body>

    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/header.php'; ?>
    <!-- Sidebar -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/sidebar.php'; ?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar Prestasi</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <div class="container">
        <h1>Daftar Prestasi</h1>
        <div class="row mb-3">
            <div class="col-md-6 offset-md-6 d-flex justify-content-end">
                <input type="text" class="form-control mr-2" placeholder="Pencarian">
                <button class="btn btn-primary">Tambah</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Nama Lomba</th>
                        <th>Tingkat Juara</th>
                        <th>Dosen Pembimbing</th>
                        <th>Tingkat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Lomba Menembak</td>
                        <td>Juara 1</td>
                        <td>Ir. Gilang S.T, M.T</td>
                        <td>Nasional</td>
                        <td><span class="status waiting">Menunggu Validasi</span></td>
                        <td class="actions">
                            <button class="edit"><i class="fas fa-edit"></i></button>
                            <button class="delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>XXL Freshman Cypher</td>
                        <td>Juara Harapan 3</td>
                        <td>Ir. Gilang S.T, M.T</td>
                        <td>Nasional</td>
                        <td><span class="status verified">Terverifikasi</span></td>
                        <td class="actions">
                            <button class="detail">Detail</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Complexcon Best Suite</td>
                        <td>Juara 2</td>
                        <td>Ir. Gilang S.T, M.T</td>
                        <td>Internasional</td>
                        <td><span class="status rejected">Ditolak</span></td>
                        <td class="actions">
                            <button class="info">Info</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            <nav>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">10</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>


</html>