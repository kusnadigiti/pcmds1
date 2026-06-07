{{-- ═══════════════════════════════════════════════════════════════
     BERITA SECTION — Cream theme, fully styled with Tailwind CSS
     ═══════════════════════════════════════════════════════════════ --}}

<section id="berita" class="bg-cream py-20 relative overflow-hidden">
    {{-- Background pattern --}}
    <div class="islamic-pattern absolute inset-0 opacity-[0.35] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <!-- HEADER -->
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight m-0">
                    Berita &amp; Kegiatan <span class="text-primary">Terbaru</span>
                </h2>
            </div>
            <a href="{{ route('berita.all') }}"
                class="hidden md:inline-block border-2 border-primary text-primary py-2 px-5 rounded-full font-bold text-xs no-underline transition duration-200 hover:bg-primary hover:text-white">
                Lihat Semua
            </a>
        </div>

        <!-- EMPTY STATE -->
        @if ($latestBerita->isEmpty())
            <div class="col-span-full text-center py-16 md:py-24">
                <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                    <i data-lucide="newspaper" class="w-16 h-16 text-gray-300"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada berita</h3>
                <p class="text-gray-500">Berita terbaru akan muncul di sini</p>
            </div>
        @else
            <div class="grid md:grid-cols-3 gap-6">
                @foreach ($latestBerita as $berita)
                    <article class="group bg-white rounded-2xl shadow-lg shadow-primary/5 border border-primary/10 overflow-hidden flex flex-col transition duration-300 hover:bg-primary/5 hover:border-primary/25 hover:-translate-y-1">
                        <div class="overflow-hidden flex-shrink-0">
                            @if ($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}"
                                    alt="{{ Str::limit($berita->judul, 60) }}"
                                    class="w-full h-[200px] object-cover transition-transform duration-500 group-hover:scale-105"
                                    loading="lazy">
                            @else
                                <div class="w-full h-[200px] bg-gradient-to-br from-primary/10 to-secondary/10 flex items-center justify-center">
                                    <i data-lucide="landmark" class="w-12 h-12 text-primary opacity-40"></i>
                                </div>
                            @endif
                        </div>

                        <!-- CONTENT -->
                        <div class="p-6 flex flex-col flex-grow">
                            <!-- KATEGORI (Menggunakan Enum) -->
                            @php
                                $kategoriColors = [
                                    'dakwah' => ['bg-amber-100', 'text-amber-800'],
                                    'sosial' => ['bg-sky-100', 'text-sky-800'],
                                    'organisasi' => ['bg-indigo-100', 'text-indigo-800'],
                                    'pendidikan' => ['bg-emerald-100', 'text-emerald-800'],
                                    'kesehatan' => ['bg-purple-100', 'text-purple-800'],
                                    'ekonomi' => ['bg-orange-100', 'text-orange-800'],
                                    'default' => ['bg-gray-100', 'text-gray-700'],
                                ];

                                $kategoriKey = strtolower($berita->kategori ?? 'default');
                                $colors = $kategoriColors[$kategoriKey] ?? $kategoriColors['default'];
                            @endphp

                            <span
                                class="{{ $colors[0] }} {{ $colors[1] }} text-xs font-medium px-3 py-1 rounded-full inline-block mb-3 max-w-max">
                                {{ ucwords(str_replace('_', ' ', $berita->kategori ?? 'Umum')) }}
                            </span>

                            <!-- JUDUL -->
                            <h3 class="font-bold text-xl md:text-lg leading-tight mb-3 group-hover:text-primary transition-colors duration-200 line-clamp-2 flex-grow">
                                <a href="{{ route('berita.show', $berita->slug) }}" class="block hover:no-underline text-gray-900 group-hover:text-primary">
                                    {{ $berita->judul }}
                                </a>
                            </h3>

                            <!-- TANGGAL -->
                            <p class="text-sm text-gray-500 mb-4 flex items-center gap-1">
                                <i data-lucide="calendar" class="w-4 h-4 text-gray-400 flex-shrink-0"></i>
                                {{ $berita->created_at->translatedFormat('d F Y') }}
                            </p>

                            <!-- ISI -->
                            <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-6 flex-grow">
                                {!! Str::limit(strip_tags($berita->isi), 140, '...') !!}
                            </p>

                            <!-- READ MORE -->
                            <a href="{{ route('berita.show', $berita->slug) }}"
                                class="inline-flex items-center gap-1 text-primary font-semibold hover:text-primary-light transition-colors group/link no-underline">
                                Baca Selengkapnya
                                <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-200 group-hover/link:translate-x-1"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        <!-- LOAD MORE BUTTON -->
        <div class="mt-10 text-center">
            <a href="/berita/show-all"
                class="md:hidden inline-block bg-gradient-to-r from-primary to-primary-light text-white py-3 px-8 rounded-full font-bold text-sm no-underline shadow-lg shadow-primary/20 transition duration-200 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30">
                Lihat Semua Berita
            </a>
        </div>
    </div>
</section>
