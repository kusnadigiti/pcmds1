<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ $berita->judul }} — PCM Duren Sawit 1</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Syne:wght@400;500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet"/>

    <style>
        :root {
            --cream:    #F4F1EB;
            --cream-dk: #EDE9E1;
            --ink:      #111010;
            --muted:    #7A7570;
            --faint:    #B8B3AB;
            --gold:     #C8A96E;
            --gold-dk:  #8B6840;
            --line:     #E4E0D8;
            --white:    #FDFCFA;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
        }

        .serif { font-family: 'Playfair Display', serif; }
        .syne  { font-family: 'Syne', sans-serif; }

        /* ── READING PROGRESS BAR ── */
        #read-progress {
            position: fixed; top: 0; left: 0; z-index: 200;
            height: 2px; width: 0%;
            background: linear-gradient(90deg, var(--gold-dk), var(--gold));
            transition: width .1s linear;
            pointer-events: none;
        }

        /* ── NAV ── */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            height: 68px;
            background: rgba(244,241,235,.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--line);
        }
        .nav-inner {
            max-width: 1280px; margin: 0 auto;
            padding: 0 2rem; height: 100%;
            display: flex; align-items: center; justify-content: space-between;
        }
        .nav-logo { display: flex; align-items: center; gap: .75rem; text-decoration: none; }
        .nav-logo img { height: 28px; }
        .nav-logo span { font-family: 'Syne', sans-serif; font-weight: 600; font-size: .95rem; color: var(--ink); }
        .nav-links { display: flex; align-items: center; gap: 2rem; }
        .nav-links a { font-size: .82rem; color: var(--muted); text-decoration: none; letter-spacing: .02em; transition: color .2s; }
        .nav-links a:hover { color: var(--ink); }
        .nav-links a.active { color: var(--gold); font-weight: 600; }
        #menu-btn { background: none; border: none; cursor: pointer; padding: .4rem; display: none; }
        #mobile-menu {
            display: none; position: absolute; top: 68px; left: 0; right: 0;
            background: rgba(244,241,235,.97); backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--line); padding: 1.25rem 2rem;
            flex-direction: column; gap: .9rem;
        }
        #mobile-menu.open { display: flex; }
        #mobile-menu a { font-size: .88rem; color: var(--muted); text-decoration: none; }
        #mobile-menu a.active { color: var(--gold); font-weight: 600; }

        /* ── HERO ── */
        .hero {
            padding-top: 68px;
            background: var(--white);
            border-bottom: 1px solid var(--line);
        }
        .hero-inner {
            max-width: 1280px; margin: 0 auto;
            padding: 4rem 2rem 0;
        }

        /* Eyebrow + breadcrumb */
        .hero-top {
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 1rem;
            margin-bottom: 2.5rem;
        }
        .eyebrow { display: flex; align-items: center; gap: .75rem; }
        .eyebrow-line { width: 28px; height: 1px; background: var(--gold); }
        .eyebrow-label {
            font-family: 'Syne', sans-serif; font-size: .65rem;
            letter-spacing: .18em; text-transform: uppercase;
            color: var(--gold); font-weight: 700;
        }
        .breadcrumb { display: flex; align-items: center; gap: .5rem; }
        .breadcrumb a {
            font-family: 'Syne', sans-serif; font-size: .7rem; color: var(--faint);
            text-decoration: none; letter-spacing: .04em;
            transition: color .2s;
        }
        .breadcrumb a:hover { color: var(--ink); }
        .breadcrumb span { font-size: .7rem; color: var(--line); }
        .breadcrumb .current { font-family: 'Syne', sans-serif; font-size: .7rem; color: var(--muted); }

        /* Title block */
        .hero-title-block {
            max-width: 860px;
            margin-bottom: 2.5rem;
        }
        .cat-badge {
            font-family: 'Syne', sans-serif; font-size: .62rem; font-weight: 700;
            letter-spacing: .1em; text-transform: uppercase;
            padding: .3rem .8rem; border-radius: 100px; display: inline-flex;
            align-items: center; gap: .35rem;
            margin-bottom: 1.25rem;
        }
        .cat-badge::before {
            content: ''; width: 6px; height: 6px; border-radius: 50%;
            background: currentColor; opacity: .6;
        }
        .cat-dakwah      { background: #D1FAE5; color: #065F46; }
        .cat-pendidikan  { background: #DBEAFE; color: #1E3A8A; }
        .cat-sosial      { background: #FFEDD5; color: #7C2D12; }
        .cat-organisasi  { background: #EDE9FE; color: #4C1D95; }
        .cat-default     { background: #F3F0E8; color: var(--muted); }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 5vw, 4rem);
            line-height: 1.1; letter-spacing: -.025em;
            color: var(--ink);
        }

        /* Meta row */
        .hero-meta {
            display: flex; align-items: center; flex-wrap: wrap; gap: 1.5rem;
            padding: 1.5rem 0;
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
            margin-bottom: 0;
        }
        .meta-author { display: flex; align-items: center; gap: .6rem; }
        .meta-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-dk));
            display: flex; align-items: center; justify-content: center;
            font-family: 'Playfair Display', serif; font-size: .75rem;
            color: white; flex-shrink: 0;
        }
        .meta-name { font-size: .82rem; font-weight: 500; color: var(--ink); }
        .meta-sep { width: 1px; height: 20px; background: var(--line); }
        .meta-item { display: flex; align-items: center; gap: .4rem; }
        .meta-item svg { color: var(--faint); }
        .meta-item span { font-family: 'Syne', sans-serif; font-size: .72rem; color: var(--muted); letter-spacing: .02em; }

        /* Hero image */
        .hero-img-wrap {
            margin-top: 3rem;
            overflow: hidden;
            border-radius: 16px 16px 0 0;
            max-height: 520px;
        }
        .hero-img-wrap img {
            width: 100%; height: 100%; object-fit: cover;
            display: block;
            transition: transform 12s ease;
        }
        .hero-img-wrap:hover img { transform: scale(1.03); }
        .hero-no-img {
            height: 320px;
            background: linear-gradient(135deg, #E8E3D8 0%, #D4CFC4 50%, #C8C2B5 100%);
            display: flex; align-items: center; justify-content: center;
            border-radius: 16px 16px 0 0;
        }
        .hero-no-img-glyph {
            font-family: 'Playfair Display', serif; font-style: italic;
            font-size: 9rem; color: rgba(0,0,0,.07);
            user-select: none; line-height: 1;
        }

        /* ── ARTICLE LAYOUT ── */
        .article-layout {
            max-width: 1280px; margin: 0 auto;
            padding: 4rem 2rem 6rem;
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 4rem;
            align-items: start;
        }

        /* ── ARTICLE BODY ── */
        .article-body { min-width: 0; }

        /* Drop cap */
        .article-content > p:first-child::first-letter {
            font-family: 'Playfair Display', serif;
            font-size: 4.5rem; font-weight: 600;
            float: left; line-height: .82;
            margin: .08em .12em 0 0;
            color: var(--gold-dk);
        }

        /* Prose */
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
            color: var(--ink); margin: 2.5rem 0 1rem;
        }
        .article-content h3 {
            font-family: 'Syne', sans-serif;
            font-size: 1rem; font-weight: 700;
            letter-spacing: .08em; text-transform: uppercase;
            color: var(--muted); margin: 2rem 0 .75rem;
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
            border-left: 3px solid var(--gold);
            background: var(--white);
            border-radius: 0 12px 12px 0;
        }
        .article-content blockquote p {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem; font-style: italic;
            line-height: 1.6; color: var(--ink);
            margin: 0;
        }
        .article-content blockquote p::first-letter { all: unset; }
        .article-content a { color: var(--gold-dk); text-decoration: underline; text-underline-offset: 3px; }
        .article-content strong { font-weight: 600; color: var(--ink); }
        .article-content em { font-style: italic; }
        .article-content img {
            width: 100%; border-radius: 12px; margin: 1.5rem 0;
        }

        /* Pull quote divider */
        .article-divider {
            display: flex; align-items: center; gap: 1rem;
            margin: 3rem 0;
        }
        .article-divider-line { flex: 1; height: 1px; background: var(--line); }
        .article-divider-glyph { font-family: 'Playfair Display', serif; font-style: italic; color: var(--gold); font-size: 1.2rem; }

        /* Share row */
        .share-row {
            margin-top: 3.5rem; padding-top: 2rem;
            border-top: 1px solid var(--line);
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 1rem;
        }
        .share-label { font-family: 'Syne', sans-serif; font-size: .7rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: var(--muted); }
        .share-btns { display: flex; align-items: center; gap: .5rem; }
        .share-btn {
            width: 36px; height: 36px; border-radius: 50%;
            border: 1.5px solid var(--line);
            background: transparent; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: var(--muted); transition: border-color .2s, color .2s, background .2s;
        }
        .share-btn:hover { border-color: var(--ink); color: var(--ink); background: var(--white); }
        .back-btn {
            display: inline-flex; align-items: center; gap: .5rem;
            font-family: 'Syne', sans-serif; font-size: .72rem; font-weight: 700;
            letter-spacing: .08em; text-transform: uppercase;
            color: var(--muted); text-decoration: none;
            transition: color .2s;
        }
        .back-btn:hover { color: var(--ink); }
        .back-btn svg { transition: transform .2s; }
        .back-btn:hover svg { transform: translateX(-3px); }

        /* ── SIDEBAR ── */
        .sidebar { position: sticky; top: 88px; display: flex; flex-direction: column; gap: 1.5rem; }

        .sidebar-card {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 1.5rem;
        }
        .sidebar-title {
            font-family: 'Syne', sans-serif; font-size: .65rem; font-weight: 700;
            letter-spacing: .14em; text-transform: uppercase; color: var(--faint);
            margin-bottom: 1.1rem;
            display: flex; align-items: center; gap: .6rem;
        }
        .sidebar-title::after { content: ''; flex: 1; height: 1px; background: var(--line); }

        /* Table of contents */
        .toc-list { list-style: none; display: flex; flex-direction: column; gap: .2rem; }
        .toc-item a {
            display: flex; align-items: baseline; gap: .5rem;
            font-size: .78rem; color: var(--muted); text-decoration: none;
            padding: .35rem .5rem; border-radius: 8px;
            transition: background .15s, color .15s;
            line-height: 1.4;
        }
        .toc-item a::before {
            content: attr(data-num);
            font-family: 'Playfair Display', serif; font-style: italic;
            font-size: .65rem; color: var(--gold); flex-shrink: 0;
        }
        .toc-item a:hover { background: var(--cream-dk); color: var(--ink); }
        .toc-item a.active { background: var(--cream-dk); color: var(--ink); font-weight: 500; }

        /* Article info */
        .info-row { display: flex; flex-direction: column; gap: .7rem; }
        .info-item {
            display: flex; align-items: flex-start; gap: .6rem;
        }
        .info-icon { color: var(--faint); flex-shrink: 0; margin-top: 1px; }
        .info-text-label { font-family: 'Syne', sans-serif; font-size: .62rem; letter-spacing: .08em; text-transform: uppercase; color: var(--faint); }
        .info-text-val { font-size: .8rem; color: var(--ink); font-weight: 500; margin-top: .1rem; }

        /* Related berita */
        .related-list { display: flex; flex-direction: column; gap: .85rem; }
        .related-item { display: flex; gap: .85rem; text-decoration: none; align-items: flex-start; group: true; }
        .related-img {
            width: 60px; height: 52px; border-radius: 8px; overflow: hidden; flex-shrink: 0;
        }
        .related-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .3s; }
        .related-item:hover .related-img img { transform: scale(1.08); }
        .related-no-img {
            width: 60px; height: 52px; border-radius: 8px; flex-shrink: 0;
            background: linear-gradient(135deg, #EAE6DF, #D4CFC4);
            display: flex; align-items: center; justify-content: center;
        }
        .related-no-img-glyph { font-family: 'Playfair Display', serif; font-style: italic; font-size: 1.4rem; color: rgba(0,0,0,.12); }
        .related-title {
            font-family: 'Playfair Display', serif; font-size: .82rem;
            line-height: 1.3; color: var(--ink);
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
            transition: color .2s;
        }
        .related-item:hover .related-title { color: var(--gold-dk); }
        .related-date { font-size: .65rem; color: var(--faint); margin-top: .25rem; font-family: 'Syne', sans-serif; }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .au { animation: fadeUp .6s cubic-bezier(.4,0,.2,1) both; }
        .d1 { animation-delay: .05s; } .d2 { animation-delay: .14s; }
        .d3 { animation-delay: .23s; } .d4 { animation-delay: .32s; }
        .d5 { animation-delay: .42s; }

        /* ── FOOTER ── */
        footer { border-top: 1px solid var(--line); }
        .footer-inner {
            max-width: 1280px; margin: 0 auto; padding: 1.75rem 2rem;
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;
        }
        .footer-brand { display: flex; align-items: center; gap: .75rem; }
        .footer-brand img { height: 22px; }
        .footer-brand span { font-family: 'Playfair Display', serif; font-size: .85rem; color: var(--ink); }
        .footer-copy { font-size: .72rem; color: var(--muted); }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .article-layout { grid-template-columns: 1fr; gap: 3rem; }
            .sidebar { position: static; flex-direction: row; flex-wrap: wrap; }
            .sidebar-card { flex: 1; min-width: 240px; }
        }
        @media (max-width: 640px) {
            .nav-links { display: none; }
            #menu-btn { display: block; }
            .hero-inner { padding: 3rem 1.25rem 0; }
            .article-layout { padding: 2.5rem 1.25rem 4rem; }
            .hero-title { font-size: 1.9rem; }
            .article-content p { font-size: .95rem; }
            .article-content > p:first-child::first-letter { font-size: 3.5rem; }
            .hero-meta { gap: 1rem; }
            .sidebar { flex-direction: column; }
        }
    </style>
