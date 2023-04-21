<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodBank>
 */
class FoodBankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cereals'=>$this->faker->numberBetween(100,500),
            'proteins'=>$this->faker->numberBetween(100,500),
            'legumes'=>$this->faker->numberBetween(100,500),
            'breakfast'=>$this->faker->numberBetween(100,500),
            'snacks'=>$this->faker->numberBetween(10,50),
            'cash'=>$this->faker->numberBetween(10000,50000),
        ];
    }
}
