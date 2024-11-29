<?php
class AuthController
{
    private $conn;

    public function __construct()
    {
        global $conn; // Menggunakan koneksi database global
        $this->conn = $conn;
    }

    public function login($username, $password)
    {
        try {
            // Query untuk mendapatkan user berdasarkan username
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Login berhasil
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role']; // Menyimpan role (mahasiswa, dosen, admin, kajur)

                // Redirect berdasarkan role
                switch ($user['role']) {
                    case 'mahasiswa':
                        header("Location: /web/mahasiswa/dashboard");
                        break;
                    case 'admin':
                        header("Location: /web/admin/dashboard");
                        break;
                    case 'dosen':
                        header("Location: /web/dosen/dashboard");
                        break;
                    case 'kajur':
                        header("Location: /web/kajur/dashboard");
                        break;
                    default:
                        header("Location: /web/auth/login");
                        break;
                }
            } else {
                // Login gagal
                echo "Username atau password salah.";
            }
        } catch (PDOException $e) {
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    }
}
