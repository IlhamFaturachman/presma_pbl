// Konfigurasi paginasi
const rowsPerPage = 10;
let currentPage = 1;
let allRankings = window.allRank || [];

// Fungsi untuk merender tabel
function renderTable(data) {
    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;
    const paginatedData = data.slice(startIndex, endIndex);

    // Kosongkan tbody
    const tbody = document.querySelector('#rankingBody');
    tbody.innerHTML = '';

    if (paginatedData.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="text-center">Tidak ada data ranking yang ditemukan.</td></tr>';
        return;
    }

    // Isi data ke tabel
    paginatedData.forEach((ranking, index) => {
        // Hitung peringkat sebenarnya berdasarkan indeks halaman
        const actualRank = index + 1 + startIndex;

        // Tentukan badge untuk peringkat 1-3
        const rankBadge = actualRank <= 3
            ? ['🥇', '🥈', '🥉'][actualRank - 1] // Ambil ikon sesuai peringkat
            : actualRank; // Selain juara 1-3, tampilkan nomor peringkat

        // Tambahkan baris ke tabel
        const row = `
            <tr>
                <td>${rankBadge}</td>
                <td>${ranking.nama_mahasiswa}</td>
                <td>${ranking.program_studi}</td>
                <td>${ranking.jumlah_prestasi}</td>
                <td>${ranking.total_points}</td>
                <td>
                    <button class="btn btn-sm btn-info detailRanking" data-nim="${ranking.nim}">
                        <i class="bi bi-info-circle"></i> Detail
                    </button>
                </td>
            </tr>
        `;
        tbody.insertAdjacentHTML('beforeend', row);
    });

}

// Fungsi untuk merender pagination
function renderPagination(totalItems) {
    const totalPages = Math.ceil(totalItems / rowsPerPage);
    const pagination = document.querySelector('#pagination');
    pagination.innerHTML = '';

    // Tombol Previous
    const prevDisabled = currentPage === 1 ? 'disabled' : '';
    pagination.insertAdjacentHTML(
        'beforeend',
        `<li class="page-item ${prevDisabled}">
            <a class="page-link" href="#" data-page="${currentPage - 1}">Prev</a>
        </li>`
    );

    // Tombol nomor halaman
    for (let i = 1; i <= totalPages; i++) {
        const activeClass = i === currentPage ? 'active' : '';
        pagination.insertAdjacentHTML(
            'beforeend',
            `<li class="page-item ${activeClass}">
                <a class="page-link" href="#" data-page="${i}">${i}</a>
            </li>`
        );
    }

    // Tombol Next
    const nextDisabled = currentPage === totalPages ? 'disabled' : '';
    pagination.insertAdjacentHTML(
        'beforeend',
        `<li class="page-item ${nextDisabled}">
            <a class="page-link" href="#" data-page="${currentPage + 1}">Next</a>
        </li>`
    );
}

// Fungsi untuk mengubah halaman
document.addEventListener('click', function (e) {
    if (e.target.closest('.page-link')) {
        e.preventDefault();
        const page = parseInt(e.target.closest('.page-link').dataset.page, 10);
        const totalPages = Math.ceil(allRankings.length / rowsPerPage);

        if (page >= 1 && page <= totalPages) {
            currentPage = page;
            renderTable(allRankings);
            renderPagination(allRankings.length);
        }
    }
});

// Fitur pencarian
const searchInput = document.querySelector('#searchInput');
searchInput.addEventListener('keyup', function () {
    const value = this.value.toLowerCase();
    const filteredRankings = allRankings.filter(ranking =>
        ranking.name.toLowerCase().includes(value) ||
        ranking.program.toLowerCase().includes(value) ||
        ranking.nim.toLowerCase().includes(value)
    );

    currentPage = 1; // Reset ke halaman pertama
    renderTable(filteredRankings);
    renderPagination(filteredRankings.length);
});

// Event delegation untuk tombol Detail
document.addEventListener('click', function (e) {
    if (e.target.closest('.detailRanking')) {
        const nim = e.target.closest('.detailRanking').dataset.nim;
        if (!nim) {
            console.error('NIM tidak ditemukan!');
            return;
        }

        // Tampilkan detail berdasarkan NIM
        alert(`Menampilkan detail untuk NIM: ${nim}`);
    }
});

// Load data saat halaman dimuat
document.addEventListener('DOMContentLoaded', function () {
    renderTable(allRankings);
    renderPagination(allRankings.length);
});
