// Event listener untuk tombol "Detail" pada setiap baris tabel
function showDetail(rank) {
    // Cari data ranking berdasarkan rank
    const ranking = rankings.find(item => item.rank === rank);
    
    if (ranking) {
        // Menampilkan data mahasiswa di dalam modal
        $('#modal-name').text(ranking.name);
        $('#modal-nim').text(ranking.rank); // Anda bisa ganti jika ada data NIM
        $('#modal-program').text(ranking.program);
        $('#modal-prestasi').text(ranking.achievements);
        $('#modal-poin').text(ranking.points);

        // Menampilkan prestasi mahasiswa pada tabel di modal
        const achievements = [
            { name: 'Lomba A', year: '2023', level: 'Nasional', rank: '1', points: 100 },
            { name: 'Lomba B', year: '2023', level: 'Internasional', rank: '2', points: 80 }
        ]; // Ganti dengan data asli dari database

        let achievementsHtml = '';
        achievements.forEach((achievement, index) => {
            achievementsHtml += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${achievement.name}</td>
                    <td>${achievement.year}</td>
                    <td>${achievement.level}</td>
                    <td>${achievement.rank}</td>
                    <td>${achievement.points}</td>
                </tr>
            `;
        });

        $('#achievements-tbody').html(achievementsHtml);
        
        // Menampilkan modal
        $('#detailModal').modal('show');
    }
}

// Event handler untuk menutup modal jika klik di luar modal
$(document).on('click', function (e) {
    if (!$(e.target).closest('#detailModal').length) {
        $('#detailModal').modal('hide');
    }
});

// export to excel
function exportToExcel() {
    const table = document.getElementById('achievements-table');
    const rows = table.getElementsByTagName('tr');

    // Data untuk bagian identitas mahasiswa
    const identityData = [
        ['Nama Mahasiswa', document.getElementById('modal-name').textContent.trim()],
        ['NIM', document.getElementById('modal-nim').textContent.trim()],
        ['Program Studi', document.getElementById('modal-program').textContent.trim()],
        ['Jumlah Prestasi', document.getElementById('modal-prestasi').textContent.trim()],
        ['Total Poin', document.getElementById('modal-poin').textContent.trim()],
        [''] // Row kosong sebagai pemisah antara identitas dan prestasi
    ];

    // Data untuk bagian prestasi mahasiswa
    const achievementsData = [
        ['Nama Lomba', 'Tahun', 'Tingkat', 'Peringkat', 'Link Sertifikat']  // Header untuk prestasi
    ];

    // Ambil data prestasi mahasiswa dan masukkan ke array achievementsData
    for (let i = 1; i < rows.length; i++) { // Mulai dari baris kedua untuk melewati header
        const cells = rows[i].getElementsByTagName('td');
        let rowContent = [
            cells[1].textContent.trim(),  // Nama Lomba
            cells[2].textContent.trim(),  // Tahun
            cells[3].textContent.trim(),  // Tingkat
            cells[4].textContent.trim(),  // Peringkat
            cells[5].textContent.trim()   // Link Sertifikat
        ];
        achievementsData.push(rowContent);
    }

    // Gabungkan identitas dan prestasi dalam satu array
    const combinedData = identityData.concat(achievementsData);

    // Membuat workbook (buku Excel) dan menambahkan data
    const wb = XLSX.utils.book_new();

    // Mengonversi data gabungan menjadi sheet Excel
    const sheet = XLSX.utils.aoa_to_sheet(combinedData);

    // Menambahkan sheet ke workbook
    XLSX.utils.book_append_sheet(wb, sheet, 'Peringkat Mahasiswa');

    // Mendapatkan nama file berdasarkan nama mahasiswa dan program studi
    const studentName = document.getElementById('modal-name').textContent.trim();
    const program = document.getElementById('modal-program').textContent.trim();
    const fileName = `Data Prestasi ${studentName}_${program}.xlsx`;

    // Menyimpan file Excel
    XLSX.writeFile(wb, fileName);
}

// Event listener untuk tombol Export
$(document).ready(function() {
    $('#exportButton').on('click', function() {
        exportToExcel();
    });
});
