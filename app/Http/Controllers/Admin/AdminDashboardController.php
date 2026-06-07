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
use Illuminate\Support\Facades\Cache;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $now = now();
        $cacheKey = 'admin_dashboard_data';

        // Cache the dashboard data for 10 minutes (600 seconds)
        $data = Cache::remember($cacheKey, 600, function () use ($now) {
            // =========================================================
            // STATISTIK UTAMA (Optimized with raw select aggregates)
            // =========================================================
            $beritaStats = Berita::selectRaw("
                count(*) as total,
                sum(case when status = 'published' then 1 else 0 end) as published
            ")->first();
            $totalBerita   = $beritaStats->total ?? 0;
            $beritaPublish = $beritaStats->published ?? 0;

            $articleStats = Article::selectRaw("
                count(*) as total,
                sum(case when status = 'published' then 1 else 0 end) as published
            ")->first();
            $totalArtikel   = $articleStats->total ?? 0;
            $artikelPublish = $articleStats->published ?? 0;

            $pengurusStats = Pengurus::selectRaw("
                count(*) as total,
                sum(case when is_active = 1 then 1 else 0 end) as active
            ")->first();
            $totalPengurusAll = $pengurusStats->total ?? 0;
            $totalPengurus    = $pengurusStats->active ?? 0;

            $totalOrganisasi  = Organisasi::where('is_active', true)->count();

            $kajianStats = Jadwal::selectRaw("
                sum(case when month(tanggal) = ? and year(tanggal) = ? then 1 else 0 end) as bulan_ini,
                sum(case when month(tanggal) = ? and year(tanggal) = ? and tanggal < ? then 1 else 0 end) as terlaksana,
                sum(case when tanggal >= ? then 1 else 0 end) as mendatang
            ", [
                $now->month, $now->year,
                $now->month, $now->year, $now,
                $now
            ])->first();

            $totalKajianBulanIni = $kajianStats->bulan_ini ?? 0;
            $kajianTerlaksana    = $kajianStats->terlaksana ?? 0;
            $kajianMendatang     = $kajianStats->mendatang ?? 0;

            // =========================================================
            // JADWAL MENDATANG (4 terdekat)
            // =========================================================
            $mendatang = Jadwal::where('tanggal', '>=', $now)
                ->orderBy('tanggal')
                ->take(4)
                ->get();

            // =========================================================
            // AKTIVITAS TERBARU (Optimized with selective columns)
            // Menggabungkan berita, artikel, pengurus, organisasi terbaru
            // =========================================================
            $aktivitas = collect();

            // Berita terbaru
            Berita::select('judul', 'status', 'created_at')
                ->latest()
                ->take(3)
                ->get()
                ->each(function ($b) use (&$aktivitas) {
                    $aktivitas->push([
                        'icon'   => '📰',
                        'bg'     => '#ffe4e6',
                        'text'   => 'Berita <strong>"' . \Illuminate\Support\Str::limit($b->judul, 40) . '"</strong> ' . ($b->status === 'published' ? 'dipublikasikan' : 'disimpan sebagai draft'),
                        'module' => 'Berita',
                        'time'   => $b->created_at, // Store Carbon instance to calculate diffForHumans outside cache
                        'sort'   => $b->created_at,
                    ]);
                });

            // Artikel terbaru
            Article::select('title', 'status', 'created_at')
                ->latest()
                ->take(3)
                ->get()
                ->each(function ($a) use (&$aktivitas) {
                    $aktivitas->push([
                        'icon'   => '📄',
                        'bg'     => '#dbeafe',
                        'text'   => 'Artikel <strong>"' . \Illuminate\Support\Str::limit($a->title, 40) . '"</strong> ' . ($a->status === 'published' ? 'diterbitkan' : 'disimpan sebagai draft'),
                        'module' => 'Artikel',
                        'time'   => $a->created_at, // Store Carbon instance
                        'sort'   => $a->created_at,
                    ]);
                });

            // Pengurus terbaru
            Pengurus::select('nama', 'jabatan', 'created_at')
                ->latest()
                ->take(2)
                ->get()
                ->each(function ($p) use (&$aktivitas) {
                    $aktivitas->push([
                        'icon'   => '👤',
                        'bg'     => '#d1fae5',
                        'text'   => 'Pengurus baru ditambahkan: <strong>' . $p->nama . '</strong> sebagai ' . $p->jabatan,
                        'module' => 'Pengurus',
                        'time'   => $p->created_at, // Store Carbon instance
                        'sort'   => $p->created_at,
                    ]);
                });

            // Kajian terbaru
            Jadwal::select('nama_kegiatan', 'created_at')
                ->latest()
                ->take(2)
                ->get()
                ->each(function ($j) use (&$aktivitas) {
                    $aktivitas->push([
                        'icon'   => '🗓️',
                        'bg'     => '#fef3c7',
                        'text'   => 'Jadwal kajian <strong>"' . \Illuminate\Support\Str::limit($j->nama_kegiatan, 40) . '"</strong> ditambahkan',
                        'module' => 'Kajian',
                        'time'   => $j->created_at, // Store Carbon instance
                        'sort'   => $j->created_at,
                    ]);
                });

            // Sort by waktu terbaru, ambil 5
            $aktivitas = $aktivitas->sortByDesc('sort')->take(5)->values();

            return compact(
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
                'aktivitas'
            );
        });

        // Format relative dates (diffForHumans) dynamically for every request
        if (isset($data['aktivitas'])) {
            $data['aktivitas'] = $data['aktivitas']->map(function ($act) {
                if (isset($act['time'])) {
                    // Re-instantiate Carbon if it was serialized as array or string from Cache
                    $carbonTime = $act['time'] instanceof Carbon 
                        ? $act['time'] 
                        : Carbon::parse($act['time']);
                    $act['time'] = $carbonTime->diffForHumans();
                }
                return $act;
            });
        }

        // =========================================================
        // RETURN VIEW
        // =========================================================
        return view('pages.admin.dashboard', $data);
    }
}
