<?php

namespace Database\Factories;

use App\Models\Entity;
use App\Models\Locker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "code" => $this->faker->randomNumber(5),
            "mark" => $this->faker->randomElement(["AAA", "BBB"]),
            "model" => $this->faker->randomElement(["XXX", "YYY"]),
            "elaboration" => $this->faker->date(),
            "expiration" => $this->faker->date(),
            "description" => $this->faker->sentence(),
            "photo" => $this->faker->randomElement(["1.png", "2.png", "3.png", "4.png", "5.png"]),
            "locker_id" => Locker::factory(),
            "entity_id" => Entity::factory(),
        ];
    }
}
