@extends('layouts.colormag')

@section('title', ($kategori ? ucfirst($kategori) . ' — ' : '') . 'Berita & Informasi — PCM Duren Sawit 1')
@section('meta_description', 'Kumpulan berita, artikel, dan kabar kegiatan Pimpinan Cabang Muhammadiyah Duren Sawit 1' . ($kategori ? ' kategori ' . $kategori : '') . '.')
@section('meta_keywords', 'Berita Muhammadiyah, PCM Duren Sawit 1, Duren Sawit, Kegiatan Muhammadiyah' . ($kategori ? ', ' . $kategori : ''))
@section('og_image', asset('images/logo.png'))

@php
    $cmBulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $tglId = function ($date) use ($cmBulan) {
        $d = \Carbon\Carbon::parse($date);
        return $d->format('j') . ' ' . ($cmBulan[(int)$d->format('n')] ?? '') . ' ' . $d->format('Y');
    };
    $beritaCollection = collect($berita->items());
    $total = $berita->total();
    $featured = $berita->currentPage() == 1 ? $beritaCollection->first() : null;
    $filterTabs = [
        '' => 'Semua',
        'dakwah' => 'Dakwah',
        'pendidikan' => 'Pendidikan',
        'sosial' => 'Sosial',
        'organisasi' => 'Organisasi',
    ];
@endphp

@section('content')
    <div class="cm-inner px-2.5">

        {{-- Breadcrumb --}}
        <nav aria-label="Breadcrumb" class="text-[12px] text-[#888888] mb-4">
            <a href="/" class="text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">Beranda</a>
            <span class="mx-1">/</span> Berita &amp; Informasi
        </nav>

        {{-- Header widget --}}
        <h1 class="cm-widget-title !text-[22px]"><span>Berita &amp; Informasi</span></h1>
        <p class="text-[13px] text-[#777777] mt-[-6px] mb-[25px]">
            Update terbaru dari aktivitas dan kegiatan PCM Duren Sawit 1.
        </p>

        {{-- Filter kategori --}}
        <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-[25px]" style="scrollbar-width:none;">
            @foreach($filterTabs as $slug => $label)
                <a href="{{ $slug ? route('berita.all', ['kategori' => $slug]) : route('berita.all') }}"
                    class="shrink-0 px-4 py-2 text-[12px] font-bold uppercase tracking-wide rounded-[3px] no-underline border cm-transition {{ ($kategori ?? '') === $slug ? 'bg-[#2e9e5b] border-[#2e9e5b] text-white' : 'border-[#dddddd] text-[#555555] hover:border-[#2e9e5b] hover:text-[#2e9e5b]' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[70.17%_1fr] gap-[30px] items-start pb-5">

            {{-- ══ PRIMARY ══ --}}
            <div class="min-w-0">

                @if ($total > 0)

                    {{-- Featured --}}
                    @if ($featured)
                        <article class="mb-[35px] cm-card-shadow border border-[#eaeaea]">
                            <a href="{{ route('berita.show', $featured['slug']) }}" class="block overflow-hidden no-underline">
                                <img src="{{ !empty($featured['gambar']) ? $featured['gambar'] : 'https://picsum.photos/seed/pcm-berita-feat-' . $featured['id'] . '/800/445' }}"
                                    alt="{{ $featured['judul'] }}"
                                    class="w-full aspect-[800/445] object-cover block hover:scale-[1.02] transition-transform duration-500"/>
                            </a>
                            <div class="p-5 pt-3.5">
                                <div class="mb-1.5">
                                    <span class="cm-cat-badge">{{ ucfirst($featured['kategori'] ?? 'Umum') }}</span>
                                </div>
                                <h2 class="cm-entry-title text-[22px] leading-snug font-semibold m-0">
                                    <a href="{{ route('berita.show', $featured['slug']) }}">{{ $featured['judul'] }}</a>
                                </h2>
                                <div class="cm-meta mt-1.5">
                                    <span><i data-lucide="calendar"></i>{{ $tglId($featured['created_at']) }}</span>
                                </div>
                                <p class="text-[14px] text-[#444444] leading-relaxed mt-2 mb-3 line-clamp-3">{{ $featured['excerpt'] }}</p>
                                <a href="{{ route('berita.show', $featured['slug']) }}"
                                    class="inline-flex items-center gap-1 text-[12px] font-bold uppercase tracking-wide text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">
                                    Baca Selengkapnya <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                </a>
                            </div>
                        </article>
                    @endif

                    {{-- Grid sisanya --}}
                    @php $gridItems = $berita->currentPage() == 1 ? $beritaCollection->skip(1) : $beritaCollection; @endphp

                    @if($gridItems->isNotEmpty())
                        <h3 class="cm-widget-title"><span>Berita Lainnya</span></h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-[25px] mb-[35px]">
                            @foreach ($gridItems as $item)
                                <x-post-card
                                    :link="route('berita.show', $item['slug'])"
                                    :image="!empty($item['gambar']) ? $item['gambar'] : 'https://picsum.photos/seed/pcm-duren-sawit-berita-' . $item['id'] . '/600/360'"
                                    :title="$item['judul']"
                                    :category="ucfirst($item['kategori'] ?? 'Umum')"
                                    :author="$item['author'] ?? 'Tim Redaksi'"
                                    :date="$tglId($item['created_at'])"
                                    :excerpt="Str::limit(strip_tags($item['isi'] ?? $item['excerpt'] ?? ''), 120)"
                                />
                            @endforeach
                        </div>
                    @endif

                    {{-- Pagination --}}
                    <div class="flex justify-center">
                        {{ $berita->appends(request()->query())->links('partials.pagination') }}
                    </div>

                @else
                    <div class="text-center py-20 border border-[#eaeaea] bg-white">
                        <i data-lucide="newspaper" class="w-12 h-12 mx-auto text-[#cccccc]"></i>
                        <p class="text-[14px] text-[#777777] mt-4">Belum ada berita yang dipublikasikan.</p>
                    </div>
                @endif

            </div>

            {{-- ══ SIDEBAR ══ --}}
            @include('partials.cm-sidebar')

        </div>
    </div>
@endsection
