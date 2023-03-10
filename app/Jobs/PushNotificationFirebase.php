<?php

namespace App\Jobs;

use App\Constants\Common;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PushNotificationFirebase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $data;

    public array $headers;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $headers, string $data)
    {
        $this->headers = $headers;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, Common::FCM_ENDPOINT);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data);

        $result = curl_exec($ch);

        if (!$result) {
            Log::debug('Curl failed: ' . curl_error($ch));
        }
        Log::debug($result);

        curl_close($ch);
    }
}
