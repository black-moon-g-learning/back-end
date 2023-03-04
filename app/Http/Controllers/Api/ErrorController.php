<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function expiredTrial()
    {
        $response = [];

        return $this->responseSuccessWithData($response);
    }
}
