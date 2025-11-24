<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin korisnik
        $this->call(AdminUserSeeder::class);

        // Customers
        $this->call(CustomerSeeder::class);

        // Kategorije
        $this->call(CategorySeeder::class);

        // Oglasi
        $this->call(AdSeeder::class);
    }
}
