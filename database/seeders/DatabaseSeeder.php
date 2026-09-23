<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@nalacoffee.test'],
            [
                'name' => 'Nala Coffee Admin',
                'password' => Hash::make('Admin@12345'),
                'role' => 'super_admin',
                'status' => 'active',
            ]
        );

        $categories = [
            ['name' => 'Arabica', 'slug' => 'arabica', 'description' => 'Kopi arabica premium'],
            ['name' => 'Robusta', 'slug' => 'robusta', 'description' => 'Kopi robusta dengan body kuat'],
            ['name' => 'House Blend', 'slug' => 'house-blend', 'description' => 'Racikan harian untuk espresso dan kopi susu'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                ['name' => $category['name'], 'description' => $category['description'], 'status' => 'active']
            );
        }

        $products = [
            ['name' => 'Arabica Ijen', 'slug' => 'arabica-ijen', 'category_id' => Category::where('slug', 'arabica')->value('id'), 'description' => 'Kopi dengan profil floral dan rasa buah yang bersih.', 'image' => 'images/products/arabica-ijen.png', 'price' => 85000, 'shopee_url' => 'https://shopee.co.id/', 'status' => 'active'],
            ['name' => 'Robusta Ijen', 'slug' => 'robusta-ijen', 'category_id' => Category::where('slug', 'robusta')->value('id'), 'description' => 'Body tebal dengan aftertaste cokelat.', 'image' => 'images/products/robusta-ijen.png', 'price' => 70000, 'shopee_url' => 'https://shopee.co.id/', 'status' => 'active'],
            ['name' => 'House Blend', 'slug' => 'house-blend', 'category_id' => Category::where('slug', 'house-blend')->value('id'), 'description' => 'Racikan seimbang untuk seduhan harian.', 'image' => 'images/products/house-blend.png', 'price' => 75000, 'shopee_url' => 'https://shopee.co.id/', 'status' => 'active'],
        ];
        foreach ($products as $product) {
            Product::updateOrCreate(['slug' => $product['slug']], $product);
        }

        foreach (range(1, 6) as $number) {
            Gallery::updateOrCreate(
                ['title' => "Galeri Nala Coffee {$number}"],
                ['image' => "images/gallery/gallery-{$number}.png", 'category' => 'Lifestyle', 'sort_order' => $number, 'status' => 'active']
            );
        }

        foreach ([
            'website_name' => 'Nala Coffee',
            'email' => 'hello@nalacoffee.test',
            'whatsapp' => '+62 812 0000 0000',
            'instagram' => 'https://instagram.com/',
            'tiktok' => 'https://tiktok.com/',
            'shopee_url' => 'https://shopee.co.id/',
        ] as $key => $value) {
            Setting::firstOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
