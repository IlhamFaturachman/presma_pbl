<?php

namespace App\Controllers;

use App\Models\ValidasiModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ValidasiController extends Controller
{
    protected ValidasiModel $validasiModel;

    public function __construct()
    {
        $this->validasiModel = new ValidasiModel();
    }

    // Validasi prestasi
    public function validPrestasi(Request $request, Response $response, array $args): Response
    {
        $prestasiId = (int) $args['prestasi_id'];
        $body = $request->getParsedBody();
        $infoValidasi = $body['info_validasi'] ?? '';

        if (!$infoValidasi) {
            $payload = ['success' => false, 'message' => 'Alasan validasi tidak boleh kosong'];
            $response->getBody()->write(json_encode($payload));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $result = $this->validasiModel->validPrestasiById($prestasiId, $infoValidasi);

        if ($result) {
            $payload = ['success' => true, 'message' => 'Prestasi berhasil divalidasi'];
        } else {
            $payload = ['success' => false, 'message' => 'Gagal memvalidasi prestasi'];
            $response = $response->withStatus(500);
        }

        $response->getBody()->write(json_encode($payload));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Menolak prestasi
    public function rejectPrestasi(Request $request, Response $response, array $args): Response
    {
        $prestasiId = (int) $args['prestasi_id'];
        $body = $request->getParsedBody();
        $infoValidasi = $body['info_validasi'] ?? '';

        if (!$infoValidasi) {
            $payload = ['success' => false, 'message' => 'Alasan penolakan tidak boleh kosong'];
            $response->getBody()->write(json_encode($payload));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $result = $this->validasiModel->rejectPrestasiById($prestasiId, $infoValidasi);

        if ($result) {
            $payload = ['success' => true, 'message' => 'Prestasi berhasil ditolak'];
        } else {
            $payload = ['success' => false, 'message' => 'Gagal menolak prestasi'];
            $response = $response->withStatus(500);
        }

        $response->getBody()->write(json_encode($payload));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
