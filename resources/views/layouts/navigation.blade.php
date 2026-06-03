<nav class="bg-white fixed w-full z-20 top-0 start-0 border-b border-gray-100 h-16 md:h-20 font-sans"
    x-data="{ open: false }">
    @once
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endonce
    <div class="max-w-screen-xl mx-auto px-4 h-full flex items-center justify-between">

        <a href="#beranda" class="flex items-center space-x-2.5">
            <img src="https://i.pinimg.com/564x/29/e9/30/29e9307518d8366f97a6d26e888c6bf4.jpg" class="h-7 rounded-full"
                alt="Logo" />
            <span class="text-base md:text-xl text-heading font-semibold whitespace-nowrap">
                PCM Duren Sawit 1
            </span>
        </a>

        <div class="hidden md:block">
            <ul class="font-medium flex space-x-8">
                <a href="/#beranda" class="text-fg-brand text-sm" onclick="handleNav(event,'beranda')">Beranda</a>
                <li><a href="/#profil" class="text-heading hover:text-fg-brand text-sm transition"
                        onclick="handleNav(event,'profil')">Profil</a></li>
                <li><a href="/#artikel" class="text-heading hover:text-fg-brand text-sm transition"
                        onclick="handleNav(event,'artikel')">Artikel</a></li>
                <li><a href="/#berita" class="text-heading hover:text-fg-brand text-sm transition"
                        onclick="handleNav(event,'berita')">Berita</a></li>
                <li><a href="/#program" class="text-heading hover:text-fg-brand text-sm transition"
                        onclick="handleNav(event,'program')">Program</a></li>
                <li><a href="/#organisasi" class="text-heading hover:text-fg-brand text-sm transition"
                        onclick="handleNav(event,'organisasi')">Organisasi Ortonom</a></li>
                <li><a href="/#amal-usaha" class="text-heading hover:text-fg-brand text-sm transition"
                        onclick="handleNav(event,'amal-usaha')">Amal Usaha</a></li>
                <li><a href="/#kontak" class="text-heading hover:text-fg-brand text-sm transition"
                        onclick="handleNav(event,'kontak')">Kontak</a></li>
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

                    <li>
                        <a href="{{ $dashboardRoute }}"
                            class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-emerald-700 transition">
                            Dashboard
                        </a>
                    </li>
                @endauth
            </ul>
        </div>

        <button @click="open = !open"
            class="md:hidden w-9 h-9 flex flex-col items-center justify-center gap-1.5 rounded-lg hover:bg-gray-50 transition"
            aria-label="Toggle menu">
            <span :class="open ? 'rotate-45 translate-y-[7px]' : ''"
                class="w-5 h-px bg-gray-700 rounded transition-all duration-200"></span>
            <span :class="open ? 'opacity-0' : ''"
                class="w-5 h-px bg-gray-700 rounded transition-all duration-200"></span>
            <span :class="open ? '-rotate-45 -translate-y-[7px]' : ''"
                class="w-5 h-px bg-gray-700 rounded transition-all duration-200"></span>
        </button>

    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden absolute top-16 left-0 w-full bg-white border-b border-gray-100 shadow-sm"
        @click.outside="open = false">
        <ul class="px-4 py-3 flex flex-col">
            <li><a href="/#beranda" @click="open = false"
                    class="flex items-center py-3 text-sm font-medium text-emerald-600 border-b border-gray-50">Beranda</a>
            </li>
            <li><a href="/#profil" @click="open = false"
                    class="flex items-center py-3 text-sm text-gray-700 hover:text-emerald-600 border-b border-gray-50 transition">Profil</a>
            </li>
            <li><a href="/#artikel" @click="open = false"
                    class="flex items-center py-3 text-sm text-gray-700 hover:text-emerald-600 border-b border-gray-50 transition">Artikel</a>
            </li>
            <li><a href="/#berita" @click="open = false"
                    class="flex items-center py-3 text-sm text-gray-700 hover:text-emerald-600 border-b border-gray-50 transition">Berita</a>
            </li>
            <li><a href="/#program" @click="open = false"
                    class="flex items-center py-3 text-sm text-gray-700 hover:text-emerald-600 border-b border-gray-50 transition">Program</a>
            </li>
            <li><a href="/#organisasi" @click="open = false"
                    class="flex items-center py-3 text-sm text-gray-700 hover:text-emerald-600 border-b border-gray-50 transition">Organisasi
                    Ortonom</a></li>
            <li><a href="/#amal-usaha" @click="open = false"
                    class="flex items-center py-3 text-sm text-gray-700 hover:text-emerald-600 border-b border-gray-50 transition">Amal
                    Usaha</a></li>
            <li><a href="/#kontak" @click="open = false"
                    class="flex items-center py-3 text-sm text-gray-700 hover:text-emerald-600 transition">Kontak</a>
            </li>
        </ul>
    </div>

</nav>
