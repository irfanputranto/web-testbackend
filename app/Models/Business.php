<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $table = 'businesses';

    protected $fillable = [
        "business_name",
        "location",
        "latitude",
        "longtitude",
        "term",
        "radius",
        "categories",
        "locale",
        "price",
        "open_now",
        "open_at",
        "attributes",
        "sort_by",
    ];
}
