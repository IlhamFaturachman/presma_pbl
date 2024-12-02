<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/adminCSS/dashboard.css">
</head>

<body>

    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/admin/header.php'; ?>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Sidebar -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/admin/sidebar.php'; ?>

        <!-- Main Content -->
        <div id="content" class="p-4">
            <div class="card">
                <div class="card-body">
                    <h2>Daftar Pengguna</h2>
                    <div class="d-flex justify-content-between mb-3">
                        <input type="text" class="form-control w-50" placeholder="Pencarian">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
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
                                    <button class="btn btn-sm btn-warning">Edit</button>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Dosen_1</td>
                                <td>**********</td>
                                <td><span class="badge bg-secondary">Dosen</span></td>
                                <td>dosen1@gmail.com</td>
                                <td>
                                    <button class="btn btn-sm btn-warning">Edit</button>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Mhs_1</td>
                                <td>**********</td>
                                <td><span class="badge bg-info">Mahasiswa</span></td>
                                <td>mbub@g...</td>
                                <td>
                                    <button class="btn btn-sm btn-warning">Edit</button>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const menuTextElements = document.querySelectorAll('.menu-text');
        const menuItem = document.getElementById('menuItem');

        // Fungsi untuk toggle sidebar
        function toggleSidebar() {
            if (sidebar.style.width === '250px' || sidebar.style.width === '') {
                sidebar.style.width = '76px'; // Menyempitkan sidebar
                menuTextElements.forEach(text => text.style.display = 'none'); // Sembunyikan teks
            } else {
                sidebar.style.width = '250px'; // Kembalikan ukuran normal
                menuTextElements.forEach(text => text.style.display = 'inline'); // Tampilkan teks
            }
        }

        // Tambahkan event listener hanya pada menuItem
        menuItem.addEventListener('click', toggleSidebar);
    </script>


</body>

</html>