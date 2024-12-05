<?php

namespace App\Controllers;

use App\Models\RolesModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class RolesController extends Controller
{
    protected RolesModel $rolesModel;

    public function __construct()
    {
        $this->rolesModel = new RolesModel();
    }
    public function index(Request $request, Response $response)
    {
        $users = $this->rolesModel->getAllRoles();

        if (!empty($users)) {
            $response->getBody()->write(json_encode($users));
        } else {
            $response->getBody()->write(json_encode(["error" => "No roles found"]));
        }

        return $response->withHeader('Content-Type', 'application/json');
    }
}