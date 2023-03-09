<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function expiredTrial()
    {
        $response = [
            'status' => false,
            'message' => 'Please pay to continue using the service'
        ];

        return $this->responseErrorWithData($response, 403);
    }

    public function blocked()
    {
        $response = [
            'status' => false,
            'message' => "Your account was blocked, please contact to admin",
        ];

        return $this->responseErrorWithData($response, 423);
    }
}
