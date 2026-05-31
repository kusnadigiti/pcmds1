<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $table = 'financial_reports';

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'file',
        'tanggal_laporan',
        'kategori',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
