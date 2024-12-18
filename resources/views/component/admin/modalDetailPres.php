<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Detail Prestasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/admin/modalDetailPres.css">
</head>
<body>

    <!-- Modal -->
    <div class="modal fade" id="detailPrestasiModal" tabindex="-1" aria-labelledby="detailPrestasiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailPrestasiLabel">Validasi Detail Prestasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Nama Mahasiswa</th>
                                        <td>: <?php echo $prestasi['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>NIM</th>
                                        <td>: <?php echo $prestasi['nim'] ?? 'N/A'; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Dosen Pembimbing</th>
                                        <td>: <?php echo $prestasi['dosenPembimbing'] ?? 'N/A'; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lomba</th>
                                        <td>: <?php echo $prestasi['achievement']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>: <?php echo $prestasi['kategori'] ?? 'N/A'; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Waktu Lomba (Mulai)</th>
                                        <td>: <?php echo $prestasi['waktuMulai'] ?? 'N/A'; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Waktu Lomba (Selesai)</th>
                                        <td>: <?php echo $prestasi['waktuSelesai'] ?? 'N/A'; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tingkat</th>
                                        <td>: <?php echo $prestasi['tingkat']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Penyelenggara</th>
                                        <td>: <?php echo $prestasi['penyelenggara'] ?? 'N/A'; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Peringkat</th>
                                        <td>: <?php echo $prestasi['peringkat'] ?? 'N/A'; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Lomba</th>
                                        <td>: <?php echo $prestasi['tempatLomba'] ?? 'N/A'; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="image-placeholder">
                                        <span>Foto Sertifikat</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="image-placeholder">
                                        <span>Foto Lomba</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="image-placeholder">
                                        <span>Flyer Lomba</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="image-placeholder">
                                        <span>Surat Tugas</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center mb-3">
                                <div class="col col-md-12">
                                    <div class="image-placeholder">
                                        <span>Ide Proposal</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">ACC</button>
                    <button type="button" class="btn btn-danger">Tolak</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tambahkan script eksternal modal.js -->
    <script src="modal.js"></script>
</body>
</html>
