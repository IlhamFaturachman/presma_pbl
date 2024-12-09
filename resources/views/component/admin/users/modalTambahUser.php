<div class="modal fade" id="tambahPenggunaModal" tabindex="-1" aria-labelledby="tambahPenggunaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPenggunaModalLabel">Tambah Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/presma_pbl/public/admin/users" method="POST" id="addUserForm">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                        <div class="invalid-feedback">Username wajib diisi.</div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <button type="button" class="btn btn-outline-secondary toggle-password">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback">Password wajib diisi.</div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="verify-password" class="form-label">Verifikasi Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="verify-password" name="verify-password"
                                required>
                            <button type="button" class="btn btn-outline-secondary toggle-password">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback">Password tidak cocok.</div>
                    </div>
                    <div class="mb-3">
                        <label for="roles" class="form-label">Roles</label>
                        <select class="form-select" id="roles" name="roles" required>
                            <option value="" disabled selected>Pilih Role</option>
                        </select>
                        <div class="invalid-feedback">Role wajib dipilih.</div>
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
        const form = document.getElementById("addUserForm");
        const passwordField = document.getElementById("password");
        const verifyPasswordField = document.getElementById("verify-password");
        const submitButton = document.getElementById("submitButton");

        // Tampilkan Role
        document.getElementById('tambahPenggunaModal').addEventListener('show.bs.modal', async () => {
            try {
                const response = await fetch('/presma_pbl/public/admin/roles');
                if (!response.ok) throw new Error("Gagal memuat roles");
                const data = await response.json();

                const rolesSelect = document.getElementById('roles');
                rolesSelect.innerHTML = '<option value="" disabled selected>Pilih Role</option>';
                data.forEach(role => {
                    const option = document.createElement('option');
                    option.value = role.role_id;
                    option.textContent = role.role_name;
                    rolesSelect.appendChild(option);
                });
            } catch (error) {
                alert("Terjadi kesalahan saat memuat roles. Silakan coba lagi.");
                console.error(error);
            }
        });

        // Lihat/Tutup Password
        document.querySelectorAll(".toggle-password").forEach(button => {
            button.addEventListener("click", () => {
                const input = button.previousElementSibling;
                const icon = button.querySelector("i");
                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.replace("bi-eye-slash", "bi-eye");
                } else {
                    input.type = "password";
                    icon.classList.replace("bi-eye", "bi-eye-slash");
                }
            });
        });

        const validatePasswordMatch = () => {
            if (passwordField.value !== verifyPasswordField.value) {
                verifyPasswordField.classList.add("is-invalid");
                return false;
            } else {
                verifyPasswordField.classList.remove("is-invalid");
                return true;
            }
        };

        passwordField.addEventListener("input", validatePasswordMatch);
        verifyPasswordField.addEventListener("input", validatePasswordMatch);

        // Validasi Form
        const validateForm = () => {
            let isValid = true;

            document.querySelectorAll(".is-invalid").forEach((el) => el.classList.remove("is-invalid"));

            if (!validatePasswordMatch()) {
                isValid = false;
            }

            if (!form.checkValidity()) {
                isValid = false;
            }

            return isValid;
        };

        // Reset Form Saat Modal Ditutup
        document.getElementById('tambahPenggunaModal').addEventListener('hidden.bs.modal', () => {
            form.reset();
            form.classList.remove("was-validated");
            document.querySelectorAll(".is-invalid").forEach((el) => el.classList.remove("is-invalid"));
        });

        // Submit Form
        form.addEventListener("submit", async (e) => {
            e.preventDefault();

            if (!validateForm()) {
                form.classList.add("was-validated");
                return;
            }

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
                        username: form.username.value,
                        password: form.password.value,
                        role_id: form.roles.value,
                    }),
                });

                const result = await response.json();
                if (result.success) {
                    form.reset();
                    form.classList.remove("was-validated");
                    bootstrap.Modal.getInstance(document.getElementById("tambahPenggunaModal")).hide();
                    alert("Pengguna berhasil ditambahkan!");
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