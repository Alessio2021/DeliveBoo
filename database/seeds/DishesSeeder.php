<?php

use Illuminate\Database\Seeder;
use App\Dish;
use App\User;
use App\DishImage;



class DishesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $data = ['dishes' => config(dishes')];
        $dishes = config("dataSeeder.dishes");
        $restaurants = config("dataSeeder.restaurants");
        

        foreach ($dishes as $dish) {
            $dishCategories = $dish['categoria'];
            $dishCategoriesCounter = [];
            foreach ($dishCategories as $dishCategory) {
                $dishCategoriesCounter[] = User::join('category_user', 'category_user.user_id', '=', 'users.id')->join('categories', 'categories.id', '=', 'category_user.category_id')->where('categories.name', $dishCategory)->count();
            
            }
            $randCopy = rand(1, max($dishCategoriesCounter));
            for ($i=0; $i < $randCopy; $i++) { 
                $newDish = new Dish();
                $rand = rand(0, count($restaurants) - 1);
                $check = false;
    
                while ($check == false) {
                    $rand = rand(0, count($restaurants) - 1);
    
                    foreach ($dish['categoria'] as $category) {
                        if (in_array($category, $restaurants[$rand]['categoria'])) {
                            $check = true;
                        }
                    }
                }

                if (empty(Dish::where('name', $dish['nome'])->where('user_id', $rand + 1)->first())) {
                    $newDish->description = $dish['descrizione'];
                    $newDish->user_id = $rand + 1;
                    $newDish->name = $dish['nome'];
        

                    $newDish->price = $dish['prezzo'];
                    if (rand(0, 9) == 0) {
                        $newDish->visibility = false;
                    } else {
                        $newDish->visibility = true;
                    }
                    $newDish->slug = Dish::slugGenerator($newDish->name, $newDish->user_id);
                    $newDish->image = $newDish->slug;
                    $newDish->save();

                    // carico piu img per piatto, se disponibili
                    if (!empty($dish['img'])) {
                        foreach ($dish['img'] as $image) {
                            $newDishImage = new DishImage();

                            // slug della foto = nome cartella / nome dell'image
                            $newDishImage->img_path = Dish::slugGenerator($newDish->name, $newDish->user_id) . "/" . $image;
                            $newDishImage->dish_id = $newDish->id;
                            $newDishImage->save();
                        }
                    }

                }
            }
        }

    }
}
