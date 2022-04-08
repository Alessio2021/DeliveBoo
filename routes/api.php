<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/top-sales', 'Api\DishController@top4Sales');

Route::get('/last-users', 'Api\DishController@last3Users');

Route::get('/categories', 'Api\DishController@categories');

Route::get('/category', 'Api\CategoriesController@getCategoryRestaurants');

Route::get('/menu', 'Api\DishController@restaurantMenu');

// pagamenti //
Route::get('/orders/generate', 'Api\OrdersPayController@generate');
Route::post('/orders/make', 'Api\OrdersPayController@makePayment');

// ordini //
Route::get('/mystats', 'Api\StatsControllerApi@myOrderStats');

