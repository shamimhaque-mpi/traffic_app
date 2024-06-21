<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\MoackResponseRequest;

class MockResponseController extends Controller
{
    public function mockResponse(MoackResponseRequest $request)
    {
        $status = $request->header('X-Mock-Status');

        if ($status === 'accepted') {
            return response()->json(['status' => 'accepted'], Response::HTTP_OK);
        } else {
            return response()->json(['status' => 'failed'], Response::HTTP_BAD_REQUEST);
        }
    }
}
