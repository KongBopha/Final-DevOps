<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTerrainRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->id === $this->terrain->owner_id;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'location' => 'sometimes|string|max:255',
            'price_per_hour' => 'sometimes|numeric|min:0',
            'price_per_day' => 'sometimes|numeric|min:0',
            'available_from' => 'nullable|date',
            'available_to' => 'nullable|date|after:available_from',
            'is_available' => 'sometimes|boolean',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
