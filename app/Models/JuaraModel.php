<?php

namespace App\Models;

use PDO;
use PDOException;

class JuaraModel extends Model
{
    protected string $tableName = 'Achievements.juara';
    protected string $primaryKey = 'juara_id';

    public function getJuaraById(int $juaraId): ?array
    {
        return $this->find($juaraId);
    }

    public function getAllJuara(): array
    {
        return $this->findAll();
    }

    public function addJuara(array $juaraData): bool
    {
        return $this->insert($juaraData);
    }

    public function updateJuara(int $juaraId, array $juaraData): bool
    {
        return $this->update($juaraId, $juaraData);
    }

    public function deleteJuara(int $juaraId): bool
    {
        return $this->delete($juaraId);
    }

    private function handleError(PDOException $e): void
    {
        error_log("JuaraModel Error: " . $e->getMessage());
        throw new \Exception("Kesalahan database");
    }
}
