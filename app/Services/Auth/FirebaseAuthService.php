<?php

namespace App\Services\Auth;

use App\Constants\AuthStatus;
use App\Constants\Gender;
use App\Constants\Role;
use App\Constants\SocialMediaProvider;
use App\Constants\User;
use App\Repositories\User\IUserRepository;
use Carbon\Carbon;
use Firebase\Auth\Token\Exception\InvalidToken;

class FirebaseAuthService implements IAuthService
{
    protected IUserRepository $userRepo;

    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login(mixed $request): array
    {
        if ($request->has('token')) {
            $auth = app('firebase.auth');
            $token =  $request->input('token');
            try {
                $verifiedToken = $auth->verifyIdToken($token);
            } catch (\InvalidArgumentException $e) {
                return response()->json([
                    'message' => 'Unauthorized - Can\'t parse the token: ' . $e->getMessage()
                ], 401);
            } catch (InvalidToken $e) {
                return response()->json([
                    'message' => 'Unauthorized - Token is invalide: ' . $e->getMessage()
                ], 401);
            }
            $uid = $verifiedToken->claims()->get('sub');
            $userInfoFireBase = $auth->getUser($uid);

            $existUser = $this->userRepo->findByFirebaseUid($uid);

            if ($existUser) {
                $user = $existUser;
                $authStatus = AuthStatus::LOGIN;
            } else {

                $userInfo['username'] =  $userInfoFireBase->uid;
                $userInfo['role_id'] = Role::USER_ROLE;
                $userInfo['provider_id'] = SocialMediaProvider::GOOGLE;
                $userInfo['image'] = $userInfoFireBase->photoUrl;
                $userInfo['gender'] = Gender::OTHER;
                $userInfo['email'] = $userInfoFireBase->providerData[0]->email ?? null;
                $userInfo['first_name'] =  $userInfoFireBase->displayName;
                $userInfo['firebase_uid'] =  $uid;
                $userInfo['expired'] = Carbon::now()->addDays(7)->toDateTimeString();
                $userInfo['status'] = User::ACTIVE_STATUS;
                $userInfo['device_token'] = $request->get('device_token') ?? null;

                $user = $this->userRepo->create($userInfo);

                $authStatus = AuthStatus::REGISTER;
            }


            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addWeek();
            $token->save();

            if ($user->status === User::BLOCKED_STATUS) {
                return [
                    'status' => false,
                    'code' => 423
                ];
            } else {
                return [
                    'auth_status' =>  $authStatus,
                    'status' => true,
                    'id' => $user->id,
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                        $tokenResult->token->expires_at
                    )->toDateTimeString()
                ];
            }
        }
    }

    public function register(mixed $request): array
    {
        return [];
    }

    public function logout()
    {
        return 3;
    }
}
