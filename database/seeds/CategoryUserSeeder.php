<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\User;


class CategoryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = config("dataSeeder.restaurants");
        
        $categories = Category::all();
        foreach ($restaurants as $restaurant) {
            $user = User::where('name', $restaurant['nome'])->first();
            foreach ($restaurant['categoria'] as $item) {
                $user->categories()->attach($categories->where('name', $item));
            }

        }
    }
}
