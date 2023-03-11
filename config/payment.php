<?php

return [
    'PAYMENT_NAME' => env('PAYMENT_NAME', 'VN_PAY'),

    //access vnpay to get this information
    'WEBSITE_ID' => env('VNP_TMNCODE'),
    'SECRET_KEY' => env('VNP_HASHSECRECT'),
    'PAYMENT_URL' => env('VNP_URL')
];
