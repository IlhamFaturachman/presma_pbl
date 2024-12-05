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
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/header.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/admin/tambahMahasiswa.css">
</head>

<body>
    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/header.php'; ?>

    <div class="d-flex">
        <!-- Sidebar -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/sidebar.php'; ?>
        <div id="content" class="p-4 w-100">
            <div class="card shadow">
                <div class="card-body">
                    <h1>Daftar Mahasiswa</h1>
                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-6 d-flex justify-content-end">
                            <input type="text" class="form-control w-50 mr-2" placeholder="Pencarian">
                            <button class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama Mahasiswa</th>
                                    <th>NIM</th>
                                    <th>Program Studi</th>
                                    <th>Angkatan</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Gilang Purnomo</td>
                                    <td>2341720042</td>
                                    <td>Teknik Informatika</td>
                                    <td>2023</td>
                                    <td>2A</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                            Hapus</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gwido Putra Wijaya</td>
                                    <td>2341720103</td>
                                    <td>Teknik Informatika</td>
                                    <td>2023</td>
                                    <td>2A</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                            Hapus</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ilham Faturachman</td>
                                    <td>244107023001</td>
                                    <td>Sistem Informasi Bisnis</td>
                                    <td>2021</td>
                                    <td>4I</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                            Hapus</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Najwa Alya Nurizzah</td>
                                    <td>2341720230</td>
                                    <td>Teknik Informatika</td>
                                    <td>2024</td>
                                    <td>1G</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                            Hapus</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sesy Tana Lina R</td>
                                    <td>2341720029</td>
                                    <td>Teknik Informatika</td>
                                    <td>2024</td>
                                    <td>1C</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                            Hapus</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dika Arie Arifky</td>
                                    <td>23417202302</td>
                                    <td>Teknik Informatika</td>
                                    <td>2022</td>
                                    <td>3B</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                            Hapus</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alvanza Saputra Y</td>
                                    <td>2341720182</td>
                                    <td>Teknik Informatika</td>
                                    <td>2023</td>
                                    <td>2F</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                            Hapus</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>M. Fatih Al Ghifary</td>
                                    <td>2341720194</td>
                                    <td>Teknik Informatika</td>
                                    <td>2023</td>
                                    <td>2A</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                            Hapus</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jiha Ramdhan</td>
                                    <td>2341720043</td>
                                    <td>Sistem Informasi Bisnis</td>
                                    <td>2024</td>
                                    <td>1A</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                            Hapus</button>
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
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>


</html>