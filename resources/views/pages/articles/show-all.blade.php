@extends('layouts.colormag')

@section('title', 'Daftar Artikel & Opini — PCM Duren Sawit 1')
@section('meta_description', 'Kumpulan artikel, tulisan, dan kajian ilmiah populer Pimpinan Cabang Muhammadiyah Duren Sawit 1.')
@section('meta_keywords', 'Artikel Muhammadiyah, Kajian Islam, Opini Muhammadiyah, PCM Duren Sawit 1, Duren Sawit')
@section('og_image', asset('images/logo.png'))

@php
    $cmBulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $tglId = function ($date) use ($cmBulan) {
        $d = \Carbon\Carbon::parse($date);
        return $d->format('j') . ' ' . ($cmBulan[(int)$d->format('n')] ?? '') . ' ' . $d->format('Y');
    };
@endphp

@section('content')
    <div class="cm-inner px-2.5">

        {{-- Breadcrumb --}}
        <nav aria-label="Breadcrumb" class="text-[12px] text-[#888888] mb-4">
            <a href="/" class="text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">Beranda</a>
            <span class="mx-1">/</span> Artikel &amp; Opini
        </nav>

        {{-- Header widget --}}
        <h1 class="cm-widget-title !text-[22px]"><span>Artikel &amp; Opini</span></h1>
        <p class="text-[13px] text-[#777777] mt-[-6px] mb-[25px]">
            Inspirasi dan nilai-nilai Islami untuk memperkuat iman dan wawasan.
        </p>

        <div class="grid grid-cols-1 lg:grid-cols-[70.17%_1fr] gap-[30px] items-start pb-5">

            {{-- ══ PRIMARY ══ --}}
            <div class="min-w-0">

                @if($articles->count() > 0)

                    @php $featured = $articles->first(); @endphp

                    {{-- Featured post --}}
                    @if($articles->currentPage() == 1)
                        <article class="mb-[35px] cm-card-shadow border border-[#eaeaea]">
                            <a href="{{ route('articles.show', $featured->slug) }}" class="block overflow-hidden no-underline">
                                <img src="{{ $featured->thumbnail ? asset('storage/' . $featured->thumbnail) : 'https://picsum.photos/seed/pcm-artikel-feat-' . $featured->id . '/800/445' }}"
                                    alt="{{ $featured->title }}"
                                    class="w-full aspect-[800/445] object-cover block hover:scale-[1.02] transition-transform duration-500"/>
                            </a>
                            <div class="p-5 pt-3.5">
                                <div class="mb-1.5">
                                    <span class="cm-cat-badge">Terbaru</span>
                                </div>
                                <h2 class="cm-entry-title text-[22px] leading-snug font-semibold m-0">
                                    <a href="{{ route('articles.show', $featured->slug) }}">{{ $featured->title }}</a>
                                </h2>
                                <div class="cm-meta mt-1.5">
                                    <span><i data-lucide="user"></i>{{ $featured->author ?? 'Tim Redaksi' }}</span>
                                    <span class="ml-3"><i data-lucide="calendar"></i>{{ $tglId($featured->created_at) }}</span>
                                </div>
                                <p class="text-[14px] text-[#444444] leading-relaxed mt-2 mb-3 line-clamp-3">
                                    {{ Str::limit(strip_tags($featured->content), 160) }}
                                </p>
                                <a href="{{ route('articles.show', $featured->slug) }}"
                                    class="inline-flex items-center gap-1 text-[12px] font-bold uppercase tracking-wide text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">
                                    Baca Selengkapnya <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                </a>
                            </div>
                        </article>

                        <h3 class="cm-widget-title"><span>Artikel Lainnya</span></h3>
                    @endif

                    {{-- Grid artikel --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-[25px] mb-[35px]">
                        @foreach($articles->currentPage() == 1 ? $articles->skip(1) : $articles as $article)
                            <x-post-card
                                :link="route('articles.show', $article->slug)"
                                :image="$article->thumbnail ? asset('storage/' . $article->thumbnail) : 'https://picsum.photos/seed/pcm-duren-sawit-artikel-' . $article->id . '/600/360'"
                                :title="$article->title"
                                category="Artikel"
                                :author="$article->author ?? 'Tim Redaksi'"
                                :date="$tglId($article->created_at)"
                                :excerpt="Str::limit(strip_tags($article->content), 120)"
                            />
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="flex justify-center">
                        {{ $articles->links('partials.pagination') }}
                    </div>

                @else
                    <div class="text-center py-20 border border-[#eaeaea] bg-white">
                        <i data-lucide="file-text" class="w-12 h-12 mx-auto text-[#cccccc]"></i>
                        <p class="text-[14px] text-[#777777] mt-4">Belum ada artikel yang dipublikasikan.</p>
                    </div>
                @endif

            </div>

            {{-- ══ SIDEBAR ══ --}}
            @include('partials.cm-sidebar')

        </div>
    </div>
@endsection
