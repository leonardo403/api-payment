<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
use App\Jobs\ProcessPaymentJob;
use Symfony\Component\HttpFoundation\Response;


class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'buyer_document' => 'required|string',
            'produto_id' => 'required|integer|exists:products,id',
        ]);

        $payment = Payment::create($validatedData);

        Queue::push(new ProcessPaymentJob($payment));

        return response()->json([
                "status"  => "processing",
                "message" => "Payment request received and is being processed."], Response::HTTP_ACCEPTED);
    }
}
