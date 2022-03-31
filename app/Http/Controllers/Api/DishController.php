<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use App\DishOrder;

class DishController extends Controller
{
    public function top4Sales() {

        $allDishOrder = DishOrder::all();
        $allDish = Dish::all();
        $dishPopularityArray = [];

        foreach ($allDish as $dish) {

            $dishOrders = DishOrder::where('dish_id', $dish->id)->get();
            $saledDish = 0;
            foreach ($dishOrders as $dishOrder) {
                $saledDish += $dishOrder->amount; 
            }
            $dishPopularityArray[] = [
                'id'=> $dish->id,
                'name'=> $dish->name,
                'popularity'=> $saledDish,
            ];
            
            
        }
        
        $result = collect($dishPopularityArray)->sortByDesc('popularity');
         
        
        return response()->json(
            [
                'response' => true,
                'results' => $result->values()->take(4), 
            ]);
    }
}
