<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('guest.welcome');
// })->name('guest.index');

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(
        function () {
            Route::get('/', 'HomeController@index')->name('home');
            Route::resource('dishes', 'DishController');
            Route::get('orders', 'OrderController@index')->name('orders.index');
            Route::get('orders/{id}', 'OrderController@show')->name('orders.show');
            Route::get('stats', 'StatController@index')->name('stats');
        }
    );

Route::post('checkout', function () {
    $data = json_decode($_POST["data"], true);
    $nonceFromTheClient = $_POST["payment_method_nonce"];

    $amount = 0;
    foreach ($data['dishes'] as $dish) {
        $amount += $dish['price'] * $dish['amount'];
    }


    $gateway = new Braintree\Gateway([
        'environment' => 'sandbox',
        'merchantId' => '6kkmvpfqh8n88bbj',
        'publicKey' => 'bnct3wd7sk8scnsv',
        'privateKey' => '35c10fb92992c1374aa6e6aa95e86c7f'
    ]);

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonceFromTheClient,
        // 'deviceData' => $deviceDataFromTheClient,
        'options' => [
            'submitForSettlement' => True
        ]
    ]);

    if ($result->success) {
        // creare ordine
        // creare dishOrdine
        // mandare email al ristorante e al cliente

        // $order = new Order();
        // $order->user_id = User::where('slug', $data['restaurant']['slug'])->get()->id;
        return redirect()->route('guests')->with('status', "Pagamento Effettuato");
    } else {
        return redirect()->route('guests')->with('status', "Problemi con il Pagamento");
    }
})->name('payment');

Route::get('/pagamiento', function ($ciro) {
    return view('guest.pagamiento', ['ciro' => $ciro]);
})->name('pagamiento');

Route::get('{any?}', function ($name = null) {
    return view('guest.welcome', ['appUrl' => config('app.asset_url')]);
})->where('any', '.*')->name('guests');
