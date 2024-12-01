<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


class Service extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable = [
        'title_en',
        'title_ar',
        'description_ar',
        'description_en',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
