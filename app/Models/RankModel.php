<?php

namespace App\Models;

class RankModel extends Model
{
    protected string $tableName = 'Achievements.ranking';
    protected string $primaryKey = 'nim';

    // Memanfaatkan findAll dari superclass
    public function getAllRank(): array
    {
        return $this->findAll();
    }
}