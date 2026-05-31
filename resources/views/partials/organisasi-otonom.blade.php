<section class="border-b border-gray-100 px-4 md:px-8 pt-10 md:pt-14 pb-8 md:pb-10 max-w-7xl mx-auto">
    <p class="flex items-center gap-2 text-[10px] uppercase tracking-[.12em] text-gray-400 mb-4">
        <span class="inline-block w-4 h-px bg-gray-400"></span>
        Struktur Kepengurusan {{ $periode ?? '2022–2027' }}
    </p>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-end">
        <div>
            <h1 class="font-serif text-[28px] md:text-[40px] leading-[1.18] tracking-tight font-normal">
                Organisasi<br>
                <em class="text-gray-400 not-italic">Otonom</em><br>
                Muhammadiyah
            </h1>
        </div>
        <div class="flex flex-col gap-4">
            <p class="text-sm text-gray-500 leading-relaxed">
                Lembaga yang menjalankan sebagian tugas pokok Muhammadiyah di bidang
                tertentu, bergerak secara mandiri namun tetap dalam naungan organisasi.
            </p>
            <div class="flex gap-4 md:gap-6 items-center">
                <div>
                    <div class="text-2xl font-medium">{{ $organisasis->count() }}</div>
                    <div class="text-[11px] text-gray-400 mt-0.5">Organisasi</div>
                </div>
                <div class="w-px h-8 bg-gray-200"></div>
                <div>
                    <div class="text-2xl font-medium">{{ $totalAnggota ?? '—' }}</div>
                    <div class="text-[11px] text-gray-400 mt-0.5">Anggota</div>
                </div>
                <div class="w-px h-8 bg-gray-200"></div>
                <div>
                    <div class="text-2xl font-medium">{{ date('Y') }}</div>
                    <div class="text-[11px] text-gray-400 mt-0.5">Tahun Aktif</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Wrapper Alpine tunggal untuk tabs + grid --}}
<div x-data="{ active: 'all', activeFilter: 'all', selected: null }">

    {{-- Filter Tabs --}}
    <div class="flex border-b border-gray-100 px-4 md:px-8 max-w-7xl mx-auto overflow-x-auto">
        @foreach ([['all', 'Semua'], ['otonom', 'Otonom'], ['lembaga', 'Lembaga'], ['majelis', 'Majelis']] as [$val, $label])
            <button
                @click="active = '{{ $val }}'; activeFilter = '{{ $val }}'; selected = null"
                :class="active === '{{ $val }}'
                    ? 'border-b-[1.5px] border-gray-900 text-gray-900 font-medium'
                    : 'border-b-[1.5px] border-transparent text-gray-400'"
                class="text-[11px] uppercase tracking-[.06em] px-5 py-4 bg-transparent transition-colors duration-150 shrink-0">
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- Org Grid --}}
    <div class="p-4 md:p-8 max-w-7xl mx-auto">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 border border-gray-100 rounded-xl overflow-hidden divide-x divide-y divide-gray-100">

            @foreach ($organisasis as $org)
                <div
                    x-show="activeFilter === 'all' || activeFilter === '{{ $org->tipe }}'"
                    x-transition:enter="transition-opacity duration-200"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    @click="selected = selected === {{ $org->id }} ? null : {{ $org->id }}"
                    class="p-4 md:p-6 bg-white hover:bg-gray-50 cursor-pointer transition-colors duration-150">
                    <div class="w-9 h-9 rounded-lg bg-gray-50 border border-gray-100 flex items-center justify-center mb-3 md:mb-4 overflow-hidden">
                        @if ($org->logo)
                            <img src="{{ asset('storage/' . $org->logo) }}" alt="{{ $org->nama }}"
                                class="w-full h-full object-contain">
                        @else
                            <span class="text-[10px] font-medium text-gray-500">{{ $org->singkatan }}</span>
                        @endif
                    </div>
                    <div class="text-[12px] md:text-[13px] font-medium mb-1 leading-snug">{{ $org->nama }}</div>
                    <div class="text-[11px] text-gray-400 mb-3 md:mb-4">{{ ucfirst($org->tipe) }}</div>
                    <div class="text-[10px] uppercase tracking-[.06em] text-gray-400">Lihat →</div>
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
                class="mt-4 border border-gray-100 rounded-xl overflow-hidden">

                {{-- Panel Header --}}
                <div class="flex justify-between items-center px-4 md:px-6 py-4 md:py-5 border-b border-gray-100">
                    <div>
                        <p class="flex items-center gap-2 text-[10px] uppercase tracking-[.12em] text-gray-400 mb-1.5">
                            <span class="w-4 h-px bg-gray-400 inline-block"></span>
                            {{ ucfirst($org->tipe) }}
                        </p>
                        <h2 class="font-serif text-[18px] md:text-[22px] font-normal">{{ $org->nama }}</h2>
                    </div>
                    <button @click="selected = null"
                        class="text-[11px] uppercase tracking-[.06em] px-3 md:px-4 py-2 border border-gray-200 rounded-full text-gray-500 hover:bg-gray-50 transition-colors shrink-0 ml-3">
                        Tutup
                    </button>
                </div>

                {{-- Pengurus Inti --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-gray-100">
                    @foreach ([['Ketua', $org->ketua], ['Sekretaris', $org->sekretaris], ['Bendahara', $org->bendahara]] as [$jabatan, $nama])
                        <div class="px-4 md:px-6 py-4 md:py-5">
                            <div class="text-[10px] uppercase tracking-[.08em] text-gray-400 mb-2">{{ $jabatan }}</div>
                            <div class="text-sm font-medium">{{ $nama ?? '—' }}</div>
                            <div class="text-[11px] text-gray-400 mt-0.5">Periode {{ $org->periode_mulai }}–{{ $org->periode_selesai }}</div>
                        </div>
                    @endforeach
                </div>

                {{-- Sub Units --}}
                @if ($org->sub_units && $org->sub_units->count())
                    <div class="px-4 md:px-6 py-4 md:py-5 border-t border-gray-100">
                        <div class="text-[10px] uppercase tracking-[.08em] text-gray-400 mb-3">Unit di Bawah</div>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($org->sub_units as $sub)
                                <span class="text-[11px] px-3 py-1 border border-gray-200 rounded-full text-gray-600">{{ $sub->nama }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Actions --}}
                <div class="px-4 md:px-6 py-4 bg-gray-50 border-t border-gray-100 flex flex-wrap gap-2 md:gap-3">
                    <a href="{{ route('organisasi-otonom.show', $org->slug) }}"
                        class="text-[11px] uppercase tracking-[.05em] px-4 py-2 border border-gray-200 rounded-full bg-white text-gray-900 hover:bg-gray-100 transition-colors">
                        Halaman lengkap →
                    </a>
                    <a href="{{ route('anggota-organisasi.show', $org->slug) }}"
                        class="text-[11px] uppercase tracking-[.05em] px-4 py-2 border border-gray-200 rounded-full text-gray-500 hover:bg-gray-50 transition-colors">
                        Daftar anggota
                    </a>
                </div>

            </div>
        @endforeach

    </div>

</div>
