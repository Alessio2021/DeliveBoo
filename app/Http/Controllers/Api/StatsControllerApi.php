<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatsControllerApi extends Controller
{
    public function myOrderStats()
    {
        $myOrders = DB::table('orders')
        ->join('dish_order', 'orders.id', '=', 'dish_order.order_id')
        ->join('dishes', 'dishes.id', '=', 'dish_order.dish_id')
        ->select('orders.*')->where('user_id', Auth::user()->id)->get();

        $results = [];

        foreach ($myOrders as $myOrder) {
            $results[] = [
                'total_amount' => $myOrder->total_amount,
                'created_at' => $myOrder->created_at,
            ];
        }
        return response()->json(
            [
                'response' => true,
                'results' => $results,
            ]
        );
    }
}
