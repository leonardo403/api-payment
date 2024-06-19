<?php

namespace App\Payments;

use App\Interfaces\PaymentStrategy;

class CartaoCreditoPayment implements PaymentStrategy
{
    public function pay(float $amount): bool
    {
        echo "Processing $amount using Cartao Credito.";
        return true;
    }
}
