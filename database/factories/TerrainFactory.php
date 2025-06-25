<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Terrain;

class TerrainFactory extends Factory
{
    protected $model = Terrain::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'location' => $this->faker->city,
            'price_per_hour' => $this->faker->randomFloat(2, 10, 100),
            'price_per_day' => $this->faker->randomFloat(2, 50, 500),
            'is_available' => true,
            'owner_id' => \App\Models\User::factory(),
        ];
    }
}
