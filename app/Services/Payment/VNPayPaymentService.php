<?php

namespace App\Services\Payment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VNPayPaymentService implements IPaymentService
{
    public function getUrl(Request $request): string
    {
        $user = Auth::user();

        $vnp_TxnRef = date('YmdHis') .  $user->id; //Mã giao dịch. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "payment for G-LEARNING service";
        $vnp_Amount = 9999900;
        $vnp_Locale = 'vn';
        // $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $vnPay_Data = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => config('payment.WEBSITE_ID'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_ReturnUrl" => route('home'),
            "vnp_TxnRef" => $vnp_TxnRef,

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $vnPay_Data['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($vnPay_Data);
        $query = "";
        $i = 0;
        $hashData = "";
        foreach ($vnPay_Data as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . $key . "=" . $value;
            } else {
                $hashData .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = env('VNP_URL') . config('payment.PAYMENT_URL') . "?" . $query;
        if (config('payment.SECRET_KEY')) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashData);
            //$vnpSecureHash = hash('sha256', env('VNP_HASHSECRECT'). $hashData);
            $vnpSecureHash =   hash_hmac('sha512', $hashData, config('payment.SECRET_KEY')); //  
            // $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }
}
