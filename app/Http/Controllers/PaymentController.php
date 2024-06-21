<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Models\Transaction;
use App\Http\Requests\ProcessPaymentRequest;

class PaymentController extends Controller
{
    public function processPayment(ProcessPaymentRequest $request)
    {
        // Call the mock response API
        $response = Http::withHeaders([
            'X-Mock-Status' => $request->header('X-Mock-Status', 'accepted')
        ])->get(route('mock.response'));
        

        $status = $response->json()['status']??'accepted1';
        $data   = $request->only('user_id', 'amount');
        //
        $data['status'] = $status;
        
        // Store transaction
        if($status=='accepted')
        {
            $transaction = Transaction::create($data);
            return response()->json([
                'transaction_id' => $transaction->id,
                'status' => $data['status']
            ])->header('Cache-Control', 'no-store');
        }
        return response()->json(['status' => 'failed'], Response::HTTP_BAD_REQUEST);
    }
}
