@extends('layouts.colormag')

@section('title', 'PCM Duren Sawit 1 | Muhammadiyah Berkemajuan')
@section('meta_description', 'Pimpinan Cabang Muhammadiyah Duren Sawit 1 - Mencerahkan Semesta, Memajukan Duren Sawit. Portal resmi berita, kajian, organisasi otonom, dan amal usaha Muhammadiyah Duren Sawit 1.')
@section('meta_keywords', 'PCM Duren Sawit 1, Muhammadiyah Duren Sawit, Kajian Islam, Amal Usaha Muhammadiyah, Berita Muhammadiyah, Jakarta Timur')
@section('og_image', asset('images/logo.png'))

@php
    // Helper tanggal Indonesia (locale aplikasi en, jadi format manual)
    $cmBulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $cmBulanPendek = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    $tglId = function ($date) use ($cmBulan) {
        $d = \Carbon\Carbon::parse($date);
        return $d->format('j') . ' ' . ($cmBulan[(int)$d->format('n')] ?? '') . ' ' . $d->format('Y');
    };

    $kategoriLabel = [
        'dakwah' => 'Dakwah',
        'pendidikan' => 'Pendidikan',
        'sosial' => 'Sosial',
        'organisasi' => 'Organisasi',
        'kesehatan' => 'Kesehatan',
        'ekonomi' => 'Ekonomi',
    ];
@endphp

@section('schema')
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@graph": [
        {
          "@@type": "Organization",
          "@@id": "{{ url('/') }}#organization",
          "name": "PCM Duren Sawit 1",
          "alternateName": "Pimpinan Cabang Muhammadiyah Duren Sawit 1",
          "url": "{{ url('/') }}",
          "logo": "{{ asset('images/logo.png') }}",
          "description": "Pimpinan Cabang Muhammadiyah Duren Sawit 1 - Mencerahkan Semesta, Memajukan Duren Sawit."
        },
        {
          "@@type": "WebSite",
          "@@id": "{{ url('/') }}#website",
          "url": "{{ url('/') }}",
          "name": "PCM Duren Sawit 1",
          "publisher": { "@@id": "{{ url('/') }}#organization" },
          "inLanguage": "id-ID"
        }
      ]
    }
    </script>
@endsection

