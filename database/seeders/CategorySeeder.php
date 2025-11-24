<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        $electronics = Category::create(['name' => 'Elektronika']);
        $vehicles    = Category::create(['name' => 'Vozila']);
        $home        = Category::create(['name' => 'Kuća i stan']);

        $computers = Category::create([
            'name'      => 'Računari',
            'parent_id' => $electronics->id,
        ]);

        Category::create([
            'name'      => 'Laptopovi',
            'parent_id' => $computers->id,
        ]);

        Category::create([
            'name'      => 'Desktop računari',
            'parent_id' => $computers->id,
        ]);

        Category::create([
            'name'      => 'Mobilni telefoni',
            'parent_id' => $electronics->id,
        ]);

        Category::create([
            'name'      => 'Automobili',
            'parent_id' => $vehicles->id,
        ]);

        Category::create([
            'name'      => 'Motori',
            'parent_id' => $vehicles->id,
        ]);

        Category::create([
            'name'      => 'Nameštaj',
            'parent_id' => $home->id,
        ]);

        Category::create([
            'name'      => 'Bela tehnika',
            'parent_id' => $home->id,
        ]);
    }
}
