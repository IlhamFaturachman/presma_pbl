document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("searchInput");
    const rankingBody = document.getElementById("rankingBody");
    const pagination = document.getElementById("pagination");

    // Data Mockup
    const data = [
        { lomba: "Lomba Menembak", juara: "Juara 1", pembimbing: "Ir. Gilang S.T., M.T", tingkat: "Nasional", status: "Menunggu Validasi" },
        { lomba: "XXL Freshman Cypher", juara: "Juara Harapan 3", pembimbing: "Ir. Gilang S.T., M.T", tingkat: "Nasional", status: "Terverifikasi" },
        { lomba: "Complexcon Best Suite", juara: "Juara 2", pembimbing: "Ir. Gilang S.T., M.T", tingkat: "Internasional", status: "Ditolak" },
        { lomba: "Hackathon 2024", juara: "Juara 3", pembimbing: "Dr. Taufiq R.", tingkat: "Internasional", status: "Terverifikasi" },
        { lomba: "Essay Competition", juara: "Juara Harapan 1", pembimbing: "Dr. Taufiq R.", tingkat: "Nasional", status: "Menunggu Validasi" },
        { lomba: "Startup Expo", juara: "Juara 2", pembimbing: "Dr. Taufiq R.", tingkat: "Nasional", status: "Terverifikasi" },
    ];

    const rowsPerPage = 10;
    let currentPage = 1;
    let totalRows = data.length;
    let totalPages = Math.ceil(totalRows / rowsPerPage);

    // Render Table Rows
    function renderRows(page = 1) {
        rankingBody.innerHTML = "";

        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        const visibleRows = data.slice(start, end);

        visibleRows.forEach((item, index) => {
            const globalIndex = start + index; // ID global
            const statusClass =
                item.status === "Menunggu Validasi" ? "badge bg-warning" :
                item.status === "Terverifikasi" ? "badge bg-success" :
                item.status === "Ditolak" ? "badge bg-danger" : "badge bg-secondary";

            rankingBody.innerHTML += `
                <tr>
                    <td>${item.lomba}</td>
                    <td>${item.juara}</td>
                    <td>${item.pembimbing}</td>
                    <td>${item.tingkat}</td>
                    <td><span class="${statusClass}">${item.status}</span></td>
                    <td>
                        <button class="btn btn-primary detail-btn" data-id="${globalIndex}">Detail</button>
                    </td>
                </tr>`;
        });
    }

    // Render Pagination
    function renderPagination() {
        pagination.innerHTML = "";

        // Previous Button
        pagination.innerHTML += `
            <li class="${currentPage === 1 ? "disabled" : ""}">
                <a href="#" data-page="${currentPage - 1}">Prev</a>
            </li>`;

        // Page Numbers
        for (let i = 1; i <= totalPages; i++) {
            pagination.innerHTML += `
                <li class="${currentPage === i ? "active" : ""}">
                    <a href="#" data-page="${i}">${i}</a>
                </li>`;
        }

        // Next Button
        pagination.innerHTML += `
            <li class="${currentPage === totalPages ? "disabled" : ""}">
                <a href="#" data-page="${currentPage + 1}">Next</a>
            </li>`;
    }

    // Update Table and Pagination
    function updateTable(page) {
        currentPage = page;
        renderRows(page);
        renderPagination();
    }

    // Search Functionality
    searchInput.addEventListener("input", () => {
        const searchTerm = searchInput.value.toLowerCase();

        const filteredData = data.filter(item => {
            return Object.values(item).some(value => 
                String(value).toLowerCase().includes(searchTerm)
            );
        });

        totalRows = filteredData.length;
        totalPages = Math.ceil(totalRows / rowsPerPage);
        updateTable(1); // Reset to first page
    });

    // Handle Pagination Click
    pagination.addEventListener("click", (e) => {
        e.preventDefault();
        const target = e.target;

        if (target.tagName === "A") {
            const page = parseInt(target.dataset.page, 10);

            if (!isNaN(page) && page >= 1 && page <= totalPages) {
                updateTable(page);
            }
        }
    });

    document.body.addEventListener("click", (event) => {
        if (event.target.classList.contains("detail-btn")) {
            const modal = new bootstrap.Modal(document.getElementById("detailModal"));
            const modalContent = document.getElementById("modalContent");

            // Tambahkan indikator loading
            modalContent.innerHTML = "<p>Memuat...</p>";

            // Dapatkan ID prestasi dari atribut tombol
            const prestasiId = event.target.dataset.id;

            // Tampilkan modal
            modal.show();

            // Fetch data untuk modal
            fetch(`/presma_pbl/resources/views/component/dosen/modalDetailPres.php?id=${prestasiId}`)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.text();
                })
                .then((data) => {
                    modalContent.innerHTML = data;
                })
                .catch((error) => {
                    modalContent.innerHTML = `<p class="text-danger">Gagal memuat data.</p>`;
                    console.error(error);
                });
        }
    });

    // Initial Render
    updateTable(currentPage);
});