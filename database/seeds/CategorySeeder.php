<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'italiano',
            'internazionale',
            'cinese',
            'giapponese',
            'messicano',
            'indiano',
            'vegetariano',
            'vegano',
            'fast food',
            'americano',
            'colazione',
            'greco',
        ];
        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->name = $category;
            $newCategory->save();
        }
    }
}
