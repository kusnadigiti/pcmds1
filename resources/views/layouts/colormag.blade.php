<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#2e9e5b">

    <title>@yield('title', 'PCM Duren Sawit 1 | Muhammadiyah Berkemajuan')</title>
    <meta name="description" content="@yield('meta_description', 'Pimpinan Cabang Muhammadiyah Duren Sawit 1 - Mencerahkan Semesta, Memajukan Duren Sawit.')">
    <meta name="keywords" content="@yield('meta_keywords', 'PCM Duren Sawit 1, Muhammadiyah Duren Sawit, Kajian Islam, Amal Usaha Muhammadiyah')">
    <meta name="robots" content="@yield('meta_robots', 'index, follow, max-image-preview:large')">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'PCM Duren Sawit 1 | Muhammadiyah Berkemajuan')">
    <meta property="og:description" content="@yield('meta_description', 'Pimpinan Cabang Muhammadiyah Duren Sawit 1 - Mencerahkan Semesta, Memajukan Duren Sawit.')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    <meta property="og:site_name" content="PCM Duren Sawit 1">
    <meta property="og:locale" content="id_ID">
    <meta name="twitter:card" content="summary_large_image">

    @yield('schema')
    @stack('schema')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet"/>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#0d5c3a',
                            'primary-light': '#167a4e',
                            secondary: '#D4A017',
                            accent: '#0f1923',
                            cream: '#f8f5ee',
                        }
                    }
                }
            }
        </script>
    @endif

    <style>
        :root {
            --cm-primary: #2e9e5b;
            --cm-nav: #232323;
            --cm-footer: #303440;
            --cm-socket: #252730;
            --cm-text-main: #333333;
            --cm-text-body: #444444;
            --cm-meta: #888888;
            --cm-page-bg: #ffffff;
            --cm-border: #eaeaea;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: var(--cm-page-bg);
            color: var(--cm-text-body);
        }

        .cm-inner { max-width: 1140px; margin: 0 auto; padding-left: 10px; padding-right: 10px; }
        .cm-page { max-width: 1200px; margin: 0 auto; background: #ffffff; }

        .cm-transition { transition: all 0.3s linear; }

        {{-- Widget title pattern: badge hijau + garis bawah --}}
        .cm-widget-title {
            border-bottom: 2px solid #2e9e5b;
            font-size: 18px;
            font-weight: 600;
            color: #333333;
            margin: 0 0 15px 0;
            line-height: 1.4;
        }
        .cm-widget-title span {
            background-color: #2e9e5b;
            color: #fff;
            padding: 6px 12px;
            display: inline-block;
        }

        {{-- Badge kategori --}}
        .cm-cat-badge {
            background-color: #2e9e5b;
            color: #fff;
            border-radius: 3px;
            font-size: 12px;
            padding: 2px 10px;
            display: inline-block;
            text-decoration: none;
        }
        .cm-cat-badge:hover { background-color: #268a4f; color: #fff; }

        .cm-entry-title a { color: #232323; text-decoration: none; }
        .cm-entry-title a:hover { color: #2e9e5b; }

        .cm-meta { color: #888888; font-size: 12px; }
        .cm-meta span, .cm-meta a { display: inline-flex; align-items: center; gap: 0.25rem; }
        .cm-meta i, .cm-meta svg { width: 1rem !important; height: 1rem !important; display: inline-block; vertical-align: middle; flex-shrink: 0; }

        .cm-card-shadow { box-shadow: 0 1px 3px 0 rgba(0,0,0,0.1); }

        {{-- Dropdown nav --}}
        .cm-nav-item .cm-submenu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: all 0.25s ease;
        }
        .cm-nav-item:hover .cm-submenu,
        .cm-nav-item:focus-within .cm-submenu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        {{-- Breaking news ticker --}}
        @keyframes cm-ticker {
            0%, 22% { transform: translateY(0); }
            25%, 47% { transform: translateY(-100%); }
            50%, 72% { transform: translateY(-200%); }
            75%, 97% { transform: translateY(-300%); }
            100% { transform: translateY(0); }
        }
        .cm-ticker-track { animation: cm-ticker 16s infinite; }
        .cm-breaking-wrap:hover .cm-ticker-track { animation-play-state: paused; }

        @media (prefers-reduced-motion: reduce) {
            .cm-ticker-track { animation: none; }
        }

        {{-- Slider fade --}}
        .cm-slide { display: none; }
        .cm-slide.cm-slide-active { display: block; animation: cm-fade 0.6s ease both; }
        @keyframes cm-fade {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @media (prefers-reduced-motion: reduce) {
            .cm-slide.cm-slide-active { animation: none; }
            html { scroll-behavior: auto; }
        }
    </style>

    @stack('styles')
    @yield('styles')
</head>
<body class="min-h-screen flex flex-col">

@php
    try {
        $navMenus = \App\Models\NavMenu::topLevel()->visible()->with(['children' => function($q) {
            $q->visible()
                ->whereRaw('LOWER(label) NOT LIKE ?', ['%sejarah%'])
                ->whereRaw('LOWER(label) NOT LIKE ?', ['%visi misi%'])
                ->orderBy('order');
        }])->get();
    } catch (\Exception $e) {
        $navMenus = collect();
    }

    try {
        $navOrtoms = \App\Models\Organisasi::where('is_active', true)
            ->orderBy('tipe')
            ->orderBy('nama')
            ->get();
    } catch (\Exception $e) {
        $navOrtoms = collect();
    }

    $contactCm = \App\Models\Contact::first();
    $cmAddress = $contactCm->address ?? 'Gedung Dakwah Muhammadiyah, Jl. Duren Sawit Raya No. 1, Jakarta Timur';
    $cmPhone = $contactCm->phone ?? '+6285280136056';
    $cmEmail = $contactCm->email ?? 'info@pcmdurensawit1.or.id';

    // Nama hari & bulan Indonesia untuk tanggal breaking bar
    $cmHari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
    $cmBulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $cmToday = now();
    $cmTanggalLabel = ($cmHari[$cmToday->format('l')] ?? $cmToday->format('l')) . ', '
        . $cmToday->format('j') . ' ' . ($cmBulan[(int)$cmToday->format('n')] ?? '') . ' ' . $cmToday->format('Y');

    // Berita untuk ticker
    try {
        $cmTickerItems = \App\Models\Berita::where('status', 'published')->latest('created_at')->limit(4)->get(['judul', 'slug']);
    } catch (\Exception $e) {
        $cmTickerItems = collect();
    }

    $hasOrtomNav = $navMenus->contains(fn($m) => Str::contains(strtolower($m->label), 'otonom'));
    $hasPrmNav = $navMenus->contains(fn($m) => $m->label === 'PRM');
@endphp

{{-- ═══════ HEADER ═══════ --}}
<header class="bg-white">
    <div class="cm-inner flex flex-col md:flex-row md:items-center justify-between gap-3 pt-4 pb-3 px-2.5">

        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}"
                alt="Logo PCM Duren Sawit 1"
                class="h-[52px] w-auto object-contain"/>
            <div>
                <a href="/" class="text-[#2e9e5b] text-[28px] leading-none font-bold no-underline hover:text-[#268a4f] cm-transition block">PCM Duren Sawit 1</a>
                <p class="text-[13px] text-[#777777] mt-1 mb-0">Muhammadiyah Berkemajuan</p>
            </div>
        </div>

        <div class="hidden md:flex items-center gap-2">
            @auth
                @php
                    $dashboardRoute = match (auth()->user()->role) {
                        'superadmin', 'admin' => route('admin.dashboard'),
                        'penulis' => route('penulis.dashboard'),
                        'bendahara' => route('bendahara.dashboard'),
                        default => route('dashboard'),
                    };
                @endphp
                <a href="{{ $dashboardRoute }}"
                    class="bg-[#2e9e5b] hover:bg-[#268a4f] text-white text-[13px] font-semibold px-4 py-2 rounded-[3px] no-underline cm-transition">Dashboard</a>
            @endauth
        </div>
    </div>

    {{-- ═══════ NAVBAR GELAP ═══════ --}}
    <nav id="site-navigation" class="bg-[#232323] border-t-4 border-[#2e9e5b]"
        x-data="{ mobileOpen: false, searchOpen: false }">

        <div class="cm-inner relative flex items-center justify-between">

            {{-- Menu desktop --}}
            <ul class="hidden lg:flex list-none m-0 p-0 items-stretch">
                @foreach($navMenus as $menu)
                    @if(Str::contains(strtolower($menu->label), 'otonom') && $navOrtoms->isNotEmpty())
                        <li class="cm-nav-item relative">
                            <button class="flex items-center gap-1 uppercase text-white text-[13px] font-semibold tracking-wide px-3 py-[11px] bg-transparent border-0 cursor-pointer hover:bg-[#2e9e5b] cm-transition">
                                {{ $menu->label }}
                                <i data-lucide="chevron-down" class="w-3 h-3 opacity-80"></i>
                            </button>
                            <ul class="cm-submenu absolute left-0 top-full z-50 min-w-[220px] list-none m-0 p-1 bg-[#232323] shadow-lg">
                                @foreach($navOrtoms as $ortom)
                                    <li>
                                        <a href="{{ route('organisasi-otonom.show', $ortom->slug) }}"
                                            class="block px-3 py-2 text-[13px] normal-case font-normal text-[#dddddd] no-underline hover:bg-[#2e9e5b] hover:text-white cm-transition">
                                            {{ $ortom->nama }} {{ $ortom->singkatan ? '('.$ortom->singkatan.')' : '' }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @elseif($menu->children->isNotEmpty())
                        <li class="cm-nav-item relative">
                            <button class="flex items-center gap-1 uppercase text-white text-[13px] font-semibold tracking-wide px-3 py-[11px] bg-transparent border-0 cursor-pointer hover:bg-[#2e9e5b] cm-transition">
                                {{ $menu->label }}
                                <i data-lucide="chevron-down" class="w-3 h-3 opacity-80"></i>
                            </button>
                            <ul class="cm-submenu absolute left-0 top-full z-50 min-w-[200px] list-none m-0 p-1 bg-[#232323] shadow-lg">
                                @if(Str::contains(strtolower($menu->label), 'amal usaha') && !$menu->children->contains('url', '/amal-usaha'))
                                    <li>
                                        <a href="{{ route('amal-usaha.index') }}"
                                            class="block px-3 py-2 text-[13px] normal-case font-normal text-[#dddddd] no-underline hover:bg-[#2e9e5b] hover:text-white cm-transition">Semua Amal Usaha</a>
                                    </li>
                                @endif
                                @foreach($menu->children as $child)
                                    <li>
                                        <a href="{{ $child->url }}" {{ $child->open_new_tab ? 'target="_blank" rel="noopener"' : '' }}
                                            class="block px-3 py-2 text-[13px] normal-case font-normal text-[#dddddd] no-underline hover:bg-[#2e9e5b] hover:text-white cm-transition">{{ $child->label }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @elseif($menu->url)
                        <li class="cm-nav-item">
                            <a href="{{ $menu->url }}" {{ $menu->open_new_tab ? 'target="_blank" rel="noopener"' : '' }}
                                class="block uppercase text-white text-[13px] font-semibold tracking-wide px-3 py-[11px] no-underline hover:bg-[#2e9e5b] cm-transition">{{ $menu->label }}</a>
                        </li>
                    @endif

                    {{-- Sisipkan Organisasi Otonom tepat 1 kali jika belum ada di nav_menus DB --}}
                    @if(!$hasOrtomNav && $navOrtoms->isNotEmpty() && (($hasPrmNav && $menu->label === 'PRM') || (!$hasPrmNav && $loop->last)))
                        <li class="cm-nav-item relative">
                            <button class="flex items-center gap-1 uppercase text-white text-[13px] font-semibold tracking-wide px-3 py-[11px] bg-transparent border-0 cursor-pointer hover:bg-[#2e9e5b] cm-transition">
                                Organisasi Otonom
                                <i data-lucide="chevron-down" class="w-3 h-3 opacity-80"></i>
                            </button>
                            <ul class="cm-submenu absolute left-0 top-full z-50 min-w-[220px] list-none m-0 p-1 bg-[#232323] shadow-lg">
                                @foreach($navOrtoms as $ortom)
                                    <li>
                                        <a href="{{ route('organisasi-otonom.show', $ortom->slug) }}"
                                            class="block px-3 py-2 text-[13px] normal-case font-normal text-[#dddddd] no-underline hover:bg-[#2e9e5b] hover:text-white cm-transition">
                                            {{ $ortom->nama }} {{ $ortom->singkatan ? '('.$ortom->singkatan.')' : '' }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>

            {{-- Hamburger mobile --}}
            <button @click="mobileOpen = !mobileOpen" aria-label="Buka menu"
                class="lg:hidden flex items-center gap-2 text-white text-[13px] font-semibold uppercase px-3 py-[11px] cursor-pointer bg-transparent border-0">
                <i data-lucide="menu" class="w-4 h-4"></i> Menu
            </button>

            {{-- Search toggle --}}
            <button @click="searchOpen = !searchOpen" aria-label="Pencarian"
                class="flex items-center text-white px-3 py-[11px] cursor-pointer bg-transparent border-0 hover:bg-[#2e9e5b] cm-transition">
                <i data-lucide="search" class="w-4 h-4"></i>
            </button>
        </div>

        {{-- Search overlay --}}
        <div x-show="searchOpen" x-collapse style="display:none;" class="bg-[#2b2b2b] border-t border-black/20">
            <form action="https://www.google.com/search" method="get" target="_blank" class="cm-inner flex gap-2 py-4">
                <input type="hidden" name="sitesearch" value="{{ request()->getHost() }}">
                <input type="text" name="q" placeholder="Cari di situs ini..."
                    class="flex-1 px-3 py-2 text-[14px] text-[#333333] bg-white border border-[#cccccc] rounded-none focus:outline-none focus:border-[#2e9e5b]"/>
                <button type="submit" class="bg-[#2e9e5b] hover:bg-[#268a4f] text-white px-5 text-[13px] font-semibold uppercase cursor-pointer border-0 rounded-[3px] cm-transition">Cari</button>
            </form>
        </div>

        {{-- Mobile menu --}}
        <div x-show="mobileOpen" x-collapse style="display:none;" class="lg:hidden bg-white border-t border-[#eaeaea]">
            <ul class="list-none m-0 p-2">
                @foreach($navMenus as $menu)
                    @if(Str::contains(strtolower($menu->label), 'otonom') && $navOrtoms->isNotEmpty())
                        <li x-data="{ sub: false }">
                            <button @click="sub = !sub"
                                class="w-full flex items-center justify-between px-3 py-2.5 text-left text-[14px] text-[#333333] bg-transparent border-0 cursor-pointer hover:text-[#2e9e5b]">
                                {{ $menu->label }}
                                <i data-lucide="chevron-down" class="w-4 h-4 text-[#888888]"></i>
                            </button>
                            <ul x-show="sub" x-collapse style="display:none;" class="list-none m-0 pl-4 pb-1">
                                @foreach($navOrtoms as $ortom)
                                    <li>
                                        <a href="{{ route('organisasi-otonom.show', $ortom->slug) }}"
                                            class="block px-3 py-2 text-[13px] text-[#555555] no-underline hover:text-[#2e9e5b]">
                                            {{ $ortom->nama }} {{ $ortom->singkatan ? '('.$ortom->singkatan.')' : '' }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @elseif($menu->children->isNotEmpty())
                        <li x-data="{ sub: false }">
                            <button @click="sub = !sub"
                                class="w-full flex items-center justify-between px-3 py-2.5 text-left text-[14px] text-[#333333] bg-transparent border-0 cursor-pointer hover:text-[#2e9e5b]">
                                {{ $menu->label }}
                                <i data-lucide="chevron-down" class="w-4 h-4 text-[#888888]"></i>
                            </button>
                            <ul x-show="sub" x-collapse style="display:none;" class="list-none m-0 pl-4 pb-1">
                                @if(Str::contains(strtolower($menu->label), 'amal usaha') && !$menu->children->contains('url', '/amal-usaha'))
                                    <li><a href="{{ route('amal-usaha.index') }}"
                                        class="block px-3 py-2 text-[13px] text-[#555555] no-underline hover:text-[#2e9e5b]">Semua Amal Usaha</a></li>
                                @endif
                                @foreach($menu->children as $child)
                                    <li><a href="{{ $child->url }}" {{ $child->open_new_tab ? 'target="_blank" rel="noopener"' : '' }}
                                        class="block px-3 py-2 text-[13px] text-[#555555] no-underline hover:text-[#2e9e5b]">{{ $child->label }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @elseif($menu->url)
                        <li><a href="{{ $menu->url }}" {{ $menu->open_new_tab ? 'target="_blank" rel="noopener"' : '' }}
                            class="block px-3 py-2.5 text-[14px] text-[#333333] no-underline hover:text-[#2e9e5b]">{{ $menu->label }}</a></li>
                    @endif

                    @if(!$hasOrtomNav && $navOrtoms->isNotEmpty() && (($hasPrmNav && $menu->label === 'PRM') || (!$hasPrmNav && $loop->last)))
                        <li x-data="{ sub: false }">
                            <button @click="sub = !sub"
                                class="w-full flex items-center justify-between px-3 py-2.5 text-left text-[14px] text-[#333333] bg-transparent border-0 cursor-pointer hover:text-[#2e9e5b]">
                                Organisasi Otonom
                                <i data-lucide="chevron-down" class="w-4 h-4 text-[#888888]"></i>
                            </button>
                            <ul x-show="sub" x-collapse style="display:none;" class="list-none m-0 pl-4 pb-1">
                                @foreach($navOrtoms as $ortom)
                                    <li>
                                        <a href="{{ route('organisasi-otonom.show', $ortom->slug) }}"
                                            class="block px-3 py-2 text-[13px] text-[#555555] no-underline hover:text-[#2e9e5b]">
                                            {{ $ortom->nama }} {{ $ortom->singkatan ? '('.$ortom->singkatan.')' : '' }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
                @auth
                    <li class="mt-1 px-3 pb-2">
                        <a href="{{ $dashboardRoute ?? route('login') }}"
                            class="block text-center bg-[#2e9e5b] hover:bg-[#268a4f] text-white text-[14px] font-semibold py-2 rounded-[3px] no-underline cm-transition">Dashboard</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
</header>

{{-- ═══════ MAIN WRAPPER ═══════ --}}
<div class="cm-page shadow-sm my-[10px]">
    <main class="py-[30px]">
        @yield('content')
    </main>
</div>

{{-- ═══════ FOOTER ═══════ --}}
<footer class="bg-[#303440] border-t border-white/5">
    <div class="cm-inner pt-[45px] pb-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-[39.5%_1fr_1fr_1fr] gap-8">

        {{-- Main widget --}}
        <div>
            <h4 class="cm-widget-title !text-white"><span>Tentang Kami</span></h4>
            <div class="flex items-center gap-3 mb-4">
                <img src="{{ asset('images/logo.png') }}"
                    class="h-11 w-11 object-contain bg-white rounded-full p-0.5" alt="Logo PCM Duren Sawit 1"/>
                <div>
                    <p class="text-white text-[15px] font-bold m-0">PCM Duren Sawit 1</p>
                    <p class="text-[#aaaaaa] text-[12px] m-0">Muhammadiyah Berkemajuan</p>
                </div>
            </div>
            <p class="text-[#aaaaaa] text-[14px] leading-relaxed m-0">
                Mencerahkan Semesta, Memajukan Duren Sawit. Portal resmi Pimpinan Cabang Muhammadiyah Duren Sawit 1.
            </p>
        </div>

        {{-- Tautan --}}
        <div>
            <h4 class="cm-widget-title"><span class="!text-white">Tautan Cepat</span></h4>
            <ul class="list-none m-0 p-0">
                <li class="border-b border-white/10"><a href="{{ route('profil') }}" class="block py-[7px] text-[13px] text-white no-underline hover:text-[#2e9e5b] cm-transition">Profil PCM</a></li>
                <li class="border-b border-white/10"><a href="{{ route('struktur-organisasi') }}" class="block py-[7px] text-[13px] text-white no-underline hover:text-[#2e9e5b] cm-transition">Struktur Organisasi</a></li>
                <li class="border-b border-white/10"><a href="{{ route('berita.all') }}" class="block py-[7px] text-[13px] text-white no-underline hover:text-[#2e9e5b] cm-transition">Berita &amp; Informasi</a></li>
                <li class="border-b border-white/10"><a href="{{ route('articles.show-all') }}" class="block py-[7px] text-[13px] text-white no-underline hover:text-[#2e9e5b] cm-transition">Artikel &amp; Opini</a></li>
                <li class="border-b border-white/10"><a href="{{ route('amal-usaha.index') }}" class="block py-[7px] text-[13px] text-white no-underline hover:text-[#2e9e5b] cm-transition">Amal Usaha Muhammadiyah</a></li>
                <li class="border-b border-white/10"><a href="{{ route('amal-usaha.by-kategori', 'bidang-kesehatan') }}" class="block py-[7px] text-[13px] text-white no-underline hover:text-[#2e9e5b] cm-transition">Amal Usaha Kesehatan</a></li>
                <li class="border-b border-white/10"><a href="{{ route('kontak') }}" class="block py-[7px] text-[13px] text-white no-underline hover:text-[#2e9e5b] cm-transition">Hubungi Kami</a></li>
            </ul>
        </div>

        {{-- Organisasi otonom --}}
        <div>
            <h4 class="cm-widget-title"><span class="!text-white">Organisasi Otonom</span></h4>
            @php
                $cmOrgs = \App\Models\Organisasi::where('is_active', true)->orderBy('tipe')->orderBy('nama')->limit(5)->get();
            @endphp
            <ul class="list-none m-0 p-0">
                @forelse($cmOrgs as $org)
                    <li class="border-b border-white/10">
                        <a href="{{ route('organisasi-otonom.show', $org->slug) }}"
                            class="block py-[7px] text-[13px] text-white no-underline hover:text-[#2e9e5b] cm-transition">{{ $org->nama }}</a>
                    </li>
                @empty
                    <li class="py-[7px] text-[13px] text-[#aaaaaa]">Belum ada data organisasi.</li>
                @endforelse
            </ul>
        </div>

        {{-- Kontak --}}
        <div>
            <h4 class="cm-widget-title"><span class="!text-white">Hubungi Kami</span></h4>
            <ul class="list-none m-0 p-0 space-y-3">
                <li class="flex gap-2.5 items-start">
                    <i data-lucide="map-pin" class="w-4 h-4 text-[#2e9e5b] shrink-0 mt-0.5"></i>
                    <span class="text-[#aaaaaa] text-[13px] leading-relaxed">{{ $cmAddress }}</span>
                </li>
                <li class="flex gap-2.5 items-center">
                    <i data-lucide="phone" class="w-4 h-4 text-[#2e9e5b] shrink-0"></i>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $cmPhone) }}" class="text-[#aaaaaa] text-[13px] no-underline hover:text-[#2e9e5b] cm-transition">{{ $cmPhone }}</a>
                </li>
                <li class="flex gap-2.5 items-center">
                    <i data-lucide="mail" class="w-4 h-4 text-[#2e9e5b] shrink-0"></i>
                    <a href="mailto:{{ $cmEmail }}" class="text-[#aaaaaa] text-[13px] no-underline hover:text-[#2e9e5b] cm-transition">{{ $cmEmail }}</a>
                </li>
            </ul>
        </div>
    </div>

    {{-- Socket bar --}}
    <div class="bg-[#252730] py-5">
        <div class="cm-inner flex flex-col md:flex-row items-center justify-between gap-2">
            <p class="text-[#b1b6b6] text-[13px] m-0">Copyright &copy; {{ date('Y') }} <a href="/" class="text-[#b1b6b6] underline hover:text-[#2e9e5b] cm-transition">PCM Duren Sawit 1</a>. All rights reserved.</p>
            <p class="text-[#8a8f96] text-[12px] m-0">Created by @bintang.ydha_ &amp; @ramtxh</p>
        </div>
    </div>
</footer>

{{-- Scroll to top --}}
<button onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Kembali ke atas"
    class="fixed bottom-5 right-5 z-40 w-10 h-10 bg-white border border-[#eaeaea] rounded-[3px] shadow-md cursor-pointer flex items-center justify-center opacity-50 hover:opacity-100 cm-transition">
    <i data-lucide="chevron-up" class="w-5 h-5 text-[#2e9e5b]"></i>
</button>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (window.lucide) lucide.createIcons();
    });
</script>
@stack('scripts')
@yield('scripts')
</body>
</html>
