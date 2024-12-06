<?php

use App\Controllers\AuthController;
use App\Controllers\DosenController;
use App\Controllers\MahasiswaController;
use App\Controllers\ProdiController;
use App\Controllers\RolesController;
use App\Controllers\UserController;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Middleware\AuthMiddleware;

// Fungsi utilitas untuk render view
function renderView(Response $response, string $viewPath, array $data = []): Response
{
    // Pastikan path file tidak berbahaya
    $filePath = realpath(__DIR__ . '/../resources/views/' . $viewPath);

    // Validasi: apakah file ada dan berada di folder views
    if (!$filePath || strpos($filePath, realpath(__DIR__ . '/../resources/views/')) !== 0) {
        $response->getBody()->write("File view '{$viewPath}' tidak valid atau tidak ditemukan.");
        return $response->withHeader('Content-Type', 'text/plain')->withStatus(404);
    }

    try {
        // Bersihkan semua buffer yang ada untuk mencegah output sebelumnya
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        // Mulai output buffering
        ob_start();

        // Ekstrak data menjadi variabel
        extract($data);

        // Sertakan file view
        require $filePath;

        // Ambil hasil output buffer
        $output = ob_get_clean();

        // Tulis output ke response body
        $response->getBody()->write($output);
        return $response->withHeader('Content-Type', 'text/html')->withStatus(200);
    } catch (\Throwable $e) {
        // Tangani error saat rendering view
        $response->getBody()->write("Terjadi kesalahan saat merender view: " . $e->getMessage());
        return $response->withHeader('Content-Type', 'text/plain')->withStatus(500);
    }
}

// Landing Page
$app->get('/', function (Request $request, Response $response) {
    return renderView($response, 'pages/landing.php');
});

// Auth Group Routes
$app->group('/auth', function ($auth) {
    // Login Page Route
    $auth->get('/login', function (Request $request, Response $response) {
        return renderView($response, 'pages/auth/login.php');
    });

    $auth->get('/test', function (Request $request, Response $response) {
        return renderView($response, 'pages/mahasiswa/dashboard.php');
    });

    // Login API Route
    $auth->post('/login', function (Request $request, Response $response) {
        $authController = new AuthController();
        return $authController->login($request, $response); // Delegate to AuthController
    });

    // Logout Route
    $auth->get('/logout', function (Request $request, Response $response) {
        $authController = new AuthController();
        return $authController->logout($request, $response); // Delegate to AuthController
    });
});

