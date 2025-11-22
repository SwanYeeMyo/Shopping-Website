<?php

namespace Database\Seeders;

use App\Models\Topping;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $toppings = [
            ['name' => 'Ribbon', 'price' => 500],
            ['name' => 'Chocolates', 'price' => 1500],
            ['name' => 'Greeting Card', 'price' => 800],
            ['name' => 'Stuffed Toy', 'price' => 2500],
            ['name' => 'Extra Flowers', 'price' => 2000],
        ];

        foreach ($toppings as $topping) {
            Topping::firstOrCreate($topping);
        }
    }
}
