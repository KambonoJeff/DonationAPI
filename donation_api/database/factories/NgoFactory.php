<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ngo>
 */
class NgoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->company(),
            'email'=>$this->faker->email(),
            'location'=>$this->faker->city(),
            'beneficiaries'=>$this->faker->numberBetween(10,200),
            'phonenumber'=>$this->faker->phoneNumber(),
            'licenseNo'=>$this->faker->numberBetween(233231,921323)
        ];
    }
}
