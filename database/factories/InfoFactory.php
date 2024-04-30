<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Info>
 */
class InfoFactory extends Factory
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
            "logo" => $this->faker->randomElement(["1.png", "2.png", "3.png"]),
            "icon" => $this->faker->name(),
            "city" => $this->faker->city(),
            "address" => $this->faker->address(),
            "phone" => $this->faker->phoneNumber(),
            "cellphone" => $this->faker->phoneNumber(),
            "email"  => fake()->unique()->safeEmail(),
            "tax" => $this->faker->name(),
        ];
    }
}
