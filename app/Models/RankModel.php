<?php

namespace App\Models;

class RankModel extends Model
{
    protected string $tableName = 'Achievements.ranking';
    protected string $primaryKey = 'nim';


    // Memanfaatkan findAll dari superclass
    // public function getAllRank(): array
    // {
    //     return $this->findAll();
    // }

    // get all data rank

    public function getAllRank(): array
    {
        $sql = "
            SELECT 
                r.nim,
                m.nama AS nama_mahasiswa,
                p.nama_prodi AS program_studi,
                COUNT(pre.prestasi_id) AS jumlah_prestasi,
                r.total_points
            FROM 
                Achievements.ranking r
            JOIN 
                UserManagement.mahasiswa m ON r.nim = m.nim
            JOIN 
                UserManagement.ProgramStudi p ON m.prodi_id = p.prodi_id
            LEFT JOIN 
                Achievements.prestasi pre ON r.nim = pre.nim
            GROUP BY 
                r.nim, m.nama, p.nama_prodi, r.total_points
            ORDER BY 
                r.total_points DESC;
        ";

        return $this->query($sql);
    }
}
