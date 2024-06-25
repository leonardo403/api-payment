<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Support\Facades\{Queue,Schedule};
use App\Jobs\ProcessPaymentJob;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\PaymentRequest;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function processPayment(PaymentRequest $request)
    {
        $validatedData = $request->validated();
        try {
            DB::beginTransaction();
            $payment = Payment::create($validatedData);
            Queue::push(new ProcessPaymentJob($payment));
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        return response()->json([
                "status"  => "processing",
                "message" => "Payment request received and is being processed."], Response::HTTP_ACCEPTED);
    }
}
