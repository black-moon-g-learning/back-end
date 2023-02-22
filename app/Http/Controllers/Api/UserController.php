<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\User\IUserService;
use App\Utils\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use Response;

    protected IUserService $userSer;

    public function __construct(IUserService $userSer)
    {
        $this->userSer = $userSer;
    }

    public function getProfile(Request $request)
    {
        return response()->json(new UserResource($request->user()));
    }

    public function update(UserRequest $request)
    {
        $response =  $this->userSer->update($request);
        if ($response['status']) {
            return $this->responseSuccessWithData($response);
        } else {
            return $this->responseErrorWithData($response);
        }
    }
}
