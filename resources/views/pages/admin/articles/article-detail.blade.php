<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $article->title }} — PCM Duren Sawit 1</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet" />

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .serif {
            font-family: 'DM Serif Display', serif;
        }

        /* Reading progress bar */
        #read-bar {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
            height: 2px;
            width: 0%;
            background: #c8a96e;
            transition: width .1s linear;
        }

        /* Drop cap */
        .article-body>p:first-of-type::first-letter {
            font-family: 'DM Serif Display', serif;
            font-size: 4.4em;
            line-height: .75;
            float: left;
            margin: .07em .1em -.05em 0;
            color: #c8a96e;
        }

        /* Article typography */
        .article-body p {
            margin-bottom: 1.65em;
            font-size: 1.08rem;
            line-height: 1.85;
            color: #1c1c1c;
        }

        .article-body h2 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.8rem;
            margin: 2.5em 0 .7em;
            color: #0d0d0d;
        }

        .article-body h3 {
            font-size: 1.15rem;
            font-weight: 600;
            margin: 2em 0 .5em;
            color: #0d0d0d;
        }

        .article-body blockquote {
            border-left: 2px solid #c8a96e;
            padding: 2px 0 2px 24px;
            margin: 2.2em 0;
            font-family: 'DM Serif Display', serif;
            font-style: italic;
            font-size: 1.3rem;
            line-height: 1.55;
            color: #5a5a5a;
        }

        .article-body a {
            color: #c8a96e;
            text-underline-offset: 3px;
        }

        /* Thumb zoom */
        .thumb-img {
            transition: transform 7s ease;
        }

        .thumb-wrap:hover .thumb-img {
            transform: scale(1.04);
        }

        /* Fade up animations */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .au {
            animation: fadeUp .6s cubic-bezier(.4, 0, .2, 1) both;
        }

        .d1 {
            animation-delay: .05s;
        }

        .d2 {
            animation-delay: .15s;
        }

        .d3 {
            animation-delay: .25s;
        }

        .d4 {
            animation-delay: .35s;
        }

        .d5 {
            animation-delay: .45s;
        }
    </style>
</head>

<body class="bg-[#F5F3EF]">

    {{-- Reading progress --}}
    <div id="read-bar"></div>

    @include('layouts.navigation')



    {{-- ══════════════════ HERO ══════════════════ --}}
    <div class="max-w-3xl mx-auto px-6 pt-36 pb-12">

        {{-- Eyebrow --}}
        <div class="flex items-center gap-4 mb-10 au d1">
            <span class="w-10 h-px bg-[#c8a96e] block"></span>
            <span class="text-xs font-semibold tracking-[.14em] uppercase text-[#c8a96e]">Artikel</span>
        </div>

        {{-- Title --}}
        <h1 class="serif text-[clamp(2rem,5vw,3.6rem)] leading-[1.1] text-[#0d0d0d] mb-10 au d2 tracking-tight">
            {{ $article->title }}
        </h1>

        {{-- Meta --}}
        <div class="flex flex-wrap items-center gap-6 py-5 border-t border-b border-[#e8e4dc] au d3">

            {{-- Author --}}
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-white serif text-sm flex-shrink-0"
                    style="background: linear-gradient(135deg, #c8a96e, #8b6840)">
                    {{ strtoupper(substr($article->author ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-[#0d0d0d] leading-none mb-0.5">
                        {{ $article->author ?? 'Unknown' }}</p>
                    <p class="text-xs text-[#6b6b6b]">Penulis</p>
                </div>
            </div>

            <span class="w-px h-7 bg-[#e8e4dc] block"></span>

            <p class="text-xs text-[#6b6b6b]">
                {{ $article->created_at->translatedFormat('d F Y') }}
            </p>

            @php
                $wordCount = str_word_count(strip_tags($article->content));
                $readMin = max(1, ceil($wordCount / 200));
            @endphp
            <p class="ml-auto text-xs font-semibold tracking-wider uppercase text-[#6b6b6b]">
                {{ $readMin }} menit baca
            </p>

        </div>
    </div>

    {{-- ══════════════════ THUMBNAIL ══════════════════ --}}
    <div class="max-w-5xl mx-auto px-6 mb-20 au d4">
        @if($article->thumbnail)
            <div class="thumb-wrap relative rounded-lg overflow-hidden" style="aspect-ratio:16/7">
                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                    class="thumb-img w-full h-full object-cover block" />
                <div class="absolute inset-0 pointer-events-none"
                    style="background: linear-gradient(to top, rgba(0,0,0,.18), transparent)"></div>
            </div>
        @else
            <div class="relative rounded-lg overflow-hidden bg-[#e8e4dc] flex items-center justify-center"
                style="aspect-ratio:16/7">
                <svg class="w-12 h-12 text-[#c4bfb3]" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24">
                    <rect x="3" y="3" width="18" height="18" rx="3" />
                    <path d="M3 15l5-5 4 4 3-3 6 5" />
                </svg>
            </div>
        @endif
    </div>

    {{-- ══════════════════ ARTICLE BODY ══════════════════ --}}
    <div class="max-w-2xl mx-auto px-6 mb-24 au d5">
        <div class="article-body">
            {!! nl2br(e($article->content)) !!}
        </div>
    </div>

    {{-- ══════════════════ FOOTER ══════════════════ --}}
    <div class="max-w-2xl mx-auto px-6">
        <div class="py-12 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6"
            style="border-top: 1px solid #e8e4dc">

            <a href="{{ url()->previous() }}"
                class="inline-flex items-center gap-2.5 text-sm font-semibold text-[#0d0d0d] px-6 py-3 rounded-full transition-all duration-200 hover:text-white"
                style="border: 1px solid #0d0d0d" onmouseover="this.style.background='#0d0d0d'"
                onmouseout="this.style.background='transparent'">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Artikel
            </a>

            <div>
                <p class="text-xs font-semibold tracking-[.12em] uppercase text-[#6b6b6b] mb-1">Ditulis oleh</p>
                <p class="sans text-xl text-[#0d0d0d]">{{ $article->author ?? 'Unknown' }}</p>
            </div>
        </div>

        <p class="serif text-center text-2xl pb-16 select-none" style="color:#e0dbd2">— ✦ —</p>
    </div>

    <script>
        // Reading progress bar
        window.addEventListener('scroll', function () {
            var doc = document.documentElement;
            var scroll = doc.scrollTop || document.body.scrollTop;
            var height = doc.scrollHeight - doc.clientHeight;
            document.getElementById('read-bar').style.width = (height > 0 ? (scroll / height) * 100 : 0) + '%';
        });

        // Mobile menu toggle
    </script>

</body>

</html>