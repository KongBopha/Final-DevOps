<?php

namespace App\Policies;

use App\Models\Terrain;
use App\Models\User;

class TerrainPolicy
{
    public function update(User $user, Terrain $terrain): bool
    {
        return $user->id === $terrain->owner_id;
    }

    public function delete(User $user, Terrain $terrain): bool
    {
        return $user->id === $terrain->owner_id;
    }
}
