<?php

namespace App\Models;

use App\Enum\KategoriEnum;
use App\Enum\StatusEnum;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'slug',
        'status',
        'kategori',
        'user_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
