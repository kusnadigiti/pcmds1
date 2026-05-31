<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmalUsaha extends Model
{
    protected $table = 'amal_usaha';

    protected $fillable = [
        'organisasi_otonom_id',
        'nama',
        'deskripsi',
        'foto',
        'tipe',
    ];

    public function organisasiOtonom()
    {
        return $this->belongsTo(Organisasi::class, 'organisasi_otonom_id');
    }
}
