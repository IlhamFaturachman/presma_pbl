<?php

namespace App\Models;

use PDO;
use PDOException;

class RolesModel extends Model
{
    protected string $tableName = 'UserManagement.roles';
    protected string $primaryKey = 'role_id';

    public function getRoleById(int $roleId): ?array
    {
        try {
            $query = "SELECT * FROM {$this->tableName} WHERE {$this->primaryKey} = :role_id";
            $stmt = $this->getDbConnection()->prepare($query);
            $stmt->bindValue(':role_id', $roleId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return null;
    }

    public function getAllRoles(): array
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

    public function addRole(array $roleData): bool
    {
        try {
            $columns = implode(", ", array_keys($roleData));
            $placeholders = implode(", ", array_map(fn($key) => ":$key", array_keys($roleData)));
            $query = "INSERT INTO {$this->tableName} ($columns) VALUES ($placeholders)";
            $stmt = $this->getDbConnection()->prepare($query);
            foreach ($roleData as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            return $stmt->execute();
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return false;
    }

    public function updateRole(int $roleId, array $roleData): bool
    {
        try {
            $setClause = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($roleData)));
            $query = "UPDATE {$this->tableName} SET $setClause WHERE {$this->primaryKey} = :role_id";
            $stmt = $this->getDbConnection()->prepare($query);
            $stmt->bindValue(':role_id', $roleId, PDO::PARAM_INT);
            foreach ($roleData as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            return $stmt->execute();
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return false;
    }

    public function deleteRole(int $roleId): bool
    {
        try {
            $query = "DELETE FROM {$this->tableName} WHERE {$this->primaryKey} = :role_id";
            $stmt = $this->getDbConnection()->prepare($query);
            $stmt->bindValue(':role_id', $roleId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            $this->handleError($e);
        }
        return false;
    }

    private function handleError(PDOException $e): void
    {
        error_log("RolesModel Error: " . $e->getMessage());
        throw new \Exception("Kesalahan database");
    }
}
