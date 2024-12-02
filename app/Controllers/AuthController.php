<?php

namespace App\Controllers;

use App\Models\UserModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class AuthController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login(Request $request, Response $response): ResponseInterface
    {
        $data = $request->getParsedBody();

        // Validasi input
        if (empty($data['username']) || empty($data['password'])) { // Menggunakan 'password'
            return $this->respondWithJson($response, 400, 'Username atau password wajib diisi!');
        }

        // Ambil data user dari database
        $user = $this->userModel->getUserByUsername($data['username']);
        if (!$user) {
            return $this->respondWithJson($response, 404, 'User tidak ditemukan!');
        }

        // Verifikasi password menggunakan password_verify
        if (!password_verify($data['password'], $user['password_hash'])) {
            return $this->respondWithJson($response, 401, 'Password salah!');
        }

        // Ambil nama pengguna berdasarkan role
        $name = $this->getUserNameByRole($user['user_id'], $user['role_id']);

        unset($_SESSION['is_login']);
        unset($_SESSION['username']);
        unset($_SESSION['name']);
        unset($_SESSION['level']);

        $_SESSION['user'] = [
            'id' => $user['user_id'],           // ID user dari tabel users
            'username' => $user['username'],   // Username dari tabel users
            'name' => $name,                   // Nama dari tabel terkait (mahasiswa, dosen, admin, dsb.)
            'role' => $user['role_id'],        // Role dari tabel users
        ];

        // echo '<pre>';
        // print_r($_SESSION);
        // echo '</pre>';
        // exit; // Hentikan eksekusi untuk melihat hasil

        // Tentukan redirect berdasarkan role
        $redirectUrl = $this->getDashboardUrlByRole($user['role_id']);

        return $this->respondWithJson($response, 200, 'Login berhasil!', ['redirect_url' => $redirectUrl]);
    }

    private function respondWithJson(Response $response, int $status, string $message, array $data = []): ResponseInterface
    {
        $payload = array_merge(['success' => $status === 200, 'message' => $message], $data);
        $response->getBody()->write(json_encode($payload));
        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    }

    // Fungsi untuk mengambil nama pengguna berdasarkan role
    private function getUserNameByRole(int $userId, int $roleId): ?string
    {
        switch ($roleId) {
            case 1:
                $query = "SELECT nama FROM UserManagement.mahasiswa WHERE user_id = :user_id";
                break;
            case 2:
                $query = "SELECT nama FROM UserManagement.dosen WHERE user_id = :user_id";
                break;
            case 3:
                $query = "SELECT nama FROM UserManagement.Admin WHERE user_id = :user_id";
                break;
            default:
                return null;
        }

        $stmt = $this->userModel->getDbConnection()->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetch();

        return $result['nama'] ?? null;
    }

    // Fungsi untuk menentukan URL dashboard berdasarkan role
    private function getDashboardUrlByRole($roleId): string
    {
        switch ($roleId) {
            case 1:
                return '/presma_pbl/public/mahasiswa/dashboard';
            case 2:
                return '/presma_pbl/public/dashboard/dosbim';
            case 3:
                return '/presma_pbl/public/admin/dashboard';
            default:
                return '/presma_pbl/public/dashboard/unknown';
        }
    }

    public function logout(Request $request, Response $response): ResponseInterface
    {
        unset($_SESSION['user']);
        session_destroy();
        return $this->respondWithJson($response, 200, 'Logout berhasil!');
    }
}
