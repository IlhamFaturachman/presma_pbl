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
        // Isi data ke tabel
    paginatedData.forEach(prestasi => {
        let actionButtons = '';
        const trimmedNamaLomba = prestasi.nama_lomba.length > 8
            ? prestasi.nama_lomba.substring(0, 14) + '...'
            : prestasi.nama_lomba;

        if (prestasi.validasi_status === 'Tervalidasi') {
            actionButtons = `
                <button class="btn btn-sm btn-primary action-button detailPrestasi" 
                    style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="#detailModal" data-prestasi-id="${prestasi.PrestasiID || ''}">
                    <i class="bi bi-eye"></i> Detail
                </button>
        `;
        } else if (prestasi.validasi_status === 'Ditolak') {
            actionButtons = `
            <div class="btn-group w-90" role="group" aria-label="Tombol Aksi">
                <button class="btn btn-sm btn-danger action-button infoDitolak" 
                    style="font-size: 14px;" data-prestasi-id="${prestasi.PrestasiID || ''}">
                    <i class="bi bi-exclamation-circle"></i> Info Ditolak
                </button>
            </div>
        `;
        } else if (prestasi.validasi_status === 'Menunggu divalidasi') {
            actionButtons = `
            <div class="btn-group w-90" role="group" aria-label="Tombol Aksi">
                <button class="btn btn-sm btn-primary action-button validasiPrestasi" 
                    style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="#validasiModal" data-prestasi-id="${prestasi.PrestasiID || ''}">
                    <i class="bi bi-eye"></i> Detail
                </button>
            </div>
        `;
        }

        let statusBadge = '';
        if (prestasi.validasi_status === 'Tervalidasi') {
            statusBadge = '<span class="badge bg-success" style="font-size: 12px; padding: 8px 10px; color: #fff;">Tervalidasi</span>';
        } else if (prestasi.validasi_status === 'Ditolak') {
            statusBadge = '<span class="badge bg-danger" style="font-size: 12px; padding: 8px 10px; color: #fff;">Ditolak</span>';
        } else if (prestasi.validasi_status === 'Menunggu divalidasi') {
            statusBadge = '<span class="badge bg-warning" style="font-size: 12px; padding: 8px 10px; color: #fff;">Menunggu divalidasi</span>';
        }

        $('#prestasiBody').append(`
            <tr>
                <td title="${prestasi.nama_lomba}">${trimmedNamaLomba}</td>
                <td>${prestasi.Peringkat}</td>
                <td>${prestasi.Tingkat}</td>
                <td>${prestasi.NamaDosen}</td>
                <td class="text-center">${statusBadge}</td>
                <td>
                    ${actionButtons}
                </td>
            </tr>
        `);
    });
}


$('#filterStatus').on('change', function () {
    const status = $(this).val();
    if (status === 'all') {
        filteredPrestasi = allPrestasi;
    } else {
        filteredPrestasi = allPrestasi.filter(prestasi => prestasi.validasi_status === status);
    }
    currentPage = 1;
    renderTable(filteredPrestasi);
    renderPagination(filteredPrestasi.length);
});

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

$(document).on('click', '.detailPrestasi', function () {
    const prestasiId = $(this).data('prestasi-id'); // Dapatkan ID dari tombol

    // Panggil endpoint untuk mendapatkan data detail
    $.ajax({
        url: `/presma_pbl/public/mahasiswa/prestasi/${prestasiId}`,
        method: 'GET',
        success: function (response) {
            if (response) {
                populateDetailModal(response);
                $('#detailModal').modal('show'); // Tampilkan modal detail
            } else {
                alert('Data tidak ditemukan.');
            }
        },
        error: function () {
            alert('Terjadi kesalahan saat mengambil data.');
        }
    });
});

function populateDetailModal(prestasi) {
    $('#modalNamaMahasiswa').text(prestasi.NamaMahasiswa || '-');
    $('#modalNIMMahasiswa').text(prestasi.NIM || '-');
    $('#modalNamaDosen').text(prestasi.NamaDosen || '-');
    $('#modalNamaLomba').text(prestasi.nama_lomba || '-');
    $('#modalPeringkat').text(prestasi.Peringkat || '-');
    $('#modalTingkat').text(prestasi.Tingkat || '-');
    $('#modalWaktuMulaiLomba').text(prestasi.waktu_mulai_lomba || '-');
    $('#modalWaktuSelesaiLomba').text(prestasi.waktu_selesai_lomba || '-');
    $('#modalKategoriLomba').text(prestasi.kategori_lomba || '-');
    $('#modalPenyelenggara').text(prestasi.penyelenggara || '-');
    $('#modalTotalPoint').text(prestasi.total_point || '-');
    $('#modalValidasiStatus').text(prestasi.validasi_status || '-');
    $('#modalInfoValidasi').text(prestasi.info_validasi || 'Tidak ada informasi');

    // File atau gambar
    $('#modalFotoLomba').attr('src', prestasi.foto_lomba || '#').toggle(!!prestasi.foto_lomba);
    $('#modalFlyerLomba').attr('src', prestasi.flyer_lomba || '#').toggle(!!prestasi.flyer_lomba);
    $('#modalSertifikat').attr('src', prestasi.sertifikat || '#').toggle(!!prestasi.sertifikat);
    $('#modalIdeProposal').attr('href', prestasi.ide_proposal || '#').toggle(!!prestasi.ide_proposal);
    $('#modalSuratTugas').attr('href', prestasi.surat_tugas || '#').toggle(!!prestasi.surat_tugas);
}


// Load data dari PHP saat halaman dimuat
$(document).ready(function () {
    allPrestasi = window.allPrestasi || [];
    filteredPrestasi = allPrestasi;
    renderTable(filteredPrestasi);
    renderPagination(filteredPrestasi.length);
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

// Saat halaman dimuat, inisialisasi data dan render tabel
$(document).ready(function () {
    allPrestasi = window.allPrestasi || [];
    renderTable(allPrestasi);
    renderPagination(allPrestasi.length);

    // Event listener untuk filter tingkat
    $('#filterTingkat').on('change', function () {
        const tingkat = $(this).val(); // Ambil tingkat yang dipilih
        filterByTingkat(tingkat); // Terapkan filter
    });
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
