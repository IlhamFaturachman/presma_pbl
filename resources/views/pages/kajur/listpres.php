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
            <h2 class="small-title">Laporan Prestasi</h2>

            <!-- Form Section -->
            <form id="filter-form" class="row row-cols-lg-auto g-3 align-items-center mb-4">
                <div class="col">
                    <label for="program-studi" class="form-label">Program Studi</label>
                    <select id="program-studi" class="form-select">
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi Bisnis">Sistem Informasi Bisnis</option>
                    </select>
                </div>
                <div class="col">
                    <label for="tahun-prestasi" class="form-label">Tahun Prestasi</label>
                    <select id="tahun-prestasi" class="form-select">
                        <?php
                        $currentYear = date("Y");
                        for ($year = 2020; $year <= $currentYear; $year++) {
                            echo "<option value='$year'>$year</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="tingkat" class="form-label">Tingkat</label>
                    <select id="tingkat" class="form-select">
                        <option value="Nasional">Nasional</option>
                        <option value="Internasional">Internasional</option>
                    </select>
                </div>
                <div class="col align-self-end">
                    <button type="button" id="filter-btn" class="btn btn-primary">Tampilkan Data</button>
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
                    <tbody id="prestasi-tbody">
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
    <script>
        // Data Dummy
        const dataDummy = [
    {
        nama: "Gilang Purnomo",
        programStudi: "Teknik Informatika",
        namaPrestasi: "Lomba CTF Nasional",
        tingkatPrestasi: "Nasional",
        tahunPrestasi: "2023",
        peringkat: "Juara 1"
    },
    {
        nama: "Najwa Alya Nurizza",
        programStudi: "Teknik Informatika",
        namaPrestasi: "PIMNAS XXXVIII",
        tingkatPrestasi: "Internasional",
        tahunPrestasi: "2022",
        peringkat: "1"
    },
    {
        nama: "Sesy Tana Lina Rahmatin",
        programStudi: "Teknik Informatika",
        namaPrestasi: "HOLOGI",
        tingkatPrestasi: "Internasional",
        tahunPrestasi: "2023",
        peringkat: "Juara 3"
    }
];


        // Event Listener untuk Filter
        document.getElementById('filter-btn').addEventListener('click', function () {
            // Ambil nilai filter
            const programStudi = document.getElementById('program-studi').value;
            const tahunPrestasi = document.getElementById('tahun-prestasi').value;
            const tingkatPrestasi = document.getElementById('tingkat').value;

            // Filter Data
            const filteredData = dataDummy.filter(item =>
                item.programStudi === programStudi &&
                item.tahunPrestasi === tahunPrestasi &&
                item.tingkatPrestasi === tingkatPrestasi
            );

            // Render Data ke Tabel
            const tableBody = document.getElementById('prestasi-tbody');
            tableBody.innerHTML = ''; // Kosongkan tabel

            if (filteredData.length > 0) {
                filteredData.forEach((item, index) => {
                    const row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.nama}</td>
                            <td>${item.programStudi}</td>
                            <td>${item.namaPrestasi}</td>
                            <td>${item.tingkatPrestasi}</td>
                            <td>${item.peringkat}</td>
                        </tr>
                    `;
                    tableBody.insertAdjacentHTML('beforeend', row);
                });
            } else {
                tableBody.innerHTML = `
                    <tr>
                        <td class="no-data text-center" colspan="6">
                            <em>Data tidak tersedia saat ini.</em>
                        </td>
                    </tr>
                `;
            }
        });
    </script>
</body>
</html>
