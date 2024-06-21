<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MockResponseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CallbackController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/mock-response', [MockResponseController::class, 'mockResponse'])->name('mock.response');
Route::post('/process-payment', [PaymentController::class, 'processPayment']);
Route::post('/callback/{transactionId}', [CallbackController::class, 'updateTransaction']);

