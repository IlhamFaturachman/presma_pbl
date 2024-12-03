<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/admin/dashboard.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/header.css">
    <link rel="stylesheet" href="/presma_pbl/public/assets/css/sidebar.css">
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="logo">
            <img src="https://via.placeholder.com/40" alt="Logo JTI">
            <h4>JTI</h4>
        </div>
        <div class="profile">
            <span>Hallo, Admin</span>
            <img src="https://via.placeholder.com/40" alt="Profile">
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cog"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Pengaturan Akun</a></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div id="sidebar">
        <div class="menu-header" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i> <span>MENU</span>
        </div>
        <ul>
            <li><a href="#" class="active"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li><a href="#"><i class="fas fa-user-tie"></i> <span>Dosen</span></a></li>
            <li><a href="#"><i class="fas fa-users"></i> <span>Mahasiswa</span></a></li>
            <li><a href="#"><i class="fas fa-trophy"></i> <span>Prestasi</span></a></li>
            <li><a href="#"><i class="fas fa-ranking-star"></i> <span>Peringkat</span></a></li>
            <li><a href="#"><i class="fas fa-file-alt"></i> <span>Laporan</span></a></li>
        </ul>
    </div>

    <!-- Content -->
    <div id="content">
        <div class="content-row">
            <div class="card">
                <div class="chart-title">Total Data Prestasi</div>
                <canvas id="donutChart"></canvas>
            </div>
            <div class="card">
                <div class="chart-title">Prestasi per Bulan</div>
                <canvas id="barChart"></canvas>
            </div>
        </div>
        <div class="card wide">
            <div class="chart-title">Pertumbuhan Mahasiswa</div>
            <canvas id="pertumbuhanMahasiswa"></canvas>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const sidebar = document.getElementById('sidebar');
    const toggleButton = document.querySelector('.menu-header i');

    toggleButton.addEventListener('click', () => {
        sidebar.classList.toggle('minimized');
    });

    // Example Chart.js setup
    const donutCtx = document.getElementById('donutChart').getContext('2d');
    const barCtx = document.getElementById('barChart').getContext('2d');
    const lineCtx = document.getElementById('pertumbuhanMahasiswa').getContext('2d');

    new Chart(donutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Mahasiswa', 'Prestasi'],
            datasets: [{
                data: [75, 25],
                backgroundColor: ['#3498db', '#2ecc71']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        }
    });

    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                data: [100, 200, 150, 250, 300, 400],
                backgroundColor: '#e74c3c'
            }]
        }
    });

    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                data: [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160],
                borderColor: '#e74c3c',
                backgroundColor: 'transparent'
            }]
        }
    });
    </script>
</body>

</html>