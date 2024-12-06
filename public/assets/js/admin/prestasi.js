// Variabel untuk menyimpan data prestasi
const prestasiData = [
    { name: "Gilang Purnomo", prodi: "Teknik Informatika", achievement: "Juara 1 Lomba Pemrograman", tingkat: "Internasional", status: "waiting" },
    { name: "Gwido Putra Wijaya", prodi: "Sistem Informasi Bisnis", achievement: "Juara 2 Lomba Data Science", tingkat: "Nasional", status: "verified" },
    { name: "Ilham Faturachman", prodi: "Teknik Mesin", achievement: "Juara 1 Hackathon Nasional", tingkat: "Nasional", status: "rejected" },
    { name: "Dina Ayu", prodi: "Desain Grafis", achievement: "Juara 3 Lomba Desain Grafis", tingkat: "Lokal", status: "waiting" },
    { name: "Budi Santoso", prodi: "Teknik Elektronika", achievement: "Juara 2 Lomba Elektronika", tingkat: "Internasional", status: "verified" },
    { name: "Rina Alfianti", prodi: "Sistem Informasi Bisnis", achievement: "Juara 1 Lomba Bisnis Digital", tingkat: "Nasional", status: "waiting" },
    { name: "Andi Pratama", prodi: "Teknik Informatika", achievement: "Juara 3 Lomba Pengembangan Aplikasi", tingkat: "Nasional", status: "verified" },
    { name: "Mira Cahyani", prodi: "Teknik Mesin", achievement: "Juara 2 Lomba Desain Otomotif", tingkat: "Lokal", status: "rejected" },
    { name: "Fahmi Rizki", prodi: "Teknik Informatika", achievement: "Juara 1 Lomba Cyber Security", tingkat: "Internasional", status: "verified" },
    { name: "Siti Fadilah", prodi: "Desain Grafis", achievement: "Juara 2 Lomba Animasi", tingkat: "Nasional", status: "waiting" },
    { name: "Ario Cahyadi", prodi: "Teknik Informatika", achievement: "Juara 1 Lomba Artificial Intelligence", tingkat: "Nasional", status: "verified" },
    { name: "Aulia Rahmawati", prodi: "Sistem Informasi Bisnis", achievement: "Juara 2 Lomba Analisis Big Data", tingkat: "Internasional", status: "waiting" },
    { name: "Ravi Putra", prodi: "Teknik Informatika", achievement: "Juara 2 Lomba Cloud Computing", tingkat: "Nasional", status: "verified" },
    { name: "Alma Dwi", prodi: "Sistem Informasi Bisnis", achievement: "Juara 3 Lomba Startup Digital", tingkat: "Lokal", status: "waiting" },
    { name: "Zakiya Fitria", prodi: "Teknik Elektronika", achievement: "Juara 1 Lomba Teknologi Robotic", tingkat: "Nasional", status: "verified" },
    { name: "Iman Setiawan", prodi: "Teknik Informatika", achievement: "Juara 2 Lomba Pengembangan Mobile Apps", tingkat: "Internasional", status: "rejected" },
    { name: "Fiona Hidayat", prodi: "Sistem Informasi Bisnis", achievement: "Juara 1 Lomba Sistem Informasi Bisnis", tingkat: "Nasional", status: "verified" },
    { name: "Edo Subrata", prodi: "Teknik Informatika", achievement: "Juara 3 Lomba Data Engineering", tingkat: "Nasional", status: "waiting" },
    { name: "Dinda Nabila", prodi: "Desain Grafis", achievement: "Juara 1 Lomba Desain UI/UX", tingkat: "Internasional", status: "verified" },
    { name: "Naufal Aditama", prodi: "Sistem Informasi Bisnis", achievement: "Juara 1 Lomba Big Data Analysis", tingkat: "Internasional", status: "waiting" },
    { name: "Benedictus Rian", prodi: "Teknik Informatika", achievement: "Juara 3 Lomba Pemrograman Java", tingkat: "Nasional", status: "verified" }
];

// Variabel lainnya
let filteredData = prestasiData;
const rowsPerPage = 5;
let currentPage = 1;
let selectedProdi = 'All'; // Default filter
let selectedTingkat = 'All'; // Default filter for tingkat
let searchQuery = ''; // Store search query

