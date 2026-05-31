<section id="berita" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <!-- HEADER -->
        <div class="flex justify-between items-end mb-10">
            <div>
                <h6 class="text-emerald-600 font-bold uppercase tracking-widest flex items-center gap-2">
                    Kabar Persyarikatan
                </h6>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                    Berita & Kegiatan Terbaru
                </h2>
            </div>
            <a href="{{ route('berita.all') }}"
                class="hidden md:inline-block border border-emerald-600 text-emerald-600 px-5 py-2 rounded-full hover:bg-emerald-600 hover:text-white transition">
                Lihat Semua
            </a>
        </div>

        <!-- EMPTY STATE -->
        @if ($latestBerita->isEmpty())
            <div class="col-span-full text-center py-16 md:py-24">
                <div class="w-20 h-20 mx-auto mb-6">
                    <svg class="w-full h-full text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada berita</h3>
                <p class="text-gray-500">Berita terbaru akan muncul di sini</p>
            </div>
        @else
            <!-- GRID -->
            <div class="grid md:grid-cols-3 gap-8">
                @foreach ($latestBerita as $berita)
                    <article
                        class="group bg-white rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden h-full flex flex-col">
                        <!-- IMAGE -->
                        <div class="overflow-hidden flex-shrink-0">
                            @if ($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}"
                                    alt="{{ Str::limit($berita->judul, 60) }}"
                                    class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                    onerror="this.onerror=null; this.src='https://via.placeholder.com/400x208/f3f4f6/6b7280?text=Berita'">
                            @else
                                <div
                                    class="w-full h-52 bg-gradient-to-br from-gray-100 via-blue-50 to-emerald-50 flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
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
                            <h3
                                class="font-bold text-xl md:text-lg leading-tight mb-3 group-hover:text-emerald-600 transition-colors line-clamp-2 flex-grow">
                                <a href="{{ route('berita.show', $berita->slug) }}" class="block hover:no-underline">
                                    {{ $berita->judul }}
                                </a>
                            </h3>

                            <!-- TANGGAL -->
                            <p class="text-sm text-gray-500 mb-4 flex items-center gap-1    ">
                                <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2">
                                    </rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                {{ $berita->created_at->translatedFormat('d F Y') }}
                            </p>

                            <!-- ISI -->
                            <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-6 flex-grow">
                                {!! Str::limit(strip_tags($berita->isi), 140, '...') !!}
                            </p>

                            <!-- READ MORE -->
                            <a href="{{ route('berita.show', $berita->slug) }}"
                                class="inline-flex items-center gap-1 text-emerald-600 font-semibold hover:text-emerald-700 transition-colors group/link">
                                Baca Selengkapnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        <!-- LOAD MORE BUTTON -->
        <div class="mt-12 text-center">
            <a href="/berita/show-all"
                class="inline-block bg-emerald-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-emerald-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 md:hidden">
                Lihat Semua Berita
            </a>
        </div>
    </div>
</section>
