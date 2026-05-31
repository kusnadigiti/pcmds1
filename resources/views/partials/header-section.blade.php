<header class="relative overflow-hidden " id="hero-header">

    @if(isset($heroSections) && $heroSections->count() > 0)

    <div class="relative" id="hero-slider-wrap">

        <div id="hero-track" style="position:relative;">
            @foreach($heroSections as $index => $hero)
            <div class="hero-slide"
                 data-index="{{ $index }}"
                 style="
                    display:{{ $index === 0 ? 'block' : 'none' }};
                    background: linear-gradient(135deg, #065f46 0%, #047857 50%, #059669 100%);
                    color: white;
                    position: relative;
                    overflow: hidden;
                 ">

                @if($hero->image)
                <div style="
                    position:absolute; inset:0;
                    background-image: url('{{ asset('storage/' . $hero->image) }}');
                    background-size: cover;
                    background-position: center;
                    opacity: 0.35;
                    transition: opacity 0.5s ease;
                "></div>
                @endif

                {{-- Decorative blobs --}}
                <div style="
                    position:absolute; top:-80px; right:-80px;
                    width:320px; height:320px;
                    background: rgba(255,255,255,0.05);
                    border-radius: 50%;
                    pointer-events:none;
                "></div>
                <div style="
                    position:absolute; bottom:-60px; left:-60px;
                    width:240px; height:240px;
                    background: rgba(255,255,255,0.04);
                    border-radius: 50%;
                    pointer-events:none;
                "></div>

                <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20" style="position:relative; z-index:2;">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                        {{-- LEFT --}}
                        <div class="text-center lg:text-left">

                            @if($hero->tagline)
                            <span style="
                                display: inline-block;
                                background: #facc15;
                                color: #1a1a1a;
                                font-size: 0.8rem;
                                font-weight: 700;
                                padding: 4px 16px;
                                border-radius: 999px;
                                margin-bottom: 1.25rem;
                                letter-spacing: 0.03em;
                            ">{{ $hero->tagline }}</span>
                            @endif

                            <h1 style="
                                font-size: clamp(1.9rem, 4vw, 3rem);
                                font-weight: 800;
                                line-height: 1.15;
                                margin-bottom: 1.25rem;
                                letter-spacing: -0.02em;
                            ">{{ $hero->title }}</h1>

                            @if($hero->description)
                            <p style="
                                color: rgba(255,255,255,0.8);
                                font-size: 1.05rem;
                                line-height: 1.7;
                                margin-bottom: 2rem;
                                max-width: 36rem;
                            " class="mx-auto lg:mx-0">{{ $hero->description }}</p>
                            @endif

                            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                                <a href="#layanan"
                                    style="background:#f97316; color:white; font-weight:700; padding:12px 28px; border-radius:999px; font-size:0.9rem; text-decoration:none; transition:background .2s;"
                                    onmouseover="this.style.background='#ea580c'"
                                    onmouseout="this.style.background='#f97316'">
                                    Kenali Program Kami
                                </a>
                                <a href="#kontak"
                                    style="border:2px solid rgba(255,255,255,0.7); color:white; font-weight:700; padding:12px 28px; border-radius:999px; font-size:0.9rem; text-decoration:none; transition:all .2s;"
                                    onmouseover="this.style.background='white';this.style.color='#065f46'"
                                    onmouseout="this.style.background='transparent';this.style.color='white'">
                                    Hubungi Pengurus
                                </a>
                            </div>
                        </div>

                        {{-- RIGHT --}}
                        <div class="flex justify-center lg:justify-end pt-10">
                            @if($hero->image)
                            <div style="border-radius:1.5rem; overflow:hidden; box-shadow: 0 25px 50px rgba(0,0,0,0.35); max-width:480px; width:100%;">
                                <img src="{{ asset('storage/' . $hero->image) }}"
                                     alt="{{ $hero->title }}"
                                     style="width:100%; height:420px; object-fit:cover; display:block;">
                            </div>
                            @else
                            <div style="
                                border-radius:1.5rem;
                                overflow:hidden;
                                background: rgba(255,255,255,0.1);
                                border: 2px dashed rgba(255,255,255,0.2);
                                max-width:480px; width:100%; height:420px;
                                display:flex; align-items:center; justify-content:center;
                                flex-direction:column; gap:1rem;
                            ">
                                <svg style="width:56px;height:56px;opacity:.3" fill="none" stroke="white" stroke-width="1.2" viewBox="0 0 24 24">
                                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span style="color:rgba(255,255,255,.4);font-size:.85rem;">Belum ada gambar</span>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>

                {{-- Slide number badge --}}
                <div style="
                    position:absolute; top:1.25rem; right:1.25rem; z-index:10;
                    background:rgba(0,0,0,0.25);
                    color:rgba(255,255,255,0.7);
                    font-size:0.75rem; font-weight:600;
                    padding:4px 12px; border-radius:999px;
                    backdrop-filter: blur(6px);
                ">{{ $index + 1 }} / {{ $heroSections->count() }}</div>

            </div>
            @endforeach
        </div>

        {{-- ===== CONTROLS (hanya kalau > 1) ===== --}}
        @if($heroSections->count() > 1)

        {{-- Prev button --}}
        <button id="hero-prev" onclick="heroPrev()" aria-label="Slide sebelumnya" style="
            position:absolute; left:1rem; top:50%; transform:translateY(-50%);
            z-index:20;
            width:44px; height:44px;
            background:rgba(0,0,0,0.3);
            border:none; border-radius:50%;
            color:white; cursor:pointer;
            display:flex; align-items:center; justify-content:center;
            backdrop-filter:blur(6px);
            transition:background .2s, transform .2s;
        "
        onmouseover="this.style.background='rgba(0,0,0,0.55)';this.style.transform='translateY(-50%) scale(1.08)'"
        onmouseout="this.style.background='rgba(0,0,0,0.3)';this.style.transform='translateY(-50%) scale(1)'">
            <svg width="20" height="20" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        {{-- Next button --}}
        <button id="hero-next" onclick="heroNext()" aria-label="Slide berikutnya" style="
            position:absolute; right:1rem; top:50%; transform:translateY(-50%);
            z-index:20;
            width:44px; height:44px;
            background:rgba(0,0,0,0.3);
            border:none; border-radius:50%;
            color:white; cursor:pointer;
            display:flex; align-items:center; justify-content:center;
            backdrop-filter:blur(6px);
            transition:background .2s, transform .2s;
        "
        onmouseover="this.style.background='rgba(0,0,0,0.55)';this.style.transform='translateY(-50%) scale(1.08)'"
        onmouseout="this.style.background='rgba(0,0,0,0.3)';this.style.transform='translateY(-50%) scale(1)'">
            <svg width="20" height="20" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        {{-- Dots --}}
        <div id="hero-dots" style="
            position:absolute; bottom:1.5rem; left:50%; transform:translateX(-50%);
            z-index:20; display:flex; gap:8px; align-items:center;
        ">
            @foreach($heroSections as $i => $s)
            <button
                class="hero-dot"
                data-dot="{{ $i }}"
                onclick="heroGoTo({{ $i }})"
                aria-label="Slide {{ $i + 1 }}"
                style="
                    border:none; cursor:pointer; padding:0;
                    height:8px; border-radius:999px;
                    background:{{ $i === 0 ? 'white' : 'rgba(255,255,255,0.35)' }};
                    width:{{ $i === 0 ? '28px' : '8px' }};
                    transition:all .35s cubic-bezier(.4,0,.2,1);
                "></button>
            @endforeach
        </div>

        {{-- Progress bar --}}
        <div style="position:absolute;bottom:0;left:0;width:100%;height:3px;background:rgba(255,255,255,0.15);z-index:20;">
            <div id="hero-progress" style="
                height:100%;
                background:rgba(255,255,255,0.7);
                width:0%;
                transition:width linear;
            "></div>
        </div>

        @endif

    </div>

    {{-- ===================== FALLBACK (kalau $heroSections kosong) ===================== --}}
    @else
    <div style="
        background: linear-gradient(135deg, #065f46 0%, #047857 50%, #059669 100%);
        color: white;
        position: relative;
        overflow: hidden;
    ">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left">
                    <span style="display:inline-block;background:#facc15;color:#1a1a1a;font-size:.8rem;font-weight:700;padding:4px 16px;border-radius:999px;margin-bottom:1.25rem;">
                        Muhammadiyah Berkemajuan
                    </span>
                    <h1 style="font-size:clamp(1.9rem,4vw,3rem);font-weight:800;line-height:1.15;margin-bottom:1.25rem;letter-spacing:-.02em;">
                        Mencerahkan Semesta,<br>Memajukan Duren Sawit.
                    </h1>
                    <p style="color:rgba(255,255,255,.8);font-size:1.05rem;line-height:1.7;margin-bottom:2rem;max-width:36rem;" class="mx-auto lg:mx-0">
                        Menjadi pilar dakwah yang inovatif, modern, dan membawa manfaat nyata bagi umat dan bangsa di lingkungan Duren Sawit 1.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#layanan"
                            style="background:#f97316;color:white;font-weight:700;padding:12px 28px;border-radius:999px;font-size:.9rem;text-decoration:none;transition:background .2s;"
                            onmouseover="this.style.background='#ea580c'" onmouseout="this.style.background='#f97316'">
                            Kenali Program Kami
                        </a>
                        <a href="#kontak"
                            style="border:2px solid rgba(255,255,255,.7);color:white;font-weight:700;padding:12px 28px;border-radius:999px;font-size:.9rem;text-decoration:none;transition:all .2s;"
                            onmouseover="this.style.background='white';this.style.color='#065f46'"
                            onmouseout="this.style.background='transparent';this.style.color='white'">
                            Hubungi Pengurus
                        </a>
                    </div>
                </div>
                <div class="flex justify-center lg:justify-end">
                    <div style="border-radius:1.5rem;overflow:hidden;box-shadow:0 25px 50px rgba(0,0,0,.35);max-width:480px;width:100%;">
                        <img src="https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?auto=format&fit=crop&w=900&q=80"
                             alt="Masjid" style="width:100%;height:420px;object-fit:cover;display:block;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</header>

{{-- ===================== SLIDER SCRIPT ===================== --}}
@if(isset($heroSections) && $heroSections->count() > 1)
<script>
(function() {
    const AUTOPLAY_DURATION = 5000;
    const slides = document.querySelectorAll('.hero-slide');
    const dots   = document.querySelectorAll('.hero-dot');
    const progress = document.getElementById('hero-progress');
    let current = 0;
    let timer = null;
    let startTime = null;
    let rafId = null;
    let paused = false;

    function showSlide(index) {
        slides.forEach((s, i) => s.style.display = i === index ? 'block' : 'none');
        dots.forEach((d, i) => {
            if (i === index) {
                d.style.background = 'white';
                d.style.width = '28px';
            } else {
                d.style.background = 'rgba(255,255,255,0.35)';
                d.style.width = '8px';
            }
        });
        current = index;
    }

    function startProgress() {
        if (progress) progress.style.transition = 'none';
        if (progress) progress.style.width = '0%';

        cancelAnimationFrame(rafId);
        startTime = performance.now();

        function tick(now) {
            if (paused) return;
            const elapsed = now - startTime;
            const pct = Math.min((elapsed / AUTOPLAY_DURATION) * 100, 100);
            if (progress) progress.style.width = pct + '%';
            if (elapsed < AUTOPLAY_DURATION) {
                rafId = requestAnimationFrame(tick);
            }
        }
        requestAnimationFrame(tick);
    }

    function startAutoplay() {
        clearTimeout(timer);
        startProgress();
        timer = setTimeout(() => {
            heroNext();
        }, AUTOPLAY_DURATION);
    }

    window.heroNext = function() {
        showSlide((current + 1) % slides.length);
        startAutoplay();
    };

    window.heroPrev = function() {
        showSlide((current - 1 + slides.length) % slides.length);
        startAutoplay();
    };

    window.heroGoTo = function(i) {
        showSlide(i);
        startAutoplay();
    };

    // Pause on hover
    const wrap = document.getElementById('hero-slider-wrap');
    if (wrap) {
        wrap.addEventListener('mouseenter', () => { paused = true; cancelAnimationFrame(rafId); clearTimeout(timer); });
        wrap.addEventListener('mouseleave', () => { paused = false; startAutoplay(); });
    }

    // Swipe support (touch)
    let touchStartX = 0;
    if (wrap) {
        wrap.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
        wrap.addEventListener('touchend', e => {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) diff > 0 ? heroNext() : heroPrev();
        }, { passive: true });
    }

    // Keyboard nav
    document.addEventListener('keydown', e => {
        if (e.key === 'ArrowRight') heroNext();
        if (e.key === 'ArrowLeft')  heroPrev();
    });

    // Start!
    startAutoplay();
})();
</script>
@endif
