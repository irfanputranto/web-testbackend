<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

if (!function_exists('checkImg')) {
    function checkImg($namefile)
    {
        $files = '';
        if (File::exists('storage/images/' . $namefile)) {
            $mimeType = File::mimeType('storage/images/' . $namefile);

            if (str_starts_with($mimeType, 'image/')) {
                $files = asset('storage/images/' . $namefile);
            }
        }

        return $files;
    }
}

if (!function_exists('checkVideo')) {
    function checkVideo($namefile)
    {
        $files = '';
        if (File::exists('storage/media/' . $namefile)) {
            $mimeType = File::mimeType('storage/media/' . $namefile);
            if (str_starts_with($mimeType, 'video/')) {
                $files = asset('storage/media/' . $namefile);
            }
        }

        return $files;
    }
}
