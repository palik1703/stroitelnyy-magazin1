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
        User::create([
            'name'     => 'Администратор',
            'email'    => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $categories = [
            ['name' => 'Дрели и шуруповёрты', 'slug' => 'dreli'],
            ['name' => 'Молотки и кувалды',   'slug' => 'molotki'],
            ['name' => 'Пилы и ножовки',       'slug' => 'pily'],
            ['name' => 'Измерительные',         'slug' => 'izmeritelnyye'],
        ];
        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $products = [
            ['name'=>'Дрель Bosch 800W',      'category_id'=>1,'price'=>4500,'stock'=>10],
            ['name'=>'Шуруповёрт DeWalt 18V', 'category_id'=>1,'price'=>8900,'stock'=>5],
            ['name'=>'Молоток слесарный 500г','category_id'=>2,'price'=>350, 'stock'=>50],
            ['name'=>'Кувалда 2кг',            'category_id'=>2,'price'=>800, 'stock'=>20],
            ['name'=>'Ножовка по дереву',      'category_id'=>3,'price'=>600, 'stock'=>30],
            ['name'=>'Рулетка 5м',             'category_id'=>4,'price'=>280, 'stock'=>100],
        ];
        foreach ($products as $p) {
            Product::create(array_merge($p, ['slug' => Str::slug($p['name'])]));
        }
    }
}
