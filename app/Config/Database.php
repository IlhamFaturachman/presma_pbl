<?php

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private ?PDO $connection = null;

    public function getConnection(): PDO
    {
        if ($this->connection === null) {
            // Ambil nilai dari .env
            $host = 'LAPTOP-KGRDEANA'; // Nama server SQL Server Ilham
            // $host = 'LAPTOP-7ODSNK1P'; // Nama server SQL Server Gilang
            $dbName = 'Presma'; // Nama database

            // DSN untuk koneksi SQL Server
            $dsn = "sqlsrv:Server={$host};Database={$dbName}";

            // Opsi tambahan untuk Windows Authentication
            $options = [
                PDO::SQLSRV_ATTR_DIRECT_QUERY => true,
            ];

            try {
                // Membuat koneksi PDO
                $this->connection = new PDO($dsn, null, null, $options);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        return $this->connection;
    }
}