@extends('layouts.frontend')

@section('title', 'Artikel — PCM Duren Sawit 1')

@section('styles')
    <style>
        .serif { font-family: 'DM Serif Display', serif; }

        /* Image zoom */
        .card-img  { transition: transform 6s ease; }
        .art-card:hover .card-img  { transform: scale(1.06); }
        .feat-img  { transition: transform 8s ease; }
        .feat-card:hover .feat-img { transform: scale(1.04); }

        /* Underline slide */
        .link-underline {
            background-image: linear-gradient(#0d5c3a, #0d5c3a);
            background-size: 0% 1px;
            background-repeat: no-repeat;
            background-position: 0 100%;
            transition: background-size .3s ease;
        }
        .link-underline:hover { background-size: 100% 1px; }

        /* Fade up */
        @keyframes fadeUp {
            from { opacity:0; transform:translateY(20px); }
            to   { opacity:1; transform:translateY(0); }
        }
        .au { animation: fadeUp .6s cubic-bezier(.4,0,.2,1) both; }
        .d1 { animation-delay:.05s; } .d2 { animation-delay:.13s; }
        .d3 { animation-delay:.29s; } .d4 { animation-delay:.29s; }

        /* Card reveal */
        @keyframes cardIn {
            from { opacity:0; transform:translateY(14px); }
            to   { opacity:1; transform:translateY(0); }
        }
        .card-revealed { animation: cardIn .38s cubic-bezier(.4,0,.2,1) both; }

        /* Hidden cards */
        .art-card.hidden-card { display: none; }

        /* Stagger first 6 */
        #articles-grid .art-card:nth-child(1) { animation-delay:.06s; }
        #articles-grid .art-card:nth-child(2) { animation-delay:.13s; }
        #articles-grid .art-card:nth-child(3) { animation-delay:.20s; }
        #articles-grid .art-card:nth-child(4) { animation-delay:.27s; }
        #articles-grid .art-card:nth-child(5) { animation-delay:.34s; }
        #articles-grid .art-card:nth-child(6) { animation-delay:.41s; }

        /* Big decorative count */
        .big-count {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(5rem, 11vw, 9rem);
            line-height: 1;
            color: rgba(13, 92, 58, 0.08);
            user-select: none;
            pointer-events: none;
        }
    </style>
@endsection

@section('content')
    {{-- ══════════ PAGE HEADER ══════════ --}}
    <div class="pt-20">
        <div class="max-w-screen-xl mx-auto px-6 pt-14 pb-8 relative overflow-hidden">

            <span class="big-count absolute right-6 top-1/2 -translate-y-1/2 hidden lg:block">
                {{ $articles->count() }}
            </span>

            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-5 au d1">
                    <span class="w-7 h-px bg-secondary block"></span>
                    <span class="text-xs font-semibold tracking-[.14em] uppercase text-secondary">Publikasi</span>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-3">
                    <h1 class="serif text-[clamp(2.4rem,5vw,4rem)] leading-[1.1] text-accent-green tracking-tight au d2">
                        Semua <span class="italic text-gray-500">Artikel</span>
                    </h1>
                    <p class="text-sm text-gray-600 max-w-xs leading-relaxed au d3">
                        Inspirasi dan nilai-nilai Islami untuk memperkuat iman dan wawasan.
                    </p>
                </div>
            </div>

            <a href="/" class="inline-flex items-center justify-center px-6 py-2.5 mt-8 text-sm font-medium text-white bg-primary hover:bg-primary-light transition-all rounded-full shadow-sm">
                Kembali
            </a>

            <div class="mt-10 h-px bg-primary/10"></div>
        </div>
    </div>

    {{-- ══════════ CONTENT ══════════ --}}
    @if($articles->count() > 0)

        @php $featured = $articles->first(); @endphp

        {{-- FEATURED --}}
        <div class="max-w-screen-xl mx-auto px-6 mb-12">
            <a href="{{ route('articles.show', $featured->slug) }}" class="feat-card group block">
                <div class="grid lg:grid-cols-2 gap-0 bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-500 border border-primary/10">

                    {{-- Image --}}
                    <div class="relative overflow-hidden" style="aspect-ratio:16/8">
                        @if($featured->thumbnail)
                            <img src="{{ asset('storage/' . $featured->thumbnail) }}"
                                alt="{{ $featured->title }}"
                                class="feat-img w-full h-full object-cover block"/>
                        @else
                            <div class="w-full h-full bg-primary/5 flex items-center justify-center">
                                <svg class="w-12 h-12 text-primary/30" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="3"/>
                                    <path d="M3 15l5-5 4 4 3-3 6 5"/>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="text-xs font-semibold tracking-widest uppercase bg-white/90 backdrop-blur-sm text-secondary px-3 py-1.5 rounded-full">
                                Terbaru
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-8 lg:p-10 flex flex-col justify-center">
                        <div class="flex items-center gap-2.5 mb-4">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-white text-[11px] serif flex-shrink-0 bg-gradient-to-br from-secondary to-secondary-light">
                                {{ strtoupper(substr($featured->author ?? 'A', 0, 1)) }}
                            </div>
                            <span class="text-sm text-gray-600">{{ $featured->author ?? 'Unknown' }}</span>
                            <span class="text-primary/25">·</span>
                            <span class="text-xs text-gray-500">{{ $featured->created_at->diffForHumans() }}</span>
                        </div>

                        <h2 class="serif text-[clamp(1.4rem,2.2vw,2rem)] leading-[1.18] text-accent-green tracking-tight mb-4 group-hover:text-primary transition-colors duration-300">
                            {{ $featured->title }}
                        </h2>

                        <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-2">
                            {{ \Illuminate\Support\Str::limit(strip_tags($featured->content), 150) }}
                        </p>

                        <div class="flex items-center gap-2 text-sm font-semibold text-primary">
                            <span class="link-underline pb-0.5">Baca Artikel</span>
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </div>
                    </div>

                </div>
            </a>
        </div>

        {{-- SECTION LABEL --}}
        @if($articles->count() > 1)
        <div class="max-w-screen-xl mx-auto px-6 mb-5">
            <div class="flex items-center gap-5">
                <span class="text-xs font-semibold tracking-[.14em] uppercase text-gray-500">Artikel Lainnya</span>
                <div class="flex-1 h-px bg-primary/10"></div>
            </div>
        </div>

        {{-- GRID --}}
        <div class="max-w-screen-xl mx-auto px-6 mb-6">
            <div id="articles-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">

                @php
                    $gridArticles = $articles->currentPage() == 1 ? $articles->skip(1) : $articles;
                @endphp
                @foreach($gridArticles as $i => $article)
                <a href="{{ route('articles.show', $article->slug) }}"
                   data-index="{{ $i }}"
                   class="art-card au group block bg-white rounded-xl overflow-hidden hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 border border-primary/10 hover:border-secondary/40">

                    {{-- Image --}}
                    <div class="relative overflow-hidden" style="aspect-ratio:16/8">
                        @if($article->thumbnail)
                            <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                alt="{{ $article->title }}"
                                class="card-img w-full h-full object-cover block"/>
                        @else
                            <div class="w-full h-full bg-primary/5 flex items-center justify-center">
                                <svg class="w-8 h-8 text-primary/30" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="3"/>
                                    <path d="M3 15l5-5 4 4 3-3 6 5"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="p-4">
                        <div class="flex items-center gap-1.5 mb-2.5">
                            <span class="text-xs text-gray-500">{{ $article->author ?? 'Unknown' }}</span>
                            <span class="text-primary/20">·</span>
                            <span class="text-xs text-gray-400">{{ $article->created_at->diffForHumans() }}</span>
                        </div>

                        <h3 class="serif text-[1rem] leading-snug text-accent-green mb-2 group-hover:text-primary transition-colors duration-200 line-clamp-2">
                            {{ $article->title }}
                        </h3>

                        <p class="text-gray-600 text-xs leading-relaxed line-clamp-2 mb-3">
                            {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 90) }}
                        </p>

                        <div class="flex items-center justify-between pt-3 border-t border-primary/10">
                            <span class="text-xs font-semibold text-secondary group-hover:translate-x-0.5 transition-transform duration-200 inline-block">Baca →</span>
                            @php
                                $wc = str_word_count(strip_tags($article->content));
                                $rm = max(1, ceil($wc / 200));
                            @endphp
                            <span class="text-[11px] text-gray-400">{{ $rm }} menit baca</span>
                        </div>
                    </div>

                </a>
                @endforeach

            </div>
        </div>

        {{-- Pagination Links --}}
        <div class="max-w-screen-xl mx-auto px-6 pb-20 flex justify-center">
            {{ $articles->links('partials.pagination') }}
        </div>

        @endif

    @else
    <div class="max-w-screen-xl mx-auto px-6 py-32 text-center">
        <p class="serif text-4xl text-primary/20 mb-3">— ✦ —</p>
        <p class="text-sm text-gray-400">Belum ada artikel yang dipublikasikan.</p>
    </div>
    @endif
@endsection
