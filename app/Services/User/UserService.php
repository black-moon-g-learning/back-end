<?php

namespace App\Services\User;

use App\Repositories\User\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService implements IUserService
{
    protected IUserRepository $userRepo;

    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        return $this->userRepo->getUserWithoutAdmin();
    }

    public function delete(int $id): array
    {
        $deletedUser = $this->userRepo->delete($id);

        if ($deletedUser) {
            return [
                "status" => true,
                "message" => "Delete successful"
            ];
        }

        return [
            "status" => false,
            "message" => "Can not delete this user"
        ];
    }

    public function update(Request $request): array
    {
        $user = Auth::user();
        $userInfo = $request->all();
        $userInfo['username'] = $userInfo['email'];
        
        $result =  $this->userRepo->update($user->id, $userInfo);

        if ($result) {

            return [
                'status' => true,
                'message' => "Update successful"
            ];
        }

        return [
            'status' => false,
            'message' => "Can not update now"
        ];
    }
}
