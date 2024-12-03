// Grafik Donut
const donutCtx = document.getElementById('donutChart').getContext('2d');
new Chart(donutCtx, {
    type: 'doughnut',
    data: {
        labels: ['Mahasiswa', 'Prestasi'],
        datasets: [{
            label: 'Persentase Data',
            data: [75, 25],
            backgroundColor: ['#3498db', '#2ecc71'],
            hoverBackgroundColor: ['#2980b9', '#27ae60']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top', // Letak legenda
            },
        },
    }
});

// Grafik Bar
const barCtx = document.getElementById('barChart').getContext('2d');
new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Prestasi per Bulan',
            data: [100, 200, 150, 250, 300, 400],
            backgroundColor: '#e74c3c',
            hoverBackgroundColor: '#c0392b'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'top',
            },
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Bulan'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Jumlah Prestasi'
                }
            }
        }
    }
});

// Grafik Line
const lineCtx = document.getElementById('pertumbuhanMahasiswa').getContext('2d');
new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Pertumbuhan Mahasiswa',
            data: [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160],
            borderColor: '#e74c3c',
            backgroundColor: 'rgba(231, 76, 60, 0.2)',
            tension: 0.4, // Kurva halus
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'top',
            },
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Bulan'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Jumlah Mahasiswa'
                }
            }
        }
    }
});
