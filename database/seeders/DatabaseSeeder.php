<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::query()->create([
            'first_name' => 'shamim',
            'last_name' => 'shakir',
            'email' => 'shamimshakir75@gmail.com',
            'phone' => '01744491461',
            'password' => Hash::make('shakir')
        ]);
        User::query()->create([
            'first_name' => 'aunik',
            'last_name' => 'datta',
            'email' => 'aunikdatta@gmail.com',
            'phone' => '01723456789',
            'password' => Hash::make('aunik')
        ]);
    }
}
