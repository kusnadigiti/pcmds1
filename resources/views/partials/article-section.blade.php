<section id="artikel" class="bg-accent-green py-24 relative">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="mb-14">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                <div>
                    <span class="section-label section-label-light">Tulisan &amp; Opini</span>
                    <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl leading-[1.15] text-white">
                        Artikel Terbaru
                    </h2>
                </div>
                <div class="max-w-md">
                    <p class="text-white/50 text-sm leading-relaxed mb-2">
                        Berbagai artikel, pembelajaran, dan nilai-nilai Islami yang kami bagikan sebagai sumber
                        inspirasi dan penguatan iman.
                    </p>
                    <span class="text-xs text-white/30 font-medium">
                        {{ $totalArticlesCount ?? $articles->count() }} Artikel Diterbitkan
                    </span>
                </div>
            </div>
        </div>

        {{-- ARTICLE LIST --}}
        @if ($articles->count() > 0)
            <div class="flex flex-col gap-3">
                @foreach ($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}" class="group block no-underline">
                        <div class="bg-white/5 border border-white/10 rounded-xl overflow-hidden grid lg:grid-cols-12 transition-all duration-200 hover:bg-white/8 hover:border-white/20">

                            {{-- IMAGE --}}
                            <div class="overflow-hidden lg:col-span-4 h-48 lg:h-auto">
                                <img src="{{ $article->thumbnail
                                    ? asset('storage/' . $article->thumbnail)
                                    : 'https://picsum.photos/600/400?random=' . $article->id }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    alt="{{ $article->title }}">
                            </div>

                            {{-- CONTENT --}}
                            <div class="p-7 flex flex-col justify-center gap-2.5 lg:col-span-8">
                                <span class="text-[11px] text-white/40 font-semibold tracking-wider uppercase">
                                    {{ $article->author ?? 'Tim Redaksi' }}
                                </span>
                                <h3 class="font-display text-xl text-white leading-snug m-0 transition-colors duration-200 group-hover:text-secondary">
                                    {{ $article->title }}
                                </h3>
                                <p class="text-white/45 text-sm leading-relaxed line-clamp-2">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}
                                </p>
                                <div class="inline-flex items-center gap-1.5 text-secondary text-xs font-semibold mt-1">
                                    Baca Selengkapnya
                                    <i data-lucide="arrow-right" class="w-3.5 h-3.5 transition-transform group-hover:translate-x-1"></i>
                                </div>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        {{-- BUTTON --}}
        <div class="mt-12">
            <a href="{{ route('articles.show-all') }}"
                class="inline-flex items-center gap-2 border border-white/20 text-white font-semibold text-sm py-2.5 px-6 rounded-lg no-underline transition-all duration-200 hover:bg-white/10 hover:border-white/40">
                Lihat Semua Artikel
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

    </div>
</section>
