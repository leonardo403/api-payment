<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
use App\Jobs\ProcessPaymentJob;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\PaymentRequest;


class PaymentController extends Controller
{
    public function processPayment(PaymentRequest $request)
    {
        $validatedData = $request->validated();

        $payment = Payment::create($validatedData);

        Queue::push(new ProcessPaymentJob($payment));

        return response()->json([
                "status"  => "processing",
                "message" => "Payment request received and is being processed."], Response::HTTP_ACCEPTED);
    }
}
