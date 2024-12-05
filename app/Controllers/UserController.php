<?php

namespace App\Controllers;

use App\Models\UserModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class UserController extends Controller
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Override index method for listing users
    public function index(Request $request, Response $response)
    {
        return $users = $this->userModel->getAllUsers();
        // $response->getBody()->write(json_encode($users));
        // return $response->withHeader('Content-Type', 'application/json');
    }

    // Override show method for fetching user by ID
    public function show(Request $request, Response $response, array $args)
    {
        $user_id = $args['user_id'];
        $user = $this->userModel->getUserById($user_id);
        if ($user) {
            $response->getBody()->write(json_encode($user));
        } else {
            $response->getBody()->write(json_encode(["error" => "User not found"]));
        }
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Override store method for creating a new user
    public function store(Request $request, Response $response)
    {
        // Ambil dan decode data dari request
        $data = json_decode($request->getBody(), true);

        // Validasi input
        $errors = [];
        if (empty($data['username'])) {
            $errors['username'] = 'Username wajib diisi.';
        } elseif (strlen($data['username']) < 4) {
            $errors['username'] = 'Username minimal 4 karakter.';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Password wajib diisi.';
        } elseif (strlen($data['password']) < 6) {
            $errors['password'] = 'Password minimal 6 karakter.';
        }

        if (empty($data['role_id'])) {
            $errors['role_id'] = 'Role ID wajib diisi.';
        } elseif (!is_numeric($data['role_id'])) {
            $errors['role_id'] = 'Role ID harus berupa angka.';
        }

        // Jika ada error, kirimkan respons dengan status 422
        if (!empty($errors)) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $errors,
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(422);
        }

        // Hash password
        $data['password_hash'] = password_hash($data['password'], PASSWORD_BCRYPT);
        unset($data['password']); // Hapus password plaintext untuk keamanan

        // Tambahkan timestamp
        $data['created_at'] = date('Y-m-d H:i:s');

        // Simpan ke database
        try {
            $result = $this->userModel->addUser($data);

            if ($result) {
                $response->getBody()->write(json_encode([
                    'success' => true,
                    'message' => 'Pengguna berhasil ditambahkan.',
                ]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
            } else {
                $response->getBody()->write(json_encode([
                    'success' => false,
                    'message' => 'Gagal menyimpan pengguna. Silakan coba lagi.',
                ]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
            }
        } catch (\Exception $e) {
            // Error handling untuk masalah yang tidak terduga
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage(),
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    }

    // Override update method for updating user data
    public function update(Request $request, Response $response, array $args)
    {
        // Ambil user_id dari args
        $user_id = $args['user_id'];

        // Cek apakah user dengan user_id tersebut ada
        if (!$user_id) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Pengguna tidak ditemukan.',
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }

        // Ambil dan decode data dari request
        $data = json_decode($request->getBody(), true);

        // Validasi input
        $errors = [];
        if (empty($data['username'])) {
            $errors['username'] = 'Username wajib diisi.';
        } elseif (strlen($data['username']) < 4) {
            $errors['username'] = 'Username minimal 4 karakter.';
        }

        if (!empty($data['password']) && strlen($data['password']) < 6) {
            $errors['password'] = 'Password minimal 6 karakter.';
        }

        if (empty($data['role_id'])) {
            $errors['role_id'] = 'Role ID wajib diisi.';
        } elseif (!is_numeric($data['role_id'])) {
            $errors['role_id'] = 'Role ID harus berupa angka.';
        }

        // Jika ada error, kirimkan respons dengan status 422
        if (!empty($errors)) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $errors,
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(422);
        }

        // Hash password jika ada perubahan password
        if (!empty($data['password'])) {
            $data['password_hash'] = password_hash($data['password'], PASSWORD_BCRYPT);
            unset($data['password']); // Hapus password plaintext untuk keamanan
        }

        // Tambahkan timestamp update
        $data['updated_at'] = date('Y-m-d H:i:s');

        // Perbarui data di database
        try {
            $result = $this->userModel->updateUser($user_id, $data);

            if ($result) {
                $response->getBody()->write(json_encode([
                    'success' => true,
                    'message' => 'Pengguna berhasil diperbarui.',
                ]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
            } else {
                $response->getBody()->write(json_encode([
                    'success' => false,
                    'message' => 'Gagal memperbarui pengguna. Silakan coba lagi.',
                ]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
            }
        } catch (\Exception $e) {
            // Error handling untuk masalah yang tidak terduga
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage(),
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    }


    // Override delete method for removing a user
    public function delete(Request $request, Response $response, array $args)
    {
        $user_id = $args['user_id'];

        // Validasi ID
        if (empty($user_id) || !is_numeric($user_id)) {
            $response->getBody()->write(json_encode([
                "success" => false,
                "message" => "ID pengguna tidak valid."
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        try {
            // Hapus pengguna menggunakan model
            $result = $this->userModel->deleteUser($user_id);

            if ($result) {
                $response->getBody()->write(json_encode([
                    "success" => true,
                    "message" => "Pengguna berhasil dihapus."
                ]));
            } else {
                $response->getBody()->write(json_encode([
                    "success" => false,
                    "message" => "Pengguna tidak ditemukan atau gagal dihapus."
                ]));
            }
        } catch (\Exception $e) {
            $response->getBody()->write(json_encode([
                "success" => false,
                "message" => "Terjadi kesalahan: " . $e->getMessage()
            ]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }

        return $response->withHeader('Content-Type', 'application/json');
    }
}