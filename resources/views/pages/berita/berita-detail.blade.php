@extends('layouts.frontend')

@section('title', $berita->judul . ' — PCM Duren Sawit 1')

@section('meta_description', Str::limit(strip_tags($berita->isi), 150))
@section('meta_keywords', 'Berita, PCM Duren Sawit 1, ' . ($berita->kategori ?? 'Umum') . ', ' . implode(', ', array_slice(explode(' ', $berita->judul), 0, 5)))
@section('og_type', 'article')
@section('og_image', $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://i.pinimg.com/564x/29/e9/30/29e9307518d8366f97a6d26e888c6bf4.jpg')

@section('styles')
    <style>
        .serif { font-family: 'Playfair Display', serif; }

        /* ── READING PROGRESS BAR ── */
        #read-progress {
            position: fixed; top: 0; left: 0; z-index: 200;
            height: 3px; width: 0%;
            background: linear-gradient(90deg, #0d5c3a, #D4A017);
            transition: width .1s linear;
            pointer-events: none;
        }

        /* ── ARTICLE CONTENT PROSE ── */
        .article-content > p:first-child::first-letter {
            font-family: 'Playfair Display', serif;
            font-size: 4.5rem; font-weight: 600;
            float: left; line-height: .82;
            margin: .08em .12em 0 0;
            color: #0d5c3a;
        }

        .article-content p {
            font-size: 1.05rem;
            line-height: 1.85;
            color: #2D2B28;
            margin-bottom: 1.6rem;
            font-weight: 300;
        }

        .article-content h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.65rem; line-height: 1.2;
            letter-spacing: -.015em;
            color: #0d5c3a; margin: 2.5rem 0 1rem;
        }

        .article-content h3 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1rem; font-weight: 700;
            letter-spacing: .08em; text-transform: uppercase;
            color: #D4A017; margin: 2rem 0 .75rem;
        }

        .article-content ul, .article-content ol {
            margin: 0 0 1.6rem 1.5rem;
        }

        .article-content li {
            font-size: 1rem; line-height: 1.75;
            color: #2D2B28; margin-bottom: .4rem;
            font-weight: 300;
        }

        .article-content blockquote {
            margin: 2.5rem 0;
            padding: 1.5rem 2rem;
            border-left: 3px solid #D4A017;
            background: #fff;
            border-radius: 0 12px 12px 0;
            border-top: 1px solid rgba(13, 92, 58, 0.05);
            border-right: 1px solid rgba(13, 92, 58, 0.05);
            border-bottom: 1px solid rgba(13, 92, 58, 0.05);
        }

        .article-content blockquote p {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem; font-style: italic;
            line-height: 1.6; color: #0f1923;
            margin: 0;
        }

        .article-content blockquote p::first-letter { all: unset; }
        .article-content a { color: #0d5c3a; text-decoration: underline; text-underline-offset: 3px; }
        .article-content strong { font-weight: 600; color: #0f1923; }
        .article-content em { font-style: italic; }
        .article-content img {
            width: 100%; border-radius: 12px; margin: 1.5rem 0;
        }

        /* Fade up */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .au { animation: fadeUp .6s cubic-bezier(.4,0,.2,1) both; }
        .d1 { animation-delay: .05s; } .d2 { animation-delay: .14s; }
        .d3 { animation-delay: .23s; } .d4 { animation-delay: .32s; }
        .d5 { animation-delay: .42s; }
    </style>
@endsection

@section('content')
    {{-- ── READING PROGRESS ── --}}
    <div id="read-progress"></div>

    {{-- ══════════ HERO ══════════ --}}
    <section class="pt-24 pb-8 bg-white border-b border-primary/10">
        <div class="max-w-6xl mx-auto px-6">
            @php
                $kat = strtolower($berita->kategori ?? '');
                $badgeColors = [
                    'dakwah' => 'bg-emerald-50 text-emerald-700 border-emerald-200/50',
                    'pendidikan' => 'bg-blue-50 text-blue-700 border-blue-200/50',
                    'sosial' => 'bg-amber-50 text-amber-700 border-amber-200/50',
                    'organisasi' => 'bg-purple-50 text-purple-700 border-purple-200/50',
                ];
                $badgeClass = $badgeColors[$kat] ?? 'bg-primary/5 text-primary border-primary/10';
            @endphp
            <div class="flex items-center gap-3 mb-4 au d1">
                <span class="w-6 h-px bg-secondary"></span>
                <span class="text-xs font-semibold uppercase tracking-wider text-secondary">Berita</span>
            </div>

            <div class="max-w-4xl">
                <span class="inline-block text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full border {{ $badgeClass }} au d2">
                    {{ $berita->kategori ?? 'Umum' }}
                </span>
                <h1 class="serif text-3xl md:text-5xl font-normal text-accent-green leading-tight tracking-tight mt-4 mb-6 au d3">
                    {{ $berita->judul }}
                </h1>
            </div>

            {{-- Meta Row --}}
            <div class="flex flex-wrap items-center gap-y-3 gap-x-6 py-4 border-t border-b border-primary/10 au d4 text-sm text-gray-500">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary to-primary-light flex items-center justify-center text-white font-bold text-xs">
                        {{ strtoupper(substr($berita->judul, 0, 1)) }}
                    </div>
                    <span class="font-medium text-gray-700">PCM Duren Sawit 1</span>
                </div>
                <span class="hidden md:inline text-primary/20">|</span>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-primary/40" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    <span>{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</span>
                </div>
                <span class="hidden md:inline text-primary/20">|</span>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-primary/40" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    @php $wc = str_word_count(strip_tags($berita->isi)); $rm = max(1, ceil($wc / 200)); @endphp
                    <span>{{ $rm }} menit baca</span>
                </div>
                <span class="hidden md:inline text-primary/20">|</span>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-primary/40" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                    <span>{{ number_format($wc) }} kata</span>
                </div>
            </div>

            {{-- Image --}}
            <div class="mt-8 au d5">
                @if($berita->gambar)
                    <div class="rounded-2xl overflow-hidden border border-primary/10 aspect-[16/9] md:aspect-[21/9]">
                        <img src="{{ $berita->gambar }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover"/>
                    </div>
                @else
                    <div class="rounded-2xl bg-gradient-to-br from-primary/5 to-primary/10 border border-primary/10 h-64 md:h-80 flex items-center justify-center">
                        <span class="serif italic text-7xl text-primary/10">{{ strtoupper(substr($berita->judul, 0, 1)) }}</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ══════════ ARTICLE LAYOUT ══════════ --}}
    <div class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-12 items-start">

        {{-- ── MAIN CONTENT ── --}}
        <main class="min-w-0">
            <div class="article-content" id="article-content">
                {!! $berita->isi !!}
            </div>

            {{-- Share/Back --}}
            <div class="mt-12 pt-6 border-t border-primary/10">
                <a href="/berita/show-all" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-gray-500 hover:text-primary transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                    Kembali ke Berita
                </a>
            </div>
        </main>

        {{-- ── SIDEBAR ── --}}
        <aside class="space-y-6">

            {{-- Table of Contents --}}
            <div id="toc-card" class="bg-white border border-primary/10 rounded-2xl p-6">
                <h4 class="text-xs font-bold uppercase tracking-wider text-primary mb-4 pb-2 border-b border-primary/10">Daftar Isi</h4>
                <ul id="toc-list" class="space-y-2 text-sm text-gray-600"></ul>
            </div>

            {{-- Info Card --}}
            <div class="bg-white border border-primary/10 rounded-2xl p-6">
                <h4 class="text-xs font-bold uppercase tracking-wider text-primary mb-4 pb-2 border-b border-primary/10">Informasi Berita</h4>
                <div class="space-y-4">
                    <div class="flex gap-3 text-sm">
                        <svg class="w-4 h-4 text-primary/40 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        <div>
                            <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Diterbitkan</div>
                            <div class="font-medium text-gray-700 mt-0.5">{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</div>
                        </div>
                    </div>
                    <div class="flex gap-3 text-sm">
                        <svg class="w-4 h-4 text-primary/40 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                        <div>
                            <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Estimasi Baca</div>
                            <div class="font-medium text-gray-700 mt-0.5">{{ $rm }} menit</div>
                        </div>
                    </div>
                    <div class="flex gap-3 text-sm">
                        <svg class="w-4 h-4 text-primary/40 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 10h16M4 14h10"/></svg>
                        <div>
                            <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Kategori</div>
                            <div class="font-medium text-gray-700 mt-0.5">{{ $berita->kategori ?? 'Umum' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Related --}}
            @php
                $related = \App\Models\Berita::where('status', 'published')
                    ->where('id', '!=', $berita->id)
                    ->where('kategori', $berita->kategori)
                    ->latest()
                    ->limit(4)
                    ->get();
                if ($related->count() < 2) {
                    $related = \App\Models\Berita::where('status', 'published')
                        ->where('id', '!=', $berita->id)
                        ->latest()
                        ->limit(4)
                        ->get();
                }
            @endphp

            @if($related->count() > 0)
            <div class="bg-white border border-primary/10 rounded-2xl p-6">
                <h4 class="text-xs font-bold uppercase tracking-wider text-primary mb-4 pb-2 border-b border-primary/10">Berita Lainnya</h4>
                <div class="space-y-4">
                    @foreach($related as $rel)
                    <a href="/berita/detail/{{ $rel->slug }}" class="flex gap-3 group items-start">
                        @if($rel->gambar)
                            <div class="w-16 h-12 rounded-lg overflow-hidden border border-primary/10 flex-shrink-0">
                                <img src="{{ asset('storage/' . $rel->gambar) }}" alt="{{ $rel->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
                            </div>
                        @else
                            <div class="w-16 h-12 rounded-lg bg-primary/5 flex items-center justify-center flex-shrink-0 border border-primary/10">
                                <span class="serif text-xs italic text-primary/30">{{ strtoupper(substr($rel->judul, 0, 1)) }}</span>
                            </div>
                        @endif
                        <div class="min-w-0">
                            <h5 class="text-xs font-medium text-gray-800 leading-snug line-clamp-2 group-hover:text-primary transition-colors">{{ $rel->judul }}</h5>
                            <span class="text-[10px] text-gray-400 mt-1 block">{{ \Carbon\Carbon::parse($rel->created_at)->diffForHumans() }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </aside>
    </div>
@endsection

@section('scripts')
    <script>
        // ── Reading progress bar ──
        window.addEventListener('scroll', function () {
            var scrollTop = window.scrollY || document.documentElement.scrollTop;
            var docHeight = document.documentElement.scrollHeight - window.innerHeight;
            var pct = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            document.getElementById('read-progress').style.width = Math.min(pct, 100) + '%';
        });

        // ── Auto Table of Contents from h2 headings ──
        (function () {
            var content = document.getElementById('article-content');
            var tocList = document.getElementById('toc-list');
            var tocCard = document.getElementById('toc-card');
            if (!content || !tocList) return;

            var headings = content.querySelectorAll('h2, h3');
            if (headings.length === 0) {
                tocCard.style.display = 'none';
                return;
            }

            headings.forEach(function (h, i) {
                var id = 'section-' + i;
                h.id = id;

                var li  = document.createElement('li');
                li.className = 'toc-item' + (h.tagName === 'H3' ? ' ml-3' : '');

                var a   = document.createElement('a');
                a.href  = '#' + id;
                a.setAttribute('data-num', (i + 1) + '.');
                a.textContent = h.textContent;

                a.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.getElementById(id).scrollIntoView({ behavior: 'smooth', block: 'start' });
                });

                li.appendChild(a);
                tocList.appendChild(li);
            });

            // Highlight active ToC item on scroll
            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    var id = entry.target.id;
                    var link = tocList.querySelector('a[href="#' + id + '"]');
                    if (!link) return;
                    if (entry.isIntersecting) {
                        tocList.querySelectorAll('a').forEach(function (a) { a.classList.remove('active'); });
                        link.classList.add('active');
                    }
                });
            }, { rootMargin: '-20% 0px -70% 0px' });

            headings.forEach(function (h) { observer.observe(h); });
        })();

        // ── Copy link ──
        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(function () {
                var btn = document.getElementById('copy-btn');
                btn.innerHTML = '<svg width="13" height="13" fill="none" stroke="var(--gold)" stroke-width="2" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>';
                setTimeout(function () {
                    btn.innerHTML = '<svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>';
                }, 2000);
            });
        }
    </script>
@endsection
