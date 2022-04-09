<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use App\DishOrder;
use App\User;
use App\Category;
use App\DishImage;
use Illuminate\Support\Facades\DB;




class DishController extends Controller
{
    public function top4Sales()
    {
        $allDish = Dish::where('visibility', '1')->get();
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
            $image = '';
            if ($user->image) {
                $image = asset('storage/' . $user->image);
            }
            $results[] = [
                'name' => $user->name,
                'img' => $image,
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

    public function restaurantMenu()
    {
        $slug = $_GET['restaurant'];
        $restaurant = User::where('slug', $slug)->first();
        $dishes = Dish::where('user_id', $restaurant->id)->where('visibility', '1')->get();

        $image = '';
        if ($restaurant->image) {
            $image = asset('storage/' . $restaurant->image);
        }

        $results = [
            'restaurant' => [
                'name' => $restaurant->name,
                'slug' => $restaurant->slug,
                'image' => $image,
                'address' => $restaurant->address,
            ],
            'dishes' => [],
        ];

        foreach ($dishes as $dish) {

            $imageArray = [];
            foreach (DishImage::where('dish_id', $dish->id)->get() as $dishimage) {
                $imageArray[] = asset('storage/' . $dishimage->img_path);
            }
            $results['dishes'][] = [
                'name' => $dish->name,
                'slug' => $dish->slug,
                'description' => $dish->description,
                'image' => $imageArray,
                'price' => $dish->price,
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
