<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\User\IUserRepository;
use App\Utils\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use Response;

    protected $userRepo;

    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getProfile()
    {

        return new UserResource($this->userRepo->getProfile(3));
    }
}
