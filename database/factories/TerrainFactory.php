<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TerrainFactory extends Factory
{
    public function definition(): array
    {
        return [
            'owner_id' => User::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->address(),
            'price_per_hour' => $this->faker->randomFloat(2, 10, 100),
            'price_per_day' => $this->faker->randomFloat(2, 50, 500),
            'available_from' => $this->faker->dateTimeBetween('now', '+1 month'),
            'available_to' => $this->faker->dateTimeBetween('+1 month', '+6 months'),
            'is_available' => $this->faker->boolean(80),
            'main_image' => $this->faker->imageUrl(640, 480, 'nature'),
        ];
    }
}
