<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'brand',
        'category_id',
        'price',
        'stock_quantity',
        'status',
        'features'
    ];


    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function variations()
    {
        return $this->HasMany(ProductVariation::class)->get();
    }

    public function productImage()
    {
        return $this->getMedia('product_img')->first() ? $this->getMedia('product_img')->first()->getUrl() : asset('images/No-Image.png');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function productGalleryImages()
    {
        return $this->getMedia('product_gallery');
    }

    public function scopeGetVendorProducts($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function scopeGetProductFeatures($query, $productId)
    {
        $q = $query->where('id', $productId)->first();
        return json_decode($q->features);
    }

    public function scopeSearchProductName($query, $searchParam)
    {
        return $query->where('status', 1)->where('name', 'like', '%' . $searchParam . '%');
    }

    public function minusProductStock($quantity)
    {
        $this->stock_quantity -= $quantity;
        $this->save();
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }

    public function returnPolicy()
    {
        return $this->hasOne(ProductReturnPolicy::class);
    }
}
