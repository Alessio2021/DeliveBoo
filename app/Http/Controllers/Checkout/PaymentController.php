<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;

use App\User;
use App\Dish;
use App\Order;

class PaymentController extends Controller
{
    public function paymentFunction()
    {
        // if (!empty($_POST["data"]) && !empty($_POST["payment_method_nonce"]) && $_POST["address"]) {
        if (!empty($_POST["data"]) && !empty($_POST["payment_method_nonce"])) {
            $data = json_decode($_POST["data"], true);
            $nonceFromTheClient = $_POST["payment_method_nonce"];
            $address = $_POST["address"];
            $guest_email = $_POST["guest_email"];
            $cardType = $_POST["card_type"];
            $amount = 0;

            $checkDishesOnDataBase = true;

            $order = new Order();
            $order->guest_address = $address;

            foreach ($data['dishes'] as $dish) {
                $dishInOrder = Dish::where('user_id', User::where('slug', $data['restaurant']['slug'])->first()->id)->where('slug', $dish['slug'])->first();
                if (!empty($dishInOrder)) {
                    $amount += $dishInOrder->price * $dish['amount'];
                } else {
                    $checkDishesOnDataBase = false;
                }
            }

            if ($checkDishesOnDataBase) {
                $gateway = new Gateway([
                    'environment' => 'sandbox',
                    'merchantId' => '6kkmvpfqh8n88bbj',
                    'publicKey' => 'bnct3wd7sk8scnsv',
                    'privateKey' => '35c10fb92992c1374aa6e6aa95e86c7f'
                ]);

                $result = $gateway->transaction()->sale([
                    'amount' => $amount,
                    'paymentMethodNonce' => $nonceFromTheClient,
                    'options' => [
                        'submitForSettlement' => True
                    ]
                ]);

                if ($result->success) {
                    $order->payment_method = $cardType;
                    $order->total_amount = $amount;
                    $order->save();

                    foreach ($data['dishes'] as $dish) {
                        $dishInOrder = Dish::where('user_id', User::where('slug', $data['restaurant']['slug'])->first()->id)->where('slug', $dish['slug'])->first();
                        $order->dishes()->attach($dishInOrder, ['amount' => $dish['amount'], 'history_price' => $dishInOrder->price]);
                    }

                    return redirect()->route('guests')->with('status', "Pagamento Effettuato");
                } else {
                    return redirect()->route('guests')->with('status', "Problemi con il Pagamento");
                }
            } else {
                return redirect()->route('guests')->with('status', "Ordine Non Valido");
            }
        } else {
            return redirect()->route('guests');
        }
    }
}
