<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryUpdateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title_en' => $this->title_en,
            'title_ar' => $this->title_ar,
            'description_en' => $this->description_en,
            'description_ar' => $this->description_ar,
            'photo'  => url('storage/' . str_replace('public/', '', $this->photo)),
            'services' => $this->getsercvices()

        ];
    }
    public function getsercvices()
    {
        $locale = app()->getLocale();

        $res = [];
        foreach ($this->services as $service) {
            $res = [
                'title_en' => $service->title_en,
                'title_ar' => $service->title_ar,
                'description_en' => $service->description_en,
                'description_ar' => $service->description_ar,
            ];
        }
        return $res;
    }
}
