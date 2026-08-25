@extends('layouts.colormag')

@section('title', 'Profil & Sejarah — PCM Duren Sawit 1')
@section('meta_description', 'Profil, sejarah, visi, dan misi Pimpinan Cabang Muhammadiyah Duren Sawit 1. Mencerahkan Semesta, Memajukan Duren Sawit.')
@section('meta_keywords', 'Profil PCM Duren Sawit 1, Sejarah Muhammadiyah Duren Sawit, Visi Misi PCM Duren Sawit 1')
@section('og_image', asset('images/logo.png'))

@section('content')
    <div class="cm-inner px-2.5">

        {{-- Breadcrumb --}}
        <nav aria-label="Breadcrumb" class="text-[12px] text-[#888888] mb-4">
            <a href="/" class="text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">Beranda</a>
            <span class="mx-1">/</span> Profil Organisasi
        </nav>

        {{-- Header --}}
        <h1 class="cm-widget-title !text-[22px]"><span>Profil Organisasi</span></h1>
        <p class="text-[13px] text-[#777777] mt-[-6px] mb-[25px]">
            Mengenal lebih dekat Pimpinan Cabang Muhammadiyah Duren Sawit 1.
        </p>

        <div class="grid grid-cols-1 lg:grid-cols-[70.17%_1fr] gap-[30px] items-start pb-5">

            {{-- ══ PRIMARY ══ --}}
            <div class="min-w-0">

                {{-- Identitas --}}
                <div class="bg-white border border-[#eaeaea] cm-card-shadow mb-[30px]">
                    @if($profil?->image)
                        <img src="{{ asset('storage/' . $profil->image) }}" alt="{{ $profil->nama ?? 'Profil PCM Duren Sawit 1' }}"
                            class="w-full aspect-[800/445] object-cover block"/>
                    @endif
                    <div class="p-5 md:p-7">
                        <div class="mb-1.5">
                            <span class="cm-cat-badge">Profil</span>
                        </div>
                        <h2 class="text-[22px] md:text-[26px] font-semibold text-[#333333] leading-tight m-0 mb-2">
                            {{ $profil?->nama ?? 'Pimpinan Cabang Muhammadiyah Duren Sawit 1' }}
                        </h2>
                        <p class="text-[14px] text-[#555555] leading-relaxed m-0">
                            {{ $profil?->tagline ?? 'Mencerahkan Semesta, Memajukan Duren Sawit.' }}
                        </p>
                    </div>
                </div>

                {{-- Sejarah --}}
                <section class="mb-[30px]" aria-label="Sejarah">
                    <h3 class="cm-widget-title"><span>Sejarah</span></h3>
                    <div class="bg-white border border-[#eaeaea] cm-card-shadow p-5 md:p-7">
                        @if($profil?->sejarah)
                            <div class="space-y-3">
                                @foreach(preg_split('/\r\n|\r|\n/', $profil->sejarah) as $paragraf)
                                    @if(trim($paragraf) !== '')
                                        <p class="text-[14px] text-[#444444] leading-relaxed m-0">{{ $paragraf }}</p>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p class="text-[14px] text-[#444444] leading-relaxed m-0">
                                Pimpinan Cabang Muhammadiyah (PCM) Duren Sawit 1 adalah cabang gerakan Islam Muhammadiyah
                                yang melayani masyarakat kecamatan Duren Sawit, Jakarta Timur. Berdiri sebagai bagian dari
                                jaringan persyarikatan di wilayah Kota Jakarta Timur, PCM Duren Sawit 1 menjalankan dakwah
                                Islam berkemajuan melalui bidang pendidikan, kesehatan, dan kesejahteraan sosial bersama
                                organisasi otonom Muhammadiyah di wilayah kerjanya.
                            </p>
                        @endif
                    </div>
                </section>

                {{-- Visi --}}
                <section class="mb-[30px]" aria-label="Visi">
                    <h3 class="cm-widget-title"><span>Visi</span></h3>
                    <div class="bg-white border border-[#eaeaea] cm-card-shadow p-5 md:p-7 border-l-4 !border-l-[#2e9e5b]">
                        <p class="text-[15px] text-[#333333] leading-relaxed m-0 font-medium">
                            {{ $profil?->visi ?? 'Mencerahkan semesta, memajukan Duren Sawit.' }}
                        </p>
                    </div>
                </section>

                {{-- Misi --}}
                <section class="mb-[20px]" aria-label="Misi">
                    <h3 class="cm-widget-title"><span>Misi</span></h3>
                    <div class="bg-white border border-[#eaeaea] cm-card-shadow p-5 md:p-7">
                        @php
                            $misiItems = $profil?->misi
                                ? collect(preg_split('/\r\n|\r|\n/', $profil->misi))->filter(fn($m) => trim($m) !== '')->values()
                                : collect();
                        @endphp

                        @if($misiItems->count() > 1)
                            <ul class="list-none m-0 p-0 space-y-3">
                                @foreach($misiItems as $i => $misi)
                                    <li class="flex gap-3 items-start">
                                        <span class="shrink-0 w-6 h-6 bg-[#2e9e5b] text-white text-[12px] font-bold flex items-center justify-center rounded-[3px] mt-0.5">{{ $i + 1 }}</span>
                                        <span class="text-[14px] text-[#444444] leading-relaxed">{{ trim(preg_replace('/^\d+[.)]\s*/', '', $misi)) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-[14px] text-[#444444] leading-relaxed m-0">
                                {{ $profil?->misi ?? 'Menyelenggarakan dakwah Islam berkemajuan, meningkatkan kualitas pendidikan dan kesehatan umat, serta menggerakkan gerakan sosial untuk kesejahteraan masyarakat.' }}
                            </p>
                        @endif
                    </div>
                </section>

            </div>

            {{-- ══ SIDEBAR ══ --}}
            @include('partials.cm-sidebar')

        </div>
    </div>
@endsection
