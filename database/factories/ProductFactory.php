<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(1000, 100000), // Random price between 10 and 1000 with 2 decimal places
            'total_product' => $this->faker->numberBetween(0, 100),
            'category_id' => mt_rand(1, 6)
        ];
    }
}
