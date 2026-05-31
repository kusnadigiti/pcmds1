{{-- resources/views/pages/otonom/organisasi-anggota.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $organisasi->nama ?? 'Daftar Anggota' }} — Muhammadiyah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&family=DM+Mono:wght@300;400&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --ink: #1a1814;
            --ink-2: #4a463f;
            --ink-3: #9b9389;
            --ink-4: #ccc8c1;
            --paper: #f7f5f1;
            --paper-2: #edeae4;
            --paper-3: #e2ddd6;
            --accent: #c8a96e;
            --rule: rgba(26, 24, 20, .08);
        }

        * {
            -webkit-font-smoothing: antialiased;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--paper);
            color: var(--ink);
            margin: 0;
        }

        .font-serif {
            font-family: 'Cormorant Garamond', Georgia, serif;
        }

        .font-mono {
            font-family: 'DM Mono', monospace;
        }


        /* ── PAGE HERO ── */
        .hero {
            padding-top: 52px;
            background: var(--ink);
            color: var(--paper);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(90deg,
                    transparent,
                    transparent calc(100% / 12 - 1px),
                    rgba(255, 255, 255, .03) calc(100% / 12 - 1px),
                    rgba(255, 255, 255, .03) calc(100% / 12));
            pointer-events: none;
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem 3.5rem;
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: end;
            gap: 3rem;
        }

        .hero-eyebrow {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'DM Mono', monospace;
            font-size: 9px;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 1.25rem;
        }

        .hero-eyebrow::before {
            content: '';
            display: block;
            width: 28px;
            height: 1px;
            background: var(--accent);
        }

        .hero-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.8rem, 6vw, 5rem);
            font-weight: 300;
            line-height: 1.05;
            letter-spacing: -.01em;
            color: #fff;
            margin: 0 0 1rem;
        }

        .hero-title em {
            font-style: italic;
            color: rgba(255, 255, 255, .45);
        }

        .hero-desc {
            font-size: 13px;
            color: rgba(255, 255, 255, .45);
            line-height: 1.65;
            max-width: 420px;
        }

        /* Stats column */
        .hero-stats {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            align-items: flex-end;
            padding-bottom: .25rem;
        }

        .stat-item {
            text-align: right;
        }

        .stat-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3rem;
            font-weight: 300;
            line-height: 1;
            color: #fff;
            letter-spacing: -.02em;
        }

        .stat-label {
            font-family: 'DM Mono', monospace;
            font-size: 9px;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .35);
            margin-top: 4px;
        }

        .stat-divider {
            width: 1px;
            height: 32px;
            background: rgba(255, 255, 255, .1);
        }

        /* Org logo pill in hero */
        .org-logo-pill {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, .07);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 100px;
            padding: 6px 14px 6px 6px;
            margin-bottom: 1.25rem;
        }

        .org-logo-pill img {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            object-fit: contain;
            background: rgba(255, 255, 255, .1);
        }

        .org-logo-pill span {
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            letter-spacing: .08em;
            color: rgba(255, 255, 255, .6);
        }

        /* ── TOOLBAR ── */
        .toolbar {
            position: sticky;
            top: 52px;
            z-index: 50;
            background: rgba(247, 245, 241, .96);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--rule);
        }

        .toolbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: .625rem 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Search */
        .search-wrap {
            position: relative;
            flex: 1;
            max-width: 280px;
        }

        .search-wrap svg {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 13px;
            height: 13px;
            color: var(--ink-4);
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            padding: 7px 12px 7px 32px;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            background: var(--paper-2);
            border: 1px solid var(--paper-3);
            border-radius: 8px;
            color: var(--ink);
            transition: border-color .15s, background .15s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--ink-4);
            background: #fff;
        }

        .search-input::placeholder {
            color: var(--ink-4);
        }

        /* Pills */
        .pills {
            display: flex;
            gap: 6px;
            overflow-x: auto;
            padding-bottom: 1px;
            scrollbar-width: none;
        }

        .pills::-webkit-scrollbar {
            display: none;
        }

        .pill {
            flex-shrink: 0;
            font-family: 'DM Mono', monospace;
            font-size: 9px;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 5px 12px;
            border: 1px solid var(--paper-3);
            border-radius: 100px;
            color: var(--ink-3);
            background: transparent;
            cursor: pointer;
            transition: all .15s;
            white-space: nowrap;
        }

        .pill:hover {
            border-color: var(--ink-4);
            color: var(--ink-2);
        }

        .pill.active {
            background: var(--ink);
            border-color: var(--ink);
            color: #fff;
        }

        /* Count badge */
        .pill-count {
            display: inline-block;
            margin-left: 5px;
            opacity: .5;
        }

        /* ── MAIN CONTENT ── */
        .content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2.5rem 2rem 5rem;
        }

        /* ── SECTION (grouped by bidang/level) ── */
        .section {
            margin-bottom: 3rem;
        }

        .section-header {
            display: flex;
            align-items: baseline;
            gap: 12px;
            margin-bottom: 1rem;
            padding-bottom: .75rem;
            border-bottom: 1px solid var(--rule);
        }

        .section-title {
            font-family: 'DM Mono', monospace;
            font-size: 9px;
            letter-spacing: .16em;
            text-transform: uppercase;
            color: var(--ink-3);
        }

        .section-count {
            font-family: 'DM Mono', monospace;
            font-size: 9px;
            color: var(--ink-4);
        }

        /* Level stripe accent */
        .level-inti .section-title {
            color: var(--ink);
        }

        .level-inti .section-stripe {
            background: var(--ink);
        }

        .level-majelis .section-title {
            color: #7c6b4e;
        }

        .level-majelis .section-stripe {
            background: var(--accent);
        }

        .level-lembaga .section-title {
            color: #4e6b5e;
        }

        .level-lembaga .section-stripe {
            background: #7aab8e;
        }

        .section-stripe {
            display: inline-block;
            width: 20px;
            height: 2px;
            background: var(--ink-4);
            border-radius: 2px;
            flex-shrink: 0;
            margin-bottom: 2px;
        }

        /* ── MEMBER GRID ── */
        .member-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1px;
            background: var(--paper-3);
            border-radius: 12px;
            overflow: hidden;
        }

        /* ── MEMBER CARD ── */
        .member-card {
            background: #fff;
            padding: 1.125rem 1.25rem;
            display: flex;
            flex-direction: column;
            gap: .75rem;
            transition: background .12s;
            position: relative;
        }

        .member-card:hover {
            background: var(--paper);
        }

        .card-main {
            display: flex;
            align-items: flex-start;
            gap: .875rem;
        }

        /* Avatar */
        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            flex-shrink: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            font-weight: 400;
        }

        .av-warm {
            background: #f0ebe3;
            color: #8c7b62;
        }

        .av-cool {
            background: #e8edf4;
            color: #5c6e8a;
        }

        .av-sage {
            background: #e5ede8;
            color: #4d7260;
        }

        .av-rose {
            background: #f0e8e8;
            color: #8a5555;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Card info */
        .card-info {
            flex: 1;
            min-width: 0;
        }

        .card-name {
            font-size: 13px;
            font-weight: 500;
            line-height: 1.3;
            color: var(--ink);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-jabatan {
            font-size: 11px;
            color: var(--ink-3);
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-bidang {
            font-family: 'DM Mono', monospace;
            font-size: 9px;
            letter-spacing: .06em;
            color: var(--ink-4);
            text-transform: uppercase;
            margin-top: 3px;
        }

        /* Badge */
        .badge-inti {
            flex-shrink: 0;
            font-family: 'DM Mono', monospace;
            font-size: 8px;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 3px 8px;
            background: var(--ink);
            color: #fff;
            border-radius: 100px;
            align-self: flex-start;
            margin-top: 2px;
        }

        .badge-majelis {
            flex-shrink: 0;
            font-family: 'DM Mono', monospace;
            font-size: 8px;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 3px 8px;
            background: #f5ede0;
            color: #8c6b3a;
            border-radius: 100px;
            align-self: flex-start;
            margin-top: 2px;
        }

        .badge-lembaga {
            flex-shrink: 0;
            font-family: 'DM Mono', monospace;
            font-size: 8px;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 3px 8px;
            background: #e5ede8;
            color: #3d6b52;
            border-radius: 100px;
            align-self: flex-start;
            margin-top: 2px;
        }

        /* Contact */
        .card-contact {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding-top: .625rem;
            border-top: 1px solid var(--rule);
        }

        .contact-link {
            display: flex;
            align-items: center;
            gap: 5px;
            font-family: 'DM Mono', monospace;
            font-size: 9px;
            letter-spacing: .03em;
            color: var(--ink-4);
            text-decoration: none;
            transition: color .15s;
            min-width: 0;
        }

        .contact-link:hover {
            color: var(--ink-2);
        }

        .contact-link svg {
            width: 10px;
            height: 10px;
            flex-shrink: 0;
        }

        .contact-link span {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ── EMPTY STATES ── */
        .empty-data,
        .empty-search {
            text-align: center;
            padding: 6rem 2rem;
        }

        .empty-glyph {
            font-family: 'Cormorant Garamond', serif;
            font-size: 4rem;
            font-weight: 300;
            color: var(--paper-3);
            line-height: 1;
            margin-bottom: 1rem;
        }

        .empty-text {
            font-size: 12px;
            color: var(--ink-4);
        }

        .empty-action {
            margin-top: 1rem;
            font-family: 'DM Mono', monospace;
            font-size: 9px;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--ink-3);
            background: none;
            border: none;
            cursor: pointer;
            transition: color .15s;
        }

        .empty-action:hover {
            color: var(--ink);
        }

        /* ── FOOTER ── */
        .page-footer {
            border-top: 1px solid var(--rule);
            background: var(--paper);
            padding: 1.5rem 2rem;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-brand {
            font-family: 'DM Mono', monospace;
            font-size: 9px;
            letter-spacing: .16em;
            text-transform: uppercase;
            color: var(--ink-4);
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp .5s cubic-bezier(.22, .68, 0, 1.2) both;
        }

        .d1 {
            animation-delay: .05s;
        }

        .d2 {
            animation-delay: .12s;
        }

        .d3 {
            animation-delay: .19s;
        }

        .d4 {
            animation-delay: .26s;
        }

        .d5 {
            animation-delay: .33s;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 640px) {
            .hero-inner {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 2.5rem 1.25rem 2.5rem;
            }

            .hero-stats {
                flex-direction: row;
                align-items: flex-start;
                flex-wrap: wrap;
                gap: 1.25rem;
            }

            .stat-divider {
                width: 1px;
                height: 2rem;
                align-self: center;
            }

            .stat-item {
                text-align: left;
            }

            .stat-num {
                font-size: 2.25rem;
            }

            .toolbar-inner {
                flex-wrap: wrap;
                gap: .625rem;
                padding: .625rem 1.25rem;
            }

            .search-wrap {
                max-width: 100%;
                width: 100%;
            }

            .content {
                padding: 1.5rem 1.25rem 4rem;
            }

            .member-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    @include('layouts.navigation')


    {{-- ── HERO ── --}}
    <section class="hero">
        <div class="hero-inner">
            <div class="fade-up d1">
                {{-- Org logo pill --}}
                @if (isset($organisasi))
                    <div class="org-logo-pill">
                        @if ($organisasi->logo)
                            <img src="{{ asset('storage/' . $organisasi->logo) }}" alt="{{ $organisasi->nama }}">
                        @else
                            <div
                                style="width:28px;height:28px;border-radius:50%;background:rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;font-family:'DM Mono',monospace;font-size:9px;color:rgba(255,255,255,.5);">
                                {{ strtoupper(substr($organisasi->singkatan ?? $organisasi->nama, 0, 2)) }}
                            </div>
                        @endif
                        <span>{{ $organisasi->singkatan ?? ucfirst($organisasi->tipe ?? '') }}</span>
                    </div>
                @else
                    <div class="hero-eyebrow">Kepengurusan Aktif</div>
                @endif

                <h1 class="hero-title">
                    @if (isset($organisasi))
                        {{ $organisasi->nama }}<br>
                        <em>Daftar Anggota</em>
                    @else
                        Daftar<br><em>Anggota</em> Pengurus
                    @endif
                </h1>
                <p class="hero-desc">
                    @if (isset($organisasi))
                        Seluruh pengurus aktif periode
                        {{ $organisasi->periode_mulai }}–{{ $organisasi->periode_selesai }}.
                    @else
                        Seluruh pengurus aktif dari setiap organisasi dalam naungan Muhammadiyah.
                    @endif
                </p>
            </div>


            {{-- Stats --}}
            <div class="hero-stats fade-up d2">
                <div class="stat-item">
                    <div class="stat-num" id="stat-total">{{ $penguruses->count() }}</div>
                    <div class="stat-label">Total Anggota</div>
                </div>
                <div class="stat-divider"></div>
                @if (!isset($organisasi))
                    <div class="stat-item">
                        <div class="stat-num">{{ $penguruses->pluck('organisasi_otonom_id')->unique()->count() }}</div>
                        <div class="stat-label">Organisasi</div>
                    </div>
                @else
                    <div class="stat-item">
                        <div class="stat-num">{{ $penguruses->where('level', 'inti')->count() }}</div>
                        <div class="stat-label">Pengurus Inti</div>
                    </div>
                @endif
            </div>
        </div>
    </section>


    {{-- ── TOOLBAR ── --}}
    <div class="toolbar fade-up d3">
        <div class="toolbar-inner">
            {{-- Search --}}
            <div class="search-wrap">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" id="search-input" class="search-input" placeholder="Cari nama atau jabatan..."
                    oninput="filterMembers()">
            </div>

            {{-- Level pills --}}
            <div class="pills" id="level-pills">
                <button class="pill active" onclick="setFilter('all', this)">
                    Semua <span class="pill-count">{{ $penguruses->count() }}</span>
                </button>
                @foreach (['inti' => 'Pengurus Inti', 'majelis' => 'Majelis', 'lembaga' => 'Lembaga'] as $val => $label)
                    @php $cnt = $penguruses->where('level', $val)->count(); @endphp
                    @if ($cnt > 0)
                        <button class="pill" onclick="setFilter('{{ $val }}', this)"
                            data-level="{{ $val }}">
                            {{ $label }} <span class="pill-count">{{ $cnt }}</span>
                        </button>
                    @endif
                @endforeach

                {{-- Org pills only when no specific org --}}
                @if (!isset($organisasi))
                    @php $orgs = $penguruses->map(fn($p) => $p->organisasi)->filter()->unique('id')->sortBy('nama'); @endphp
                    @foreach ($orgs as $o)
                        <button class="pill" onclick="setFilter('org_{{ $o->id }}', this)"
                            data-org="{{ $o->id }}">
                            {{ $o->singkatan ?? $o->nama }}
                            <span
                                class="pill-count">{{ $penguruses->where('organisasi_otonom_id', $o->id)->count() }}</span>
                        </button>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <a href="{{ url()->previous() }}"
        class="flex items-center w-40 ml-10 mt-10 gap-2 px-3 py-2 text-xs font-mono uppercase tracking-widest text-gray-600 border border-gray-200 rounded-full hover:bg-gray-900 hover:border-gray-900 hover:text-white transition-all duration-150 whitespace-nowrap">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        <span>Kembali</span>
    </a>


    {{-- ── MEMBER LIST ── --}}
    <main class="content">
        @php
            $grouped = $penguruses->groupBy('level');
            $levelOrder = ['inti', 'majelis', 'lembaga'];
            $levelLabels = ['inti' => 'Pengurus Inti', 'majelis' => 'Majelis', 'lembaga' => 'Lembaga'];
            $avatarClasses = ['av-warm', 'av-cool', 'av-sage', 'av-rose'];
            $delay = 4;
        @endphp

        @forelse($levelOrder as $level)
            @if ($grouped->has($level))
                @php
                    $members = $grouped[$level]->sortBy('urutan');
                    $delay++;
                @endphp

                <div class="section level-{{ $level }} fade-up d{{ min($delay, 5) }}"
                    data-section-level="{{ $level }}">

                    <div class="section-header">
                        <span class="section-stripe"></span>
                        <span class="section-title">{{ $levelLabels[$level] }}</span>
                        <span class="section-count">{{ $members->count() }} orang</span>
                    </div>

                    <div class="member-grid">
                        @foreach ($members as $index => $p)
                            @php $av = $avatarClasses[$index % 4]; @endphp
                            <div class="member-card" data-nama="{{ strtolower($p->nama) }}"
                                data-jabatan="{{ strtolower($p->jabatan) }}" data-level="{{ $p->level }}"
                                data-org="{{ $p->organisasi_otonom_id ?? 'null' }}">

                                <div class="card-main">
                                    {{-- Avatar --}}
                                    <div class="avatar {{ $av }}">
                                        @if ($p->foto)
                                            <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama }}">
                                        @else
                                            {{ strtoupper(substr(explode(' ', trim($p->nama))[0], 0, 1)) }}{{ strtoupper(substr(explode(' ', trim($p->nama))[1] ?? '', 0, 1)) }}
                                        @endif
                                    </div>

                                    {{-- Info --}}
                                    <div class="card-info">
                                        <div class="card-name">{{ $p->nama }}</div>
                                        <div class="card-jabatan">{{ $p->jabatan }}</div>
                                        @if ($p->bidang && $p->bidang !== '—')
                                            <div class="card-bidang">{{ $p->bidang }}</div>
                                        @endif
                                    </div>

                                    {{-- Badge --}}
                                    @if ($p->level === 'inti')
                                        <span class="badge-inti">Inti</span>
                                    @elseif($p->level === 'majelis')
                                        <span class="badge-majelis">Majelis</span>
                                    @elseif($p->level === 'lembaga')
                                        <span class="badge-lembaga">Lembaga</span>
                                    @endif
                                </div>

                                {{-- Contact --}}
                                @if ($p->no_hp || $p->email)
                                    <div class="card-contact">
                                        @if ($p->no_hp)
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $p->no_hp) }}"
                                                target="_blank" class="contact-link">
                                                <svg fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z" />
                                                    <path
                                                        d="M12 0C5.373 0 0 5.373 0 12c0 2.123.554 4.118 1.522 5.852L0 24l6.338-1.498A11.952 11.952 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.882 0-3.644-.495-5.17-1.362l-.37-.22-3.764.889.943-3.658-.243-.378A9.944 9.944 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                                                </svg>
                                                <span>{{ $p->no_hp }}</span>
                                            </a>
                                        @endif
                                        @if ($p->email)
                                            <a href="mailto:{{ $p->email }}" class="contact-link"
                                                style="min-width:0;flex:1;">
                                                <svg fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                <span>{{ $p->email }}</span>
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @empty
            <div class="empty-data">
                <div class="empty-glyph">—</div>
                <p class="empty-text">Belum ada data anggota.</p>
            </div>
        @endforelse

        {{-- Empty search --}}
        <div id="empty-search" class="empty-search" style="display:none;">
            <div class="empty-glyph">∅</div>
            <p class="empty-text">Tidak ada anggota yang cocok.</p>
            <button class="empty-action" onclick="clearFilter()">Hapus filter</button>
        </div>
    </main>



    {{-- ── FOOTER ── --}}
    @include('layouts.footer')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <script>
        let currentFilter = 'all';

        function filterMembers() {
            const query = document.getElementById('search-input').value.toLowerCase().trim();
            const sections = document.querySelectorAll('.section');
            let total = 0;

            sections.forEach(section => {
                const sectionLevel = section.dataset.sectionLevel;
                let sectionVisible = 0;

                section.querySelectorAll('.member-card').forEach(card => {
                    const nama = card.dataset.nama || '';
                    const jabatan = card.dataset.jabatan || '';
                    const level = card.dataset.level || '';
                    const org = card.dataset.org || '';

                    const matchSearch = !query || nama.includes(query) || jabatan.includes(query);
                    let matchFilter = true;

                    if (currentFilter !== 'all') {
                        if (currentFilter.startsWith('org_')) {
                            matchFilter = org === currentFilter.replace('org_', '');
                        } else {
                            matchFilter = level === currentFilter;
                        }
                    }

                    const show = matchSearch && matchFilter;
                    card.style.display = show ? '' : 'none';
                    if (show) {
                        sectionVisible++;
                        total++;
                    }
                });

                section.style.display = sectionVisible > 0 ? '' : 'none';
            });

            const stat = document.getElementById('stat-total');
            if (stat) stat.textContent = total;

            const empty = document.getElementById('empty-search');
            if (empty) empty.style.display = total === 0 ? 'block' : 'none';
        }

        function setFilter(val, btn) {
            currentFilter = val;
            document.querySelectorAll('.pill').forEach(p => p.classList.remove('active'));
            btn.classList.add('active');
            filterMembers();
        }

        function clearFilter() {
            document.getElementById('search-input').value = '';
            currentFilter = 'all';
            const pills = document.querySelectorAll('.pill');
            pills.forEach((p, i) => p.classList.toggle('active', i === 0));
            filterMembers();
        }
    </script>
</body>

</html>