@section('content')
    <div class="cm-inner px-2.5">

        {{-- ═══ HERO SLIDER ═══ --}}
        @if($heroSections->count() > 0)
            <section class="mb-[30px] relative" id="cm-slider"
                x-data="{ current: 0, total: {{ $heroSections->count() }} }"
                @mouseenter="paused = true" @mouseleave="paused = false">

                @foreach($heroSections as $index => $heroSlide)
                    <div class="cm-slide {{ $index === 0 ? 'cm-slide-active' : '' }}" data-slide="{{ $index }}">
                        <a href="{{ $heroSections->count() > 1 ? '#' : route('berita.all') }}" class="block relative overflow-hidden no-underline group" tabindex="-1">
                            @if($heroSlide->image)
                                <img src="{{ asset('storage/' . $heroSlide->image) }}" alt="{{ $heroSlide->title }}"
                                    class="w-full h-[280px] md:h-[420px] object-cover block"/>
                            @else
                                <div class="w-full h-[280px] md:h-[420px] bg-gradient-to-br from-[#232323] via-[#1f4a33] to-[#2e9e5b]"></div>
                            @endif

                            {{-- Gradient overlay bawah --}}
                            <div class="absolute inset-x-0 bottom-0 h-3/5 bg-gradient-to-t from-black/70 to-transparent pointer-events-none"></div>

                            {{-- Konten overlay --}}
                            <div class="absolute left-0 bottom-0 p-5 md:p-7 max-w-[85%]">
                                <span class="cm-cat-badge mb-2">{{ $heroSlide->tagline ?? 'PCM Duren Sawit 1' }}</span>
                                <h2 class="text-white text-lg md:text-[22px] font-semibold m-0 mb-1.5 leading-snug drop-shadow-sm">{{ $heroSlide->title }}</h2>
                                @if($heroSlide->description)
                                    <p class="hidden md:block text-white/90 text-[13px] m-0 max-w-[65ch] line-clamp-2">{{ $heroSlide->description }}</p>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach

                @if($heroSections->count() > 1)
                    {{-- Prev / Next --}}
                    <button onclick="cmSlidePrev()" aria-label="Sebelumnya"
                        class="absolute left-3 top-1/2 -translate-y-1/2 z-10 w-9 h-9 bg-black/35 hover:bg-[#2e9e5b] text-white border-0 rounded-none cursor-pointer flex items-center justify-center transition-colors duration-300">
                        <i data-lucide="chevron-left" class="w-5 h-5"></i>
                    </button>
                    <button onclick="cmSlideNext()" aria-label="Berikutnya"
                        class="absolute right-3 top-1/2 -translate-y-1/2 z-10 w-9 h-9 bg-black/35 hover:bg-[#2e9e5b] text-white border-0 rounded-none cursor-pointer flex items-center justify-center transition-colors duration-300">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </button>

                    {{-- Dots --}}
                    <div class="absolute bottom-3 right-4 z-10 flex gap-1.5">
                        @foreach($heroSections as $i => $s)
                            <button data-dot="{{ $i }}" onclick="cmGoTo({{ $i }})" aria-label="Slide {{ $i + 1 }}"
                                class="h-[10px] w-[10px] p-0 border-0 cursor-pointer bg-white/50 hover:bg-white transition-colors duration-300"
                                style="{{ $i === 0 ? 'background:#fff;' : '' }}"></button>
                        @endforeach
                    </div>
                @endif
            </section>
        @endif

        {{-- ═══ GRID UTAMA 70 / 30 ═══ --}}
        <div class="grid grid-cols-1 lg:grid-cols-[70.17%_1fr] gap-[30px] items-start">

            {{-- ══ PRIMARY CONTENT ══ --}}
            <div class="min-w-0">

                {{-- Widget Berita Utama: 1 besar + kecil di samping --}}
                @if($latestBerita->isNotEmpty())
                    <section class="mb-[35px]" aria-label="Berita utama">
                        <h3 class="cm-widget-title"><span>Berita Utama</span></h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            {{-- First post: besar --}}
                            @php $first = $latestBerita->first(); @endphp
                            <article class="cm-card-shadow">
                                <a href="{{ route('berita.show', $first->slug) }}" class="block overflow-hidden no-underline">
                                    <img src="{{ $first->gambar ? asset('storage/' . $first->gambar) : 'https://picsum.photos/seed/pcm-duren-sawit-berita-' . $first->id . '/800/445' }}"
                                        alt="{{ $first->judul }}"
                                        class="w-full aspect-[800/445] object-cover block hover:scale-[1.03] transition-transform duration-500"
                                        loading="eager"/>
                                </a>
                                <div class="pt-3">
                                    <div class="mb-1.5">
                                        <span class="cm-cat-badge">{{ $kategoriLabel[$first->kategori] ?? ucfirst($first->kategori) }}</span>
                                    </div>
                                    <h2 class="cm-entry-title text-[22px] leading-snug font-semibold m-0">
                                        <a href="{{ route('berita.show', $first->slug) }}">{{ $first->judul }}</a>
                                    </h2>
                                    <div class="cm-meta mt-1.5">
                                        <span class="flex items-center gap-1"><i data-lucide="calendar" class="size-4"></i>{{ $tglId($first->created_at) }}</span>
                                    </div>
                                    <p class="text-[14px] text-[#444444] leading-relaxed mt-2 mb-0 line-clamp-3">{!! Str::limit(strip_tags($first->isi), 150) !!}</p>
                                </div>
                            </article>

                            {{-- Following posts: kecil horizontal --}}
                            <div class="flex flex-col gap-5">
                                @foreach($latestBerita->skip(1)->take(2) as $item)
                                    <article class="flex gap-3.5">
                                        <a href="{{ route('berita.show', $item->slug) }}" class="shrink-0 w-[110px] overflow-hidden no-underline self-start">
                                            <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://picsum.photos/seed/pcm-duren-sawit-berita-' . $item->id . '/400/260' }}"
                                                alt="{{ $item->judul }}"
                                                class="w-full aspect-[400/260] object-cover block hover:scale-[1.05] transition-transform duration-500"
                                                loading="lazy"/>
                                        </a>
                                        <div class="min-w-0">
                                            <h3 class="cm-entry-title text-[15px] leading-snug font-semibold m-0 mb-1">
                                                <a href="{{ route('berita.show', $item->slug) }}">{{ $item->judul }}</a>
                                            </h3>
                                            <div class="cm-meta">
                                                <span class="flex items-center gap-1"><i data-lucide="calendar" class="size-4"></i>{{ $tglId($first->created_at) }}</span>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif

                {{-- Widget Berita Terbaru: kartu standar --}}
                <section class="mb-[35px]" aria-label="Berita terbaru">
                    <h3 class="cm-widget-title"><span>Berita Terbaru</span></h3>

                    @if($latestBerita->skip(3)->isEmpty())
                        <p class="text-[14px] text-[#777777]">Belum ada berita lain yang diterbitkan.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-[30px]">
                            @foreach($latestBerita->skip(3) as $item)
                                <x-post-card
                                    :link="route('berita.show', $item->slug)"
                                    :image="$item->gambar ? asset('storage/' . $item->gambar) : 'https://picsum.photos/seed/pcm-duren-sawit-berita-' . $item->id . '/600/360'"
                                    :title="$item->judul"
                                    :category="$kategoriLabel[$item->kategori] ?? ucfirst($item->kategori)"
                                    :author="$item->user->name ?? 'Tim Redaksi'"
                                    :date="$tglId($item->created_at)"
                                    :excerpt="Str::limit(strip_tags($item->isi), 120)"
                                />
                            @endforeach
                        </div>

                        <div class="mt-7 text-center">
                            <a href="{{ route('berita.all') }}"
                                class="inline-block border border-[#2e9e5b] text-[#2e9e5b] hover:bg-[#2e9e5b] hover:text-white text-[13px] font-semibold uppercase tracking-wide py-2.5 px-7 no-underline rounded-[3px] cm-transition">
                                Lihat Semua Berita
                            </a>
                        </div>
                    @endif
                </section>

                {{-- Widget Artikel --}}
                <section class="mb-[35px]" aria-label="Artikel dan opini">
                    <h3 class="cm-widget-title"><span>Artikel &amp; Opini</span></h3>

                    @if($articles->isEmpty())
                        <p class="text-[14px] text-[#777777]">Belum ada artikel yang diterbitkan.</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-[25px]">
                            @foreach($articles as $article)
                                <x-post-card
                                    :link="route('articles.show', $article->slug)"
                                    :image="$article->thumbnail ? asset('storage/' . $article->thumbnail) : 'https://picsum.photos/seed/pcm-duren-sawit-artikel-' . $article->id . '/600/360'"
                                    :title="$article->title"
                                    category="Artikel"
                                    :author="$article->author ?? 'Tim Redaksi'"
                                    :date="$tglId($article->created_at)"
                                    :excerpt="Str::limit(strip_tags($article->content), 120)"
                                />
                            @endforeach
                        </div>

                        <div class="mt-7 text-center">
                            <a href="{{ route('articles.show-all') }}"
                                class="inline-block border border-[#2e9e5b] text-[#2e9e5b] hover:bg-[#2e9e5b] hover:text-white text-[13px] font-semibold uppercase tracking-wide py-2.5 px-7 no-underline rounded-[3px] cm-transition">
                                Lihat Semua Artikel
                            </a>
                        </div>
                    @endif
                </section>

            </div>

            {{-- ══ SIDEBAR ══ --}}
            <aside class="min-w-0 text-[14px]" aria-label="Sidebar">

                {{-- Search box --}}
                <div class="mb-[35px]">
                    <form action="https://www.google.com/search" method="get" target="_blank" class="flex">
                        <input type="hidden" name="sitesearch" value="{{ request()->getHost() }}">
                        <input type="text" name="q" placeholder="Cari..."
                            aria-label="Pencarian"
                            class="min-w-0 flex-1 px-3 py-2 text-[13px] text-[#333333] bg-white border border-[#cccccc] border-r-0 focus:outline-none focus:border-[#2e9e5b] rounded-none"/>
                        <button type="submit" aria-label="Cari"
                            class="bg-[#2e9e5b] hover:bg-[#268a4f] text-white px-3.5 border-0 cursor-pointer rounded-r-[3px] transition-colors duration-300">
                            <i data-lucide="search" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>

                {{-- Jadwal kajian --}}
                <div class="mb-[35px]">
                    <h4 class="cm-widget-title"><span>Kajian Terdekat</span></h4>
                    @if($jadwals->isEmpty())
                        <p class="text-[13px] text-[#888888]">Belum ada jadwal kajian mendatang.</p>
                    @else
                        <ul class="list-none m-0 p-0 space-y-3.5">
                            @foreach($jadwals as $jadwal)
                                <li class="flex gap-3">
                                    <div class="shrink-0 w-[46px] text-center bg-[#2e9e5b] text-white rounded-[3px] py-1.5">
                                        <span class="block text-[18px] font-bold leading-none">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('j') }}</span>
                                        <span class="block text-[10px] uppercase mt-0.5">{{ $cmBulanPendek[(int)\Carbon\Carbon::parse($jadwal->tanggal)->format('n')] ?? '' }}</span>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="m-0 text-[13.5px] font-semibold text-[#333333] leading-snug">{{ $jadwal->nama_kegiatan }}</p>
                                        <p class="m-0 mt-0.5 text-[12px] text-[#888888]">
                                            {{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} WIB{{ $jadwal->lokasi ? ' · ' . $jadwal->lokasi : '' }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                {{-- Profil singkat --}}
                @if($hero)
                    <div class="mb-[35px]">
                        <h4 class="cm-widget-title"><span>Profil Organisasi</span></h4>
                        @if($hero->image)
                            <a href="#" class="block overflow-hidden mb-3 no-underline">
                                <img src="{{ asset('storage/' . $hero->image) }}" alt="{{ $hero->nama ?? 'Profil PCM Duren Sawit 1' }}"
                                    class="w-full aspect-[800/445] object-cover block" loading="lazy"/>
                            </a>
                        @endif
                        <p class="text-[13.5px] text-[#555555] leading-relaxed m-0">
                            {{ Str::limit(strip_tags($hero->visi ?? 'Pimpinan Cabang Muhammadiyah Duren Sawit 1, Mencerahkan Semesta Memajukan Duren Sawit.'), 160) }}
                        </p>
                    </div>
                @endif

                {{-- Organisasi otonom --}}
                <div class="mb-[35px]">
                    <h4 class="cm-widget-title"><span>Organisasi Otonom</span></h4>
                    <ul class="list-none m-0 p-0">
                        @forelse($organisasis as $org)
                            <li class="border-b border-[#eaeaea] last:border-b-0">
                                <a href="{{ route('organisasi-otonom.show', $org->slug) }}"
                                    class="flex items-center gap-2 py-2 text-[13.5px] text-[#444444] no-underline hover:text-[#2e9e5b] cm-transition">
                                    <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-[#2e9e5b] shrink-0"></i>
                                    {{ $org->nama }}
                                </a>
                            </li>
                        @empty
                            <li class="py-2 text-[13px] text-[#888888]">Belum ada data organisasi.</li>
                        @endforelse
                    </ul>
                </div>

                {{-- Amal usaha --}}
                <div class="mb-[35px]">
                    <h4 class="cm-widget-title"><span>Amal Usaha</span></h4>
                    <ul class="list-none m-0 p-0">
                        <li class="border-b border-[#eaeaea]">
                            <a href="{{ route('amal-usaha.by-kategori', 'bidang-pendidikan') }}"
                                class="flex items-center gap-2 py-2 text-[13.5px] text-[#444444] no-underline hover:text-[#2e9e5b] cm-transition">
                                <i data-lucide="graduation-cap" class="w-4 h-4 text-[#2e9e5b] shrink-0"></i> Bidang Pendidikan
                            </a>
                        </li>
                        <li class="border-b border-[#eaeaea]">
                            <a href="{{ route('amal-usaha.by-kategori', 'bidang-kesehatan') }}"
                                class="flex items-center gap-2 py-2 text-[13.5px] text-[#444444] no-underline hover:text-[#2e9e5b] cm-transition">
                                <i data-lucide="heart-pulse" class="w-4 h-4 text-[#2e9e5b] shrink-0"></i> Bidang Kesehatan
                            </a>
                        </li>
                        <li class="border-b border-[#eaeaea]">
                            <a href="{{ route('amal-usaha.by-kategori', 'bidang-kesejahteraan-sosial') }}"
                                class="flex items-center gap-2 py-2 text-[13.5px] text-[#444444] no-underline hover:text-[#2e9e5b] cm-transition">
                                <i data-lucide="hand-helping" class="w-4 h-4 text-[#2e9e5b] shrink-0"></i> Bidang Kesejahteraan Sosial
                            </a>
                        </li>
                    </ul>
                </div>

            </aside>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // ── Slider ColorMag-style ──
        (function () {
            const wrap = document.getElementById('cm-slider');
            if (!wrap) return;
            const slides = wrap.querySelectorAll('.cm-slide');
            if (slides.length < 2) return;
            let current = 0;
            let timer = null;
            let paused = false;

            function show(index) {
                slides.forEach((s, i) => s.classList.toggle('cm-slide-active', i === index));
                wrap.querySelectorAll('[data-dot]').forEach((d, i) => {
                    d.style.background = i === index ? '#ffffff' : '';
                });
                current = index;
            }

            window.cmSlideNext = () => show((current + 1) % slides.length);
            window.cmSlidePrev = () => show((current - 1 + slides.length) % slides.length);
            window.cmGoTo = (i) => show(i);

            function startAutoplay() {
                clearInterval(timer);
                timer = setInterval(() => { if (!paused) cmSlideNext(); }, 6000);
            }

            wrap.addEventListener('mouseenter', () => { paused = true; });
            wrap.addEventListener('mouseleave', () => { paused = false; });

            document.addEventListener('keydown', (e) => {
                if (window.location.pathname !== '/') return;
                if (e.key === 'ArrowRight') cmSlideNext();
                if (e.key === 'ArrowLeft') cmSlidePrev();
            });

            startAutoplay();
        })();
    </script>
@endsection
