<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articel extends Model
{
    use HasFactory;

    protected $fillable = [
        'alias',
        'title',
        'content',
        'user_id',
        'image',
        'video',
        'publish_at'
    ];
}
