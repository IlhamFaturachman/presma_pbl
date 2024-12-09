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
        return $this->find($roleId);
    }

    public function getAllRoles(): array
    {
        return $this->findAll();
    }

    public function addRole(array $roleData): bool
    {
        return $this->insert($roleData);
    }

    public function updateRole(int $roleId, array $roleData): bool
    {
        return $this->update($roleId, $roleData);
    }

    public function deleteRole(int $roleId): bool
    {
        return $this->delete($roleId);
    }

    private function handleError(PDOException $e): void
    {
        error_log("RolesModel Error: " . $e->getMessage());
        throw new \Exception("Kesalahan database");
    }
}
