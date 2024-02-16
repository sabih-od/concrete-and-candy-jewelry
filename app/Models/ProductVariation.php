<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size_id',
        'color',
        'price'
    ];

    public function size()
    {
        return $this->belongsTo(ProductSize::class)->first();
    }
}
