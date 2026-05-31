<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileOrganisasi extends Model
{
    protected $table = 'profile_organisasi';

    protected $fillable = [
        'nama',
        'visi',
        'misi',
        'image',
        'tagline',
    ];
}
