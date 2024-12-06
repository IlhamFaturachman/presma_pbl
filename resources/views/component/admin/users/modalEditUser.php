<div class="modal fade" id="editPenggunaModal" tabindex="-1" aria-labelledby="editPenggunaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPenggunaModalLabel">Edit Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editUserForm">
                    <input type="hidden" id="edit-user_id" name="user_id">
                    <div class="mb-3">
                        <label for="edit-username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="edit-username" name="username" required>
                        <div class="invalid-feedback">Username wajib diisi.</div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="edit-password" class="form-label">Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="edit-password" name="password">
                            <button type="button" class="btn btn-outline-secondary toggle-password">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        <div class="form-text">Biarkan kosong jika tidak ingin mengubah password.</div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="edit-verify-password" class="form-label">Verifikasi Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="edit-verify-password"
                                name="verify-password">
                            <button type="button" class="btn btn-outline-secondary toggle-password">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback">Password tidak cocok.</div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-roles" class="form-label">Roles</label>
                        <select class="form-select" id="edit-roles" name="roles" required>
                            <option value="" disabled selected>Pilih Role</option>
                        </select>
                        <div class="invalid-feedback">Role wajib dipilih.</div>
                    </div>
                    <div id="role-warning" class="form-text text-danger d-none">Role tidak dapat diubah untuk pengguna
                        ini karena sudah memiliki data di tabel lain.</div>
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
    const form = document.getElementById("editUserForm");
    const submitButton = document.getElementById("edit-submitButton");

    // Validasi Password
    const validatePasswordMatch = () => {
        const passwordField = form.querySelector("#edit-password");
        const verifyPasswordField = form.querySelector("#edit-verify-password");

        if (passwordField.value !== verifyPasswordField.value) {
            verifyPasswordField.classList.add("is-invalid");
            return false;
        } else {
            verifyPasswordField.classList.remove("is-invalid");
            return true;
        }
    };

    form.querySelector("#edit-password").addEventListener("input", validatePasswordMatch);
    form.querySelector("#edit-verify-password").addEventListener("input", validatePasswordMatch);

    // Tampilkan data pengguna saat modal dibuka
    document.getElementById('editPenggunaModal').addEventListener('show.bs.modal', async (event) => {
        const button = event.relatedTarget; // Tombol yang memicu modal
        const userId = button.getAttribute('data-user-id'); // Ambil user_id dari tombol
        const modal = document.getElementById('editPenggunaModal');

        try {
            const response = await fetch(`/presma_pbl/public/admin/users/${userId}`);
            if (!response.ok) throw new Error("Gagal memuat data pengguna");
            const data = await response.json();

            modal.querySelector("#edit-user_id").value = data.user_id;
            modal.querySelector("#edit-username").value = data.username;

            const rolesResponse = await fetch('/presma_pbl/public/admin/roles');
            if (!rolesResponse.ok) throw new Error("Gagal memuat roles");
            const roles = await rolesResponse.json();

            const rolesSelect = modal.querySelector("#edit-roles");
            rolesSelect.innerHTML = '<option value="" disabled>Pilih Role</option>';
            roles.forEach(role => {
                const option = document.createElement("option");
                option.value = role.role_id;
                option.textContent = role.role_name;
                if (role.role_id == data.role_id) {
                    option.selected = true;
                }
                rolesSelect.appendChild(option);
            });

            // Simpan data-current-role untuk validasi di submit
            rolesSelect.setAttribute("data-current-role", data.role_id);

            // Nonaktifkan dropdown role jika user tidak bisa mengubah role
            if (data.is_role_editable === false) {
                rolesSelect.setAttribute("disabled", "true");
                document.getElementById("role-warning").classList.remove("d-none");
            } else {
                rolesSelect.removeAttribute("disabled");
                document.getElementById("role-warning").classList.add("d-none");
            }
        } catch (error) {
            alert("Terjadi kesalahan saat memuat data. Silakan coba lagi.");
            console.error(error);
        }
    });

    // Submit form untuk update
    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        // Validasi password cocok
        if (!validatePasswordMatch()) {
            alert("Password tidak cocok. Mohon periksa kembali.");
            return;
        }

        submitButton.disabled = true;
        submitButton.innerHTML =
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memperbarui...`;

        const userId = form["edit-user_id"].value;
        const payload = {
            username: form["edit-username"].value,
        };

        // Tambahkan role_id jika dropdown roles tidak disabled
        const rolesSelect = form.querySelector("#edit-roles");
        const currentRole = rolesSelect.getAttribute("data-current-role");
        if (!rolesSelect.disabled) {
            payload.role_id = rolesSelect.value;
        }

        // Tambahkan password jika diisi
        if (form["edit-password"].value) {
            payload.password = form["edit-password"].value;
        }

        try {
            const response = await fetch(`/presma_pbl/public/admin/users/${userId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(payload),
            });

            const result = await response.json();

            if (result.success) {
                // Berikan pesan jika role tidak diperbarui
                alert("Pengguna berhasil diperbarui!");
                form.reset();
                bootstrap.Modal.getInstance(document.getElementById("editPenggunaModal")).hide();
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