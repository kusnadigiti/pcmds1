<section id="berita" class="bg-bone py-24 relative">
    <div class="max-w-7xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="flex justify-between items-end mb-10">
            <div>
                <span class="section-label section-label-dark">Kabar Terkini</span>
                <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl leading-[1.15] text-gray-900">
                    Berita &amp; Kegiatan
                </h2>
            </div>
            <a href="{{ route('berita.all') }}"
                class="hidden md:inline-flex items-center gap-1.5 border border-gray-300 text-gray-600 py-2 px-5 rounded-lg font-semibold text-xs no-underline transition duration-200 hover:border-gray-900 hover:text-gray-900">
                Lihat Semua
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        {{-- EMPTY STATE --}}
        @if ($latestBerita->isEmpty())
            <div class="text-center py-20">
                <i data-lucide="newspaper" class="w-12 h-12 text-gray-300 mx-auto mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Belum ada berita</h3>
                <p class="text-gray-400 text-sm">Berita terbaru akan muncul di sini.</p>
            </div>
        @else
            <div class="grid md:grid-cols-3 gap-5">
                @foreach ($latestBerita as $berita)
                    <article class="group bg-white rounded-xl border border-gray-100 overflow-hidden flex flex-col transition duration-200 hover:shadow-lg hover:shadow-black/5 hover:border-gray-200">

                        <div class="overflow-hidden">
                            @if ($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}"
                                    alt="{{ Str::limit($berita->judul, 60) }}"
                                    class="w-full h-[180px] object-cover transition-transform duration-500 group-hover:scale-105"
                                    loading="lazy">
                            @else
                                <div class="w-full h-[180px] bg-gray-100 flex items-center justify-center">
                                    <i data-lucide="landmark" class="w-10 h-10 text-gray-300"></i>
                                </div>
                            @endif
                        </div>

                        <div class="p-5 flex flex-col flex-grow">
                            @php
                                $kategoriColors = [
                                    'dakwah' => 'bg-amber-50 text-amber-700',
                                    'sosial' => 'bg-sky-50 text-sky-700',
                                    'organisasi' => 'bg-indigo-50 text-indigo-700',
                                    'pendidikan' => 'bg-emerald-50 text-emerald-700',
                                    'kesehatan' => 'bg-purple-50 text-purple-700',
                                    'ekonomi' => 'bg-orange-50 text-orange-700',
                                    'default' => 'bg-gray-50 text-gray-600',
                                ];
                                $kategoriKey = strtolower($berita->kategori ?? 'default');
                                $kategoriClass = $kategoriColors[$kategoriKey] ?? $kategoriColors['default'];
                            @endphp

                            <span class="{{ $kategoriClass }} text-[10px] font-semibold px-2.5 py-0.5 rounded-full inline-block mb-3 max-w-max uppercase tracking-wider">
                                {{ ucwords(str_replace('_', ' ', $berita->kategori ?? 'Umum')) }}
                            </span>

                            <h3 class="font-bold text-lg leading-snug mb-2 flex-grow">
                                <a href="{{ route('berita.show', $berita->slug) }}" class="block text-gray-900 no-underline hover:text-primary transition-colors duration-200">
                                    {{ $berita->judul }}
                                </a>
                            </h3>

                            <p class="text-xs text-gray-400 mb-3 flex items-center gap-1">
                                <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                {{ $berita->created_at->translatedFormat('d F Y') }}
                            </p>

                            <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-4">
                                {!! Str::limit(strip_tags($berita->isi), 140, '...') !!}
                            </p>

                            <a href="{{ route('berita.show', $berita->slug) }}"
                                class="inline-flex items-center gap-1 text-primary font-semibold text-sm hover:text-primary-light transition-colors no-underline">
                                Baca Selengkapnya
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 transition-transform group-hover/link:translate-x-1"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        <div class="mt-8 text-center md:hidden">
            <a href="/berita/show-all"
                class="inline-flex items-center gap-1.5 border border-gray-300 text-gray-600 py-2.5 px-6 rounded-lg font-semibold text-sm no-underline transition duration-200 hover:border-gray-900 hover:text-gray-900">
                Lihat Semua Berita
            </a>
        </div>
    </div>
</section>
