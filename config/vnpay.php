<?php

return [
    'vnp_TmnCode' => env('VNP_TMN_CODE'), // Mã Merchant
    'vnp_HashSecret' => env('VNP_HASH_SECRET'), // Chuỗi bí mật
    'vnp_Url' => 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html', // URL VNPay
    'vnp_ReturnUrl' => 'http://localhost:8080//vnpay_return'
];