<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramUnggulan extends Model
{
    protected $table = 'program_unggulan';

    protected $fillable = [
        'nama_program',
        'deskripsi',
        'gambar',
        'headline'
    ];
}