// Fungsi untuk merender tabel
function renderTable(page) {
    const startIndex = (page - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;
    const currentData = filteredData.slice(startIndex, endIndex);
    const tbody = document.getElementById('prestasiBody');
    tbody.innerHTML = '';

    // Pengecekan jika tidak ada data yang valid setelah filter/pencarian
    if (filteredData.length === 0 || currentData.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" class="text-center">Tidak ada prestasi yang ditemukan.</td></tr>';
        return;
    }

    // Jika ada data valid, tampilkan data dalam tabel
    currentData.forEach((data, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${data.name}</td>
            <td>${data.prodi}</td>
            <td>${data.achievement}</td>
            <td>${data.tingkat}</td>
            <td><span class="status ${data.status}">${data.status.charAt(0).toUpperCase() + data.status.slice(1)}</span></td>
            <td>
                <button class="btn btn-primary btn-sm" onclick="showDetails(${startIndex + index})">Detail</button>
            </td>
        `;
        tbody.appendChild(row);
    });

    renderPagination();
}

// Fungsi untuk merender tombol pagination
function renderPagination() {
    const totalPages = Math.ceil(filteredData.length / rowsPerPage);
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    // Tombol Previous
    const prevButton = document.createElement('li');
    prevButton.classList.add('page-item', currentPage === 1 ? 'disabled' : '');
    prevButton.innerHTML = `
        <a class="page-link" href="#" onclick="changePage(${currentPage - 1})">Prev</a>
    `;
    pagination.appendChild(prevButton);

    // Menampilkan nomor halaman
    const pageNumbers = [];
    const range = 2; // Menampilkan 2 halaman sebelumnya dan setelahnya
    for (let i = 1; i <= totalPages; i++) {
        if (i === 1 || i === totalPages || (i >= currentPage - range && i <= currentPage + range)) {
            pageNumbers.push(i);
        }
    }

    // Menambahkan tanda "..." jika perlu
    if (pageNumbers[0] > 1) pageNumbers.unshift('...');
    if (pageNumbers[pageNumbers.length - 1] < totalPages) pageNumbers.push('...');

    pageNumbers.forEach(page => {
        const pageItem = document.createElement('li');
        pageItem.classList.add('page-item', page === currentPage ? 'active' : '');
        pageItem.innerHTML = `
            <a class="page-link" href="#" onclick="changePage(${page})">${page}</a>
        `;
        pagination.appendChild(pageItem);
    });

    // Tombol Next
    const nextButton = document.createElement('li');
    nextButton.classList.add('page-item', currentPage === totalPages || totalPages === 0 ? 'disabled' : '');
    nextButton.innerHTML = `
        <a class="page-link" href="#" onclick="changePage(${currentPage + 1})">Next</a>
    `;
    pagination.appendChild(nextButton);
}

// Fungsi untuk mengubah halaman
function changePage(page) {
    const totalPages = Math.ceil(filteredData.length / rowsPerPage);
    if (page < 1 || page > totalPages) return; // Pastikan halaman valid
    currentPage = page;
    renderTable(currentPage);
}

// Fungsi untuk filter berdasarkan program studi
function filterByProdi(prodi) {
    selectedProdi = prodi;
    if (prodi === 'All') {
        filteredData = prestasiData;
    } else {
        filteredData = prestasiData.filter(data => data.prodi === prodi);
    }
    currentPage = 1; // Reset to first page after filter
    renderTable(currentPage);
}

// Fungsi untuk filter berdasarkan tingkat
function filterByTingkat(tingkat) {
    selectedTingkat = tingkat;
    if (tingkat === 'All') {
        filteredData = prestasiData;
    } else {
        filteredData = prestasiData.filter(data => data.tingkat === tingkat);
    }
    currentPage = 1; // Reset to first page after filter
    renderTable(currentPage);
}

// Fungsi untuk filter berdasarkan pencarian
function searchTable() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    filteredData = prestasiData.filter(data =>
        data.name.toLowerCase().includes(searchTerm) ||
        data.prodi.toLowerCase().includes(searchTerm) ||
        data.achievement.toLowerCase().includes(searchTerm) ||
        data.tingkat.toLowerCase().includes(searchTerm)
    );
    currentPage = 1; // Reset to first page after search
    renderTable(currentPage);
}

// Initial rendering of the table
renderTable(currentPage);

// Fungsi untuk menyimpan data di localStorage dan membuka modal
function showDetails(index) {
    const prestasi = filteredData[index]; // Ambil data prestasi dari tabel
    
    // Menyimpan data prestasi ke localStorage
    localStorage.setItem('selectedPrestasi', JSON.stringify(prestasi));
    
    // Arahkan ke halaman modal (modal.html)
    window.location.href = '/presma_pbl/resources/views/component/admin/modalDetailPres.php'; 
}
