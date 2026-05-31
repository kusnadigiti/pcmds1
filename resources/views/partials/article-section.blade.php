<section class="bg-neutral-50 py-32" id="media">
    <div class="container mx-auto px-6 lg:px-16">
        <div class="max-w-7xl mx-auto">

            <!-- HEADER -->
            <div class="mb-16">
                <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                    <h2 class="text-5xl font-light leading-tight">
                        Artikel <br>
                        <span class="font-medium">Terbaru</span>
                    </h2>

                    <div class="max-w-md">
                        <p class="text-neutral-600">
                            Berbagai artikel, pembelajaran, dan nilai-nilai Islami yang kami bagikan sebagai sumber
                            inspirasi dan penguatan iman
                        </p>
                        <span class="text-sm text-neutral-500">
                            {{ $articles->count() }} Articles Published
                        </span>
                    </div>
                </div>
            </div>

            <!-- HORIZONTAL SCROLL -->
            @if ($articles->count() > 0)
                <div class="space-y-6">

                    @foreach ($articles->take(3) as $article)
                        <a href="{{ route('articles.show', $article->slug) }}" class="group block">

                            <div
                                class="grid lg:grid-cols-12 gap-6 bg-white rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-500">

                                <!-- IMAGE -->
                                <div class="lg:col-span-4 h-56 overflow-hidden">
                                    <img src="{{ $article->thumbnail
                                        ? asset('storage/' . $article->thumbnail)
                                        : 'https://picsum.photos/600/400?random=' . $article->id }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                </div>

                                <!-- CONTENT -->
                                <div class="lg:col-span-8 p-6 flex flex-col justify-center space-y-4">

                                    <span class="text-sm text-neutral-500">
                                        {{ $article->author ?? 'Unknown' }}
                                    </span>

                                    <h3
                                        class="text-2xl font-medium text-neutral-900 group-hover:text-neutral-600 transition">
                                        {{ $article->title }}
                                    </h3>

                                    <p class="text-neutral-600 line-clamp-2">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}
                                    </p>

                                    <div class="flex items-center gap-2 text-sm font-medium">
                                        Read More →
                                    </div>

                                </div>

                            </div>
                        </a>
                    @endforeach

                </div>
            @endif

            <!-- BUTTON -->
            <div class="mt-16">
                <a href="{{ route('articles.show-all') }}"
                    class="inline-flex items-center gap-2 border border-neutral-900 px-8 py-3 rounded-full hover:bg-neutral-900 hover:text-white transition">
                    Lihat Semua Artikel →
                </a>
            </div>

        </div>
    </div>
</section>
