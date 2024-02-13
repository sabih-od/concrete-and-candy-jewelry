<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'header_logo',
        'footer_logo',
        'fav_image',
        'phone_no',
        'address',
        'email',
        'social_link_1',
        'social_link_2',
        'social_link_3',
        'social_link_4',
//        'pay_out_days',
//        'product_return_days'
    ];

}
