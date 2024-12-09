<?php

namespace App\Models;

use App\Config\Database;
use Exception;
use PDO;
use PDOException;

class ValidasiModel extends Model
{
    protected string $tableName = 'Administration.validasi';
    protected string $primaryKey = 'validasi_id';
    protected string $fkForeignPrestasi = 'prestasi_id';

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

    public function updatePrestasiStatus(int $prestasiId, string $status, string $infoValidasi): bool
    {
        try {
            $sql = "
                UPDATE {$this->tableName}
                SET 
                    validasi_status = :validasi_status,
                    info_validasi = :info_validasi,
                    validasi_date = GETDATE()
                WHERE {$this->fkForeignPrestasi} = :prestasi_id;
            ";

            $params = [
                ':prestasi_id' => $prestasiId,
                ':validasi_status' => $status,
                ':info_validasi' => $infoValidasi,
            ];

            // Debugging: Log query and parameters
            error_log("Executing query: $sql with params " . json_encode($params));

            $stmt = $this->db->prepare($sql); // Prepare the query
            return $stmt->execute($params); // Execute and return success/failure
        } catch (PDOException $e) {
            error_log("Database error in updatePrestasiStatus: " . $e->getMessage());
            return false;
        }
    }

    public function validPrestasiById(int $prestasiId, string $infoValidasi): bool
    {
        return $this->updatePrestasiStatus($prestasiId, 'Tervalidasi', $infoValidasi);
    }

    public function rejectPrestasiById(int $prestasiId, string $infoValidasi): bool
    {
        return $this->updatePrestasiStatus($prestasiId, 'Ditolak', $infoValidasi);
    }

    private function handleError(PDOException $e): void
    {
        error_log("ValidasiModel Error: " . $e->getMessage());
        throw new Exception("Kesalahan database");
    }
}
