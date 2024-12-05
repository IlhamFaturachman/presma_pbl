<?php

namespace App\Models;

use PDO;
use PDOException;

class MahasiswaModel extends Model
{
    protected string $tableName = 'UserManagement.mahasiswa';
    protected string $primaryKey = 'nim';

    public function getAllUsers(): array
    {
        return $this->findAll();
    }

    public function getUserByNIM(int $nim): array
    {
        return $this->find($nim);
    }

    public function addUser(array $userData): bool
    {
        return $this->insert($userData);
    }

    public function updateUser(int $mhsNim, array $userData): bool
    {
        return $this->update($mhsNim, $userData);
    }

    public function deleteUser(int $mhsNim): bool
    {
        return $this->delete($mhsNim);
    }

    private function handleError(PDOException $e): void
    {
        error_log("MahasiswaModel Error: " . $e->getMessage());
        throw new \Exception("Kesalahan database");
    }
}