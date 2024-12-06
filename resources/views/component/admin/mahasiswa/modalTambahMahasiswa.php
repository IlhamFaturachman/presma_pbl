<div class="modal fade" id="tambahMahasiswaModal" tabindex="-1" aria-labelledby="tambahMahasiswaLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahMahasiswaLabel">Tambah Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/presma_pbl/public/admin/mahasiswa" method="POST" id="addMahasiswaForm">
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <select class="form-select" id="nim" name="nim" required>
                            <option value="" disabled selected>Pilih Username (NIM)</option>
                        </select>
                        <div class="invalid-feedback">NIM wajib dipilih.</div>
                    </div>
                    <input type="hidden" id="user_id" name="user_id">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                        <div class="invalid-feedback">Nama wajib diisi.</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">Email wajib diisi.</div>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telp</label>
                        <input type="tel" class="form-control" id="no_telp" name="no_telp" required>
                        <div class="invalid-feedback">No. Telp wajib diisi.</div>
                    </div>
                    <div class="mb-3">
                        <label for="angkatan" class="form-label">Angkatan</label>
                        <select class="form-select" id="angkatan" name="angkatan" required>
                            <option value="" disabled selected>Pilih Angkatan</option>
                            <!-- Generate tahun dari 2022-2030 -->
                            <script>
                            for (let year = 2022; year <= 2030; year++) {
                                document.write(`<option value="${year}">${year}</option>`);
                            }
                            </script>
                        </select>
                        <div class="invalid-feedback">Angkatan wajib dipilih.</div>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select class="form-select" id="kelas" name="kelas" required>
                            <option value="" disabled selected>Pilih Kelas</option>
                            <script>
                            for (let level = 1; level <= 4; level++) {
                                for (let char of "ABCDEFGHI") {
                                    document.write(
                                        `<option value="${level}${char}">${level}${char}</option>`
                                    );
                                }
                            }
                            </script>
                        </select>
                        <div class="invalid-feedback">Kelas wajib dipilih.</div>
                    </div>
                    <div class="mb-3">
                        <label for="prodi" class="form-label">Prodi</label>
                        <select class="form-select" id="prodi" name="prodi" required>
                            <option value="" disabled selected>Pilih Prodi</option>
                        </select>
                        <div class="invalid-feedback">Prodi wajib dipilih.</div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("addMahasiswaForm");

    // Fetch data user untuk dropdown NIM
    document.getElementById('tambahMahasiswaModal').addEventListener('show.bs.modal', async () => {
        try {
            const response = await fetch(
                '/presma_pbl/public/admin/for-mahasiswa'
            ); // Fetch hanya user dengan role mahasiswa
            if (!response.ok) throw new Error("Gagal memuat data NIM.");
            const data = await response.json();

            const nimSelect = document.getElementById('nim');
            const userIdSelect = document.getElementById('user_id');
            nimSelect.innerHTML =
                '<option value="" disabled selected>Pilih Username (NIM)</option>';
            data.forEach(user => {
                const option = document.createElement('option');
                option.value = user.username; // Username dijadikan NIM
                option.textContent = user.username;
                option.dataset.userId = user.user_id; // Simpan user_id sebagai data atribut
                nimSelect.appendChild(option);
            });
        } catch (error) {
            alert("Terjadi kesalahan saat memuat NIM. Silakan coba lagi.");
            console.error(error);
        }

        // Fetch prodi
        try {
            const response = await fetch('/presma_pbl/public/admin/program-studi');
            if (!response.ok) throw new Error("Gagal memuat data prodi.");
            const data = await response.json();

            const prodiSelect = document.getElementById('prodi');
            prodiSelect.innerHTML = '<option value="" disabled selected>Pilih Prodi</option>';
            data.forEach(prodi => {
                const option = document.createElement('option');
                option.value = prodi.prodi_id;
                option.textContent = prodi.nama_prodi;
                prodiSelect.appendChild(option);
            });
        } catch (error) {
            alert("Terjadi kesalahan saat memuat prodi. Silakan coba lagi.");
            console.error(error);
        }
    });

    // Update user_id berdasarkan pilihan NIM
    document.getElementById("nim").addEventListener("change", (e) => {
        const selectedOption = e.target.selectedOptions[0];
        const userIdField = document.getElementById("user_id");
        userIdField.value = selectedOption.dataset.userId || "";
    });

    // Reset Form Saat Modal Ditutup
    document.getElementById('tambahMahasiswaModal').addEventListener('hidden.bs.modal', () => {
        form.reset();
        form.classList.remove("was-validated");
    });

    // Submit Form
    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        if (!form.checkValidity()) {
            form.classList.add("was-validated");
            return;
        }

        const submitButton = document.getElementById("submitButton");
        submitButton.disabled = true;
        submitButton.innerHTML =
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...`;

        try {
            const response = await fetch(form.action, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    nim: form.nim.value, // NIM diambil dari username
                    nama: form.nama.value,
                    email: form.email.value,
                    phone: form.no_telp.value,
                    angkatan: form.angkatan.value,
                    kelas: form.kelas.value,
                    prodi_id: form.prodi.value,
                    user_id: form.user_id.value, // Ambil user_id yang dipilih
                }),
            });

            const result = await response.json();
            if (result.success) {
                form.reset();
                bootstrap.Modal.getInstance(document.getElementById("tambahMahasiswaModal")).hide();
                alert("Mahasiswa berhasil ditambahkan!");
                window.location.reload(); // Refresh halaman
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
});
</script>