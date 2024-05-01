<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductBuy;
use App\Models\ProductSale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductOut>
 */
class ProductOutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "quantity" => $this->faker->randomNumber(),
            "price" => $this->faker->randomNumber(),
            "commission" => $this->faker->randomNumber(),
            "product_id" => Product::factory(),
            "product_sale_id" => ProductSale::factory(),
        ];
    }
}
