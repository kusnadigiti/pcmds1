{{-- ═══════════════════════════════════════════════════════════════
     PROFILE SECTION — Cream theme, fully styled with Tailwind CSS
     ═══════════════════════════════════════════════════════════════ --}}

<div class="bg-cream py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">

            <!-- LEFT IMAGE -->
            <div class="relative">
                <div class="absolute -inset-1.5 rounded-[2rem] bg-gradient-to-br from-secondary to-primary opacity-35 z-0"></div>
                <img src="{{ $hero?->image ? asset('storage/' . $hero->image) : 'https://picsum.photos/800/600?grayscale' }}"
                    class="w-full h-full object-cover rounded-[1.75rem] relative z-10 shadow-2xl shadow-primary/20"
                    alt="Gambar Profil Organisasi">

                <!-- floating card -->
                <div class="absolute bottom-6 -right-4 bg-white py-4 px-5.5 rounded-2xl shadow-xl shadow-black/10 border-l-4 border-primary z-20 min-w-[140px]">
                    <h4 class="text-primary font-bold text-base m-0 mb-0.5">Dakwah</h4>
                    <p class="text-gray-400 text-xs m-0">Berkemajuan</p>
                </div>

                <!-- decorative dot grid -->
                <div class="absolute -top-5 -left-5 w-20 h-20 bg-[radial-gradient(circle,_#D4A017_1.5px,_transparent_1.5px)] bg-[size:12px_12px] opacity-50 z-0"></div>
            </div>

            <!-- RIGHT CONTENT -->
            <div>
                <span class="section-label section-label-green">☽ Profil Organisasi</span>

                <h2 class="text-sm font-semibold text-gray-500 mb-1">Mengenal Lebih Dekat</h2>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight text-gray-900 mb-5 tracking-tight">
                    {{ $hero->nama ?? 'Nama Organisasi' }}
                </h1>

                <p class="text-gray-600 text-base leading-relaxed mb-8">
                    {{ $hero->tagline ?? 'Tagline organisasi' }}
                </p>

                <!-- ACCORDION -->
                <div class="flex flex-col gap-3">

                    <!-- Visi -->
                    <div class="border border-primary/15 rounded-2xl overflow-hidden bg-white shadow-sm shadow-black/5">
                        <button onclick="toggleAcc('visi')"
                            class="w-full flex items-center justify-between p-5 font-semibold text-gray-900 bg-transparent border-none cursor-pointer text-left">
                            <span class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-lg bg-primary/8 flex items-center justify-center text-primary text-sm">👁</span>
                                Visi Persyarikatan
                            </span>
                            <span id="icon-visi" class="text-primary text-xl transition-transform duration-300 font-light">+</span>
                        </button>
                        <div id="visi" class="max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out px-5">
                            <p class="text-gray-700 text-sm leading-relaxed pb-4">
                                {{ $hero->visi ?? 'Visi organisasi' }}
                            </p>
                        </div>
                    </div>

                    <!-- Misi -->
                    <div class="border border-primary/15 rounded-2xl overflow-hidden bg-white shadow-sm shadow-black/5">
                        <button onclick="toggleAcc('misi')"
                            class="w-full flex items-center justify-between p-5 font-semibold text-gray-900 bg-transparent border-none cursor-pointer text-left">
                            <span class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-lg bg-secondary/10 flex items-center justify-center text-sm">🌙</span>
                                Misi Utama Kami
                            </span>
                            <span id="icon-misi" class="text-primary text-xl transition-transform duration-300 font-light">+</span>
                        </button>
                        <div id="misi" class="max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out px-5">
                            <div class="pb-4 flex flex-col gap-2">
                                @if (!empty($hero->misi ?? null))
                                    @php $misiPoints = explode("\n", $hero->misi); @endphp
                                    @foreach ($misiPoints as $point)
                                        @if (trim($point))
                                            <div class="flex items-start gap-2">
                                                <span class="text-secondary mt-0.5 text-base">✦</span>
                                                <p class="text-gray-700 text-sm leading-relaxed">{{ trim($point) }}</p>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <p class="text-gray-400 text-xs italic">Misi organisasi akan ditampilkan di sini...</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Pimpinan -->
                    <div class="border border-primary/15 rounded-2xl overflow-hidden bg-white shadow-sm shadow-black/5">
                        <button onclick="toggleAcc('pengurus')"
                            class="w-full flex items-center justify-between p-5 font-semibold text-gray-900 bg-transparent border-none cursor-pointer text-left">
                            <span class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-lg bg-accent/6 flex items-center justify-center text-sm">🏛️</span>
                                Pimpinan & Majelis
                            </span>
                            <span id="icon-pengurus" class="text-primary text-xl transition-transform duration-300 font-light">+</span>
                        </button>
                        <div id="pengurus" class="max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out px-5">
                            <div class="pb-4">
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Roda pergerakan PCM Duren Sawit 1 digerakkan secara kolektif oleh Pimpinan Cabang Muhammadiyah beserta Majelis dan Lembaga.
                                </p>
                                <a href="/struktur-organisasi"
                                    class="inline-block mt-3 text-primary font-bold text-sm no-underline transition-colors duration-200 hover:text-secondary">
                                    Lihat Struktur Organisasi →
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
