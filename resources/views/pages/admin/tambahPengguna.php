<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/adminCSS/tambahPengguna.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/adminCSS/dashboard.css">
</head>

<body>
    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/admin/header.php'; ?>

    <!-- Sidebar and Content -->
    <div class="content-wrapper d-flex">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/admin/sidebar.php'; ?>

        <div id="content" class="p-4 flex-grow-1">
            <div class="container">
                <!-- Card -->
                <div class="card shadow-sm rounded-4 p-4">
                    <div class="card-body">
                        <h1 class="card-title mb-4">Daftar Pengguna</h1>

                        <!-- Search and Add Button -->
                        <div class="d-flex justify-content-end align-items-center mb-3">
                            <!-- Form Search and Button -->
                            <input type="text" id="search" class="form-control me-2 w-auto" placeholder="Cari pengguna">
                            <button class="btn btn-primary">
                                <i class="bi bi-person-plus"></i> Tambah Pengguna
                            </button>
                        </div>

                        <!-- User Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody id="userTable">
                                    <!-- Data pengguna akan dimuat melalui AJAX -->
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
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <nav>
                            <ul class="pagination justify-content-end">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a>
                                </li>
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    // AJAX untuk pencarian data
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            const query = $(this).val();

            // Kirim data pencarian ke server
            $.ajax({
                url: '/presma_pbl/search_users.php', // URL untuk memproses pencarian
                type: 'GET',
                data: {
                    search: query
                },
                success: function(response) {
                    // Tampilkan data hasil pencarian
                    $('#userTable').html(response);
                },
                error: function() {
                    console.error("Pencarian gagal.");
                }
            });
        });
    });
    </script>
</body>

</html>