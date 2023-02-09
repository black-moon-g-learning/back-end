<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Services\Auth\IAuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected IAuthService $auth;

    public function __construct(IAuthService $auth)
    {
        $this->auth = $auth;
    }

    /**
     * register
     *
     * @return void
     */
    public function register()
    {
        return view('pages.register');
    }

    /**
     * loginGet
     *
     * @return void
     */
    public function loginGet()
    {
        return view('pages.login');
    }

    /**
     * loginPost
     *
     * @param  Request $request
     * @return void
     */
    public function loginPost(Request $request)
    {
        $response =  $this->auth->login($request);
        if (!$response['status']) {
            return redirect()->back()->with('errors', $response['errors']);
        }
        return redirect()->route('web.dashboard');
    }
    
    /**
     * logout
     *
     * @return void
     */
    public function logout()
    {
        $this->auth->logout();
        return  redirect()->route('web.login.get');
    }
}
