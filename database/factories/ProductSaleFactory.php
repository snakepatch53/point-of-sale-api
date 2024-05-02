<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductSaleFactory extends Factory
{
    public function definition()
    {
        return [
            "tax" => $this->faker->randomNumber(),
            "client_id" => Client::factory(),
            "user_id" => User::factory(),
        ];
    }
}
