<div class="bg-cream py-24 relative">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- LEFT IMAGE --}}
            <div class="relative">
                <img src="{{ $hero?->image ? asset('storage/' . $hero->image) : 'https://picsum.photos/800/600?grayscale' }}"
                    class="w-full h-[420px] object-cover rounded-2xl shadow-xl shadow-black/10"
                    alt="Gambar Profil Organisasi">
            </div>

            {{-- RIGHT CONTENT --}}
            <div>
                <span class="section-label section-label-dark">Mengenal Lebih Dekat</span>
                <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl leading-[1.15] text-gray-900 mb-5">
                    {{ $hero->nama ?? 'Nama Organisasi' }}
                </h1>

                <p class="text-gray-500 text-base leading-relaxed mb-8">
                    {{ $hero->tagline ?? 'Tagline organisasi' }}
                </p>

                {{-- ACCORDION --}}
                <div class="flex flex-col gap-2">

                    {{-- Visi --}}
                    <div class="border border-gray-200 rounded-xl overflow-hidden bg-white">
                        <button onclick="toggleAcc('visi')"
                            class="w-full flex items-center justify-between p-5 font-semibold text-gray-900 bg-transparent border-none cursor-pointer text-left">
                            <span class="flex items-center gap-3">
                                <i data-lucide="eye" class="w-4 h-4 text-primary"></i>
                                Visi Persyarikatan
                            </span>
                            <span id="icon-visi"
                                class="text-gray-400 text-lg transition-transform duration-300">+</span>
                        </button>
                        <div id="visi"
                            class="max-h-0 opacity-0 overflow-hidden transition-all duration-400 ease-in-out px-5">
                            <p class="text-gray-600 text-sm leading-relaxed pb-5">
                                {{ $hero->visi ?? 'Visi organisasi' }}
                            </p>
                        </div>
                    </div>

                    {{-- Misi --}}
                    <div class="border border-gray-200 rounded-xl overflow-hidden bg-white">
                        <button onclick="toggleAcc('misi')"
                            class="w-full flex items-center justify-between p-5 font-semibold text-gray-900 bg-transparent border-none cursor-pointer text-left">
                            <span class="flex items-center gap-3">
                                <i data-lucide="moon" class="w-4 h-4 text-secondary"></i>
                                Misi Utama Kami
                            </span>
                            <span id="icon-misi"
                                class="text-gray-400 text-lg transition-transform duration-300">+</span>
                        </button>
                        <div id="misi"
                            class="max-h-0 opacity-0 overflow-hidden transition-all duration-400 ease-in-out px-5">
                            <div class="pb-5 flex flex-col gap-2">
                                @if (!empty($hero->misi ?? null))
                                    @php $misiPoints = explode("\n", $hero->misi); @endphp
                                    @foreach ($misiPoints as $point)
                                        @if (trim($point))
                                            <div class="flex items-start gap-2.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-primary mt-2 shrink-0"></span>
                                                <p class="text-gray-600 text-sm leading-relaxed">{{ trim($point) }}</p>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <p class="text-gray-400 text-xs italic">Misi organisasi akan ditampilkan di sini...</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Pimpinan --}}
                    <div class="border border-gray-200 rounded-xl overflow-hidden bg-white">
                        <button onclick="toggleAcc('pengurus')"
                            class="w-full flex items-center justify-between p-5 font-semibold text-gray-900 bg-transparent border-none cursor-pointer text-left">
                            <span class="flex items-center gap-3">
                                <i data-lucide="landmark" class="w-4 h-4 text-primary"></i>
                                Pimpinan &amp; Majelis
                            </span>
                            <span id="icon-pengurus"
                                class="text-gray-400 text-lg transition-transform duration-300">+</span>
                        </button>
                        <div id="pengurus"
                            class="max-h-0 opacity-0 overflow-hidden transition-all duration-400 ease-in-out px-5">
                            <div class="pb-5">
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Roda pergerakan PCM Duren Sawit 1 digerakkan secara kolektif oleh Pimpinan Cabang
                                    Muhammadiyah beserta Majelis dan Lembaga.
                                </p>
                                <a href="/struktur-organisasi"
                                    class="inline-block mt-3 text-primary font-semibold text-sm no-underline transition-colors duration-200 hover:text-primary-light">
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
