<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Information\IInformationService;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    protected IInformationService $informationSer;

    public function __construct(IInformationService $informationSer)
    {
        $this->informationSer = $informationSer;
    }

    public function index(Request $request)
    {
        $information = $this->informationSer->getAll($request);
        return view('pages.information', compact('information'));
    }

    public function edit(int $id)
    {
        $response =  $this->informationSer->edit($id);
        $info = $response['info'];
        $countries = $response['countries'];

        return view('forms.form-information', compact('info', 'countries'));
    }

    public function update(Request $request, int $id)
    {
        $response = $this->informationSer->update($request, $id);

        if ($response["status"]) {
            return redirect()->route('web.information')->with('response', $response);
        }
        return redirect()->back()->with("errors", $response["errors"]);
    }
}
