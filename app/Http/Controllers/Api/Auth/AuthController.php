<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    protected $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }


    public function login(AuthRequest $request)
    {
        $response = $this->auth->login($request);

        if ($response['status']) {
            return $this->responseSuccessWithData($response);
        }

        return $this->responseErrorWithData([
            'message' => 'Incorrect account or password information'
        ], 422);
    }

    public function register(AuthRequest $request)
    {
    }
}
