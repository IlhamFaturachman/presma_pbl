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
    <title>Daftar Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/header.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/admin/prestasi.css">

</head>

<body>

    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/header.php'; ?>

    <div class="content-wrapper d-flex">
        <!-- Sidebar -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/layouts/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="container mt-5">
            <div class="table-container">
                <h1 class="fs-5 mb-4">Daftar Prestasi</h1>
                <div class="d-flex justify-content-end mb-3">
                    <input type="text" class="form-control w-25" id="searchInput" placeholder="Pencarian">
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>
                        Program Studi
                        <!-- Gambar sebagai ikon dropdown untuk Prodi -->
                        <button class="dropdown-image" type="button" id="dropdownProdiButton">
                            <img src="../../public/assets/img/dropdown.png" alt="Dropdown Icon" style="width: 16px; height: 16px;">
                        </button>
                        <!-- Dropdown Menu Prodi -->
                        <ul class="dropdown-menu" id="dropdownMenuProdi">
                            <li><a class="dropdown-item" href="#" data-value="All">All</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Teknik Informatika">Teknik Informatika</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Sistem Informasi Bisnis">Sistem Informasi Bisnis</a></li>
                        </ul>
                        </th>
                        <th>Nama Lomba</th>
                        <th>
                        Tingkat
                        <!-- Gambar sebagai ikon dropdown untuk Tingkat -->
                        <button class="dropdown-image" type="button" id="dropdownTingkatButton">
                            <img src="../../public/assets/img/dropdown.png" alt="Dropdown Icon" style="width: 16px; height: 16px;">
                        </button>
                        <!-- Dropdown Menu Tingkat -->
                        <ul class="dropdown-menu" id="dropdownMenuTingkat">
                            <li><a class="dropdown-item" href="#" data-value="All">All</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Internasional">Internasional</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Nasional">Nasional</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Lokal">Lokal</a></li>
                        </ul>
                        </th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody id="prestasiTableBody">
                    <tr class="filterRow" data-prodi="Teknik Informatika" data-tingkat="Nasional">
                        <td>Gilang Purnomo</td>
                        <td>Teknik Informatika</td>
                        <td>POMNAS</td>
                        <td>Nasional</td>
                        <td><span class="status waiting">Menunggu Validasi</span></td>
                        <td><button class="btn btn-primary btn-sm" data-modal-url="/presma_pbl/resources/views/component/modalDetail_pres.php?id=1">Detail</button></td>

                    </tr>
                    <tr class="filterRow" data-prodi="Teknik Informatika" data-tingkat="Nasional">
                        <td>Gwido Putra Wijaya</td>
                        <td>Teknik Informatika</td>
                        <td>Lograk</td>
                        <td>Nasional</td>
                        <td><span class="status verified">Terverifikasi</span></td>
                        <td><button class="btn btn-primary btn-sm">Detail</button></td>
                    </tr>
                    <tr class="filterRow" data-prodi="Sistem Informasi Bisnis" data-tingkat="Internasional">
                        <td>Ilham Faturachman</td>
                        <td>Sistem Informasi Bisnis</td>
                        <td>PIMNAS XXXVIII</td>
                        <td>Internasional</td>
                        <td><span class="status rejected">Ditolak</span></td>
                        <td><button class="btn btn-primary btn-sm">Detail</button></td>
                    </tr>
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination justify-content-end">
                    <li class="page-item">
                        <a class="page-link" href="#">Prev</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">10</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                    </ul>
                </nav>
                </div>
            </div>

            <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/component/admin/modalDetailPres.php'; ?>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/presma_pbl/public/assets/js/sidebar.js"></script>
    <script src="/presma_pbl/public/assets/js/admin/dashboard.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownProdiButton = document.getElementById('dropdownProdiButton');
            const dropdownTingkatButton = document.getElementById('dropdownTingkatButton');
            const dropdownMenuProdi = document.getElementById('dropdownMenuProdi');
            const dropdownMenuTingkat = document.getElementById('dropdownMenuTingkat');
            const filterButtonsProdi = document.querySelectorAll('#dropdownMenuProdi .dropdown-item');
            const filterButtonsTingkat = document.querySelectorAll('#dropdownMenuTingkat .dropdown-item');
            const tableRows = document.querySelectorAll('.filterRow');

            // Toggle dropdown visibility when the Prodi button is clicked
            dropdownProdiButton.addEventListener('click', function() {
                dropdownMenuProdi.classList.toggle('show');
                dropdownProdiButton.classList.toggle('open');
            });

            // Toggle dropdown visibility when the Tingkat button is clicked
            dropdownTingkatButton.addEventListener('click', function() {
                dropdownMenuTingkat.classList.toggle('show');
                dropdownTingkatButton.classList.toggle('open');
            });

            // Filter rows based on selected Prodi
            filterButtonsProdi.forEach(button => {
                button.addEventListener('click', function(event) {
                const filterValue = event.target.getAttribute('data-value');
                
                // Hide dropdown menu after selection
                dropdownMenuProdi.classList.remove('show');
                dropdownProdiButton.classList.remove('open');
                
                tableRows.forEach(row => {
                    const prodi = row.getAttribute('data-prodi');
                    if (filterValue === 'All' || prodi === filterValue) {
                    row.style.display = '';
                    } else {
                    row.style.display = 'none';
                    }
                });
                });
            });

            // Filter rows based on selected Tingkat
            filterButtonsTingkat.forEach(button => {
                button.addEventListener('click', function(event) {
                const filterValue = event.target.getAttribute('data-value');
                
                // Hide dropdown menu after selection
                dropdownMenuTingkat.classList.remove('show');
                dropdownTingkatButton.classList.remove('open');
                
                tableRows.forEach(row => {
                    const tingkat = row.getAttribute('data-tingkat');
                    if (filterValue === 'All' || tingkat === filterValue) {
                    row.style.display = '';
                    } else {
                    row.style.display = 'none';
                    }
                });
                });
            });
            
            // Fungsi Search
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', function() {
                const searchText = searchInput.value.toLowerCase();
                tableRows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                if (rowText.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
                });
            });
        });

        // Fungsi untuk menampilkan modal dengan konten dari file yang berbeda
        $(document).on('click', '[data-modal-url]', function(e) {
            e.preventDefault();
            
            const modalUrl = $(this).data('modal-url');  // Ambil URL dari atribut data-modal-url
            $('#modalContainer').load(modalUrl, function() {
                // Setelah konten modal dimuat, tampilkan modal
                const modal = new bootstrap.Modal(document.getElementById('detailPrestasiModal'));  // Ubah id modal sesuai kebutuhan
                modal.show();
            });
        });
    </script>
</body>

</html>