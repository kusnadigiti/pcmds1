<nav class="fixed w-full z-50 top-0 start-0 font-sans transition-all duration-300 bg-accent-green"
    id="main-nav" x-data="{ open: false }">
    @once
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endonce

    @php
        // Baca menu dari DB, fallback ke kosong jika tabel belum ada
        try {
            $navMenus = \App\Models\NavMenu::topLevel()->visible()->with(['children' => function($q) {
                $q->visible()
                    ->whereRaw('LOWER(label) NOT LIKE ?', ['%sejarah%'])
                    ->whereRaw('LOWER(label) NOT LIKE ?', ['%visi misi%'])
                    ->orderBy('order');
            }])->get();
        } catch (\Exception $e) {
            $navMenus = collect();
        }

        // Ortom dinamis (tetap dari DB organisasi)
        try {
            $navOrtoms = \App\Models\Organisasi::where('is_active', true)
                ->orderBy('tipe')
                ->orderBy('nama')
                ->get();
        } catch (\Exception $e) {
            $navOrtoms = collect();
        }

        $hasOrtomNav = $navMenus->contains(fn($m) => Str::contains(strtolower($m->label), 'otonom'));
        $hasPrmNav = $navMenus->contains(fn($m) => $m->label === 'PRM');
    @endphp

    <div class="max-w-screen-xl mx-auto px-5 h-16 md:h-[72px] flex items-center justify-between">

        {{-- Logo --}}
        <a href="/" class="flex items-center gap-3 no-underline group">
            <div class="w-10 h-10 rounded-lg overflow-hidden border border-white/10 flex-shrink-0 bg-white/5 flex items-center justify-center">
                <img src="{{ asset('images/logo.png') }}"
                    class="w-full h-full object-cover"
                    alt="Logo PCM Duren Sawit 1" />
            </div>
            <div class="leading-none">
                <span class="block text-[15px] font-bold text-white tracking-tight">PCM Duren Sawit 1</span>
                <span class="block text-[10px] text-secondary/80 font-medium tracking-[0.15em] uppercase mt-[3px]">Muhammadiyah Berkemajuan</span>
            </div>
        </a>

        {{-- Desktop Menu — dinamis dari DB --}}
        <div class="hidden md:flex items-center gap-0.5">

            @foreach($navMenus as $menu)
                @if(Str::contains(strtolower($menu->label), 'otonom') && $navOrtoms->isNotEmpty())
                    {{-- Dropdown menu Organisasi Otonom --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="text-white/60 hover:text-white text-[13px] font-medium py-2 px-3.5 rounded-md transition duration-150 flex items-center gap-1.5 cursor-pointer hover:bg-white/[0.06]">
                            {{ $menu->label }}
                            <svg class="w-3.5 h-3.5 opacity-50 transition-transform duration-200" :class="open ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1"
                            style="display:none;"
                            class="absolute left-0 top-full pt-2 w-56 z-[100]">
                            <div class="bg-[#0a1e12] border border-white/[0.08] rounded-xl shadow-2xl py-1.5 flex flex-col">
                                @foreach($navOrtoms as $ortom)
                                    <a href="{{ route('organisasi-otonom.show', $ortom->slug) }}"
                                        class="block px-4 py-2.5 text-[13px] text-white/70 hover:text-white hover:bg-white/[0.06] transition duration-150 no-underline">
                                        {{ $ortom->nama }} {{ $ortom->singkatan ? '('.$ortom->singkatan.')' : '' }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @elseif($menu->children->isNotEmpty())
                    {{-- Dropdown menu --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="text-white/60 hover:text-white text-[13px] font-medium py-2 px-3.5 rounded-md transition duration-150 flex items-center gap-1.5 cursor-pointer hover:bg-white/[0.06]">
                            {{ $menu->label }}
                            <svg class="w-3.5 h-3.5 opacity-50 transition-transform duration-200" :class="open ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1"
                            style="display:none;"
                            class="absolute left-0 top-full pt-2 w-52 z-[100]">
                            <div class="bg-[#0a1e12] border border-white/[0.08] rounded-xl shadow-2xl py-1.5 flex flex-col">
                                @foreach($menu->children as $child)
                                    <a href="{{ $child->url }}"
                                        class="block px-4 py-2.5 text-[13px] text-white/70 hover:text-white hover:bg-white/[0.06] transition duration-150 no-underline"
                                        {{ $child->open_new_tab ? 'target="_blank" rel="noopener"' : '' }}>
                                        {{ $child->label }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @elseif($menu->url)
                    {{-- Simple link --}}
                    <a href="{{ $menu->url }}"
                        class="text-white/60 hover:text-white text-[13px] font-medium py-2 px-3.5 rounded-md no-underline transition duration-150 hover:bg-white/[0.06]"
                        {{ $menu->open_new_tab ? 'target="_blank" rel="noopener"' : '' }}>
                        {{ $menu->label }}
                    </a>
                @endif

                @if(!$hasOrtomNav && $navOrtoms->isNotEmpty() && (($hasPrmNav && $menu->label === 'PRM') || (!$hasPrmNav && $loop->last)))
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="text-white/60 hover:text-white text-[13px] font-medium py-2 px-3.5 rounded-md transition duration-150 flex items-center gap-1.5 cursor-pointer hover:bg-white/[0.06]">
                            Organisasi Otonom
                            <svg class="w-3.5 h-3.5 opacity-50 transition-transform duration-200" :class="open ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1"
                            style="display:none;"
                            class="absolute left-0 top-full pt-2 w-56 z-[100]">
                            <div class="bg-[#0a1e12] border border-white/[0.08] rounded-xl shadow-2xl py-1.5 flex flex-col">
                                @foreach($navOrtoms as $ortom)
                                    <a href="{{ route('organisasi-otonom.show', $ortom->slug) }}"
                                        class="block px-4 py-2.5 text-[13px] text-white/70 hover:text-white hover:bg-white/[0.06] transition duration-150 no-underline">
                                        {{ $ortom->nama }} {{ $ortom->singkatan ? '('.$ortom->singkatan.')' : '' }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            @auth
                @php
                    $dashboardRoute = match (auth()->user()->role) {
                        'superadmin' => route('admin.dashboard'),
                        'admin' => route('admin.dashboard'),
                        'penulis' => route('penulis.dashboard'),
                        'bendahara' => route('bendahara.dashboard'),
                        default => route('dashboard'),
                    };
                @endphp
                <a href="{{ $dashboardRoute }}"
                    class="bg-secondary/90 hover:bg-secondary text-accent text-[13px] font-semibold py-[7px] px-4 rounded-md no-underline transition duration-150 ml-2">
                    Dashboard
                </a>
            @endauth
        </div>

        {{-- Mobile Toggle — two lines --}}
        <button @click="open = !open"
            class="md:hidden flex flex-col items-end justify-center gap-[5px] w-[38px] h-[38px] rounded-lg cursor-pointer transition duration-150"
            aria-label="Toggle menu">
            <span :class="open ? 'w-[18px] rotate-45 translate-y-[3.5px]' : 'w-[18px]'"
                class="block h-[1.5px] bg-white/70 rounded-full transition-all duration-200 origin-center"></span>
            <span :class="open ? 'w-[18px] -rotate-45 -translate-y-[3.5px]' : 'w-[12px]'"
                class="block h-[1.5px] bg-secondary/80 rounded-full transition-all duration-200 origin-center"></span>
        </button>

    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="md:hidden absolute top-16 left-0 w-full bg-[#0a1e12] border-t border-white/[0.06] max-h-[80vh] overflow-y-auto"
        @click.outside="open = false">

        <div class="px-5 py-4 flex flex-col gap-0.5">

            @foreach($navMenus as $menu)
                @if(Str::contains(strtolower($menu->label), 'otonom') && $navOrtoms->isNotEmpty())
                    <div x-data="{ sub: false }">
                        <button @click="sub = !sub"
                            class="w-full text-left py-2.5 px-3 text-[14px] text-white/50 rounded-lg transition duration-150 hover:text-white hover:bg-white/[0.04] flex justify-between items-center">
                            {{ $menu->label }}
                            <svg class="w-4 h-4 opacity-40 transition-transform duration-200" :class="sub ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <div x-show="sub" x-collapse class="pl-3 pb-1 space-y-0.5 mt-0.5">
                            @foreach($navOrtoms as $ortom)
                                <a href="{{ route('organisasi-otonom.show', $ortom->slug) }}" @click="open = false"
                                    class="block py-2 px-3 text-[13px] text-white/40 rounded-lg hover:text-white hover:bg-white/[0.04] no-underline">
                                    {{ $ortom->nama }} {{ $ortom->singkatan ? '('.$ortom->singkatan.')' : '' }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @elseif($menu->children->isNotEmpty())
                    {{-- Mobile accordion --}}
                    <div x-data="{ sub: false }">
                        <button @click="sub = !sub"
                            class="w-full text-left py-2.5 px-3 text-[14px] text-white/50 rounded-lg transition duration-150 hover:text-white hover:bg-white/[0.04] flex justify-between items-center">
                            {{ $menu->label }}
                            <svg class="w-4 h-4 opacity-40 transition-transform duration-200" :class="sub ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <div x-show="sub" x-collapse class="pl-3 pb-1 space-y-0.5 mt-0.5">
                            @foreach($menu->children as $child)
                                <a href="{{ $child->url }}" @click="open = false"
                                    class="block py-2 px-3 text-[13px] text-white/40 rounded-lg hover:text-white hover:bg-white/[0.04] no-underline"
                                    {{ $child->open_new_tab ? 'target="_blank" rel="noopener"' : '' }}>
                                    {{ $child->label }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @elseif($menu->url)
                    {{-- Mobile simple link --}}
                    <a href="{{ $menu->url }}" @click="open = false"
                        class="block py-2.5 px-3 text-[14px] text-white/50 rounded-lg no-underline transition duration-150 hover:text-white hover:bg-white/[0.04]"
                        {{ $menu->open_new_tab ? 'target="_blank" rel="noopener"' : '' }}>
                        {{ $menu->label }}
                    </a>
                @endif

                @if(!$hasOrtomNav && $navOrtoms->isNotEmpty() && (($hasPrmNav && $menu->label === 'PRM') || (!$hasPrmNav && $loop->last)))
                    <div x-data="{ sub: false }">
                        <button @click="sub = !sub"
                            class="w-full text-left py-2.5 px-3 text-[14px] text-white/50 rounded-lg transition duration-150 hover:text-white hover:bg-white/[0.04] flex justify-between items-center">
                            Organisasi Otonom
                            <svg class="w-4 h-4 opacity-40 transition-transform duration-200" :class="sub ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <div x-show="sub" x-collapse class="pl-3 pb-1 space-y-0.5 mt-0.5">
                            @foreach($navOrtoms as $ortom)
                                <a href="{{ route('organisasi-otonom.show', $ortom->slug) }}" @click="open = false"
                                    class="block py-2 px-3 text-[13px] text-white/40 rounded-lg hover:text-white hover:bg-white/[0.04] no-underline">
                                    {{ $ortom->nama }} {{ $ortom->singkatan ? '('.$ortom->singkatan.')' : '' }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

            {{-- Dashboard (auth) --}}
            @auth
                @php
                    $dashboardRoute = match (auth()->user()->role) {
                        'superadmin' => route('admin.dashboard'),
                        'admin' => route('admin.dashboard'),
                        'penulis' => route('penulis.dashboard'),
                        'bendahara' => route('bendahara.dashboard'),
                        default => route('dashboard'),
                    };
                @endphp
                <a href="{{ $dashboardRoute }}" @click="open = false"
                    class="block py-2.5 px-3 mt-1 text-[14px] font-medium text-accent bg-secondary/90 hover:bg-secondary rounded-lg no-underline text-center transition duration-150">
                    Dashboard
                </a>
            @endauth

        </div>
    </div>

</nav>
