<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TerrainImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'image_path' => $this->faker->imageUrl(),
        ];
    }
}
