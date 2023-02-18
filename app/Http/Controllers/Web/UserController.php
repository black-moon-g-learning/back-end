<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\User\IUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected IUserService $userSer;

    public function __construct(IUserService $userSer)
    {
        $this->userSer = $userSer;
    }

    public function index()
    {
        $users = $this->userSer->index();
        return view('pages.users', compact('users'));
    }

    public function delete(int $id)
    {
        return $id;
    }
}
