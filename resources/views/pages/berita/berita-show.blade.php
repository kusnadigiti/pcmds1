@extends('layouts.frontend')

@section('title', 'Berita — PCM Duren Sawit 1')

@section('styles')
    <style>
        .serif { font-family: 'Playfair Display', serif; }
        /* ── BENTO GRID ── */
        .bento-wrap {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem 2rem;
        }

        #bento-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            grid-auto-rows: minmax(56px, auto);
            gap: 14px;
        }

        /* Card base */
        .b-card {
            background: #fff;
            border: 1px solid rgba(13, 92, 58, 0.08);
            border-radius: 16px;
            overflow: hidden;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            transition: box-shadow .35s ease, transform .35s ease;
        }

        .b-card:hover {
            box-shadow: 0 16px 40px rgba(13, 92, 58, .08);
            transform: translateY(-2px);
        }

        /* Bento slots */
        .b-card[data-slot="a0"] { grid-column: span 7; grid-row: span 6; }
        .b-card[data-slot="a1"] { grid-column: span 5; grid-row: span 3; }
        .b-card[data-slot="a2"] { grid-column: span 5; grid-row: span 3; }
        .b-card[data-slot="b0"] { grid-column: span 4; grid-row: span 4; }
        .b-card[data-slot="b1"] { grid-column: span 4; grid-row: span 4; }
        .b-card[data-slot="b2"] { grid-column: span 4; grid-row: span 4; }
        .b-card[data-slot="c0"] { grid-column: span 5; grid-row: span 5; }
        .b-card[data-slot="c1"] { grid-column: span 7; grid-row: span 3; }
        .b-card[data-slot="c2"] { grid-column: span 7; grid-row: span 2; }
        .b-card[data-slot="d"] { grid-column: span 4; grid-row: span 4; }

        /* Image heights */
        [data-slot="a0"] .b-img-wrap { height: 200px; }
        [data-slot="a1"] .b-img-wrap,
        [data-slot="a2"] .b-img-wrap,
        [data-slot="b0"] .b-img-wrap,
        [data-slot="b1"] .b-img-wrap,
        [data-slot="b2"] .b-img-wrap { height: 130px; }
        [data-slot="c0"] .b-img-wrap { height: 170px; }
        [data-slot="c1"] .b-img-wrap,
        [data-slot="c2"] .b-img-wrap { height: 0; display: none; }
        [data-slot="d"] .b-img-wrap { height: 130px; }

        /* Horizontal cards */
        [data-slot="c1"], [data-slot="c2"] {
            flex-direction: row !important;
            align-items: center;
        }

        [data-slot="c1"] .b-body, [data-slot="c2"] .b-body {
            padding: 1.25rem 1.5rem !important;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        [data-slot="c1"] .b-excerpt, [data-slot="c2"] .b-excerpt { display: none; }
        [data-slot="c2"] .b-title { font-size: .9rem !important; }

        /* Image transitions */
        .b-img-wrap { position: relative; overflow: hidden; flex-shrink: 0; }
        .b-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 6s ease; }
        .b-card:hover .b-img-wrap img { transform: scale(1.06); }

        .b-no-img {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #eae6df, #d8d3ca);
        }

        .b-no-img-glyph {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 3rem;
            color: rgba(0,0,0,.1);
            user-select: none;
        }

        [data-slot="a0"] .b-no-img { height: 200px; }
        [data-slot="a1"] .b-no-img, [data-slot="a2"] .b-no-img,
        [data-slot="b0"] .b-no-img, [data-slot="b1"] .b-no-img,
        [data-slot="b2"] .b-no-img { height: 130px; }
        [data-slot="c0"] .b-no-img { height: 170px; }
        [data-slot="c1"] .b-no-img, [data-slot="c2"] .b-no-img {
            width: 88px; height: 100% !important; flex-shrink: 0;
        }
        [data-slot="d"] .b-no-img { height: 130px; }

        /* Gold stripe on a0 */
        [data-slot="a0"] { position: relative; }
        [data-slot="a0"]::after {
            content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 3px;
            background: linear-gradient(to bottom, #D4A017, transparent);
        }

        .b-body {
            padding: 1.1rem 1.25rem 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        [data-slot="a0"] .b-body { padding: 1.4rem 1.6rem 1.6rem; }
        .b-meta { display: flex; align-items: center; gap: .4rem; margin-bottom: .6rem; flex-wrap: wrap; }
        .b-meta-txt { font-size: .7rem; color: #7A7570; letter-spacing: .02em; }
        .b-meta .sep { color: rgba(13, 92, 58, 0.1); font-size: .8rem; }

        .b-title {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            line-height: 1.3;
            letter-spacing: -.01em;
            color: #0f1923;
            transition: color .2s;
            margin: .35rem 0 0;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        [data-slot="a0"] .b-title { font-size: 1.3rem; -webkit-line-clamp: 4; }
        .b-card:hover .b-title { color: #0d5c3a; }

        .b-excerpt {
            font-size: .75rem;
            color: #7A7570;
            line-height: 1.65;
            margin-top: .5rem;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        [data-slot="a0"] .b-excerpt { -webkit-line-clamp: 3; font-size: .8rem; }

        .b-footer {
            display: flex; align-items: center; justify-content: space-between;
            margin-top: auto; padding-top: .75rem;
            border-top: 1px solid rgba(13, 92, 58, 0.08);
        }

        .b-read {
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #D4A017;
        }

        .b-date { font-size: .65rem; color: #B8B3AB; }

        /* ── HIDDEN / REVEAL ── */
        .b-card.hidden-card { display: none !important; }
        .b-card.filtered-out { display: none !important; }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .au { animation: fadeUp .55s cubic-bezier(.4, 0, .2, 1) both; }
        .d1 { animation-delay: .05s; }
        .d2 { animation-delay: .13s; }
        .d3 { animation-delay: .21s; }
        .d4 { animation-delay: .29s; }

        @keyframes cardIn {
            from { opacity: 0; transform: translateY(12px) scale(.99); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        .card-in { animation: cardIn .38s cubic-bezier(.4,0,.2,1) both; }

        /* Stagger animations */
        #bento-grid .b-card:nth-child(1) { animation: cardIn .45s .08s both cubic-bezier(.4,0,.2,1); }
        #bento-grid .b-card:nth-child(2) { animation: cardIn .45s .15s both cubic-bezier(.4,0,.2,1); }
        #bento-grid .b-card:nth-child(3) { animation: cardIn .45s .22s both cubic-bezier(.4,0,.2,1); }
        #bento-grid .b-card:nth-child(4) { animation: cardIn .45s .28s both cubic-bezier(.4,0,.2,1); }
        #bento-grid .b-card:nth-child(5) { animation: cardIn .45s .34s both cubic-bezier(.4,0,.2,1); }
        #bento-grid .b-card:nth-child(6) { animation: cardIn .45s .40s both cubic-bezier(.4,0,.2,1); }
        #bento-grid .b-card:nth-child(7) { animation: cardIn .45s .46s both cubic-bezier(.4,0,.2,1); }
        #bento-grid .b-card:nth-child(8) { animation: cardIn .45s .52s both cubic-bezier(.4,0,.2,1); }
        #bento-grid .b-card:nth-child(9) { animation: cardIn .45s .58s both cubic-bezier(.4,0,.2,1); }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            #bento-grid {
                grid-template-columns: repeat(6, 1fr);
                grid-auto-rows: minmax(48px, auto);
            }
            .b-card[data-slot="a0"] { grid-column: span 6; grid-row: span 5; }
            .b-card[data-slot="a1"], .b-card[data-slot="a2"] { grid-column: span 3; grid-row: span 3; }
            .b-card[data-slot="b0"], .b-card[data-slot="b1"], .b-card[data-slot="b2"] { grid-column: span 2; grid-row: span 4; }
            .b-card[data-slot="c0"] { grid-column: span 3; grid-row: span 4; }
            .b-card[data-slot="c1"] { grid-column: span 3; grid-row: span 2; flex-direction: column !important; }
            .b-card[data-slot="c2"] { grid-column: span 6; grid-row: span 2; flex-direction: column !important; }
            .b-card[data-slot="d"] { grid-column: span 3; grid-row: span 4; }
        }

        @media (max-width: 600px) {
            #bento-grid {
                grid-template-columns: 1fr 1fr;
                grid-auto-rows: auto;
                gap: 10px;
            }
            .b-card[data-slot] { grid-column: span 1 !important; grid-row: span 1 !important; }
            [data-slot="c1"], [data-slot="c2"] { flex-direction: column !important; }
            [data-slot="c1"] .b-no-img, [data-slot="c2"] .b-no-img {
                width: 100% !important; height: 110px !important;
            }
        }
    </style>
@endsection

@section('content')
    {{-- ══════════ PAGE HEADER ══════════ --}}
    <div class="pt-[68px] bg-cream">
        <div class="max-w-7xl mx-auto px-8 pt-20 pb-12 relative overflow-hidden">
            <span class="hidden md:block absolute right-8 top-1/2 -translate-y-1/2 serif italic text-[10rem] leading-none text-[#eae6df] select-none pointer-events-none" id="big-num">
                {{ count($berita) }}
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
        $beritaCollection = collect($berita);
        $total = $beritaCollection->count();
    @endphp

    @if ($total > 0)

        {{-- ══════════ FILTER TABS ══════════ --}}
        <div class="flex items-center gap-3 overflow-x-auto pb-4 scrollbar-none max-w-7xl mx-auto px-8 mt-8 au d4">
            <button class="filter-btn px-5 py-2 text-xs font-semibold uppercase tracking-wider border border-accent bg-accent text-white rounded-full transition-all duration-300" data-filter="all">Semua</button>
            <button class="filter-btn px-5 py-2 text-xs font-semibold uppercase tracking-wider border border-gray-200 text-gray-500 rounded-full hover:bg-gray-50 transition-all duration-300" data-filter="dakwah">Dakwah</button>
            <button class="filter-btn px-5 py-2 text-xs font-semibold uppercase tracking-wider border border-gray-200 text-gray-500 rounded-full hover:bg-gray-50 transition-all duration-300" data-filter="pendidikan">Pendidikan</button>
            <button class="filter-btn px-5 py-2 text-xs font-semibold uppercase tracking-wider border border-gray-200 text-gray-500 rounded-full hover:bg-gray-50 transition-all duration-300" data-filter="sosial">Sosial</button>
            <button class="filter-btn px-5 py-2 text-xs font-semibold uppercase tracking-wider border border-gray-200 text-gray-500 rounded-full hover:bg-gray-50 transition-all duration-300" data-filter="organisasi">Organisasi</button>
        </div>

        @php $featured = $beritaCollection->first(); @endphp

        {{-- ══════════ FEATURED ══════════ --}}
        <div class="max-w-7xl mx-auto px-8 my-12" id="featured-wrap">
            <a href="{{ route('berita.show', $featured['slug']) }}" class="group block bg-white rounded-3xl overflow-hidden border border-gray-100 hover:border-primary/20 hover:shadow-xl transition-all duration-500" data-kategori="{{ $featured['kategori'] }}">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">
                    <div class="lg:col-span-7 relative aspect-[16/10] lg:aspect-auto lg:h-[480px] overflow-hidden bg-gray-100">
                        @if (!empty($featured['gambar']))
                            <img src="{{ $featured['gambar'] }}" alt="{{ $featured['judul'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#eae6df] to-[#d8d3ca]">
                                <span class="serif italic text-7xl text-black/10 select-none">{{ strtoupper(substr($featured['judul'], 0, 1)) }}</span>
                            </div>
                        @endif
                        <span class="absolute top-6 left-6 px-4 py-1.5 text-[0.62rem] font-bold tracking-widest uppercase bg-secondary text-white rounded-full shadow-sm">Terbaru</span>
                    </div>

                    <div class="lg:col-span-5 p-8 lg:p-12 flex flex-col justify-center">
                        <div class="flex items-center gap-3 text-xs text-gray-400 mb-6">
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

                        <h2 class="serif text-3xl lg:text-4xl text-accent font-semibold leading-tight group-hover:text-primary transition-colors duration-300">{{ $featured['judul'] }}</h2>
                        <p class="text-sm text-gray-500 leading-relaxed mt-4 mb-8 line-clamp-3">{{ $featured['excerpt'] }}</p>

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

        {{-- ══════════ SECTION LABEL ══════════ --}}
        @if ($total > 1)
            <div class="max-w-7xl mx-auto px-8 my-8 flex items-center justify-between gap-4">
                <span class="text-[0.68rem] font-bold tracking-[0.16em] uppercase text-gray-400">Berita Lainnya</span>
                <div class="flex-1 h-[1px] bg-gray-200"></div>
                <span id="grid-count-label" class="text-xs font-medium text-gray-400">
                    {{ min(9, $total - 1) }} dari {{ $total - 1 }}
                </span>
            </div>

            {{-- ══════════ BENTO GRID ══════════ --}}
            <div class="bento-wrap">
                <div id="bento-grid">
                    @foreach ($beritaCollection->skip(1) as $i => $item)
                        @php
                            $pat = $i % 9;
                            if ($pat === 0) {
                                $slot = 'a0';
                            } elseif ($pat === 1) {
                                $slot = 'a1';
                            } elseif ($pat === 2) {
                                $slot = 'a2';
                            } elseif ($pat === 3) {
                                $slot = 'b0';
                            } elseif ($pat === 4) {
                                $slot = 'b1';
                            } elseif ($pat === 5) {
                                $slot = 'b2';
                            } elseif ($pat === 6) {
                                $slot = 'c0';
                            } elseif ($pat === 7) {
                                $slot = 'c1';
                            } else {
                                $slot = 'c2';
                            }

                            $kat = strtolower($item['kategori'] ?? '');
                            $catColor = 'bg-gray-100 text-gray-700';
                            if ($kat === 'dakwah') $catColor = 'bg-primary/10 text-primary';
                            elseif ($kat === 'pendidikan') $catColor = 'bg-blue-50 text-blue-600';
                            elseif ($kat === 'sosial') $catColor = 'bg-orange-50 text-orange-600';
                            elseif ($kat === 'organisasi') $catColor = 'bg-purple-50 text-purple-600';
                        @endphp

                        <a href="{{ route('berita.show', $item['slug']) }}" data-index="{{ $i }}"
                            data-slot="{{ $slot }}" data-kategori="{{ $item['kategori'] }}"
                            class="b-card {{ $i >= 9 ? 'hidden-card' : '' }}">

                            {{-- Image / gradient tile --}}
                            @if (!empty($item['gambar']))
                                <div class="b-img-wrap">
                                    <img src="{{ $item['gambar'] }}" alt="{{ $item['judul'] }}" loading="lazy" />
                                </div>
                            @else
                                <div class="b-no-img b-img-wrap">
                                    <span class="b-no-img-glyph">{{ strtoupper(substr($item['judul'], 0, 1)) }}</span>
                                </div>
                            @endif

                            {{-- Body --}}
                            <div class="b-body">
                                <div class="b-meta">
                                    <span class="px-2 py-0.5 text-[0.58rem] font-bold uppercase tracking-wider rounded-full {{ $catColor }}">{{ $item['kategori'] ?? 'Umum' }}</span>
                                    <span class="sep">·</span>
                                    <span class="b-meta-txt">{{ \Carbon\Carbon::parse($item['created_at'])->diffForHumans() }}</span>
                                </div>
                                <h3 class="b-title">{{ $item['judul'] }}</h3>
                                <p class="b-excerpt">{{ $item['excerpt'] }}</p>
                                <div class="b-footer">
                                    <span class="b-read">Baca →</span>
                                    <span
                                        class="b-date">{{ \Carbon\Carbon::parse($item['created_at'])->format('d M Y') }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- EMPTY STATE for filter --}}
            <div id="empty-filter" style="display:none" class="max-w-7xl mx-auto px-8 py-20 text-center">
                <p class="serif text-5xl text-gray-300 mb-4">— ✦ —</p>
                <p class="text-sm text-gray-500">Belum ada berita untuk kategori ini.</p>
            </div>

            {{-- SHOW MORE --}}
            @if ($total - 1 > 9)
                <div class="max-w-xs mx-auto flex flex-col items-center gap-4 my-16" id="show-more-area">
                    <div class="w-full h-1 bg-gray-200 rounded-full overflow-hidden">
                        <div id="progress-fill" class="h-full bg-primary transition-all duration-500" style="width:{{ min((9 / ($total - 1)) * 100, 100) }}%"></div>
                    </div>
                    <p class="text-xs text-gray-500">
                        Menampilkan <span id="shown-num">9</span> dari <span
                            id="total-visible">{{ $total - 1 }}</span> berita
                    </p>
                    <div class="flex gap-3 mt-2">
                        <button id="show-more-btn" class="inline-flex items-center gap-2 px-5 py-2.5 bg-accent hover:bg-accent/90 text-white rounded-full text-xs font-semibold uppercase tracking-wider transition-all duration-300 shadow-sm">
                            <svg width="13" height="13" fill="none" stroke="currentColor"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                            Tampilkan Lebih Banyak
                        </button>
                        <button id="show-less-btn" class="inline-flex items-center gap-2 px-5 py-2.5 bg-accent hover:bg-accent/90 text-white rounded-full text-xs font-semibold uppercase tracking-wider transition-all duration-300 shadow-sm" style="display:none">
                            <svg width="13" height="13" fill="none" stroke="currentColor"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M5 15l7-7 7 7" />
                            </svg>
                            Lebih Sedikit
                        </button>
                    </div>
                </div>
            @else
                <div style="padding-bottom:5rem"></div>
            @endif

        @endif
    @else
        <div class="max-w-7xl mx-auto px-8 py-20 text-center">
            <p class="serif text-5xl text-gray-300 mb-4">— ✦ —</p>
            <p class="text-sm text-gray-500">Belum ada berita yang dipublikasikan.</p>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        // ── Filter ──
        var STEP = 9;
        var activeFilter = 'all';
        var allCards = Array.from(document.querySelectorAll('#bento-grid .b-card'));
        var featWrap = document.getElementById('featured-wrap');
        var emptyMsg = document.getElementById('empty-filter');
        var countLabel = document.getElementById('grid-count-label');
        var shownNum = document.getElementById('shown-num');
        var totalVis = document.getElementById('total-visible');
        var fillEl = document.getElementById('progress-fill');
        var moreBtn = document.getElementById('show-more-btn');
        var lessBtn = document.getElementById('show-less-btn');
        var showArea = document.getElementById('show-more-area');

        var shown = Math.min(STEP, allCards.length);

        function getFilteredCards() {
            if (activeFilter === 'all') return allCards;
            return allCards.filter(function(c) {
                return (c.dataset.kategori || '').toLowerCase() === activeFilter;
            });
        }

        function applyFilter() {
            var filtered = getFilteredCards();
            var unfiltered = allCards.filter(function(c) {
                return filtered.indexOf(c) === -1;
            });

            // Hide cards not in current filter
            unfiltered.forEach(function(c) {
                c.classList.add('filtered-out');
            });

            // Show/hide based on filter + shown count
            filtered.forEach(function(c, idx) {
                c.classList.remove('filtered-out');
                if (idx < shown) {
                    c.classList.remove('hidden-card');
                } else {
                    c.classList.add('hidden-card');
                }
            });

            // Featured visibility
            if (featWrap) {
                var featEl = featWrap.querySelector('[data-kategori]');
                if (featEl) {
                    var featKat = (featEl.dataset.kategori || '').toLowerCase();
                    featWrap.style.display = (activeFilter === 'all' || featKat === activeFilter) ? '' : 'none';
                }
            }

            // Empty state
            var visibleCount = document.querySelectorAll('#bento-grid .b-card:not(.hidden-card):not(.filtered-out)').length;
            if (emptyMsg) emptyMsg.style.display = (filtered.length === 0) ? 'block' : 'none';

            // Sync labels
            var filtTotal = filtered.length;
            shown = Math.min(shown, filtTotal) || Math.min(STEP, filtTotal);

            if (countLabel) countLabel.textContent = Math.min(shown, filtTotal) + ' dari ' + filtTotal;
            if (shownNum) shownNum.textContent = Math.min(shown, filtTotal);
            if (totalVis) totalVis.textContent = filtTotal;
            if (fillEl) fillEl.style.width = filtTotal > 0 ? Math.min(shown / filtTotal * 100, 100) + '%' : '0%';
            if (showArea) showArea.style.display = filtTotal > STEP ? 'flex' : 'none';
            if (moreBtn) moreBtn.style.display = shown >= filtTotal ? 'none' : '';
            if (lessBtn) lessBtn.style.display = shown <= STEP ? 'none' : '';
        }

        // Filter buttons
        document.querySelectorAll('.filter-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                activeFilter = this.dataset.filter;
                shown = STEP;

                // Reset all filter buttons to default style
                document.querySelectorAll('.filter-btn').forEach(function(b) {
                    b.className = 'filter-btn px-5 py-2 text-xs font-semibold uppercase tracking-wider border border-gray-200 text-gray-500 rounded-full hover:bg-gray-50 transition-all duration-300';
                });

                // Apply active style to clicked button based on category
                if (activeFilter === 'all') {
                    this.className = 'filter-btn px-5 py-2 text-xs font-semibold uppercase tracking-wider border border-accent bg-accent text-white rounded-full transition-all duration-300';
                } else if (activeFilter === 'dakwah') {
                    this.className = 'filter-btn px-5 py-2 text-xs font-semibold uppercase tracking-wider border border-primary bg-primary text-white rounded-full transition-all duration-300';
                } else if (activeFilter === 'pendidikan') {
                    this.className = 'filter-btn px-5 py-2 text-xs font-semibold uppercase tracking-wider border border-blue-600 bg-blue-600 text-white rounded-full transition-all duration-300';
                } else if (activeFilter === 'sosial') {
                    this.className = 'filter-btn px-5 py-2 text-xs font-semibold uppercase tracking-wider border border-orange-600 bg-orange-600 text-white rounded-full transition-all duration-300';
                } else if (activeFilter === 'organisasi') {
                    this.className = 'filter-btn px-5 py-2 text-xs font-semibold uppercase tracking-wider border border-purple-600 bg-purple-600 text-white rounded-full transition-all duration-300';
                }

                applyFilter();

                // Re-animate visible cards
                var visCards = document.querySelectorAll(
                    '#bento-grid .b-card:not(.hidden-card):not(.filtered-out)');
                visCards.forEach(function(c, i) {
                    c.style.animation = 'none';
                    void c.offsetWidth;
                    c.style.animation = 'cardIn .38s ' + (i * 0.05) +
                        's both cubic-bezier(.4,0,.2,1)';
                });
            });
        });

        // Show more
        if (moreBtn) {
            moreBtn.addEventListener('click', function() {
                var filtered = getFilteredCards();
                var hidden = filtered.filter(function(c) {
                    return c.classList.contains('hidden-card');
                });
                var count = 0;
                hidden.forEach(function(card) {
                    if (count < STEP) {
                        card.classList.remove('hidden-card');
                        void card.offsetWidth;
                        card.classList.add('card-in');
                        shown++;
                        count++;
                    }
                });
                applyFilter();
                window.scrollBy({
                    top: 260,
                    behavior: 'smooth'
                });
            });
        }

        // Show less
        if (lessBtn) {
            lessBtn.addEventListener('click', function() {
                shown = STEP;
                applyFilter();
                var grid = document.getElementById('bento-grid');
                if (grid) window.scrollTo({
                    top: grid.offsetTop - 140,
                    behavior: 'smooth'
                });
            });
        }

        applyFilter();
    </script>
@endsection
