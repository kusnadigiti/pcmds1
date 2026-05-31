<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengurus extends Model
{
    protected $table = 'pengurus';

    protected $fillable = [
        'organisasi_otonom_id',
        'nama',
        'jabatan',
        'level',
        'bidang',
        'foto',
        'no_hp',
        'email',
        'periode_mulai',
        'periode_selesai',
        'urutan',
        'is_active',
    ];

    public function organisasi(): BelongsTo
    {
        return $this->belongsTo(Organisasi::class, 'organisasi_otonom_id');
    }
}
