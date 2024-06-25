<?php

namespace App\Jobs;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\HttpFoundation\Response;
use App\Payments\PaymentContext;
use Illuminate\Support\Facades\DB;

class ProcessPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function handle()
    {
        try {
            DB::beginTransaction();
            $paymentStrategy = app($this->payment->payment_method);
            $paymentContext = new PaymentContext($paymentStrategy);
            $result = $paymentContext->executePayment($this->payment->amount);
            $this->payment->update(['status' => 'processed']);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        return response()->json(['success' => $result]);
    }
}
