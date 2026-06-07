<header id="hero-header" class="relative overflow-hidden">

    @if(isset($heroSections) && $heroSections->count() > 0)

        <div id="hero-slider-wrap" class="relative">
            <div id="hero-track" class="relative">
                @foreach($heroSections as $index => $hero)
                    <div class="hero-slide" data-index="{{ $index }}" style="display:{{ $index === 0 ? 'block' : 'none' }};">
                        <div
                            class="bg-gradient-to-br from-accent via-accent-green to-primary text-white relative overflow-hidden min-h-[580px] flex items-center">
                            {{-- Background image --}}
                            @if($hero->image)
                                <div class="absolute inset-0 bg-cover bg-center opacity-[0.18]"
                                    style="background-image:url('{{ asset('storage/' . $hero->image) }}');"></div>
                            @endif

                            {{-- Islamic geometric pattern --}}
                            <div class="islamic-pattern absolute inset-0 opacity-50 pointer-events-none"></div>

                            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-24 relative z-10 w-full">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                                    {{-- LEFT --}}
                                    <div class="text-center lg:text-left animate-fadeUp">

                                        @if($hero->tagline)
                                            <span
                                                class="inline-flex items-center gap-1.5 bg-secondary/12 border border-secondary/40 text-secondary text-[11px] font-bold tracking-widest uppercase py-1 px-4 rounded-full mb-6">
                                                {{ $hero->tagline }}
                                            </span>
                                        @endif

                                        <h1
                                            class="text-3xl sm:text-4xl lg:text-6xl font-extrabold leading-tight mb-6 tracking-tight">
                                            {{ $hero->title }}
                                        </h1>

                                        @if($hero->description)
                                            <p class="text-white/70 text-base leading-relaxed mb-10 max-w-lg mx-auto lg:mx-0">
                                                {{ $hero->description }}
                                            </p>
                                        @endif

                                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                                            <a href="#layanan"
                                                class="bg-gradient-to-r from-secondary to-secondary-light text-accent font-extrabold py-3.5 px-8 rounded-full text-sm no-underline shadow-lg shadow-secondary/40 transition duration-200 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-secondary/50">
                                                Kenali Program Kami
                                            </a>
                                            <a href="#kontak"
                                                class="border-2 border-secondary/50 text-white font-bold py-3.5 px-8 rounded-full text-sm no-underline transition duration-200 hover:bg-secondary/15 hover:border-secondary/80">
                                                Hubungi Pengurus
                                            </a>
                                        </div>
                                    </div>

                                    {{-- RIGHT --}}
                                    <div class="flex justify-center lg:justify-end pt-10">
                                        @if($hero->image)
                                            <div class="relative">
                                                <div
                                                    class="absolute -inset-2 rounded-[2rem] bg-gradient-to-br from-secondary to-primary opacity-50 z-0">
                                                </div>
                                                <div
                                                    class="rounded-3xl overflow-hidden shadow-2xl shadow-black/50 max-w-[480px] w-full relative z-10">
                                                    <img src="{{ asset('storage/' . $hero->image) }}" alt="{{ $hero->title }}"
                                                        class="w-full h-[420px] object-cover block">
                                                </div>
                                            </div>
                                        @else
                                            <div
                                                class="rounded-3xl overflow-hidden bg-secondary/6 border-2 border-dashed border-secondary/25 max-w-[480px] w-full h-[420px] flex flex-col items-center justify-center gap-4 text-secondary">
                                                <i data-lucide="image" class="w-14 h-14 opacity-30 text-secondary"></i>
                                                <span class="text-secondary/40 text-sm">Belum ada gambar</span>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            {{-- Slide counter --}}
                            <div
                                class="absolute top-5 right-5 z-10 bg-secondary/12 border border-secondary/30 text-white/80 text-xs font-semibold py-1 px-3 rounded-full backdrop-blur-md">
                                {{ $index + 1 }} / {{ $heroSections->count() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($heroSections->count() > 1)
                {{-- Prev --}}
                <button id="hero-prev" onclick="heroPrev()" aria-label="Slide sebelumnya"
                    class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-11 h-11 bg-secondary/15 border border-secondary/30 rounded-full text-white cursor-pointer flex items-center justify-center backdrop-blur-sm transition duration-200 hover:bg-secondary/35">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </button>
                {{-- Next --}}
                <button id="hero-next" onclick="heroNext()" aria-label="Slide berikutnya"
                    class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-11 h-11 bg-secondary/15 border border-secondary/30 rounded-full text-white cursor-pointer flex items-center justify-center backdrop-blur-sm transition duration-200 hover:bg-secondary/35">
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </button>

                {{-- Dots --}}
                <div id="hero-dots" class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex gap-2 items-center">
                    @foreach($heroSections as $i => $s)
                        <button
                            class="hero-dot border-none cursor-pointer p-0 h-2 rounded-full transition-all duration-350 ease-out"
                            data-dot="{{ $i }}" onclick="heroGoTo({{ $i }})" aria-label="Slide {{ $i + 1 }}"
                            style="background:{{ $i === 0 ? '#D4A017' : 'rgba(212,160,23,0.3)' }};width:{{ $i === 0 ? '28px' : '8px' }};"></button>
                    @endforeach
                </div>

                {{-- Progress bar --}}
                <div class="absolute bottom-0 left-0 w-full h-[3px] bg-white/8 z-20">
                    <div id="hero-progress"
                        class="h-full bg-gradient-to-r from-primary to-secondary w-0 transition-all duration-[linear]"></div>
                </div>
            @endif

        </div>

    @else
        {{-- FALLBACK --}}
        <div
            class="bg-gradient-to-br from-accent via-accent-green to-primary text-white relative overflow-hidden min-h-[580px] flex items-center">
            <div class="islamic-pattern absolute inset-0 opacity-50 pointer-events-none"></div>
            <div
                class="absolute -top-[120px] -right-[120px] w-[500px] h-[500px] rounded-full border-2 border-secondary/12 pointer-events-none">
            </div>
            <div
                class="absolute -bottom-[100px] -left-[80px] w-[400px] h-[400px] rounded-full bg-[radial-gradient(circle,_rgba(13,92,58,0.3)_0%,_transparent_70%)] pointer-events-none">
            </div>

            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-24 relative z-10 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="text-center lg:text-left animate-fadeUp">
                        <span
                            class="inline-flex items-center gap-1.5 bg-secondary/12 border border-secondary/40 text-secondary text-[11px] font-bold tracking-widest uppercase py-1 px-4 rounded-full mb-6">
                            <i data-lucide="moon" class="w-3.5 h-3.5 mr-1 align-middle inline-block"></i> Muhammadiyah Berkemajuan
                        </span>
                        <h1 class="text-3xl sm:text-4xl lg:text-6xl font-extrabold leading-tight mb-6 tracking-tight">
                            Mencerahkan Semesta,<br>Memajukan Duren Sawit.
                        </h1>
                        <p class="text-white/70 text-base leading-relaxed mb-10 max-w-lg mx-auto lg:mx-0">
                            Menjadi pilar dakwah yang inovatif, modern, dan membawa manfaat nyata bagi umat dan bangsa di
                            lingkungan Duren Sawit 1.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="#layanan"
                                class="bg-gradient-to-r from-secondary to-secondary-light text-accent font-extrabold py-3.5 px-8 rounded-full text-sm no-underline shadow-lg shadow-secondary/40 transition duration-200 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-secondary/50">
                                Kenali Program Kami
                            </a>
                            <a href="#kontak"
                                class="border-2 border-secondary/50 text-white font-bold py-3.5 px-8 rounded-full text-sm no-underline transition duration-200 hover:bg-secondary/15 hover:border-secondary/80">
                                Hubungi Pengurus
                            </a>
                        </div>
                    </div>
                    <div class="flex justify-center lg:justify-end">
                        <div class="relative">
                            <div
                                class="absolute -inset-2 rounded-[2rem] bg-gradient-to-br from-secondary to-primary opacity-40 z-0">
                            </div>
                            <div
                                class="rounded-3xl overflow-hidden shadow-2xl shadow-black/50 max-w-[480px] w-full relative z-10">
                                <img src="https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?auto=format&fit=crop&w=900&q=80"
                                    alt="Masjid" class="w-full h-[420px] object-cover block">
                            </div>
                        </div>
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
            const progress = document.getElementById('hero-progress');
            let current = 0, timer = null, startTime = null, rafId = null, paused = false;

            function showSlide(index) {
                slides.forEach((s, i) => s.style.display = i === index ? 'block' : 'none');
                dots.forEach((d, i) => {
                    d.style.background = i === index ? '#D4A017' : 'rgba(212,160,23,0.3)';
                    d.style.width = i === index ? '28px' : '8px';
                });
                current = index;
            }

            function startProgress() {
                if (progress) { progress.style.transition = 'none'; progress.style.width = '0%'; }
                cancelAnimationFrame(rafId);
                startTime = performance.now();
                function tick(now) {
                    if (paused) return;
                    const elapsed = now - startTime;
                    const pct = Math.min((elapsed / AUTOPLAY_DURATION) * 100, 100);
                    if (progress) progress.style.width = pct + '%';
                    if (elapsed < AUTOPLAY_DURATION) rafId = requestAnimationFrame(tick);
                }
                requestAnimationFrame(tick);
            }

            function startAutoplay() {
                clearTimeout(timer);
                startProgress();
                timer = setTimeout(() => heroNext(), AUTOPLAY_DURATION);
            }

            window.heroNext = function () { showSlide((current + 1) % slides.length); startAutoplay(); };
            window.heroPrev = function () { showSlide((current - 1 + slides.length) % slides.length); startAutoplay(); };
            window.heroGoTo = function (i) { showSlide(i); startAutoplay(); };

            const wrap = document.getElementById('hero-slider-wrap');
            if (wrap) {
                wrap.addEventListener('mouseenter', () => { paused = true; cancelAnimationFrame(rafId); clearTimeout(timer); });
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