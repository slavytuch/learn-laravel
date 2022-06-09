<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductProperty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \Faker\Generator as Faker;

class ProductProductPropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        /*        $products = Product::all();

                ProductProperty::all()->each(function ($property) use ($products) {
                    $property->products()->attach(
                        $products->random(rand(1, 3))->pluck('id')->toArray()
                    );
                });*/

        $properties = ProductProperty::all();

        Product::all()->each(
            fn($product) => $product->properties()->attach(
                $properties->each(
                    fn($property) => [
                        $property['id'] => [
                            'value' => $faker->randomNumber(4)
                        ]
                    ]
                )
            )
        );
    }
}
