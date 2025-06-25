<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ReviewFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(), // creates a User if not given
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->sentence(),
            'terrain_id' => \App\Models\Terrain::factory(),
        ];
    }
}
