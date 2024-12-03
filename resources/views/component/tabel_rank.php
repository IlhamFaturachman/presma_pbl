<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peringkat Prestasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/component/tabel_rank.css">
</head>

<body>
    <div class="container mt-5 p-4 rounded shadow">
        <h3>Peringkat Prestasi</h3>

        <div class="search-container">
            <input type="text" class="form-control w-25" placeholder="Pencarian">
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Nama Mahasiswa</th>
                    <th>Program Studi</th>
                    <th>Jumlah Prestasi</th>
                    <th>Point Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>🥇</td>
                    <td>Gilang Purnomo</td>
                    <td>Teknik Informatika</td>
                    <td>20</td>
                    <td>750</td>
                    <td><button class="btn btn-primary btn-sm">Detail</button></td>
                </tr>
                <tr>
                    <td>🥈</td>
                    <td>Gwido Putra Wijaya</td>
                    <td>Sistem Informasi Bisnis</td>
                    <td>17</td>
                    <td>520</td>
                    <td><button class="btn btn-primary btn-sm">Detail</button></td>
                </tr>
                <tr>
                    <td>🥉</td>
                    <td>Ilham Faturachman</td>
                    <td>Sistem Informasi Bisnis</td>
                    <td>15</td>
                    <td>505</td>
                    <td><button class="btn btn-primary btn-sm">Detail</button></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Najwa Alya Nurizzah</td>
                    <td>Teknik Informatika</td>
                    <td>10</td>
                    <td>500</td>
                    <td><button class="btn btn-primary btn-sm">Detail</button></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Sesy Tana Lina R</td>
                    <td>Sistem Informasi Bisnis</td>
                    <td>10</td>
                    <td>500</td>
                    <td><button class="btn btn-primary btn-sm">Detail</button></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Dika Arie Arrifky</td>
                    <td>Teknik Informatika</td>
                    <td>8</td>
                    <td>480</td>
                    <td><button class="btn btn-primary btn-sm">Detail</button></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Alvanza Saputra Y</td>
                    <td>Teknik Informatika</td>
                    <td>9</td>
                    <td>470</td>
                    <td><button class="btn btn-primary btn-sm">Detail</button></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>M. Fatih Al Ghifary</td>
                    <td>Teknik Informatika</td>
                    <td>5</td>
                    <td>430</td>
                    <td><button class="btn btn-primary btn-sm">Detail</button></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Jiha Ramdhan</td>
                    <td>Sistem Informasi Bisnis</td>
                    <td>5</td>
                    <td>430</td>
                    <td><button class="btn btn-primary btn-sm">Detail</button></td>
                </tr>
                <!-- Tambahkan data lainnya sesuai kebutuhan -->
            </tbody>
        </table>

        <div class="pagination-container">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item disabled"><a class="page-link">Prev</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">10</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
