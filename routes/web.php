<?php

use App\Controllers\AuthController;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Middleware\AuthMiddleware;

// Fungsi utilitas untuk render view
function renderView(Response $response, string $viewPath): Response
{
    $filePath = __DIR__ . '/../resources/views/' . $viewPath;
    if (file_exists($filePath)) {
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
        return renderView($response, 'pages/auth/test.php');
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
        if ($request->getMethod() === 'POST') {
            // Proses tambah pengguna
            // Ambil data dari form
            $data = $request->getParsedBody();
            // Logika untuk menyimpan data pengguna (misalnya ke database)
            return $response->withHeader('Location', '/admin/dashboard')->withStatus(302);
        }
        return renderView($response, 'pages/admin/tambahPengguna.php');
    });

    // Tambah Mahasiswa
    $admin->map(['GET', 'POST'], '/tambah-mahasiswa', function (Request $request, Response $response) {
        if ($request->getMethod() === 'POST') {
            // Proses tambah mahasiswa
            $data = $request->getParsedBody();
            return $response->withHeader('Location', '/admin/dashboard')->withStatus(302);
        }
        return renderView($response, 'pages/admin/tambahPengguna.php');
    });

    // Tambah Dosen
    $admin->map(['GET', 'POST'], '/tambah-dosen', function (Request $request, Response $response) {
        if ($request->getMethod() === 'POST') {
            // Proses tambah dosen
            $data = $request->getParsedBody();
            return $response->withHeader('Location', '/admin/dashboard')->withStatus(302);
        }
        return renderView($response, 'pages/admin/tambah_dosen.php');
    });

    // Validasi Prestasi
    $admin->get('/validasi-prestasi', function (Request $request, Response $response) {
        return renderView($response, 'pages/admin/validasi_prestasi.php');
    });

    // Lihat Ranking Mahasiswa
    $admin->get('/lihat-ranking', function (Request $request, Response $response) {
        return renderView($response, 'pages/admin/lihat_ranking.php');
    });

    $admin->post('/export-prestasi', function (Request $request, Response $response) {
        // Proses export data
        // Logika untuk meng-export data prestasi mahasiswa ke file (Excel/CSV)
        return $response->withHeader('Content-Type', 'application/octet-stream')
            ->withHeader('Content-Disposition', 'attachment; filename="prestasi_mahasiswa.csv"');
    });
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
})->add(new AuthMiddleware(1));

// Dashboard untuk Ketua Jurusan (Kajur)
$app->group('/kajur', function ($kajur) {
    $kajur->get('/dashboard', function (Request $request, Response $response) {
        return renderView($response, 'pages/kajur/dashboard.php');
    });
})->add(new AuthMiddleware(4));