<div class="modal fade" id="prestasiModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Prestasi Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <!-- Form Input Data -->
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="col-md-12 mb-3">
                                <label for="namaMahasiswa" class="form-label required">Nama Mahasiswa</label>
                                <input type="text" id="namaMahasiswa" class="form-control"
                                    placeholder="Masukkan nama mahasiswa">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nimMahasiswa" class="form-label required">NIM</label>
                                    <input type="text" id="nimMahasiswa" class="form-control"
                                        placeholder="Masukkan NIM">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dosenPembimbing" class="form-label required">Dosen
                                        Pembimbing</label>
                                    <select id="dosenPembimbing" class="form-select">
                                        <option>Pilih dosen pembimbing</option>
                                        <option>Ir. Gilang S.T, M.T</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="namaLomba" class="form-label required">Nama Lomba</label>
                                    <input type="text" id="namaLomba" class="form-control"
                                        placeholder="Masukkan nama lomba">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kategoriLomba" class="form-label required">Kategori</label>
                                    <select id="kategoriLomba" class="form-select">
                                        <option>Pilih kategori lomba</option>
                                        <option>Kelompok</option>
                                        <option>Individu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="peringkatLomba" class="form-label required">Peringkat</label>
                                    <select id="peringkatLomba" class="form-select">
                                        <option>Pilih peringkat</option>
                                        <option>Juara 1</option>
                                        <option>Juara 2</option>
                                        <option>Juara 3</option>
                                        <option>Harapan 1</option>
                                        <option>Harapan 2</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tingkatLomba" class="form-label required">Tingkat</label>
                                    <input type="text" id="tingkatLomba" class="form-control"
                                        placeholder="Masukkan tingkat lomba">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="waktuMulai" class="form-label required">Waktu Lomba (Mulai)</label>
                                    <input type="date" id="waktuMulai" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="waktuSelesai" class="form-label required">Waktu Lomba
                                        (Selesai)</label>
                                    <input type="date" id="waktuSelesai" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="penyelenggara" class="form-label required">Penyelenggara</label>
                                    <input type="text" id="penyelenggara" class="form-control"
                                        placeholder="Masukkan nama penyelenggara">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tempatLomba" class="form-label required">Tempat Lomba</label>
                                    <input type="text" id="tempatLomba" class="form-control"
                                        placeholder="Masukkan lokasi lomba">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Upload -->
                    <div class="col-md-12 mb-3">
                        <label for="fotoSertifikat" class="form-label required">Foto Sertifikat</label>
                        <div class="upload-box">
                            <div class="upload-icon">📤</div>
                            <input type="file" id="fotoSertifikat" accept="image/jpeg, application/pdf"
                                onchange="updateUploadBox(this)">
                            <div class="pdf-icon">&#128196;</div>
                            <img src="" alt="Preview Image" class="preview-image">
                            <div class="file-name">Upload file</div>
                            <span class="remove-icon" onclick="removeFile(this)">&#10005;</span>
                        </div>
                        <div class="row g-4 mt-4">
                            <div class="col-md-6 mb-3">
                                <label for="fotoLomba" class="form-label required">Foto Lomba</label>
                                <div class="upload-box">
                                    <div class="upload-icon">📤</div>
                                    <input type="file" id="fotoLomba" accept="image/jpeg, application/pdf"
                                        onchange="updateUploadBox(this)">
                                    <div class="pdf-icon">&#128196;</div>
                                    <img src="" alt="Preview Image" class="preview-image">
                                    <div class="file-name">Upload file</div>
                                    <span class="remove-icon" onclick="removeFile(this)">&#10005;</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="flyerLomba" class="form-label required">Flyer Lomba</label>
                                <div class="upload-box">
                                    <div class="upload-icon">📤</div>
                                    <input type="file" id="flyerLomba" accept="image/jpeg, application/pdf"
                                        onchange="updateUploadBox(this)">
                                    <div class="pdf-icon">&#128196;</div>
                                    <img src="" alt="Preview Image" class="preview-image">
                                    <div class="file-name">Upload file</div>
                                    <span class="remove-icon" onclick="removeFile(this)">&#10005;</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="suratTugas" class="form-label required">Surat Tugas</label>
                            <div class="upload-box">
                                <div class="upload-icon">📤</div>
                                <input type="file" id="suratTugas" accept="image/jpeg, application/pdf"
                                    onchange="updateUploadBox(this)">
                                <div class="pdf-icon">&#128196;</div>
                                <img src="" alt="Preview Image" class="preview-image">
                                <div class="file-name">Upload file</div>
                                <span class="remove-icon" onclick="removeFile(this)">&#10005;</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="ideProposal" class="form-label">Ide Proposal</label>
                            <div class="upload-box">
                                <div class="upload-icon">📤</div>
                                <input type="file" id="ideProposal" accept="image/jpeg, application/pdf"
                                    onchange="updateUploadBox(this)">
                                <div class="pdf-icon">&#128196;</div>
                                <img src="" alt="Preview Image" class="preview-image">
                                <div class="file-name">Upload file</div>
                                <span class="remove-icon" onclick="removeFile(this)">&#10005;</span>
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
<script>
function updateUploadBox(inputElement) {
    const file = inputElement.files[0];
    const uploadBox = inputElement.closest('.upload-box');
    const previewImage = uploadBox.querySelector('.preview-image');
    const pdfIcon = uploadBox.querySelector('.pdf-icon');
    const uploadIcon = uploadBox.querySelector('.upload-icon');
    const fileNameElement = uploadBox.querySelector('.file-name');
    const removeIcon = uploadBox.querySelector('.remove-icon');

    if (file) {
        const fileType = file.type;

        if (fileType.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
                pdfIcon.style.display = 'none';
                uploadIcon.style.display = 'none';
                fileNameElement.textContent = file.name;
                fileNameElement.style.color = '#007bff';
            };
            reader.readAsDataURL(file);
        } else if (fileType === 'application/pdf') {
            previewImage.style.display = 'none';
            pdfIcon.style.display = 'block';
            uploadIcon.style.display = 'none';
            fileNameElement.textContent = file.name;
            fileNameElement.style.color = '#007bff';
        } else {
            alert('Hanya mendukung file gambar (JPEG/JPG) atau PDF.');
            inputElement.value = '';
            resetUploadBox(uploadBox);
            return;
        }

        removeIcon.style.display = 'inline';
        uploadBox.classList.add('active');
    } else {
        resetUploadBox(uploadBox);
    }
}

function removeFile(iconElement) {
    const uploadBox = iconElement.closest('.upload-box');
    const inputElement = uploadBox.querySelector('input[type="file"]');
    resetUploadBox(uploadBox);
    inputElement.value = '';
}

function resetUploadBox(uploadBox) {
    const previewImage = uploadBox.querySelector('.preview-image');
    const pdfIcon = uploadBox.querySelector('.pdf-icon');
    const uploadIcon = uploadBox.querySelector('.upload-icon');
    const fileNameElement = uploadBox.querySelector('.file-name');
    const removeIcon = uploadBox.querySelector('.remove-icon');

    previewImage.style.display = 'none';
    pdfIcon.style.display = 'none';
    uploadIcon.style.display = 'block';
    fileNameElement.textContent = 'Upload file';
    fileNameElement.style.color = '#6c757d';
    removeIcon.style.display = 'none';
    uploadBox.classList.remove('active');
}
</script>