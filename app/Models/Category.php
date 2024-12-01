<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_en',
        'title_ar',
        'photo',
        'description_en',
        'description_ar',
    ];
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
