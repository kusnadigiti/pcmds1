<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap');

    #amal-usaha-section {
        --au-black: #0e0e0e;
        --au-white: #fafaf8;
        --au-cream: #f5f2ec;
        --au-line: #e4e1da;
        --au-muted: #9a9690;
        --au-dark: #3a3830;

        --au-green: #1b5e40;
        --au-green-mid: #2e7d52;
        --au-green-bg: #e8f3ec;
        --au-green-grd: linear-gradient(135deg, #1b5e40 0%, #2e9e68 100%);

        --au-blue: #1a3a6c;
        --au-blue-mid: #2558a8;
        --au-blue-bg: #e8eef8;
        --au-blue-grd: linear-gradient(135deg, #1a3a6c 0%, #2e6ab8 100%);

        --au-amber: #7a3e00;
        --au-amber-mid: #c47a15;
        --au-amber-bg: #fdf4e4;
        --au-amber-grd: linear-gradient(135deg, #7a3e00 0%, #d4860e 100%);

        --au-indigo: #2d1e6b;
        --au-indigo-mid: #5040b0;
        --au-indigo-bg: #eeeaf8;
        --au-indigo-grd: linear-gradient(135deg, #2d1e6b 0%, #6050c8 100%);

        --au-radius: 18px;
        --au-radius-sm: 10px;
    }

    #amal-usaha-section {
        background: var(--au-white);
        font-family: 'DM Sans', sans-serif;
        padding: 100px 0 120px;
        overflow: hidden;
    }

    .au-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 5vw;
    }

    /* ── Header ── */
    .au-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 56px;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .au-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.72rem;
        font-weight: 500;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: var(--au-green-mid);
        margin-bottom: 10px;
    }

    .au-eyebrow::before {
        content: '';
        width: 22px;
        height: 1.5px;
        background: var(--au-green-mid);
        display: block;
    }

    .au-title {
        font-family: 'DM Serif Display', serif;
        font-size: clamp(1.9rem, 3vw, 2.8rem);
        letter-spacing: -0.025em;
        line-height: 1.08;
        color: var(--au-black);
    }

    .au-title em {
        font-style: italic;
        color: var(--au-green-mid);
    }

    .au-header-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 14px;
    }

    .au-header-desc {
        font-size: 0.88rem;
        color: var(--au-muted);
        line-height: 1.7;
        text-align: right;
        max-width: 300px;
    }

    .au-progress-track {
        width: 240px;
        height: 2px;
        background: var(--au-line);
        border-radius: 2px;
        overflow: hidden;
    }

    .au-progress-fill {
        height: 100%;
        background: var(--au-black);
        border-radius: 2px;
        width: 0%;
    }

    /* ── Slider ── */
    .au-slider-outer {
        position: relative;
    }

    .au-slider-viewport {
        overflow: hidden;
        border-radius: var(--au-radius);
    }

    .au-slider-track {
        display: flex;
        transition: transform 0.85s cubic-bezier(0.77, 0, 0.18, 1);
    }

    /* ── Slide card ── */
    .au-slide {
        min-width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 420px;
    }

    .au-slide-content {
        padding: 52px 52px 52px 56px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: var(--au-white);
        border: 1px solid var(--au-line);
        border-right: none;
        border-radius: var(--au-radius) 0 0 var(--au-radius);
    }

    .au-slide-visual {
        border-radius: 0 var(--au-radius) var(--au-radius) 0;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .au-slide-visual::before {
        content: '';
        position: absolute;
        inset: 0;
        opacity: 0.08;
        background-image:
            radial-gradient(circle at 30% 70%, white 1px, transparent 1px),
            radial-gradient(circle at 70% 30%, white 1px, transparent 1px);
        background-size: 32px 32px;
        z-index: 1;
    }

    .au-slide-visual img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.4;
        z-index: 0;
        transition: opacity 0.5s ease;
    }

    .au-slide.au-slide-active .au-slide-visual img {
        opacity: 0.55;
    }

    .au-visual-icon {
        font-size: 96px;
        opacity: 0.22;
        z-index: 2;
        filter: drop-shadow(0 8px 24px rgba(0, 0, 0, 0.3));
        transition: transform 0.5s ease, opacity 0.5s ease;
    }

    .au-slide.au-slide-active .au-visual-icon {
        opacity: 0.32;
        transform: scale(1.05);
    }

    .au-visual-label {
        position: absolute;
        bottom: 24px;
        left: 24px;
        font-size: 0.68rem;
        font-weight: 500;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.5);
        z-index: 3;
    }

    /* Warna visual per tipe */
    .au-slide-green .au-slide-visual {
        background: var(--au-green-grd);
    }

    .au-slide-blue .au-slide-visual {
        background: var(--au-blue-grd);
    }

    .au-slide-amber .au-slide-visual {
        background: var(--au-amber-grd);
    }

    .au-slide-indigo .au-slide-visual {
        background: var(--au-indigo-grd);
    }

    /* ── Badge ── */
    .au-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: 100px;
        font-size: 0.72rem;
        font-weight: 500;
        letter-spacing: 0.06em;
        width: fit-content;
        margin-bottom: 16px;
    }

    .au-badge-green {
        background: var(--au-green-bg);
        color: var(--au-green);
    }

    .au-badge-blue {
        background: var(--au-blue-bg);
        color: var(--au-blue);
    }

    .au-badge-amber {
        background: var(--au-amber-bg);
        color: var(--au-amber);
    }

    .au-badge-indigo {
        background: var(--au-indigo-bg);
        color: var(--au-indigo);
    }

    /* ── Judul (nama amal usaha dari DB) ── */
    .au-slide-name {
        font-family: 'DM Serif Display', serif;
        font-size: clamp(2rem, 3.5vw, 3rem);
        letter-spacing: -0.025em;
        line-height: 1.05;
        color: var(--au-black);
        margin-bottom: 6px;
        animation: au-fade-up 0.7s ease both;
    }

    /* ── Organisasi otonom (sebagai sub-label) ── */
    .au-org-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.78rem;
        color: var(--au-muted);
        margin-bottom: 20px;
        animation: au-fade-up 0.7s 0.06s ease both;
    }

    .au-org-chip svg {
        flex-shrink: 0;
        opacity: 0.6;
    }

    .au-divider-line {
        width: 36px;
        height: 1.5px;
        background: var(--au-line);
        margin-bottom: 18px;
    }

    /* ── Deskripsi ── */
    .au-slide-desc {
        font-size: 0.88rem;
        line-height: 1.75;
        color: var(--au-dark);
        max-width: 440px;
        animation: au-fade-up 0.7s 0.12s ease both;

        /* Clamp panjang teks agar slide tidak melar */
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* ── Nav buttons ── */
    .au-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 44px;
        height: 44px;
        background: var(--au-white);
        border: 1px solid var(--au-line);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: background 0.2s, border-color 0.2s, transform 0.2s;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
    }

    .au-nav-btn:hover {
        background: var(--au-black);
        border-color: var(--au-black);
        transform: translateY(-50%) scale(1.08);
    }

    .au-nav-btn:hover svg {
        stroke: white;
    }

    .au-nav-prev {
        left: -22px;
    }

    .au-nav-next {
        right: -22px;
    }

    .au-nav-btn svg {
        stroke: var(--au-dark);
        transition: stroke 0.2s;
    }

    /* ── Dots ── */
    .au-dots {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 28px;
    }

    .au-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--au-line);
        cursor: pointer;
        transition: background 0.3s, width 0.3s, border-radius 0.3s;
        border: none;
        padding: 0;
    }

    .au-dot.active {
        background: var(--au-black);
        width: 20px;
        border-radius: 3px;
    }

    /* ── Counter ── */
    .au-counter {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 18px;
    }

    .au-counter-text {
        font-size: 0.72rem;
        color: var(--au-muted);
        letter-spacing: 0.08em;
    }

    .au-counter-text strong {
        color: var(--au-black);
    }

    /* ── Tipe filter tabs ── */
    .au-tipe-tabs {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 32px;
    }

    .au-badge-count {
        font-weight: 400;
        opacity: 0.8;
        margin-left: 4px;
    }

    .au-org-list {
        margin: 20px 0 24px;
        padding: 0;
        list-style: none;
        padding-right: 8px;
    }

    .au-org-item {
        margin-bottom: 16px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--au-line);
    }

    .au-org-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .au-item-desc {
        font-size: 0.8rem;
        color: var(--au-muted);
        margin-top: 4px;
        line-height: 1.5;
    }

    .au-total-org {
        font-weight: 500;
        font-style: italic;
    }

    /* Scrollbar custom */
    .au-org-list::-webkit-scrollbar {
        width: 4px;
    }

    .au-org-list::-webkit-scrollbar-track {
        background: transparent;
    }

    .au-org-list::-webkit-scrollbar-thumb {
        background: var(--au-line);
        border-radius: 2px;
    }

    .au-org-list::-webkit-scrollbar-thumb:hover {
        background: var(--au-dark);
    }

    .au-tipe-tab {
        padding: 6px 16px;
        border-radius: 100px;
        font-size: 0.75rem;
        font-weight: 500;
        border: 1px solid var(--au-line);
        background: transparent;
        color: var(--au-muted);
        cursor: pointer;
        transition: all 0.2s;
        letter-spacing: 0.04em;
    }

    .au-tipe-tab:hover {
        border-color: var(--au-dark);
        color: var(--au-dark);
    }

    .au-tipe-tab.active {
        background: var(--au-black);
        color: #fff;
        border-color: var(--au-black);
    }

    @keyframes au-fade-up {
        from {
            opacity: 0;
            transform: translateY(16px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        #amal-usaha-section {
            padding: 70px 0 80px;
        }

        .au-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .au-header-right {
            align-items: flex-start;
        }

        .au-header-desc {
            text-align: left;
            max-width: 100%;
        }

        .au-progress-track {
            width: 160px;
        }

        .au-slide {
            min-width: 100%;
            display: flex;
            flex-direction: column;

            min-height: auto;
        }

        .au-slide-content {
            padding: 32px 24px;
            border-right: 1px solid var(--au-line);
            border-bottom: none;
            border-radius: var(--au-radius) var(--au-radius) 0 0;
        }

        .au-slide-visual {
            min-height: 200px;
            border-radius: 0 0 var(--au-radius) var(--au-radius);
        }

        .au-nav-prev {
            left: -8px;
        }

        .au-nav-next {
            right: -8px;
        }

        .au-slide-name {
            font-size: clamp(1.6rem, 6vw, 2.4rem);
        }
    }
</style>

@php
    /*
     * Config per tipe — hanya untuk icon, warna, label badge.
     * Nama & deskripsi slide sepenuhnya dari DB.
     */
    $tipeConfig = [
        'bidang_kesehatan' => [
            'label' => 'Bidang Kesehatan',
            'icon' => '🏥',
            'color' => 'blue',
        ],
        'bidang_pendidikan' => [
            'label' => 'Bidang Pendidikan',
            'icon' => '🎓',
            'color' => 'amber',
        ],
        'bidang_sosial' => [
            'label' => 'Bidang Sosial',
            'icon' => '🤝',
            'color' => 'indigo',
        ],
    ];

    $totalSlides = $amalUsahaGrouped->count();
@endphp

@if ($totalSlides > 0)
    <section id="amal-usaha-section">
        <div class="au-container">

            <div class="au-header">
                <div>
                    <div class="au-eyebrow">Amal Usaha Muhammadiyah</div>
                    <h2 class="au-title">
                        Gerak <em>Nyata</em><br>PCM Duren Sawit
                    </h2>
                </div>
                <div class="au-header-right">
                    <p class="au-header-desc">
                        Amal usaha yang menggerakkan<br>
                        kehidupan bermasyarakat PCM Duren Sawit.
                    </p>
                    <div class="au-progress-track">
                        <div class="au-progress-fill" id="auProgressFill"></div>
                    </div>
                </div>
            </div>

            {{-- Filter tabs per tipe --}}
            <div class="au-tipe-tabs" id="auTipeTabs">
                <button class="au-tipe-tab active" data-tipe="all">Semua</button>
                @foreach ($amalUsahaGrouped as $group)
                    @php $cfg = $tipeConfig[$group['tipe']] ?? ['label' => ucwords(str_replace('_', ' ', $group['tipe'])), 'color' => 'green']; @endphp
                    <button class="au-tipe-tab" data-tipe="{{ $group['tipe'] }}">
                        {{ $cfg['label'] }} ({{ $group['count'] }})
                    </button>
                @endforeach
            </div>

            {{-- Slider --}}
            <div class="au-slider-outer">
                <button class="au-nav-btn au-nav-prev" onclick="auSlide(-1)" aria-label="Sebelumnya">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke-width="1.8">
                        <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                <div class="au-slider-viewport">
                    <div class="au-slider-track" id="auSliderTrack">

                        @foreach ($amalUsahaGrouped as $index => $group)
                            @php
                                $cfg = $tipeConfig[$group['tipe']] ?? [
                                    'label' => ucwords(str_replace('_', ' ', $group['tipe'])),
                                    'icon' => '📋',
                                    'color' => 'green',
                                ];
                                $firstItem = $group['items']->first();
                            @endphp

                            <div class="au-slide au-slide-{{ $cfg['color'] }}" data-tipe="{{ $group['tipe'] }}">

                                {{-- Konten kiri --}}
                                <div class="au-slide-content">

                                    <span class="au-badge au-badge-{{ $cfg['color'] }}">
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                                            <circle cx="5" cy="5" r="3" fill="currentColor" />
                                        </svg>
                                        {{ $cfg['label'] }}
                                        <span class="au-badge-count">({{ $group['count'] }})</span>
                                    </span>

                                    @if ($firstItem)
                                        <h3 class="au-slide-name">{{ $firstItem->nama }}</h3>
                                    @endif

                                    @if ($group['latestDesc'])
                                        <div class="au-latest-desc">
                                            <p class="au-item-desc">{{ Str::limit($group['latestDesc'], 120) }}</p>
                                        </div>
                                    @endif

                                    <ul class="au-org-list">
                                        @foreach ($group['items'] as $item)
                                            @if ($item->organisasiOtonom)
                                                <li class="au-org-chip au-org-name-only">
                                                    <svg width="12" height="12" viewBox="0 0 12 12"
                                                        fill="none">
                                                        <path
                                                            d="M6 1L7.5 4.5H11L8.5 6.5L9.5 10L6 8L2.5 10L3.5 6.5L1 4.5H4.5L6 1Z"
                                                            stroke="currentColor" stroke-width="1" fill="none"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    {{ $item->organisasiOtonom->nama }}
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    <div class="au-divider-line"></div>

                                </div>

                                {{-- Visual kanan --}}
                                <div class="au-slide-visual">
                                    @if ($firstItem && $firstItem->foto)
                                        <img src="{{ Storage::url($firstItem->foto) }}" alt="{{ $firstItem->nama }}"
                                            loading="lazy">
                                    @endif
                                    <span class="au-visual-icon">{{ $cfg['icon'] }}</span>
                                    <span class="au-visual-label">{{ $cfg['label'] }}</span>
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>

                <button class="au-nav-btn au-nav-next" onclick="auSlide(1)" aria-label="Berikutnya">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke-width="1.8">
                        <path d="M6 4l4 4-4 4" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            {{-- Footer dots + counter --}}
            <div class="au-counter">
                <div class="au-dots" id="auDots"></div>
                <span class="au-counter-text">
                    <strong id="auCurrent">01</strong> /
                    <span id="auTotal">{{ str_pad($totalSlides, 2, '0', STR_PAD_LEFT) }}</span>
                </span>
            </div>

        </div>
    </section>

    <script>
        (function() {
            const INTERVAL = 5500;

            const track = document.getElementById('auSliderTrack');
            const dotsWrap = document.getElementById('auDots');
            const currentEl = document.getElementById('auCurrent');
            const totalEl = document.getElementById('auTotal');
            const progressEl = document.getElementById('auProgressFill');

            /* ── Semua slides (NodeList) ── */
            let allSlides = Array.from(track.querySelectorAll('.au-slide'));
            let visible = [...allSlides]; // slides yang sedang ditampilkan
            let current = 0;
            let timer = null;

            /* ── Build dots ── */
            function buildDots(count) {
                dotsWrap.innerHTML = '';
                for (let i = 0; i < count; i++) {
                    const d = document.createElement('button');
                    d.className = 'au-dot' + (i === 0 ? ' active' : '');
                    d.setAttribute('aria-label', 'Slide ' + (i + 1));
                    d.addEventListener('click', () => {
                        clearInterval(timer);
                        goTo(i);
                        startAuto();
                    });
                    dotsWrap.appendChild(d);
                }
            }

            /* ── Filter by tipe ── */
            document.getElementById('auTipeTabs').addEventListener('click', (e) => {
                const btn = e.target.closest('.au-tipe-tab');
                if (!btn) return;

                document.querySelectorAll('.au-tipe-tab').forEach(t => t.classList.remove('active'));
                btn.classList.add('active');

                const tipe = btn.dataset.tipe;

                allSlides.forEach(s => {
                    s.style.display = (tipe === 'all' || s.dataset.tipe === tipe) ? '' : 'none';
                });

                visible = allSlides.filter(s => s.style.display !== 'none');
                totalEl.textContent = String(visible.length).padStart(2, '0');

                clearInterval(timer);
                goTo(0);
                startAuto();
                buildDots(visible.length);
            });

            /* ── goTo ── */
            function goTo(idx) {
                current = ((idx % visible.length) + visible.length) % visible.length;

                /* Hitung offset: jumlah slides sebelum slide visible[current] dalam allSlides */
                const targetSlide = visible[current];
                const allIdx = allSlides.indexOf(targetSlide);

                track.style.transform = `translateX(-${allIdx * 100}%)`;

                dotsWrap.querySelectorAll('.au-dot').forEach((d, i) =>
                    d.classList.toggle('active', i === current)
                );

                currentEl.textContent = String(current + 1).padStart(2, '0');

                allSlides.forEach((s, i) =>
                    s.classList.toggle('au-slide-active', i === allIdx)
                );

                resetProgress();
            }

            window.auSlide = function(dir) {
                clearInterval(timer);
                goTo(current + dir);
                startAuto();
            };

            /* ── Progress bar ── */
            function resetProgress() {
                progressEl.style.transition = 'none';
                progressEl.style.width = '0%';
                requestAnimationFrame(() => {
                    progressEl.style.transition = `width ${INTERVAL}ms linear`;
                    progressEl.style.width = '100%';
                });
            }

            /* ── Auto-advance ── */
            function startAuto() {
                clearInterval(timer);
                resetProgress();
                timer = setInterval(() => goTo(current + 1), INTERVAL);
            }

            /* ── Pause on hover ── */
            const section = document.getElementById('amal-usaha-section');
            section.addEventListener('mouseenter', () => clearInterval(timer));
            section.addEventListener('mouseleave', () => startAuto());

            /* ── Touch swipe ── */
            let touchX = 0;
            track.addEventListener('touchstart', e => {
                touchX = e.touches[0].clientX;
            }, {
                passive: true
            });
            track.addEventListener('touchend', e => {
                const diff = touchX - e.changedTouches[0].clientX;
                if (Math.abs(diff) > 40) window.auSlide(diff > 0 ? 1 : -1);
            }, {
                passive: true
            });

            /* ── Init ── */
            buildDots(visible.length);
            goTo(0);
            startAuto();
        })();
    </script>
@endif
