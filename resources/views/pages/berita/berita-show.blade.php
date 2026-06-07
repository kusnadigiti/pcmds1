@extends('layouts.frontend')

@section('title', 'Berita — PCM Duren Sawit 1')

@section('styles')
    <style>
        .serif { font-family: 'Playfair Display', serif; }

        /* Image zoom */
        .card-img  { transition: transform 6s ease; }
        .berita-card:hover .card-img  { transform: scale(1.06); }
        .feat-img  { transition: transform 8s ease; }
        .feat-card:hover .feat-img { transform: scale(1.04); }

        /* Fade up */
        @keyframes fadeUp {
            from { opacity:0; transform:translateY(20px); }
            to   { opacity:1; transform:translateY(0); }
        }
        .au { animation: fadeUp .6s cubic-bezier(.4,0,.2,1) both; }
        .d1 { animation-delay:.05s; } .d2 { animation-delay:.13s; }
        .d3 { animation-delay:.21s; } .d4 { animation-delay:.29s; }
    </style>
@endsection

@section('content')
    {{-- ══════════ PAGE HEADER ══════════ --}}
    <div class="pt-[68px] bg-cream">
        <div class="max-w-7xl mx-auto px-8 pt-20 pb-12 relative overflow-hidden">
            <span class="hidden md:block absolute right-8 top-1/2 -translate-y-1/2 serif italic text-[10rem] leading-none text-[#eae6df] select-none pointer-events-none" id="big-num">
                {{ $berita->total() }}
            </span>

            <div class="flex flex-wrap items-end justify-between gap-4 relative z-10">
                <div>
                    <span class="inline-flex items-center gap-2 mb-4">
                        <span class="w-8 h-[1px] bg-secondary"></span>
                        <span class="text-[0.68rem] tracking-[0.16em] uppercase text-secondary font-semibold">Berita Terkini</span>
                    </span>
                    <h1 class="serif text-5xl md:text-6xl text-accent font-semibold">Semua <em class="italic text-primary font-normal">Berita</em></h1>
                </div>
                <p class="text-sm text-gray-500 max-w-xs leading-relaxed au d3">
                    Update terbaru dari aktivitas dan kegiatan PCM Duren Sawit 1.
                </p>
            </div>

            <a href="/" class="inline-flex items-center justify-center px-6 py-2.5 mt-8 text-sm font-medium text-white bg-primary hover:bg-primary-light transition-all rounded-full shadow-sm">
                Kembali
            </a>

            <div class="h-[1px] bg-gray-200 mt-10"></div>
        </div>
    </div>

    @php
        $beritaCollection = collect($berita->items());
        $total = $berita->total();
        $featured = $berita->currentPage() == 1 ? $beritaCollection->first() : null;
    @endphp

    @if ($total > 0)

        {{-- ══════════ FILTER TABS ══════════ --}}
        <div class="flex items-center gap-3 overflow-x-auto pb-4 scrollbar-none max-w-7xl mx-auto px-8 mt-8 au d4">
            <a href="{{ route('berita.all') }}" class="px-5 py-2 text-xs font-semibold uppercase tracking-wider border rounded-full transition-all duration-300 no-underline {{ !$kategori ? 'border-accent bg-accent text-white hover:text-white' : 'border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">Semua</a>
            <a href="{{ route('berita.all', ['kategori' => 'dakwah']) }}" class="px-5 py-2 text-xs font-semibold uppercase tracking-wider border rounded-full transition-all duration-300 no-underline {{ $kategori === 'dakwah' ? 'border-primary bg-primary text-white hover:text-white' : 'border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">Dakwah</a>
            <a href="{{ route('berita.all', ['kategori' => 'pendidikan']) }}" class="px-5 py-2 text-xs font-semibold uppercase tracking-wider border rounded-full transition-all duration-300 no-underline {{ $kategori === 'pendidikan' ? 'border-blue-600 bg-blue-600 text-white hover:text-white' : 'border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">Pendidikan</a>
            <a href="{{ route('berita.all', ['kategori' => 'sosial']) }}" class="px-5 py-2 text-xs font-semibold uppercase tracking-wider border rounded-full transition-all duration-300 no-underline {{ $kategori === 'sosial' ? 'border-orange-600 bg-orange-600 text-white hover:text-white' : 'border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">Sosial</a>
            <a href="{{ route('berita.all', ['kategori' => 'organisasi']) }}" class="px-5 py-2 text-xs font-semibold uppercase tracking-wider border rounded-full transition-all duration-300 no-underline {{ $kategori === 'organisasi' ? 'border-purple-600 bg-purple-600 text-white hover:text-white' : 'border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">Organisasi</a>
        </div>

        {{-- ══════════ FEATURED ══════════ --}}
        @if ($featured)
        <div class="max-w-7xl mx-auto px-8 my-12" id="featured-wrap">
            <a href="{{ route('berita.show', $featured['slug']) }}" class="feat-card group block bg-white rounded-3xl overflow-hidden border border-gray-100 hover:border-primary/20 hover:shadow-xl transition-all duration-500">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">
                    <div class="lg:col-span-7 relative aspect-[16/10] lg:aspect-auto lg:h-[400px] overflow-hidden bg-gray-100">
                        @if (!empty($featured['gambar']))
                            <img src="{{ $featured['gambar'] }}" alt="{{ $featured['judul'] }}" class="feat-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#eae6df] to-[#d8d3ca]">
                                <span class="serif italic text-7xl text-black/10 select-none">{{ strtoupper(substr($featured['judul'], 0, 1)) }}</span>
                            </div>
                        @endif
                        <span class="absolute top-6 left-6 px-4 py-1.5 text-[0.62rem] font-bold tracking-widest uppercase bg-secondary text-white rounded-full shadow-sm">Terbaru</span>
                    </div>

                    <div class="lg:col-span-5 p-8 lg:p-12 flex flex-col justify-center">
                        <div class="flex items-center gap-3 text-xs text-gray-400 mb-4">
                            @php
                                $catFeat = strtolower($featured['kategori'] ?? '');
                                $badgeColor = 'bg-gray-100 text-gray-700';
                                if ($catFeat === 'dakwah') $badgeColor = 'bg-primary/10 text-primary';
                                elseif ($catFeat === 'pendidikan') $badgeColor = 'bg-blue-50 text-blue-600';
                                elseif ($catFeat === 'sosial') $badgeColor = 'bg-orange-50 text-orange-600';
                                elseif ($catFeat === 'organisasi') $badgeColor = 'bg-purple-50 text-purple-600';
                            @endphp
                            <span class="px-3 py-1 text-[0.65rem] font-semibold uppercase tracking-wider rounded-full {{ $badgeColor }}">{{ $featured['kategori'] ?? 'Umum' }}</span>
                            <span>·</span>
                            <span>{{ \Carbon\Carbon::parse($featured['created_at'])->diffForHumans() }}</span>
                        </div>

                        <h2 class="serif text-2xl lg:text-3xl text-accent font-semibold leading-tight group-hover:text-primary transition-colors duration-300">{{ $featured['judul'] }}</h2>
                        <p class="text-sm text-gray-500 leading-relaxed mt-3 mb-6 line-clamp-3">{{ $featured['excerpt'] }}</p>

                        <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-secondary group-hover:text-secondary-light transition-colors">
                            Baca Berita
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif

        {{-- ══════════ SECTION LABEL ══════════ --}}
        @if ($total > ($featured ? 1 : 0))
            <div class="max-w-7xl mx-auto px-8 my-8 flex items-center justify-between gap-4">
                <span class="text-[0.68rem] font-bold tracking-[0.16em] uppercase text-gray-400">Berita Lainnya</span>
                <div class="flex-1 h-[1px] bg-gray-200"></div>
            </div>

            {{-- ══════════ STANDARD GRID ══════════ --}}
            <div class="max-w-7xl mx-auto px-8 mb-16">
                <div id="berita-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @php
                        $gridItems = $berita->currentPage() == 1 ? $beritaCollection->skip(1) : $beritaCollection;
                    @endphp
                    @foreach ($gridItems as $i => $item)
                        @php
                            $kat = strtolower($item['kategori'] ?? '');
                            $catColor = 'bg-gray-100 text-gray-700';
                            if ($kat === 'dakwah') $catColor = 'bg-primary/10 text-primary';
                            elseif ($kat === 'pendidikan') $catColor = 'bg-blue-50 text-blue-600';
                            elseif ($kat === 'sosial') $catColor = 'bg-orange-50 text-orange-600';
                            elseif ($kat === 'organisasi') $catColor = 'bg-purple-50 text-purple-600';
                        @endphp

                        <a href="{{ route('berita.show', $item['slug']) }}"
                            class="berita-card group block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md border border-primary/10 hover:border-secondary/40 transition-all duration-300 hover:-translate-y-1">

                            {{-- Image --}}
                            <div class="relative overflow-hidden aspect-[16/10] bg-gray-100">
                                @if (!empty($item['gambar']))
                                    <img src="{{ $item['gambar'] }}" alt="{{ $item['judul'] }}" class="card-img w-full h-full object-cover transition-transform duration-700" loading="lazy" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#eae6df] to-[#d8d3ca]">
                                        <span class="serif italic text-4xl text-black/10 select-none">{{ strtoupper(substr($item['judul'], 0, 1)) }}</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Body --}}
                            <div class="p-5 flex flex-col justify-between h-[220px]">
                                <div>
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="px-2.5 py-0.5 text-[0.6rem] font-bold uppercase tracking-wider rounded-full {{ $catColor }}">{{ $item['kategori'] ?? 'Umum' }}</span>
                                        <span class="text-gray-300 text-[10px]">·</span>
                                        <span class="text-[10px] text-gray-400 font-medium">{{ \Carbon\Carbon::parse($item['created_at'])->diffForHumans() }}</span>
                                    </div>
                                    <h3 class="serif text-lg leading-snug text-accent mb-2 group-hover:text-primary transition-colors duration-200 line-clamp-2">{{ $item['judul'] }}</h3>
                                    <p class="text-gray-500 text-xs leading-relaxed line-clamp-2">{{ $item['excerpt'] }}</p>
                                </div>
                                <div class="flex items-center justify-between pt-3 border-t border-primary/5 mt-auto">
                                    <span class="text-xs font-bold text-secondary group-hover:translate-x-0.5 transition-transform duration-200 inline-block">Baca Berita →</span>
                                    <span class="text-[10px] text-gray-400 font-medium">{{ \Carbon\Carbon::parse($item['created_at'])->format('d M Y') }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Pagination Links --}}
            <div class="max-w-7xl mx-auto px-8 pb-20 flex justify-center">
                {{ $berita->appends(request()->query())->links('partials.pagination') }}
            </div>

        @endif
    @else
        <div class="max-w-7xl mx-auto px-8 py-20 text-center">
            <p class="serif text-5xl text-gray-300 mb-4">— ✦ —</p>
            <p class="text-sm text-gray-500">Belum ada berita yang dipublikasikan.</p>
        </div>
    @endif
@endsection
