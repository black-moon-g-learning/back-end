<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Level\ILevelService;

class LevelController extends Controller
{
    protected ILevelService $levelSer;

    public function __construct(ILevelService $levelSer)
    {
        $this->levelSer = $levelSer;
    }
    public function index()
    {
        $levels = $this->levelSer->indexAdmin();
        return view('pages.levels', compact('levels'));
    }
}
