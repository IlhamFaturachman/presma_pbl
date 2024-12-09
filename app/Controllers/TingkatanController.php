<?php

namespace App\Controllers;

use App\Models\TingkatanModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class TingkatanController extends Controller
{
    protected TingkatanModel $tingkatanModel;

    public function __construct()
    {
        $this->tingkatanModel = new TingkatanModel();
    }
    public function index(Request $request, Response $response)
    {
        $tingkatan = $this->tingkatanModel->getAllTingkatan();

        if (!empty($tingkatan)) {
            $response->getBody()->write(json_encode($tingkatan));
        } else {
            $response->getBody()->write(json_encode(["error" => "No tingkatan found"]));
        }

        return $response->withHeader('Content-Type', 'application/json');
    }
}
