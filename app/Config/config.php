<?php
$serverName = "LAPTOP-KGRDEANA"; // Nama server SQL Server, bisa juga menggunakan IP
$connectionOptions = [
    "Database" => "Presma", // Sesuaikan dengan nama database Anda
    "UID" => "", // Kosongkan untuk Windows Authentication
    "PWD" => "", // Kosongkan untuk Windows Authentication
    "Authentication" => "ActiveDirectoryIntegrated", // Opsi untuk Windows Authentication
    "TrustServerCertificate" => true,
];

try {
    $conn = new PDO("sqlsrv:Server=$serverName;Database=" . $connectionOptions['Database'], "", "", $connectionOptions);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}