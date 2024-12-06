
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
    { name: "Siti Fadilah", prodi: "Desain Grafis", achievement: "Juara 2 Lomba Animasi", tingkat: "Nasional", status: "waiting" }
];

let filteredData = prestasiData;
const rowsPerPage = 5;
let currentPage = 1;

function renderTable(page) {
    const startIndex = (page - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;
    const currentData = filteredData.slice(startIndex, endIndex);
    const tbody = document.getElementById('prestasiBody');
    tbody.innerHTML = '';

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

function renderPagination() {
    const totalPages = Math.ceil(filteredData.length / rowsPerPage);
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    const prevButton = document.createElement('li');
    prevButton.classList.add('page-item', currentPage === 1 ? 'disabled' : '');
    prevButton.innerHTML = `
        <a class="page-link" href="#" aria-label="Previous" onclick="changePage(${currentPage - 1})">
            <span aria-hidden="true">&laquo;</span>
        </a>`;
    pagination.appendChild(prevButton);

    const pageNumbers = [];
    const range = 2;
    for (let i = 1; i <= totalPages; i++) {
        if (i === 1 || i === totalPages || (i >= currentPage - range && i <= currentPage + range)) {
            pageNumbers.push(i);
        }
    }

    if (pageNumbers[0] > 1) {
        pageNumbers.unshift('...');
    }
    if (pageNumbers[pageNumbers.length - 1] < totalPages) {
        pageNumbers.push('...');
    }

    pageNumbers.forEach(page => {
        const pageItem = document.createElement('li');
        pageItem.classList.add('page-item', page === currentPage ? 'active' : '');
        pageItem.innerHTML = `
            <a class="page-link" href="#" onclick="changePage(${page})">${page}</a>
        `;
        pagination.appendChild(pageItem);
    });

    const nextButton = document.createElement('li');
    nextButton.classList.add('page-item', currentPage === totalPages ? 'disabled' : '');
    nextButton.innerHTML = `
        <a class="page-link" href="#" aria-label="Next" onclick="changePage(${currentPage + 1})">
            <span aria-hidden="true">&raquo;</span>
        </a>`;
    pagination.appendChild(nextButton);
}

function changePage(page) {
    if (page < 1 || page > Math.ceil(filteredData.length / rowsPerPage)) {
        return;
    }
    currentPage = page;
    renderTable(currentPage);
}

function showDetails(index) {
    // Show modal content from external modal file
    fetch('detailModal.html')
        .then(response => response.text())
        .then(content => {
            const modalBody = document.querySelector('#modalBody');
            modalBody.innerHTML = content;
            const modal = new bootstrap.Modal(document.getElementById('detailModal'));
            modal.show();
        });
}

function searchTable() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    filteredData = prestasiData.filter(data => 
        data.name.toLowerCase().includes(searchTerm) ||
        data.prodi.toLowerCase().includes(searchTerm) ||
        data.achievement.toLowerCase().includes(searchTerm) ||
        data.tingkat.toLowerCase().includes(searchTerm)
    );
    currentPage = 1;
    renderTable(currentPage);
}

function filterByProdi(prodi) {
    if (prodi === 'All') {
        filteredData = prestasiData;
    } else {
        filteredData = prestasiData.filter(data => data.prodi === prodi);
    }
    currentPage = 1;
    renderTable(currentPage);
}

function filterByTingkat(tingkat) {
    if (tingkat === 'All') {
        filteredData = prestasiData;
    } else {
        filteredData = prestasiData.filter(data => data.tingkat === tingkat);
    }
    currentPage = 1;
    renderTable(currentPage);
}

// Initial rendering of the table
renderTable(currentPage);
