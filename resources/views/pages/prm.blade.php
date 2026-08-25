@extends('layouts.colormag')

@section('title', 'PRM — PCM Duren Sawit 1')
@section('meta_description', 'Kegiatan dan amal usaha PRM di bawah naungan Pimpinan Cabang Muhammadiyah Duren Sawit 1.')
@section('meta_keywords', 'PRM, Kegiatan PRM, Amal Usaha, PCM Duren Sawit 1, Muhammadiyah')
@section('og_image', asset('images/logo.png'))

@php
    $cmBulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $cmBulanPendek = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    $tglId = function ($date) use ($cmBulan) {
        $d = \Carbon\Carbon::parse($date);
        return $d->format('j') . ' ' . ($cmBulan[(int)$d->format('n')] ?? '') . ' ' . $d->format('Y');
    };
    $tipeLabelMap = [
        'bidang_pendidikan' => 'Bidang Pendidikan',
        'bidang_kesehatan' => 'Bidang Kesehatan',
        'bidang_sosial' => 'Bidang Kesejahteraan Sosial',
    ];
    $tipeSlugMap = [
        'bidang_pendidikan' => 'bidang-pendidikan',
        'bidang_kesehatan' => 'bidang-kesehatan',
        'bidang_sosial' => 'bidang-kesejahteraan-sosial',
    ];
@endphp

@section('content')
    <div class="cm-inner px-2.5">

        {{-- Breadcrumb --}}
        <nav aria-label="Breadcrumb" class="text-[12px] text-[#888888] mb-4">
            <a href="/" class="text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">Beranda</a>
            <span class="mx-1">/</span> PRM
        </nav>

        {{-- Header --}}
        <h1 class="cm-widget-title !text-[22px]"><span>PRM</span></h1>
        <p class="text-[13px] text-[#777777] mt-[-6px] mb-[25px]">
            Kegiatan dan amal usaha PRM di bawah naungan Pimpinan Cabang Muhammadiyah Duren Sawit 1.
        </p>

        <div class="grid grid-cols-1 lg:grid-cols-[70.17%_1fr] gap-[30px] items-start pb-5">

            {{-- ══ PRIMARY ══ --}}
            <div class="min-w-0">

                {{-- Kegiatan / jadwal mendatang --}}
                <section class="mb-[35px]" aria-label="Kegiatan">
                    <h3 class="cm-widget-title"><span>Kegiatan Mendatang</span></h3>

                    @if($jadwals->isEmpty())
                        <div class="bg-white border border-[#eaeaea] cm-card-shadow text-center py-14 px-5">
                            <i data-lucide="calendar-x" class="w-10 h-10 mx-auto text-[#cccccc]"></i>
                            <p class="text-[14px] text-[#777777] mt-3 mb-0">Belum ada kegiatan yang dijadwalkan.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-[15px]">
                            @foreach($jadwals as $jadwal)
                                <div class="bg-white border border-[#eaeaea] cm-card-shadow p-4 flex gap-3.5 hover:border-[#2e9e5b] cm-transition">
                                    <div class="shrink-0 w-[52px] text-center bg-[#2e9e5b] text-white rounded-[3px] py-2 self-start">
                                        <span class="block text-[20px] font-bold leading-none">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('j') }}</span>
                                        <span class="block text-[10px] uppercase mt-0.5">{{ $cmBulanPendek[(int)\Carbon\Carbon::parse($jadwal->tanggal)->format('n')] ?? '' }}</span>
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="text-[14.5px] font-semibold text-[#333333] leading-snug m-0 mb-1">{{ $jadwal->nama_kegiatan }}</h4>
                                        <p class="text-[12px] text-[#888888] m-0 mb-1">
                                            <i data-lucide="clock" class="w-3 h-3 align-[-1px]"></i>
                                            {{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} WIB
                                        </p>
                                        @if($jadwal->lokasi)
                                            <p class="text-[12px] text-[#888888] m-0 mb-1">
                                                <i data-lucide="map-pin" class="w-3 h-3 align-[-1px]"></i> {{ $jadwal->lokasi }}
                                            </p>
                                        @endif
                                        @if($jadwal->deskripsi)
                                            <p class="text-[12.5px] text-[#555555] leading-relaxed m-0 line-clamp-2">{{ $jadwal->deskripsi }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>

                {{-- Amal usaha per bidang --}}
                <section class="mb-[20px]" aria-label="Amal usaha">
                    <h3 class="cm-widget-title"><span>Amal Usaha</span></h3>

                    @if($amalUsahaGrouped->isEmpty())
                        <div class="bg-white border border-[#eaeaea] cm-card-shadow text-center py-14 px-5">
                            <i data-lucide="building-2" class="w-10 h-10 mx-auto text-[#cccccc]"></i>
                            <p class="text-[14px] text-[#777777] mt-3 mb-0">Belum ada data amal usaha.</p>
                        </div>
                    @else
                        <div class="flex flex-col gap-[25px]">
                            @foreach($amalUsahaGrouped as $group)
                                <div>
                                    <h4 class="text-[14px] font-bold text-[#333333] border-b-2 border-[#2e9e5b] inline-block pb-1 mb-4 mt-0">
                                        {{ $tipeLabelMap[$group['tipe']] ?? ucfirst(str_replace('_', ' ', $group['tipe'])) }}
                                        <span class="font-normal text-[#888888] text-[12px]">({{ $group['count'] }} unit)</span>
                                    </h4>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-[15px]">
                                        @foreach($group['items']->take(4) as $item)
                                            <div class="bg-white border border-[#eaeaea] cm-card-shadow p-4 hover:border-[#2e9e5b] cm-transition">
                                                <h5 class="text-[14px] font-semibold text-[#333333] m-0 mb-1">{{ $item->nama }}</h5>
                                                @if($item->organisasiOtonom)
                                                    <p class="text-[12px] text-[#888888] m-0 flex items-center gap-1">
                                                        <i data-lucide="landmark" class="w-3 h-3 shrink-0"></i> {{ $item->organisasiOtonom->nama }}
                                                    </p>
                                                @endif
                                                @if($item->deskripsi)
                                                    <p class="text-[12.5px] text-[#555555] leading-relaxed mt-1.5 mb-0 line-clamp-2">{{ $item->deskripsi }}</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>

                                    @if($group['count'] > 4)
                                        <a href="{{ route('amal-usaha.by-kategori', $tipeSlugMap[$group['tipe']] ?? '') }}"
                                            class="inline-flex items-center gap-1 mt-4 text-[12px] font-bold uppercase tracking-wide text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">
                                            Lihat semua {{ $group['count'] }} unit <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>

            </div>

            {{-- ══ SIDEBAR ══ --}}
            @include('partials.cm-sidebar')

        </div>
    </div>
@endsection
