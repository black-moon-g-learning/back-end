<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Services\Auth\AuthService;

class AuthController extends Controller
{

    protected $auth;

    /**
     * __construct
     *
     * @param  AuthService $auth
     * @return void
     */
    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }


    /**
     * login
     *
     * @param  AuthRequest $request
     * @return void
     */
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

    /**
     * register
     *
     * @param  AuthRequest $request
     * @return void
     */
    public function register(AuthRequest $request)
    {
        $response = $this->auth->register($request);
        return $this->responseSuccessWithData($response, 201);;
    }
}
