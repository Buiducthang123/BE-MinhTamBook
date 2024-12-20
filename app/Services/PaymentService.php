<?php

namespace App\Services;

class PaymentService
{
    public function createPayment($data)
    {
        //Thanh toán vnPay
        // $order_id = $data['order_id'];

        $order_id = $data['order_id'];

        // $amount = $data['amount'];

        $amount = 100000;

        $vnp_TmnCode = config('app.VnPay_tmncode'); // Mã website tại VNPAY

        $vnp_HashSecret = config('app.VnPay_hash_secret'); // Chuỗi bí mật

        $vnp_Url = config('app.VnPay_url'); // URL thanh toán

        // $vnp_ReturnUrl = config('app.VnPay_return_url'); // URL trả về sau khi thanh toán

        $vnp_ReturnUrl = $data['vnp_ReturnUrl'] ?? null;

        if($vnp_ReturnUrl== null){
            throw new \Exception('Vui lòng cung cấp URL trả về sau khi thanh toán');
        }

        $vnp_TxnRef = $order_id; // Mã đơn hàng

        $vnp_OrderInfo = $data['order_info']; // Thông tin đơn hàng

        $vnp_Amount = $amount * 100; // Số tiền thanh toán (nhân với 100 để chuyển sang đơn vị VNĐ)

        $vnp_Locale = 'vn';

        // $startTime = date("YmdHis");

        // $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate" => $expire,
            "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],
        ];

        // sắp xếp mảng theo key
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }


    public function checkPayment($data)
    {
        $vnp_HashSecret = config('app.VnPay_hash_secret'); // Chuỗi bí mật

        $vnp_SecureHash = $data['vnp_SecureHash'];

        $inputData = array();
        foreach ($data as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashdata = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

        if ($secureHash == $vnp_SecureHash) {
            return true;
        }
        return false;
    }
}
