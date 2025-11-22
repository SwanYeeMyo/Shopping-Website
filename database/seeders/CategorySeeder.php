<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            ['name' => 'Bouquet'],
            ['name' => 'Basket'],
            ['name' => 'Mixed Flowers'],
            ['name' => 'Single Flower'],
            ['name' => 'Money Flower'],
            ['name' => 'Special Occasions'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate($category);
        }
    }
}
