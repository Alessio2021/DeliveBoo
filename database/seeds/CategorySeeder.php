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
            [
                'nome' => "italiano",
                'img' => 'italian-icon.svg',
            ],
            [
                'nome' => "internazionale",
                'img' => 'international-icon.svg',
            ],
            [
                'nome' => "cinese",
                'img' => 'chinese-icon.svg',
            ],
            [
                'nome' => "giapponese",
                'img' => 'japan-icon.svg',
            ],
            [
                'nome' => "messicano",
                'img' => 'mexican-icon.svg',
            ],
            [
                'nome' => "indiano",
                'img' => 'indian-icon.svg',
            ],
            [
                'nome' => "vegetariano",
                'img' => 'vegetarian-icon.svg',
            ],
            [
                'nome' => "vegano",
                'img' => 'vegan-icon.svg',
            ],
            [
                'nome' => "fast food",
                'img' => 'fastfood-icon.svg',
            ],
            [
                'nome' => "americano",
                'img' => 'american-icon.svg',
            ],
            [
                'nome' => "colazione",
                'img' => 'breakfast-icon.svg',
            ],
            [
                'nome' => "greco",
                'img' => 'greek-icon.svg',
            ],

        ];
        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->name = $category['nome'];
            $newCategory->image = $category['img'];
            $newCategory->save();
        }
    }
}
