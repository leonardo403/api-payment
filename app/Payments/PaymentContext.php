<?php

namespace App\Payments;
use App\Interfaces\PaymentStrategy;

class PaymentContext
{
    private $paymentStrategy;

    public function __construct(PaymentStrategy $paymentStrategy)
    {
        $this->paymentStrategy = $paymentStrategy;
    }

    public function executePayment(float $amount): bool
    {
        return $this->paymentStrategy->pay($amount);
    }
}
