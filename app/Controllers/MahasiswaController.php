<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\UserModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class MahasiswaController extends Controller
{
    protected MahasiswaModel $mahasiswaModel;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->userModel = new UserModel();
    }

    // Override index method for listing mahasiswa
    public function index(Request $request, Response $response)
    {
        return $mahasiswa = $this->mahasiswaModel->getAllMahasiswa();
    }

    // Override show method for fetching mahasiswa by ID
    public function show(Request $request, Response $response, array $args)
    {
        $nim = $args['nim'];
        $mahasiswa = $this->mahasiswaModel->getMahasiswaByNim($nim);
        if ($mahasiswa) {
            $response->getBody()->write(json_encode($mahasiswa));
        } else {
            $response->getBody()->write(json_encode(["error" => "Mahasiswa tidak ditemukan."]));
        }
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Override store method for creating a new mahasiswa
    public function store(Request $request, Response $response)
    {
        $data = json_decode($request->getBody(), true);

        // Validasi input
        $errors = [];

        if (empty($data['user_id'])) {
            $errors['user_id'] = 'User ID wajib disertakan.';
        }

        if (empty($data['nim'])) {
            $errors['nim'] = 'NIM wajib dipilih.';
        }

        if (empty($data['nama'])) {
            $errors['nama'] = 'Nama wajib diisi.';
        }

        if (empty($data['email'])) {
            $errors['email'] = 'Email wajib diisi.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email tidak valid.';
        }

        if (empty($data['phone'])) {
            $errors['phone'] = 'No. Telp wajib diisi.';
        } elseif (!is_numeric($data['phone'])) {
            $errors['phone'] = 'No. Telp harus berupa angka.';
        }

        if (empty($data['angkatan'])) {
            $errors['angkatan'] = 'Angkatan wajib dipilih.';
        }

        if (empty($data['kelas'])) {
            $errors['kelas'] = 'Kelas wajib dipilih.';
        }

        if (empty($data['prodi_id'])) {
            $errors['prodi_id'] = 'Prodi wajib dipilih.';
        }

        // Jika ada error validasi, kembalikan respons
        if (!empty($errors)) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $errors,
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(422);
        }

        // Tambahkan timestamp
        $data['created_at'] = date('Y-m-d H:i:s');

        try {
            // Simpan data ke database melalui model
            $result = $this->mahasiswaModel->addMahasiswa($data);

            if ($result) {
                $response->getBody()->write(json_encode([
                    'success' => true,
                    'message' => 'Mahasiswa berhasil ditambahkan.',
                ]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
            } else {
                $response->getBody()->write(json_encode([
                    'success' => false,
                    'message' => 'Gagal menyimpan mahasiswa.',
                ]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
            }
        } catch (\Exception $e) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage(),
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    }



    // Override update method for updating mahasiswa data
    public function update(Request $request, Response $response, array $args)
    {
        $nim = $args['nim']; // Pastikan nim yang diambil benar
        $data = json_decode($request->getBody(), true);

        // Validasi input
        $errors = [];

        if (empty($data['nama'])) {
            $errors['nama'] = 'Nama wajib diisi.';
        }

        if (empty($data['email'])) {
            $errors['email'] = 'Email wajib diisi.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email tidak valid.';
        }

        if (empty($data['phone'])) {
            $errors['phone'] = 'No. Telp wajib diisi.';
        }

        if (empty($data['angkatan'])) {
            $errors['angkatan'] = 'Angkatan wajib diisi.';
        }

        if (empty($data['kelas'])) {
            $errors['kelas'] = 'Kelas wajib diisi.';
        }

        if (empty($data['prodi_id'])) {
            $errors['prodi_id'] = 'Prodi wajib diisi.';
        }

        if (!empty($errors)) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $errors,
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(422);
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        try {
            // Perbarui data mahasiswa di database
            $result = $this->mahasiswaModel->updateMahasiswa($nim, $data);

            if ($result) {
                $response->getBody()->write(json_encode([
                    'success' => true,
                    'message' => 'Mahasiswa berhasil diperbarui.',
                ]));
                return $response->withHeader('Content-Type', 'application/json');
            } else {
                $response->getBody()->write(json_encode([
                    'success' => false,
                    'message' => 'Gagal memperbarui mahasiswa.',
                ]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
            }
        } catch (\Exception $e) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage(),
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    }


    // Override delete method for removing mahasiswa
    public function delete(Request $request, Response $response, array $args)
    {
        $nim = $args['nim'];

        if (empty($nim) || !is_numeric($nim)) {
            $response->getBody()->write(json_encode([
                "success" => false,
                "message" => "NIM mahasiswa tidak valid.",
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        try {
            $result = $this->mahasiswaModel->deleteMahasiswa($nim);

            if ($result) {
                $response->getBody()->write(json_encode([
                    "success" => true,
                    "message" => "Mahasiswa berhasil dihapus.",
                ]));
            } else {
                $response->getBody()->write(json_encode([
                    "success" => false,
                    "message" => "Mahasiswa tidak ditemukan atau gagal dihapus.",
                ]));
            }
        } catch (\Exception $e) {
            $response->getBody()->write(json_encode([
                "success" => false,
                "message" => "Terjadi kesalahan: " . $e->getMessage(),
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }

        return $response->withHeader('Content-Type', 'application/json');
    }
}