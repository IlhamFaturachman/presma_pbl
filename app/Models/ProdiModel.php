<?php

namespace App\Models;

class ProdiModel extends Model
{
    protected string $tableName = 'UserManagement.ProgramStudi';
    protected string $primaryKey = 'user_id';

    // Memanfaatkan findAll dari superclass
    public function getAllProdi(): array
    {
        return $this->findAll();
    }

    // Memanfaatkan find dari superclass
    public function getProdiById(int $user_id): ?array
    {
        return $this->find($user_id);
    }

    // Memanfaatkan insert dari superclass
    public function addProdi(array $userData): bool
    {
        return $this->insert($userData);
    }

    // Memanfaatkan update dari superclass
    public function updateProdi(int $userId, array $userData): bool
    {
        return $this->update($userId, $userData);
    }

    // Memanfaatkan delete dari superclass
    public function deleteProdi(int $userId): bool
    {
        return $this->delete($userId);
    }
}