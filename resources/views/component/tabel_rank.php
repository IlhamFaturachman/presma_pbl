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
                    <td><button class="btn btn-primary btn-sm" data-id="1" data-bs-toggle="modal" data-bs-target="#detailModal">Detail</button></td>
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

        <div class="pagination-container mt-3">
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

    <!-- Include Modal Detail -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/presma_pbl/resources/views/component/modalDetail_rank.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Ketika tombol "Detail" diklik
        $('button[data-id]').on('click', function () {
            var mahasiswaId = $(this).data('id');

            // Ambil data mahasiswa dan prestasinya menggunakan AJAX
            $.ajax({
                url: '/get_student_details/' + mahasiswaId, // Ganti dengan URL yang sesuai
                method: 'GET',
                success: function (data) {
                    // Isi modal dengan data mahasiswa
                    $('#modal-name').text(data.name);
                    $('#modal-nim').text(data.nim);
                    $('#modal-program').text(data.program);
                    $('#modal-prestasi').text(data.achievementsCount);
                    $('#modal-poin').text(data.totalPoints);

                    // Isi tabel prestasi dengan data prestasi
                    var achievementsTable = $('#achievements-tbody');
                    achievementsTable.empty();
                    data.achievements.forEach(function (achievement, index) {
                        achievementsTable.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${achievement.name}</td>
                                <td>${achievement.year}</td>
                                <td>${achievement.level}</td>
                                <td>${achievement.rank}</td>
                                <td>${achievement.points}</td>
                            </tr>
                        `);
                    });
                }
            });
        });
    </script>
</body>

</html>
