<?php

namespace App\Models;

use PDO;
use PDOException;

class DosenModel extends Model
{
    protected string $tableName = 'UserManagement.dosen';
    protected string $prodiTableName = 'UserManagement.ProgramStudi';

    protected string $primaryKey = 'nip';

    public function getAllDosen(): array
    {
        $sql = "
            SELECT 
                dosen.nip, 
                dosen.nama, 
                dosen.email, 
                dosen.phone, 
                prodi.nama_prodi AS nama_prodi
            FROM {$this->tableName} AS dosen
            INNER JOIN {$this->prodiTableName} AS prodi
            ON dosen.prodi_id = prodi.prodi_id
        ";
        return $this->query($sql); // Gunakan metode query() dari superclass
    }

    public function getDosenByNip(int $nip): array
    {
        return $this->find($nip);
    }

    public function addDosen(array $dsnData): bool
    {
        return $this->insert($dsnData);
    }

    public function updateDosen(int $dsnNip, array $dsnData): bool
    {
        return $this->update($dsnNip, $dsnData);
    }

    public function deleteDosen(int $dsnNip): bool
    {
        return $this->delete($dsnNip);
    }

    private function handleError(PDOException $e): void
    {
        error_log("DosenModel Error: " . $e->getMessage());
        throw new \Exception("Kesalahan database");
    }
}