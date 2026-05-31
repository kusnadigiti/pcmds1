<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Berita;
use App\Models\Jadwal;
use App\Models\Organisasi;
use App\Models\Pengurus;
use App\Models\ProfileOrganisasi;
use App\Models\StrukturOrganisasi;
use App\Models\HeroSections;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LandingController extends Controller
{

    public function index()
    {
        $hero = ProfileOrganisasi::latest('created_at')->first();
        $heroSections = HeroSections::latest()->get();

        $articles = Article::where('status', 'published')
            ->latest('created_at')
            ->get();

        $latestBerita = Berita::where('status', 'published')
            ->latest('created_at')
            ->limit(3)
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
            ->with(['pengurus' => function ($q) {
                $q->where('level', 'inti')
                    ->orderBy('urutan', 'asc')
                    ->orderBy('jabatan', 'asc');
            }])
            ->orderBy('tipe')
            ->orderBy('nama')
            ->get();

        $amalUsahaGrouped = \App\Models\AmalUsaha::with('organisasiOtonom')
            ->whereHas('organisasiOtonom')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('tipe')
            ->map(function ($items, $tipe) {

                $allOrgs = $items
                    ->filter(fn($item) => $item->organisasiOtonom)
                    ->unique('organisasi_otonom_id')
                    ->values();

                $latestItem = $items->first();

                return [
                    'tipe' => $tipe,
                    'items' => $allOrgs,
                    'count' => $allOrgs->count(),
                    'latestDesc' => $latestItem?->deskripsi,
                    'latestDescTitle' => $latestItem?->nama,
                ];
            })
            ->filter(fn($group) => $group['count'] > 0)
            ->values();


        $totalAnggota = Pengurus::where('is_active', true)->count();

        $tahunMulai = Organisasi::min('periode_mulai') ?? date('Y');
        $tahunSelesai = Organisasi::max('periode_selesai') ?? date('Y') + 5;
        $periode = $tahunMulai . '–' . $tahunSelesai;

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
            'hero'            => $hero,
            'articles'        => $articles,
            'latestBerita'    => $latestBerita,
            'jadwals'         => $jadwals,
            'jadwalJson'      => $allJadwalsRaw->map(fn($j) => [
                'nama_kegiatan' => $j->nama_kegiatan,
                'tanggal'       => \Carbon\Carbon::parse($j->tanggal)->format('Y-m-d'),
                'waktu'         => \Carbon\Carbon::parse($j->waktu)->format('H:i'),
                'lokasi'        => $j->lokasi,
                'deskripsi'     => $j->deskripsi,
            ])->values(),
            'jadwalCount'     => $allJadwalsRaw->count(),
            'kajianPerTahun'  => $kajianPerTahun,
            'currentYear'     => $currentYear,
            'organisasis'     => $organisasis,
            'totalAnggota'    => $totalAnggota,
            'periode'         => $periode,
            'amalUsahaGrouped' => $amalUsahaGrouped,
            'heroSections' => $heroSections,
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

    public function showAllBerita()
    {
        $berita = Berita::where('status', 'published')
            ->latest()
            ->get()
            ->map(function ($item) {
                return [
                    'id'         => $item->id,
                    'judul'      => $item->judul,
                    'slug'       => $item->slug,
                    'isi'        => $item->isi,
                    'excerpt'    => Str::limit(strip_tags($item->isi), 140),
                    'gambar'     => $item->gambar ? asset('storage/' . $item->gambar) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&fit=crop',
                    'kategori'   => $item->kategori,
                    'status'     => $item->status,
                    'created_at' => $item->created_at,
                ];
            });

        return view('pages.berita.berita-show', compact('berita'));
    }

    public function showBerita($berita)
    {
        $berita = Berita::where('slug', $berita)
            ->where('status', 'published')
            ->firstOrFail();

        $berita->gambar = $berita->gambar
            ? asset('storage/' . $berita->gambar)
            : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&fit=crop';

        return view('pages.berita.berita-detail', compact('berita'));
    }

    public function showOrganisasiOtonom(string $slug)
    {
        $org = Organisasi::aktif()
            ->where('slug', $slug)
            ->with(['pengurus' => fn($q) => $q->orderBy('urutan')->orderBy('jabatan')])
            ->firstOrFail();

        // Pengurus inti (ketua, sekretaris, bendahara)
        $pengurusInti = $org->pengurus->filter(fn($p) => $p->level === 'inti');

        // Semua pengurus
        $allPengurus = $org->pengurus;

        // Total anggota aktif
        $totalPengurus = $org->pengurus->where('is_active', true)->count();

        // Resolusi jabatan inti
        $org->ketua = $pengurusInti->first(fn($p) => strtolower(trim($p->jabatan)) === 'ketua')?->nama;
        $org->sekretaris = $pengurusInti->first(fn($p) => strtolower(trim($p->jabatan)) === 'sekretaris')?->nama;
        $org->bendahara = $pengurusInti->first(fn($p) => strtolower(trim($p->jabatan)) === 'bendahara')?->nama;

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
}
