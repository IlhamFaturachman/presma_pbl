<div class="modal fade" id="deleteDosenModal" tabindex="-1" aria-labelledby="deleteDosenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteDosenModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p>Apakah Anda yakin ingin menghapus dosen ini?</p>
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
    let nipToDelete = null;

    // Tampilkan modal konfirmasi
    document.querySelectorAll(".deleteDosenModal").forEach(button => {
        button.addEventListener("click", (e) => {
            nipToDelete = e.currentTarget.dataset
                .nip; // Menggunakan e.currentTarget untuk mendapatkan elemen yang benar
            console.log("NIP to delete:",
                nipToDelete); // Log untuk memastikan ID diambil dengan benar
            const deleteDosenModal = new bootstrap.Modal(document.getElementById(
                "deleteDosenModal"));
            deleteDosenModal.show();
        });
    });

    // Konfirmasi hapus
    document.getElementById("confirmDelete").addEventListener("click", async () => {
        console.log("Hapus button clicked"); // Log ketika tombol diklik
        console.log("NIP to delete:", nipToDelete); // Log ID pengguna yang akan dihapus
        if (!nipToDelete) return;

        const submitButton = document.getElementById("confirmDelete");
        submitButton.disabled = true;
        submitButton.innerHTML =
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menghapus...`;

        try {
            const response = await fetch(`/presma_pbl/public/admin/dosen/${nipToDelete}`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                },
            });

            const result = await response.json();
            console.log("Response data:", result); // Log data respons

            if (result.success) {
                alert("dosen berhasil dihapus.");
                window.location.reload(); // Refresh halaman
            } else {
                alert(result.message || "Gagal menghapus dosen.");
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat menghapus dosen.");
        } finally {
            submitButton.disabled = false;
            submitButton.innerHTML = "Hapus";
        }
    });
});
</script>