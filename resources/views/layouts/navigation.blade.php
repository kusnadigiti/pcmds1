<nav class="fixed w-full z-50 top-0 start-0 font-sans transition-all duration-300 bg-accent-green/95 backdrop-blur-md border-b border-secondary/25" id="main-nav"
    x-data="{ open: false }">
    @once
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endonce

    <div class="max-w-screen-xl mx-auto px-4 h-16 md:h-20 flex items-center justify-between">

        <a href="/" class="flex items-center space-x-3 no-underline">
            <div class="relative">
                <div class="absolute -inset-[3px] rounded-full bg-gradient-to-br from-secondary to-primary opacity-60 z-0"></div>
                <img src="https://i.pinimg.com/564x/29/e9/30/29e9307518d8366f97a6d26e888c6bf4.jpg"
                    class="w-9 h-9 rounded-full relative z-10 border-2 border-secondary/50"
                    alt="Logo PCM Duren Sawit 1" />
            </div>
            <div>
                <span class="block text-base font-bold text-white leading-tight">PCM Duren Sawit 1</span>
                <span class="block text-[10px] text-secondary tracking-widest uppercase">Muhammadiyah Berkemajuan</span>
            </div>
        </a>

        <div class="hidden md:flex items-center gap-1">
            <a href="/" onclick="handleNav(event,'beranda')" data-nav="beranda"
                class="text-secondary text-[13px] font-semibold py-1.5 px-3.5 rounded-lg no-underline transition duration-200 tracking-wide">Beranda</a>
            
            <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="text-white/80 hover:text-secondary hover:bg-secondary/10 text-[13px] font-medium py-1.5 px-3.5 rounded-lg no-underline transition duration-200 flex items-center gap-1 cursor-pointer">
                    Profil
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition.opacity.duration.200ms style="display: none;" class="absolute left-0 mt-0 w-48 pt-2 z-50">
                    <div class="bg-accent-green/95 backdrop-blur-md border border-secondary/25 rounded-lg shadow-lg py-2 flex flex-col gap-1">
                        <a href="/#profil" class="block px-4 py-2 text-sm text-white/80 hover:text-secondary hover:bg-secondary/10 transition duration-200">Sejarah</a>
                        <a href="/#profil" class="block px-4 py-2 text-sm text-white/80 hover:text-secondary hover:bg-secondary/10 transition duration-200">Visi & Misi</a>
                        <a href="{{ route('struktur-organisasi') }}" class="block px-4 py-2 text-sm text-white/80 hover:text-secondary hover:bg-secondary/10 transition duration-200">Struktur Organisasi</a>
                    </div>
                </div>
            </div>

            <a href="/#artikel" onclick="handleNav(event,'artikel')" data-nav="artikel"
                class="text-white/80 hover:text-secondary hover:bg-secondary/10 text-[13px] font-medium py-1.5 px-3.5 rounded-lg no-underline transition duration-200">Artikel</a>
            <a href="/#berita" onclick="handleNav(event,'berita')" data-nav="berita"
                class="text-white/80 hover:text-secondary hover:bg-secondary/10 text-[13px] font-medium py-1.5 px-3.5 rounded-lg no-underline transition duration-200">Berita</a>
            
            <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="text-white/80 hover:text-secondary hover:bg-secondary/10 text-[13px] font-medium py-1.5 px-3.5 rounded-lg no-underline transition duration-200 flex items-center gap-1 cursor-pointer">
                    Kegiatan
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition.opacity.duration.200ms style="display: none;" class="absolute left-0 mt-0 w-48 pt-2 z-50">
                    <div class="bg-accent-green/95 backdrop-blur-md border border-secondary/25 rounded-lg shadow-lg py-2 flex flex-col gap-1">
                        <a href="/#kegiatan" class="block px-4 py-2 text-sm text-white/80 hover:text-secondary hover:bg-secondary/10 transition duration-200">Agenda</a>
                        <a href="/#kegiatan" class="block px-4 py-2 text-sm text-white/80 hover:text-secondary hover:bg-secondary/10 transition duration-200">Galeri</a>
                    </div>
                </div>
            </div>

            <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="text-white/80 hover:text-secondary hover:bg-secondary/10 text-[13px] font-medium py-1.5 px-3.5 rounded-lg no-underline transition duration-200 flex items-center gap-1 cursor-pointer">
                    Ortom
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition.opacity.duration.200ms style="display: none;" class="absolute left-0 mt-0 w-48 pt-2 z-50">
                    <div class="bg-accent-green/95 backdrop-blur-md border border-secondary/25 rounded-lg shadow-lg py-2 flex flex-col gap-1">
                        <a href="/#ortom" class="block px-4 py-2 text-sm text-white/80 hover:text-secondary hover:bg-secondary/10 transition duration-200">Aisyiyah</a>
                        <a href="/#ortom" class="block px-4 py-2 text-sm text-white/80 hover:text-secondary hover:bg-secondary/10 transition duration-200">Pemuda Muhammadiyah</a>
                        <a href="/#ortom" class="block px-4 py-2 text-sm text-white/80 hover:text-secondary hover:bg-secondary/10 transition duration-200">Nasyiatul Aisyiyah</a>
                    </div>
                </div>
            </div>

            <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="text-white/80 hover:text-secondary hover:bg-secondary/10 text-[13px] font-medium py-1.5 px-3.5 rounded-lg no-underline transition duration-200 flex items-center gap-1 cursor-pointer">
                    Amal Usaha
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition.opacity.duration.200ms style="display: none;" class="absolute left-0 mt-0 w-48 pt-2 z-50">
                    <div class="bg-accent-green/95 backdrop-blur-md border border-secondary/25 rounded-lg shadow-lg py-2 flex flex-col gap-1">
                        <a href="/#amal-usaha" class="block px-4 py-2 text-sm text-white/80 hover:text-secondary hover:bg-secondary/10 transition duration-200">Pendidikan</a>
                        <a href="/#amal-usaha" class="block px-4 py-2 text-sm text-white/80 hover:text-secondary hover:bg-secondary/10 transition duration-200">Kesehatan</a>
                        <a href="/#amal-usaha" class="block px-4 py-2 text-sm text-white/80 hover:text-secondary hover:bg-secondary/10 transition duration-200">Ekonomi</a>
                    </div>
                </div>
            </div>

            <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="text-white/80 hover:text-secondary hover:bg-secondary/10 text-[13px] font-medium py-1.5 px-3.5 rounded-lg no-underline transition duration-200 flex items-center gap-1 cursor-pointer">
                    PRM
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition.opacity.duration.200ms style="display: none;" class="absolute left-0 mt-0 w-48 pt-2 z-50">
                    <div class="bg-accent-green/95 backdrop-blur-md border border-secondary/25 rounded-lg shadow-lg py-2 flex flex-col gap-1">
                        <a href="/#prm" class="block px-4 py-2 text-sm text-white/80 hover:text-secondary hover:bg-secondary/10 transition duration-200">Daftar PRM</a>
                        <a href="/#prm" class="block px-4 py-2 text-sm text-white/80 hover:text-secondary hover:bg-secondary/10 transition duration-200">Info PRM</a>
                    </div>
                </div>
            </div>

            <a href="/#kontak" onclick="handleNav(event,'kontak')" data-nav="kontak"
                class="text-white/80 hover:text-secondary hover:bg-secondary/10 text-[13px] font-medium py-1.5 px-3.5 rounded-lg no-underline transition duration-200">Kontak</a>
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
                    class="bg-gradient-to-r from-primary to-primary-light text-white text-[13px] font-bold py-2 px-4 rounded-full no-underline border border-secondary/40 transition duration-200 ml-1.5 hover:from-secondary hover:to-secondary-light hover:text-accent">
                    Dashboard
                </a>
            @endauth
        </div>

        {{-- Mobile Hamburger --}}
        <button @click="open = !open"
            class="md:hidden flex flex-col items-center justify-center gap-[5px] w-[38px] h-[38px] rounded-lg bg-secondary/10 border border-secondary/30 cursor-pointer transition duration-200"
            aria-label="Toggle menu">
            <span :class="open ? 'rotate-45 translate-y-[7px]' : ''"
                class="block w-[18px] h-[2px] bg-secondary rounded-[2px] transition duration-300"></span>
            <span :class="open ? 'opacity-0' : ''"
                class="block w-[18px] h-[2px] bg-secondary rounded-[2px] transition duration-300"></span>
            <span :class="open ? '-rotate-45 -translate-y-[7px]' : ''"
                class="block w-[18px] h-[2px] bg-secondary rounded-[2px] transition duration-300"></span>
        </button>

    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden absolute top-16 left-0 w-full shadow-lg bg-accent-green/98 backdrop-blur-md border-b border-secondary/20"
        @click.outside="open = false">
        <ul class="p-3 flex flex-col gap-0.5">
            <li><a href="/#beranda" @click="open = false" data-nav="beranda"
                    class="block py-2.5 px-3.5 text-sm font-semibold text-secondary rounded-lg no-underline bg-secondary/8"><i data-lucide="home" class="w-4 h-4 mr-1 inline-block align-middle"></i> Beranda</a></li>
            
            <li x-data="{ openSub: false }">
                <button @click="openSub = !openSub" class="w-full text-left py-2.5 px-3.5 text-sm text-white/80 rounded-lg no-underline transition duration-200 hover:bg-secondary/10 hover:text-secondary flex justify-between items-center">
                    Profil
                    <svg class="w-4 h-4 transition-transform duration-200" :class="openSub ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="openSub" style="display: none;" class="pl-4 py-1 space-y-1">
                    <a href="/#profil" @click="open = false" class="block py-2 px-3 text-sm text-white/70 rounded-lg hover:text-secondary hover:bg-secondary/10">Sejarah</a>
                    <a href="/#profil" @click="open = false" class="block py-2 px-3 text-sm text-white/70 rounded-lg hover:text-secondary hover:bg-secondary/10">Visi & Misi</a>
                    <a href="{{ route('struktur-organisasi') }}" @click="open = false" class="block py-2 px-3 text-sm text-white/70 rounded-lg hover:text-secondary hover:bg-secondary/10">Struktur Organisasi</a>
                </div>
            </li>

            <li><a href="/#artikel" @click="open = false" data-nav="artikel"
                    class="block py-2.5 px-3.5 text-sm text-white/80 rounded-lg no-underline transition duration-200 hover:bg-secondary/10 hover:text-secondary">Artikel</a></li>
            <li><a href="/#berita" @click="open = false" data-nav="berita"
                    class="block py-2.5 px-3.5 text-sm text-white/80 rounded-lg no-underline transition duration-200 hover:bg-secondary/10 hover:text-secondary">Berita</a></li>
            
            <li x-data="{ openSub: false }">
                <button @click="openSub = !openSub" class="w-full text-left py-2.5 px-3.5 text-sm text-white/80 rounded-lg no-underline transition duration-200 hover:bg-secondary/10 hover:text-secondary flex justify-between items-center">
                    Kegiatan
                    <svg class="w-4 h-4 transition-transform duration-200" :class="openSub ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="openSub" style="display: none;" class="pl-4 py-1 space-y-1">
                    <a href="/#kegiatan" @click="open = false" class="block py-2 px-3 text-sm text-white/70 rounded-lg hover:text-secondary hover:bg-secondary/10">Agenda</a>
                    <a href="/#kegiatan" @click="open = false" class="block py-2 px-3 text-sm text-white/70 rounded-lg hover:text-secondary hover:bg-secondary/10">Galeri</a>
                </div>
            </li>

            <li x-data="{ openSub: false }">
                <button @click="openSub = !openSub" class="w-full text-left py-2.5 px-3.5 text-sm text-white/80 rounded-lg no-underline transition duration-200 hover:bg-secondary/10 hover:text-secondary flex justify-between items-center">
                    Ortom
                    <svg class="w-4 h-4 transition-transform duration-200" :class="openSub ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="openSub" style="display: none;" class="pl-4 py-1 space-y-1">
                    <a href="/#ortom" @click="open = false" class="block py-2 px-3 text-sm text-white/70 rounded-lg hover:text-secondary hover:bg-secondary/10">Aisyiyah</a>
                    <a href="/#ortom" @click="open = false" class="block py-2 px-3 text-sm text-white/70 rounded-lg hover:text-secondary hover:bg-secondary/10">Pemuda Muhammadiyah</a>
                    <a href="/#ortom" @click="open = false" class="block py-2 px-3 text-sm text-white/70 rounded-lg hover:text-secondary hover:bg-secondary/10">Nasyiatul Aisyiyah</a>
                </div>
            </li>

            <li x-data="{ openSub: false }">
                <button @click="openSub = !openSub" class="w-full text-left py-2.5 px-3.5 text-sm text-white/80 rounded-lg no-underline transition duration-200 hover:bg-secondary/10 hover:text-secondary flex justify-between items-center">
                    Amal Usaha
                    <svg class="w-4 h-4 transition-transform duration-200" :class="openSub ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="openSub" style="display: none;" class="pl-4 py-1 space-y-1">
                    <a href="/#amal-usaha" @click="open = false" class="block py-2 px-3 text-sm text-white/70 rounded-lg hover:text-secondary hover:bg-secondary/10">Pendidikan</a>
                    <a href="/#amal-usaha" @click="open = false" class="block py-2 px-3 text-sm text-white/70 rounded-lg hover:text-secondary hover:bg-secondary/10">Kesehatan</a>
                    <a href="/#amal-usaha" @click="open = false" class="block py-2 px-3 text-sm text-white/70 rounded-lg hover:text-secondary hover:bg-secondary/10">Ekonomi</a>
                </div>
            </li>

            <li x-data="{ openSub: false }">
                <button @click="openSub = !openSub" class="w-full text-left py-2.5 px-3.5 text-sm text-white/80 rounded-lg no-underline transition duration-200 hover:bg-secondary/10 hover:text-secondary flex justify-between items-center">
                    PRM
                    <svg class="w-4 h-4 transition-transform duration-200" :class="openSub ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="openSub" style="display: none;" class="pl-4 py-1 space-y-1">
                    <a href="/#prm" @click="open = false" class="block py-2 px-3 text-sm text-white/70 rounded-lg hover:text-secondary hover:bg-secondary/10">Daftar PRM</a>
                    <a href="/#prm" @click="open = false" class="block py-2 px-3 text-sm text-white/70 rounded-lg hover:text-secondary hover:bg-secondary/10">Info PRM</a>
                </div>
            </li>

            <li><a href="/#kontak" @click="open = false" data-nav="kontak"
                    class="block py-2.5 px-3.5 text-sm text-white/80 rounded-lg no-underline transition duration-200 hover:bg-secondary/10 hover:text-secondary">Kontak</a></li>
        </ul>
    </div>

</nav>