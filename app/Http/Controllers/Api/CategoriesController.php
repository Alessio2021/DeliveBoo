<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller

{
    public function getCategoryRestaurants()
    {
        if ($_GET['category'] != "") {

            $categoryName = $_GET['category'];
            $restaurants = DB::table('users')
                ->join('category_user', 'users.id', '=', 'category_user.user_id')
                ->join('categories', 'categories.id', '=', 'category_user.category_id')
                ->select('users.*')->where('categories.name', $categoryName)
                ->get();

            if (count($restaurants) != 0) {
                $results = [];

                foreach ($restaurants as $restaurant) {
                    $results[] = [
                        'name' => $restaurant->name,
                        'slug' => $restaurant->slug,
                        'email' => $restaurant->email,
                        'image' => asset('storage/' . $restaurant->image),
                    ];
                }

                return response()->json(
                    [
                        'response' => true,
                        'results' => $results,
                    ]
                );
            } else {
                return response()->json(
                    [
                        'response' => false,
                    ]
                );
            }
        } else {
            $restaurants = User::inRandomOrder()->get();

            $results = [];
            foreach ($restaurants as $restaurant) {
                $results[] = [
                    'name' => $restaurant->name,
                    'slug' => $restaurant->slug,
                    'email' => $restaurant->email,
                    'image' => asset('storage/' . $restaurant->image),
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
}
