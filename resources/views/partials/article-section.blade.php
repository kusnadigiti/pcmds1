{{-- ═══════════════════════════════════════════════════════════════
ARTIKEL SECTION — Dark Islamic theme, fully styled with Tailwind CSS
═══════════════════════════════════════════════════════════════ --}}

<section id="artikel" class="bg-gradient-to-b from-accent-green to-accent py-20 relative overflow-hidden">
    {{-- Background pattern --}}
    <div class="islamic-pattern absolute inset-0 opacity-40 pointer-events-none"></div>
    <div
        class="absolute -top-[100px] -right-[100px] w-[400px] h-[400px] rounded-full border border-secondary/10 pointer-events-none">
    </div>

    <div class="container mx-auto px-6 lg:px-16 relative z-10">
        <div class="max-w-7xl mx-auto">

            <!-- HEADER -->
            <div class="mb-14">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div>
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight text-white m-0">
                            Artikel <span class="text-shimmer">Terbaru</span>
                        </h2>
                    </div>
                    <div class="max-w-md">
                        <p class="text-white/60 text-sm leading-relaxed mb-2">
                            Berbagai artikel, pembelajaran, dan nilai-nilai Islami yang kami bagikan sebagai sumber
                            inspirasi dan penguatan iman
                        </p>
                        <span class="text-xs text-secondary/70 font-medium">
                            {{ $totalArticlesCount ?? $articles->count() }} Artikel Diterbitkan
                        </span>
                    </div>
                </div>
            </div>

            <!-- ARTICLE LIST -->
            @if ($articles->count() > 0)
                <div class="flex flex-col gap-4">
                    @foreach ($articles as $article)
                            <a href="{{ route('articles.show', $article->slug) }}" class="group block no-underline">
                                <div
                                    class="bg-white/5 border border-secondary/15 rounded-2xl overflow-hidden grid lg:grid-cols-12 transition-all duration-300 hover:bg-white/10 hover:border-secondary/35 hover:-translate-y-1">

                                    <!-- IMAGE -->
                                    <div class="overflow-hidden lg:col-span-4 h-52 lg:h-auto">
                                        <img src="{{ $article->thumbnail
                        ? asset('storage/' . $article->thumbnail)
                        : 'https://picsum.photos/600/400?random=' . $article->id }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                            alt="{{ $article->title }}">
                                    </div>

                                    <!-- CONTENT -->
                                    <div class="p-7 flex flex-col justify-center gap-3 lg:col-span-8">
                                        <span class="text-xs text-secondary/70 font-semibold tracking-wider uppercase">
                                            {{ $article->author ?? 'Tim Redaksi' }}
                                        </span>
                                        <h3
                                            class="text-xl font-bold text-white leading-snug m-0 transition-colors duration-200 group-hover:text-secondary">
                                            {{ $article->title }}
                                        </h3>
                                        <p class="text-white/55 text-sm leading-relaxed line-clamp-2">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}
                                        </p>
                                        <div class="inline-flex items-center gap-1.5 text-secondary text-xs font-bold mt-1">
                                            Baca Selengkapnya
                                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 transition-transform group-hover:translate-x-1"></i>
                                        </div>
                                    </div>

                                </div>
                            </a>
                    @endforeach
                </div>
            @endif

            <!-- BUTTON -->
            <div class="mt-12 text-center">
                <a href="{{ route('articles.show-all') }}"
                    class="inline-flex items-center gap-2 border-2 border-secondary/40 text-secondary font-bold text-sm py-3 px-8 rounded-full no-underline transition-all duration-200 hover:bg-secondary/10 hover:border-secondary/70">
                    Lihat Semua Artikel
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

        </div>
    </div>
</section>