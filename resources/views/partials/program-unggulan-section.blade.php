{{-- ═══════════════════════════════════════════════════════════════
     PROGRAM UNGGULAN — Islamic themed, fully styled with Tailwind CSS
     ═══════════════════════════════════════════════════════════════ --}}

<section id="program-unggulan" class="bg-gradient-to-b from-accent to-accent-green py-24 relative overflow-hidden">
    {{-- Background pattern --}}
    <div class="islamic-pattern absolute inset-0 opacity-[0.35] pointer-events-none"></div>
    <div class="absolute -bottom-30 -left-30 w-[400px] h-[400px] rounded-full border border-secondary/10 pointer-events-none"></div>

    <div class="max-w-5xl mx-auto px-6 relative z-10">

        {{-- ── HEADER ── --}}
        <div class="mb-12">
            <span class="inline-flex items-center gap-2 bg-secondary/10 border border-secondary/35 text-secondary text-[11px] font-bold tracking-wider uppercase py-1 px-4 rounded-full mb-4">✦ Fokus Gerakan</span>
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight text-white m-0">
                    Program <span class="text-shimmer">Unggulan</span>
                </h2>
                {{-- Tab pills --}}
                <div class="inline-flex bg-white/5 border border-white/10 rounded-full p-1 gap-1 overflow-x-auto">
                    <button class="prog-tab py-2 px-5 rounded-full text-sm font-semibold border-none cursor-pointer transition-all duration-200 whitespace-nowrap bg-primary text-white shadow-lg shadow-primary/20" onclick="openProgTab('kajian', this)">
                        Kajian &amp; Tabligh
                    </button>
                    <button class="prog-tab py-2 px-5 rounded-full text-sm font-semibold border-none cursor-pointer transition-all duration-200 whitespace-nowrap bg-transparent text-gray-400 hover:text-white" onclick="openProgTab('pendidikan', this)">
                        Pendidikan Kader
                    </button>
                    <button class="prog-tab py-2 px-5 rounded-full text-sm font-semibold border-none cursor-pointer transition-all duration-200 whitespace-nowrap bg-transparent text-gray-400 hover:text-white" onclick="openProgTab('ekonomi', this)">
                        Ekonomi Umat
                    </button>
                </div>
            </div>
            <div class="mt-6 h-px bg-secondary/15"></div>
        </div>

        {{-- ── CONTENT PANELS ── --}}

        {{-- KAJIAN --}}
        <div class="prog-panel active" id="prog-kajian">
            <div class="grid md:grid-cols-2 gap-10 items-center">

                {{-- Left: info --}}
                <div class="space-y-6">
                    <div>
                        <h3 class="text-2xl font-extrabold text-white mb-2 leading-snug">
                            Mencerahkan Umat<br>Melalui Kajian
                        </h3>
                        <p class="text-white/60 text-sm leading-relaxed">
                            Program pembinaan aqidah, ibadah, dan akhlak masyarakat melalui kajian rutin yang konsisten
                            dan terstruktur.
                        </p>
                    </div>

                    {{-- Feature pills --}}
                    <div class="flex flex-wrap gap-2">
                        @foreach (['Kajian Ahad Pagi', 'Kajian Tarjih', 'Pelatihan Mubaligh'] as $feat)
                        <span class="inline-flex items-center gap-1.5 text-xs font-medium py-1 px-3.5 border border-primary/30 bg-primary/10 text-white/90 rounded-full">
                            <svg class="w-2.5 h-2.5 text-primary-light" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="3"/></svg>
                            {{ $feat }}
                        </span>
                        @endforeach
                    </div>

                    {{-- Stats row --}}
                    <div class="flex gap-3">
                        <div class="flex-1 min-w-0 bg-white/5 border border-secondary/15 rounded-2xl p-4">
                            <p class="text-2xl font-bold text-white">
                                {{ $kajianPerTahun }}
                                <span class="text-secondary">×</span>
                            </p>
                            <p class="text-[10px] text-white/40 font-semibold mt-1 uppercase tracking-wider">
                                Kajian tahun {{ $currentYear }}
                            </p>
                        </div>
                        <div class="flex-1 min-w-0 bg-white/5 border border-secondary/15 rounded-2xl p-4">
                            <p class="text-2xl font-bold text-white">3<span class="text-secondary">+</span></p>
                            <p class="text-[10px] text-white/40 font-semibold mt-1 uppercase tracking-wider">Program aktif</p>
                        </div>
                        <div class="flex-1 min-w-0 bg-white/5 border border-secondary/15 rounded-2xl p-4">
                            <p class="text-2xl font-bold text-white">∞</p>
                            <p class="text-[10px] text-white/40 font-semibold mt-1 uppercase tracking-wider">Terbuka untuk umum</p>
                        </div>
                    </div>

                    <button onclick="openJadwalModal()" class="inline-flex items-center gap-2 text-sm font-semibold py-2.5 px-6 border-none rounded-full cursor-pointer transition-all duration-200 bg-primary text-white hover:bg-primary-light hover:translate-y-[-1px] hover:shadow-lg hover:shadow-primary/20 active:scale-95 no-underline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2"/>
                            <path d="M16 2v4M8 2v4M3 10h18"/>
                        </svg>
                        Lihat Jadwal Kajian
                    </button>
                </div>

                {{-- Right: illustration --}}
                <div class="flex justify-center md:justify-end">
                    <div class="w-full aspect-square max-w-[240px] rounded-3xl flex items-center justify-center text-7xl relative bg-primary/10 border border-primary/20">
                        🎤
                        <div class="absolute -top-3 -right-3 bg-white/10 backdrop-blur-md border border-secondary/20 rounded-2xl py-2 px-3 text-[10px] font-bold text-white flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                            Rutin setiap Ahad
                        </div>
                        <div class="absolute -bottom-3 -left-3 bg-primary rounded-2xl py-2 px-3.5 text-[10px] font-bold text-white shadow-lg shadow-primary/20">
                            Gratis &amp; Terbuka 🙌
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- PENDIDIKAN --}}
        <div class="prog-panel hidden" id="prog-pendidikan">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div class="space-y-6">
                    <div>
                        <h3 class="text-2xl font-extrabold text-white mb-2 leading-snug">
                            Mencetak Generasi<br>yang Tangguh
                        </h3>
                        <p class="text-white/60 text-sm leading-relaxed">
                            Fokus pada peningkatan kualitas pendidikan dan kaderisasi untuk masa depan umat yang lebih baik.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach (['Beasiswa Mentari', 'Digitalisasi Guru', 'Baitul Arqam'] as $feat)
                        <span class="inline-flex items-center gap-1.5 text-xs font-medium py-1 px-3.5 border border-secondary/30 bg-secondary/10 text-white/90 rounded-full">
                            <svg class="w-2.5 h-2.5 text-secondary-light" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="3"/></svg>
                            {{ $feat }}
                        </span>
                        @endforeach
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-1 min-w-0 bg-white/5 border border-secondary/15 rounded-2xl p-4">
                            <p class="text-2xl font-bold text-white">100<span class="text-secondary">+</span></p>
                            <p class="text-[10px] text-white/40 font-semibold mt-1 uppercase tracking-wider">Penerima beasiswa</p>
                        </div>
                        <div class="flex-1 min-w-0 bg-white/5 border border-secondary/15 rounded-2xl p-4">
                            <p class="text-2xl font-bold text-white">3</p>
                            <p class="text-[10px] text-white/40 font-semibold mt-1 uppercase tracking-wider">Lembaga pendidikan</p>
                        </div>
                    </div>
                    <button onclick="openModal('modalSekolah')" class="inline-flex items-center gap-2 text-sm font-semibold py-2.5 px-6 border-none rounded-full cursor-pointer transition-all duration-200 bg-secondary text-accent hover:bg-secondary-light hover:translate-y-[-1px] hover:shadow-lg hover:shadow-secondary/20 active:scale-95 no-underline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        </svg>
                        Info Sekolah
                    </button>
                </div>
                <div class="prog-emoji-wrap justify-end">
                    <div class="w-full aspect-square max-w-[240px] rounded-3xl flex items-center justify-center text-7xl relative bg-secondary/10 border border-secondary/20">
                        📚
                        <div class="absolute -top-3 -right-3 bg-white/10 backdrop-blur-md border border-secondary/20 rounded-2xl py-2 px-3 text-[10px] font-bold text-white flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                            Beasiswa aktif
                        </div>
                        <div class="absolute -bottom-3 -left-3 bg-secondary rounded-2xl py-2 px-3.5 text-[10px] font-bold text-accent shadow-lg shadow-secondary/20">
                            Daftar sekarang 🎓
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- EKONOMI --}}
        <div class="prog-panel hidden" id="prog-ekonomi">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div class="space-y-6">
                    <div>
                        <h3 class="text-2xl font-extrabold text-white mb-2 leading-snug">
                            Kemandirian<br>Ekonomi Umat
                        </h3>
                        <p class="text-white/60 text-sm leading-relaxed">
                            Penguatan ekonomi melalui jaringan saudagar Muhammadiyah yang kuat dan saling mendukung.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach (['Sertifikasi Halal', 'Koperasi Syariah', 'Bazar UMKM'] as $feat)
                        <span class="inline-flex items-center gap-1.5 text-xs font-medium py-1 px-3.5 border border-secondary/30 bg-secondary/10 text-white/90 rounded-full">
                            <svg class="w-2.5 h-2.5 text-secondary-light" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="3"/></svg>
                            {{ $feat }}
                        </span>
                        @endforeach
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-1 min-w-0 bg-white/5 border border-secondary/15 rounded-2xl p-4">
                            <p class="text-2xl font-bold text-white">200<span class="text-secondary">+</span></p>
                            <p class="text-[10px] text-white/40 font-semibold mt-1 uppercase tracking-wider">Anggota JSM</p>
                        </div>
                        <div class="flex-1 min-w-0 bg-white/5 border border-secondary/15 rounded-2xl p-4">
                            <p class="text-2xl font-bold text-white">3</p>
                            <p class="text-[10px] text-white/40 font-semibold mt-1 uppercase tracking-wider">Program ekonomi</p>
                        </div>
                    </div>
                    <button onclick="openModal('modalJSM')" class="inline-flex items-center gap-2 text-sm font-semibold py-2.5 px-6 border-none rounded-full cursor-pointer transition-all duration-200 bg-secondary text-accent hover:bg-secondary-light hover:translate-y-[-1px] hover:shadow-lg hover:shadow-secondary/20 active:scale-95 no-underline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                        Gabung JSM
                    </button>
                </div>
                <div class="prog-emoji-wrap justify-end">
                    <div class="w-full aspect-square max-w-[240px] rounded-3xl flex items-center justify-center text-7xl relative bg-secondary/10 border border-secondary/20">
                        🏪
                        <div class="absolute -top-3 -right-3 bg-white/10 backdrop-blur-md border border-secondary/20 rounded-2xl py-2 px-3 text-[10px] font-bold text-white flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                            Jaringan aktif
                        </div>
                        <div class="absolute -bottom-3 -left-3 bg-secondary rounded-2xl py-2 px-3.5 text-[10px] font-bold text-accent shadow-lg shadow-secondary/20">
                            UMKM Halal 🤝
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    function openProgTab(id, btn) {
        document.querySelectorAll('.prog-panel').forEach(p => p.classList.add('hidden'));
        document.querySelectorAll('.prog-tab').forEach(b => {
            b.classList.remove('bg-primary', 'text-white', 'shadow-lg', 'shadow-primary/20', 'text-white');
            b.classList.add('bg-transparent', 'text-gray-400', 'hover:text-white');
        });
        document.getElementById('prog-' + id).classList.remove('hidden');
        btn.classList.add('bg-primary', 'text-white', 'shadow-lg', 'shadow-primary/20');
        btn.classList.remove('bg-transparent', 'text-gray-400', 'hover:text-white');
    }
</script>
