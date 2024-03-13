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
            'name' => 'shamim shakir',
            'email' => 'shamimshakir75@gmail.com',
            'password' => Hash::make('shakir')
        ]);
        User::query()->create([
            'name' => 'aunik datta',
            'email' => 'aunikdatta@gmail.com',
            'password' => Hash::make('aunik')
        ]);
    }
}
