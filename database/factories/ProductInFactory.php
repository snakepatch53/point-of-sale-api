<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductBuy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductIn>
 */
class ProductInFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "date" => $this->faker->date(),
            "quantity" => $this->faker->randomNumber(),
            "price" => $this->faker->randomNumber(),
            "commission" => $this->faker->randomNumber(),
            "product_id" => Product::factory(),
            "product_buy_id" => ProductBuy::factory(),
        ];
    }
}
