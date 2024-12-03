<?php

namespace App\Models;

use PDO;
use PDOException;

class UserModel extends Model
{
    protected string $tableName = 'UserManagement.users';
    protected string $primaryKey = 'user_id';

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
        return null;
    }

    public function getAllUsers(): array
    {
        try {
            $query = "SELECT * FROM {$this->tableName}";
            $stmt = $this->getDbConnection()->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return [];
    }


    public function getUserById(int $id): array
    {
        try {
            $query = "SELECT * FROM {$this->tableName} WHERE id = :id";
            $stmt = $this->getDbConnection()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return [];
    }


    public function addUser(array $userData): bool
    {
        try {
            $columns = implode(", ", array_keys($userData));
            $placeholders = implode(", ", array_map(fn($key) => ":$key", array_keys($userData)));
            $query = "INSERT INTO {$this->tableName} ($columns) VALUES ($placeholders)";
            $stmt = $this->getDbConnection()->prepare($query);
            foreach ($userData as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            return $stmt->execute();
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return false;
    }

    public function updateUser(int $userId, array $userData): bool
    {
        try {
            $setClause = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($userData)));
            $query = "UPDATE {$this->tableName} SET $setClause WHERE {$this->primaryKey} = :user_id";
            $stmt = $this->getDbConnection()->prepare($query);
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            foreach ($userData as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            return $stmt->execute();
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return false;
    }

    public function deleteUser(int $userId): bool
    {
        try {
            $query = "DELETE FROM {$this->tableName} WHERE {$this->primaryKey} = :user_id";
            $stmt = $this->getDbConnection()->prepare($query);
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return false;
    }

    private function handleError(PDOException $e): void
    {
        error_log("UserModel Error: " . $e->getMessage());
        throw new \Exception("Kesalahan database");
    }
}