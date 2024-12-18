<?php

namespace App\Services;

class PaymentService
{
    public function createPayment($data)
    {
        //Thanh toán vnPay
        // $order_id = $data['order_id'];

        $order_id = 1;

        // $order_info = $data['order_info'];

        $order_info = "Thanh toán đơn hàng";

        // $amount = $data['amount'];

        $amount = 100000;

        // $vnpayConfig = config('app.VnPay_url');

        // $vnp_TmnCode = config('app.VnPay_tmncode'); // Mã website tại VNPAY

        // $vnp_HashSecret = config('app.VnPay_hash_secret'); // Chuỗi bí mật

        // $vnp_Url = config('app.VnPay_url');

        // $vnp_ReturnUrl = config('app.VnPay_return_url');

        $vnp_TmnCode = "8MYXNMCB";

        $vnp_HashSecret = "80BOPTR3P0LPEEZ3LO3EY75SZU8GNGIW";

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";

        $vnp_ReturnUrl = "http://localhost:8000/api/v1/vnpay-return";

        $vnp_TxnRef = $order_id; // Mã đơn hàng

        $vnp_OrderInfo = $order_info; // Thông tin đơn hàng

        // $vnp_OrderType = 'billpayment';

        $vnp_Amount = $amount * 100; // Số tiền thanh toán (nhân với 100 để chuyển sang đơn vị VNĐ)

        $vnp_Locale = 'vn';

        $startTime = date("YmdHis");

        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));// Thời gian hết hạn của link thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            // "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            // "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$expire,
        );

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


    public function vnPayReturn($data=[]){

        $vnp_HashSecret = config('app.VnPay_hash_secret');

        $inputData = array();

        return $data;

        // foreach ($data as $key => $value) {
        //     if (substr($key, 0, 4) == "vnp_") {
        //         $inputData[$key] = $value;
        //     }
        // }

    }
}
