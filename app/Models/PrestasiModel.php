<?php

namespace App\Models;

use PDOException;

class PrestasiModel extends Model
{
    protected string $tableName = 'Achievements.prestasi';
    protected string $primaryKey = 'prestasi_id';

    // Memanfaatkan findAll dari superclass
    public function getAllPrestasi(): array
    {
        return $this->findAll();
    }

    // Memanfaatkan find dari superclass
    public function getPrestasiById(int $prestasi_id): ?array
    {
        return $this->find($prestasi_id);
    }

    // Memanfaatkan insert dari superclass
    public function addPrestasi(array $prestasiData): bool
    {
        return $this->insert($prestasiData);
    }

    // Memanfaatkan update dari superclass
    public function updatePrestasi(int $prestasiId, array $prestasiData): bool
    {
        return $this->update($prestasiId, $prestasiData);
    }

    // Memanfaatkan delete dari superclass
    public function deletePrestasi(int $prestasiId): bool
    {
        return $this->delete($prestasiId);
    }


    private function handleError(PDOException $e): void
    {
        error_log("UserModel Error: " . $e->getMessage());
        throw new \Exception("Kesalahan database");
    }
}