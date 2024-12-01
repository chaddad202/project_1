<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = app()->getLocale();

        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'title' => $locale === 'ar' ? $this->title_ar : $this->title_en,
            'description' => $locale === 'ar' ? $this->description_ar : $this->description_en,
        ];
    }
}
