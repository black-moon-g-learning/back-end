<?php

namespace App\Services\Auth;

use App\Constants\Gender;
use App\Constants\Role;
use App\Constants\SocialMediaProvider;
use App\Constants\User;
use App\Repositories\User\IUserRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService implements IAuthService
{
    protected $userRepo;

    /**
     * __construct
     *
     * @param  IUserRepository $userRepo
     * @return void
     */
    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * login
     *
     * @param  mixed $request
     * @return array
     */
    public function login(mixed $request): array
    {
        $credentials = $request->validated();

        if (Auth::attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password']
        ])) {

            $user = Auth::user();

            $token = $user->createToken('authToken')->plainTextToken;

            return [
                'status' => true,
                'token' => $token,
                'type' => 'Bearer Token'
            ];
        };
        return [
            'status' => false
        ];
    }


    /**
     * register
     *
     * @param  mixed $request
     * @return array
     */
    public function register(mixed $request): array
    {

        $userInfo = $this->setUpUserData($request->validated());

        $this->userRepo->create($userInfo);

        return  $userInfo;
    }

    /**
     * inputUserDefaultData
     *
     * @param  array $userInfo
     * @return array
     */
    public function setUpUserData(array $userInfo): array
    {

        $userInfo['role_id'] = Role::USER_ROLE;
        $userInfo['provider_id'] = SocialMediaProvider::DEFAULT;
        $userInfo['password'] = Hash::make($userInfo['password']);
        $userInfo['image'] = User::DEFAULT_PROFILE_IMAGE;
        $userInfo['gender'] = Gender::OTHER;

        unset($userInfo['password_confirm']);

        return $userInfo;
    }

    public function logout()
    {
        return true;
    }
}
