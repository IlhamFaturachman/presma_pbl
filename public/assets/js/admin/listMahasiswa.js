// Konfigurasi paginasi
const rowsPerPage = 10;
let currentPage = 1;
let allMahasiswa = [];

// Render tabel
function renderTable(data) {
    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;
    const paginatedData = data.slice(startIndex, endIndex);

    // Kosongkan tbody
    $('#mahasiswaBody').empty();

    if (paginatedData.length === 0) {
        $('#mahasiswaBody').append('<tr><td colspan="8" class="text-center">Tidak ada mahasiswa yang ditemukan.</td></tr>');
        return;
    }

    // Isi data ke tabel
    paginatedData.forEach(mahasiswa => {
        const trimmedEmail = mahasiswa.email.length > 10
            ? mahasiswa.email.substring(0, 17) + '...'
            : mahasiswa.email;

        $('#mahasiswaBody').append(`
            <tr>
                <td>${mahasiswa.nim}</td>
                <td>${mahasiswa.nama}</td>
                <td title="${mahasiswa.email}">${trimmedEmail}</td>
                <td>${mahasiswa.phone}</td>
                <td>${mahasiswa.angkatan}</td>
                <td>${mahasiswa.kelas}</td>
                <td>${mahasiswa.nama_prodi}</td>
                <td>
                    <button class="btn btn-sm btn-warning editMahasiswa" data-mahasiswa-nim="${mahasiswa.nim}">
                        <i class="bi bi-pencil"></i> Edit
                    </button>
                    <button class="btn btn-sm btn-danger deleteMahasiswa" data-mahasiswa-nim="${mahasiswa.nim}">
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
    const totalPages = Math.ceil(allMahasiswa.length / rowsPerPage);

    if (page >= 1 && page <= totalPages) {
        currentPage = page;
        renderTable(allMahasiswa);
        renderPagination(allMahasiswa.length);
    }
});

// Fitur pencarian
$('#searchInput').on('keyup', function () {
    const value = $(this).val().toLowerCase();
    const filteredMahasiswa = allMahasiswa.filter(mahasiswa =>
        mahasiswa.nama.toLowerCase().includes(value)
    );

    currentPage = 1; // Reset ke halaman pertama
    renderTable(filteredMahasiswa);
    renderPagination(filteredMahasiswa.length);
});

// Event delegation untuk tombol Edit
$(document).on('click', '.editMahasiswa', async function () {
    const nim = $(this).data('mahasiswa-nim');
    if (!nim) {
        console.error('NIM tidak ditemukan!');
        return;
    }

    // Buka modal edit pengguna
    $('#editMahasiswaModal').modal('show');

    try {
        // Ambil data pengguna berdasarkan ID
        const response = await fetch(`/presma_pbl/public/admin/mahasiswa/${nim}`);
        if (!response.ok) throw new Error('Gagal memuat data Mahasiswa');
        const mhsData = await response.json();

        // Isi form dengan data pengguna
        $('#edit-nim').val(mhsData.nim);
        $('#edit-nama').val(mhsData.nama);
        $('#edit-email').val(mhsData.email);
        $('#edit-phone').val(mhsData.phone);
        $('#edit-angkatan').val(mhsData.angkatan);
        $('#edit-kelas').val(mhsData.kelas);
        $('#edit-prodi').val(mhsData.prodi);

        // Load prodi
        const prodiResponse = await fetch('/presma_pbl/public/admin/program-studi');
        if (!prodiResponse.ok) throw new Error('Gagal memuat Program Studi');
        const prodi = await prodiResponse.json();

        const prodiSelect = $('#edit-prodi');
        prodiSelect.empty();
        prodiSelect.append('<option value="" disabled>Pilih Prodi</option>');
        prodi.forEach(prodi => {
            const option = `<option value="${prodi.prodi_id}" ${prodi.prodi_id === mhsData.prodi_id ? 'selected' : ''}>${prodi.nama_prodi}</option>`;
            prodiSelect.append(option);
        });
    } catch (error) {
        console.error(error);
        alert('Terjadi kesalahan saat memuat data pengguna.');
    }
});

// Event delegation untuk tombol Hapus
$(document).on('click', '.deleteMahasiswa', function () {
    const nim = $(this).data('mahasiswa-nim');
    if (!nim) {
        console.error('NIM tidak ditemukan!');
        return;
    }

    // Buka modal konfirmasi hapus
    $('#deleteMahasiswaModal').modal('show');
    $('#confirmDelete').data('mahasiswa-nim', nim);
});

// Konfirmasi Hapus
$(document).on('click', '#confirmDelete', async function () {
    const nim = $(this).data('mahasiswa-nim');
    if (!nim) {
        console.error('NIM tidak ditemukan!');
        return;
    }

    try {
        const response = await fetch(`/presma_pbl/public/admin/mahasiswa/${nim}`, {
            method: 'DELETE'
        });
        if (!response.ok) throw new Error('Gagal menghapus mahasiswa');
        alert('Mahasiswa berhasil dihapus!');
        location.reload();
    } catch (error) {
        console.error(error);
        alert('Terjadi kesalahan saat menghapus mahasiswa.');
    }
});

// Load data dari PHP saat halaman dimuat
$(document).ready(function () {
    allMahasiswa = window.allMahasiswa || []; // Ambil data dari PHP
    renderTable(allMahasiswa);
    renderPagination(allMahasiswa.length);
});
