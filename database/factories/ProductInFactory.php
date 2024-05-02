<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductBuy;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductInFactory extends Factory
{
    public function definition()
    {
        return [
            "quantity" => $this->faker->randomNumber(),
            "price" => $this->faker->randomNumber(),
            "commission" => $this->faker->randomNumber(),
            "product_id" => Product::factory(),
            "product_buy_id" => ProductBuy::factory(),
        ];
    }
}
