@extends('layouts.colormag')

@section('title', $article->title . ' — PCM Duren Sawit 1')
@section('meta_description', Str::limit(strip_tags($article->content), 150))
@section('meta_keywords', 'Artikel, PCM Duren Sawit 1, ' . ($article->author ?? 'PCM Duren Sawit 1') . ', ' . implode(', ', array_slice(explode(' ', $article->title), 0, 5)))
@section('og_type', 'article')
@section('og_image', $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('images/logo.png'))

@php
    $cmBulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $tglId = function ($date) use ($cmBulan) {
        $d = \Carbon\Carbon::parse($date);
        return $d->format('j') . ' ' . ($cmBulan[(int)$d->format('n')] ?? '') . ' ' . $d->format('Y');
    };
    $wordCount = str_word_count(strip_tags($article->content));
    $readMin = max(1, ceil($wordCount / 200));
@endphp

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Article",
  "headline": "{{ addslashes($article->title) }}",
  "image": ["{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('images/logo.png') }}"],
  "datePublished": "{{ $article->created_at ? $article->created_at->toIso8601String() : now()->toIso8601String() }}",
  "dateModified": "{{ $article->updated_at ? $article->updated_at->toIso8601String() : now()->toIso8601String() }}",
  "author": [{
      "@@type": "Person",
      "name": "{{ addslashes($article->author ?? 'PCM Duren Sawit 1') }}"
  }],
  "publisher": {
    "@@type": "Organization",
    "name": "PCM Duren Sawit 1",
    "logo": {
      "@@type": "ImageObject",
      "url": "{{ asset('images/logo.png') }}"
    }
  },
  "description": "{{ addslashes(Str::limit(strip_tags($article->content), 150)) }}"
}
</script>
@endsection

@section('styles')
    <style>
        #read-progress {
            position: fixed; top: 0; left: 0; z-index: 200;
            height: 3px; width: 0%;
            background: #2e9e5b;
            transition: width .1s linear;
            pointer-events: none;
        }

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
    </style>
@endsection

@section('content')
    <div id="read-progress"></div>

    <div class="cm-inner px-2.5">

        {{-- Breadcrumb --}}
        <nav aria-label="Breadcrumb" class="text-[12px] text-[#888888] mb-4">
            <a href="/" class="text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">Beranda</a>
            <span class="mx-1">/</span>
            <a href="{{ route('articles.show-all') }}" class="text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">Artikel &amp; Opini</a>
            <span class="mx-1">/</span> {{ Str::limit($article->title, 40) }}
        </nav>

        {{-- Kartu artikel --}}
        <article class="bg-white border border-[#eaeaea] cm-card-shadow p-5 md:p-8 mb-[30px]">
            <div class="mb-1.5">
                <span class="cm-cat-badge">Artikel</span>
            </div>

            <h1 class="text-[26px] md:text-[32px] leading-tight font-semibold text-[#333333] m-0 mb-3">
                {{ $article->title }}
            </h1>

            {{-- Meta row --}}
            <div class="flex flex-wrap items-center gap-x-5 gap-y-2 py-3 border-t border-b border-[#eeeeee] cm-meta">
                <span><i data-lucide="user"></i>{{ $article->author ?? 'Tim Redaksi' }}</span>
                <span><i data-lucide="calendar"></i>{{ $tglId($article->created_at) }}</span>
                <span><i data-lucide="clock"></i>{{ $readMin }} menit baca</span>
            </div>

            {{-- Thumbnail --}}
            @if($article->thumbnail)
                <div class="mt-5 overflow-hidden">
                    <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                        class="w-full aspect-[800/445] object-cover block"/>
                </div>
            @endif

            {{-- Isi --}}
            <div class="mt-6">
                <div class="article-content">
                    {!! nl2br(e($article->content)) !!}
                </div>
            </div>

            {{-- Footer --}}
            <div class="mt-10 pt-5 border-t border-[#eeeeee] flex flex-wrap items-center justify-between gap-4">
                <div class="text-[13px] text-[#777777]">
                    Ditulis oleh <strong class="text-[#333333]">{{ $article->author ?? 'Tim Redaksi' }}</strong>
                </div>
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center gap-1.5 text-[12px] font-bold uppercase tracking-wide text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali
                </a>
            </div>
        </article>

        {{-- Related articles --}}
        @php
            $relatedArticles = \App\Models\Article::where('status', 'published')
                ->where('id', '!=', $article->id)
                ->latest('created_at')
                ->limit(3)
                ->get();
        @endphp

        @if($relatedArticles->count() > 0)
            <section class="mb-[20px]" aria-label="Artikel terkait">
                <h3 class="cm-widget-title"><span>Artikel Terkait</span></h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-[25px]">
                    @foreach($relatedArticles as $rel)
                        <x-post-card
                            :link="route('articles.show', $rel->slug)"
                            :image="$rel->thumbnail ? asset('storage/' . $rel->thumbnail) : 'https://picsum.photos/seed/pcm-artikel-rel-' . $rel->id . '/600/360'"
                            :title="Str::limit($rel->title, 60)"
                            :date="$tglId($rel->created_at)"
                        />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        window.addEventListener('scroll', function () {
            var scrollTop = window.scrollY || document.documentElement.scrollTop;
            var docHeight = document.documentElement.scrollHeight - window.innerHeight;
            var pct = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            document.getElementById('read-progress').style.width = Math.min(pct, 100) + '%';
        });
    </script>
@endsection
