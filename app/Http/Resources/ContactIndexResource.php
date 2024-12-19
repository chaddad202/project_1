<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = app()->getLocale();

        return
            [
                'id' => $this->id,
                'link'=>$this->link,
                'icon' => url('storage/' . str_replace('public/', '', $this->icon)),
                'name' => $locale === 'ar' ? $this->name_ar : $this->name_en,
            ];
    }
}
