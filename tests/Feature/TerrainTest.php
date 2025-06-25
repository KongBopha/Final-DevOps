<?php

use App\Models\Terrain;
use App\Models\User;

test('can list all available terrains', function () {
    $terrains = Terrain::factory(5)->create(['is_available' => true]);

    $response = $this->getJson('/api/terrains');

    $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
});

test('can view single terrain with relationships', function () {
    $terrain = Terrain::factory()
        ->hasImages(3)
        ->hasReviews(2)
        ->create();

    $response = $this->getJson("/api/terrains/{$terrain->id}");

    $response->assertStatus(200)
            ->assertJson([
                'id' => $terrain->id,
                'title' => $terrain->title,
            ])
            ->assertJsonStructure([
                'images',
                'reviews',
                'owner'
            ]);
});

test('authenticated user can create terrain', function () {
    $user = User::factory()->create();

    $terrainData = [
        'title' => 'Test Terrain',
        'description' => 'A beautiful terrain for rent',
        'location' => 'Test Location',
        'price_per_hour' => 25.50,
        'price_per_day' => 200.00,
    ];

    $response = $this->actingAs($user)
                    ->postJson('/api/terrains', $terrainData);

    $response->assertStatus(201)
            ->assertJson([
                'title' => 'Test Terrain',
                'owner_id' => $user->id,
            ]);

    $this->assertDatabaseHas('terrains', $terrainData);
});

test('owner can update their terrain', function () {
    $user = User::factory()->create();
    $terrain = Terrain::factory()->create(['owner_id' => $user->id]);

    $updateData = ['title' => 'Updated Terrain Title'];

    $response = $this->actingAs($user)
                    ->putJson("/api/terrains/{$terrain->id}", $updateData);

    $response->assertStatus(200)
            ->assertJson(['title' => 'Updated Terrain Title']);

    $this->assertDatabaseHas('terrains', [
        'id' => $terrain->id,
        'title' => 'Updated Terrain Title',
    ]);
});

test('non-owner cannot update terrain', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();
    $terrain = Terrain::factory()->create(['owner_id' => $owner->id]);

    $response = $this->actingAs($otherUser)
                    ->putJson("/api/terrains/{$terrain->id}", ['title' => 'Hacked']);

    $response->assertStatus(403);
});
