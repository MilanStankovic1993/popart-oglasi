<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'customer1@popart-oglasi.test'],
            [
                'name'     => 'Customer 1',
                'password' => Hash::make('password'),
                'role'     => 'customer',
            ]
        );

        User::firstOrCreate(
            ['email' => 'customer2@popart-oglasi.test'],
            [
                'name'     => 'Customer 2',
                'password' => Hash::make('password'),
                'role'     => 'customer',
            ]
        );
    }
}
