<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SaleItem;
use App\Models\Product;
use Faker\Factory as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SaleItems>
 */
class SaleItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
      protected $model = SaleItem::class;

    
    public function definition(): array
    {
        return [
            'sale_id'    => $this->faker->numberBetween(1, 50), // Assuming sales have IDs from 1 to 50
            'product_id' => Product::factory(), // Assuming products have IDs from 1 to 100
            'qty'        => $this->faker->randomNumber(2),
            'total'      => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
