<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Product #' . ($number = $this->faker->randomNumber()),
            'code' => 'product_' . $number,
            'created_at' => Carbon::now(),
            'price' => $this->faker->randomFloat(2, 250.5),
            'quantity' => $this->faker->randomNumber(),
            'product_section_id' => null
        ];
    }
}
