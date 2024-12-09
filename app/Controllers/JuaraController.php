<?php

namespace App\Controllers;

use App\Models\JuaraModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class JuaraController extends Controller
{
    protected JuaraModel $juaraModel;

    public function __construct()
    {
        $this->juaraModel = new JuaraModel();
    }
    public function index(Request $request, Response $response)
    {
        $juara = $this->juaraModel->getAllJuara();

        if (!empty($juara)) {
            $response->getBody()->write(json_encode($juara));
        } else {
            $response->getBody()->write(json_encode(["error" => "No juara found"]));
        }

        return $response->withHeader('Content-Type', 'application/json');
    }
}
