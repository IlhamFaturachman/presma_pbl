<?php

use App\Controllers\AuthController;
use App\Controllers\UserController;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Middleware\AuthMiddleware;

// Fungsi utilitas untuk render view
function renderView(Response $response, string $viewPath, array $data = []): Response
{
    $filePath = __DIR__ . '/../resources/views/' . $viewPath;
    if (file_exists($filePath)) {
        extract($data); // Mengekstrak array menjadi variabel
        ob_start(); // Mulai output buffering
        require $filePath; // Sertakan file view
        $output = ob_get_clean(); // Ambil hasil buffer dan bersihkan buffer
        $response->getBody()->write($output); // Tulis output ke body response
        return $response->withHeader('Content-Type', 'text/html')->withStatus(200);
    } else {
        $response->getBody()->write("File view '{$viewPath}' tidak ditemukan.");
        return $response->withHeader('Content-Type', 'text/plain')->withStatus(404);
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
        return renderView($response, 'component/tabel_rank.php');
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

    // Tambah Pengguna
    $admin->map(['GET', 'POST'], '/tambah-pengguna', function (Request $request, Response $response) {
        $userController = new UserController();

        if ($request->getMethod() === 'POST') {
            // Proses tambah pengguna menggunakan UserController
            return $userController->store($request, $response);
        }

        // Ambil daftar pengguna
        $users = $userController->index($request, $response);

        // Render halaman dengan daftar pengguna
        return renderView($response, 'pages/admin/tambahPengguna.php', ['users' => $users]);
    });

    // Tambah Mahasiswa
    // $admin->map(['GET', 'POST'], '/tambah-mahasiswa', function (Request $request, Response $response) {
    //     $mahasiswaController = new MahasiswaController();

    //     if ($request->getMethod() === 'POST') {
    //         // Proses tambah mahasiswa menggunakan MahasiswaController
    //         return $mahasiswaController->store($request, $response);
    //     }

    //     return renderView($response, 'pages/admin/tambah_mahasiswa.php');
    // });

    // // Tambah Dosen
    // $admin->map(['GET', 'POST'], '/tambah-dosen', function (Request $request, Response $response) {
    //     $dosenController = new DosenController();

    //     if ($request->getMethod() === 'POST') {
    //         // Proses tambah dosen menggunakan DosenController
    //         return $dosenController->store($request, $response);
    //     }

    //     return renderView($response, 'pages/admin/tambah_dosen.php');
    // });

    // // Validasi Prestasi
    // $admin->get('/validasi-prestasi', function (Request $request, Response $response) {
    //     $prestasiController = new PrestasiController();
    //     $prestasi = $prestasiController->index($request, $response);

    //     // Decode hasil JSON dari PrestasiController
    //     $dataPrestasi = json_decode((string)$prestasi->getBody(), true);
    //     return renderView($response, 'pages/admin/validasi_prestasi.php', ['prestasi' => $dataPrestasi]);
    // });

    // // Lihat Ranking Mahasiswa
    // $admin->get('/lihat-ranking', function (Request $request, Response $response) {
    //     $rankingController = new RankingController();
    //     $ranking = $rankingController->index($request, $response);

    //     // Decode hasil JSON dari RankingController
    //     $dataRanking = json_decode((string)$ranking->getBody(), true);
    //     return renderView($response, 'pages/admin/lihat_ranking.php', ['ranking' => $dataRanking]);
    // });

    // // Export Prestasi
    // $admin->post('/export-prestasi', function (Request $request, Response $response) {
    //     $prestasiController = new PrestasiController();
    //     return $prestasiController->export($request, $response);
    // });
})->add(new AuthMiddleware(3)); // Role admin



// Dashboard untuk dosen pembimbing
$app->group('/dosbim', function ($dosbim) {
    $dosbim->get('/dashboard', function (Request $request, Response $response) {
        return renderView($response, 'pages/dosbim/dashboard.php');
    });
})->add(new AuthMiddleware(2));

// Dashboard untuk mahasiswa
$app->group('/mahasiswa', function ($mahasiswa) {
    $mahasiswa->get('/dashboard', function (Request $request, Response $response) {
        return renderView($response, 'pages/mahasiswa/dashboard.php');
    });
    $mahasiswa->get('/listPres', function (Request $request, Response $response) {
        return renderView($response, 'pages/mahasiswa/listPres.php');
    });
})->add(new AuthMiddleware(1));

// Dashboard untuk Ketua Jurusan (Kajur)
$app->group('/kajur', function ($kajur) {
    $kajur->get('/dashboard', function (Request $request, Response $response) {
        return renderView($response, 'pages/kajur/dashboard.php');
    });
})->add(new AuthMiddleware(4));