</head>
<body>

    {{-- ── READING PROGRESS ── --}}
    <div id="read-progress"></div>

    {{-- ══════════ NAV ══════════ --}}
    @include('layouts.navigation')

    {{-- ══════════ HERO ══════════ --}}
    <section class="hero">
        <div class="hero-inner">

            {{-- Top row --}}

            {{-- Title block --}}
            <div class="hero-title-block">
                @php
                    $kat = strtolower($berita->kategori ?? '');
                    $catClass = in_array($kat, ['dakwah','pendidikan','sosial','organisasi']) ? 'cat-'.$kat : 'cat-default';
                @endphp
                <span class="cat-badge {{ $catClass }} au d2">{{ $berita->kategori ?? 'Umum' }}</span>
                <h1 class="hero-title au d3">{{ $berita->judul }}</h1>
            </div>

            {{-- Meta --}}
            <div class="hero-meta au d4">
                <div class="meta-author">
                    <div class="meta-avatar">{{ strtoupper(substr($berita->judul, 0, 1)) }}</div>
                    <div>
                        <div class="meta-name">PCM Duren Sawit 1</div>
                    </div>
                </div>
                <div class="meta-sep"></div>
                <div class="meta-item">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    <span>{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</span>
                </div>
                <div class="meta-sep"></div>
                <div class="meta-item">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    @php $wc = str_word_count(strip_tags($berita->isi)); $rm = max(1, ceil($wc / 200)); @endphp
                    <span>{{ $rm }} menit baca</span>
                </div>
                <div class="meta-sep"></div>
                <div class="meta-item">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                    <span>{{ number_format($wc) }} kata</span>
                </div>
            </div>
        </div>

        {{-- Hero image --}}
        <div class="max-w-screen-xl mx-auto px-8 au d5" style="max-width:1280px">
            @if($berita->gambar)
                <div class="hero-img-wrap" style="max-height:520px">
                    <img src="{{ $berita->gambar }}" alt="{{ $berita->judul }}"/>
                </div>
            @else
                <div class="hero-no-img">
                    <span class="hero-no-img-glyph">{{ strtoupper(substr($berita->judul, 0, 1)) }}</span>
                </div>
            @endif
        </div>
    </section>

    {{-- ══════════ ARTICLE LAYOUT ══════════ --}}
    <div class="article-layout">

        {{-- ── MAIN CONTENT ── --}}
        <main class="article-body">

            <div class="article-divider">
                <div class="article-divider-line"></div>
                <span class="article-divider-glyph">✦</span>
                <div class="article-divider-line"></div>
            </div>

            <div class="article-content" id="article-content">
                {!! $berita->isi !!}
            </div>

            {{-- Share row --}}
            <div class="share-row">
                <a href="/berita/show-all" class="back-btn">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                    Kembali ke Berita
                </a>

            </div>
        </main>

        {{-- ── SIDEBAR ── --}}
        <aside class="sidebar">

            {{-- Table of Contents --}}

            {{-- Article Info --}}
            <div class="sidebar-card">
                <div class="sidebar-title">Info</div>
                <div class="info-row">
                    <div class="info-item">
                        <svg class="info-icon" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        <div>
                            <div class="info-text-label">Diterbitkan</div>
                            <div class="info-text-val">{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <svg class="info-icon" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                        <div>
                            <div class="info-text-label">Estimasi Baca</div>
                            <div class="info-text-val">{{ $rm }} menit</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <svg class="info-icon" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M4 6h16M4 10h16M4 14h10"/></svg>
                        <div>
                            <div class="info-text-label">Jumlah Kata</div>
                            <div class="info-text-val">{{ number_format($wc) }} kata</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <svg class="info-icon" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M7 7h10M7 11h10M7 15h6"/></svg>
                        <div>
                            <div class="info-text-label">Kategori</div>
                            <div class="info-text-val">{{ $berita->kategori ?? 'Umum' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Related Berita --}}
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
            <div class="sidebar-card">
                <div class="sidebar-title">Berita Lainnya</div>
                <div class="related-list">
                    @foreach($related as $rel)
                    <a href="/berita/detail/{{ $rel->slug }}" class="related-item">
                        @if($rel->gambar)
                            <div class="related-img">
                                <img src="{{ asset('storage/' . $rel->gambar) }}" alt="{{ $rel->judul }}" loading="lazy"/>
                            </div>
                        @else
                            <div class="related-no-img">
                                <span class="related-no-img-glyph">{{ strtoupper(substr($rel->judul, 0, 1)) }}</span>
                            </div>
                        @endif
                        <div style="min-width:0">
                            <div class="related-title">{{ $rel->judul }}</div>
                            <div class="related-date">{{ \Carbon\Carbon::parse($rel->created_at)->diffForHumans() }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </aside>
    </div>

    {{-- ══════════ FOOTER ══════════ --}}
    @include('layouts.footer')

    <script>
        // ── Mobile nav ──
        document.getElementById('menu-btn').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('open');
        });

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
</body>
</html>
