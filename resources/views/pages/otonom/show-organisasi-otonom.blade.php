{{-- resources/views/pages/otonom/show-organisasi-otonom-detail.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $org->nama }} — Muhammadiyah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;1,400&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        * {
            -webkit-font-smoothing: antialiased;
        }

        body {
            font-family: 'DM Sans', sans-serif;
        }

        .font-serif {
            font-family: 'Playfair Display', Georgia, serif;
        }

        .fade-up {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 0.55s cubic-bezier(.22, .68, 0, 1.2) forwards;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .delay-1 {
            animation-delay: 0.05s;
        }

        .delay-2 {
            animation-delay: 0.12s;
        }

        .delay-3 {
            animation-delay: 0.20s;
        }

        .delay-4 {
            animation-delay: 0.28s;
        }

        .delay-5 {
            animation-delay: 0.36s;
        }

        .delay-6 {
            animation-delay: 0.44s;
        }

        .pengurus-card:hover .pengurus-arrow {
            transform: translateX(4px);
        }

        .pengurus-arrow {
            transition: transform 0.2s ease;
        }

        .nav-link::after {
            content: '';
            display: block;
            height: 1px;
            width: 0;
            background: #111;
            transition: width 0.2s ease;
            margin-top: 1px;
        }

        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>

<body class="bg-white text-gray-900 min-h-screen">

    @include('layouts.navigation')

    <main class="pt-14">

        <header class="max-w-6xl mx-auto px-6 pt-16 pb-12 border-b border-gray-100">
            <div class="fade-up">
                <p class="flex items-center gap-2 text-[10px] uppercase tracking-[.14em] text-gray-400 mb-6">
                    <span class="inline-block w-5 h-px bg-gray-300"></span>
                    {{ ucfirst($org->tipe) }} · Periode {{ $org->periode_mulai }}–{{ $org->periode_selesai }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-[1fr_auto] gap-8 items-end">
                <div class="fade-up delay-1">
                    <div class="flex items-start gap-5 mb-6 flex-col">
                        <div
                            class="w-14 h-14 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center overflow-hidden flex-shrink-0 mt-1">
                            @if ($org->logo)
                                <img src="{{ asset('storage/' . $org->logo) }}" alt="{{ $org->nama }}"
                                    class="w-full h-full object-contain">
                            @else
                                <span class="text-[13px] font-medium text-gray-500">{{ $org->singkatan }}</span>
                            @endif
                        </div>
                        <div>
                            <h1 class="font-serif text-[38px] lg:text-[52px] leading-[1.1] font-normal tracking-tight">
                                {{ $org->nama }}
                            </h1>
                        </div>
                    </div>

                    @if ($org->deskripsi)
                        <p class="text-[15px] text-gray-500 leading-relaxed max-w-xl">
                            {{ $org->deskripsi }}
                        </p>
                    @endif
                </div>

                {{-- Stats --}}
                <div class="fade-up delay-2 flex gap-8 lg:flex-col lg:gap-5 lg:text-right pb-1">
                    <div>
                        <div class="text-[28px] font-medium leading-none">{{ $pengurusInti->count() }}</div>
                        <div class="text-[11px] text-gray-400 mt-1 uppercase tracking-[.06em]">Pengurus Inti</div>
                    </div>
                    <div class="w-px bg-gray-100 lg:hidden"></div>
                    <div>
                        <div class="text-[28px] font-medium leading-none">{{ $totalPengurus }}</div>
                        <div class="text-[11px] text-gray-400 mt-1 uppercase tracking-[.06em]">Total Anggota</div>
                    </div>
                </div>
            </div>
        </header>

        {{-- ─── PENGURUS INTI ────────────────────────── --}}
        <section class="max-w-6xl mx-auto px-6 py-12 border-b border-gray-100">
            <div class="fade-up delay-2">
                <p class="text-[10px] uppercase tracking-[.14em] text-gray-400 mb-8 flex items-center gap-2">
                    <span class="w-4 h-px bg-gray-300 inline-block"></span>
                    Pimpinan Organisasi
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-px bg-gray-100 rounded-xl overflow-hidden fade-up delay-3">
                @foreach ([['Ketua', $org->ketua, 'Pimpinan utama organisasi'], ['Sekretaris', $org->sekretaris, 'Pengelola administrasi'], ['Bendahara', $org->bendahara, 'Pengelola keuangan']] as [$jabatan, $nama, $desc])
                    <div class="bg-white px-7 py-7">
                        <div class="text-[10px] uppercase tracking-[.10em] text-gray-400 mb-5">{{ $jabatan }}
                        </div>
                        <div class="text-[17px] font-medium leading-snug mb-1">{{ $nama ?? '—' }}</div>
                        <div class="text-[11px] text-gray-400">{{ $desc }}</div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ─── SEMUA PENGURUS ──────────────────────── --}}
        @if ($allPengurus->count())
            <section class="max-w-6xl mx-auto px-6 py-12 border-b border-gray-100">
                <div class="fade-up delay-3">
                    <div class="flex items-end justify-between mb-8">
                        <p class="text-[10px] uppercase tracking-[.14em] text-gray-400 flex items-center gap-2">
                            <span class="w-4 h-px bg-gray-300 inline-block"></span>
                            Seluruh Pengurus
                        </p>
                        <span class="text-[11px] text-gray-400">{{ $allPengurus->count() }} orang</span>
                    </div>
                </div>

                {{-- Group by level/bidang --}}
                @php
                    $grouped = $allPengurus->groupBy('bidang');
                    $grouped = $grouped->sortKeys();
                @endphp

                <div class="space-y-10 fade-up delay-4">
                    @foreach ($grouped as $bidang => $members)
                        <div>
                            @if ($bidang && $bidang !== '—')
                                <div
                                    class="text-[10px] uppercase tracking-[.12em] text-gray-400 mb-4 pb-3 border-b border-gray-100">
                                    {{ $bidang }}
                                </div>
                            @endif

                            <div
                                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-px bg-gray-100 rounded-xl overflow-hidden">
                                @foreach ($members->sortBy('urutan') as $p)
                                    <div class="pengurus-card bg-white px-5 py-5 group">
                                        <div class="flex items-start gap-3">
                                            {{-- Avatar --}}
                                            <div
                                                class="w-10 h-10 rounded-full bg-gray-100 overflow-hidden flex-shrink-0">
                                                @if ($p->foto)
                                                    <img src="{{ asset('storage/' . $p->foto) }}"
                                                        alt="{{ $p->nama }}" class="w-full h-full object-cover">
                                                @else
                                                    <div
                                                        class="w-full h-full flex items-center justify-center text-[11px] font-medium text-gray-400">
                                                        {{ strtoupper(substr($p->nama, 0, 2)) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div class="text-[13px] font-medium leading-snug truncate">
                                                    {{ $p->nama }}</div>
                                                <div class="text-[11px] text-gray-400 mt-0.5">{{ $p->jabatan }}</div>
                                                @if ($p->no_hp)
                                                    <div class="text-[10px] text-gray-300 mt-1.5 font-mono">
                                                        {{ $p->no_hp }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- ─── INFORMASI TAMBAHAN ──────────────────── --}}
        <section class="max-w-6xl mx-auto px-6 py-12">
            <div class="fade-up delay-5">
                <p class="text-[10px] uppercase tracking-[.14em] text-gray-400 mb-8 flex items-center gap-2">
                    <span class="w-4 h-px bg-gray-300 inline-block"></span>
                    Informasi Organisasi
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-px bg-gray-100 rounded-xl overflow-hidden fade-up delay-5">
                <div class="bg-white px-6 py-6">
                    <div class="text-[10px] uppercase tracking-[.08em] text-gray-400 mb-3">Singkatan</div>
                    <div class="text-[22px] font-medium">{{ $org->singkatan }}</div>
                </div>
                <div class="bg-white px-6 py-6">
                    <div class="text-[10px] uppercase tracking-[.08em] text-gray-400 mb-3">Tipe</div>
                    <div class="text-[15px] font-medium capitalize">{{ $org->tipe }}</div>
                </div>
                <div class="bg-white px-6 py-6">
                    <div class="text-[10px] uppercase tracking-[.08em] text-gray-400 mb-3">Periode Aktif</div>
                    <div class="text-[15px] font-medium">{{ $org->periode_mulai }}–{{ $org->periode_selesai }}</div>
                </div>
                <div class="bg-white px-6 py-6">
                    <div class="text-[10px] uppercase tracking-[.08em] text-gray-400 mb-3">Status</div>
                    <div class="flex items-center gap-2 mt-1">
                        <span
                            class="w-1.5 h-1.5 rounded-full {{ $org->is_active ? 'bg-emerald-400' : 'bg-gray-300' }}"></span>
                        <span class="text-[13px]">{{ $org->is_active ? 'Aktif' : 'Tidak Aktif' }}</span>
                    </div>
                </div>
            </div>

            {{-- Bottom CTA --}}
            <div class="fade-up delay-6 mt-10 flex items-center justify-between pt-8 border-t border-gray-100">
                <a href="{{ route('home') }}"
                    class="text-[11px] uppercase tracking-[.08em] text-gray-400 hover:text-gray-900 transition-colors nav-link">
                    ← Kembali ke daftar
                </a>
                <a href="{{ route('anggota-organisasi.show', $org->slug) }}"
                    class="text-[11px] uppercase tracking-[.08em] px-5 py-2.5 border border-gray-200 rounded-full text-gray-700 hover:bg-gray-50 transition-colors">
                    Lihat semua anggota →
                </a>
            </div>
        </section>

    </main>

    @include('layouts.footer')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>

</html>
