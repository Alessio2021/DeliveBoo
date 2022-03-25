<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $restaurants = config("dataSeeder.restaurants");
        $faker->addProvider(new \Faker\Provider\it_IT\Company($faker));
        
        foreach ($restaurants as $restaurant) {
            $newUser = new User();
            $newUser->name = $restaurant['nome'];
            $newUser->image = $restaurant['img'];
            $newUser->email = strtolower(str_replace([" ", "'" ], "", $restaurant['nome']))."@gmail.com";
            $newUser->password = Hash::make('12345678');
            $newUser->PIVA = str_replace("IT","", $faker->vat());
            $newUser->address = $faker->address;
            $newUser->slug = User::slugGenerator($newUser->name);
            $newUser->save();
        }
    }
}
