<?php

namespace App\Services\Notification;

use Illuminate\Http\Request;

interface INotificationService
{
    public function saveToken(Request $request);

    public function sendNotification(int $infoId);
}
