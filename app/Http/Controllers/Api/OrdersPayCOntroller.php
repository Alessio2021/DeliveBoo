<?php

namespace App\Http\Controllers\Api;

use Braintree\Gateway;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersPayCOntroller extends Controller
{
    public function generate(Request $request, Gateway $gateway)
    {
        $gateway->clientToken()->generate();
        dd($gateway->clientToken()->generate());
        return 'generate';
    }

    public function makePayment(Request $request, Gateway $gateway)
    {

        return 'makePayment';
    }
}
