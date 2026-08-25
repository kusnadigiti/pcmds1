@extends('layouts.colormag')

@section('title', $org->nama . ' — PCM Duren Sawit 1')
@section('meta_description', 'Profil ' . $org->nama . ' (' . ($org->singkatan ?? 'Ortom') . ') Pimpinan Cabang Muhammadiyah Duren Sawit 1. Visi, misi, dan susunan kepengurusan.')
@section('meta_keywords', $org->nama . ', ' . ($org->singkatan ?? 'Ortom') . ', Organisasi Otonom Muhammadiyah, PCM Duren Sawit 1')
@section('og_image', $org->logo ? asset('storage/' . $org->logo) : asset('images/logo.png'))

@php
    $tipeLabel = ['otonom' => 'Organisasi Otonom', 'lembaga' => 'Lembaga', 'majelis' => 'Majelis'];
@endphp

@section('content')
    <div class="cm-inner px-2.5">

        {{-- Breadcrumb --}}
        <nav aria-label="Breadcrumb" class="text-[12px] text-[#888888] mb-4">
            <a href="/" class="text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">Beranda</a>
            <span class="mx-1">/</span> {{ $org->nama }}
        </nav>

        {{-- Header organisasi --}}
        <div class="bg-white border border-[#eaeaea] cm-card-shadow p-5 md:p-8 mb-[30px]">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_auto] gap-6 items-center">
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 bg-white border border-[#eaeaea] rounded-[3px] flex items-center justify-center overflow-hidden shrink-0">
                        @if ($org->logo)
                            <img src="{{ asset('storage/' . $org->logo) }}" alt="{{ $org->nama }}" class="w-full h-full object-contain"/>
                        @else
                            <span class="text-[15px] font-bold text-[#2e9e5b]">{{ $org->singkatan }}</span>
                        @endif
                    </div>
                    <div class="min-w-0">
                        <div class="mb-1.5">
                            <span class="cm-cat-badge">{{ $tipeLabel[$org->tipe] ?? ucfirst($org->tipe) }}</span>
                        </div>
                        <h1 class="text-[24px] md:text-[30px] leading-tight font-semibold text-[#333333] m-0 mb-2">
                            {{ $org->nama }}
                        </h1>
                        @if ($org->deskripsi)
                            <p class="text-[14px] text-[#555555] leading-relaxed m-0 max-w-[65ch]">{{ $org->deskripsi }}</p>
                        @endif
                    </div>
                </div>

                {{-- Stats --}}
                <div class="flex lg:flex-col gap-6 border-t lg:border-t-0 border-l-0 pt-4 lg:pt-0 lg:text-right lg:border-[#eeeeee]">
                    <div>
                        <div class="text-[26px] font-bold text-[#2e9e5b] leading-none">{{ $pengurusInti->count() }}</div>
                        <div class="text-[11px] uppercase tracking-wide text-[#888888] mt-1">Pengurus Inti</div>
                    </div>
                    <div>
                        <div class="text-[26px] font-bold text-[#2e9e5b] leading-none">{{ $totalPengurus }}</div>
                        <div class="text-[11px] uppercase tracking-wide text-[#888888] mt-1">Total Anggota</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pengurus inti --}}
        <section class="mb-[35px]" aria-label="Pimpinan organisasi">
            <h3 class="cm-widget-title"><span>Pimpinan Organisasi</span></h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-[25px]">
                @foreach ([['Ketua', $org->ketua], ['Sekretaris', $org->sekretaris], ['Bendahara', $org->bendahara]] as [$jabatan, $nama])
                    <div class="bg-white border border-[#eaeaea] cm-card-shadow p-5 border-t-2 !border-t-[#2e9e5b]">
                        <div class="text-[11px] uppercase tracking-wide text-[#888888] mb-3">{{ $jabatan }}</div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#eaf5ee] text-[#2e9e5b] flex items-center justify-center text-[13px] font-bold overflow-hidden shrink-0">
                                @if($nama)
                                    {{ strtoupper(substr($nama, 0, 1)) }}
                                @else
                                    ?
                                @endif
                            </div>
                            <div class="text-[15px] font-semibold text-[#333333]">{{ $nama ?? 'Belum diisi' }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Semua pengurus --}}
        @if ($allPengurus->count())
            <section class="mb-[35px]" aria-label="Seluruh pengurus">
                <h3 class="cm-widget-title"><span>Seluruh Pengurus <small class="font-normal text-white/80 text-[13px]">({{ $allPengurus->count() }} orang)</small></span></h3>

                @php
                    $grouped = $allPengurus->groupBy('bidang');
                    $grouped = $grouped->sortKeys();
                @endphp

                <div class="space-y-[25px]">
                    @foreach ($grouped as $bidang => $members)
                        <div>
                            @if ($bidang && $bidang !== '—')
                                <h4 class="text-[14px] font-bold text-[#333333] border-b-2 border-[#2e9e5b] inline-block pb-1 mb-4 mt-0">{{ $bidang }}</h4>
                            @endif

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-[15px]">
                                @foreach ($members->sortBy('urutan') as $p)
                                    <div class="bg-white border border-[#eaeaea] cm-card-shadow px-4 py-4 hover:border-[#2e9e5b] cm-transition">
                                        <div class="flex items-start gap-3">
                                            <div class="w-11 h-11 rounded-full bg-[#eaf5ee] overflow-hidden flex-shrink-0 flex items-center justify-center">
                                                @if ($p->foto)
                                                    <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama }}" class="w-full h-full object-cover"/>
                                                @else
                                                    <span class="text-[12px] font-bold text-[#2e9e5b]">{{ strtoupper(substr($p->nama, 0, 2)) }}</span>
                                                @endif
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div class="text-[13.5px] font-semibold text-[#333333] leading-snug truncate">{{ $p->nama }}</div>
                                                <div class="text-[12px] text-[#888888] mt-0.5">{{ $p->jabatan }}</div>
                                                @if ($p->no_hp)
                                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $p->no_hp) }}" target="_blank" rel="noopener"
                                                        class="inline-flex items-center gap-1 text-[11px] text-[#2e9e5b] hover:text-[#268a4f] mt-1.5 no-underline cm-transition">
                                                        <i data-lucide="phone" class="w-3 h-3"></i> {{ $p->no_hp }}
                                                    </a>
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

        {{-- Informasi tambahan --}}
        <section class="mb-[20px]" aria-label="Informasi organisasi">
            <h3 class="cm-widget-title"><span>Informasi Organisasi</span></h3>
            <div class="bg-white border border-[#eaeaea] cm-card-shadow grid grid-cols-2 md:grid-cols-4 divide-x divide-[#eeeeee]">
                <div class="p-5">
                    <div class="text-[11px] uppercase tracking-wide text-[#888888] mb-2">Singkatan</div>
                    <div class="text-[18px] font-bold text-[#333333]">{{ $org->singkatan }}</div>
                </div>
                <div class="p-5">
                    <div class="text-[11px] uppercase tracking-wide text-[#888888] mb-2">Tipe</div>
                    <div class="text-[14px] font-semibold capitalize text-[#333333]">{{ $tipeLabel[$org->tipe] ?? $org->tipe }}</div>
                </div>
                <div class="p-5">
                    <div class="text-[11px] uppercase tracking-wide text-[#888888] mb-2">Periode Aktif</div>
                    <div class="text-[14px] font-semibold text-[#333333]">{{ $org->periode_mulai }} - {{ $org->periode_selesai }}</div>
                </div>
                <div class="p-5">
                    <div class="text-[11px] uppercase tracking-wide text-[#888888] mb-2">Status</div>
                    <div class="text-[14px] font-semibold {{ $org->is_active ? 'text-[#2e9e5b]' : 'text-[#888888]' }}">{{ $org->is_active ? 'Aktif' : 'Tidak Aktif' }}</div>
                </div>
            </div>

            {{-- CTA bawah --}}
            <div class="mt-6 flex flex-wrap items-center justify-between gap-4">
                <a href="/" onclick="if(document.referrer && window.history.length > 1) { window.history.back(); return false; }"
                    class="inline-flex items-center gap-1.5 text-[12px] font-bold uppercase tracking-wide text-[#888888] hover:text-[#2e9e5b] no-underline cm-transition">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali
                </a>
                <a href="{{ route('anggota-organisasi.show', $org->slug) }}"
                    class="inline-flex items-center gap-1.5 bg-[#2e9e5b] hover:bg-[#268a4f] text-white text-[12px] font-bold uppercase tracking-wide px-5 py-2.5 rounded-[3px] no-underline cm-transition">
                    Lihat Semua Anggota <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        </section>
    </div>
@endsection
