<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Администратор',
                'password' => bcrypt('password'),
                'is_admin' => 1,
            ]
        );

        $categories = [
            ['name' => 'Дрели и шуруповёрты', 'slug' => 'dreli'],
            ['name' => 'Молотки и кувалды',   'slug' => 'molotki'],
            ['name' => 'Пилы и ножовки',       'slug' => 'pily'],
            ['name' => 'Измерительные',         'slug' => 'izmeritelnyye'],
        ];
        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        $products = [
            ['name' => 'Дрель Bosch 800W', 'category_id' => 1, 'price' => 4500, 'stock' => 10, 'is_active' => true],
            ['name' => 'Шуруповёрт DeWalt 18V', 'category_id' => 1, 'price' => 8900, 'stock' => 5, 'is_active' => true],
            ['name' => 'Молоток слесарный 500г', 'category_id' => 2, 'price' => 350, 'stock' => 50, 'is_active' => true],
            ['name' => 'Кувалда 2кг', 'category_id' => 2, 'price' => 800, 'stock' => 20, 'is_active' => true],
            ['name' => 'Ножовка по дереву', 'category_id' => 3, 'price' => 600, 'stock' => 30, 'is_active' => true],
            ['name' => 'Рулетка 5м', 'category_id' => 4, 'price' => 280, 'stock' => 100, 'is_active' => true],
        ];

        foreach ($products as $p) {
            $slug = Str::slug($p['name']);
            Product::firstOrCreate(['slug' => $slug], array_merge($p, ['slug' => $slug]));
        }
    }
}
