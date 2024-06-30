<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reports>
 */
class ReportsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $arr = ["product,quantity", "product,quantity,price", "product,quantity,price,total"];
        return [
            "name" => "Report-" . $this->faker->words(1, true),
            "columns" => $arr[rand(0, 2)],
            "owner_id" => 1
        ];
    }
}
