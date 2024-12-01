<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryShowResource extends JsonResource
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
            'photo'  => url('storage/' . str_replace('public/', '', $this->photo)),
            'title' => $locale === 'ar' ? $this->title_ar : $this->title_en,
            'description' => $locale === 'ar' ? $this->description_ar : $this->description_en,
            'services' => $this->getsercvices()




        ];
    }
    public function getsercvices()
    {
        $locale = app()->getLocale();

        $res = [];
        foreach ($this->services as $service) {
            $res = [
                'title' => $locale === 'ar' ? $service->title_ar : $service->title_en,
                'description' => $locale === 'ar' ? $service->description_ar : $service->description_en,
            ];
        }
        return $res;
    }
}
