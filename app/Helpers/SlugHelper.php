<?php

namespace App\Helpers;

if (!function_exists('generateSlug')) {
    function generateSlug($title)
    {
        $slug = preg_replace('/\s+/', '-', $title);
        $slug = preg_replace('/\d+/', '', $slug);
        $slug = preg_replace('/[^a-zA-Z0-9-]/', '', $slug);

        return $slug;
    }
}
