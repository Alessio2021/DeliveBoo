<?php

use Illuminate\Database\Seeder;
use App\Dish;

class DishesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newDish = new Dish();

        $newDish->user_id = 2;
        $newDish->name = "Dio e' cane";
        $newDish->image = 'jahdadhddaaaaaaaaaaha';
        $newDish->price = 2.05;
        $newDish->visibility = true;
        $newDish->slug = Dish::slugGenerator($newDish->name, $newDish->user_id);
        $newDish->save();
    }
}
