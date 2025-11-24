<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'milan@popart-oglasi.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('test123'),
                'role' => 'admin',
            ]
        );
    }
}