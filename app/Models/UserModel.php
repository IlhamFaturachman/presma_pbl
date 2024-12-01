<?php

namespace App\Models;

use PDO;
use PDOException;

class UserModel extends Model
{
    protected string $tableName = 'UserManagement.users';
    protected string $primaryKey = 'user_id';

    /**
     * Mengambil data pengguna berdasarkan username.
     *
     * @param string $username
     * @return array|null
     */
    public function getUserByUsername(string $username): ?array
    {
        try {
            $query = "SELECT * FROM {$this->tableName} WHERE username = :username";
            $stmt = $this->getDbConnection()->prepare($query);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return null; // Return default value jika terjadi error
    }

    /**
     * Menambahkan pengguna baru ke dalam database.
     *
     * @param array $userData
     * @return bool
     */
    public function addUser(array $userData): bool
    {
        try {
            return $this->insert($userData);
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return false;
    }

    /**
     * Memperbarui data pengguna berdasarkan user_id.
     *
     * @param int $userId
     * @param array $userData
     * @return bool
     */
    public function updateUser(int $userId, array $userData): bool
    {
        try {
            return $this->update($userId, $userData);
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return false;
    }

    /**
     * Menghapus pengguna berdasarkan user_id.
     *
     * @param int $userId
     * @return bool
     */
    public function deleteUser(int $userId): bool
    {
        try {
            return $this->delete($userId);
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return false;
    }

    /**
     * Memeriksa apakah username sudah digunakan.
     *
     * @param string $username
     * @return bool
     */
    public function isUsernameTaken(string $username): bool
    {
        try {
            $query = "SELECT COUNT(*) FROM {$this->tableName} WHERE username = :username";
            $stmt = $this->getDbConnection()->prepare($query);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return false;
    }

    /**
     * Mengambil semua pengguna berdasarkan role.
     *
     * @param int $roleId
     * @return array
     */
    public function getUsersByRole(int $roleId): array
    {
        try {
            $query = "SELECT * FROM {$this->tableName} WHERE role_id = :role_id";
            $stmt = $this->getDbConnection()->prepare($query);
            $stmt->bindValue(':role_id', $roleId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return [];
    }

    /**
     * Menangani kesalahan database khusus untuk model ini.
     *
     * @param PDOException $e
     */
    private function handleError(PDOException $e): void
    {
        // Log pesan lengkap termasuk file dan baris kesalahan
        error_log("UserModel Error: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine());
        throw new \Exception("Kesalahan database: " . $e->getMessage()); // Berikan pesan detail jika dalam mode debug
    }
}