<?php

namespace Database\Factories;

use App\Models\Suplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductBuy>
 */
class ProductBuyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "tax" => $this->faker->randomNumber(2),
            "suplier_id" => Suplier::factory(),
            "user_id" => User::factory(),
        ];
    }
}
