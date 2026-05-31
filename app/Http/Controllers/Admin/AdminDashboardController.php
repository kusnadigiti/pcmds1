<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Berita;
use App\Models\Jadwal;
use App\Models\Organisasi;
use App\Models\Pengurus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // =========================================================
        // STATISTIK UTAMA
        // =========================================================
        $totalBerita       = Berita::count();
        $beritaPublish     = Berita::where('status', 'published')->count();

        $totalArtikel      = Article::count();
        $artikelPublish    = Article::where('status', 'published')->count();

        $totalPengurus     = Pengurus::where('is_active', true)->count();
        $totalPengurusAll  = Pengurus::count();
        $totalOrganisasi   = Organisasi::where('is_active', true)->count();

        $totalKajianBulanIni = Jadwal::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->count();

        $kajianTerlaksana  = Jadwal::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->where('tanggal', '<', now())
            ->count();

        $kajianMendatang   = Jadwal::where('tanggal', '>=', now())
            ->count();

        // =========================================================
        // JADWAL MENDATANG (4 terdekat)
        // =========================================================
        $mendatang = Jadwal::where('tanggal', '>=', now())
            ->orderBy('tanggal')
            ->take(4)
            ->get();

        // =========================================================
        // AKTIVITAS TERBARU
        // Menggabungkan berita, artikel, pengurus, organisasi terbaru
        // =========================================================
        $aktivitas = collect();

        // Berita terbaru
        Berita::latest()->take(3)->get()->each(function ($b) use (&$aktivitas) {
            $aktivitas->push([
                'icon'   => '📰',
                'bg'     => '#ffe4e6',
                'text'   => 'Berita <strong>"' . \Illuminate\Support\Str::limit($b->judul, 40) . '"</strong> ' . ($b->status === 'published' ? 'dipublikasikan' : 'disimpan sebagai draft'),
                'module' => 'Berita',
                'time'   => $b->created_at->diffForHumans(),
                'sort'   => $b->created_at,
            ]);
        });

        // Artikel terbaru
        Article::latest()->take(3)->get()->each(function ($a) use (&$aktivitas) {
            $aktivitas->push([
                'icon'   => '📄',
                'bg'     => '#dbeafe',
                'text'   => 'Artikel <strong>"' . \Illuminate\Support\Str::limit($a->title, 40) . '"</strong> ' . ($a->status === 'published' ? 'diterbitkan' : 'disimpan sebagai draft'),
                'module' => 'Artikel',
                'time'   => $a->created_at->diffForHumans(),
                'sort'   => $a->created_at,
            ]);
        });

        // Pengurus terbaru
        Pengurus::latest()->take(2)->get()->each(function ($p) use (&$aktivitas) {
            $aktivitas->push([
                'icon'   => '👤',
                'bg'     => '#d1fae5',
                'text'   => 'Pengurus baru ditambahkan: <strong>' . $p->nama . '</strong> sebagai ' . $p->jabatan,
                'module' => 'Pengurus',
                'time'   => $p->created_at->diffForHumans(),
                'sort'   => $p->created_at,
            ]);
        });

        // Kajian terbaru
        Jadwal::latest()->take(2)->get()->each(function ($j) use (&$aktivitas) {
            $aktivitas->push([
                'icon'   => '🗓️',
                'bg'     => '#fef3c7',
                'text'   => 'Jadwal kajian <strong>"' . \Illuminate\Support\Str::limit($j->nama_kegiatan, 40) . '"</strong> ditambahkan',
                'module' => 'Kajian',
                'time'   => $j->created_at->diffForHumans(),
                'sort'   => $j->created_at,
            ]);
        });

        // Sort by waktu terbaru, ambil 5
        $aktivitas = $aktivitas->sortByDesc('sort')->take(5)->values();

        // =========================================================
        // RETURN VIEW
        // =========================================================
        return view('pages.admin.dashboard', compact(
            'totalBerita',
            'beritaPublish',
            'totalArtikel',
            'artikelPublish',
            'totalPengurus',
            'totalPengurusAll',
            'totalOrganisasi',
            'totalKajianBulanIni',
            'kajianTerlaksana',
            'kajianMendatang',
            'mendatang',
            'aktivitas',
        ));
    }
}
