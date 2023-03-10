<?php

namespace App\Services\Notification;

use App\Constants\Common;
use App\Jobs\PushNotificationFirebase;
use App\Repositories\Information\IInformationRepository;
use App\Repositories\User\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FirebaseNotificationService implements INotificationService
{
    protected IUserRepository $userRepo;

    protected IInformationRepository $infoRepo;

    public function __construct(
        IUserRepository $userRepo,
        IInformationRepository $infoRepo
    ) {
        $this->userRepo = $userRepo;
        $this->infoRepo = $infoRepo;
    }

    public function saveToken(Request $request)
    {
        $user = auth()->user();
        $user->device_token = $request->token;
        $user->save();

        return ['token saved successfully.'];
    }

    public function sendNotification(int $infoId)
    {
        $firebaseToken = $this->userRepo->getUserTokenDevice();

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => $this->setupNotificationContent($infoId)
        ];

        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . config('notification.SERVER_API_KEY'),
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, Common::FCM_ENDPOINT);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,   $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  $dataString);

        $result = curl_exec($ch);

        if (!$result) {
            Log::debug('Curl failed: ' . curl_error($ch));
        }
        Log::debug($result);

        dd($result);
        return [
            'status' => true,
            'data' => "Sending info for all users"
        ];
    }


    public function setupNotificationContent(int $infoId): array
    {
        $infoDB = $this->infoRepo->find($infoId);

        return [
            "title" =>  handleLongText($infoDB->title, 15),
            "body" =>  handleLongText($infoDB->description, 30)
        ];
    }
}
