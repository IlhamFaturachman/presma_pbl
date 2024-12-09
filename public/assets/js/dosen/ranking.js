// Variabel untuk menyimpan data ranking
const rankings = [
    { rank: '🥇', name: 'Gilang Purnomo', program: 'Teknik Informatika', achievements: 20, points: 750 },
    { rank: '🥈', name: 'Gwido Putra Wijaya', program: 'Sistem Informasi Bisnis', achievements: 17, points: 520 },
    { rank: '🥉', name: 'Ilham Faturachman', program: 'Sistem Informasi Bisnis', achievements: 15, points: 505 },
    { rank: '4', name: 'Najwa Alya Nurizah', program: 'Teknik Informatika', achievements: 10, points: 500 },
    { rank: '5', name: 'Sesy Tana Lina R', program: 'Teknik Informatika', achievements: 10, points: 500 },
    { rank: '6', name: 'Dika Arie Arifky', program: 'Teknik Informatika', achievements: 8, points: 480 },
    { rank: '7', name: 'Alvanza Saputra Y', program: 'Teknik Informatika', achievements: 9, points: 470 },
    { rank: '8', name: 'M. Fatih Al Ghifary', program: 'Teknik Informatika', achievements: 5, points: 430 },
    { rank: '9', name: 'Jiha Ramadhan', program: 'Teknik Informatika', achievements: 5, points: 430 },
    { rank: '10', name: 'Aulia Rizky Pratama', program: 'Sistem Informasi', achievements: 4, points: 400 },
    { rank: '11', name: 'Reza Fahlevi', program: 'Teknik Informatika', achievements: 4, points: 380 },
    { rank: '12', name: 'Raka Dwi Santoso', program: 'Sistem Informasi Bisnis', achievements: 3, points: 370 },
    { rank: '13', name: 'Rani Alivia', program: 'Sistem Informasi', achievements: 3, points: 360 },
    { rank: '14', name: 'Budi Santoso', program: 'Teknik Informatika', achievements: 2, points: 350 },
    { rank: '15', name: 'Dina Aulia', program: 'Teknik Informatika', achievements: 2, points: 340 }
];

// Variabel lainnya
const rowsPerPage = 10;
let currentPage = 1;
let selectedProdi = 'All'; // Default filter
let searchQuery = ''; // Store search query

// Fungsi untuk merender tabel
function renderTable() {
    // Filter rankings berdasarkan selectedProdi dan searchQuery
    const filteredRankings = rankings.filter(ranking => {
        const matchesProdi = selectedProdi === 'All' || ranking.program === selectedProdi;
        const matchesSearch = ranking.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
                              ranking.program.toLowerCase().includes(searchQuery.toLowerCase());
        return matchesProdi && matchesSearch;
    });

    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;
    const paginatedRankings = filteredRankings.slice(startIndex, endIndex);

    // Kosongkan body tabel sebelumnya
    $('#rankingBody').empty();

    // Masukkan data yang sudah difilter dan dipaginasi ke dalam body tabel
    if (paginatedRankings.length > 0) {
        paginatedRankings.forEach(ranking => {
            $('#rankingBody').append(`
                <tr>
                    <td>${ranking.rank}</td>
                    <td>${ranking.name}</td>
                    <td>${ranking.program}</td>
                    <td>${ranking.achievements}</td>
                    <td>${ranking.points}</td>
                </tr>
            `);
        });
    } else {
        // Jika tidak ada hasil, tampilkan pesan
        $('#rankingBody').append(`<tr><td colspan="5" class="text-center">No data found for the selected filter.</td></tr>`);
    }

    // Render pagination
    renderPagination(filteredRankings);
}

// Fungsi untuk merender tombol pagination
function renderPagination(filteredRankings) {
    const totalPages = Math.ceil(filteredRankings.length / rowsPerPage);
    $('#pagination').empty();

    // Tombol Previous
    $('#pagination').append(`<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                                <a class="page-link" href="#" onclick="changePage(${currentPage - 1})">Prev</a>
                              </li>`);

    // Tombol nomor halaman
    for (let i = 1; i <= totalPages; i++) {
        $('#pagination').append(`<li class="page-item ${i === currentPage ? 'active' : ''}">
                                    <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
                                  </li>`);
    }

    // Tombol Next
    $('#pagination').append(`<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                                <a class="page-link" href="#" onclick="changePage(${currentPage + 1})">Next</a>
                              </li>`);
}

// Fungsi untuk mengubah halaman
function changePage(page) {
    if (page < 1 || page > Math.ceil(rankings.length / rowsPerPage)) return;
    currentPage = page;
    renderTable();
}

// Fungsi untuk filter berdasarkan program studi
function filterByProdi(prodi) {
    selectedProdi = prodi;
    currentPage = 1; // Reset ke halaman pertama saat filter berubah
    renderTable();

    // Tutup dropdown setelah memilih opsi
    $('.dropdown-menu').removeClass('show');
    $('.dropdown-image').removeClass('open');
}

// Fungsi untuk filter berdasarkan pencarian
$('#searchInput').on('keyup', function() {
    searchQuery = $(this).val(); // Menyimpan query pencarian
    currentPage = 1; // Reset ke halaman pertama saat pencarian berubah
    renderTable();
});

// Event klik pada tombol dropdown
$('#dropdownProdiButton').on('click', function(e) {
    e.stopPropagation(); // Mencegah klik menyebar ke elemen lain
    
    const dropdownMenu = $(this).next('.dropdown-menu'); // Menemukan elemen dropdown menu
    const dropdownImage = $(this).children('.dropdown-image'); // Menemukan elemen gambar dropdown

    // Toggle visibilitas dropdown
    dropdownMenu.toggleClass('show'); // Menambahkan/menyembunyikan kelas .show

    // Toggle rotasi gambar ikon dropdown
    dropdownImage.toggleClass('open');
});

// Klik di luar dropdown untuk menutup dropdown
$(document).on('click', function(e) {
    if (!$(e.target).closest('.dropdown-container').length) {
        // Jika klik di luar dropdown, sembunyikan menu
        $('.dropdown-menu').removeClass('show');
        $('.dropdown-image').removeClass('open');
    }
});

// Render awal tabel
renderTable();
