<?php

namespace App\Http\Controllers\Web;

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
        $levels = $this->levelSer->indexAdmin();
        return view('pages.levels', compact('levels'));
    }

    public function create()
    {
        return view('forms.level');
    }

    public function edit(int $id)
    {
        $level =  $this->levelSer->edit($id);
        return view('forms.level', compact('level'));
    }

    public function update(Request $request, int $id)
    {
        $response = $this->levelSer->update($request, $id);

        if ($response['status']) {
            return redirect()->route('web.levels')->with('response', $response);
        }
        return redirect()->back()->with('errors', $response['data']);
    }

    public function store(Request $request)
    {
        $response = $this->levelSer->store($request);

        if ($response['status']) {
            return redirect()->route('web.levels')->with('response', $response);
        }
        return redirect()->back()->with('errors', $response['data']);
    }
}
