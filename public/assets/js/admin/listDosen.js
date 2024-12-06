// Konfigurasi paginasi
const rowsPerPage = 10;
let currentPage = 1;
let allDosen = [];

// Render tabel
function renderTable(data) {
    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;
    const paginatedData = data.slice(startIndex, endIndex);

    // Kosongkan tbody
    $('#dosenBody').empty();

    if (paginatedData.length === 0) {
        $('#dosenBody').append('<tr><td colspan="6" class="text-center">Tidak ada dosen yang ditemukan.</td></tr>');
        return;
    }

    // Isi data ke tabel
    paginatedData.forEach(dosen => {
        const trimmedEmail = dosen.email.length > 10
            ? dosen.email.substring(0, 17) + '...'
            : dosen.email;

        $('#dosenBody').append(`
            <tr>
                <td>${dosen.nip}</td>
                <td>${dosen.nama}</td>
                <td title="${dosen.email}">${trimmedEmail}</td>
                <td>${dosen.phone}</td>
                <td>${dosen.nama_prodi}</td>
                <td>
                    <button class="btn btn-sm btn-warning editDosen" data-dosen-nip="${dosen.nip}">
                        <i class="bi bi-pencil"></i> Edit
                    </button>
                    <button class="btn btn-sm btn-danger deleteDosen" data-dosen-nip="${dosen.nip}">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </td>
            </tr>
        `);
    });
}

// Render paginasi
function renderPagination(totalItems) {
    const totalPages = Math.ceil(totalItems / rowsPerPage);
    $('#pagination').empty();

    // Tombol Previous
    $('#pagination').append(`
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="${currentPage - 1}">Prev</a>
        </li>
    `);

    // Tombol nomor halaman
    for (let i = 1; i <= totalPages; i++) {
        $('#pagination').append(`
            <li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="#" data-page="${i}">${i}</a>
            </li>
        `);
    }

    // Tombol Next
    $('#pagination').append(`
        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="${currentPage + 1}">Next</a>
        </li>
    `);
}

// Ubah halaman
$(document).on('click', '#pagination .page-link', function (e) {
    e.preventDefault();
    const page = parseInt($(this).data('page'));
    const totalPages = Math.ceil(allDosen.length / rowsPerPage);

    if (page >= 1 && page <= totalPages) {
        currentPage = page;
        renderTable(allDosen);
        renderPagination(allDosen.length);
    }
});

// Fitur pencarian
$('#searchInput').on('keyup', function () {
    const value = $(this).val().toLowerCase();
    const filteredDosen = allDosen.filter(dosen =>
        dosen.nama.toLowerCase().includes(value)
    );

    currentPage = 1; // Reset ke halaman pertama
    renderTable(filteredDosen);
    renderPagination(filteredDosen.length);
});

// Event delegation untuk tombol Edit
$(document).on('click', '.editDosen', async function () {
    const nip = $(this).data('dosen-nip');
    if (!nip) {
        console.error('NIP tidak ditemukan!');
        return;
    }

    // Buka modal edit pengguna
    $('#editDosenModal').modal('show');

    try {
        // Ambil data pengguna berdasarkan ID
        const response = await fetch(`/presma_pbl/public/admin/dosen/${nip}`);
        if (!response.ok) throw new Error('Gagal memuat data Mahasiswa');
        const dsnData = await response.json();

        // Isi form dengan data pengguna
        $('#edit-nim').val(dsnData.nim);
        $('#edit-nama').val(dsnData.nama);
        $('#edit-email').val(dsnData.email);
        $('#edit-phone').val(dsnData.phone);
        $('#edit-prodi').val(dsnData.prodi);

        // Load prodi
        const prodiResponse = await fetch('/presma_pbl/public/admin/program-studi');
        if (!prodiResponse.ok) throw new Error('Gagal memuat Program Studi');
        const prodi = await prodiResponse.json();

        const prodiSelect = $('#edit-prodi');
        prodiSelect.empty();
        prodiSelect.append('<option value="" disabled>Pilih Prodi</option>');
        prodi.forEach(prodi => {
            const option = `<option value="${prodi.prodi_id}" ${prodi.prodi_id === dsnData.prodi_id ? 'selected' : ''}>${prodi.nama_prodi}</option>`;
            prodiSelect.append(option);
        });
    } catch (error) {
        console.error(error);
        alert('Terjadi kesalahan saat memuat data pengguna.');
    }
});

// Event delegation untuk tombol Hapus
$(document).on('click', '.deleteDosen', function () {
    const nip = $(this).data('dosen-nip');
    if (!nip) {
        console.error('NIP tidak ditemukan!');
        return;
    }

    // Buka modal konfirmasi hapus
    $('#deleteDosenModal').modal('show');
    $('#confirmDelete').data('dosen-nip', nip);
});

// Konfirmasi Hapus
$(document).on('click', '#confirmDelete', async function () {
    const nip = $(this).data('dosen-nip');
    if (!nip) {
        console.error('NIP tidak ditemukan!');
        return;
    }

    try {
        const response = await fetch(`/presma_pbl/public/admin/dosen/${nip}`, {
            method: 'DELETE'
        });
        if (!response.ok) throw new Error('Gagal menghapus Dosen');
        alert('Dosen berhasil dihapus!');
        location.reload();
    } catch (error) {
        console.error(error);
        alert('Terjadi kesalahan saat menghapus Dosen.');
    }
});

// Load data dari PHP saat halaman dimuat
$(document).ready(function () {
    allDosen = window.allDosen || []; // Ambil data dari PHP
    renderTable(allDosen);
    renderPagination(allDosen.length);
});
