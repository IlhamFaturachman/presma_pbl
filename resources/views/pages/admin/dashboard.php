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
    <title>Daftar Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
        <div id="content" class="p-4 w-100">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="mb-4">Daftar Pengguna</h2>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <input type="text" class="form-control w-50" placeholder="Cari pengguna...">
                        <button class="btn btn-primary">
                            <i class="bi bi-plus-lg"></i> Tambah Pengguna
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>Nama Pengguna</th>
                                    <th>Password</th>
                                    <th>Roles</th>
                                    <th>Email</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Admin_1</td>
                                    <td>**********</td>
                                    <td><span class="badge bg-primary">Admin</span></td>
                                    <td>admin1@gmail.com</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dosen_1</td>
                                    <td>**********</td>
                                    <td><span class="badge bg-secondary">Dosen</span></td>
                                    <td>dosen1@gmail.com</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mahasiswa_1</td>
                                    <td>**********</td>
                                    <td><span class="badge bg-info">Mahasiswa</span></td>
                                    <td>mahasiswa1@gmail.com</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/presma_pbl/public/assets/js/sidebar.js"></script>
</body>

</html>