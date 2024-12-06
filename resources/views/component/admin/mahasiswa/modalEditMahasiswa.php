<div class="modal fade" id="editMahasiswaModal" tabindex="-1" aria-labelledby="editMahasiswaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMahasiswaLabel">Edit Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editMahasiswaForm">
                    <!-- <input type="hidden" id="edit-nim" name="nim"> -->
                    <div class="mb-3">
                        <label for="edit-nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="edit-nim" name="nim" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit-nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="edit-nama" name="nama" required>
                        <div class="invalid-feedback">Nama wajib diisi.</div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit-email" name="email" required>
                        <div class="invalid-feedback">Email wajib diisi.</div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-phone" class="form-label">No. Telp</label>
                        <input type="tel" class="form-control" id="edit-phone" name="phone" required>
                        <div class="invalid-feedback">No. Telp wajib diisi.</div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-angkatan" class="form-label">Angkatan</label>
                        <select class="form-select" id="edit-angkatan" name="angkatan" required>
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
                        <label for="edit-kelas" class="form-label">Kelas</label>
                        <select class="form-select" id="edit-kelas" name="kelas" required>
                            <option value="" disabled selected>Pilih Kelas</option>
                            <script>
                            for (let level = 1; level <= 4; level++) {
                                for (let char of "ABCDEFGHI") {
                                    document.write(`<option value="${level}${char}">${level}${char}</option>`);
                                }
                            }
                            </script>
                        </select>
                        <div class="invalid-feedback">Kelas wajib dipilih.</div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-prodi" class="form-label">Prodi</label>
                        <select class="form-select" id="edit-prodi" name="prodi" required>
                            <option value="" disabled selected>Pilih Prodi</option>
                        </select>
                        <div class="invalid-feedback">Prodi wajib dipilih.</div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="edit-submitButton">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("editMahasiswaForm");
    const submitButton = document.getElementById("edit-submitButton");

    // Tampilkan data mahasiswa saat modal dibuka
    document.getElementById('editMahasiswaModal').addEventListener('show.bs.modal', async (event) => {
        const button = event.relatedTarget; // Tombol yang memicu modal
        const nim = button.getAttribute('data-mahasiswa-nim'); // Ambil nim dari tombol
        const modal = document.getElementById('editMahasiswaModal');

        try {
            // Ambil data mahasiswa berdasarkan nim
            const response = await fetch(`/presma_pbl/public/admin/mahasiswa/${nim}`);
            if (!response.ok) {
                console.error("Error response:", await response.text());
                throw new Error("Gagal memuat data mahasiswa");
            }
            const data = await response.json();

            // Isi form dengan data mahasiswa
            modal.querySelector("#edit-nim").value = data.nim;
            modal.querySelector("#edit-nama").value = data.nama;
            modal.querySelector("#edit-email").value = data.email;
            modal.querySelector("#edit-phone").value = data.phone;
            modal.querySelector("#edit-angkatan").value = data.angkatan;
            modal.querySelector("#edit-kelas").value = data.kelas;

            // Load prodi
            const prodiResponse = await fetch('/presma_pbl/public/admin/program-studi');
            if (!prodiResponse.ok) throw new Error("Gagal memuat data prodi.");
            const prodiData = await prodiResponse.json();

            const prodiSelect = modal.querySelector("#edit-prodi");
            prodiSelect.innerHTML = '<option value="" disabled>Pilih Prodi</option>';
            prodiData.forEach(prodi => {
                const option = document.createElement("option");
                option.value = prodi.prodi_id;
                option.textContent = prodi.nama_prodi;
                if (prodi.prodi_id == data.prodi_id) {
                    option.selected = true;
                }
                prodiSelect.appendChild(option);
            });
        } catch (error) {
            alert("Terjadi kesalahan saat memuat data. Silakan coba lagi.");
            console.error(error);
        }
    });

    // Submit form untuk update
    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        if (!form.checkValidity()) {
            form.classList.add("was-validated");
            return;
        }

        submitButton.disabled = true;
        submitButton.innerHTML =
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memperbarui...`;

        const payload = {
            nama: form["edit-nama"].value,
            email: form["edit-email"].value,
            phone: form["edit-phone"].value,
            angkatan: form["edit-angkatan"].value,
            kelas: form["edit-kelas"].value,
            prodi_id: form["edit-prodi"].value,
        };

        const nim = form["edit-nim"].value;

        try {
            const response = await fetch(`/presma_pbl/public/admin/mahasiswa/${nim}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(payload),
            });

            const result = await response.json();
            if (result.success) {
                form.reset();
                bootstrap.Modal.getInstance(document.getElementById("editMahasiswaModal")).hide();
                alert("Mahasiswa berhasil diperbarui!");
                window.location.reload(); // Refresh halaman
            } else {
                alert(result.message || "Terjadi kesalahan. Silakan coba lagi.");
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Terjadi kesalahan. Silakan coba lagi.");
        } finally {
            submitButton.disabled = false;
            submitButton.innerHTML = "Perbarui";
        }
    });
});
</script>