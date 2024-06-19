<?php

namespace App\Payments;

use App\Interfaces\PaymentStrategy;

class BoletoPayment implements PaymentStrategy
{
    public function pay(float $amount): bool
    {
        echo "Processing $amount using Boleto.";
        return true;
    }
}
