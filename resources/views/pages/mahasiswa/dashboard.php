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
    <title>Dashboard Prestasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/adminCSS/dashboard.css">
    <style>
        body {
            font-family: Poppins, sans-serif;
            background-color: #f9f9f9;
        }

        .photo-frame {
            width: 100%;
            height: 280px;
            border: 2px dashed #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            color: #aaa;
            font-size: 16px;
        }

        .info-card {
            background-color: #f4f4f9;
            border-radius: 8px;
            padding: 20px;
            margin-top: 15px;
            text-align: center;
        }

        .btn-card {
            width: 270px;
            height: 115px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background-color: #aaa;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }

        .btn-card:hover {
            background-color: #0056b3;
        }

        .btn-card.red {
            background-color: #d9534f;
        }

        .btn-card.red:hover {
            background-color: #c9302c;
        }

        .btn-layout {
            display: grid;
            grid-template-rows: 1fr 1fr;
            grid-template-columns: 1fr 1fr;
            height: 100%;
            margin-left: auto;
            /* Menggeser ke kanan agar sejajar dengan tabel */
        }


        .table-section {
            margin-top: 30px;
        }

        .table-section h5 {
            font-weight: bold;
        }

        .table {
            margin-top: 20px;
        }

        .table tbody tr {
            background-color: #f8f9fa;
        }

        .btn-layout .btn-card {
            height: 115px;
        }
    </style>
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/admin/header.php'; ?>

    <div class="content-wrapper">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/admin/sidebar.php'; ?>

        <div class="container mt-4">
            <div class="row">
                <!-- Photo and Profile Section -->
                <div class="col-md-4">
                    <div class="photo-frame">
                        Foto Kosong
                    </div>
                    <div class="info-card mt-3">
                        <h5>Ilham Faturachman</h5>
                        <p class="mb-0">244107023001 / TI 2A</p>
                    </div>
                </div>

                <!-- Buttons Section -->
                <div class="col-md-8">
                    <div class="btn-layout">
                        <!-- Top Left -->
                        <a href="#" class="btn-card">Tambah</a>

                        <!-- Top Right -->
                        <a href="#" class="btn-card">Prestasi</a>

                        <!-- Bottom Right -->
                        <a href="#" class="btn-card">Prestasi Ditambah</a>

                        <!-- Bottom Left -->
                        <a href="#" class="btn-card red">Keluar</a>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="table-section">
                <h3 class="mt-4">Peringkat Prestasi</h3>
                <table class="table">
                    <thead>
                        <th>Peringkat</th>
                        <th>Nama Mahasiswa</th>
                        <th>Program Studi</th>
                        <th>Jumlah Prestasi</th>
                        <th>Poin Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>🥇</td>
                            <td>Gilang Purnomo</td>
                            <td>Teknik Informatika</td>
                            <td>20</td>
                            <td>750</td>
                        </tr>
                        <tr>
                            <td>🥈</td>
                            <td>Gwido Putra Wijaya</td>
                            <td>Sistem Informasi Bisnis</td>
                            <td>17</td>
                            <td>520</td>
                        </tr>
                        <tr>
                            <td>🥉</td>
                            <td>Ilham Faturachman</td>
                            <td>Sistem Informasi Bisnis</td>
                            <td>15</td>
                            <td>505</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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