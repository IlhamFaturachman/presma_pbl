<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal Diverifikasi</title>
    <!-- Tambahkan Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/component/modalTerverifikasi.css">
</head>
<body>
    <!-- Modal Data Berhasil Diverifikasi -->
    <div class="modal fade" id="diverifikasiModal" tabindex="-1" aria-labelledby="diverifikasiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
            <img src="img/rb_1046 1.png" alt="Berhasil Diverifikasi">
            <p>Data Berhasil Diverifikasi</p>
            </div>
        </div>
        </div>
    </div>

    <!-- Tambahkan Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tampilkan modal secara otomatis
        const diverifikasiModal = new bootstrap.Modal(document.getElementById('diverifikasiModal'));
        diverifikasiModal.show();
    </script>
</body>
</html>
