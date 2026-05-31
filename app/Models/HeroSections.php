<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSections extends Model
{
    protected $table = 'hero_sections';

    protected $fillable = [
        'tagline',
        'title',
        'description',
        'image',
    ];
}
