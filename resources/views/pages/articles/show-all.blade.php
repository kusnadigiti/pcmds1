<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Artikel — PCM Duren Sawit 1</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>

    <style>
        body { font-family: 'DM Sans', sans-serif; -webkit-font-smoothing: antialiased; }
        .serif { font-family: 'DM Serif Display', serif; }

        /* Image zoom */
        .card-img  { transition: transform 6s ease; }
        .art-card:hover .card-img  { transform: scale(1.06); }
        .feat-img  { transition: transform 8s ease; }
        .feat-card:hover .feat-img { transform: scale(1.04); }

        /* Underline slide */
        .link-underline {
            background-image: linear-gradient(#0d0d0d, #0d0d0d);
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
        .d3 { animation-delay:.21s; } .d4 { animation-delay:.29s; }

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
            color: #ede9e1;
            user-select: none;
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-[#F5F3EF] min-h-screen">

    {{-- ══════════ NAV ══════════ --}}
    @include('layouts.navigation')

    {{-- ══════════ PAGE HEADER ══════════ --}}
    <div class="pt-20">
        <div class="max-w-screen-xl mx-auto px-6 pt-14 pb-8 relative overflow-hidden">

            <span class="big-count absolute right-6 top-1/2 -translate-y-1/2 hidden lg:block">
                {{ $articles->count() }}
            </span>

            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-5 au d1">
                    <span class="w-7 h-px bg-[#c8a96e] block"></span>
                    <span class="text-xs font-semibold tracking-[.14em] uppercase text-[#c8a96e]">Publikasi</span>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-3">
                    <h1 class="serif text-[clamp(2.4rem,5vw,4rem)] leading-[1.1] text-[#0d0d0d] tracking-tight au d2">
                        Semua <span style="font-style:italic;color:#9a9690">Artikel</span>
                    </h1>
                    <p class="text-sm text-[#6b6b6b] max-w-xs leading-relaxed au d3">
                        Inspirasi dan nilai-nilai Islami untuk memperkuat iman dan wawasan.
                    </p>
                </div>
            </div>

            <div class="mt-10 h-px bg-[#e8e4dc]"></div>
        </div>
    </div>

    {{-- ══════════ CONTENT ══════════ --}}
    @if($articles->count() > 0)

        @php $featured = $articles->first(); @endphp

        {{-- FEATURED --}}
        <div class="max-w-screen-xl mx-auto px-6 mb-12">
            <a href="{{ route('articles.show', $featured->slug) }}" class="feat-card group block">
                <div class="grid lg:grid-cols-2 gap-0 bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-500">

                    {{-- Image --}}
                    <div class="relative overflow-hidden" style="aspect-ratio:16/8">
                        @if($featured->thumbnail)
                            <img src="{{ asset('storage/' . $featured->thumbnail) }}"
                                alt="{{ $featured->title }}"
                                class="feat-img w-full h-full object-cover block"/>
                        @else
                            <div class="w-full h-full bg-[#e8e4dc] flex items-center justify-center">
                                <svg class="w-12 h-12 text-[#c4bfb3]" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="3"/>
                                    <path d="M3 15l5-5 4 4 3-3 6 5"/>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="text-xs font-semibold tracking-widest uppercase bg-white/90 backdrop-blur-sm text-[#c8a96e] px-3 py-1.5 rounded-full">
                                Terbaru
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-8 lg:p-10 flex flex-col justify-center">
                        <div class="flex items-center gap-2.5 mb-4">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-white text-[11px] serif flex-shrink-0"
                                style="background:linear-gradient(135deg,#c8a96e,#8b6840)">
                                {{ strtoupper(substr($featured->author ?? 'A', 0, 1)) }}
                            </div>
                            <span class="text-sm text-[#6b6b6b]">{{ $featured->author ?? 'Unknown' }}</span>
                            <span class="text-[#e8e4dc]">·</span>
                            <span class="text-xs text-[#6b6b6b]">{{ $featured->created_at->diffForHumans() }}</span>
                        </div>

                        <h2 class="serif text-[clamp(1.4rem,2.2vw,2rem)] leading-[1.18] text-[#0d0d0d] tracking-tight mb-4 group-hover:text-[#3a3a3a] transition-colors duration-300">
                            {{ $featured->title }}
                        </h2>

                        <p class="text-[#6b6b6b] text-sm leading-relaxed mb-6 line-clamp-2">
                            {{ \Illuminate\Support\Str::limit(strip_tags($featured->content), 150) }}
                        </p>

                        <div class="flex items-center gap-2 text-sm font-semibold text-[#0d0d0d]">
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
                <span class="text-xs font-semibold tracking-[.14em] uppercase text-[#6b6b6b]">Artikel Lainnya</span>
                <div class="flex-1 h-px bg-[#e8e4dc]"></div>
                <span id="grid-count-label" class="text-xs text-[#9a9690]">
                    {{ min(6, $articles->count() - 1) }} dari {{ $articles->count() - 1 }}
                </span>
            </div>
        </div>

        {{-- GRID --}}
        <div class="max-w-screen-xl mx-auto px-6 mb-6">
            <div id="articles-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">

                @foreach($articles->skip(1) as $i => $article)
                <a href="{{ route('articles.show', $article->slug) }}"
                   data-index="{{ $i }}"
                   class="art-card au group block bg-white rounded-xl overflow-hidden hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 border border-[#f0ede7] {{ $i >= 6 ? 'hidden-card' : '' }}">

                    {{-- Image --}}
                    <div class="relative overflow-hidden" style="aspect-ratio:16/8">
                        @if($article->thumbnail)
                            <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                alt="{{ $article->title }}"
                                class="card-img w-full h-full object-cover block"/>
                        @else
                            <div class="w-full h-full bg-[#e8e4dc] flex items-center justify-center">
                                <svg class="w-8 h-8 text-[#c4bfb3]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="3"/>
                                    <path d="M3 15l5-5 4 4 3-3 6 5"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="p-4">
                        <div class="flex items-center gap-1.5 mb-2.5">
                            <span class="text-xs text-[#9a9690]">{{ $article->author ?? 'Unknown' }}</span>
                            <span class="text-[#e0dbd2]">·</span>
                            <span class="text-xs text-[#9a9690]">{{ $article->created_at->diffForHumans() }}</span>
                        </div>

                        <h3 class="serif text-[1rem] leading-snug text-[#0d0d0d] mb-2 group-hover:text-[#3a3a3a] transition-colors duration-200 line-clamp-2">
                            {{ $article->title }}
                        </h3>

                        <p class="text-[#6b6b6b] text-xs leading-relaxed line-clamp-2 mb-3">
                            {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 90) }}
                        </p>

                        <div class="flex items-center justify-between pt-3" style="border-top:1px solid #f0ede7">
                            <span class="text-xs font-semibold text-[#c8a96e] group-hover:translate-x-0.5 transition-transform duration-200 inline-block">Baca →</span>
                            @php
                                $wc = str_word_count(strip_tags($article->content));
                                $rm = max(1, ceil($wc / 200));
                            @endphp
                            <span class="text-[11px] text-[#9a9690]">{{ $rm }} menit baca</span>
                        </div>
                    </div>

                </a>
                @endforeach

            </div>
        </div>

        {{-- SHOW MORE / LESS — only if grid articles > 6 --}}
        @if($articles->count() - 1 > 6)
        <div class="max-w-screen-xl mx-auto px-6 pb-20">
            <div class="flex flex-col items-center gap-4">

                {{-- Progress bar --}}
                <div class="w-40 h-[2px] bg-[#e8e4dc] rounded-full overflow-hidden">
                    <div id="progress-fill" class="h-full bg-[#c8a96e] rounded-full transition-all duration-500"
                        style="width:{{ min(6 / ($articles->count() - 1) * 100, 100) }}%"></div>
                </div>

                <p id="shown-label" class="text-xs text-[#9a9690]">
                    Menampilkan <span id="shown-num">6</span> dari <span>{{ $articles->count() - 1 }}</span> artikel
                </p>

                <div class="flex items-center gap-3">
                    <button id="show-more-btn"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-[#0d0d0d] border border-[#0d0d0d] px-5 py-2.5 rounded-full hover:bg-[#0d0d0d] hover:text-white transition-all duration-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
                        Tampilkan Lebih Banyak
                    </button>
                    <button id="show-less-btn" style="display:none"
                        class="inline-flex items-center gap-2 text-sm font-medium text-[#9a9690] border border-[#e8e4dc] px-5 py-2.5 rounded-full hover:border-[#9a9690] hover:text-[#0d0d0d] transition-all duration-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 15l7-7 7 7"/></svg>
                        Tampilkan Lebih Sedikit
                    </button>
                </div>

            </div>
        </div>
        @else
        <div class="pb-20"></div>
        @endif

        @endif

    @else
    <div class="max-w-screen-xl mx-auto px-6 py-32 text-center">
        <p class="serif text-4xl text-[#e0dbd2] mb-3">— ✦ —</p>
        <p class="text-sm text-[#9a9690]">Belum ada artikel yang dipublikasikan.</p>
    </div>
    @endif

    {{-- ══════════ FOOTER ══════════ --}}
   @include('layouts.footer')

    <script>
        // Mobile nav

        // Show more / less
        var STEP       = 6;
        var total      = {{ max(0, $articles->count() - 1) }};
        var shown      = Math.min(STEP, total);
        var moreBtn    = document.getElementById('show-more-btn');
        var lessBtn    = document.getElementById('show-less-btn');
        var shownNum   = document.getElementById('shown-num');
        var fillEl     = document.getElementById('progress-fill');
        var countLabel = document.getElementById('grid-count-label');

        function syncUI() {
            if (shownNum)   shownNum.textContent = shown;
            if (fillEl)     fillEl.style.width = Math.min(shown / total * 100, 100) + '%';
            if (countLabel) countLabel.textContent = shown + ' dari ' + total;
            if (moreBtn)    moreBtn.style.display = shown >= total ? 'none' : '';
            if (lessBtn)    lessBtn.style.display  = shown <= STEP  ? 'none' : '';
        }

        if (moreBtn) {
            moreBtn.addEventListener('click', function () {
                var hidden = document.querySelectorAll('#articles-grid .art-card.hidden-card');
                var count  = 0;
                hidden.forEach(function (card) {
                    if (count < STEP) {
                        card.classList.remove('hidden-card');
                        card.classList.add('card-revealed');
                        shown++;
                        count++;
                    }
                });
                syncUI();
                window.scrollBy({ top: 200, behavior: 'smooth' });
            });
        }

        if (lessBtn) {
            lessBtn.addEventListener('click', function () {
                var allCards = document.querySelectorAll('#articles-grid .art-card');
                var idx = 0;
                allCards.forEach(function (card) {
                    if (idx >= STEP) {
                        card.classList.add('hidden-card');
                        card.classList.remove('card-revealed');
                    }
                    idx++;
                });
                shown = STEP;
                syncUI();
                var grid = document.getElementById('articles-grid');
                if (grid) window.scrollTo({ top: grid.offsetTop - 140, behavior: 'smooth' });
            });
        }

        syncUI();
    </script>

</body>
</html>
