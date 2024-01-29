<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

if (!function_exists('checkImg')) {
    function checkImg($namefile)
    {
        if (File::exists('storage/images/' . $namefile)) {
            $mimeType = File::mimeType('storage/images/' . $namefile);

            if (str_starts_with($mimeType, 'image/')) {
                return asset('storage/images/' . $namefile);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
}
