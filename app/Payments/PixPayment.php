<?php

namespace App\Payments;

use App\Interfaces\PaymentStrategy;

class PixPayment implements PaymentStrategy
{
    public function pay(float $amount): bool
    {
        echo "Processing $amount using PIX.";
        return true;
    }
}
