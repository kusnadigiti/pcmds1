<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 6; $i++) {
            Article::create([
                'title' => "Article Title $i",
                'slug' => Str::slug("Article Title $i"),
                'author' => "Bintang",
                'content' => "Ini adalah contoh konten artikel ke-$i. Isinya bisa panjang banget, tapi ini dummy aja buat testing UI.",
                'thumbnail' => null // nanti bisa isi manual
            ]);
        }
    }
}
