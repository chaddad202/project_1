<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactUpdateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'icon' => url('storage/' . str_replace('public/', '', $this->icon)),
            'name_en' => $this->name_en,
            'name_ar' => $this->name_ar,
        ];
    }
}
