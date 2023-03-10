<?php

namespace App\Http\Controllers;

use App\Services\Notification\INotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    protected INotificationService $notificationSer;

    public function __construct(INotificationService $notificationSer)
    {
        $this->notificationSer = $notificationSer;
    }

    public function index()
    {
        return view('pages.home');
    }
    public function saveToken(Request $request)
    {
        $response =  $this->notificationSer->saveToken($request);

        if ($response['status']) {
            return $this->responseSuccessWithData($response);
        } else {
            return $this->responseErrorWithData($response);
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function sendNotification(int $infoId)
    {
        $response = $this->notificationSer->sendNotification($infoId);
        return redirect()->route('web.information')->with('response', $response);
    }
}
