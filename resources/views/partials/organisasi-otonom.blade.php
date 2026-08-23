<section class="bg-cream py-24 relative">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-end mb-10">
            <div>
                <span class="section-label section-label-dark">Lembaga &amp; Organisasi</span>
                <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl leading-[1.15] text-gray-900">
                    Organisasi Otonom
                </h2>
            </div>
            <div class="flex flex-col gap-4">
                <p class="text-sm text-gray-500 leading-relaxed">
                    Lembaga yang menjalankan sebagian tugas pokok Muhammadiyah di bidang
                    tertentu, bergerak secara mandiri namun tetap dalam naungan organisasi.
                </p>
                <div class="flex gap-6 items-center">
                    <div>
                        <div class="text-2xl font-bold text-primary">{{ $organisasis->count() }}</div>
                        <div class="text-[10px] text-gray-400 mt-0.5 uppercase tracking-wider">Organisasi</div>
                    </div>
                    <div class="w-px h-8 bg-gray-200"></div>
                    <div>
                        <div class="text-2xl font-bold text-primary">{{ $totalAnggota ?? '—' }}</div>
                        <div class="text-[10px] text-gray-400 mt-0.5 uppercase tracking-wider">Anggota</div>
                    </div>
                    <div class="w-px h-8 bg-gray-200"></div>
                    <div>
                        <div class="text-2xl font-bold text-secondary">{{ date('Y') }}</div>
                        <div class="text-[10px] text-gray-400 mt-0.5 uppercase tracking-wider">Tahun Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- TABS + GRID --}}
<div x-data="{ active: 'all', activeFilter: 'all', selected: null }" class="bg-cream">

    <div class="flex border-b border-gray-200 px-6 max-w-7xl mx-auto overflow-x-auto">
        @foreach ([['all', 'Semua'], ['ortonom', 'Ortonom'], ['lembaga', 'Lembaga'], ['majelis', 'Majelis']] as [$val, $label])
            <button @click="active = '{{ $val }}'; activeFilter = '{{ $val }}'; selected = null" :class="active === '{{ $val }}'
                        ? 'border-b-2 border-primary text-primary font-bold'
                        : 'border-b-2 border-transparent text-gray-400'"
                class="text-[11px] uppercase tracking-wider py-3.5 px-5 bg-transparent border-x-0 border-t-0 cursor-pointer transition duration-150 whitespace-nowrap hover:text-gray-600">
                {{ $label }}
            </button>
        @endforeach
    </div>

    <div class="py-8 px-6 max-w-7xl mx-auto">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 border border-gray-200 rounded-xl overflow-hidden bg-white">

            @foreach ($organisasis as $org)
                <div x-show="activeFilter === 'all' || activeFilter === '{{ $org->tipe }}'"
                    x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    @click="selected = selected === {{ $org->id }} ? null : {{ $org->id }}"
                    class="p-5 bg-white border-r border-b border-gray-100 cursor-pointer transition duration-200 hover:bg-primary/5">
                    <div class="w-10 h-10 rounded-lg bg-primary/5 border border-primary/10 flex items-center justify-center mb-3 overflow-hidden">
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
            <div x-show="selected === {{ $org->id }}" x-transition:enter="transition-all duration-200"
                x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                class="mt-4 border border-gray-200 rounded-xl overflow-hidden bg-white">

                <div class="flex justify-between items-center p-5 border-b border-gray-100">
                    <div>
                        <p class="flex items-center gap-2 text-[10px] uppercase tracking-wider text-gray-400 mb-1.5">
                            <span class="w-4 h-px bg-gray-300 inline-block"></span>
                            {{ ucfirst($org->tipe) }}
                        </p>
                        <h2 class="text-lg font-bold text-gray-900 m-0">{{ $org->nama }}</h2>
                    </div>
                    <button @click="selected = null"
                        class="text-[10px] uppercase tracking-wider py-1.5 px-3.5 border border-gray-200 rounded-lg text-gray-400 bg-transparent cursor-pointer transition duration-150 hover:bg-gray-50 hover:text-gray-600">
                        Tutup
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 border-b border-gray-100">
                    @foreach ([['Ketua', $org->ketua], ['Sekretaris', $org->sekretaris], ['Bendahara', $org->bendahara]] as [$jabatan, $nama])
                        <div class="p-5 border-r border-gray-100 last:border-r-0">
                            <div class="text-[10px] uppercase tracking-wider text-gray-400 mb-1.5">{{ $jabatan }}</div>
                            <div class="text-sm font-semibold text-gray-900">{{ $nama ?? '—' }}</div>
                            <div class="text-[11px] text-gray-400 mt-1">Periode
                                {{ $org->periode_mulai }}–{{ $org->periode_selesai }}</div>
                        </div>
                    @endforeach
                </div>

                @if ($org->sub_units && $org->sub_units->count())
                    <div class="p-5 border-b border-gray-100">
                        <div class="text-[10px] uppercase tracking-wider text-gray-400 mb-2.5">Unit di Bawah</div>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($org->sub_units as $sub)
                                <span class="text-[11px] py-1 px-3 border border-gray-200 rounded-lg text-gray-600 bg-gray-50">{{ $sub->nama }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="p-5 bg-gray-50 flex flex-wrap gap-2">
                    <a href="{{ route('organisasi-otonom.show', $org->slug) }}"
                        class="text-[11px] uppercase tracking-wider py-2 px-4 rounded-lg bg-primary text-white font-semibold transition duration-200 hover:bg-primary-light no-underline">
                        Halaman lengkap →
                    </a>
                    <a href="{{ route('anggota-organisasi.show', $org->slug) }}"
                        class="text-[11px] uppercase tracking-wider py-2 px-4 border border-gray-200 rounded-lg text-gray-600 transition duration-150 hover:bg-gray-100 hover:text-gray-900 no-underline">
                        Daftar anggota
                    </a>
                </div>

            </div>
        @endforeach

    </div>

</div>
