@extends('layouts.colormag')

@section('title', $label . ' — Amal Usaha PCM Duren Sawit 1')
@section('meta_description', 'Daftar unit Amal Usaha Muhammadiyah PCM Duren Sawit 1 dalam kategori ' . $label . '.')
@section('meta_keywords', 'Amal Usaha, ' . $label . ', PCM Duren Sawit 1, Muhammadiyah Duren Sawit')
@section('og_image', asset('images/logo.png'))

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BreadcrumbList",
  "itemListElement": [
    { "@@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}" },
    { "@@type": "ListItem", "position": 2, "name": "Amal Usaha", "item": "{{ url('/#amal-usaha') }}" },
    { "@@type": "ListItem", "position": 3, "name": "{{ $label }}", "item": "{{ url()->current() }}" }
  ]
}
</script>
@endsection

@section('content')
    <div class="cm-inner px-2.5">

        {{-- Breadcrumb --}}
        <nav aria-label="Breadcrumb" class="text-[12px] text-[#888888] mb-4">
            <a href="/" class="text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">Beranda</a>
            <span class="mx-1">/</span> Amal Usaha
            <span class="mx-1">/</span> {{ $label }}
        </nav>

        {{-- Header --}}
        <h1 class="cm-widget-title !text-[22px]"><span>{{ $label }}</span></h1>
        <p class="text-[13px] text-[#777777] mt-[-6px] mb-[25px]">
            Daftar unit amal usaha PCM Duren Sawit 1 dalam kategori {{ $label }}.
        </p>

        {{-- Tab filter kategori --}}
        <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-[25px]" style="scrollbar-width:none;">
            @foreach($allKategori as $kat)
                <a href="{{ route('amal-usaha.by-kategori', $kat['slug']) }}"
                    class="shrink-0 px-4 py-2 text-[12px] font-bold uppercase tracking-wide rounded-[3px] no-underline border cm-transition {{ $kategori === $kat['slug'] ? 'bg-[#2e9e5b] border-[#2e9e5b] text-white' : 'border-[#dddddd] text-[#555555] hover:border-[#2e9e5b] hover:text-[#2e9e5b]' }}">
                    {{ $kat['label'] }}
                </a>
            @endforeach
        </div>

        {{-- Grid kartu --}}
        @if($amalUsahaList->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-[25px] mb-[35px]">
                @foreach($amalUsahaList as $item)
                    <article class="border border-[#eaeaea] cm-card-shadow flex flex-col bg-white">
                        <a href="#" class="block overflow-hidden no-underline">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}"
                                    class="w-full aspect-[600/360] object-cover block hover:scale-[1.04] transition-transform duration-500"
                                    loading="lazy"/>
                            @else
                                <div class="w-full aspect-[600/360] bg-gradient-to-br from-[#eaf5ee] to-[#d8ecdf] flex items-center justify-center">
                                    <i data-lucide="building-2" class="w-10 h-10 text-[#2e9e5b]/40"></i>
                                </div>
                            @endif
                        </a>
                        <div class="p-5 pt-3.5 flex flex-col flex-grow">
                            <div class="mb-1.5">
                                <span class="cm-cat-badge">{{ ucfirst(str_replace('_', ' ', $item->tipe)) }}</span>
                            </div>
                            <h2 class="cm-entry-title text-[17px] leading-snug font-semibold m-0">
                                {{ $item->nama }}
                            </h2>

                            @if($item->organisasiOtonom)
                                <div class="flex items-center gap-1.5 mt-2 text-[12.5px] text-[#888888]">
                                    <i data-lucide="landmark" class="w-3.5 h-3.5 shrink-0"></i>
                                    <span class="truncate">{{ $item->organisasiOtonom->nama }}</span>
                                </div>
                            @endif

                            @if($item->deskripsi)
                                <p class="text-[13.5px] text-[#444444] leading-relaxed mt-2 mb-0 line-clamp-3">{{ $item->deskripsi }}</p>
                            @endif

                            <div class="mt-auto pt-4">
                                <span class="inline-flex items-center gap-1 text-[11px] font-semibold uppercase tracking-wide text-[#2e9e5b]">
                                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i> Aktif
                                </span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 border border-[#eaeaea] bg-white mb-[35px]">
                <i data-lucide="building-2" class="w-12 h-12 mx-auto text-[#cccccc]"></i>
                <p class="text-[14px] text-[#777777] mt-4">Belum ada data amal usaha untuk kategori <strong>{{ $label }}</strong>.</p>
                <a href="/"
                    class="mt-5 inline-block bg-[#2e9e5b] hover:bg-[#268a4f] text-white text-[13px] font-semibold px-6 py-2.5 rounded-[3px] no-underline cm-transition">
                    Kembali ke Beranda
                </a>
            </div>
        @endif
    </div>
@endsection
