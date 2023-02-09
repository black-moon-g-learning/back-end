<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class ContinentController extends Controller
{
    public function index()
    {
        return view('pages.continents');
    }
}
