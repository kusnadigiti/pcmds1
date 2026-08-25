@extends('layouts.colormag')

@section('title', 'Daftar Pengurus ' . ($organisasi->nama ?? 'Organisasi') . ' — PCM Duren Sawit 1')
@section('meta_description', 'Daftar lengkap jajaran pengurus dan anggota ' . ($organisasi->nama ?? 'organisasi') . ' Pimpinan Cabang Muhammadiyah Duren Sawit 1.')
@section('meta_keywords', 'Pengurus ' . ($organisasi->nama ?? '') . ', ' . ($organisasi->singkatan ?? '') . ', PCM Duren Sawit 1, Muhammadiyah')
@section('og_image', isset($organisasi) && $organisasi->logo ? asset('storage/' . $organisasi->logo) : asset('images/logo.png'))

@php
    $tipeLabel = ['otonom' => 'Organisasi Otonom', 'lembaga' => 'Lembaga', 'majelis' => 'Majelis'];
@endphp

@section('content')
    <div class="cm-inner px-2.5">

        {{-- Breadcrumb --}}
        <nav aria-label="Breadcrumb" class="text-[12px] text-[#888888] mb-4">
            <a href="/" class="text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">Beranda</a>
            @if (isset($organisasi))
                <span class="mx-1">/</span>
                <a href="{{ route('organisasi-otonom.show', $organisasi->slug) }}" class="text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">{{ $organisasi->nama }}</a>
            @endif
            <span class="mx-1">/</span> Daftar Anggota
        </nav>

        {{-- Header --}}
        <div class="bg-white border border-[#eaeaea] cm-card-shadow p-5 md:p-7 mb-[30px]">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <div class="mb-1.5">
                        <span class="cm-cat-badge">{{ isset($organisasi) ? ($organisasi->singkatan ?? ucfirst($organisasi->tipe ?? '')) : 'Muhammadiyah' }}</span>
                    </div>
                    <h1 class="text-[22px] md:text-[28px] leading-tight font-semibold text-[#333333] m-0 mb-1.5">
                        {{ isset($organisasi) ? $organisasi->nama : 'Daftar Anggota Pengurus' }}
                    </h1>
                    <p class="text-[13px] text-[#777777] m-0">
                        @if (isset($organisasi))
                            Seluruh pengurus aktif periode {{ $organisasi->periode_mulai }} - {{ $organisasi->periode_selesai }}.
                        @else
                            Seluruh pengurus aktif dari setiap organisasi dalam naungan Muhammadiyah.
                        @endif
                    </p>
                </div>

                {{-- Statistik --}}
                <div class="flex gap-6 text-right">
                    <div>
                        <div class="text-[26px] font-bold text-[#2e9e5b] leading-none" id="stat-total">{{ $penguruses->count() }}</div>
                        <div class="text-[11px] uppercase tracking-wide text-[#888888] mt-1">Total Anggota</div>
                    </div>
                    <div>
                        <div class="text-[26px] font-bold text-[#2e9e5b] leading-none">
                            @if (!isset($organisasi))
                                {{ $penguruses->pluck('organisasi_otonom_id')->unique()->count() }}
                            @else
                                {{ $penguruses->where('level', 'inti')->count() }}
                            @endif
                        </div>
                        <div class="text-[11px] uppercase tracking-wide text-[#888888] mt-1">
                            @if (!isset($organisasi)) Organisasi @else Pengurus Inti @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Toolbar pencarian & filter --}}
        <div class="bg-white border border-[#eaeaea] cm-card-shadow p-4 mb-[30px] flex flex-col md:flex-row md:items-center justify-between gap-3">
            <div class="relative max-w-sm w-full">
                <input type="text" id="search-input"
                    class="w-full pl-9 pr-3 py-2 border border-[#cccccc] rounded-none focus:outline-none focus:border-[#2e9e5b] text-[13px] text-[#333333]"
                    placeholder="Cari nama atau jabatan..." oninput="filterMembers()"/>
                <i data-lucide="search" class="absolute left-2.5 top-1/2 -translate-y-1/2 w-4 h-4 text-[#888888] pointer-events-none"></i>
            </div>

            <div class="flex gap-2 overflow-x-auto pb-1" id="level-pills" style="scrollbar-width:none;">
                <button type="button"
                    class="pill-btn shrink-0 px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-wide rounded-[3px] border bg-[#2e9e5b] border-[#2e9e5b] text-white cursor-pointer cm-transition whitespace-nowrap"
                    onclick="setFilter('all', this)">
                    Semua ({{ $penguruses->count() }})
                </button>
                @foreach (['inti' => 'Pengurus Inti', 'majelis' => 'Majelis', 'lembaga' => 'Lembaga'] as $val => $label)
                    @php $cnt = $penguruses->where('level', $val)->count(); @endphp
                    @if ($cnt > 0)
                        <button type="button"
                            class="pill-btn shrink-0 px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-wide rounded-[3px] border border-[#dddddd] text-[#555555] hover:border-[#2e9e5b] hover:text-[#2e9e5b] bg-white cursor-pointer cm-transition whitespace-nowrap"
                            onclick="setFilter('{{ $val }}', this)" data-level="{{ $val }}">
                            {{ $label }} ({{ $cnt }})
                        </button>
                    @endif
                @endforeach

                @if (!isset($organisasi))
                    @php $orgs = $penguruses->map(fn($p) => $p->organisasi)->filter()->unique('id')->sortBy('nama'); @endphp
                    @foreach ($orgs as $o)
                        <button type="button"
                            class="pill-btn shrink-0 px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-wide rounded-[3px] border border-[#dddddd] text-[#555555] hover:border-[#2e9e5b] hover:text-[#2e9e5b] bg-white cursor-pointer cm-transition whitespace-nowrap"
                            onclick="setFilter('org_{{ $o->id }}', this)" data-org="{{ $o->id }}">
                            {{ $o->singkatan ?? $o->nama }} ({{ $penguruses->where('organisasi_otonom_id', $o->id)->count() }})
                        </button>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- Daftar anggota --}}
        <main class="pb-[20px]">
            @php
                $grouped = $penguruses->groupBy('level');
                $levelOrder = ['inti', 'majelis', 'lembaga'];
                $levelLabels = ['inti' => 'Pengurus Inti', 'majelis' => 'Majelis', 'lembaga' => 'Lembaga'];
            @endphp

            @forelse($levelOrder as $level)
                @if ($grouped->has($level))
                    @php $members = $grouped[$level]->sortBy('urutan'); @endphp

                    <div class="section level-{{ $level }} mb-[35px]" data-section-level="{{ $level }}">
                        <h2 class="cm-widget-title"><span>{{ $levelLabels[$level] }} <small class="font-normal text-white/80 text-[13px]">({{ $members->count() }} orang)</small></span></h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[15px]">
                            @foreach ($members as $index => $p)
                                <div class="member-card bg-white border border-[#eaeaea] cm-card-shadow p-4 flex flex-col justify-between hover:border-[#2e9e5b] cm-transition"
                                    data-nama="{{ strtolower($p->nama) }}" data-jabatan="{{ strtolower($p->jabatan) }}"
                                    data-level="{{ $p->level }}" data-org="{{ $p->organisasi_otonom_id ?? 'null' }}">

                                    <div class="flex items-start gap-3">
                                        {{-- Avatar --}}
                                        <div class="w-11 h-11 rounded-full overflow-hidden flex-shrink-0 flex items-center justify-center bg-[#eaf5ee] font-bold text-[13px] text-[#2e9e5b]">
                                            @if ($p->foto)
                                                <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama }}" class="w-full h-full object-cover"/>
                                            @else
                                                {{ strtoupper(substr(explode(' ', trim($p->nama))[0], 0, 1)) }}{{ strtoupper(substr(explode(' ', trim($p->nama))[1] ?? '', 0, 1)) }}
                                            @endif
                                        </div>

                                        {{-- Info --}}
                                        <div class="min-w-0 flex-1">
                                            <h3 class="text-[13.5px] font-semibold text-[#333333] truncate leading-snug m-0">{{ $p->nama }}</h3>
                                            <p class="text-[12px] text-[#888888] mt-0.5 truncate m-0">{{ $p->jabatan }}</p>
                                            @if ($p->bidang && $p->bidang !== '—')
                                                <span class="inline-block text-[10px] font-semibold uppercase tracking-wide text-[#2e9e5b] mt-1">{{ $p->bidang }}</span>
                                            @endif
                                        </div>

                                        {{-- Level badge --}}
                                        <span class="shrink-0 text-[9px] font-bold uppercase tracking-widest px-2 py-1 rounded-[3px] {{ $p->level === 'inti' ? 'bg-[#2e9e5b] text-white' : ($p->level === 'majelis' ? 'bg-[#eaf5ee] text-[#2e9e5b]' : 'bg-[#f0f0f0] text-[#666666]') }}">
                                            {{ $p->level }}
                                        </span>
                                    </div>

                                    {{-- Kontak --}}
                                    @if ($p->no_hp || $p->email)
                                        <div class="mt-3 pt-3 border-t border-[#eeeeee] flex items-center gap-4 flex-wrap">
                                            @if ($p->no_hp)
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $p->no_hp) }}" target="_blank" rel="noopener"
                                                    class="inline-flex items-center gap-1 text-[11px] text-[#888888] hover:text-[#2e9e5b] no-underline truncate cm-transition">
                                                    <i data-lucide="message-circle" class="w-3.5 h-3.5 shrink-0"></i> {{ $p->no_hp }}
                                                </a>
                                            @endif
                                            @if ($p->email)
                                                <a href="mailto:{{ $p->email }}"
                                                    class="inline-flex items-center gap-1 text-[11px] text-[#888888] hover:text-[#2e9e5b] no-underline truncate cm-transition">
                                                    <i data-lucide="mail" class="w-3.5 h-3.5 shrink-0"></i> {{ $p->email }}
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
                <div class="text-center py-20 bg-white border border-[#eaeaea]">
                    <i data-lucide="users" class="w-12 h-12 mx-auto text-[#cccccc]"></i>
                    <p class="text-[14px] text-[#777777] mt-4">Belum ada data anggota.</p>
                </div>
            @endforelse

            {{-- Hasil pencarian kosong --}}
            <div id="empty-search" class="text-center py-20 bg-white border border-[#eaeaea]" style="display:none;">
                <i data-lucide="search-x" class="w-12 h-12 mx-auto text-[#cccccc]"></i>
                <p class="text-[14px] text-[#777777] mt-4">Tidak ada anggota yang cocok dengan pencarian.</p>
                <button type="button"
                    class="mt-4 px-5 py-2 text-[11px] font-bold uppercase tracking-wide text-white bg-[#2e9e5b] hover:bg-[#268a4f] border-0 rounded-[3px] cursor-pointer cm-transition"
                    onclick="clearFilter()">Hapus Filter</button>
            </div>
        </main>
    </div>
@endsection

@section('scripts')
    <script>
        let currentFilter = 'all';

        const PILL_ACTIVE = 'pill-btn shrink-0 px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-wide rounded-[3px] border bg-[#2e9e5b] border-[#2e9e5b] text-white cursor-pointer cm-transition whitespace-nowrap';
        const PILL_IDLE = 'pill-btn shrink-0 px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-wide rounded-[3px] border border-[#dddddd] text-[#555555] hover:border-[#2e9e5b] hover:text-[#2e9e5b] bg-white cursor-pointer cm-transition whitespace-nowrap';

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
                    if (show) { sectionVisible++; total++; }
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
            document.querySelectorAll('.pill-btn').forEach(p => { p.className = PILL_IDLE; });
            btn.className = PILL_ACTIVE;
            filterMembers();
        }

        function clearFilter() {
            document.getElementById('search-input').value = '';
            currentFilter = 'all';
            const pills = document.querySelectorAll('.pill-btn');
            pills.forEach((p, i) => { p.className = i === 0 ? PILL_ACTIVE : PILL_IDLE; });
            filterMembers();
        }
    </script>
@endsection
