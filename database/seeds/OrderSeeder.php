<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Order;
use App\Dish;
use Faker\Generator as Faker;


class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // creo 20 ordini
        for ($i=0; $i < 20; $i++) { 
            $randRestaurant = User::inRandomOrder()->first();       /* estraggo rist a caso */
            $randRestaurantDishes = Dish::where('user_id', $randRestaurant->id)->get();    /* carico tutti i piatti del rist estratto */

            $newOrder = new Order();
            $newOrder->guest_address = $faker->address();
            $newOrder->payment_method = $faker->creditCardType();
            $newOrder->total_amount = 0;
            $newOrder->save();
            
            $totalPrice = 0;
            foreach ($randRestaurantDishes as $randRestaurantDish) {          /* giro in tutti i piatti di quel rist */

                $randBuy = rand(0,1);
                if ($randBuy) { /* possibilita di scelta al bot */
                    $rand = rand(1, 5);
                    $newOrder->dishes()->save($randRestaurantDish, ['amount'=> $rand, 'history_price' => $randRestaurantDish->price]); /* qui relaziono i dati della pivot con quelli aggiuntivi */
                    $totalPrice += $rand * $randRestaurantDish->price; /* moltiplico il prezzo per le quantita' */
                    
                }
            }
            if ($totalPrice === 0) { /* se un rist ha 0 ordini.. forzo l ordine per almeno 1 piatto */
                $rand = rand(1, 5);
                /* indice di un piatto random */
                $randDishIndex = rand(0, count($randRestaurantDishes) - 1);
                /* qui relaziono i dati della pivot con quelli aggiuntivi */
                $newOrder->dishes()->save($randRestaurantDishes[$randDishIndex], ['amount' => $rand, 'history_price' => $randRestaurantDishes[$randDishIndex]->price]); 
                $totalPrice += $rand * $randRestaurantDishes[$randDishIndex]->price; /* 
                moltiplico il prezzo per le quantita' */
            }
            $newOrder->total_amount = $totalPrice;
            $newOrder->update();
        }
    }
}
