<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller

{
    public function getCategoryRestaurants()
    {
        if (!empty($_GET['categories'])) {
            $requestArray = explode(',', $_GET['categories']);

            $firstFilter = [];

            foreach ($requestArray as $request) {
                $filterdRestaurants = DB::table('users')
                    ->join('category_user', 'users.id', '=', 'category_user.user_id')
                    ->join('categories', 'categories.id', '=', 'category_user.category_id')
                    ->select('users.*')->where('categories.name', $request)->get();
                foreach ($filterdRestaurants as $restaurant) {
                    if (count($firstFilter)) {
                        $put = true;
                        foreach ($firstFilter as &$value) {
                            if ($value['slug'] == $restaurant->slug) {
                                $value['filterIndex'] = $value['filterIndex'] + 1;
                                $put = false;
                            }
                        }
                        if ($put) {
                            $firstFilter[] = [
                                'name' => $restaurant->name,
                                'slug' => $restaurant->slug,
                                'email' => $restaurant->email,
                                'image' => $restaurant->image,
                                'filterIndex' => 1,
                            ];
                        }
                    } else {
                        $firstFilter[] = [
                            'name' => $restaurant->name,
                            'slug' => $restaurant->slug,
                            'email' => $restaurant->email,
                            'image' => $restaurant->image,
                            'filterIndex' => 1,
                        ];
                    }
                }
            }

            $restaurants = [];
            foreach ($firstFilter as $allFilteredRestaurant) {
                $image = '';
                if ($allFilteredRestaurant['image']){
                    $image = asset('storage/' . $allFilteredRestaurant['image']);
                }
                if ($allFilteredRestaurant['filterIndex'] == count($requestArray)) {
                    $restaurants[] = [
                        'name' => $allFilteredRestaurant['name'],
                        'slug' => $allFilteredRestaurant['slug'],
                        'email' => $allFilteredRestaurant['email'],
                        'image' => $image,
                    ];
                }
            }

            if (count($restaurants) != 0) {
                $results = [];
                foreach ($restaurants as $restaurant) {
                    $results[] = [
                        'name' => $restaurant['name'],
                        'slug' => $restaurant['slug'],
                        'email' => $restaurant['email'],
                        'image' => $restaurant['image'],
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
            $restaurants = User::orderBy('name')->get();
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
