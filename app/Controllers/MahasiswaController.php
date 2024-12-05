<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class MahasiswaController extends Controller
{
    protected MahasiswaModel $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
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
        if (empty($data['nama'])) {
            $errors['nama'] = 'Nama wajib diisi.';
        }

        if (empty($data['nim'])) {
            $errors['nim'] = 'NIM wajib diisi.';
        } elseif (!is_numeric($data['nim'])) {
            $errors['nim'] = 'NIM harus berupa angka.';
        }

        if (empty($data['jurusan'])) {
            $errors['jurusan'] = 'Jurusan wajib diisi.';
        }

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
        $id = $args['id'];
        $data = json_decode($request->getBody(), true);

        // Validasi input
        $errors = [];
        if (empty($data['nama'])) {
            $errors['nama'] = 'Nama wajib diisi.';
        }

        if (empty($data['jurusan'])) {
            $errors['jurusan'] = 'Jurusan wajib diisi.';
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
            $result = $this->mahasiswaModel->updateMahasiswa($id, $data);

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
        $id = $args['id'];

        if (empty($id) || !is_numeric($id)) {
            $response->getBody()->write(json_encode([
                "success" => false,
                "message" => "ID mahasiswa tidak valid.",
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        try {
            $result = $this->mahasiswaModel->deleteMahasiswa($id);

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
