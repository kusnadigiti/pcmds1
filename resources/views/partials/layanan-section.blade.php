{{-- ═══════════════════════════════════════════════════════════════
     AMAL USAHA SECTION — Cream theme, fully styled with Tailwind CSS
     ═══════════════════════════════════════════════════════════════ --}}

@php
    /*
     * Config per tipe — untuk icon, warna gradient, dan label badge.
     * Nama & deskripsi slide sepenuhnya diambil dari database.
     */
    $tipeConfig = [
        'bidang_kesehatan' => [
            'label' => 'Bidang Kesehatan',
            'icon_lucide' => 'hospital',
            'badge' => 'bg-sky-100 text-sky-800',
            'gradient' => 'from-sky-900 to-sky-600',
        ],
        'bidang_pendidikan' => [
            'label' => 'Bidang Pendidikan',
            'icon_lucide' => 'graduation-cap',
            'badge' => 'bg-amber-100 text-amber-800',
            'gradient' => 'from-amber-700 to-amber-500',
        ],
        'bidang_sosial' => [
            'label' => 'Bidang Sosial',
            'icon_lucide' => 'hand-helping',
            'badge' => 'bg-indigo-100 text-indigo-800',
            'gradient' => 'from-indigo-900 to-indigo-600',
        ],
    ];

    $totalSlides = isset($amalUsahaList) ? $amalUsahaList->count() : 0;
@endphp

