<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p>Apakah Anda yakin ingin menghapus pengguna ini?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    let userIdToDelete = null;

    // Tampilkan modal konfirmasi
    document.querySelectorAll(".deleteUser ").forEach(button => {
        button.addEventListener("click", (e) => {
            userIdToDelete = e.currentTarget.dataset
                .userId; // Menggunakan e.currentTarget untuk mendapatkan elemen yang benar
            console.log("User  ID to delete:",
                userIdToDelete); // Log untuk memastikan ID diambil dengan benar
            const deleteModal = new bootstrap.Modal(document.getElementById("deleteModal"));
            deleteModal.show();
        });
    });

    // Konfirmasi hapus
    document.getElementById("confirmDelete").addEventListener("click", async () => {
        console.log("Hapus button clicked"); // Log ketika tombol diklik
        console.log("User  ID to delete:", userIdToDelete); // Log ID pengguna yang akan dihapus
        if (!userIdToDelete) return;

        const submitButton = document.getElementById("confirmDelete");
        submitButton.disabled = true;
        submitButton.innerHTML =
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menghapus...`;

        try {
            const response = await fetch(`/presma_pbl/public/admin/users/${userIdToDelete}`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                },
            });

            const result = await response.json();
            console.log("Response data:", result); // Log data respons

            if (result.success) {
                alert("Pengguna berhasil dihapus.");
                window.location.reload(); // Refresh halaman
            } else {
                alert(result.message || "Gagal menghapus pengguna.");
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat menghapus pengguna.");
        } finally {
            submitButton.disabled = false;
            submitButton.innerHTML = "Hapus";
        }
    });
});
</script>