<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil informasi pengguna dari sesi
$userId = $_SESSION['user']['id'];
$userName = $_SESSION['user']['name'];
$userRole = $_SESSION['user']['role'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa - Dashboard</title>
</head>

<body>
    <h1>Ini adalah Dashboard Mahasiswa puny gwido</h1>
    <p>Selamat datang, <?php echo htmlspecialchars($userName); ?>!</p>
    <p>Role Anda: Mahasiswa</p>
</body>

</html>