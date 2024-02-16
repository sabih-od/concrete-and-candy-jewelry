<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;


    protected $fillable = [
        'name',
        'slug',
    ];

    public function scopeGetSlugCategory($query, $slug)
    {
        return $query->where('slug', $slug);
    }


    public function scopeGetParentCategories($query)
    {
        return $query->where('parent_id', 0);
    }

    public function categoryImage()
    {
        return $this->getMedia('category_img')->first() ? $this->getMedia('category_img')->first()->getUrl() : asset('images/No-Image.png');
    }
}
