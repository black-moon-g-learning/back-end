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

    public function index()
    {
        $information = $this->informationSer->getAll();
        return view('pages.information', compact('information'));
    }
}
