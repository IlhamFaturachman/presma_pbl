<div class="modal fade" id="addPrestasiModal" tabindex="-1" aria-labelledby="addPrestasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPrestasiModalLabel">Tambah Prestasi Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="path_to_your_server_endpoint" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        <!-- Baris 1 -->
                        <div class="col-md-4">
                            <label for="namaMahasiswa" class="form-label">Nama Mahasiswa *</label>
                            <input type="text" class="form-control" id="namaMahasiswa" name="namaMahasiswa"
                                placeholder="Masukkan Nama Mahasiswa" required>
                        </div>
                        <div class="col-md-4">
                            <label for="nim" class="form-label">NIM *</label>
                            <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label for="namaLomba" class="form-label">Nama Lomba *</label>
                            <input type="text" class="form-control" id="namaLomba" name="namaLomba"
                                placeholder="Masukkan Nama Lomba" required>
                        </div>

                        <!-- Baris 2 -->
                        <div class="col-md-4">
                            <label for="kategori" class="form-label">Kategori *</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="" selected disabled>Pilih Kategori</option>
                                <option value="Individu">Individu</option>
                                <option value="Kelompok">Kelompok</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="tingkat" class="form-label">Tingkat *</label>
                            <select class="form-select" id="tingkat" name="tingkat" required>
                                <option value="" selected disabled>Pilih Tingkat</option>
                                <option value="Regional">Regional</option>
                                <option value="Nasional">Nasional</option>
                                <option value="Internasional">Internasional</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="peringkat" class="form-label">Peringkat *</label>
                            <select class="form-select" id="peringkat" name="peringkat" required>
                                <option value="" selected disabled>Pilih Peringkat</option>
                                <option value="Juara 1">Juara 1</option>
                                <option value="Juara 2">Juara 2</option>
                                <option value="Juara 3">Juara 3</option>
                                <option value="Harapan 1">Harapan 1</option>
                                <option value="Harapan 2">Harapan 2</option>
                            </select>
                        </div>

                        <!-- Baris 3 -->
                        <div class="col-md-4">
                            <label for="dosenPembimbing" class="form-label">Dosen Pembimbing *</label>
                            <select class="form-select" id="dosenPembimbing" name="dosenPembimbing" required>
                                <option value="" selected disabled>Pilih Dosen Pembimbing</option>
                                <!-- Tambahkan opsi dosen di sini -->
                                <option value="Ir. Gilang S.T, M.T">Ir. Gilang S.T, M.T</option>
                                <option value="Dr. Aulia Rahman S.T, M.Sc">Dr. Aulia Rahman S.T, M.Sc</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="programStudi" class="form-label">Program Studi *</label>
                            <select class="form-select" id="programStudi" name="programStudi" required>
                                <option value="" selected disabled>Pilih Program Studi</option>
                                <option value="D-IV Teknik Informatika">D-IV Teknik Informatika</option>
                                <option value="D-IV Sistem Informasi Bisnis">D-IV Sistem Informasi Bisnis</option>
                                <option value="D-II PPLS">D-II PPLS</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="waktuLomba" class="form-label">Waktu Lomba *</label>
                            <input type="date" class="form-control" id="waktuLomba" name="waktuLomba" required>
                        </div>

                        <!-- Baris 4 -->
                        <div class="col-md-4">
                            <label for="penyelenggara" class="form-label">Penyelenggara *</label>
                            <input type="text" class="form-control" id="penyelenggara" name="penyelenggara"
                                placeholder="Masukkan Penyelenggara" required>
                        </div>
                        <div class="col-md-4">
                            <label for="tempatLomba" class="form-label">Tempat Lomba *</label>
                            <input type="text" class="form-control" id="tempatLomba" name="tempatLomba"
                                placeholder="Masukkan Tempat Lomba" required>
                        </div>
                    </div>

                    <!-- Section File Upload -->
                    <div class="row g-3 mt-3 text-center">
                        <div class="col-md-2">
                            <label for="fotoSertifikat" class="form-label">Foto Sertifikat *</label>
                            <input type="file" class="form-control" id="fotoSertifikat" name="fotoSertifikat" required>
                        </div>
                        <div class="col-md-2">
                            <label for="fotoLomba" class="form-label">Foto Lomba *</label>
                            <input type="file" class="form-control" id="fotoLomba" name="fotoLomba" required>
                        </div>
                        <div class="col-md-2">
                            <label for="flyerLomba" class="form-label">Flyer Lomba *</label>
                            <input type="file" class="form-control" id="flyerLomba" name="flyerLomba" required>
                        </div>
                        <div class="col-md-2">
                            <label for="suratTugas" class="form-label">Surat Tugas *</label>
                            <input type="file" class="form-control" id="suratTugas" name="suratTugas" required>
                        </div>
                        <div class="col-md-2">
                            <label for="ideProposal" class="form-label">Ide Proposal</label>
                            <input type="file" class="form-control" id="ideProposal" name="ideProposal">
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>