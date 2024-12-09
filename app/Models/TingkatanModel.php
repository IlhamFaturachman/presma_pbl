<?php

namespace App\Models;

use PDO;
use PDOException;

class TingkatanModel extends Model
{
    protected string $tableName = 'Achievements.tingkatan';
    protected string $primaryKey = 'tingkatan_id';

    public function getTingkatanById(int $tingkatanId): ?array
    {
        return $this->find($tingkatanId);
    }

    public function getAllTingkatan(): array
    {
        return $this->findAll();
    }

    public function addTingkatan(array $tingkatanData): bool
    {
        return $this->insert($tingkatanData);
    }

    public function updateTingkatan(int $tingkatanId, array $tingkatanData): bool
    {
        return $this->update($tingkatanId, $tingkatanData);
    }

    public function deleteTingkatan(int $tingkatanId): bool
    {
        return $this->delete($tingkatanId);
    }

    private function handleError(PDOException $e): void
    {
        error_log("TingkatanModel Error: " . $e->getMessage());
        throw new \Exception("Kesalahan database");
    }
}
