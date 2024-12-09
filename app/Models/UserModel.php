<?php

namespace App\Models;

use PDO;
use PDOException;

class UserModel extends Model
{
    protected string $tableName = 'UserManagement.users';
    protected string $mahasiswaTableName = 'UserManagement.mahasiswa';
    protected string $dosenTableName = 'UserManagement.dosen';
    protected string $adminTableName = 'UserManagement.admin';

    protected string $primaryKey = 'user_id';

    // Metode untuk mendapatkan user berdasarkan username
    public function getUserByUsername(string $username): ?array
    {
        $query = "SELECT * FROM {$this->tableName} WHERE username = :username";
        $params = [':username' => $username];
        $result = $this->query($query, $params);
        return $result[0] ?? null;
    }

    public function getUserNotInMahasiswa(): ?array
    {
        $sql = "
            SELECT u.user_id, u.username, u.role_id
            FROM {$this->tableName} AS u
            LEFT JOIN {$this->mahasiswaTableName} AS m ON u.user_id = m.user_id
            WHERE u.role_id = 1 AND m.user_id IS NULL
        ";
        return $this->query($sql); // Gunakan metode query() dari superclass
    }

    public function getUserNotInDosen(): ?array
    {
        $sql = "
            SELECT u.user_id, u.username, u.role_id
            FROM {$this->tableName} AS u
            LEFT JOIN {$this->dosenTableName} AS d ON u.user_id = d.user_id
            WHERE u.role_id = 2 AND d.user_id IS NULL
        ";
        return $this->query($sql); // Gunakan metode query() dari superclass
    }


    public function getUserOnlyDosen(): ?array
    {
        $sql = "
            SELECT d.nip, d.nama
            FROM {$this->dosenTableName} AS d
            JOIN {$this->tableName} AS u ON u.user_id = d.user_id
            WHERE u.role_id = 2
        ";
        return $this->query($sql); // Gunakan metode query() dari superclass
    }


    public function getUserByIdWithRoles(int $user_id): ?array
    {
        try {
            $sql = "
            SELECT u.*, 
                   CASE WHEN EXISTS(SELECT 1 FROM {$this->mahasiswaTableName} WHERE user_id = u.user_id) THEN 1 ELSE 0 END AS is_mahasiswa,
                   CASE WHEN EXISTS(SELECT 1 FROM {$this->dosenTableName} WHERE user_id = u.user_id) THEN 1 ELSE 0 END AS is_dosen,
                   CASE WHEN EXISTS(SELECT 1 FROM {$this->adminTableName} WHERE user_id = u.user_id) THEN 1 ELSE 0 END AS is_admin
            FROM {$this->tableName} u
            WHERE u.{$this->primaryKey} = :user_id
            ";

            $result = $this->query($sql, ['user_id' => $user_id]);

            if (!empty($result)) {
                $user = $result[0];
                // Tentukan apakah role dapat diubah
                $user['is_role_editable'] = !($user['is_mahasiswa'] || $user['is_dosen'] || $user['is_admin']);
                return $user;
            }
        } catch (PDOException $e) {
            $this->handleError($e);
        }

        return null;
    }

    // Memanfaatkan findAll dari superclass
    public function getAllUsers(): array
    {
        return $this->findAll();
    }

    // Memanfaatkan find dari superclass
    public function getUserById(int $user_id): ?array
    {
        return $this->find($user_id);
    }

    // Memanfaatkan insert dari superclass
    public function addUser(array $userData): bool
    {
        return $this->insert($userData);
    }

    // Memanfaatkan update dari superclass
    public function updateUser(int $userId, array $userData): bool
    {
        return $this->update($userId, $userData);
    }

    // Memanfaatkan delete dari superclass
    public function deleteUser(int $userId): bool
    {
        return $this->delete($userId);
    }


    private function handleError(PDOException $e): void
    {
        error_log("UserModel Error: " . $e->getMessage());
        throw new \Exception("Kesalahan database");
    }
}
