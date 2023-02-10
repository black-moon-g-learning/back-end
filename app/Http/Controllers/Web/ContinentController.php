<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Continent\IContinentRepository;
use App\Services\Continent\IContinentService;
use Aws\History;

class ContinentController extends Controller
{
    protected IContinentService $continentSer;

    public function __construct(IContinentService $continentSer)
    {
        $this->continentSer = $continentSer;
    }

    public function index()
    {
        $continents =  $this->continentSer->index();
        return view('pages.continents', compact('continents'));
    }

    public function edit(int $id)
    {
        $continent = $this->continentSer->edit($id);
        return view('pages.form', compact('continent'));
    }
}
