<?php

namespace Database\Factories;

use App\Models\Ngo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostRequest>
 */
class PostRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'user_id' => Ngo::all()->random()->id,
          'typeoffood'=> $this->faker->randomElement(['cereals','proteins','legumes','breakfast','snacks']),
          'quantity'=>$this->faker->numberBetween(5,100),
          'beneficiaries'=> $this->faker->numberBetween(10,100),
          'location'=>$this->faker->city(),
          'status'=>$this->faker->randomElement(['Approved','Pending','NotApproved'])
        ];
    }
}
