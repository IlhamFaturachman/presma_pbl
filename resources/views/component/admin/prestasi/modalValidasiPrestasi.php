<div class="modal fade" id="validasiModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Prestasi Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Detail Information -->
                <div class="row g-4">
                    <div class="col-md-12 mb-3">
                        <input type="text" id="modalNamaMahasiswa" class="form-control" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">NIM</label>
                        <p id="modalNIMMahasiswa" class="form-control-plaintext">-</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Dosen Pembimbing</label>
                        <p id="modalNamaDosen" class="form-control-plaintext">-</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lomba</label>
                        <p id="modalNamaLomba" class="form-control-plaintext">-</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori Lomba</label>
                        <p id="modalKategoriLomba" class="form-control-plaintext">-</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Peringkat</label>
                        <p id="modalPeringkat" class="form-control-plaintext">-</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tingkat</label>
                        <p id="modalTingkat" class="form-control-plaintext">-</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Penyelenggara</label>
                        <p id="modalPenyelenggara" class="form-control-plaintext">-</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Waktu Mulai Lomba</label>
                        <p id="modalWaktuMulaiLomba" class="form-control-plaintext">-</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Waktu Selesai Lomba</label>
                        <p id="modalWaktuSelesaiLomba" class="form-control-plaintext">-</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status Validasi</label>
                        <p id="modalValidasiStatus" class="form-control-plaintext">-</p>
                    </div>
                </div>

                <!-- Dokumen dan File -->
                <div class="row g-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Foto Lomba</label>
                        <div class="upload-box">
                            <a id="modalFotoLombaLink" class="btn btn-outline-primary" style="display: none;"
                                target="_blank">Lihat Dokumen</a>
                            <img id="modalFotoLombaImg" alt="Foto Lomba" class="img-fluid"
                                style="max-width: 100%; display: none;" onclick="openImageModal(this.src)" />
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sertifikat</label>
                        <div class="upload-box">
                            <a id="modalSertifikatLink" class="btn btn-outline-primary" style="display: none;"
                                target="_blank">Lihat Dokumen</a>
                            <img id="modalSertifikatImg" alt="Sertifikat" class="img-fluid"
                                style="max-width: 100%; display: none;" onclick="openImageModal(this.src)" />
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Flyer Lomba</label>
                        <div class="upload-box">
                            <a id="modalFlyerLombaLink" class="btn btn-outline-primary" style="display: none;"
                                target="_blank">Lihat Dokumen</a>
                            <img id="modalFlyerLombaImg" alt="Flyer Lomba" class="img-fluid"
                                style="max-width: 100%; display: none;" onclick="openImageModal(this.src)" />
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Surat Tugas</label>
                        <div class="upload-box">
                            <a id="modalSuratTugasLink" class="btn btn-outline-primary" style="display: none;"
                                target="_blank">Lihat Dokumen</a>
                            <img id="modalSuratTugasImg" alt="Surat Tugas" class="img-fluid"
                                style="max-width: 100%; display: none;" onclick="openImageModal(this.src)" />
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ide Proposal</label>
                        <div class="upload-box">
                            <a id="modalIdeProposalLink" class="btn btn-outline-primary" style="display: none;"
                                target="_blank">Lihat Dokumen</a>
                            <img id="modalIdeProposalImg" alt="Ide Proposal" class="img-fluid"
                                style="max-width: 100%; display: none;" onclick="openImageModal(this.src)" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex w-100 justify-content-between align-items-center">
                    <div class="row text-start">
                        <p style="font-size: 20px;">TOTAL POINT PRESTASI INI</p>
                        <p id="modalTotalPoint" class="fw-bold" style="font-size: 30px;"></p>
                    </div>
                    <div>
                        <button id="btnReject" class="btn btn-danger" style="width: 150px;">TOLAK</button>
                        <button id="btnValidate" class="btn btn-success" style="width: 150px;">VALIDASI</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmTitle">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="confirmForm">
                    <div class="mb-3">
                        <label for="reasonInput" class="form-label">Alasan</label>
                        <textarea id="reasonInput" class="form-control" rows="3"
                            placeholder="Masukkan alasan"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button id="confirmAction" type="button" class="btn btn-primary">Kirim</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('validasiModal').addEventListener('show.bs.modal', async (event) => {
        const button = event.relatedTarget;
        const prestasiId = button.getAttribute('data-prestasi-id');
        const modal = document.getElementById('validasiModal');

        try {
            const response = await fetch(`/presma_pbl/public/admin/prestasi/${prestasiId}`);
            const data = await response.json();

            // Populate modal fields
            modal.querySelector("#modalNamaMahasiswa").value = data.NamaMahasiswa || "-";
            modal.querySelector("#modalNIMMahasiswa").textContent = data.NIM || "-";
            modal.querySelector("#modalNamaDosen").textContent = data.NamaDosen || "-";
            modal.querySelector("#modalNamaLomba").textContent = data.nama_lomba || "-";
            modal.querySelector("#modalKategoriLomba").textContent = data.kategori_lomba || "-";
            modal.querySelector("#modalPeringkat").textContent = data.Peringkat || "-";
            modal.querySelector("#modalTingkat").textContent = data.Tingkat || "-";
            modal.querySelector("#modalPenyelenggara").textContent = data.penyelenggara || "-";
            modal.querySelector("#modalWaktuMulaiLomba").textContent = data.waktu_mulai_lomba || "-";
            modal.querySelector("#modalWaktuSelesaiLomba").textContent = data.waktu_selesai_lomba || "-";
            modal.querySelector("#modalTotalPoint").textContent = data.total_point || "-";
            modal.querySelector("#modalValidasiStatus").textContent = data.validasi_status || "-";

            // Helper function to handle images and links with PDF icons
            const setFile = (linkSelector, imgSelector, fileUrl) => {
                const linkElement = modal.querySelector(linkSelector);
                const imgElement = modal.querySelector(imgSelector);

                if (fileUrl) {
                    if (fileUrl.endsWith('.pdf')) {
                        linkElement.href = fileUrl;
                        linkElement.style.display = 'inline-block';
                        imgElement.style.display = 'none';
                    } else {
                        imgElement.src = fileUrl;
                        imgElement.style.display = 'block';
                        linkElement.style.display = 'none';
                    }
                } else {
                    linkElement.style.display = 'none';
                    imgElement.style.display = 'none';
                }
            };

            // Set images and links for uploaded files
            setFile("#modalFotoLombaLink", "#modalFotoLombaImg", data.foto_lomba, data.foto_lomba && data
                .foto_lomba.endsWith(".pdf"));
            setFile("#modalSertifikatLink", "#modalSertifikatImg", data.sertifikat, data.sertifikat && data
                .sertifikat.endsWith(".pdf"));
            setFile("#modalFlyerLombaLink", "#modalFlyerLombaImg", data.flyer_lomba, data.flyer_lomba && data
                .flyer_lomba.endsWith(".pdf"));
            setFile("#modalSuratTugasLink", "#modalSuratTugasImg", data.surat_tugas, data.surat_tugas && data
                .surat_tugas.endsWith(".pdf"));
            setFile("#modalIdeProposalLink", "#modalIdeProposalImg", data.ide_proposal, data.ide_proposal &&
                data
                .ide_proposal.endsWith(".pdf"));

        } catch (error) {
            console.error("Error loading modal data:", error);
        }
    });

    function openImageModal(src) {
        const imgWindow = window.open("", "_blank");
        imgWindow.document.write(`<img src="${src}" style="width: 70%;">`);
    }
    const validasiModal = document.getElementById('validasiModal');
    const confirmModal = document.getElementById('confirmModal');
    const confirmTitle = confirmModal.querySelector('#confirmTitle');
    const confirmAction = confirmModal.querySelector('#confirmAction');
    let actionType = null;
    let prestasiId = null;

    validasiModal.addEventListener('show.bs.modal', (event) => {
        const button = event.relatedTarget;
        prestasiId = button.getAttribute('data-prestasi-id');
    });

    document.getElementById('btnReject').addEventListener('click', () => {
        actionType = 'reject';
        confirmTitle.textContent = 'Tolak Prestasi';
        new bootstrap.Modal(confirmModal).show();
    });

    document.getElementById('btnValidate').addEventListener('click', () => {
        actionType = 'validate';
        confirmTitle.textContent = 'Validasi Prestasi';
        new bootstrap.Modal(confirmModal).show();
    });

    confirmAction.addEventListener('click', async () => {
        const reason = document.getElementById('reasonInput').value.trim();

        // Validasi jika alasan kosong
        if (!reason) {
            alert("Alasan harus diisi.");
            return;
        }

        // Konversi ID prestasi jika perlu
        if (typeof prestasiId === 'string') {
            prestasiId = parseInt(prestasiId, 10);
            if (isNaN(prestasiId)) {
                alert('ID prestasi tidak valid.');
                return;
            }
        }

        // Pilih endpoint berdasarkan tipe aksi
        const endpoint = actionType === 'validate' ?
            `/presma_pbl/public/admin/validasi-prestasi/${prestasiId}` :
            `/presma_pbl/public/admin/reject-prestasi/${prestasiId}`;

        try {
            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    info_validasi: reason
                })
            });

            if (response.ok) {
                const result = await response.json();
                if (result.success) {
                    alert(`${actionType === 'validate' ? 'Validasi' : 'Penolakan'} berhasil!`);
                    location.reload(); // Refresh page
                } else {
                    alert(`Gagal: ${result.message}`);
                }
            } else {
                const error = await response.json();
                alert(`Error ${response.status}: ${error.message || 'Terjadi kesalahan pada server.'}`);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan pada server.');
        }
    });



    // validasiModal.addEventListener('hide.bs.modal', () => {
    //     actionType = null;
    //     prestasiId = null; // Reset prestasiId
    // });
</script>