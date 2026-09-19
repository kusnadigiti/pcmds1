@extends('layouts.colormag')

@section('title', 'Amal Usaha Muhammadiyah — PCM Duren Sawit 1')
@section('meta_description', 'Direktori sekolah, layanan kesehatan, dan amal usaha sosial Muhammadiyah di lingkungan PCM Duren Sawit 1.')
@section('meta_keywords', 'Amal Usaha Muhammadiyah, Sekolah Muhammadiyah Duren Sawit, PCM Duren Sawit 1')
@section('og_image', asset('images/logo.png'))

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BreadcrumbList",
  "itemListElement": [
    { "@@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}" },
    { "@@type": "ListItem", "position": 2, "name": "Amal Usaha", "item": "{{ route('amal-usaha.index') }}" }
  ]
}
</script>
@endsection

@php
    // Ganti nama, gambar, dan URL saat data resmi sekolah tersedia.
    $sekolahList = [
        ['jenjang' => 'SD', 'nama' => 'Sekolah Dasar Muhammadiyah', 'url' => null, 'gambar' => null],
        ['jenjang' => 'SMP', 'nama' => 'Sekolah Menengah Pertama Muhammadiyah', 'url' => null, 'gambar' => null],
        ['jenjang' => 'SMA', 'nama' => 'Sekolah Menengah Atas Muhammadiyah', 'url' => null, 'gambar' => null],
    ];

    $tipeLabels = [
        'bidang_pendidikan' => 'Pendidikan',
        'bidang_kesehatan' => 'Kesehatan',
        'bidang_sosial' => 'Kesejahteraan Sosial',
    ];
@endphp

