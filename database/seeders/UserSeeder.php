<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'phone' => "09770774800",
                'address' => "Yangon",
                'role' => 'admin',
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'phone' => "09770774800",
                'address' => "Yangon",
                'role' => 'user',
            ],
            [
                'name' => 'Florist',
                'email' => 'florist@gmail.com',
                'password' => Hash::make('password'),
                'phone' => "09770774800",
                'address' => "Yangon",
                'role' => 'florist',
            ]
        ];

        foreach ($users as $user) {
            User::updateOrCreate($user);
        }
    }
}
