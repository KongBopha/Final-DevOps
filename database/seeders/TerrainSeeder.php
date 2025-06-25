<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Terrain;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Database\Seeder;

class TerrainSeeder extends Seeder
{
    public function run(): void
    {
        // Create users
        $users = User::factory(10)->create();

        // Create terrains with relationships
        Terrain::factory(20)
            ->recycle($users)
            ->has(Booking::factory(3)->recycle($users))
            ->create();
    }
}
