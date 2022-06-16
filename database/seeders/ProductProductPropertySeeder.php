<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductProperty;
use Illuminate\Database\Seeder;

class ProductProductPropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = ProductProperty::all();
        $products = Product::all();
        foreach ($properties as $property) {
            foreach ($products as $product) {
                $rand = rand(1000, 10000);
                $product->properties()->attach(
                    [$property['id'] => ['value' => $rand]]
                );
            }
        }
    }
}
