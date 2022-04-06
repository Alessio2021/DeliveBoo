<?php

namespace App\Http\Controllers\Api;

use Braintree\Gateway;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersPayController extends Controller
{
    public function generate(Request $request, Gateway $gateway)
    {
        $token = $gateway->clientToken()->generate();
        $data = [
            'token' => $token
        ];

        return response()->json(
            [
                'response' => true,
                'results' => $data,
            ]
        );
    }

    public function makePayment(Request $request, Gateway $gateway)
    {
        $result = $gateway->transaction()->sale([
            'amount' => '5.00',
            'paymentMethodNonce' => $request->token,
            'option' => [
                'submitForSettlment' => true
            ]
        ]);

        if ($result->success) {

            $data = [
                'message' => 'ok'
            ];
            return response()->json(
                [
                    'response' => true,
                    'results' => $data,
                ]
            );
        } else {

            $data = [
                'message' => 'ko'
            ];
            return response()->json(
                [
                    'response' => true,
                    'results' => $data,
                ]
            );
        }
    }
}
