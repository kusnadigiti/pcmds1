<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organisasi extends Model
{
    protected $table = 'organisasi_otonom';

    protected $fillable = [
        'nama',
        'singkatan',
        'slug',
        'tipe',
        'deskripsi',
        'logo',
        'periode_mulai',
        'periode_selesai',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relasi ke semua pengurus
    public function pengurus(): HasMany
    {
        return $this->hasMany(Pengurus::class, 'organisasi_otonom_id');
    }

    public function amalUsaha(): HasMany
    {
        return $this->hasMany(AmalUsaha::class, 'organisasi_otonom_id');
    }

    // Helpers untuk pengurus inti (accessor di blade)
    public function getKetuaAttribute(): ?string
    {
        return $this->pengurus()
            ->where('jabatan', 'like', 'Ketua%')
            ->where('level', 'inti')
            ->where('is_active', true)
            ->value('nama');
    }

    // Helper untuk mendapatkan sekretaris
    public function getSekretarisAttribute(): ?string
    {
        return $this->pengurus()
            ->where('jabatan', 'like', 'Sekretaris%')
            ->where('level', 'inti')
            ->where('is_active', true)
            ->value('nama');
    }

    // Helper untuk mendapatkan bendahara
    public function getBendaharaAttribute(): ?string
    {
        return $this->pengurus()
            ->where('jabatan', 'like', 'Bendahara%')
            ->where('is_active', true)
            ->value('nama');
    }

    // Scope filter
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOtonom($query)
    {
        return $query->where('tipe', 'ortonom');
    }

    public function scopeLembaga($query)
    {
        return $query->where('tipe', 'lembaga');
    }

    public function scopeMajelis($query)
    {
        return $query->where('tipe', 'majelis');
    }
}
