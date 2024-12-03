<?php

namespace App\Controllers;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class Controller
{
    // For get all data
    function index(Request $request, Response $response)
    {
        $response->getBody()->write(json_encode([
            "message" => "Index method not implemented"
        ]));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // For get data by id
    function show(Request $request, Response $response, array $args)
    {
        $response->getBody()->write(json_encode([
            "message" => "Show method not implemented"
        ]));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // For create data
    function store(Request $request, Response $response)
    {
        $response->getBody()->write(json_encode([
            "message" => "Store method not implemented"
        ]));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // For update data
    function update(Request $request, Response $response, array $args)
    {
        $response->getBody()->write(json_encode([
            "message" => "Update method not implemented"
        ]));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // For delete data
    function delete(Request $request, Response $response, array $args)
    {
        $response->getBody()->write(json_encode([
            "message" => "Delete method not implemented"
        ]));
        return $response->withHeader('Content-Type', 'application/json');
    }
}