<?php

namespace App\Models;

use PDO;
use PDOException;

class MahasiswaModel extends Model
{
    protected string $tableName = 'UserManagement.mahasiswa';
    protected string $prodiTableName = 'UserManagement.ProgramStudi';

    protected string $primaryKey = 'nim';

    public function getAllMahasiswa(): array
    {
        $sql = "
            SELECT 
                mahasiswa.nim, 
                mahasiswa.nama, 
                mahasiswa.email, 
                mahasiswa.phone, 
                mahasiswa.angkatan, 
                mahasiswa.kelas, 
                prodi.nama_prodi AS nama_prodi
            FROM {$this->tableName} AS mahasiswa
            INNER JOIN {$this->prodiTableName} AS prodi
            ON mahasiswa.prodi_id = prodi.prodi_id
        ";
        return $this->query($sql); // Gunakan metode query() dari superclass
    }


    public function getMahasiswaByNim(int $nim): array
    {
        return $this->find($nim);
    }

    public function addMahasiswa(array $mhsData): bool
    {
        return $this->insert($mhsData);
    }

    public function updateMahasiswa(int $mhsNim, array $mhsData): bool
    {
        return $this->update($mhsNim, $mhsData);
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