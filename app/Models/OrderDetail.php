<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'size_id',
        'color',
        'unit_price',
        'subtotal',
        'invoice_number',
        'return_date',
        'return_reason',
        'return_qty'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function size()
    {
        return $this->belongsTo(ProductSize::class);
    }

    public function scopeVendorProduct($query)
    {
        return $query->with('product.user', 'order.user')->first();
    }
}
