<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         User::factory(10)->create();

        $user1 = User::query()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'admin@gmail.com',
            'phone' => '01987654321',
            'password' => Hash::make('admin')
        ]);

        $user2 = User::query()->create([
            'first_name' => 'shamim',
            'last_name' => 'shakir',
            'email' => 'shamimshakir75@gmail.com',
            'phone' => '01744491461',
            'password' => Hash::make('12345678')
        ]);

        $user3 = User::query()->create([
            'first_name' => 'aunik',
            'last_name' => 'datta',
            'email' => 'aunikdatta@gmail.com',
            'phone' => '01723456789',
            'password' => Hash::make('12345678')
        ]);

        $user1->addresses()->saveMany(
            Address::factory()->count(2)->make()
        );

        $user2->addresses()->saveMany(
            Address::factory()->count(2)->make()
        );

        $user3->addresses()->saveMany(
            Address::factory()->count(1)->make()
        );
    }
}
