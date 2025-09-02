<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // insert data ke table users
        User::create([

                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => '12345678',

        ]);
    }
}
