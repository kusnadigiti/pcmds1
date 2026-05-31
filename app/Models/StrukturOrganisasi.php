<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    protected $table = 'struktur_organisasi';

    protected $fillable = ['nama', 'peran', 'peran_level', 'urutan', 'image'];
}
