<?php

namespace App\Controllers;

use App\Models\UserModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class UserController extends Controller
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Override index method for listing users
    public function index(Request $request, Response $response)
    {
        return $users = $this->userModel->getAllUsers();
        // $response->getBody()->write(json_encode($users));
        // return $response->withHeader('Content-Type', 'application/json');
    }

    // Override show method for fetching user by ID
    public function show(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $user = $this->userModel->getUserById($id);
        if ($user) {
            $response->getBody()->write(json_encode($user));
        } else {
            $response->getBody()->write(json_encode(["error" => "User not found"]));
        }
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Override store method for creating a new user
    public function store(Request $request, Response $response)
    {
        $data = json_decode($request->getBody(), true);
        $result = $this->userModel->addUser($data);
        $response->getBody()->write(json_encode(["success" => $result]));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Override update method for updating user data
    public function update(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $data = json_decode($request->getBody(), true);
        $result = $this->userModel->updateUser($id, $data);
        $response->getBody()->write(json_encode(["success" => $result]));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Override delete method for removing a user
    public function delete(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $result = $this->userModel->deleteUser($id);
        $response->getBody()->write(json_encode(["success" => $result]));
        return $response->withHeader('Content-Type', 'application/json');
    }
}