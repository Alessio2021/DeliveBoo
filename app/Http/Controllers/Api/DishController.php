<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use App\DishOrder;
use App\User;

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
        
        $results = collect($dishPopularityArray)->sortByDesc('popularity');
         
        
        return response()->json(
            [
                'response' => true,
                'results' => $results->values()->take(4), 
            ]);
    }

    public function last3Users() {
        $users = User::orderBy('created_at', 'desc')->limit(3)->get();
        $results= [];
        foreach ($users as $user) {
            $results[] = [
                'name'=> $user->name,
                'img'=> $user->image,
                'slug'=>$user->slug
            ];
        }
        return response()->json(
            [
                'response' => true,
                'results' => $results, 
            ]);
    }

    
}
