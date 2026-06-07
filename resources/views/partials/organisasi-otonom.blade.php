{{-- ═══════════════════════════════════════════════════════════════
     ORGANISASI OTONOM — Cream theme, fully styled with Tailwind CSS
     ═══════════════════════════════════════════════════════════════ --}}

<section class="bg-cream py-20 px-4 relative overflow-hidden">
    {{-- Subtle pattern --}}
    <div class="islamic-pattern absolute inset-0 opacity-[0.35] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10">

        {{-- Section Label --}}
        <span class="section-label section-label-green">☪ Struktur Kepengurusan {{ $periode ?? '2022–2027' }}</span>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-end mt-2">
            <div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight text-gray-900">
                    Organisasi<br>
                    <span class="text-primary">Otonom</span><br>
                    <span class="text-gray-500">Muhammadiyah</span>
                </h2>
            </div>
            <div class="flex flex-col gap-4">
                <p class="text-sm text-gray-600 leading-relaxed">
                    Lembaga yang menjalankan sebagian tugas pokok Muhammadiyah di bidang
                    tertentu, bergerak secara mandiri namun tetap dalam naungan organisasi.
                </p>
                <div class="flex gap-6 items-center">
                    <div>
                        <div class="text-2xl font-bold text-primary">{{ $organisasis->count() }}</div>
                        <div class="text-[10px] text-gray-400 mt-0.5 uppercase tracking-wider">Organisasi</div>
                    </div>
                    <div class="w-px h-8 bg-primary/15"></div>
                    <div>
                        <div class="text-2xl font-bold text-primary">{{ $totalAnggota ?? '—' }}</div>
                        <div class="text-[10px] text-gray-400 mt-0.5 uppercase tracking-wider">Anggota</div>
                    </div>
                    <div class="w-px h-8 bg-primary/15"></div>
                    <div>
                        <div class="text-2xl font-bold text-secondary">{{ date('Y') }}</div>
                        <div class="text-[10px] text-gray-400 mt-0.5 uppercase tracking-wider">Tahun Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── TABS + GRID ── --}}
<div x-data="{ active: 'all', activeFilter: 'all', selected: null }" class="bg-cream">

    {{-- Filter Tabs --}}
    <div class="flex border-b border-primary/10 px-4 max-w-7xl mx-auto overflow-x-auto">
        @foreach ([['all', 'Semua'], ['ortonom', 'Ortonom'], ['lembaga', 'Lembaga'], ['majelis', 'Majelis']] as [$val, $label])
            <button
                @click="active = '{{ $val }}'; activeFilter = '{{ $val }}'; selected = null"
                :class="active === '{{ $val }}'
                    ? 'border-b-2 border-primary text-primary font-bold'
                    : 'border-b-2 border-transparent text-gray-400'"
                class="text-[11px] uppercase tracking-wider py-3.5 px-5 bg-transparent border-x-0 border-t-0 cursor-pointer transition duration-150 whitespace-nowrap">
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- Org Grid --}}
    <div class="py-6 px-4 max-w-7xl mx-auto">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 border border-primary/10 rounded-2xl overflow-hidden bg-white">

            @foreach ($organisasis as $org)
                <div
                    x-show="activeFilter === 'all' || activeFilter === '{{ $org->tipe }}'"
                    x-transition:enter="transition-opacity duration-200"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    @click="selected = selected === {{ $org->id }} ? null : {{ $org->id }}"
                    class="p-5 bg-white border-r border-b border-primary/5 cursor-pointer transition duration-200 hover:bg-primary/5">
                    <div class="w-10 h-10 rounded-xl bg-primary/5 border border-primary/10 flex items-center justify-center mb-3 overflow-hidden">
                        @if ($org->logo)
                            <img src="{{ asset('storage/' . $org->logo) }}" alt="{{ $org->nama }}"
                                class="w-full h-full object-contain">
                        @else
                            <span class="text-[11px] font-bold text-primary">{{ $org->singkatan }}</span>
                        @endif
                    </div>
                    <div class="text-sm font-semibold text-gray-900 mb-1 leading-snug">{{ $org->nama }}</div>
                    <div class="text-[11px] text-primary/70 mb-2.5 capitalize">{{ ucfirst($org->tipe) }}</div>
                    <div class="text-[10px] uppercase tracking-wider text-gray-300">Lihat →</div>
                </div>
            @endforeach

        </div>

        {{-- Detail Panel --}}
        @foreach ($organisasis as $org)
            <div
                x-show="selected === {{ $org->id }}"
                x-transition:enter="transition-all duration-200"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="mt-4 border border-primary/10 rounded-2xl overflow-hidden bg-white shadow-sm">

                {{-- Panel Header --}}
                <div class="flex justify-between items-center p-5 border-b border-primary/10">
                    <div>
                        <p class="flex items-center gap-2 text-[10px] uppercase tracking-wider text-gray-400 mb-1.5">
                            <span class="w-4 h-px bg-gray-300 inline-block"></span>
                            {{ ucfirst($org->tipe) }}
                        </p>
                        <h2 class="text-lg font-bold text-gray-900 m-0">{{ $org->nama }}</h2>
                    </div>
                    <button @click="selected = null"
                        class="text-[10px] uppercase tracking-wider py-1.5 px-3.5 border border-primary/15 rounded-full text-gray-400 bg-transparent cursor-pointer transition duration-150 hover:bg-primary/5 hover:text-primary">
                        Tutup
                    </button>
                </div>

                {{-- Pengurus Inti --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 border-b border-primary/5">
                    @foreach ([['Ketua', $org->ketua], ['Sekretaris', $org->sekretaris], ['Bendahara', $org->bendahara]] as [$jabatan, $nama])
                        <div class="p-5 border-r border-primary/5 last:border-r-0">
                            <div class="text-[10px] uppercase tracking-wider text-gray-400 mb-1.5">{{ $jabatan }}</div>
                            <div class="text-sm font-semibold text-gray-900">{{ $nama ?? '—' }}</div>
                            <div class="text-[11px] text-gray-400 mt-1">Periode {{ $org->periode_mulai }}–{{ $org->periode_selesai }}</div>
                        </div>
                    @endforeach
                </div>

                {{-- Sub Units --}}
                @if ($org->sub_units && $org->sub_units->count())
                    <div class="p-5 border-b border-primary/5">
                        <div class="text-[10px] uppercase tracking-wider text-gray-400 mb-2.5">Unit di Bawah</div>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($org->sub_units as $sub)
                                <span class="text-[11px] py-1 px-3 border border-primary/10 rounded-full text-gray-600 bg-gray-50">{{ $sub->nama }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Actions --}}
                <div class="p-5 bg-primary/5 flex flex-wrap gap-2">
                    <a href="{{ route('organisasi-otonom.show', $org->slug) }}"
                        class="text-[11px] uppercase tracking-wider py-2 px-4 border border-primary/15 rounded-full bg-primary text-white font-semibold transition duration-200 hover:bg-primary-light no-underline">
                        Halaman lengkap →
                    </a>
                    <a href="{{ route('anggota-organisasi.show', $org->slug) }}"
                        class="text-[11px] uppercase tracking-wider py-2 px-4 border border-primary/15 rounded-full text-gray-600 transition duration-150 hover:bg-primary/5 hover:text-primary no-underline">
                        Daftar anggota
                    </a>
                </div>

            </div>
        @endforeach

    </div>

</div>
