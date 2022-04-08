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
            // Route::get('/mystats', 'Api\StatsControllerApi@myOrderStats');
        }
    );

Route::post('checkout', 'Checkout\PaymentController@paymentFunction')->name('payment');

Route::get('{any?}', function ($name = null) {
    return view('guest.welcome', ['appUrl' => config('app.asset_url')]);
})->where('any', '.*')->name('guests');