@section('content')
    <div class="cm-inner px-2.5">
        <nav aria-label="Breadcrumb" class="text-[12px] text-[#888888] mb-4">
            <a href="/" class="text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">Beranda</a>
            <span class="mx-1">/</span> Amal Usaha
        </nav>

        <h1 class="cm-widget-title !text-[22px]"><span>Amal Usaha Muhammadiyah</span></h1>
        <p class="max-w-[760px] text-[13.5px] text-[#777777] leading-relaxed mt-[-6px] mb-[25px]">
            Temukan sekolah dan unit pelayanan Muhammadiyah di lingkungan PCM Duren Sawit 1 yang bergerak dalam bidang pendidikan, kesehatan, dan kesejahteraan sosial.
        </p>

        <section class="grid grid-cols-1 sm:grid-cols-3 border border-[#eaeaea] cm-card-shadow mb-[30px]" aria-label="Ringkasan Amal Usaha">
            <div class="p-4 flex items-center gap-3 border-b sm:border-b-0 sm:border-r border-[#eaeaea]">
                <i data-lucide="building-2" class="w-8 h-8 text-[#2e9e5b] shrink-0"></i>
                <div><strong class="block text-[22px] leading-none text-[#333333]">{{ $amalUsahaList->count() }}</strong><span class="text-[12px] text-[#888888]">Total Amal Usaha</span></div>
            </div>
            <div class="p-4 flex items-center gap-3 border-b sm:border-b-0 sm:border-r border-[#eaeaea]">
                <i data-lucide="graduation-cap" class="w-8 h-8 text-[#2e9e5b] shrink-0"></i>
                <div><strong class="block text-[22px] leading-none text-[#333333]">{{ $amalUsahaList->where('tipe', 'bidang_pendidikan')->count() }}</strong><span class="text-[12px] text-[#888888]">Unit Pendidikan</span></div>
            </div>
            <div class="p-4 flex items-center gap-3">
                <i data-lucide="layout-grid" class="w-8 h-8 text-[#2e9e5b] shrink-0"></i>
                <div><strong class="block text-[22px] leading-none text-[#333333]">{{ $kategoriList->where('count', '>', 0)->count() }}</strong><span class="text-[12px] text-[#888888]">Bidang Layanan</span></div>
            </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-[70.17%_1fr] gap-[30px] items-start pb-5">
            <div class="min-w-0">
                <section class="mb-[35px]" aria-labelledby="kategori-title">
                    <h2 id="kategori-title" class="cm-widget-title"><span>Jelajahi Berdasarkan Bidang</span></h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-[15px]">
                        @foreach($kategoriList as $item)
                            <a href="{{ route('amal-usaha.by-kategori', $item['slug']) }}"
                                class="group flex flex-col border border-[#eaeaea] bg-white p-4 no-underline cm-card-shadow hover:border-[#2e9e5b] focus:outline-none focus:ring-2 focus:ring-[#2e9e5b] focus:ring-offset-2 cm-transition">
                                <i data-lucide="{{ $item['icon'] }}" class="w-8 h-8 text-[#2e9e5b] mb-3"></i>
                                <h3 class="text-[15px] leading-snug font-semibold text-[#333333] group-hover:text-[#2e9e5b] m-0">{{ $item['label'] }}</h3>
                                <p class="text-[12px] leading-relaxed text-[#777777] mt-2 mb-4">{{ $item['description'] }}</p>
                                <span class="mt-auto text-[11px] font-bold uppercase tracking-wide text-[#2e9e5b]">{{ $item['count'] }} unit <i data-lucide="arrow-right" class="inline w-3.5 h-3.5"></i></span>
                            </a>
                        @endforeach
                    </div>
                </section>

                <section class="mb-[35px]" aria-labelledby="sekolah-title">
                    <h2 id="sekolah-title" class="cm-widget-title"><span>Pilih Sekolah Muhammadiyah</span></h2>
                    <p class="text-[13px] text-[#777777] leading-relaxed mt-[-5px] mb-4">
                        Pilih jenjang sekolah di lingkungan PCM Duren Sawit 1. Tautan website resmi akan tersedia setelah data sekolah dilengkapi.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-[15px]">
                        @foreach($sekolahList as $sekolah)
                            @if($sekolah['url'])
                                <a href="{{ $sekolah['url'] }}" target="_blank" rel="noopener noreferrer"
                                    class="group block border border-[#eaeaea] bg-white no-underline cm-card-shadow hover:border-[#2e9e5b] focus:outline-none focus:ring-2 focus:ring-[#2e9e5b] focus:ring-offset-2 cm-transition">
                            @else
                                <article class="group border border-[#eaeaea] bg-white cm-card-shadow" aria-label="{{ $sekolah['nama'] }} — website segera tersedia">
                            @endif

                                <div class="aspect-[600/360] overflow-hidden bg-[#f1f5f2] flex items-center justify-center relative">
                                    @if($sekolah['gambar'])
                                        <img src="{{ $sekolah['gambar'] }}" alt="{{ $sekolah['nama'] }}" class="w-full h-full object-cover group-hover:scale-[1.04] transition-transform duration-500">
                                    @else
                                        <i data-lucide="school" class="w-14 h-14 text-[#2e9e5b]/35"></i>
                                    @endif
                                    <span class="absolute top-3 left-3 cm-cat-badge font-bold">{{ $sekolah['jenjang'] }}</span>
                                </div>
                                <div class="p-4">
                                    <h3 class="text-[16px] leading-snug font-semibold text-[#333333] m-0 group-hover:text-[#2e9e5b] cm-transition">{{ $sekolah['nama'] }}</h3>
                                    @if($sekolah['url'])
                                        <span class="inline-flex items-center gap-1 mt-3 text-[11px] font-bold uppercase tracking-wide text-[#2e9e5b]">Kunjungi Website <i data-lucide="external-link" class="w-3.5 h-3.5"></i></span>
                                    @else
                                        <span class="inline-flex items-center gap-1 mt-3 text-[11px] font-semibold uppercase tracking-wide text-[#888888]"><i data-lucide="clock-3" class="w-3.5 h-3.5"></i> Website segera tersedia</span>
                                    @endif
                                </div>

                            @if($sekolah['url'])
                                </a>
                            @else
                                </article>
                            @endif
                        @endforeach
                    </div>
                </section>

                <section class="mb-[35px]" aria-labelledby="direktori-title">
                    <h2 id="direktori-title" class="cm-widget-title"><span>Direktori Amal Usaha</span></h2>
                    @if($amalUsahaList->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-[20px]">
                            @foreach($amalUsahaList as $item)
                                <article class="border border-[#eaeaea] cm-card-shadow flex flex-col bg-white">
                                    @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" class="w-full aspect-[600/360] object-cover" loading="lazy">
                                    @else
                                        <div class="w-full aspect-[600/360] bg-[#f1f5f2] flex items-center justify-center"><i data-lucide="building-2" class="w-10 h-10 text-[#2e9e5b]/35"></i></div>
                                    @endif
                                    <div class="p-4 flex flex-col flex-grow">
                                        <div class="mb-2"><span class="cm-cat-badge">{{ $tipeLabels[$item->tipe] ?? ucfirst(str_replace('_', ' ', $item->tipe)) }}</span></div>
                                        <h3 class="text-[16px] leading-snug font-semibold text-[#333333] m-0">{{ $item->nama }}</h3>
                                        @if($item->organisasiOtonom)
                                            <p class="flex items-center gap-1.5 text-[12px] text-[#888888] mt-2 mb-0"><i data-lucide="landmark" class="w-3.5 h-3.5 shrink-0"></i>{{ $item->organisasiOtonom->nama }}</p>
                                        @endif
                                        @if($item->deskripsi)
                                            <p class="text-[13px] text-[#555555] leading-relaxed mt-2 mb-0 line-clamp-3">{{ $item->deskripsi }}</p>
                                        @endif
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-14 border border-[#eaeaea] bg-white">
                            <i data-lucide="building-2" class="w-11 h-11 mx-auto text-[#cccccc]"></i>
                            <p class="text-[14px] text-[#777777] mt-3 mb-0">Belum ada data amal usaha.</p>
                        </div>
                    @endif
                </section>

                @if($organisasiCounts->isNotEmpty())
                    <section class="mb-[35px]" aria-labelledby="pengelola-title">
                        <h2 id="pengelola-title" class="cm-widget-title"><span>Organisasi Pengelola</span></h2>
                        <ul class="list-none m-0 p-0 border-t border-[#eaeaea]">
                            @foreach($organisasiCounts as $group)
                                <li class="flex items-center justify-between gap-3 py-3 border-b border-[#eaeaea]">
                                    <a href="{{ route('organisasi-otonom.show', $group['organisasi']->slug) }}" class="text-[13.5px] font-semibold text-[#333333] no-underline hover:text-[#2e9e5b] cm-transition">{{ $group['organisasi']->nama }}</a>
                                    <span class="shrink-0 text-[12px] text-[#888888]">{{ $group['count'] }} unit</span>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endif

                <section class="border-l-4 border-[#2e9e5b] bg-[#f8f8f8] p-5" aria-labelledby="kontak-title">
                    <h2 id="kontak-title" class="text-[18px] font-semibold text-[#333333] mt-0 mb-2">Butuh informasi lebih lanjut?</h2>
                    <p class="text-[13px] leading-relaxed text-[#666666] mt-0 mb-4">Hubungi PCM Duren Sawit 1 untuk informasi sekolah dan layanan Amal Usaha Muhammadiyah.</p>
                    <a href="{{ route('kontak') }}" class="inline-flex items-center gap-1.5 bg-[#2e9e5b] hover:bg-[#268a4f] text-white text-[12px] font-semibold px-4 py-2.5 rounded-[3px] no-underline cm-transition">Hubungi PCM <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i></a>
                </section>
            </div>

            @include('partials.cm-sidebar')
        </div>
    </div>
@endsection
