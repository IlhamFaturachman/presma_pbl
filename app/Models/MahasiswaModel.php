<?php

namespace App\Models;

use PDO;
use PDOException;

class MahasiswaModel extends Model
{
    protected string $tableName = 'UserManagement.mahasiswa';
    protected string $primaryKey = 'nim';

    public function getAllMahasiswa(): array
    {
        return $this->findAll();
    }

    public function getMahasiswaByNim(int $nim): array
    {
        return $this->find($nim);
    }

    public function addMahasiswa(array $userData): bool
    {
        return $this->insert($userData);
    }

    public function updateMahasiswa(int $mhsNim, array $userData): bool
    {
        return $this->update($mhsNim, $userData);
    }

    public function deleteMahasiswa(int $mhsNim): bool
    {
        return $this->delete($mhsNim);
    }

    private function handleError(PDOException $e): void
    {
        error_log("MahasiswaModel Error: " . $e->getMessage());
        throw new \Exception("Kesalahan database");
    }
}
