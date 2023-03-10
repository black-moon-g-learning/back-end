<?php

namespace App\Services\Notification;

use App\Constants\Common;
use App\Constants\Information;
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
        if ($request->has('token')) {
            $user = auth()->user();
            $user->device_token = $request->token;
            $user->save();

            return [
                'status' => true,
                'message' => 'Save device token successful'
            ];
        }

        return [
            'status' => false,
            'message' => 'Not found device Token'
        ];
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

        $this->pushByCurl($headers, $dataString);

        return [
            'status' => true,
            'data' => "Sending info for all users"
        ];
    }


    public function setupNotificationContent(int $infoId): array
    {
        $infoDB = $this->infoRepo->find($infoId);
        $infoUpdate['status'] = Information::PUBLISHED;

        $this->infoRepo->update($infoId, $infoUpdate);

        return [
            "title" =>  handleLongText($infoDB->title, 25),
            "body" =>  handleLongText($infoDB->description, 50)
        ];
    }

    public function pushByCurl(array $headers, string $data)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,  $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($ch);

        curl_close($ch);
        Log::debug($response);
        return $response;
    }
}
