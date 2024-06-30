<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sales>
 */
class SalesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $price = $this->faker->numberBetween(100, 800);
        $quantity = $this->faker->numberBetween(1, 10);
        $total = $price * $quantity;

        return [
            'product' => $this->faker->word(),
            'quantity' => $quantity,
            'price' => $price,
            'total' => $total,
        ];
    }
}
