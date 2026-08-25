@extends('layouts.colormag')

@section('title', $berita->judul . ' — PCM Duren Sawit 1')

@section('meta_description', Str::limit(strip_tags($berita->isi), 150))
@section('meta_keywords', 'Berita, PCM Duren Sawit 1, ' . ($berita->kategori ?? 'Umum') . ', ' . implode(', ', array_slice(explode(' ', $berita->judul), 0, 5)))
@section('og_type', 'article')
@section('og_image', $berita->gambar ? asset('storage/' . $berita->gambar) : asset('images/logo.png'))

@php
    $cmBulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $tglId = function ($date) use ($cmBulan) {
        $d = \Carbon\Carbon::parse($date);
        return $d->format('j') . ' ' . ($cmBulan[(int)$d->format('n')] ?? '') . ' ' . $d->format('Y');
    };
    $wc = str_word_count(strip_tags($berita->isi));
    $rm = max(1, ceil($wc / 200));
@endphp

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "NewsArticle",
  "headline": "{{ addslashes($berita->judul) }}",
  "image": ["{{ $berita->gambar ? asset('storage/' . $berita->gambar) : asset('images/logo.png') }}"],
  "datePublished": "{{ $berita->created_at ? $berita->created_at->toIso8601String() : now()->toIso8601String() }}",
  "dateModified": "{{ $berita->updated_at ? $berita->updated_at->toIso8601String() : now()->toIso8601String() }}",
  "author": [{
      "@@type": "Organization",
      "name": "PCM Duren Sawit 1",
      "url": "{{ url('/') }}"
  }],
  "publisher": {
    "@@type": "Organization",
    "name": "PCM Duren Sawit 1",
    "logo": {
      "@@type": "ImageObject",
      "url": "{{ asset('images/logo.png') }}"
    }
  },
  "description": "{{ addslashes(Str::limit(strip_tags($berita->isi), 150)) }}"
}
</script>
@endsection

