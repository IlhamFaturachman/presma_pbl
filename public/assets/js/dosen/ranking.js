// Placeholder for pagination functionality (can be extended later)
$(document).ready(function() {
    // For search functionality
    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#rankingTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Pagination could be dynamically generated if needed (depends on your use case)
});

       // Data for ranking
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

    // Variables
    const rowsPerPage = 10;
    let currentPage = 1;

    // Function to render rankings
    function renderTable() {
        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;
        const paginatedRankings = rankings.slice(startIndex, endIndex);

        // Clear current table body
        $('#rankingBody').empty();

        // Insert paginated data into the table body
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

        // Render pagination
        renderPagination();
    }

    // Function to render pagination buttons
    function renderPagination() {
        const totalPages = Math.ceil(rankings.length / rowsPerPage);
        $('#pagination').empty();

        // Previous button
        $('#pagination').append(`<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                                    <a class="page-link" href="#" onclick="changePage(${currentPage - 1})">Prev</a>
                                  </li>`);

        // Page number buttons
        for (let i = 1; i <= totalPages; i++) {
            $('#pagination').append(`<li class="page-item ${i === currentPage ? 'active' : ''}">
                                        <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
                                      </li>`);
        }

        // Next button
        $('#pagination').append(`<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                                    <a class="page-link" href="#" onclick="changePage(${currentPage + 1})">Next</a>
                                  </li>`);
    }

    // Function to change page
    function changePage(page) {
        if (page < 1 || page > Math.ceil(rankings.length / rowsPerPage)) return;
        currentPage = page;
        renderTable();
    }

    // Initial rendering
    renderTable();

