{{-- ═══════════════════════════════════════════════════════════════
AMAL USAHA — Cream theme, fully styled with Tailwind CSS
═══════════════════════════════════════════════════════════════ --}}

<section id="amal-usaha" class="bg-cream py-20 relative overflow-hidden">
    {{-- Subtle pattern --}}
    <div class="islamic-pattern absolute inset-0 opacity-30 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">

        {{-- HEADER --}}
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight m-0">
                    Lembaga <span class="text-primary">&amp;</span> Unit Kami
                </h2>
            </div>
            <div class="hidden md:block w-16 h-1 bg-gradient-to-r from-secondary to-primary rounded-full"></div>
        </div>

        @if($amalUsahaPerOrg->isNotEmpty())

            <div class="relative overflow-hidden rounded-2xl border border-primary/10 bg-white shadow-xl shadow-primary/5">

                <div id="auSliderTrack" class="flex transition-transform duration-700 ease-in-out">

                    @php
                        $colorSets = [
                            ['pill' => 'bg-primary/10 text-primary', 'grad' => 'from-primary to-primary-light', 'dot' => 'bg-primary'],
                            ['pill' => 'bg-secondary/10 text-secondary', 'grad' => 'from-secondary to-secondary-light', 'dot' => 'bg-secondary'],
                            ['pill' => 'bg-accent/15 text-primary-light', 'grad' => 'from-accent to-accent-green', 'dot' => 'bg-primary-light'],
                        ];
                        $tipeLabel = [
                            'bidang_sosial' => ['label' => 'Bidang Sosial', 'icon' => 'hand-helping'],
                            'bidang_kesehatan' => ['label' => 'Bidang Kesehatan', 'icon' => 'heart-pulse'],
                            'bidang_pendidikan' => ['label' => 'Bidang Pendidikan', 'icon' => 'graduation-cap'],
                        ];
                    @endphp

                    @foreach($amalUsahaPerOrg as $idx => $group)
                        @php $c = $colorSets[$idx % count($colorSets)]; @endphp

                        <div class="min-w-full grid md:grid-cols-2">

                            <div class="p-10 flex flex-col justify-center">
                                <div>
                                    <span
                                        class="{{ $c['pill'] }} inline-block py-1 px-3.5 rounded-full text-xs font-semibold mb-4">
                                        {{ $group['organisasi']->tipe ?? 'Organisasi Otonom' }}
                                    </span>

                                    <h2 class="text-2xl font-extrabold text-gray-900 mb-1 leading-tight">
                                        {{ $group['organisasi']->nama }}
                                    </h2>
                                    <p class="text-gray-400 text-xs mb-6">
                                        {{ $group['amalUsaha']->count() }} unit amal usaha
                                    </p>

                                    <ul class="list-none p-0 m-0 mb-6 flex flex-col gap-2.5">
                                        @forelse($group['amalUsaha'] as $au)
                                            <li class="flex items-start gap-2.5">
                                                <span class="mt-1.5 w-2 h-2 rounded-full {{ $c['dot'] }} shrink-0"></span>
                                                <div class="min-w-0">
                                                    <p class="text-sm font-semibold text-gray-900 leading-snug">{{ $au->nama }}</p>
                                                    @if($au->deskripsi)
                                                        <p class="text-xs text-gray-400 mt-0.5 line-clamp-1">{{ $au->deskripsi }}</p>
                                                    @endif
                                                    @if(isset($tipeLabel[$au->tipe]))
                                                        <span
                                                            class="{{ $c['pill'] }} inline-flex items-center gap-1 mt-1 text-[10px] font-semibold py-0.5 px-2.5 rounded-full">
                                                            <i data-lucide="{{ $tipeLabel[$au->tipe]['icon'] }}" class="w-3 h-3"></i> {{ $tipeLabel[$au->tipe]['label'] }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </li>
                                        @empty
                                            <li class="text-gray-400 text-sm italic">Belum ada amal usaha terdaftar.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>

                            {{-- RIGHT: FOTO / GRADIENT --}}
                            <div
                                class="bg-gradient-to-br {{ $c['grad'] }} flex items-center justify-center p-10 min-h-[280px] relative overflow-hidden">
                                @if($group['amalUsaha']->first()?->foto)
                                    <img src="{{ asset('storage/' . $group['amalUsaha']->first()->foto) }}"
                                        alt="{{ $group['organisasi']->nama }}"
                                        class="absolute inset-0 w-full h-full object-cover opacity-30" />
                                @endif
                                <div class="relative z-10 text-center text-white">
                                    <i data-lucide="landmark" class="w-16 h-16 text-white opacity-85 mx-auto mb-4"></i>
                                    <p class="font-bold text-lg opacity-90">{{ $group['organisasi']->nama }}</p>
                                    <p class="text-white/50 text-xs mt-1">{{ $group['amalUsaha']->count() }} Unit</p>
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>{{-- /sliderTrack --}}

                {{-- NAV ARROWS --}}
                <button onclick="auPrev()"
                    class="absolute left-3 top-1/2 -translate-y-1/2 bg-white border border-primary/10 shadow-lg p-2.5 rounded-full cursor-pointer z-10 transition duration-200 hover:bg-primary hover:text-white hover:border-primary flex items-center justify-center">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </button>
                <button onclick="auNext()"
                    class="absolute right-3 top-1/2 -translate-y-1/2 bg-white border border-primary/10 shadow-lg p-2.5 rounded-full cursor-pointer z-10 transition duration-200 hover:bg-primary hover:text-white hover:border-primary flex items-center justify-center">
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </button>

                {{-- DOTS --}}
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                    @foreach($amalUsahaPerOrg as $i => $_)
                        <button onclick="auGoTo({{ $i }})" id="au-dot-{{ $i }}"
                            class="h-2 rounded-full border-none cursor-pointer transition-all duration-300 {{ $i === 0 ? 'w-5 bg-secondary' : 'w-2 bg-white/40' }}">
                        </button>
                    @endforeach
                </div>

            </div>{{-- /slider wrapper --}}

        @else
            <div class="text-center py-16 text-gray-400">
                <p class="text-base">Belum ada data amal usaha.</p>
            </div>
        @endif

    </div>
</section>

<script>
    (function () {
        const total = {{ $amalUsahaPerOrg->count() }};
        let current = 0;

        function auRender() {
            document.getElementById('auSliderTrack').style.transform = `translateX(-${current * 100}%)`;
            for (let i = 0; i < total; i++) {
                const dot = document.getElementById('au-dot-' + i);
                if (!dot) continue;
                if (i === current) {
                    dot.className = 'w-5 h-2 rounded-full border-none cursor-pointer transition-all duration-300 bg-secondary';
                } else {
                    dot.className = 'w-2 h-2 rounded-full border-none cursor-pointer transition-all duration-300 bg-white/40';
                }
            }
        }

        window.auNext = function () { current = (current + 1) % total; auRender(); };
        window.auPrev = function () { current = (current - 1 + total) % total; auRender(); };
        window.auGoTo = function (i) { current = i; auRender(); };
    })();
</script>