@extends('layouts.frontend')

@section('title', $label . '- Amal Usaha PCM Duren Sawit 1')

@section('meta')
    <meta name="description" content="Daftar Amal Usaha Muhammadiyah PCM Duren Sawit 1 — {{ $label }}">
@endsection

@section('content')
    <div class="pt-[68px] bg-cream">
        <div class="max-w-7xl mx-auto px-6 md:px-8 pt-16 pb-10 relative overflow-hidden">

            <div class="relative z-10">
                <span class="inline-flex items-center gap-2 mb-3 fu fu-2">
                    <span class="text-[0.68rem] tracking-[0.16em] uppercase text-primary font-semibold">
                        Amal Usaha Muhammadiyah
                    </span>
                </span>
                <h1 class="serif text-4xl md:text-5xl text-accent font-semibold leading-tight fu fu-3">
                    {{ $label }}
                </h1>
                <p class="mt-3 text-sm text-gray-500 max-w-lg leading-relaxed fu fu-4">
                    Daftar unit amal usaha PCM Duren Sawit 1 dalam kategori <strong>{{ $label }}</strong>.
                </p>
            </div>

            {{-- Back button --}}
            <a href="/"
                class="inline-flex items-center gap-2 mt-8 px-5 py-2.5 text-sm font-medium text-white bg-primary hover:bg-primary/80 transition-all rounded-full shadow-sm no-underline fu fu-5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 12H5M12 5l-7 7 7 7" />
                </svg>
                Kembali ke Beranda
            </a>

            <div class="h-[1px] bg-gray-200 mt-10"></div>
        </div>
    </div>

    {{-- ══ TAB FILTER KATEGORI ══ --}}
    <div class="bg-cream sticky top-[64px] md:top-[80px] z-30 border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 md:px-8">
            <div class="flex items-center gap-2 overflow-x-auto scrollbar-none py-3">
                @foreach($allKategori as $kat)
                    <a href="{{ route('amal-usaha.by-kategori', $kat['slug']) }}"
                        class="flex-shrink-0 px-5 py-2 text-xs font-semibold uppercase tracking-wider border rounded-full transition-all duration-200 no-underline {{ $kategori === $kat['slug'] ? 'tab-aktif' : 'border-gray-300 text-gray-500 hover:border-primary hover:text-primary' }}">
                        {{ $kat['label'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ══ CONTENT ══ --}}
    <div class="bg-cream min-h-[60vh]">
        <div class="max-w-7xl mx-auto px-6 md:px-8 py-12">

            @if($amalUsahaList->isNotEmpty())
                {{-- Grid Cards --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($amalUsahaList as $i => $item)
                        <div
                            class="au-card bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm fu fu-{{ min($i + 1, 12) }}">

                            {{-- Image --}}
                            <div class="relative overflow-hidden aspect-[16/10]">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}"
                                        class="au-img w-full h-full object-cover" loading="lazy" />
                                @else
                                    <div class="no-img w-full h-full flex items-center justify-center">
                                        <svg class="w-14 h-14 text-primary/20" fill="none" stroke="currentColor" stroke-width="1.5"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 21h19.5M6.75 3h10.5A2.25 2.25 0 0119.5 5.25v15.75H4.5V5.25A2.25 2.25 0 016.75 3z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 22.5V12h6v10.5" />
                                        </svg>
                                    </div>
                                @endif

                                {{-- Tipe badge --}}
                                <span
                                    class="absolute top-3 left-3 px-3 py-1 text-[0.6rem] font-bold tracking-widest uppercase bg-primary text-white rounded-full shadow">
                                    {{ str_replace('_', ' ', $item->tipe) }}
                                </span>
                            </div>

                            {{-- Body --}}
                            <div class="p-5 flex flex-col gap-3">

                                {{-- Nama amal usaha --}}
                                <h2 class="serif text-lg font-semibold text-accent leading-snug">
                                    {{ $item->nama }}
                                </h2>

                                {{-- Organisasi induk --}}
                                @if($item->organisasiOtonom)
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-primary/60 flex-shrink-0" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15" />
                                        </svg>
                                        <span class="text-xs text-gray-500 line-clamp-1">
                                            {{ $item->organisasiOtonom->nama }}
                                        </span>
                                    </div>
                                @endif

                                {{-- Deskripsi --}}
                                @if($item->deskripsi)
                                    <p class="text-xs text-gray-500 leading-relaxed line-clamp-3">
                                        {{ $item->deskripsi }}
                                    </p>
                                @endif

                                {{-- Divider --}}
                                <div class="h-[1px] bg-gray-100 mt-auto"></div>

                                {{-- Footer --}}
                                <div class="flex items-center justify-between pt-1">
                                    <span class="text-[0.6rem] font-bold uppercase tracking-wider text-primary/60">
                                        PCM Duren Sawit 1
                                    </span>
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-primary">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Aktif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            @else
                {{-- Empty State --}}
                <div class="flex flex-col items-center justify-center py-24 text-center">
                    <div class="w-20 h-20 rounded-full bg-primary/5 flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-primary/30" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 21h19.5M6.75 3h10.5A2.25 2.25 0 0119.5 5.25v15.75H4.5V5.25A2.25 2.25 0 016.75 3z" />
                        </svg>
                    </div>
                    <p class="serif text-3xl text-gray-300 mb-3">— ✦ —</p>
                    <p class="text-sm text-gray-400 max-w-xs leading-relaxed">
                        Belum ada data amal usaha untuk kategori <strong>{{ $label }}</strong> saat ini.
                    </p>
                    <a href="/"
                        class="mt-6 inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-primary hover:bg-primary/80 transition rounded-full no-underline">
                        Kembali ke Beranda
                    </a>
                </div>
            @endif

        </div>
    </div>
@endsection

@section('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap');

        .serif {
            font-family: 'Playfair Display', serif;
        }

        /* Card hover lift */
        .au-card {
            transition: transform .3s cubic-bezier(.4, 0, .2, 1),
                box-shadow .3s cubic-bezier(.4, 0, .2, 1),
                border-color .3s ease;
        }

        .au-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -10px rgba(21, 94, 52, .15);
            border-color: rgba(21, 94, 52, .35);
        }

        /* Image zoom */
        .au-img {
            transition: transform 6s ease;
        }

        .au-card:hover .au-img {
            transform: scale(1.06);
        }

        /* Fade-up animation */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(22px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fu {
            animation: fadeUp .55s cubic-bezier(.4, 0, .2, 1) both;
        }

        @for ($i = 1; $i <= 12; $i++)
            .fu-{{ $i }} {
                animation-delay:
                    {{ ($i - 1) * 0.07 }}
                    s;
            }

        @endfor

        /* Tab active */
        .tab-aktif {
            background: #155e34;
            color: #fff !important;
            border-color: #155e34 !important;
        }

        /* No-image placeholder gradient */
        .no-img {
            background: linear-gradient(135deg, #e6f4ec 0%, #d0e9d8 100%);
        }

        /* Scrollbar hide */
        .scrollbar-none::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-none {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endsection