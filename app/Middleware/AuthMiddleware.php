<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class AuthMiddleware
{
    private int $requiredRole;

    public function __construct(int $requiredRole)
    {
        $this->requiredRole = $requiredRole;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        // Memastikan sesi dimulai jika belum aktif
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        error_log("AuthMiddleware invoked. Required role: {$this->requiredRole}");

        // Periksa apakah pengguna sudah login
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['role'])) {
            error_log("ACCESS DENIED: No user session or role found.");
            return $this->denyAccess();
        }

        // Periksa apakah role pengguna sesuai
        $userRole = (int)$_SESSION['user']['role'];
        if ($userRole < $this->requiredRole) {
            error_log("ACCESS DENIED: Role mismatch. User role: {$userRole}, Required role: {$this->requiredRole}");
            return $this->denyAccess();
        }

        error_log("ACCESS GRANTED: User role {$userRole} matches required role {$this->requiredRole}.");
        return $handler->handle($request);
    }

    private function denyAccess(): Response
    {
        $response = new \Slim\Psr7\Response();
        $response->getBody()->write(json_encode([
            'success' => false,
            'error' => 'forbidden',
            'message' => 'Anda tidak memiliki akses ke halaman ini!',
        ], JSON_PRETTY_PRINT));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(403);
    }
}