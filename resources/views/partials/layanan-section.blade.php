@php
    $tipeConfig = [
        'bidang_kesehatan' => [
            'label' => 'Bidang Kesehatan',
            'icon_lucide' => 'hospital',
            'badge' => 'bg-sky-50 text-sky-700',
        ],
        'bidang_pendidikan' => [
            'label' => 'Bidang Pendidikan',
            'icon_lucide' => 'graduation-cap',
            'badge' => 'bg-amber-50 text-amber-700',
        ],
        'bidang_sosial' => [
            'label' => 'Bidang Sosial',
            'icon_lucide' => 'hand-helping',
            'badge' => 'bg-indigo-50 text-indigo-700',
        ],
    ];

    $totalSlides = isset($amalUsahaList) ? $amalUsahaList->count() : 0;
@endphp

@if ($totalSlides > 0)
    <section id="amal-usaha-section" class="bg-bone py-24 relative">
        <div class="max-w-7xl mx-auto px-6">

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                <div>
                    <span class="section-label section-label-dark">Layanan &amp; Unit</span>
                    <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl leading-[1.15] text-gray-900">
                        Gerak Nyata<br>PCM Duren Sawit
                    </h2>
                </div>
                <p class="text-sm text-gray-500 leading-relaxed text-left md:text-right max-w-xs m-0">
                    Amal usaha yang menggerakkan kehidupan bermasyarakat PCM Duren Sawit.
                </p>
            </div>

            {{-- FILTER TABS --}}
            <div class="flex gap-2 flex-wrap mb-8" id="auTipeTabs">
                <button class="px-4 py-1.5 rounded-lg text-xs font-semibold border border-gray-900 bg-gray-900 text-white cursor-pointer transition duration-200 au-tipe-tab" data-tipe="all">
                    Semua
                </button>
                @foreach ($amalUsahaGrouped as $group)
                    @php
                        $cfg = $tipeConfig[$group['tipe']] ?? [
                            'label' => ucwords(str_replace('_', ' ', $group['tipe'])),
                            'badge' => 'bg-emerald-50 text-emerald-700'
                        ];
                    @endphp
                    <button class="px-4 py-1.5 rounded-lg text-xs font-semibold border border-gray-200 bg-transparent text-gray-500 cursor-pointer transition duration-200 hover:border-gray-900 hover:text-gray-900 au-tipe-tab" data-tipe="{{ $group['tipe'] }}">
                        {{ $cfg['label'] }} ({{ $group['count'] }})
                    </button>
                @endforeach
            </div>

            {{-- SLIDER --}}
            <div class="relative">
                <button class="absolute top-1/2 -translate-y-1/2 w-10 h-10 bg-white border border-gray-200 rounded-full flex items-center justify-center cursor-pointer z-20 shadow-md transition duration-200 hover:bg-gray-900 hover:border-gray-900 group active:scale-95 -left-3 md:-left-5" onclick="auSlide(-1)" aria-label="Sebelumnya">
                    <i data-lucide="chevron-left" class="w-4 h-4 text-gray-600 transition-colors duration-200 group-hover:text-white"></i>
                </button>

                <div class="overflow-hidden rounded-xl">
                    <div class="flex transition-transform duration-700 ease-in-out" id="auSliderTrack">

                        @foreach ($amalUsahaList as $index => $item)
                            @php
                                $cfg = $tipeConfig[$item->tipe] ?? [
                                    'label' => ucwords(str_replace('_', ' ', $item->tipe)),
                                    'icon_lucide' => 'clipboard',
                                    'badge' => 'bg-emerald-50 text-emerald-700',
                                ];
                            @endphp

                            <div class="au-slide group/slide min-w-full grid grid-cols-1 md:grid-cols-2 min-h-[380px]" data-tipe="{{ $item->tipe }}">

                                {{-- LEFT CONTENT --}}
                                <div class="p-8 md:p-10 flex flex-col justify-center bg-white border border-gray-200 rounded-t-xl md:rounded-l-xl md:rounded-tr-none md:border-r-0">

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold max-w-max mb-4 {{ $cfg['badge'] }}">
                                        {{ $cfg['label'] }}
                                    </span>

                                    <h3 class="font-display text-2xl md:text-3xl text-gray-900 leading-snug mb-3">{{ $item->nama }}</h3>

                                    @if ($item->deskripsi)
                                        <p class="text-sm text-gray-500 leading-relaxed m-0 line-clamp-4 mb-4">{{ Str::limit($item->deskripsi, 250) }}</p>
                                    @endif

                                    @if ($item->organisasiOtonom)
                                        <span class="inline-flex items-center gap-1.5 text-xs text-gray-500 font-medium bg-gray-50 border border-gray-100 py-1 px-3 rounded-lg max-w-max">
                                            <i data-lucide="award" class="w-3.5 h-3.5 text-gray-400"></i>
                                            {{ $item->organisasiOtonom->nama }}
                                        </span>
                                    @endif
                                </div>

                                {{-- RIGHT VISUAL --}}
                                <div class="relative overflow-hidden rounded-b-xl md:rounded-r-xl md:rounded-bl-none min-h-[200px] md:min-h-full flex items-center justify-center bg-gray-100">
                                    @if ($item->foto)
                                        <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama }}"
                                            class="absolute inset-0 w-full h-full object-cover opacity-50 transition-opacity duration-500 group-[.au-slide-active]/slide:opacity-65"
                                            loading="lazy">
                                    @endif
                                    <i data-lucide="{{ $cfg['icon_lucide'] }}" class="w-16 h-16 stroke-[1.5] text-gray-400 z-10 transition-transform duration-500 group-[.au-slide-active]/slide:scale-105"></i>
                                    <span class="absolute bottom-5 left-5 text-[10px] font-semibold tracking-wider text-gray-400 uppercase z-10">{{ $cfg['label'] }}</span>
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>

                <button class="absolute top-1/2 -translate-y-1/2 w-10 h-10 bg-white border border-gray-200 rounded-full flex items-center justify-center cursor-pointer z-20 shadow-md transition duration-200 hover:bg-gray-900 hover:border-gray-900 group active:scale-95 -right-3 md:-right-5" onclick="auSlide(1)" aria-label="Berikutnya">
                    <i data-lucide="chevron-right" class="w-4 h-4 text-gray-600 transition-colors duration-200 group-hover:text-white"></i>
                </button>
            </div>

            {{-- DOTS & COUNTER --}}
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

            let allSlides = Array.from(track.querySelectorAll('.au-slide'));
            let visible = [...allSlides];
            let current = 0;
            let timer = null;

            function buildDots(count) {
                dotsWrap.innerHTML = '';
                for (let i = 0; i < count; i++) {
                    const d = document.createElement('button');
                    d.className = 'w-1.5 h-1.5 rounded-full bg-gray-300 border-none p-0 cursor-pointer transition-all duration-300' + (i === 0 ? ' w-5 bg-gray-900' : '');
                    d.setAttribute('aria-label', 'Slide ' + (i + 1));
                    d.addEventListener('click', () => {
                        clearInterval(timer);
                        goTo(i);
                        startAuto();
                    });
                    dotsWrap.appendChild(d);
                }
            }

            document.getElementById('auTipeTabs').addEventListener('click', (e) => {
                const btn = e.target.closest('.au-tipe-tab');
                if (!btn) return;

                document.querySelectorAll('.au-tipe-tab').forEach(t => {
                    t.classList.remove('bg-gray-900', 'text-white', 'border-gray-900');
                    t.classList.add('bg-transparent', 'text-gray-500', 'border-gray-200');
                });
                btn.classList.add('bg-gray-900', 'text-white', 'border-gray-900');
                btn.classList.remove('bg-transparent', 'text-gray-500', 'border-gray-200');

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

            function goTo(idx) {
                if (visible.length === 0) return;
                current = ((idx % visible.length) + visible.length) % visible.length;

                const targetSlide = visible[current];

                track.style.transform = `translateX(-${current * 100}%)`;

                dotsWrap.querySelectorAll('button').forEach((d, i) => {
                    if (i === current) {
                        d.className = 'w-5 h-1.5 rounded-full bg-gray-900 border-none p-0 cursor-pointer transition-all duration-300';
                    } else {
                        d.className = 'w-1.5 h-1.5 rounded-full bg-gray-300 border-none p-0 cursor-pointer transition-all duration-300';
                    }
                });

                currentEl.textContent = String(current + 1).padStart(2, '0');

                allSlides.forEach((s) => {
                    s.classList.toggle('au-slide-active', s === targetSlide);
                });
            }

            window.auSlide = function(dir) {
                clearInterval(timer);
                goTo(current + dir);
                startAuto();
            };

            function startAuto() {
                clearInterval(timer);
                timer = setInterval(() => goTo(current + 1), INTERVAL);
            }

            const section = document.getElementById('amal-usaha-section');
            if (section) {
                section.addEventListener('mouseenter', () => clearInterval(timer));
                section.addEventListener('mouseleave', () => startAuto());
            }

            let touchX = 0;
            track.addEventListener('touchstart', e => {
                touchX = e.touches[0].clientX;
            }, { passive: true });
            track.addEventListener('touchend', e => {
                const diff = touchX - e.changedTouches[0].clientX;
                if (Math.abs(diff) > 40) window.auSlide(diff > 0 ? 1 : -1);
            }, { passive: true });

            buildDots(visible.length);
            goTo(0);
            startAuto();
        })();
    </script>
@endif
