<?php

namespace Database\Seeders;

use App\Models\ProductProperty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductPropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductProperty::create(['name' => 'Тестовое свойство']);
        ProductProperty::create(['name' => 'Ширина']);
        ProductProperty::create(['name' => 'Высота']);
        ProductProperty::create(['name' => 'Длинна']);
        ProductProperty::create(['name' => 'Вес']);
    }
}
