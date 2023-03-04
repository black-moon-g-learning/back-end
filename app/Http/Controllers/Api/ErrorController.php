<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function expiredTrial()
    {
        $response = [
            'status' => 'false',
            'message' => 'Please pay to continue using the service'
        ];

        return $this->responseErrorWithData($response, 403);
    }
}
