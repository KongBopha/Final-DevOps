<?php

namespace App\Http\Controllers;

use App\Models\Terrain;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TerrainController extends Controller
{
    public function index(): JsonResponse
    {
$terrains = Terrain::where('is_available', true)->get();
    return response()->json(['data' => $terrains], 200);
    }

    public function show(Terrain $terrain): JsonResponse
    {
        $terrain->load(['owner', 'images', 'reviews.user', 'bookings']);

        return response()->json($terrain);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'price_per_hour' => 'required|numeric|min:0',
            'price_per_day' => 'required|numeric|min:0',
            'available_from' => 'nullable|date',
            'available_to' => 'nullable|date|after:available_from',
        ]);

        $validated['owner_id'] = auth()->id();

        $terrain = Terrain::create($validated);

        return response()->json($terrain, 201);
    }

    public function update(Request $request, Terrain $terrain): JsonResponse
    {
        $this->authorize('update', $terrain);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'location' => 'sometimes|string|max:255',
            'price_per_hour' => 'sometimes|numeric|min:0',
            'price_per_day' => 'sometimes|numeric|min:0',
            'available_from' => 'nullable|date',
            'available_to' => 'nullable|date|after:available_from',
            'is_available' => 'sometimes|boolean',
        ]);

        $terrain->update($validated);

        return response()->json($terrain);
    }

    public function destroy(Terrain $terrain): JsonResponse
    {
        $this->authorize('delete', $terrain);

        $terrain->delete();

        return response()->json(null, 204);
    }
}
