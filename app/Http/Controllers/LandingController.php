<?php

namespace App\Http\Controllers;

use App\Models\AmalUsaha;
use App\Models\Article;
use App\Models\Berita;
use App\Models\HeroSections;
use App\Models\Jadwal;
use App\Models\Organisasi;
use App\Models\Pengurus;
use App\Models\ProfileOrganisasi;
use App\Models\StrukturOrganisasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LandingController extends Controller
{
    public function index()
    {
        $hero = ProfileOrganisasi::latest('created_at')->first();
        $heroSections = HeroSections::latest()->get();

        $totalArticlesCount = Article::where('status', 'published')->count();
        $articles = Article::where('status', 'published')
            ->latest('created_at')
            ->limit(6)
            ->get();

        $latestBerita = Berita::where('status', 'published')
            ->latest('created_at')
            ->limit(7)
            ->get();

        $jadwals = Jadwal::where('tanggal', '>=', today())
            ->orderBy('tanggal', 'asc')
            ->orderBy('waktu', 'asc')
            ->limit(3)
            ->get();

        $allJadwalsRaw = Jadwal::orderBy('tanggal', 'asc')
            ->orderBy('waktu', 'asc')
            ->get();

        $organisasis = Organisasi::aktif()
            ->with([
                'pengurus' => function ($q) {
                    $q->where('level', 'inti')
                        ->orderBy('urutan', 'asc')
                        ->orderBy('jabatan', 'asc');
                },
                'amalUsaha',
            ])
            ->orderBy('tipe')
            ->orderBy('nama')
            ->get();

        $amalUsahaList = AmalUsaha::with('organisasiOtonom')
            ->whereHas('organisasiOtonom')
            ->orderBy('created_at', 'desc')
            ->get();

        $amalUsahaGrouped = $amalUsahaList->groupBy('tipe')
            ->map(function ($items, $tipe) {
                return [
                    'tipe' => $tipe,
                    'items' => $items,
                    'count' => $items->count(),
                ];
            })
            ->values();

        $totalAnggota = Pengurus::where('is_active', true)->count();

        $tahunMulai = Organisasi::min('periode_mulai') ?? date('Y');
        $tahunSelesai = Organisasi::max('periode_selesai') ?? date('Y') + 5;
        $periode = $tahunMulai.'–'.$tahunSelesai;

        foreach ($organisasis as $org) {
            // Cari ketua
            $org->ketua = $org->pengurus->first(function ($p) {
                return strtolower(trim($p->jabatan)) === 'ketua';
            })?->nama ?? null;

            // Cari sekretaris - PASTIKAN pakai trim()
            $org->sekretaris = $org->pengurus->first(function ($p) {
                return strtolower(trim($p->jabatan)) === 'sekretaris';
            })?->nama ?? null;

            // Cari bendahara
            $org->bendahara = $org->pengurus->first(function ($p) {
                return strtolower(trim($p->jabatan)) === 'bendahara';
            })?->nama ?? null;
        }

        $currentYear = now()->year;
        $kajianPerTahun = Jadwal::whereYear('tanggal', $currentYear)->count();

        return view('welcome', [
            'hero' => $hero,
            'articles' => $articles,
            'totalArticlesCount' => $totalArticlesCount,
            'latestBerita' => $latestBerita,
            'jadwals' => $jadwals,
            'jadwalJson' => $allJadwalsRaw->map(fn ($j) => [
                'nama_kegiatan' => $j->nama_kegiatan,
                'tanggal' => Carbon::parse($j->tanggal)->format('Y-m-d'),
                'waktu' => Carbon::parse($j->waktu)->format('H:i'),
                'lokasi' => $j->lokasi,
                'deskripsi' => $j->deskripsi,
            ])->values(),
            'jadwalCount' => $allJadwalsRaw->count(),
            'kajianPerTahun' => $kajianPerTahun,
            'currentYear' => $currentYear,
            'organisasis' => $organisasis,
            'totalAnggota' => $totalAnggota,
            'periode' => $periode,
            'amalUsahaGrouped' => $amalUsahaGrouped,
            'amalUsahaList' => $amalUsahaList,
            'heroSections' => $heroSections,
        ]);
    }

    public function showProfil()
    {
        $profil = ProfileOrganisasi::latest('created_at')->first();

        return view('pages.profil', compact('profil'));
    }

    public function showKontak()
    {
        return view('pages.kontak');
    }

    public function showPrm()
    {
        $jadwals = Jadwal::where('tanggal', '>=', today())
            ->orderBy('tanggal', 'asc')
            ->orderBy('waktu', 'asc')
            ->limit(9)
            ->get();

        $amalUsahaList = AmalUsaha::with('organisasiOtonom')
            ->whereHas('organisasiOtonom')
            ->orderBy('created_at', 'desc')
            ->get();

        $amalUsahaGrouped = $amalUsahaList->groupBy('tipe')
            ->map(function ($items, $tipe) {
                return [
                    'tipe' => $tipe,
                    'items' => $items,
                    'count' => $items->count(),
                ];
            })
            ->values();

        return view('pages.prm', [
            'jadwals' => $jadwals,
            'amalUsahaGrouped' => $amalUsahaGrouped,
        ]);
    }

    public function showArticle($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        return view('pages.admin.articles.article-detail', compact('article'));
    }

    public function showAllArticles()
    {
        $articles = Article::where('status', 'published')
            ->latest('created_at')
            ->paginate(10);

        return view('pages.articles.show-all', compact('articles'));
    }

    public function showStrukturOrganisasi()
    {
        $strukturs = StrukturOrganisasi::orderBy('peran_level')
            ->orderBy('urutan')
            ->get();

        return view('struktur-organisasi', compact('strukturs'));
    }

    public function showAllBerita(Request $request)
    {
        $kategori = $request->query('kategori');

        $query = Berita::with('user')->where('status', 'published')->latest();

        if ($kategori && in_array($kategori, ['dakwah', 'pendidikan', 'sosial', 'organisasi'])) {
            $query->where('kategori', $kategori);
        }

        $berita = $query->paginate(10)->through(function ($item) {
            return [
                'id' => $item->id,
                'judul' => $item->judul,
                'slug' => $item->slug,
                'isi' => $item->isi,
                'excerpt' => Str::limit(strip_tags($item->isi), 140),
                'gambar' => $item->gambar ? asset('storage/'.$item->gambar) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&fit=crop',
                'kategori' => $item->kategori,
                'status' => $item->status,
                'created_at' => $item->created_at,
                'author' => $item->user->name ?? 'Tim Redaksi',
            ];
        });

        return view('pages.berita.berita-show', compact('berita', 'kategori'));
    }

    public function showBerita($berita)
    {
        $berita = Berita::where('slug', $berita)
            ->where('status', 'published')
            ->firstOrFail();

        $berita->gambar = $berita->gambar
            ? asset('storage/'.$berita->gambar)
            : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&fit=crop';

        return view('pages.berita.berita-detail', compact('berita'));
    }

    public function showOrganisasiOtonom(string $slug)
    {
        $org = Organisasi::aktif()
            ->where('slug', $slug)
            ->with(['pengurus' => fn ($q) => $q->orderBy('urutan')->orderBy('jabatan')])
            ->firstOrFail();

        // Pengurus inti (ketua, sekretaris, bendahara)
        $pengurusInti = $org->pengurus->filter(fn ($p) => $p->level === 'inti');

        // Semua pengurus
        $allPengurus = $org->pengurus;

        // Total anggota aktif
        $totalPengurus = $org->pengurus->where('is_active', true)->count();

        // Resolusi jabatan inti
        $org->ketua = $pengurusInti->first(fn ($p) => strtolower(trim($p->jabatan)) === 'ketua')?->nama;
        $org->sekretaris = $pengurusInti->first(fn ($p) => strtolower(trim($p->jabatan)) === 'sekretaris')?->nama;
        $org->bendahara = $pengurusInti->first(fn ($p) => strtolower(trim($p->jabatan)) === 'bendahara')?->nama;

        return view('pages.otonom.show-organisasi-otonom', compact(
            'org',
            'pengurusInti',
            'allPengurus',
            'totalPengurus',
        ));
    }

    public function showAnggotaOrganisasi(string $slug)
    {
        // Cari organisasi berdasarkan slug
        $organisasi = Organisasi::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Ambil semua pengurus aktif dari organisasi ini
        $penguruses = Pengurus::where('organisasi_otonom_id', $organisasi->id)
            ->where('is_active', true)
            ->orderBy('urutan')
            ->orderBy('nama')
            ->get();

        return view('pages.otonom.organisasi-anggota', compact('penguruses', 'organisasi'));
    }

    public function showAmalUsaha()
    {
        $amalUsahaList = AmalUsaha::with('organisasiOtonom')
            ->whereHas('organisasiOtonom')
            ->orderBy('tipe')
            ->orderBy('nama')
            ->get();

        $kategori = collect([
            [
                'tipe' => 'bidang_pendidikan',
                'slug' => 'bidang-pendidikan',
                'label' => 'Bidang Pendidikan',
                'icon' => 'graduation-cap',
                'description' => 'Sekolah dan layanan pendidikan Muhammadiyah untuk membentuk generasi berilmu dan berakhlak.',
            ],
            [
                'tipe' => 'bidang_kesehatan',
                'slug' => 'bidang-kesehatan',
                'label' => 'Bidang Kesehatan',
                'icon' => 'heart-pulse',
                'description' => 'Layanan kesehatan yang hadir untuk membantu kebutuhan masyarakat Duren Sawit.',
            ],
            [
                'tipe' => 'bidang_sosial',
                'slug' => 'bidang-kesejahteraan-sosial',
                'label' => 'Kesejahteraan Sosial',
                'icon' => 'hand-heart',
                'description' => 'Gerakan sosial dan pelayanan umat yang memberi manfaat langsung bagi masyarakat.',
            ],
        ])->map(function ($item) use ($amalUsahaList) {
            $item['count'] = $amalUsahaList->where('tipe', $item['tipe'])->count();

            return $item;
        });

        $organisasiCounts = $amalUsahaList
            ->groupBy('organisasi_otonom_id')
            ->map(function ($items) {
                return [
                    'organisasi' => $items->first()->organisasiOtonom,
                    'count' => $items->count(),
                ];
            })
            ->sortBy(fn ($group) => $group['organisasi']->nama)
            ->values();

        return view('pages.amal-usaha.landing', [
            'amalUsahaList' => $amalUsahaList,
            'kategoriList' => $kategori,
            'organisasiCounts' => $organisasiCounts,
        ]);
    }

    public function showAmalUsahaByKategori(string $kategori)
    {
        // Mapping slug URL → enum di DB
        $tipeMappings = [
            'bidang-pendidikan' => 'bidang_pendidikan',
            'bidang-kesehatan' => 'bidang_kesehatan',
            'bidang-kesejahteraan-sosial' => 'bidang_sosial',
            'bidang-sosial' => 'bidang_sosial',
        ];

        if (! array_key_exists($kategori, $tipeMappings)) {
            abort(404);
        }

        $tipe = $tipeMappings[$kategori];

        $labelMappings = [
            'bidang_pendidikan' => 'Bidang Pendidikan',
            'bidang_kesehatan' => 'Bidang Kesehatan',
            'bidang_sosial' => 'Bidang Kesejahteraan Sosial',
        ];

        $amalUsahaList = AmalUsaha::with('organisasiOtonom')
            ->where('tipe', $tipe)
            ->orderBy('nama')
            ->get();

        $label = $labelMappings[$tipe];

        // Daftar kategori untuk tab navigasi
        $allKategori = [
            ['slug' => 'bidang-pendidikan',           'label' => 'Bidang Pendidikan'],
            ['slug' => 'bidang-kesehatan',             'label' => 'Bidang Kesehatan'],
            ['slug' => 'bidang-kesejahteraan-sosial',  'label' => 'Bidang Kesejahteraan Sosial'],
        ];

        return view('pages.amal-usaha.index', compact(
            'amalUsahaList',
            'label',
            'kategori',
            'allKategori',
            'tipe',
        ));
    }
}
