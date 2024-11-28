<?php

// Landing Page
$app->get('/', function ($request, $response) {
    include __DIR__ . '/../resources/views/pages/landing.php'; // Path absolut
    return $response;
});

// Auth Group Routes
$app->group('/auth', function ($auth) {
    $auth->get('/login', function ($request, $response) {
        include __DIR__ . '/../resources/views/pages/auth/login.php'; // Path absolut
        return $response;
    });
    $auth->get('/logout', function ($request, $response) {
        include __DIR__ . '/../resources/views/pages/auth/logout.php'; // Path absolut
        return $response;
    });
});