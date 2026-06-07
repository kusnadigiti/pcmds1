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
            <a href="/#profil" onclick="handleNav(event,'profil')" data-nav="profil"
                class="text-white/80 hover:text-secondary hover:bg-secondary/10 text-[13px] font-medium py-1.5 px-3.5 rounded-lg no-underline transition duration-200">Profil</a>
            <a href="/#artikel" onclick="handleNav(event,'artikel')" data-nav="artikel"
                class="text-white/80 hover:text-secondary hover:bg-secondary/10 text-[13px] font-medium py-1.5 px-3.5 rounded-lg no-underline transition duration-200">Artikel</a>
            <a href="/#berita" onclick="handleNav(event,'berita')" data-nav="berita"
                class="text-white/80 hover:text-secondary hover:bg-secondary/10 text-[13px] font-medium py-1.5 px-3.5 rounded-lg no-underline transition duration-200">Berita</a>
            <a href="/#program" onclick="handleNav(event,'program')" data-nav="program"
                class="text-white/80 hover:text-secondary hover:bg-secondary/10 text-[13px] font-medium py-1.5 px-3.5 rounded-lg no-underline transition duration-200">Program</a>
            <a href="/#organisasi" onclick="handleNav(event,'organisasi')" data-nav="organisasi"
                class="text-white/80 hover:text-secondary hover:bg-secondary/10 text-[13px] font-medium py-1.5 px-3.5 rounded-lg no-underline transition duration-200">Organisasi</a>
            <a href="/#amal-usaha" onclick="handleNav(event,'amal-usaha')" data-nav="amal-usaha"
                class="text-white/80 hover:text-secondary hover:bg-secondary/10 text-[13px] font-medium py-1.5 px-3.5 rounded-lg no-underline transition duration-200">Amal Usaha</a>
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
            <li><a href="/#profil" @click="open = false" data-nav="profil"
                    class="block py-2.5 px-3.5 text-sm text-white/80 rounded-lg no-underline transition duration-200 hover:bg-secondary/10 hover:text-secondary">Profil</a></li>
            <li><a href="/#artikel" @click="open = false" data-nav="artikel"
                    class="block py-2.5 px-3.5 text-sm text-white/80 rounded-lg no-underline transition duration-200 hover:bg-secondary/10 hover:text-secondary">Artikel</a></li>
            <li><a href="/#berita" @click="open = false" data-nav="berita"
                    class="block py-2.5 px-3.5 text-sm text-white/80 rounded-lg no-underline transition duration-200 hover:bg-secondary/10 hover:text-secondary">Berita</a></li>
            <li><a href="/#program" @click="open = false" data-nav="program"
                    class="block py-2.5 px-3.5 text-sm text-white/80 rounded-lg no-underline transition duration-200 hover:bg-secondary/10 hover:text-secondary">Program</a></li>
            <li><a href="/#organisasi" @click="open = false" data-nav="organisasi"
                    class="block py-2.5 px-3.5 text-sm text-white/80 rounded-lg no-underline transition duration-200 hover:bg-secondary/10 hover:text-secondary">Organisasi Otonom</a></li>
            <li><a href="/#amal-usaha" @click="open = false" data-nav="amal-usaha"
                    class="block py-2.5 px-3.5 text-sm text-white/80 rounded-lg no-underline transition duration-200 hover:bg-secondary/10 hover:text-secondary">Amal Usaha</a></li>
            <li><a href="/#kontak" @click="open = false" data-nav="kontak"
                    class="block py-2.5 px-3.5 text-sm text-white/80 rounded-lg no-underline transition duration-200 hover:bg-secondary/10 hover:text-secondary">Kontak</a></li>
        </ul>
    </div>

</nav>