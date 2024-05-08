<?php

namespace Database\Factories;

use App\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Suplier>
 */
class SuplierFactory extends Factory
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
            "province" => $this->faker->randomElement(["costa", "sierra"]),
            "city" => $this->faker->city(),
            "address" => $this->faker->address(),
            "phone" => $this->faker->phoneNumber(),
            "cellphone" => $this->faker->phoneNumber(),
            "email" => fake()->unique()->safeEmail(),
            "ruc" => $this->faker->randomNumber(),
            "entity_id" => Entity::factory(),
        ];
    }
}
