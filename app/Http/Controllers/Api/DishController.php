<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use App\DishOrder;
use App\User;
use App\Category;
use App\DishImage;

class DishController extends Controller
{
    public function top4Sales()
    {

        $allDishOrder = DishOrder::all();
        $allDish = Dish::all();
        $dishPopularityArray = [];

        foreach ($allDish as $dish) {

            $dishOrders = DishOrder::where('dish_id', $dish->id)->get();
            $saledDish = 0;
            foreach ($dishOrders as $dishOrder) {
                $saledDish += $dishOrder->amount;
            }

            $imageArray = [];
            foreach (DishImage::where('dish_id', $dish->id)->get() as $dishimage) {
                $imageArray[] = asset('storage/' . $dishimage->img_path);
            }

            $restaurant = User::where('id', $dish->user_id)->first();

            $dishPopularityArray[] = [
                'slug' => $dish->slug,
                'restaurant_slug' => $restaurant->slug,
                'restaurant_name' => $restaurant->name,
                'name' => $dish->name,
                'price' => $dish->price,
                'image_array' => $imageArray,
                'popularity' => $saledDish,
            ];
        }

        $results = collect($dishPopularityArray)->sortByDesc('popularity');


        return response()->json(
            [
                'response' => true,
                'results' => $results->values()->take(4),
            ]
        );
    }

    public function last3Users()
    {
        $users = User::orderBy('created_at', 'desc')->limit(3)->get();
        $results = [];
        foreach ($users as $user) {
            $results[] = [
                'name' => $user->name,
                'img' => asset('storage/' . $user->image),
                'slug' => $user->slug
            ];
        }
        return response()->json(
            [
                'response' => true,
                'results' => $results,
            ]
        );
    }

    public function categories()
    {
        $categories = Category::all();
        $results = [];
        foreach ($categories as $category) {
            $results[] = [
                'name' => $category->name,
                'img' => asset('img/icone/' . $category->image),
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
