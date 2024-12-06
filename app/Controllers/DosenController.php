<?php

namespace App\Controllers;

use App\Models\DosenModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class DosenController extends Controller
{
    protected DosenModel $dosenModel;

    public function __construct()
    {
        $this->dosenModel = new DosenModel();
    }

    public function index(Request $request, Response $response)
    {
        return $dosenList = $this->dosenModel->getAllDosen();
        // $response->getBody()->write(json_encode($dosenList));
        // return $response->withHeader('Content-Type', 'application/json');
    }

    public function show(Request $request, Response $response, array $args)
    {
        $nip = $args['nip'];
        $dosen = $this->dosenModel->getDosenByNip($nip);

        if ($dosen) {
            $response->getBody()->write(json_encode($dosen));
        } else {
            $response->getBody()->write(json_encode(["error" => "Dosen tidak ditemukan."]));
        }

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function store(Request $request, Response $response)
    {
        $data = json_decode($request->getBody(), true);

        $errors = [];

        if (empty($data['nip'])) {
            $errors['nip'] = 'NIP wajib diisi.';
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

        if (empty($data['prodi_id'])) {
            $errors['prodi_id'] = 'Prodi wajib dipilih.';
        }

        if (!empty($errors)) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $errors,
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(422);
        }

        $data['created_at'] = date('Y-m-d H:i:s');

        try {
            $result = $this->dosenModel->addDosen($data);

            if ($result) {
                $response->getBody()->write(json_encode([
                    'success' => true,
                    'message' => 'Dosen berhasil ditambahkan.',
                ]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
            } else {
                $response->getBody()->write(json_encode([
                    'success' => false,
                    'message' => 'Gagal menyimpan dosen.',
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

    public function update(Request $request, Response $response, array $args)
    {
        $nip = $args['nip'];
        $data = json_decode($request->getBody(), true);

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
            $result = $this->dosenModel->updateDosen($nip, $data);

            if ($result) {
                $response->getBody()->write(json_encode([
                    'success' => true,
                    'message' => 'Dosen berhasil diperbarui.',
                ]));
                return $response->withHeader('Content-Type', 'application/json');
            } else {
                $response->getBody()->write(json_encode([
                    'success' => false,
                    'message' => 'Gagal memperbarui dosen.',
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

    public function delete(Request $request, Response $response, array $args)
    {
        $nip = $args['nip'];

        if (empty($nip) || !is_numeric($nip)) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'NIP dosen tidak valid.',
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        try {
            $result = $this->dosenModel->deleteDosen($nip);

            if ($result) {
                $response->getBody()->write(json_encode([
                    'success' => true,
                    'message' => 'Dosen berhasil dihapus.',
                ]));
            } else {
                $response->getBody()->write(json_encode([
                    'success' => false,
                    'message' => 'Dosen tidak ditemukan atau gagal dihapus.',
                ]));
            }
        } catch (\Exception $e) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }

        return $response->withHeader('Content-Type', 'application/json');
    }
}