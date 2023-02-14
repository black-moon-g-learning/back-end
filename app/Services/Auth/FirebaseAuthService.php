<?php

namespace App\Services\Auth;

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
            } else {

                $userInfo['username'] = $userInfoFireBase->email;
                $userInfo['role_id'] = Role::USER_ROLE;
                $userInfo['provider_id'] = SocialMediaProvider::GOOGLE;
                $userInfo['image'] = $userInfoFireBase->photoUrl;
                $userInfo['gender'] = Gender::OTHER;
                $userInfo['email'] = $userInfoFireBase->email;
                // $userInfo['password'] = "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi";
                $userInfo['first_name'] =  $userInfoFireBase->displayName;
                $userInfo['firebase_uid'] =  $uid;

                $user = $this->userRepo->create($userInfo);
            }


            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addWeek();
            $token->save();

            return [
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

    public function register(mixed $request): array
    {
        return [];
    }

    public function logout()
    {
        return 3;
    }
}