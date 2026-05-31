<section id="amal-usaha" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="flex justify-between items-end mb-10">
            <div>
                <h6 class="text-emerald-600 font-bold uppercase tracking-widest flex items-center gap-2 mb-1">
                    <span>⚙️</span> Amal Usaha
                </h6>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                    Lembaga & Unit Kami
                </h2>
            </div>
            <div class="hidden md:block w-24 h-1 bg-yellow-400 rounded-full"></div>
        </div>

        @if($amalUsahaPerOrg->isNotEmpty())

        <div class="relative overflow-hidden rounded-3xl shadow-xl bg-white">

            <div id="auSliderTrack" class="flex transition-transform duration-700 ease-in-out">

                @php
                    $palette = [
                        ['badge_bg'=>'bg-emerald-50','badge_text'=>'text-emerald-600','btn'=>'bg-emerald-600 hover:bg-emerald-700','grad'=>'from-emerald-700 to-green-600','dot'=>'bg-emerald-500'],
                        ['badge_bg'=>'bg-sky-50',    'badge_text'=>'text-sky-600',    'btn'=>'bg-sky-600 hover:bg-sky-700',        'grad'=>'from-sky-700 to-blue-900',    'dot'=>'bg-sky-500'],
                        ['badge_bg'=>'bg-amber-50',  'badge_text'=>'text-amber-600',  'btn'=>'bg-amber-600 hover:bg-amber-700',    'grad'=>'from-amber-700 to-orange-900','dot'=>'bg-amber-500'],
                        ['badge_bg'=>'bg-indigo-50', 'badge_text'=>'text-indigo-600', 'btn'=>'bg-indigo-600 hover:bg-indigo-700',  'grad'=>'from-indigo-700 to-purple-900','dot'=>'bg-indigo-500'],
                        ['badge_bg'=>'bg-rose-50',   'badge_text'=>'text-rose-600',   'btn'=>'bg-rose-600 hover:bg-rose-700',      'grad'=>'from-rose-700 to-pink-900',   'dot'=>'bg-rose-500'],
                    ];
                    $tipeLabel = [
                        'bidang_sosial'     => ['label'=>'Bidang Sosial',     'icon'=>'🤝'],
                        'bidang_kesehatan'  => ['label'=>'Bidang Kesehatan',  'icon'=>'🏥'],
                        'bidang_pendidikan' => ['label'=>'Bidang Pendidikan', 'icon'=>'🎓'],
                    ];
                @endphp

                @foreach($amalUsahaPerOrg as $idx => $group)
                @php $c = $palette[$idx % count($palette)]; @endphp

                <div class="min-w-full grid md:grid-cols-2">

                    <div class="p-10 flex flex-col justify-between">
                        <div>
                            <span class="{{ $c['badge_bg'] }} {{ $c['badge_text'] }} px-4 py-1 rounded-full text-sm font-semibold w-fit mb-4 inline-block">
                                {{ $group['organisasi']->tipe ?? 'Organisasi Otonom' }}
                            </span>

                            <h2 class="text-3xl font-bold text-gray-900 mb-1 leading-tight">
                                {{ $group['organisasi']->nama }}
                            </h2>
                            <p class="text-gray-400 text-sm mb-6">
                                {{ $group['amalUsaha']->count() }} unit amal usaha
                            </p>

                            <ul class="au-list space-y-2 mb-8">
                                @forelse($group['amalUsaha'] as $au)
                                <li class="flex items-start gap-3 group/item">
                                    <span class="mt-1.5 w-2 h-2 rounded-full {{ $c['dot'] }} shrink-0"></span>
                                    <div class="min-w-0">
                                        <p class="text-gray-800 font-medium text-sm leading-snug">{{ $au->nama }}</p>
                                        @if($au->deskripsi)
                                        <p class="text-gray-400 text-xs mt-0.5 line-clamp-1">{{ $au->deskripsi }}</p>
                                        @endif
                                        @if(isset($tipeLabel[$au->tipe]))
                                        <span class="{{ $c['badge_bg'] }} {{ $c['badge_text'] }} text-xs font-semibold px-2 py-0.5 rounded-full mt-1 inline-block">
                                            {{ $tipeLabel[$au->tipe]['icon'] }} {{ $tipeLabel[$au->tipe]['label'] }}
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
                    <div class="bg-gradient-to-br {{ $c['grad'] }} flex items-center justify-center p-10 min-h-[280px] relative overflow-hidden">
                        @if($group['amalUsaha']->first()?->foto)
                            <img src="{{ asset('storage/' . $group['amalUsaha']->first()->foto) }}"
                                 alt="{{ $group['organisasi']->nama }}"
                                 class="w-full h-full object-cover absolute inset-0 opacity-40 mix-blend-luminosity"/>
                        @endif
                        <div class="relative z-10 text-center text-white">
                            <div class="text-7xl mb-4 opacity-80">🏛️</div>
                            <p class="font-bold text-xl opacity-90">{{ $group['organisasi']->nama }}</p>
                            <p class="text-white/60 text-sm mt-1">{{ $group['amalUsaha']->count() }} Unit</p>
                        </div>
                    </div>

                </div>
                @endforeach

            </div>{{-- /sliderTrack --}}

            {{-- NAV ARROWS --}}
            <button onclick="auPrev()"
                class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white shadow p-3 rounded-full transition z-10">
                ◀
            </button>
            <button onclick="auNext()"
                class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white shadow p-3 rounded-full transition z-10">
                ▶
            </button>

            {{-- DOTS --}}
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                @foreach($amalUsahaPerOrg as $i => $_)
                <button onclick="auGoTo({{ $i }})"
                    id="au-dot-{{ $i }}"
                    class="w-2 h-2 rounded-full transition-all duration-300 {{ $i === 0 ? 'bg-gray-800 w-5' : 'bg-gray-300' }}">
                </button>
                @endforeach
            </div>

        </div>{{-- /slider wrapper --}}

        @else
        <div class="text-center py-16 text-gray-400">
            <p class="text-lg">Belum ada data amal usaha.</p>
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
            dot.classList.toggle('bg-gray-800', i === current);
            dot.classList.toggle('w-5', i === current);
            dot.classList.toggle('bg-gray-300', i !== current);
            dot.classList.toggle('w-2', i !== current);
        }
    }

    window.auNext = function () { current = (current + 1) % total; auRender(); };
    window.auPrev = function () { current = (current - 1 + total) % total; auRender(); };
    window.auGoTo = function (i) { current = i; auRender(); };
})();
</script>
