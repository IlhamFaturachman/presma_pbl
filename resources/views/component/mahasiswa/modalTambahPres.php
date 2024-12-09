<div class="modal fade" id="prestasiModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Prestasi Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/presma_pbl/public/mahasiswa/prestasi" method="POST" id="addPrestasiForm"
                    enctype="multipart/form-data">
                    <!-- Form Input Data -->
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="col-md-12 mb-3">
                                <input type="text" id="namaMahasiswa" name="namaMahasiswa" class="form-control"
                                    placeholder="Masukkan nama mahasiswa" value="<?php echo $userName; ?>" readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nim" class="form-label required">NIM</label>
                                    <input type="text" id="nim" name="nim" class="form-control"
                                        placeholder="Masukkan NIM" value="<?php echo $userNameFromTableUsers; ?>"
                                        readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dosenPembimbing" class="form-label required">Dosen
                                        Pembimbing</label>
                                    <select id="dosenPembimbing" name="nip" class="form-select" required>
                                        <option value="" disabled selected>Pilih Dosen Pembimbing</option>
                                    </select>
                                    <div class="invalid-feedback">Dosen wajib dipilih.</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_lomba" class="form-label required">Nama Lomba</label>
                                    <input type="text" id="nama_lomba" name="nama_lomba" class="form-control"
                                        placeholder="Masukkan nama lomba">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kategori_lomba" class="form-label required">Kategori</label>
                                    <select id="kategori_lomba" name="kategori_lomba" class="form-select">
                                        <option value="" disabled selected>Pilih kategori lomba</option>
                                        <option>Kelompok</option>
                                        <option>Individu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="peringkatLomba" class="form-label required">Peringkat</label>
                                    <select id="peringkatLomba" name="juara_id" class="form-select" required>
                                        <option value="" disabled selected>Pilih Peringkat Lomba</option>
                                    </select>
                                    <div class="invalid-feedback">Peringkat wajib dipilih.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tingkatLomba" class="form-label required">Tingkatan</label>
                                    <select id="tingkatLomba" name="tingkatan_id" class="form-select" required>
                                        <option value="" disabled selected>Pilih Tingkat Lomba</option>
                                    </select>
                                    <div class="invalid-feedback">Tingkatan wajib dipilih.</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="waktu_mulai_lomba" class="form-label required">Waktu Lomba
                                        (Mulai)</label>
                                    <input type="date" id="waktu_mulai_lomba" name="waktu_mulai_lomba"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="waktu_selesai_lomba" class="form-label required">Waktu Lomba
                                        (Selesai)</label>
                                    <input type="date" id="waktu_selesai_lomba" name="waktu_selesai_lomba"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="penyelenggara" class="form-label required">Penyelenggara</label>
                                    <input type="text" id="penyelenggara" name="penyelenggara" class="form-control"
                                        placeholder="Masukkan nama penyelenggara">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tempat_lomba" class="form-label required">Tempat Lomba</label>
                                    <input type="text" id="tempat_lomba" name="tempat_lomba" class="form-control"
                                        placeholder="Masukkan lokasi lomba">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Upload -->
                    <div class="col-md-12 mb-3">
                        <label for="sertifikat" class="form-label required">Foto Sertifikat</label>
                        <div class="upload-box">
                            <div class="upload-icon">📤</div>
                            <input type="file" id="sertifikat" name="sertifikat" accept="image/jpeg, application/pdf">
                            <div class="pdf-icon">&#128196;</div>
                            <img src="" alt="Preview Image" class="preview-image">
                            <div class="file-name">Upload file</div>
                            <span class="remove-icon" onclick="removeFile(this)">&#10005;</span>
                        </div>
                        <div class="row g-4 mt-4">
                            <div class="col-md-6 mb-3">
                                <label for="foto_lomba" class="form-label required">Foto Lomba</label>
                                <div class="upload-box">
                                    <div class="upload-icon">📤</div>
                                    <input type="file" id="foto_lomba" name="foto_lomba"
                                        accept="image/jpeg, application/pdf">
                                    <div class="pdf-icon">&#128196;</div>
                                    <img src="" alt="Preview Image" class="preview-image">
                                    <div class="file-name">Upload file</div>
                                    <span class="remove-icon" onclick="removeFile(this)">&#10005;</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="flyer_lomba" class="form-label required">Flyer Lomba</label>
                                <div class="upload-box">
                                    <div class="upload-icon">📤</div>
                                    <input type="file" id="flyer_lomba" name="flyer_lomba"
                                        accept="image/jpeg, application/pdf">
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
                            <label for="surat_tugas" class="form-label required">Surat Tugas</label>
                            <div class="upload-box">
                                <div class="upload-icon">📤</div>
                                <input type="file" id="surat_tugas" name="surat_tugas"
                                    accept="image/jpeg, application/pdf">
                                <div class="pdf-icon">&#128196;</div>
                                <img src="" alt="Preview Image" class="preview-image">
                                <div class="file-name">Upload file</div>
                                <span class="remove-icon" onclick="removeFile(this)">&#10005;</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="ide_proposal" class="form-label">Ide Proposal</label>
                            <div class="upload-box">
                                <div class="upload-icon">📤</div>
                                <input type="file" id="ide_proposal" name="ide_proposal"
                                    accept="image/jpeg, application/pdf">
                                <div class="pdf-icon">&#128196;</div>
                                <img src="" alt="Preview Image" class="preview-image">
                                <div class="file-name">Upload file</div>
                                <span class="remove-icon" onclick="removeFile(this)">&#10005;</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="btnBatal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", async () => { // Mengubah menjadi async
            // Mendapatkan form
            const form = document.getElementById("addPrestasiForm");

            const formData = new FormData(form);

            // Fungsi untuk memperbarui kotak upload
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

            // Fungsi untuk mereset kotak upload
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

            // Fungsi untuk menghapus file
            function removeFile(iconElement) {
                const uploadBox = iconElement.closest('.upload-box');
                const inputElement = uploadBox.querySelector('input[type="file"]');
                resetUploadBox(uploadBox);
                inputElement.value = '';
            }

            // Menambahkan event listener untuk semua input file dengan id yang ditentukan
            const fileInputs = [
                'sertifikat',
                'foto_lomba',
                'flyer_lomba',
                'surat_tugas',
                'ide_proposal'
            ];

            fileInputs.forEach(inputId => {
                const fileInputElement = document.getElementById(inputId);
                if (fileInputElement) {
                    fileInputElement.addEventListener('change', (e) => {
                        updateUploadBox(e.target);
                    });
                }
            });

            // Fetch data Dosen Pembimbing
            try {
                const response = await fetch('/presma_pbl/public/mahasiswa/dosen');
                if (!response.ok) throw new Error("Gagal memuat data Dosen Pembimbing.");
                const data = await response.json();

                const dosenSelect = document.getElementById('dosenPembimbing');
                dosenSelect.innerHTML = '<option value="" disabled selected>Pilih Dosen Pembimbing</option>';
                data.forEach(dosen => {
                    const option = document.createElement('option');
                    option.value = dosen.nip; // Harus ada nip di sini
                    option.textContent = dosen.nama;
                    dosenSelect.appendChild(option);
                });
            } catch (error) {
                alert("Terjadi kesalahan saat memuat data Dosen Pembimbing. Silakan coba lagi.");
                console.error(error);
            }

            // Fetch data Juara
            try {
                const response = await fetch('/presma_pbl/public/mahasiswa/juara');
                if (!response.ok) throw new Error("Gagal memuat data Peringkat.");
                const data = await response.json();

                const juaraSelect = document.getElementById('peringkatLomba');
                juaraSelect.innerHTML = '<option value="" disabled selected>Pilih Peringkat</option>';
                data.forEach(juara => {
                    const option = document.createElement('option');
                    option.value = juara.juara_id;
                    option.textContent = `${juara.nama_juara} (Point: ${juara.point})`;
                    juaraSelect.appendChild(option);
                });
            } catch (error) {
                alert("Terjadi kesalahan saat memuat data Juara. Silakan coba lagi.");
                console.error(error);
            }

            // Fetch data Tingkatan
            try {
                const response = await fetch('/presma_pbl/public/mahasiswa/tingkatan');
                if (!response.ok) throw new Error("Gagal memuat data Tingkat Lomba.");
                const data = await response.json();

                const tingkatanSelect = document.getElementById('tingkatLomba');
                tingkatanSelect.innerHTML =
                    '<option value="" disabled selected>Pilih Tingkatan Lomba</option>';
                data.forEach(tingkatan => {
                    const option = document.createElement('option');
                    option.value = tingkatan.tingkatan_id;
                    option.textContent =
                        `${tingkatan.nama_tingkatan} (Point: ${tingkatan.point})`;
                    tingkatanSelect.appendChild(option);
                });
            } catch (error) {
                alert("Terjadi kesalahan saat memuat data Tingkatan. Silakan coba lagi.");
                console.error(error);
            }

            // Event listener untuk form submit
            form.addEventListener("submit", async (e) => {
                e.preventDefault();


                // Validasi form
                if (!form.checkValidity()) {
                    form.classList.add("was-validated");
                    return;
                }

                const formData = new FormData(form);

                formData.delete('namaMahasiswa');
                console.log("nip: ", form.nip.value);
                console.log("juara_id: ", form.juara_id.value);
                console.log("tingkatan_id: ", form.tingkatan_id.value);


                // Disable submit button dan tampilkan loading
                const submitButton = document.getElementById("submitButton");
                submitButton.disabled = true;
                submitButton.innerHTML =
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...`;

                try {
                    // Ambil data form dan kirim ke server
                    const response = await fetch(form.action, {
                        method: "POST",
                        body: formData
                    });

                    const result = await response.json();
                    console.log(result);

                    if (result.success) {
                        form.reset();
                        bootstrap.Modal.getInstance(document.getElementById("prestasiModal"))
                            .hide();
                        alert("Prestasi berhasil ditambahkan!");
                        window.location.reload();
                    } else {
                        alert(result.message || "Terjadi kesalahan. Silakan coba lagi.");
                    }
                } catch (error) {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan. Silakan coba lagi.");
                } finally {
                    submitButton.disabled = false;
                    submitButton.innerHTML = "Simpan";
                }
            });

            // Reset form saat modal ditutup
            document.getElementById('prestasiModal').addEventListener('hidden.bs.modal', () => {
                form.reset();
                form.classList.remove("was-validated");
            });
        });
    </script>