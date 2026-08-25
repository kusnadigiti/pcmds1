{{-- ═════════════════════════════════════════════════════════════════════
     SIDEBAR ColorMag — dipakai bersama halaman publik
     Variabel yang tersedia (opsional): $sidebarExcludeBeritaId
     ═════════════════════════════════════════════════════════════════════ --}}
@php
    $cmBulanSb = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $tglIdSb = function ($date) use ($cmBulanSb) {
        $d = \Carbon\Carbon::parse($date);
        return $d->format('j') . ' ' . ($cmBulanSb[(int)$d->format('n')] ?? '') . ' ' . $d->format('Y');
    };

    try {
        $queryBerita = \App\Models\Berita::where('status', 'published')->latest('created_at');
        if (isset($sidebarExcludeBeritaId) && $sidebarExcludeBeritaId) {
            $queryBerita->where('id', '!=', $sidebarExcludeBeritaId);
        }
        $sbBerita = $queryBerita->limit(4)->get();
        $sbOrgs = \App\Models\Organisasi::where('is_active', true)->orderBy('tipe')->orderBy('nama')->get();
    } catch (\Exception $e) {
        $sbBerita = collect();
        $sbOrgs = collect();
    }
@endphp

<aside class="min-w-0 text-[14px]" aria-label="Sidebar">

    {{-- Search box --}}
    <div class="mb-[35px]">
        <form action="https://www.google.com/search" method="get" target="_blank" class="flex">
            <input type="hidden" name="sitesearch" value="{{ request()->getHost() }}">
            <input type="text" name="q" placeholder="Cari..." aria-label="Pencarian"
                class="min-w-0 flex-1 px-3 py-2 text-[13px] text-[#333333] bg-white border border-[#cccccc] border-r-0 focus:outline-none focus:border-[#2e9e5b] rounded-none"/>
            <button type="submit" aria-label="Cari"
                class="bg-[#2e9e5b] hover:bg-[#268a4f] text-white px-3.5 border-0 cursor-pointer rounded-r-[3px] transition-colors duration-300">
                <i data-lucide="search" class="w-4 h-4"></i>
            </button>
        </form>
    </div>

    {{-- Berita terbaru --}}
    <div class="mb-[35px]">
        <h4 class="cm-widget-title"><span>Berita Terbaru</span></h4>
        @forelse($sbBerita as $item)
            <article class="flex gap-3 mb-4 last:mb-0">
                <a href="{{ route('berita.show', $item->slug) }}" class="shrink-0 w-[90px] overflow-hidden self-start no-underline">
                    <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://picsum.photos/seed/pcm-duren-sawit-sb-' . $item->id . '/300/200' }}"
                        alt="{{ $item->judul }}"
                        class="w-full aspect-[300/200] object-cover block hover:scale-[1.05] transition-transform duration-500"
                        loading="lazy"/>
                </a>
                <div class="min-w-0 flex-1">
                    <h5 class="cm-entry-title text-[13.5px] leading-snug font-semibold m-0 mb-1">
                        <a href="{{ route('berita.show', $item->slug) }}">{{ Str::limit($item->judul, 55) }}</a>
                    </h5>
                    <div class="cm-meta flex items-center gap-1.5 mt-1">
                        <span class="inline-flex items-center gap-1 text-[12px] text-[#888888]"><i data-lucide="calendar" class="w-4 h-4 shrink-0"></i>{{ $tglIdSb($item->created_at) }}</span>
                    </div>
                </div>
            </article>
        @empty
            <p class="text-[13px] text-[#888888]">Belum ada berita.</p>
        @endforelse
    </div>

    {{-- Organisasi otonom --}}
    <div class="mb-[35px]">
        <h4 class="cm-widget-title"><span>Organisasi Otonom</span></h4>
        <ul class="list-none m-0 p-0">
            @forelse($sbOrgs as $org)
                <li class="border-b border-[#eaeaea] last:border-b-0">
                    <a href="{{ route('organisasi-otonom.show', $org->slug) }}"
                        class="flex items-center gap-2 py-2 text-[13.5px] text-[#444444] no-underline hover:text-[#2e9e5b] cm-transition">
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-[#2e9e5b] shrink-0"></i>
                        {{ $org->nama }}
                    </a>
                </li>
            @empty
                <li class="py-2 text-[13px] text-[#888888]">Belum ada data organisasi.</li>
            @endforelse
        </ul>
    </div>

    {{-- Banner --}}
    <div class="mb-[35px]">
        <h4 class="cm-widget-title"><span>PCM Duren Sawit 1</span></h4>
        <a href="/" class="block overflow-hidden no-underline cm-card-shadow">
            <img src="{{ asset('images/logo.png') }}"
                alt="Logo PCM Duren Sawit 1"
                class="w-full object-cover block" loading="lazy"/>
        </a>
        <p class="text-center text-[12px] text-[#888888] mt-3 mb-0">Mencerahkan Semesta, Memajukan Duren Sawit.</p>
        <div class="flex gap-2 mt-3">
            <a href="{{ route('profil') }}"
                class="flex-1 text-center border border-[#2e9e5b] text-[#2e9e5b] hover:bg-[#2e9e5b] hover:text-white text-[12px] font-semibold py-2 rounded-[3px] no-underline cm-transition">Profil</a>
            <a href="{{ route('kontak') }}"
                class="flex-1 text-center bg-[#2e9e5b] hover:bg-[#268a4f] text-white text-[12px] font-semibold py-2 rounded-[3px] no-underline cm-transition">Kontak</a>
        </div>
    </div>

</aside>
