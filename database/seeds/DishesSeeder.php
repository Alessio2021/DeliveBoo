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
        
        // 1 ciclo -> su tutti i piatti che devono essere presenti nel nostro sito - UNICI
        foreach ($dishes as $dish) {
            
            // prelevo le categorie dal file dishes.php di quel determinato piatto
            $dishCategories = $dish['categoria'];

            // conto i ristoranti per singola categoria, dal piatto da cui parto e li inserisco nell array
            $dishCategoriesCounter = [];
            foreach ($dishCategories as $dishCategory) {
                $dishCategoriesCounter[] = User::join('category_user', 'category_user.user_id', '=', 'users.id')->join('categories', 'categories.id', '=', 'category_user.category_id')->where('categories.name', $dishCategory)->count();
            
            }
            // assegno un numero rand di copie tra 1 e il max -> (dei ristoranti per singola categoria) 2 ita e 5 cinesi, prendo 5
            $randCopy = rand(1, max($dishCategoriesCounter));
            for ($i=0; $i < $randCopy; $i++) { 
                $newDish = new Dish();

                // ogni volta prendo un ristorante casuale
                $rand = rand(0, count($restaurants) - 1);
                $check = false;
                // controllo che sia compatibile con la categoria se non e' compatibile continuo la ricerca
                while ($check == false) {
                    $rand = rand(0, count($restaurants) - 1);
                    foreach ($dish['categoria'] as $category) {   /*controllo se la categoria e' quella giusta*/
                        if (in_array($category, $restaurants[$rand]['categoria'])) {
                            $check = true;
                        }
                    }
                }
                // se il piatto non e' inserito nel ristorante, lo creo e lo inserisco
                if (empty(Dish::where('name', $dish['nome'])->where('user_id', $rand + 1)->first())) {
                    $newDish->description = $dish['descrizione'];
                    $newDish->user_id = $rand + 1;
                    $newDish->name = $dish['nome'];
        
                    $newDish->price = $dish['prezzo'];
                    if (rand(0, 9) == 0) {              /*visibilita'*/
                        $newDish->visibility = false;
                    } else {
                        $newDish->visibility = true;
                    }
                    // salvo il piatto
                    $newDish->slug = Dish::slugGenerator($newDish->name, $newDish->user_id);
                    $newDish->image = $newDish->slug;
                    $newDish->save();

                    // se l array di immagini, appartenente al piatto selezionato NON E' VUOTO, ci ciclo dentro, 
                    // prendo il nome dell imagine, costruisco il path e lo carico nel DB. importiamo il collegamento con l id del piatto
                    if (!empty($dish['img'])) {
                        foreach ($dish['img'] as $image) {
                            $newDishImage = new DishImage();

                            // nome cartella dove si trova l img / immagine.formato
                            $newDishImage->img_path = 'Our_faker_img/Dishes/' . strtolower(str_replace("'", "", str_replace(' ', '-', $dish['nome']))) . "/" . $image;
                            $newDishImage->dish_id = $newDish->id;
                            $newDishImage->save();
                        }
                    }
                }
            }
        }
    }
}
