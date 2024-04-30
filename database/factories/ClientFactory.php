<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "name2" => $this->faker->name(),
            "lastname" => $this->faker->lastName(),
            "lastname2" => $this->faker->lastName(),
            "dni" => $this->faker->randomNumber(8),
            "ruc" => $this->faker->randomNumber(8),
            "city" => $this->faker->city(),
            "address" => $this->faker->address(),
            "phone" => $this->faker->phoneNumber(),
            "cellphone" => $this->faker->phoneNumber(),
            "email" => fake()->unique()->safeEmail(),
        ];
    }
}
