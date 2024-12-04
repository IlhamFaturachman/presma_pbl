<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Prestasi Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/component/modalTambahPres.css">
</head>
<body>
    <div class="modal fade" id="prestasiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Prestasi Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <!-- Form Input Data (Left side) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">Nama Mahasiswa</label>
                                    <input type="text" class="form-control" placeholder="MHS 1">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Dosen Pembimbing</label>
                                    <select class="form-select">
                                        <option>Ir. Gilang S.T, M.T</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">NIM</label>
                                        <input type="text" class="form-control" placeholder="1234567890">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">Nama Lomba</label>
                                        <input type="text" class="form-control" placeholder="Lomba Memanah">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">Kategori</label>
                                        <select class="form-select">
                                            <option>Kelompok</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">Waktu Lomba</label>
                                        <input type="date" class="form-control" value="2024-11-27">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">Tingkat</label>
                                        <input type="text" class="form-control" placeholder="Nasional">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">Penyelenggara</label>
                                        <input type="text" class="form-control" placeholder="Polinema">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">Peringkat</label>
                                        <select class="form-select">
                                            <option>Harapan 1</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">Tempat Lomba</label>
                                        <input type="text" class="form-control" placeholder="Malang">
                                    </div>
                                </div>
                            </div>


                            <!-- Form Upload (Right side) -->
                            <div class="col-md-6">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label required">Foto Sertifikat</label>
                                        <div class="upload-box">
                                            <div class="upload-icon">📤</div>
                                            <input type="file" onchange="updateUploadBox(this)" accept="image/jpeg, image/png, application/pdf">
                                            <div class="file-name">Upload File</div>
                                            <span class="remove-icon" onclick="removeFile(this)">&#10005;</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">Foto Lomba</label>
                                        <div class="upload-box">
                                            <div class="upload-icon">📤</div>
                                            <input type="file" onchange="updateUploadBox(this)" accept="image/jpeg, image/png, application/pdf">
                                            <div class="file-name">Upload File</div>
                                            <span class="remove-icon" onclick="removeFile(this)">&#10005;</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label required">Flyer Lomba</label>
                                        <div class="upload-box">
                                            <div class="upload-icon">📤</div>
                                            <input type="file" onchange="updateUploadBox(this)">
                                            <div class="file-name">Upload File</div>
                                            <span class="remove-icon" onclick="removeFile(this)">&#10005;</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">Surat Tugas</label>
                                        <div class="upload-box">
                                            <div class="upload-icon">📤</div>
                                            <input type="file" onchange="updateUploadBox(this)">
                                            <div class="file-name">Upload File</div>
                                            <span class="remove-icon" onclick="removeFile(this)">&#10005;</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label required">Ide Proposal</label>
                                        <div class="upload-box">
                                            <div class="upload-icon">📤</div>
                                            <input type="file" onchange="updateUploadBox(this)">
                                            <div class="file-name">Upload File</div>
                                            <span class="remove-icon" onclick="removeFile(this)">&#10005;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnBatal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menutup modal dan mereset form
        function resetForm() {
            const form = document.querySelector('#prestasiModal form');
            form.reset(); // Reset semua input di form
            const uploadBoxes = form.querySelectorAll('.upload-box .file-name');
            uploadBoxes.forEach(box => {
                box.textContent = 'Upload File'; // Reset teks file
                box.style.color = '#333'; // Reset warna teks file
            });
            const removeIcons = form.querySelectorAll('.remove-icon');
            removeIcons.forEach(icon => icon.style.display = 'none'); // Sembunyikan semua ikon "X"
        }

        // Tambahkan event listener pada tombol "Batal" dan ikon "X"
        document.querySelector('#btnBatal').addEventListener('click', resetForm);
        document.querySelector('.btn-close').addEventListener('click', resetForm);

        // Fungsi untuk memeriksa jenis file
        function validateFile(file) {
            const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf']; // Jenis file yang diizinkan
            const fileType = file.type;
            const fileName = file.name;

            if (!allowedTypes.includes(fileType)) {
                alert('File yang diupload harus berupa gambar (JPEG, PNG) atau PDF.');
                return false; // Menolak file yang tidak sesuai
            }

            // Jika file valid, lanjutkan
            return true;
        }

        // Fungsi untuk memperbarui upload box
        function updateUploadBox(inputElement) {
            const file = inputElement.files[0]; // Mendapatkan file pertama yang diunggah
            const uploadBox = inputElement.closest('.upload-box');
            const fileNameElement = uploadBox.querySelector('.file-name');
            const removeIcon = uploadBox.querySelector('.remove-icon');

            if (file) {
                // Memvalidasi file
                if (validateFile(file)) {
                    fileNameElement.textContent = file.name;
                    fileNameElement.style.color = '#007bff';
                    removeIcon.style.display = 'inline'; // Tampilkan ikon "X"
                } else {
                    // Jika file tidak valid, reset tampilan
                    inputElement.value = '';
                    fileNameElement.textContent = 'Upload File';
                    fileNameElement.style.color = '#333';
                    removeIcon.style.display = 'none'; // Sembunyikan ikon "X"
                }
            } else {
                fileNameElement.textContent = 'Upload File'; // Reset nama file
                fileNameElement.style.color = '#333';
                removeIcon.style.display = 'none'; // Sembunyikan ikon "X"
            }
        }

        function removeFile(iconElement) {
            const uploadBox = iconElement.closest('.upload-box');
            const inputElement = uploadBox.querySelector('input[type="file"]');
            const fileNameElement = uploadBox.querySelector('.file-name');

            inputElement.value = ''; // Hapus file dari input
            fileNameElement.textContent = 'Upload File'; // Reset nama file
            fileNameElement.style.color = '#333'; // Reset warna teks
            iconElement.style.display = 'none'; // Sembunyikan ikon "X"
        }
    </script>
</body>
</html>
