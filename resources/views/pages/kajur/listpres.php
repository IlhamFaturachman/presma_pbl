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
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/mahasiswa/dashboard.css">
</head>

<body>

    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/header.php'; ?>

    <div class="d-flex">
        <!-- Sidebar -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/sidebar.php'; ?>

        <div class="container">
            <h1>Laporan Prestasi</h1>

            <!-- Form Section -->
<form class="row row-cols-lg-auto g-3 align-items-center mb-4">
    <div class="col">
        <label for="program-studi" class="form-label">Program Studi</label>
        <select id="program-studi" class="form-select">
            <option>Teknik Informatika</option>
        </select>
    </div>
    <div class="col">
        <label for="tahun-prestasi" class="form-label">Tahun Prestasi</label>
        <input type="text" id="tahun-prestasi" class="form-control" value="2023">
    </div>
    <div class="col">
        <label for="tingkat" class="form-label">Tingkat</label>
        <select id="tingkat" class="form-select">
            <option>Nasional</option>
        </select>
    </div>
    <div class="col align-self-end">
        <button type="submit" class="btn btn-primary">Tampilkan Data</button>
    </div>
</form>


            <!-- Table Section -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Nama Mahasiswa</th>
                            <th>Program Studi</th>
                            <th>Nama Prestasi</th>
                            <th>Tingkat Prestasi</th>
                            <th>Peringkat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="no-data text-center" colspan="6">
                                <em>Data tidak tersedia saat ini.</em>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
