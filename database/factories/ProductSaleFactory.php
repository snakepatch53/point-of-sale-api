<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSale>
 */
class ProductSaleFactory extends Factory
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
            "iva" => $this->faker->randomNumber(),
            "client_id" => Client::factory(),
            "user_id" => User::factory(),
        ];
    }
}