@section('styles')
    <style>
        /* Progress bar baca (aksen hijau ColorMag) */
        #read-progress {
            position: fixed; top: 0; left: 0; z-index: 200;
            height: 3px; width: 0%;
            background: #2e9e5b;
            transition: width .1s linear;
            pointer-events: none;
        }

        /* Tipografi isi artikel */
        .article-content > p:first-child::first-letter {
            font-size: 3.6rem; font-weight: 700;
            float: left; line-height: .82;
            margin: .08em .12em 0 0;
            color: #2e9e5b;
        }
        .article-content p {
            font-size: 16px; line-height: 1.7;
            color: #444444; margin-bottom: 1.5rem;
        }
        .article-content h2 {
            font-size: 24px; font-weight: 600; line-height: 1.25;
            color: #333333; margin: 2.2rem 0 .9rem;
        }
        .article-content h3 {
            font-size: 18px; font-weight: 600;
            color: #333333; margin: 1.8rem 0 .7rem;
        }
        .article-content ul, .article-content ol { margin: 0 0 1.5rem 1.5rem; }
        .article-content li {
            font-size: 15px; line-height: 1.7;
            color: #444444; margin-bottom: .35rem;
        }
        .article-content blockquote {
            margin: 2rem 0; padding: 1.2rem 1.6rem;
            border-left: 3px solid #2e9e5b;
            background: #f8f8f8;
        }
        .article-content blockquote p::first-letter { all: unset; }
        .article-content a { color: #2e9e5b; text-decoration: underline; text-underline-offset: 3px; }
        .article-content strong { font-weight: 700; color: #333333; }
        .article-content img { max-width: 100%; height: auto; margin: 1.4rem 0; }

        .toc-item a { color: #555555; display: block; padding: 3px 0; text-decoration: none; font-size: 13px; }
        .toc-item a:hover, .toc-item a.active { color: #2e9e5b; }
    </style>
@endsection

@section('content')
    <div id="read-progress"></div>

    <div class="cm-inner px-2.5">

        {{-- Breadcrumb --}}
        <nav aria-label="Breadcrumb" class="text-[12px] text-[#888888] mb-4">
            <a href="/" class="text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">Beranda</a>
            <span class="mx-1">/</span>
            <a href="{{ route('berita.all') }}" class="text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">Berita</a>
            <span class="mx-1">/</span> {{ Str::limit($berita->judul, 40) }}
        </nav>

        {{-- Kartu artikel single post --}}
        <article class="bg-white border border-[#eaeaea] cm-card-shadow p-5 md:p-8 mb-[30px]">
            <div class="mb-1.5">
                <span class="cm-cat-badge">{{ ucfirst($berita->kategori ?? 'Umum') }}</span>
            </div>

            <h1 class="text-[26px] md:text-[32px] leading-tight font-semibold text-[#333333] m-0 mb-3">
                {{ $berita->judul }}
            </h1>

            {{-- Meta row --}}
            <div class="flex flex-wrap items-center gap-x-5 gap-y-2 py-3 border-t border-b border-[#eeeeee] cm-meta">
                <span><i data-lucide="user"></i>PCM Duren Sawit 1</span>
                <span><i data-lucide="calendar"></i>{{ $tglId($berita->created_at) }}</span>
                <span><i data-lucide="clock"></i>{{ $rm }} menit baca</span>
                <span><i data-lucide="type"></i>{{ number_format($wc) }} kata</span>
            </div>

            {{-- Gambar utama --}}
            @if($berita->gambar)
                <div class="mt-5 overflow-hidden">
                    <img src="{{ $berita->gambar }}" alt="{{ $berita->judul }}" class="w-full aspect-[800/445] object-cover block"/>
                </div>
            @endif

            {{-- Isi --}}
            <div class="mt-6">
                <div class="article-content" id="article-content">
                    {!! $berita->isi !!}
                </div>
            </div>

            {{-- Footer share/back --}}
            <div class="mt-10 pt-5 border-t border-[#eeeeee] flex flex-wrap items-center justify-between gap-4">
                <button onclick="copyLink()" id="copy-btn"
                    class="inline-flex items-center gap-1.5 text-[12px] font-bold uppercase tracking-wide text-[#888888] hover:text-[#2e9e5b] bg-transparent border-0 cursor-pointer cm-transition">
                    <i data-lucide="link" class="w-3.5 h-3.5"></i> Salin Tautan
                </button>
                <a href="{{ route('berita.all') }}"
                    class="inline-flex items-center gap-1.5 text-[12px] font-bold uppercase tracking-wide text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali ke Berita
                </a>
            </div>
        </article>

        {{-- Related posts bawah --}}
        @php
            $related = \App\Models\Berita::where('status', 'published')
                ->where('id', '!=', $berita->id)
                ->where('kategori', $berita->kategori)
                ->latest()
                ->limit(3)
                ->get();
            if ($related->count() < 2) {
                $related = \App\Models\Berita::where('status', 'published')
                    ->where('id', '!=', $berita->id)
                    ->latest()
                    ->limit(3)
                    ->get();
            }
        @endphp

        @if($related->count() > 0)
            <section class="mb-[20px]" aria-label="Berita terkait">
                <h3 class="cm-widget-title"><span>Berita Terkait</span></h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-[25px]">
                    @foreach($related as $rel)
                        <article class="border border-[#eaeaea] cm-card-shadow">
                            <a href="{{ route('berita.show', $rel->slug) }}" class="block overflow-hidden no-underline">
                                <img src="{{ $rel->gambar ? asset('storage/' . $rel->gambar) : 'https://picsum.photos/seed/pcm-rel-' . $rel->id . '/600/360' }}"
                                    alt="{{ $rel->judul }}"
                                    class="w-full aspect-[600/360] object-cover block hover:scale-[1.04] transition-transform duration-500"
                                    loading="lazy"/>
                            </a>
                            <div class="p-4 pt-3">
                                <h4 class="cm-entry-title text-[14.5px] leading-snug font-semibold m-0 mb-1">
                                    <a href="{{ route('berita.show', $rel->slug) }}">{{ Str::limit($rel->judul, 60) }}</a>
                                </h4>
                                <div class="cm-meta">
                                    <span><i data-lucide="calendar"></i>{{ $tglId($rel->created_at) }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        // ── Reading progress bar ──
        window.addEventListener('scroll', function () {
            var scrollTop = window.scrollY || document.documentElement.scrollTop;
            var docHeight = document.documentElement.scrollHeight - window.innerHeight;
            var pct = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            document.getElementById('read-progress').style.width = Math.min(pct, 100) + '%';
        });

        // ── Salin tautan ──
        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(function () {
                var btn = document.getElementById('copy-btn');
                var old = btn.innerHTML;
                btn.innerHTML = '<i data-lucide="check" class="w-3.5 h-3.5"></i> Tersalin';
                if (window.lucide) lucide.createIcons();
                setTimeout(function () { btn.innerHTML = old; if (window.lucide) lucide.createIcons(); }, 2000);
            });
        }
    </script>
@endsection
