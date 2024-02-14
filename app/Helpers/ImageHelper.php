<?php
// app/Helpers/ImageHelper.php

namespace App\Helpers;

class ImageHelper
{
    public static function uploadImage($file, $imageName , $path)
    {
        $filename = $imageName . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($path), $filename);

        return $filename;
    }
}
