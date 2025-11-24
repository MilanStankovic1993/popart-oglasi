<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ad;
use App\Models\Category;
use App\Models\User;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        $customer1 = User::where('email', 'customer1@popart-oglasi.test')->first();
        $customer2 = User::where('email', 'customer2@popart-oglasi.test')->first();

        if (! $customer1 || ! $customer2) {
            return;
        }

        $laptops      = Category::where('name', 'Laptopovi')->first();
        $phones       = Category::where('name', 'Mobilni telefoni')->first();
        $cars         = Category::where('name', 'Automobili')->first();
        $furniture    = Category::where('name', 'Nameštaj')->first();

        if ($laptops) {
            Ad::create([
                'user_id'     => $customer1->id,
                'category_id' => $laptops->id,
                'title'       => 'Dell XPS 13, 16GB RAM',
                'description' => 'Odlično očuvan laptop, korišćen pretežno za kancelarijski rad.',
                'price'       => 750.00,
                'condition'   => 'polovno',
                'image'       => null, // kasnije ćemo dodati upload
                'phone'       => '060/123-4567',
                'location'    => 'Beograd',
            ]);
        }

        if ($phones) {
            Ad::create([
                'user_id'     => $customer1->id,
                'category_id' => $phones->id,
                'title'       => 'Samsung Galaxy S24, nov, garancija',
                'description' => 'Neotpakovan telefon, dobijen na poklon, uz njega ide puna oprema.',
                'price'       => 900.00,
                'condition'   => 'novo',
                'image'       => null,
                'phone'       => '061/987-6543',
                'location'    => 'Novi Sad',
            ]);
        }

        if ($cars) {
            Ad::create([
                'user_id'     => $customer2->id,
                'category_id' => $cars->id,
                'title'       => 'VW Golf 7 2.0 TDI',
                'description' => 'Redovno servisiran, prvi vlasnik, registrovan godinu dana.',
                'price'       => 12000.00,
                'condition'   => 'polovno',
                'image'       => null,
                'phone'       => '062/222-333',
                'location'    => 'Niš',
            ]);
        }

        if ($furniture) {
            Ad::create([
                'user_id'     => $customer2->id,
                'category_id' => $furniture->id,
                'title'       => 'Trosed na razvlačenje, kao nov',
                'description' => 'Veoma malo korišćen, bez oštećenja, braon boje.',
                'price'       => 180.00,
                'condition'   => 'polovno',
                'image'       => null,
                'phone'       => '063/444-555',
                'location'    => 'Kragujevac',
            ]);
        }
    }
}
