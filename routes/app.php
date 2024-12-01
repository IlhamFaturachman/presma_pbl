<?php
// app/app.php

use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

// Create the app instance
$app = AppFactory::create();

// Mengatur base path sesuai dengan folder public
$app->setBasePath('/presma_pbl/public');

// Menambahkan middleware untuk parsing body
$app->addBodyParsingMiddleware();

// Memasukkan semua rute (routes) yang diperlukan
require_once __DIR__ . '/web.php'; // Mengimpor routing web

// Menjalankan aplikasi
$app->run();