// Dashboard untuk admin
$app->group('/admin', function ($admin) {
    $admin->get('/dashboard', function (Request $request, Response $response) {
        return renderView($response, 'pages/admin/dashboard.php');
    });

    $admin->get('/roles', function (Request $request, Response $response) {
        $rolesController = new RolesController();
        return $rolesController->index($request, $response);
    });

    // Mendapatkan data pengguna berdasarkan ID
    $admin->get('/users/{user_id}', function (Request $request, Response $response, array $args) {
        $usersController = new UserController(); // Controller untuk pengguna
        return $usersController->show($request, $response, $args); // Kirim seluruh $args
    });

    $admin->get('/users', function (Request $request, Response $response) {
        $usersController = new UserController(); // Controller untuk pengguna
        $users = $usersController->index($request, $response); // Kirim seluruh $args
        return renderView($response, 'pages/admin/users.php', ['users' => $users]);
    });

    // Manage Pengguna
    $admin->map(['POST', 'DELETE', 'PUT'], '/users[/{user_id}]', function (Request $request, Response $response, array $args) {
        $userController = new UserController();

        // Jika metode adalah POST, proses tambah pengguna
        if ($request->getMethod() === 'POST') {
            return $userController->store($request, $response);
        }

        // Jika metode adalah DELETE, hapus pengguna
        if ($request->getMethod() === 'DELETE') {
            // Pastikan ID pengguna ada dalam args
            if (isset($args['user_id'])) {
                // Mengirimkan args sebagai array ke metode delete
                return $userController->delete($request, $response, $args);
            } else {
                // Menggunakan getBody()->write() untuk menulis ke dalam respons
                $response->getBody()->write('User ID is required for deletion.');
                return $response->withStatus(400);
            }
        }

        // Jika metode adalah PUT, update pengguna
        if ($request->getMethod() === 'PUT') {
            // Pastikan ID pengguna ada dalam args
            if (isset($args['user_id'])) {
                // Panggil metode update di UserController
                return $userController->update($request, $response, $args);
            } else {
                // ID pengguna diperlukan untuk pembaruan
                $response->getBody()->write(json_encode([
                    'success' => false,
                    'message' => 'User ID is required for update.',
                ]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
            }
        }
        // Jika metode tidak dikenal, kembalikan error
        $response->getBody()->write(json_encode([
            'success' => false,
            'message' => 'Invalid request method.',
        ]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(405);
    });

    // Get Program Studi
    $admin->get('/program-studi', function (Request $request, Response $response) {
        $prodiController = new ProdiController();
        return $prodiController->index($request, $response);
    });

    // untuk Dropdown isi NIM pada mahasiswa, datanya dari tabel user
    $admin->get('/for-mahasiswa', function (Request $request, Response $response) {
        $usersController = new UserController(); // Controller untuk pengguna
        return $usersController->getForMahasiswaDropdown($request, $response);
    });

    // Get mahasiswa by id
    $admin->get('/mahasiswa/{nim}', function (Request $request, Response $response, array $args) {
        $mahasiswaController = new MahasiswaController(); // Controller untuk mahasiswa
        return $mahasiswaController->show($request, $response, $args); // Kirim seluruh $args
    });

    // Get all mahasiswa
    $admin->get('/mahasiswa', function (Request $request, Response $response) {
        $mahasiswaController = new MahasiswaController(); // Controller untuk mahasiswa
        $mahasiswa = $mahasiswaController->index($request, $response); // Kirim seluruh $args
        return renderView($response, 'pages/admin/mahasiswa.php', ['mahasiswa' => $mahasiswa]);
    });

    // Manage Mahasiswa
    $admin->map(['POST', 'DELETE', 'PUT'], '/mahasiswa[/{nim}]', function (Request $request, Response $response, array $args) {
        $mahasiswaController = new MahasiswaController();

        // Jika metode adalah POST, proses tambah mahasiswa
        if ($request->getMethod() === 'POST') {
            return $mahasiswaController->store($request, $response);
        }

        // Jika metode adalah DELETE, hapus mahasiswa
        if ($request->getMethod() === 'DELETE') {
            // Pastikan nim mahasiswa ada dalam args
            if (isset($args['nim'])) {
                // Mengirimkan args sebagai array ke metode delete
                return $mahasiswaController->delete($request, $response, $args);
            } else {
                // Menggunakan getBody()->write() untuk menulis ke dalam respons
                $response->getBody()->write('NIM is required for deletion.');
                return $response->withStatus(400);
            }
        }

        // Jika metode adalah PUT, update mahasiswa
        if ($request->getMethod() === 'PUT') {
            // Pastikan nim mahasiswa ada dalam args
            if (isset($args['nim'])) {
                // Panggil metode update di mahasiswaController
                return $mahasiswaController->update($request, $response, $args);
            } else {
                // nim mahasiswa diperlukan untuk pembaruan
                $response->getBody()->write(json_encode([
                    'success' => false,
                    'message' => 'NIM is required for update.',
                ]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
            }
        }
        // Jika metode tidak dikenal, kembalikan error
        $response->getBody()->write(json_encode([
            'success' => false,
            'message' => 'Invalid request method.',
        ]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(405);
    });

    $admin->get('/for-dosen', function (Request $request, Response $response) {
        $usersController = new UserController(); // Controller untuk pengguna
        return $usersController->getForDosenDropdown($request, $response);
    });

    $admin->get('/dosen/{nip}', function (Request $request, Response $response, array $args) {
        $dosenController = new DosenController(); // Controller untuk mahasiswa
        return $dosenController->show($request, $response, $args); // Kirim seluruh $args
    });

    // Get all dosen
    $admin->get('/dosen', function (Request $request, Response $response) {
        $dosenController = new DosenController(); // Controller untuk dosen
        $dosen = $dosenController->index($request, $response); // Kirim seluruh $args
        return renderView($response, 'pages/admin/dosen.php', ['dosen' => $dosen]);
    });

    // Manage Dosen
    $admin->map(['POST', 'DELETE', 'PUT'], '/dosen[/{nip}]', function (Request $request, Response $response, array $args) {
        $dosenController = new DosenController();

        // Jika metode adalah POST, proses tambah dosen
        if ($request->getMethod() === 'POST') {
            return $dosenController->store($request, $response);
        }

        // Jika metode adalah DELETE, hapus dosen
        if ($request->getMethod() === 'DELETE') {
            // Pastikan nip dosen ada dalam args
            if (isset($args['nip'])) {
                // Mengirimkan args sebagai array ke metode delete
                return $dosenController->delete($request, $response, $args);
            } else {
                // Menggunakan getBody()->write() untuk menulis ke dalam respons
                $response->getBody()->write('NIP is required for deletion.');
                return $response->withStatus(400);
            }
        }

        // Jika metode adalah PUT, update dosen
        if ($request->getMethod() === 'PUT') {
            // Pastikan nip dosen ada dalam args
            if (isset($args['nip'])) {
                // Panggil metode update di dosenController
                return $dosenController->update($request, $response, $args);
            } else {
                // nip dosen diperlukan untuk pembaruan
                $response->getBody()->write(json_encode([
                    'success' => false,
                    'message' => 'NIP is required for update.',
                ]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
            }
        }
        // Jika metode tidak dikenal, kembalikan error
        $response->getBody()->write(json_encode([
            'success' => false,
            'message' => 'Invalid request method.',
        ]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(405);
    });

    // // Validasi Prestasi
    // $admin->get('/validasi-prestasi', function (Request $request, Response $response) {
    //     $prestasiController = new PrestasiController();
    //     $prestasi = $prestasiController->index($request, $response);

    //     // Decode hasil JSON dari PrestasiController
    //     $dataPrestasi = json_decode((string)$prestasi->getBody(), true);
    //     return renderView($response, 'pages/admin/prestasi.php', ['prestasi' => $dataPrestasi]);
    // });

    // Lihat Ranking Mahasiswa
    $admin->get('/ranking', function (Request $request, Response $response) {
        return renderView($response, 'pages/admin/rank.php');
    });
    $admin->get('/prestasi', function (Request $request, Response $response) {
        return renderView($response, 'pages/admin/prestasi.php');
    });

    // // Export Prestasi
    // $admin->post('/export-prestasi', function (Request $request, Response $response) {
    //     $prestasiController = new PrestasiController();
    //     return $prestasiController->export($request, $response);
    // });
})->add(new AuthMiddleware(3)); // Role admin



// Dashboard untuk dosen pembimbing
$app->group('/dosbim', function ($dosbim) {
    $dosbim->get('/dashboard', function (Request $request, Response $response) {
        return renderView($response, 'pages/dosen/dashboard.php');
    });
    $dosbim->get('/ranking', function (Request $request, Response $response) {
        return renderView($response, 'pages/dosen/ranking.php');
    });
});
// ->add(new AuthMiddleware(2));


// Dashboard untuk mahasiswa
$app->group('/mahasiswa', function ($mahasiswa) {
    $mahasiswa->get('/dashboard', function (Request $request, Response $response) {
        return renderView($response, 'pages/mahasiswa/dashboard.php');
    });
    $mahasiswa->get('/prestasi', function (Request $request, Response $response) {
        return renderView($response, 'pages/mahasiswa/listPres.php');
    });

    // Manage Prestasi
    $mahasiswa->map(['POST', 'DELETE', 'PUT'], '/prestasi[/{nip}]', function (Request $request, Response $response, array $args) {
        $dosenController = new DosenController();

        // Jika metode adalah POST, proses tambah dosen
        if ($request->getMethod() === 'POST') {
            return $dosenController->store($request, $response);
        }

        // Jika metode adalah DELETE, hapus dosen
        if ($request->getMethod() === 'DELETE') {
            // Pastikan nip dosen ada dalam args
            if (isset($args['nip'])) {
                // Mengirimkan args sebagai array ke metode delete
                return $dosenController->delete($request, $response, $args);
            } else {
                // Menggunakan getBody()->write() untuk menulis ke dalam respons
                $response->getBody()->write('NIP is required for deletion.');
                return $response->withStatus(400);
            }
        }

        // Jika metode adalah PUT, update dosen
        if ($request->getMethod() === 'PUT') {
            // Pastikan nip dosen ada dalam args
            if (isset($args['nip'])) {
                // Panggil metode update di dosenController
                return $dosenController->update($request, $response, $args);
            } else {
                // nip dosen diperlukan untuk pembaruan
                $response->getBody()->write(json_encode([
                    'success' => false,
                    'message' => 'NIP is required for update.',
                ]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
            }
        }
        // Jika metode tidak dikenal, kembalikan error
        $response->getBody()->write(json_encode([
            'success' => false,
            'message' => 'Invalid request method.',
        ]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(405);
    });
});
// ->add(new AuthMiddleware(1));

// Dashboard untuk Ketua Jurusan (Kajur)
$app->group('/kajur', function ($kajur) {
    $kajur->get('/dashboard', function (Request $request, Response $response) {
        return renderView($response, 'pages/kajur/dashboard.php');
    });
})->add(new AuthMiddleware(4));