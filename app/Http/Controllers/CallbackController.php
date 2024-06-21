<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Transaction;
use App\Http\Requests\UpdateTransactionRequest;

class CallbackController extends Controller
{
    public function updateTransaction(UpdateTransactionRequest $request, $transactionId)
    {
        $status = $request->only('status');

        $transaction = Transaction::find($transactionId);

        if (!$transaction) {
            return response()->json(['error' => 'Transaction not found'], Response::HTTP_NOT_FOUND);
        }

        $transaction->update(['status'=>$status]);

        return response()->json(['message' => 'Transaction updated successfully']);
    }
}
