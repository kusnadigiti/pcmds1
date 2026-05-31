<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'author',
        'content',
        'thumbnail',
        'status',
        'user_id'
    ];

    public  function getRouteKeyName()
    {
        return 'slug';
    }
}
