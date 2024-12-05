<?php

namespace App\Models;

use PDO;

class UserModel extends Model
{
    protected string $tableName = 'UserManagement.users';
    protected string $primaryKey = 'user_id';

    // Metode untuk mendapatkan user berdasarkan username
    public function getUserByUsername(string $username): ?array
    {
        $query = "SELECT * FROM {$this->tableName} WHERE username = :username";
        $params = [':username' => $username];
        $result = $this->query($query, $params);
        return $result[0] ?? null;
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
}