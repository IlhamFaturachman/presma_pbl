<?php

namespace App\Controllers;

use App\Models\RankModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class RankController extends Controller
{
    protected RankModel $rankModel;

    public function __construct()
    {
        $this->rankModel = new RankModel();
    }

    // get all data rank
    public function index(Request $request, Response $response)
    {
        return $rank = $this->rankModel->getAllRank();
    }
}