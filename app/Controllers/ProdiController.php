<?php

namespace App\Controllers;

use App\Models\ProdiModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ProdiController extends Controller
{
    protected ProdiModel $prodiModel;

    public function __construct()
    {
        $this->prodiModel = new ProdiModel();
    }
    public function index(Request $request, Response $response)
    {
        $prodi = $this->prodiModel->getAllProdi();

        if (!empty($prodi)) {
            $response->getBody()->write(json_encode($prodi));
        } else {
            $response->getBody()->write(json_encode(["error" => "No Program Studi found"]));
        }

        return $response->withHeader('Content-Type', 'application/json');
    }
}