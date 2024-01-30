<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\Sales;

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
     protected $model = Sales::class;
    public function definition(): array
    {
        return [
            'customer_name' => $this->faker->name,
            'grand_total' => rand(100, 1000),
            'cgst' => rand(5, 15),
            'sgst' => rand(5, 15),
            'total' => rand(500, 5000),
            'status' => rand(1, 4), 
        ];
    }
}
