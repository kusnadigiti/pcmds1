@extends('layouts.frontend')

@section('title', ($organisasi->nama ?? 'Daftar Anggota') . ' — Muhammadiyah')

@section('content')
    {{-- ── HERO ── --}}
    <section
        class="bg-gradient-to-br from-accent via-accent-green to-primary text-white relative overflow-hidden py-16 md:py-24 flex items-center">
        {{-- Islamic geometric pattern --}}
        <div class="islamic-pattern absolute inset-0 opacity-50 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                {{-- Left content --}}
                <div class="lg:col-span-8 text-center lg:text-left animate-fadeUp">
                    {{-- Tagline / Pill --}}
                    @if (isset($organisasi))
                        <div
                            class="inline-flex items-center gap-2 bg-secondary/12 border border-secondary/40 text-secondary text-[11px] font-bold tracking-widest uppercase py-1 px-4 rounded-full mb-6">
                            @if ($organisasi->logo)
                                <img src="{{ asset('storage/' . $organisasi->logo) }}" alt="{{ $organisasi->nama }}"
                                    class="w-4 h-4 rounded-full object-contain bg-white/20">
                            @endif
                            <span>{{ $organisasi->singkatan ?? ucfirst($organisasi->tipe ?? '') }}</span>
                        </div>
                    @else
                            <i data-lucide="moon" class="w-3.5 h-3.5 mr-1 align-middle inline-block"></i> Muhammadiyah
                    @endif

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-6 tracking-tight">
                        @if (isset($organisasi))
                            {{ $organisasi->nama }}<br>
                            <span class="text-secondary font-normal italic font-serif">Daftar Anggota</span>
                        @else
                            Daftar <span class="text-secondary font-normal italic font-serif">Anggota</span> Pengurus
                        @endif
                    </h1>

                    <p class="text-white/70 text-base leading-relaxed max-w-xl mx-auto lg:mx-0">
                        @if (isset($organisasi))
                            Seluruh pengurus aktif periode {{ $organisasi->periode_mulai }}–{{ $organisasi->periode_selesai }}.
                        @else
                            Seluruh pengurus aktif dari setiap organisasi dalam naungan Muhammadiyah.
                        @endif
                    </p>
                </div>

                {{-- Right stats --}}
                <div class="lg:col-span-4 flex justify-center lg:justify-end">
                    <div
                        class="flex flex-col sm:flex-row lg:flex-col gap-6 lg:gap-8 bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-8 max-w-md w-full animate-fadeUp">
                        <div class="flex-1">
                            <div class="text-4xl sm:text-5xl font-extrabold text-secondary" id="stat-total">
                                {{ $penguruses->count() }}</div>
                            <div class="text-xs text-white/50 uppercase tracking-widest font-mono mt-1">Total Anggota</div>
                        </div>
                        <div class="h-px w-full bg-white/10 hidden lg:block"></div>
                        <div class="w-px h-12 bg-white/10 hidden sm:block lg:hidden"></div>
                        <div class="flex-1">
                            @if (!isset($organisasi))
                                <div class="text-4xl sm:text-5xl font-extrabold text-secondary">
                                    {{ $penguruses->pluck('organisasi_otonom_id')->unique()->count() }}</div>
                                <div class="text-xs text-white/50 uppercase tracking-widest font-mono mt-1">Organisasi Otonom
                                </div>
                            @else
                                <div class="text-4xl sm:text-5xl font-extrabold text-secondary">
                                    {{ $penguruses->where('level', 'inti')->count() }}</div>
                                <div class="text-xs text-white/50 uppercase tracking-widest font-mono mt-1">Pengurus Inti</div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── TOOLBAR ── --}}
    <div class="sticky top-14 z-50 bg-cream/95 backdrop-blur-md border-b border-primary/10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            {{-- Search input --}}
            <div class="relative max-w-md w-full">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i data-lucide="search" class="h-5 w-5 text-gray-400"></i>
                </span>
                <input type="text" id="search-input"
                    class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm transition-all"
                    placeholder="Cari nama atau jabatan..." oninput="filterMembers()">
            </div>

            {{-- Pills --}}
            <div class="flex gap-2 overflow-x-auto pb-1 scrollbar-none" id="level-pills">
                <button
                    class="pill-btn px-4 py-1.5 text-xs font-semibold uppercase tracking-wider rounded-full border border-primary bg-primary text-white transition-all whitespace-nowrap"
                    onclick="setFilter('all', this)">
                    Semua ({{ $penguruses->count() }})
                </button>
                @foreach (['inti' => 'Pengurus Inti', 'majelis' => 'Majelis', 'lembaga' => 'Lembaga'] as $val => $label)
                    @php $cnt = $penguruses->where('level', $val)->count(); @endphp
                    @if ($cnt > 0)
                        <button
                            class="pill-btn px-4 py-1.5 text-xs font-semibold uppercase tracking-wider rounded-full border border-gray-200 text-gray-500 hover:bg-gray-50 transition-all whitespace-nowrap"
                            onclick="setFilter('{{ $val }}', this)" data-level="{{ $val }}">
                            {{ $label }} ({{ $cnt }})
                        </button>
                    @endif
                @endforeach

                @if (!isset($organisasi))
                    @php $orgs = $penguruses->map(fn($p) => $p->organisasi)->filter()->unique('id')->sortBy('nama'); @endphp
                    @foreach ($orgs as $o)
                        <button
                            class="pill-btn px-4 py-1.5 text-xs font-semibold uppercase tracking-wider rounded-full border border-gray-200 text-gray-500 hover:bg-gray-50 transition-all whitespace-nowrap"
                            onclick="setFilter('org_{{ $o->id }}', this)" data-org="{{ $o->id }}">
                            {{ $o->singkatan ?? $o->nama }} ({{ $penguruses->where('organisasi_otonom_id', $o->id)->count() }})
                        </button>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    {{-- Kembali Button --}}
    <div class="max-w-7xl mx-auto px-6 mt-8">
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center gap-2 px-5 py-2 text-xs font-bold uppercase tracking-wider text-gray-600 bg-white border border-gray-200 rounded-full hover:bg-primary hover:text-white hover:border-primary transition-all duration-200">
            <i data-lucide="chevron-left" class="w-4 h-4"></i>
            <span>Kembali</span>
        </a>
    </div>

    {{-- ── MEMBER LIST ── --}}
    <main class="max-w-7xl mx-auto px-6 py-10">
        @php
            $grouped = $penguruses->groupBy('level');
            $levelOrder = ['inti', 'majelis', 'lembaga'];
            $levelLabels = ['inti' => 'Pengurus Inti', 'majelis' => 'Majelis', 'lembaga' => 'Lembaga'];
            $delay = 4;
        @endphp

        @forelse($levelOrder as $level)
            @if ($grouped->has($level))
                @php
                    $members = $grouped[$level]->sortBy('urutan');
                    $delay++;
                @endphp

                <div class="section level-{{ $level }} mb-12 animate-fadeUp" data-section-level="{{ $level }}">

                    <div class="flex items-center gap-3 mb-6 pb-2 border-b border-gray-200">
                        @php
                            $stripeColor = 'bg-primary';
                            if ($level === 'majelis')
                                $stripeColor = 'bg-secondary';
                            elseif ($level === 'lembaga')
                                $stripeColor = 'bg-blue-600';
                        @endphp
                        <span class="w-5 h-1 rounded {{ $stripeColor }}"></span>
                        <h2 class="text-sm font-extrabold uppercase tracking-widest text-accent-green">{{ $levelLabels[$level] }}
                        </h2>
                        <span class="text-xs text-gray-400 font-medium">({{ $members->count() }} orang)</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($members as $index => $p)
                            <div class="member-card bg-white rounded-2xl border border-gray-100 p-5 flex flex-col justify-between hover:shadow-lg hover:border-primary/20 transition-all duration-300 relative group"
                                data-nama="{{ strtolower($p->nama) }}" data-jabatan="{{ strtolower($p->jabatan) }}"
                                data-level="{{ $p->level }}" data-org="{{ $p->organisasi_otonom_id ?? 'null' }}">

                                <div class="flex items-start gap-4">
                                    {{-- Avatar --}}
                                    @php
                                        $bgColors = [
                                            'bg-emerald-50 text-emerald-700',
                                            'bg-blue-50 text-blue-700',
                                            'bg-amber-50 text-amber-700',
                                            'bg-purple-50 text-purple-700',
                                        ];
                                        $avatarBg = $bgColors[$index % 4];
                                    @endphp
                                    <div
                                        class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0 flex items-center justify-center font-bold text-sm {{ $avatarBg }}">
                                        @if ($p->foto)
                                            <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            {{ strtoupper(substr(explode(' ', trim($p->nama))[0], 0, 1)) }}{{ strtoupper(substr(explode(' ', trim($p->nama))[1] ?? '', 0, 1)) }}
                                        @endif
                                    </div>

                                    {{-- Info --}}
                                    <div class="min-w-0 flex-1">
                                        <h3
                                            class="text-sm font-bold text-gray-800 truncate leading-snug group-hover:text-primary transition-colors">
                                            {{ $p->nama }}</h3>
                                        <p class="text-xs text-gray-500 mt-0.5 truncate">{{ $p->jabatan }}</p>
                                        @if ($p->bidang && $p->bidang !== '—')
                                            <span
                                                class="inline-block text-[10px] font-semibold uppercase tracking-wider text-gray-400 mt-1">{{ $p->bidang }}</span>
                                        @endif
                                    </div>

                                    {{-- Badge --}}
                                    @php
                                        $badgeBg = 'bg-primary/10 text-primary';
                                        if ($p->level === 'majelis')
                                            $badgeBg = 'bg-secondary/15 text-secondary';
                                        elseif ($p->level === 'lembaga')
                                            $badgeBg = 'bg-blue-50 text-blue-600';
                                    @endphp
                                    <span
                                        class="text-[9px] font-extrabold uppercase tracking-widest px-2.5 py-1 rounded-full {{ $badgeBg }}">
                                        {{ $p->level }}
                                    </span>
                                </div>

                                {{-- Contact --}}
                                @if ($p->no_hp || $p->email)
                                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center gap-4">
                                        @if ($p->no_hp)
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $p->no_hp) }}" target="_blank"
                                                class="flex items-center gap-1.5 text-[11px] font-medium text-gray-400 hover:text-emerald-600 transition-colors truncate">
                                                <i data-lucide="message-circle" class="w-3.5 h-3.5 flex-shrink-0 text-emerald-600"></i>
                                                <span>{{ $p->no_hp }}</span>
                                            </a>
                                        @endif
                                        @if ($p->email)
                                            <a href="mailto:{{ $p->email }}"
                                                class="flex items-center gap-1.5 text-[11px] font-medium text-gray-400 hover:text-primary transition-colors truncate">
                                                <i data-lucide="mail" class="w-3.5 h-3.5 flex-shrink-0 text-primary"></i>
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
            <div class="text-center py-20 bg-white rounded-3xl border border-gray-100">
                <span class="serif italic text-6xl text-gray-200 block mb-4">— ✦ —</span>
                <p class="text-sm text-gray-400 font-medium">Belum ada data anggota.</p>
            </div>
        @endforelse

        {{-- Empty search --}}
        <div id="empty-search" class="text-center py-20 bg-white rounded-3xl border border-gray-100" style="display:none;">
            <span class="serif text-6xl text-gray-200 block mb-4">∅</span>
            <p class="text-sm text-gray-400 font-medium">Tidak ada anggota yang cocok dengan pencarian.</p>
            <button
                class="mt-4 px-5 py-2 text-xs font-semibold uppercase tracking-wider text-secondary border border-secondary hover:bg-secondary hover:text-white rounded-full transition-all duration-300"
                onclick="clearFilter()">Hapus filter</button>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        let currentFilter = 'all';

        function filterMembers() {
            const query = document.getElementById('search-input').value.toLowerCase().trim();
            const sections = document.querySelectorAll('.section');
            let total = 0;

            sections.forEach(section => {
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
            document.querySelectorAll('.pill-btn').forEach(p => {
                p.className = 'pill-btn px-4 py-1.5 text-xs font-semibold uppercase tracking-wider rounded-full border border-gray-200 text-gray-500 hover:bg-gray-50 transition-all whitespace-nowrap';
            });
            btn.className = 'pill-btn px-4 py-1.5 text-xs font-semibold uppercase tracking-wider rounded-full border border-primary bg-primary text-white transition-all whitespace-nowrap';
            filterMembers();
        }

        function clearFilter() {
            document.getElementById('search-input').value = '';
            currentFilter = 'all';
            const pills = document.querySelectorAll('.pill-btn');
            pills.forEach((p, i) => {
                if (i === 0) {
                    p.className = 'pill-btn px-4 py-1.5 text-xs font-semibold uppercase tracking-wider rounded-full border border-primary bg-primary text-white transition-all whitespace-nowrap';
                } else {
                    p.className = 'pill-btn px-4 py-1.5 text-xs font-semibold uppercase tracking-wider rounded-full border border-gray-200 text-gray-500 hover:bg-gray-50 transition-all whitespace-nowrap';
                }
            });
            filterMembers();
        }
    </script>
@endsection