<?php

namespace Database\Factories;

use App\Models\Detail;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Detail>
 */
class DetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'calories' => fake()->randomFloat(2, 100, 5000),
            'ingridients' => fake()->text(),
        ];
    }
}
