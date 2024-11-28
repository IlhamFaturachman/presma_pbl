<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    /* General Styling */
    body, html {
      margin: 0;
      padding: 0;
      font-family: 'Arial', sans-serif;
      background-color: #f4f6f9;
      height: 100%;
      overflow: hidden;
    }

    /* Header Styling */
    .header {
      width: 100%;
      height: 60px;
      background-color: #00509d;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
      color: white;
      position: fixed;
      top: 0;
      z-index: 1000;
    }

    .header .logo {
      display: flex;
      align-items: center;
    }

    .header .logo img {
      height: 40px;
      margin-right: 10px;
    }

    .header .profile {
      display: flex;
      align-items: center;
    }

    .header .profile img {
      border-radius: 50%;
      width: 40px;
      height: 40px;
    }

    .header .profile .dropdown {
      margin-left: 10px;
    }

    /* Sidebar Styling */
    #sidebar {
      width: 250px;
      height: 100vh;
      background-color: #002855;
      position: fixed;
      top: 60px; /* Start after header */
      left: 0;
      color: white;
      display: flex;
      flex-direction: column;
      transition: all 0.3s;
      z-index: 999;
    }

    #sidebar.minimized {
      width: 80px;
    }

    #sidebar .menu-header {
      text-align: left;
      padding: 15px 20px;
      font-size: 16px;
      font-weight: bold;
      display: flex;
      align-items: center;
      cursor: pointer;
    }

    #sidebar ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    #sidebar ul li {
      width: 100%;
    }

    #sidebar ul li a {
      display: flex;
      align-items: center;
      padding: 12px 20px;
      color: white;
      text-decoration: none;
      transition: all 0.3s;
    }

    #sidebar ul li a i {
      margin-right: 10px;
    }

    #sidebar.minimized ul li a span {
      display: none;
    }

    #sidebar ul li a:hover,
    #sidebar ul li a.active {
      background-color: #00509d;
      border-left: 4px solid #ffc107;
    }

    /* Content Styling */
    #content {
      margin-top: 60px; /* Avoid header overlap */
      margin-left: 250px;
      padding: 20px;
      transition: margin-left 0.3s;
      display: flex;
      flex-direction: column;
      gap: 20px;
      height: calc(100vh - 60px);
    }

    #sidebar.minimized ~ #content {
      margin-left: 80px;
    }

    .content-row {
      display: flex;
      gap: 20px;
    }

    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 20px;
      flex: 1;
    }

    .wide {
      flex: 2; /* Spans across two cards */
    }

    .chart-title {
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 15px;
    }

    /* Styling Pertumbuhan Mahasiswa Chart */
    #pertumbuhanMahasiswa {
      height: 250px; /* Adjust height of growth chart */
    }

    /* Styling Donut Chart */
    #donutChart {
      width: 100%;
      max-height: 200px; /* Make donut chart smaller */
    }

    /* Responsive Adjustments */
    @media screen and (max-width: 768px) {
      #sidebar {
        width: 60px;
      }

      #content {
        margin-left: 60px;
      }

      .content-row {
        flex-direction: column;
      }

      .card {
        flex: 1 1 100%;
      }

      #sidebar.minimized .menu-header span {
        display: none;
      }
    }
  </style>
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
        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
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
