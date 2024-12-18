<?php

namespace App\Repositories\Payment;

interface PaymentRepositoryInterface{
    public function createPayment($attributes = []);
}
