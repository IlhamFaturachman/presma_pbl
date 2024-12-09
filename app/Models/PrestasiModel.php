<?php

namespace App\Models;

use PDOException;

class PrestasiModel extends Model
{
    protected string $tableName = 'Achievements.prestasi';
    protected string $prestasiViewTableName = 'vw_prestasi_validasi';
    protected string $primaryKey = 'prestasi_id';


    public function getAllPrestasi(): array
    {
        $sql = "SELECT * FROM {$this->prestasiViewTableName}";
        return $this->query($sql); // Gunakan metode query() dari superclass
    }
    public function getPrestasiByNim(string $nim): array
    {
        $sql = "SELECT 
                    p.prestasi_id AS PrestasiID,
                    m.nama AS NamaMahasiswa,
                    d.nama AS NamaDosen,
                    p.nama_lomba,
                    j.nama_juara AS Peringkat,
                    t.nama_tingkatan AS Tingkat,
                    p.waktu_mulai_lomba,
                    p.waktu_selesai_lomba,
                    p.kategori_lomba,
                    p.penyelenggara,
                    p.foto_lomba,
                    p.flyer_lomba,
                    p.sertifikat,
                    p.ide_proposal,
                    p.surat_tugas,
                    p.total_point,
                    p.created_at,
                    v.validasi_status, -- Tambahkan kolom status_validasi dari tabel validasi
                    v.info_validasi,
                    v.validasi_date
                FROM 
                    Achievements.prestasi p
                JOIN 
                    UserManagement.mahasiswa m ON p.nim = m.nim
                JOIN 
                    UserManagement.dosen d ON p.nip = d.nip
                JOIN 
                    Achievements.juara j ON p.juara_id = j.juara_id
                JOIN 
                    Achievements.tingkatan t ON p.tingkatan_id = t.tingkatan_id
                JOIN 
                    Administration.validasi v ON p.prestasi_id = v.prestasi_id
                WHERE 
                    p.nim = :nim";
        $params = [':nim' => $nim]; // Menggunakan binding parameter
        return $this->query($sql, $params); // Menggunakan query() dengan parameter
    }

    // Memanfaatkan find dari superclass
    // public function getPrestasiById(int $prestasi_id): ?array
    // {
    //     $sql = "SELECT 
    //     p.prestasi_id AS PrestasiID,
    //     m.nim AS NIM, -- Tambahkan NIM di sini
    //     m.nama AS NamaMahasiswa,
    //     d.nama AS NamaDosen,
    //     p.nama_lomba,
    //     j.nama_juara AS Peringkat,
    //     t.nama_tingkatan AS Tingkat,
    //     p.waktu_mulai_lomba,
    //     p.waktu_selesai_lomba,
    //     p.kategori_lomba,
    //     p.penyelenggara,
    //     p.foto_lomba,
    //     p.flyer_lomba,
    //     p.sertifikat,
    //     p.ide_proposal,
    //     p.surat_tugas,
    //     p.total_point,
    //     p.created_at,
    //     v.validasi_status, 
    //     v.info_validasi,
    //     v.validasi_date
    // FROM 
    //     Achievements.prestasi p
    // LEFT JOIN 
    //     UserManagement.mahasiswa m ON p.nim = m.nim
    // LEFT JOIN 
    //     UserManagement.dosen d ON p.nip = d.nip
    // LEFT JOIN 
    //     Achievements.juara j ON p.juara_id = j.juara_id
    // LEFT JOIN 
    //     Achievements.tingkatan t ON p.tingkatan_id = t.tingkatan_id
    // LEFT JOIN 
    //     Administration.validasi v ON p.prestasi_id = v.prestasi_id
    // WHERE 
    //     p.prestasi_id = :prestasi_id";

    //     $params = [':prestasi_id' => $prestasi_id];
    //     return $this->query($sql, $params);
    // }
    public function getPrestasiById(int $prestasi_id): ?array
    {
        $sql = "SELECT 
            p.prestasi_id AS PrestasiID,
            m.nim AS NIM,
            m.nama AS NamaMahasiswa,
            d.nama AS NamaDosen,
            p.nama_lomba,
            j.nama_juara AS Peringkat,
            t.nama_tingkatan AS Tingkat,
            p.waktu_mulai_lomba,
            p.waktu_selesai_lomba,
            p.kategori_lomba,
            p.penyelenggara,
            p.foto_lomba,
            p.flyer_lomba,
            p.sertifikat,
            p.ide_proposal,
            p.surat_tugas,
            p.total_point,
            p.created_at,
            v.validasi_status, 
            v.info_validasi,
            v.validasi_date
        FROM 
            Achievements.prestasi p
        LEFT JOIN 
            UserManagement.mahasiswa m ON p.nim = m.nim
        LEFT JOIN 
            UserManagement.dosen d ON p.nip = d.nip
        LEFT JOIN 
            Achievements.juara j ON p.juara_id = j.juara_id
        LEFT JOIN 
            Achievements.tingkatan t ON p.tingkatan_id = t.tingkatan_id
        LEFT JOIN 
            Administration.validasi v ON p.prestasi_id = v.prestasi_id
        WHERE 
            p.prestasi_id = :prestasi_id";

        $params = [':prestasi_id' => $prestasi_id];

        // Ambil data dari database
        $result = $this->queryOne($sql, $params);

        if (!$result) {
            // Jika data tidak ditemukan, kembalikan null atau array error
            return null; // atau return ['error' => 'Prestasi tidak ditemukan.'] jika ingin menggunakan array error
        }

        return $result; // Kembalikan data sebagai array
    }


    // Memanfaatkan insert dari superclass
    public function addPrestasi(array $prestasiData): bool
    {
        return $this->insert($prestasiData);
    }

    // Memanfaatkan update dari superclass
    public function updatePrestasi(int $prestasiId, array $prestasiData): bool
    {
        return $this->update($prestasiId, $prestasiData);
    }

    // Memanfaatkan delete dari superclass
    public function deletePrestasi(int $prestasiId): bool
    {
        return $this->delete($prestasiId);
    }


    private function handleError(PDOException $e): void
    {
        error_log("PrestasiModel Error: " . $e->getMessage());
        throw new \Exception("Kesalahan database");
    }
}
