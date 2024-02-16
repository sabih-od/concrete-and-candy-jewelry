<?php

namespace App\Helpers;
use App\Models\ProductSize;
use App\Models\Size;

class SizeHelper
{
    public static function getSize($size_id)
    {
        return ProductSize::find($size_id)->name;
    }
}
