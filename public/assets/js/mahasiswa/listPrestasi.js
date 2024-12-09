// Konfigurasi paginasi
const rowsPerPage = 10;
let currentPage = 1;
let allPrestasi = [];

// Render tabel
function renderTable(data) {
    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;
    const paginatedData = data.slice(startIndex, endIndex);

    // Kosongkan tbody
    $('#prestasiBody').empty();

    if (paginatedData.length === 0) {
        $('#prestasiBody').append('<tr><td colspan="6" class="text-center">Tidak ada prestasi yang ditemukan.</td></tr>');
        return;
    }

    // Isi data ke tabel
    paginatedData.forEach(prestasi => {
        let actionButtons = '';
        const trimmedNamaLomba = prestasi.nama_lomba.length > 8
            ? prestasi.nama_lomba.substring(0, 14) + '...'
            : prestasi.nama_lomba;

            if (prestasi.validasi_status === 'Tervalidasi') {
                actionButtons = `
                <button class="btn btn-sm btn-primary action-button detailPrestasi" style="font-size: 15px;" data-prestasi-id="${prestasi.PrestasiID}">
                    <i class="bi bi-eye"></i> Detail
                </button>
                `;
            } else if (prestasi.validasi_status === 'Ditolak') {
                actionButtons = `
                <button class="btn btn-sm btn-danger action-button infoDitolak" style="font-size: 15px;" data-prestasi-id="${prestasi.PrestasiID}">
                    <i class="bi bi-exclamation-circle"></i> Info Ditolak
                </button>
                `;
            } else if (prestasi.validasi_status === 'Menunggu divalidasi') {
                actionButtons = `
                <div class="btn-group w-100" role="group" aria-label="Tombol Aksi">
                    <button class="btn btn-sm btn-warning action-button d-flex justify-content-center align-items-center" style="font-size: 15px;" data-prestasi-id="${prestasi.PrestasiID}">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-sm btn-primary action-button d-flex justify-content-center align-items-center" style="font-size: 15px;" data-prestasi-id="${prestasi.PrestasiID}">
                        <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-danger action-button d-flex justify-content-center align-items-center" style="font-size: 15px;" data-prestasi-id="${prestasi.PrestasiID}">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                `;
            }            

        if (prestasi.validasi_status === 'Tervalidasi') {
            statusBadge = '<span class="badge bg-success" style="font-size: 12px; padding: 8px 10px; color: #fff;">Tervalidasi</span>';
        } else if (prestasi.validasi_status === 'Ditolak') {
            statusBadge = '<span class="badge bg-danger" style="font-size: 12px; padding: 8px 10px; color: #fff;">Ditolak</span>';
        } else if (prestasi.validasi_status === 'Menunggu divalidasi') {
            statusBadge = '<span class="badge bg-warning" style="font-size: 12px; padding: 8px 10px; color: #fff;">Menunggu divalidasi</span>';
        }

        $('#prestasiBody').append(`
            <tr>
                <td tittle="${prestasi.nama_lomba}">${trimmedNamaLomba}</td>
                <td>${prestasi.Peringkat}</td>
                <td>${prestasi.Tingkat}</td>
                <td>${prestasi.NamaDosen}</td>
                <td class="text-center">${statusBadge}</td> <!-- Badge status -->
                <td>
                    ${actionButtons}
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
    const totalPages = Math.ceil(allPrestasi.length / rowsPerPage);

    if (page >= 1 && page <= totalPages) {
        currentPage = page;
        renderTable(allPrestasi);
        renderPagination(allPrestasi.length);
    }
});

// Fitur pencarian
$('#searchInput').on('keyup', function () {
    const value = $(this).val().toLowerCase();
    const filteredPrestasi = allPrestasi.filter(prestasi =>
        prestasi.nama_lomba.toLowerCase().includes(value)
    );

    currentPage = 1; // Reset ke halaman pertama
    renderTable(filteredPrestasi);
    renderPagination(filteredPrestasi.length);
});

// Event delegation untuk tombol Edit
$(document).on('click', '.editPrestasi', async function () {
    const prestasi = $(this).data('mahasiswa-prestasi');
    if (!prestasi) {
        console.error('Prestasi tidak ditemukan!');
        return;
    }

    // Buka modal edit pengguna
    $('#editPrestasiModal').modal('show');

    try {
        // Ambil data pengguna berdasarkan ID
        const response = await fetch(`/presma_pbl/public/mahasiswa/prestasi/${nim}`);
        if (!response.ok) throw new Error('Gagal memuat data Prestasi');
        const prsData = await response.json();

        // Isi form dengan data pengguna
        $('#edit-nim').val(prsData.nim);
        $('#edit-nama').val(prsData.nama);
        $('#edit-email').val(prsData.email);
        $('#edit-phone').val(prsData.phone);
        $('#edit-angkatan').val(prsData.angkatan);
        $('#edit-kelas').val(prsData.kelas);
        $('#edit-prodi').val(prsData.prodi);

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
    allPrestasi = window.allPrestasi || []; // Ambil data dari PHP
    renderTable(allPrestasi);
    renderPagination(allPrestasi.length);
});

// Fungsi untuk filter berdasarkan tingkat
function filterByTingkat(tingkat) {
    let filteredPrestasi = [];

    if (tingkat === 'All') {
        filteredPrestasi = allPrestasi; // Tampilkan semua data
    } else {
        filteredPrestasi = allPrestasi.filter(prestasi => prestasi.Tingkat === tingkat);
    }

    currentPage = 1; // Reset ke halaman pertama
    renderTable(filteredPrestasi);
    renderPagination(filteredPrestasi.length);
}

// Menambahkan event listener untuk dropdown
$(document).on('click', '.dropdown-item', function () {
    const tingkat = $(this).text(); // Ambil teks dari item yang dipilih
    filterByTingkat(tingkat); // Panggil fungsi filter
});
