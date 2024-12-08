<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peringkat Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/component/modalDetail_rank.css">
</head>

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Detail Peringkat Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Informasi Mahasiswa -->
                    <div class="detail-info">
                        <div>Nama Mahasiswa :</div>
                        <div id="modal-name"></div>
                        <div>NIM :</div>
                        <div id="modal-nim"></div>
                        <div>Program Studi :</div>
                        <div id="modal-program"></div>
                        <div>Jumlah Prestasi :</div>
                        <div id="modal-prestasi"></div>
                        <div>Total Poin :</div>
                        <div id="modal-poin"></div>
                    </div>
                    <hr>
                    <!-- Tabel Prestasi -->
                    <div class="table-container-modal">
                        <table class="table table-striped" id="achievements-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Prestasi</th>
                                    <th>Tahun</th>
                                    <th>Tingkat</th>
                                    <th>Peringkat</th>
                                    <th>Poin</th>
                                </tr>
                            </thead>
                            <tbody id="achievements-tbody">
                                <!-- Prestasi mahasiswa akan dimuat di sini -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="exportButton">Export</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/presma_pbl/public/assets/js/modalDetail_rank.js"></script>
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
</body>

</html>
