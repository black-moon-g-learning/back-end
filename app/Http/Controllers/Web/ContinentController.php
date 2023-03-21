<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Continent\IContinentService;
use Illuminate\Http\Request;

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
        return view('forms.form-continent', compact('continent'));
    }

    public function update(Request $request, $id)
    {
        $response = $this->continentSer->update($request, $id);;

        if ($response["status"]) {
            return redirect()->route('web.continents')->with('response', $response);
        }
        return redirect()->back()->with("errors", $response["errors"]);
    }
}
