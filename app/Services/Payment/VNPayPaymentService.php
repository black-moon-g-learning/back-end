<?php

namespace App\Services\Payment;

use App\Constants\Process;
use App\Constants\User;
use App\Jobs\SendMail;
use App\Repositories\Package\IPackageRepository;
use App\Repositories\User\IUserRepository;
use App\Services\User\IUserService;
use App\Services\UserPayment\IUserPaymentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VNPayPaymentService implements IPaymentService
{
    protected IUserPaymentService $userPaymentSer;

    protected IPackageRepository $packageRepo;

    protected IUserRepository $userRepo;

    public function __construct(
        IUserPaymentService $userPaymentSer,
        IPackageRepository $packageRepo,
        IUserRepository $userRepo
    ) {
        $this->userPaymentSer = $userPaymentSer;
        $this->packageRepo = $packageRepo;
        $this->userRepo = $userRepo;
    }

    public function getUrl(Request $request): string
    {
        $user = Auth::user();
        $package = $this->packageRepo->getFirstRow();

        $vnp_TxnRef = date('YmdHis') .  $user->id; //Mã giao dịch. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "payment for G-LEARNING service";
        $vnp_Amount = $package->price * 100;
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
            "vnp_ReturnUrl" => route('return-payment'),
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

        $vnp_Url =  config('payment.PAYMENT_URL') . "?" . $query;
        if (config('payment.SECRET_KEY')) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashData);
            //$vnpSecureHash = hash('sha256', env('VNP_HASHSECRECT'). $hashData);
            $vnpSecureHash =   hash_hmac('sha512', $hashData, config('payment.SECRET_KEY')); //  
            // $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $this->userPaymentSer->create($vnp_TxnRef, $user->id, $package->id);

        return $vnp_Url;
    }

    public function checkIsPayMentSuccess(Request $request)
    {
        $inputData = array();
        $returnData = array();

        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, config('payment.SECRET_KEY'));
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $vnp_Amount = $inputData['vnp_Amount'] / 100; // Số tiền thanh toán VNPAY phản hồi

        $Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo URL thanh toán.
        $orderId = $inputData['vnp_TxnRef'];



        try {
            //Check Orderid    
            //Kiểm tra checksum của dữ liệu
            if ($secureHash == $vnp_SecureHash) {
                //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId            
                //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                //Giả sử: $order = mysqli_fetch_assoc($result);   
                $orderDB = $this->userPaymentSer->findPaymentByOrderId($orderId);

                if ($orderDB != NULL) {
                    if ($orderDB->service->price == $vnp_Amount) //Kiểm tra số tiền thanh toán của giao dịch: giả sử số tiền kiểm tra là đúng. //$order["Amount"] == $vnp_Amount
                    {
                        // if ($order["Status"] != NULL && $order["Status"] == 0) {
                        if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
                            $Status = 1; // Trạng thái thanh toán thành công
                        } else {
                            $Status = 2; // Trạng thái thanh toán thất bại / lỗi
                        }
                        //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB
                        //

                        if ($Status == 1) {
                            DB::transaction(function () use ($orderDB) {
                                $this->userPaymentSer->updateStatus(Process::SUCCESS, $orderDB->id);
                                $this->userRepo->update($orderDB->user_id, ['expired' => null]);
                            });

                            if (isset($orderDB->user) && $orderDB->user->email !== null) {

                                $data = array();
                                $data['user'] = getUsername($orderDB->user);
                                $data['email'] =  $orderDB->user->email == 'admin@gmail.com' ||  $orderDB->user->email == null ?   User::DEFAULT_MAIL : $orderDB->user->email;
                                $data['price'] = $orderDB->service->price;
                                SendMail::dispatch($data);
                            }
                        } else if ($Status == 2) {
                            $this->userPaymentSer->updateStatus(Process::FAIL, $orderDB->id);
                        }
                        //
                        //Trả kết quả về cho VNPAY: Website/APP TMĐT ghi nhận yêu cầu thành công                
                        $returnData['RspCode'] = '00';
                        $returnData['Message'] = 'Confirm Success';
                        // } else {
                        //     $returnData['RspCode'] = '02';
                        //     $returnData['Message'] = 'Order already confirmed';
                        // }
                    } else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'invalid amount';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Invalid signature';
            }
        } catch (Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknown error';
        }

        return $returnData;
    }

    public function returnPayment(Request $request): array
    {
        $vnp_SecureHash = $request->get('vnp_SecureHash');
        $inputData = array();
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, config('payment.SECRET_KEY'));
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $response['data'] =  "GD Thanh cong";
                $response['status'] = true;
            } else {
                $response['data']  = "GD Khong thanh cong";
                $response['status'] = false;
            }
        } else {
            $response['data']  = "Chu ky khong hop le";
            $response['status'] = false;
        }
        return $response;
    }
}
