<?php

namespace App\Interfaces;

interface PaymentStrategy
{
    public function pay(float $amount): bool;
}
