<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;

abstract class Model
{
    protected string $tableName = ''; // Nama tabel (harus diatur oleh model turunan)
    protected string $primaryKey = 'id'; // Primary key default
    private PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getDbConnection(): PDO
    {
        return $this->db;
    }

    // Fungsi untuk mendapatkan semua data
    public function findAll(): array
    {
        try {
            $query = "SELECT * FROM {$this->tableName}";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return []; // Return default value jika terjadi error
    }

    // Fungsi untuk mendapatkan satu data berdasarkan primary key
    public function find(int $id): ?array
    {
        try {
            $query = "SELECT * FROM {$this->tableName} WHERE {$this->primaryKey} = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return null; // Return default value jika terjadi error
    }

    // Fungsi untuk menambahkan data
    public function insert(array $data): bool
    {
        try {
            $columns = implode(", ", array_keys($data));
            $placeholders = implode(", ", array_map(fn($key) => ":$key", array_keys($data)));

            $query = "INSERT INTO {$this->tableName} ($columns) VALUES ($placeholders)";
            $stmt = $this->db->prepare($query);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            return $stmt->execute();
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return false; // Return default value jika terjadi error
    }

    // Fungsi untuk memperbarui data berdasarkan primary key
    public function update(int $id, array $data): bool
    {
        try {
            $setClause = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));

            $query = "UPDATE {$this->tableName} SET $setClause WHERE {$this->primaryKey} = :id";
            $stmt = $this->db->prepare($query);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return false; // Return default value jika terjadi error
    }

    // Fungsi untuk menghapus data berdasarkan primary key
    public function delete(int $id): bool
    {
        try {
            $query = "DELETE FROM {$this->tableName} WHERE {$this->primaryKey} = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return false; // Return default value jika terjadi error
    }

    // Fungsi untuk menjalankan query manual
    public function query(string $sql, array $params = []): array
    {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error untuk debugging
            error_log("SQL Error: " . $e->getMessage());
            error_log("Query: " . $sql);
            error_log("Params: " . json_encode($params));
            $this->handleError($e);
        }
        return []; // Return default value jika terjadi error
    }

    // Fungsi untuk menangani error
    private function handleError(PDOException $e): void
    {
        error_log("Database Error: " . $e->getMessage()); // Log error
        throw new \Exception("Terjadi kesalahan pada database. Silakan coba lagi."); // Jangan tampilkan error mentah ke pengguna
    }
}