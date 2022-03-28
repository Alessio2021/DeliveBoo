<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CategoryUserSeeder::class);
        $this->call(DishesSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
