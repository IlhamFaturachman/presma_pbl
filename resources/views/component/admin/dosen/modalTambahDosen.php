<div class="modal fade" id="tambahDosenModal" tabindex="-1" aria-labelledby="tambahDosenLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDosenLabel">Tambah Dosen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/presma_pbl/public/admin/dosen" method="POST" id="addDosenForm">
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <select class="form-select" id="nip" name="nip" required>
                            <option value="" disabled selected>Pilih Username (NIP)</option>
                        </select>
                        <div class="invalid-feedback">NIP wajib dipilih.</div>
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
    const form = document.getElementById("addDosenForm");

    // Fetch data user untuk dropdown NIP
    document.getElementById('tambahDosenModal').addEventListener('show.bs.modal', async () => {
        try {
            const response = await fetch(
                '/presma_pbl/public/admin/for-dosen'
            ); // Fetch hanya user dengan role dosen
            if (!response.ok) throw new Error("Gagal memuat data NIP.");
            const data = await response.json();

            const nipSelect = document.getElementById('nip');
            const userIdSelect = document.getElementById('user_id');
            nipSelect.innerHTML =
                '<option value="" disabled selected>Pilih Username (NIP)</option>';
            data.forEach(user => {
                const option = document.createElement('option');
                option.value = user.username; // Username dijadikan NIP
                option.textContent = user.username;
                option.dataset.userId = user.user_id; // Simpan user_id sebagai data atribut
                nipSelect.appendChild(option);
            });
        } catch (error) {
            alert("Terjadi kesalahan saat memuat NIP. Silakan coba lagi.");
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

    // Update user_id berdasarkan pilihan NIP
    document.getElementById("nip").addEventListener("change", (e) => {
        const selectedOption = e.target.selectedOptions[0];
        const userIdField = document.getElementById("user_id");
        userIdField.value = selectedOption.dataset.userId || "";
    });

    // Reset Form Saat Modal Ditutup
    document.getElementById('tambahDosenModal').addEventListener('hidden.bs.modal', () => {
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
                    nip: form.nip.value, // NIP diambil dari username
                    nama: form.nama.value,
                    email: form.email.value,
                    phone: form.no_telp.value,
                    prodi_id: form.prodi.value,
                    user_id: form.user_id.value, // Ambil user_id yang dipilih
                }),
            });

            const result = await response.json();
            if (result.success) {
                form.reset();
                bootstrap.Modal.getInstance(document.getElementById("tambahDosenModal")).hide();
                alert("Dosen berhasil ditambahkan!");
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