@if ($totalSlides > 0)
    <section id="amal-usaha-section" class="bg-cream py-20 relative overflow-hidden">
        {{-- Background pattern --}}
        <div class="islamic-pattern absolute inset-0 opacity-[0.35] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">

            <!-- HEADER -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                <div>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight m-0">
                        Gerak <span class="text-primary font-normal italic">Nyata</span><br>PCM Duren Sawit
                    </h2>
                </div>
                <div class="flex flex-col items-start md:items-end gap-3.5">
                    <p class="text-sm text-gray-500 leading-relaxed text-left md:text-right max-w-xs m-0">
                        Amal usaha yang menggerakkan kehidupan bermasyarakat PCM Duren Sawit.
                    </p>
                    <div class="w-40 sm:w-60 h-0.5 bg-primary/10 rounded-full overflow-hidden">
                        <div class="h-full bg-gray-900 rounded-full w-0 transition-all duration-[linear]" id="auProgressFill"></div>
                    </div>
                </div>
            </div>

            <!-- FILTER TABS -->
            <div class="flex gap-2 flex-wrap mb-8" id="auTipeTabs">
                <button class="px-4 py-1.5 rounded-full text-xs font-semibold border border-transparent bg-gray-900 text-white cursor-pointer transition duration-200 au-tipe-tab" data-tipe="all">
                    Semua
                </button>
                @foreach ($amalUsahaGrouped as $group)
                    @php 
                        $cfg = $tipeConfig[$group['tipe']] ?? [
                            'label' => ucwords(str_replace('_', ' ', $group['tipe'])), 
                            'badge' => 'bg-emerald-100 text-emerald-800'
                        ]; 
                    @endphp
                    <button class="px-4 py-1.5 rounded-full text-xs font-semibold border border-primary/15 bg-transparent text-gray-500 cursor-pointer transition duration-200 hover:border-gray-900 hover:text-gray-900 au-tipe-tab" data-tipe="{{ $group['tipe'] }}">
                        {{ $cfg['label'] }} ({{ $group['count'] }})
                    </button>
                @endforeach
            </div>

            <!-- SLIDER -->
            <div class="relative">
                <button class="absolute top-1/2 -translate-y-1/2 w-11 h-11 bg-white border border-primary/10 rounded-full flex items-center justify-center cursor-pointer z-20 shadow-lg transition duration-200 hover:bg-gray-900 hover:border-gray-900 group active:scale-95 -left-3 md:-left-5" onclick="auSlide(-1)" aria-label="Sebelumnya">
                    <i data-lucide="chevron-left" class="w-5 h-5 text-gray-700 transition-colors duration-200 group-hover:text-white"></i>
                </button>

                <div class="overflow-hidden rounded-2xl">
                    <div class="flex transition-transform duration-700 ease-in-out" id="auSliderTrack">

                        @foreach ($amalUsahaList as $index => $item)
                            @php
                                $cfg = $tipeConfig[$item->tipe] ?? [
                                    'label' => ucwords(str_replace('_', ' ', $item->tipe)),
                                    'icon_lucide' => 'clipboard',
                                    'badge' => 'bg-emerald-100 text-emerald-800',
                                    'gradient' => 'from-primary to-primary-light',
                                ];
                            @endphp

                            <div class="au-slide group/slide min-w-full grid grid-cols-1 md:grid-cols-2 min-h-[420px]" data-tipe="{{ $item->tipe }}">

                                <!-- LEFT CONTENT -->
                                <div class="p-8 md:p-12 flex flex-col justify-center bg-white border border-primary/10 rounded-t-2xl md:rounded-l-2xl md:rounded-tr-none md:border-r-0">

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold max-w-max mb-4 {{ $cfg['badge'] }}">
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                                            <circle cx="5" cy="5" r="3" fill="currentColor" />
                                        </svg>
                                        {{ $cfg['label'] }}
                                    </span>

                                    <h3 class="font-bold text-3xl md:text-4xl text-gray-900 tracking-tight leading-none mb-2">{{ $item->nama }}</h3>

                                    @if ($item->deskripsi)
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-500 leading-relaxed m-0 line-clamp-4">{{ Str::limit($item->deskripsi, 250) }}</p>
                                        </div>
                                    @endif

                                    @if ($item->organisasiOtonom)
                                        <div class="mb-6">
                                            <span class="inline-flex items-center gap-1.5 text-xs text-gray-600 font-semibold bg-gray-50 border border-gray-100 py-1.5 px-3.5 rounded-full">
                                                <i data-lucide="award" class="w-3.5 h-3.5 text-gray-500"></i>
                                                {{ $item->organisasiOtonom->nama }}
                                            </span>
                                        </div>
                                    @endif

                                    <div class="w-9 h-[1.5px] bg-primary/10 mb-4"></div>

                                </div>

                                <!-- RIGHT VISUAL -->
                                <div class="relative overflow-hidden rounded-b-2xl md:rounded-r-2xl md:rounded-bl-none min-h-[200px] md:min-h-full flex items-center justify-center bg-gradient-to-br {{ $cfg['gradient'] }}">
                                    <div class="absolute inset-0 opacity-[0.08] pointer-events-none bg-[radial-gradient(circle_at_30%_70%,_white_1px,_transparent_1px),_radial-gradient(circle_at_70%_30%,_white_1px,_transparent_1px)] bg-[size:32px_32px] z-10"></div>
                                    @if ($item->foto)
                                        <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama }}"
                                            class="absolute inset-0 w-full h-full object-cover opacity-40 z-0 transition-opacity duration-500 group-[.au-slide-active]/slide:opacity-55"
                                            loading="lazy">
                                    @endif
                                    <i data-lucide="{{ $cfg['icon_lucide'] }}" class="w-24 h-24 stroke-[1.2] opacity-25 z-10 filter drop-shadow-lg transition-transform duration-500 group-[.au-slide-active]/slide:scale-105 text-white"></i>
                                    <span class="absolute bottom-6 left-6 text-[10px] font-semibold tracking-wider text-white/50 uppercase z-10">{{ $cfg['label'] }}</span>
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>

                <button class="absolute top-1/2 -translate-y-1/2 w-11 h-11 bg-white border border-primary/10 rounded-full flex items-center justify-center cursor-pointer z-20 shadow-lg transition duration-200 hover:bg-gray-900 hover:border-gray-900 group active:scale-95 -right-3 md:-right-5" onclick="auSlide(1)" aria-label="Berikutnya">
                    <i data-lucide="chevron-right" class="w-5 h-5 text-gray-700 transition-colors duration-200 group-hover:text-white"></i>
                </button>
            </div>

            <!-- DOTS & COUNTER -->
            <div class="flex items-center justify-between mt-5">
                <div class="flex items-center justify-center gap-2 mt-7" id="auDots"></div>
                <span class="text-xs text-gray-400 tracking-wider">
                    <strong id="auCurrent" class="text-gray-900">01</strong> /
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
                    d.className = 'w-1.5 h-1.5 rounded-full bg-primary/15 border-none p-0 cursor-pointer transition-all duration-300' + (i === 0 ? ' w-5 bg-gray-900' : '');
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

                document.querySelectorAll('.au-tipe-tab').forEach(t => {
                    t.classList.remove('bg-gray-900', 'text-white', 'border-gray-900');
                    t.classList.add('bg-transparent', 'text-gray-500', 'border-primary/15');
                });
                btn.classList.add('bg-gray-900', 'text-white', 'border-gray-900');
                btn.classList.remove('bg-transparent', 'text-gray-500', 'border-primary/15');

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
                if (visible.length === 0) return;
                current = ((idx % visible.length) + visible.length) % visible.length;

                const targetSlide = visible[current];

                track.style.transform = `translateX(-${current * 100}%)`;

                dotsWrap.querySelectorAll('button').forEach((d, i) => {
                    if (i === current) {
                        d.className = 'w-5 h-1.5 rounded-full bg-gray-900 border-none p-0 cursor-pointer transition-all duration-300';
                    } else {
                        d.className = 'w-1.5 h-1.5 rounded-full bg-primary/15 border-none p-0 cursor-pointer transition-all duration-300';
                    }
                });

                currentEl.textContent = String(current + 1).padStart(2, '0');

                allSlides.forEach((s) => {
                    s.classList.toggle('au-slide-active', s === targetSlide);
                });

                resetProgress();
            }

            window.auSlide = function(dir) {
                clearInterval(timer);
                goTo(current + dir);
                startAuto();
            };

            /* ── Progress bar ── */
            function resetProgress() {
                if (!progressEl) return;
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
            if (section) {
                section.addEventListener('mouseenter', () => clearInterval(timer));
                section.addEventListener('mouseleave', () => startAuto());
            }

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
