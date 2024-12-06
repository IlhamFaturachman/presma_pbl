// Data for ranking
const rankings = [
    { rank: '🥇', name: 'Gilang Purnomo', program: 'Teknik Informatika', achievements: 20, points: 750 },
    { rank: '🥈', name: 'Gwido Putra Wijaya', program: 'Sistem Informasi Bisnis', achievements: 17, points: 520 },
    { rank: '🥉', name: 'Ilham Faturachman', program: 'Sistem Informasi Bisnis', achievements: 15, points: 505 }
];

// Function to render rankings
function renderTable() {
    // Clear current table body
    $('#rankingBody').empty();

    // Insert all data into the table body (without pagination)
    rankings.forEach(ranking => {
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
}

// Initial rendering
renderTable();
