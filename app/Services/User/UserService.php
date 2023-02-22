<?php

namespace App\Services\User;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\User\IUserRepository;
use App\Services\Storage\IStorageService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class UserService implements IUserService
{
    protected IUserRepository $userRepo;

    protected IStorageService $storeSer;

    protected array $successUpdate =  [
        'status' => true,
        'message' => "Update successful"
    ];

    protected array $failedUpdate = [
        'status' => false,
        'message' => "Can not update now"
    ];

    public function __construct(
        IUserRepository $userRepo,
        IStorageService $storeSer
    ) {
        $this->userRepo = $userRepo;
        $this->storeSer = $storeSer;
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

    public function update(UserRequest $request): array
    {
        $user = Auth::user();
        $userInfo = $request->all();

        if ($request->hasFile('file')) {
            return $this->updateWithFile($request->file('file'), $user);
        }

        $result = $this->updateWithoutFile($userInfo, $user);

        if ($result) {
            return $this->successUpdate;
        }
        return $this->failedUpdate;
    }

    public function updateWithFile(UploadedFile $file, User $user): array
    {
        if ($this->storeSer->exists($user->image)) {
            $this->storeSer->delete($user->image);
        }

        $uploaded = $this->storeSer->upload($file, 'users');

        if ($uploaded['status']) {
            $userInfo['image'] = $uploaded['url'];
            $this->userRepo->update($user->id, $userInfo);

            return $this->successUpdate;
        }

        return $this->failedUpdate;;
    }

    public function updateWithoutFile(array $userInfo, User $user): bool
    {
        $userInfo['username'] = $userInfo['email'];
        $user = $this->userRepo->update($user->id, $userInfo);

        if ($user) {
            return true;
        }
        return false;
    }
}
