<header id="hero-header" class="relative overflow-hidden bg-accent-green">

    @if(isset($heroSections) && $heroSections->count() > 0)

        <div id="hero-slider-wrap" class="relative">
            <div id="hero-track" class="relative">
                @foreach($heroSections as $index => $hero)
                    <div class="hero-slide" data-index="{{ $index }}" style="display:{{ $index === 0 ? 'block' : 'none' }};">
                        <div class="text-white relative overflow-hidden min-h-[540px] flex items-center">

                            @if($hero->image)
                                <div class="absolute inset-0 bg-cover bg-center opacity-20"
                                    style="background-image:url('{{ asset('storage/' . $hero->image) }}');"></div>
                                <div class="absolute inset-0 bg-gradient-to-r from-accent-green via-accent-green/95 to-accent-green/70"></div>
                            @endif

                            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-24 relative z-10 w-full">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                                    {{-- LEFT --}}
                                    <div class="animate-fadeUp">

                                        @if($hero->tagline)
                                            <span class="section-label section-label-light">{{ $hero->tagline }}</span>
                                        @endif

                                        <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl leading-[1.1] mb-6 text-white">
                                            {{ $hero->title }}
                                        </h1>

                                        @if($hero->description)
                                            <p class="text-white/60 text-base leading-relaxed mb-10 max-w-lg">
                                                {{ $hero->description }}
                                            </p>
                                        @endif

                                        <div class="flex flex-col sm:flex-row gap-4">
                                            <a href="#layanan"
                                                class="bg-secondary text-accent font-bold py-3 px-7 rounded-lg text-sm no-underline transition duration-200 hover:bg-secondary-light">
                                                Kenali Program Kami
                                            </a>
                                            <a href="#kontak"
                                                class="border border-white/20 text-white font-semibold py-3 px-7 rounded-lg text-sm no-underline transition duration-200 hover:bg-white/10">
                                                Hubungi Pengurus
                                            </a>
                                        </div>
                                    </div>

                                    {{-- RIGHT --}}
                                    <div class="hidden lg:flex justify-end">
                                        @if($hero->image)
                                            <div class="relative">
                                                <img src="{{ asset('storage/' . $hero->image) }}" alt="{{ $hero->title }}"
                                                    class="rounded-2xl overflow-hidden max-w-[460px] w-full h-[380px] object-cover border border-white/10">
                                            </div>
                                        @else
                                            <div class="rounded-2xl bg-white/5 border border-dashed border-white/15 max-w-[460px] w-full h-[380px] flex flex-col items-center justify-center gap-3 text-white/30">
                                                <i data-lucide="image" class="w-12 h-12"></i>
                                                <span class="text-sm">Belum ada gambar</span>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            {{-- Slide counter --}}
                            <div class="absolute top-5 right-5 z-10 text-white/40 text-xs font-medium tracking-wide">
                                {{ $index + 1 }} / {{ $heroSections->count() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($heroSections->count() > 1)
                {{-- Prev --}}
                <button id="hero-prev" onclick="heroPrev()" aria-label="Slide sebelumnya"
                    class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 bg-white/10 border border-white/10 rounded-full text-white cursor-pointer flex items-center justify-center transition duration-200 hover:bg-white/20">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </button>
                {{-- Next --}}
                <button id="hero-next" onclick="heroNext()" aria-label="Slide berikutnya"
                    class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 bg-white/10 border border-white/10 rounded-full text-white cursor-pointer flex items-center justify-center transition duration-200 hover:bg-white/20">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </button>

                {{-- Dots --}}
                <div id="hero-dots" class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex gap-2 items-center">
                    @foreach($heroSections as $i => $s)
                        <button
                            class="hero-dot border-none cursor-pointer p-0 h-1.5 rounded-full transition-all duration-300"
                            data-dot="{{ $i }}" onclick="heroGoTo({{ $i }})" aria-label="Slide {{ $i + 1 }}"
                            style="background:{{ $i === 0 ? 'rgba(255,255,255,0.9)' : 'rgba(255,255,255,0.2)' }};width:{{ $i === 0 ? '24px' : '6px' }};"></button>
                    @endforeach
                </div>
            @endif

        </div>

    @else
        {{-- FALLBACK --}}
        <div class="text-white relative overflow-hidden min-h-[540px] flex items-center">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-24 relative z-10 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div class="animate-fadeUp">
                        <span class="section-label section-label-light">
                            <i data-lucide="moon" class="w-3 h-3 mr-1 align-middle inline-block"></i> Muhammadiyah Berkemajuan
                        </span>
                        <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl leading-[1.1] mb-6 text-white">
                            Mencerahkan Semesta,<br>Memajukan Duren Sawit.
                        </h1>
                        <p class="text-white/60 text-base leading-relaxed mb-10 max-w-lg">
                            Menjadi pilar dakwah yang inovatif, modern, dan membawa manfaat nyata bagi umat dan bangsa di
                            lingkungan Duren Sawit 1.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="#layanan"
                                class="bg-secondary text-accent font-bold py-3 px-7 rounded-lg text-sm no-underline transition duration-200 hover:bg-secondary-light">
                                Kenali Program Kami
                            </a>
                            <a href="#kontak"
                                class="border border-white/20 text-white font-semibold py-3 px-7 rounded-lg text-sm no-underline transition duration-200 hover:bg-white/10">
                                Hubungi Pengurus
                            </a>
                        </div>
                    </div>
                    <div class="hidden lg:flex justify-end">
                        <img src="https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?auto=format&fit=crop&w=900&q=80"
                            alt="Masjid" class="rounded-2xl max-w-[460px] w-full h-[380px] object-cover border border-white/10">
                    </div>
                </div>
            </div>
        </div>
    @endif

</header>

@if(isset($heroSections) && $heroSections->count() > 1)
    <script>
        (function () {
            const AUTOPLAY_DURATION = 5000;
            const slides = document.querySelectorAll('.hero-slide');
            const dots = document.querySelectorAll('.hero-dot');
            let current = 0, timer = null, paused = false;

            function showSlide(index) {
                slides.forEach((s, i) => s.style.display = i === index ? 'block' : 'none');
                dots.forEach((d, i) => {
                    d.style.background = i === index ? 'rgba(255,255,255,0.9)' : 'rgba(255,255,255,0.2)';
                    d.style.width = i === index ? '24px' : '6px';
                });
                current = index;
            }

            function startAutoplay() {
                clearTimeout(timer);
                timer = setTimeout(() => heroNext(), AUTOPLAY_DURATION);
            }

            window.heroNext = function () { showSlide((current + 1) % slides.length); startAutoplay(); };
            window.heroPrev = function () { showSlide((current - 1 + slides.length) % slides.length); startAutoplay(); };
            window.heroGoTo = function (i) { showSlide(i); startAutoplay(); };

            const wrap = document.getElementById('hero-slider-wrap');
            if (wrap) {
                wrap.addEventListener('mouseenter', () => { paused = true; clearTimeout(timer); });
                wrap.addEventListener('mouseleave', () => { paused = false; startAutoplay(); });
                let touchStartX = 0;
                wrap.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
                wrap.addEventListener('touchend', e => {
                    const diff = touchStartX - e.changedTouches[0].clientX;
                    if (Math.abs(diff) > 50) diff > 0 ? heroNext() : heroPrev();
                }, { passive: true });
            }
            document.addEventListener('keydown', e => {
                if (e.key === 'ArrowRight') heroNext();
                if (e.key === 'ArrowLeft') heroPrev();
            });
            startAutoplay();
        })();
    </script>
@endif
