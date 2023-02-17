<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Level\ILevelService;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    protected ILevelService $levelSer;

    public function __construct(ILevelService $levelSer)
    {
        $this->levelSer = $levelSer;
    }

    public function index()
    {
        $response = $this->levelSer->index();
        return $this->responseSuccessWithData($response);
    }
}
