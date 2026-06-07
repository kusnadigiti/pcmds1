{{-- ═══════════════════════════════════════════════════════════════
PROGRAM UNGGULAN — Islamic themed, fully styled with Tailwind CSS
═══════════════════════════════════════════════════════════════ --}}

<section id="program-unggulan" class="bg-gradient-to-b from-accent to-accent-green py-24 relative overflow-hidden">
    {{-- Background pattern --}}
    <div class="islamic-pattern absolute inset-0 opacity-[0.35] pointer-events-none"></div>
    <div
        class="absolute -bottom-30 -left-30 w-[400px] h-[400px] rounded-full border border-secondary/10 pointer-events-none">
    </div>

    <div class="max-w-5xl mx-auto px-6 relative z-10">

        {{-- ── HEADER ── --}}
        <div class="mb-12">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight text-white m-0">
                    Program <span class="text-shimmer">Unggulan</span>
                </h2>
                {{-- Tab pills --}}
                <div class="inline-flex bg-white/5 border border-white/10 rounded-full p-1 gap-1 overflow-x-auto">
                    <button
                        class="prog-tab py-2 px-5 rounded-full text-sm font-semibold border-none cursor-pointer transition-all duration-200 whitespace-nowrap bg-primary text-white shadow-lg shadow-primary/20"
                        onclick="openProgTab('kajian', this)">
                        Kajian &amp; Tabligh
                    </button>
                    <button
                        class="prog-tab py-2 px-5 rounded-full text-sm font-semibold border-none cursor-pointer transition-all duration-200 whitespace-nowrap bg-transparent text-gray-400 hover:text-white"
                        onclick="openProgTab('pendidikan', this)">
                        Pendidikan Kader
                    </button>
                    <button
                        class="prog-tab py-2 px-5 rounded-full text-sm font-semibold border-none cursor-pointer transition-all duration-200 whitespace-nowrap bg-transparent text-gray-400 hover:text-white"
                        onclick="openProgTab('ekonomi', this)">
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
                            <span
                                class="inline-flex items-center gap-1.5 text-xs font-medium py-1 px-3.5 border border-primary/30 bg-primary/10 text-white/90 rounded-full">
                                <i data-lucide="sparkles" class="w-2.5 h-2.5 text-primary-light"></i>
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
                            <p class="text-[10px] text-white/40 font-semibold mt-1 uppercase tracking-wider">Program
                                aktif</p>
                        </div>
                        <div class="flex-1 min-w-0 bg-white/5 border border-secondary/15 rounded-2xl p-4">
                            <p class="text-2xl font-bold text-white">∞</p>
                            <p class="text-[10px] text-white/40 font-semibold mt-1 uppercase tracking-wider">Terbuka
                                untuk umum</p>
                        </div>
                    </div>

                    <button onclick="openJadwalModal()"
                        class="inline-flex items-center gap-2 text-sm font-semibold py-2.5 px-6 border-none rounded-full cursor-pointer transition-all duration-200 bg-primary text-white hover:bg-primary-light hover:translate-y-[-1px] hover:shadow-lg hover:shadow-primary/20 active:scale-95 no-underline">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        Lihat Jadwal Kajian
                    </button>
                </div>

                {{-- Right: illustration --}}
                <div class="flex justify-center">
                    <div
                        class="w-full aspect-square max-w-[240px] rounded-3xl flex items-center justify-center text-7xl relative bg-primary/10 border border-primary/20">
                        <i data-lucide="mic" class="w-16 h-16 text-white opacity-80 z-10"></i>
                        <div
                            class="absolute -top-3 -right-3 bg-white/10 backdrop-blur-md border border-secondary/20 rounded-2xl py-2 px-3 text-[10px] font-bold text-white flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                            Rutin setiap Ahad
                        </div>
                        <div
                            class="absolute -bottom-3 -left-3 bg-primary rounded-2xl py-2 px-3.5 text-[10px] font-bold text-white shadow-lg shadow-primary/20">
                            Gratis &amp; Terbuka <i data-lucide="smile" class="w-3.5 h-3.5 inline ml-0.5"></i>
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
                            Fokus pada peningkatan kualitas pendidikan dan kaderisasi untuk masa depan umat yang lebih
                            baik.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach (['Beasiswa Mentari', 'Digitalisasi Guru', 'Baitul Arqam'] as $feat)
                            <span
                                class="inline-flex items-center gap-1.5 text-xs font-medium py-1 px-3.5 border border-secondary/30 bg-secondary/10 text-white/90 rounded-full">
                                <i data-lucide="sparkles" class="w-2.5 h-2.5 text-secondary-light"></i>
                                {{ $feat }}
                            </span>
                        @endforeach
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-1 min-w-0 bg-white/5 border border-secondary/15 rounded-2xl p-4">
                            <p class="text-2xl font-bold text-white">100<span class="text-secondary">+</span></p>
                            <p class="text-[10px] text-white/40 font-semibold mt-1 uppercase tracking-wider">Penerima
                                beasiswa</p>
                        </div>
                        <div class="flex-1 min-w-0 bg-white/5 border border-secondary/15 rounded-2xl p-4">
                            <p class="text-2xl font-bold text-white">3</p>
                            <p class="text-[10px] text-white/40 font-semibold mt-1 uppercase tracking-wider">Lembaga
                                pendidikan</p>
                        </div>
                    </div>
                    <button onclick="openModal('modalSekolah')"
                        class="inline-flex items-center gap-2 text-sm font-semibold py-2.5 px-6 border-none rounded-full cursor-pointer transition-all duration-200 bg-secondary text-accent hover:bg-secondary-light hover:translate-y-[-1px] hover:shadow-lg hover:shadow-secondary/20 active:scale-95 no-underline">
                        <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                        Info Sekolah
                    </button>
                </div>
                <div class="prog-emoji-wrap flex justify-center">
                    <div
                        class="w-full aspect-square max-w-[240px] rounded-3xl flex items-center justify-center text-7xl relative bg-secondary/10 border border-secondary/20">
                        <i data-lucide="book-open" class="w-16 h-16 text-white opacity-80 z-10"></i>
                        <div
                            class="absolute -top-3 -right-3 bg-white/10 backdrop-blur-md border border-secondary/20 rounded-2xl py-2 px-3 text-[10px] font-bold text-white flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                            Beasiswa aktif
                        </div>
                        <div
                            class="absolute -bottom-3 -left-3 bg-secondary rounded-2xl py-2 px-3.5 text-[10px] font-bold text-accent shadow-lg shadow-secondary/20">
                            Daftar sekarang <i data-lucide="graduation-cap" class="w-3.5 h-3.5 inline ml-0.5"></i>
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
                            <span
                                class="inline-flex items-center gap-1.5 text-xs font-medium py-1 px-3.5 border border-secondary/30 bg-secondary/10 text-white/90 rounded-full">
                                <i data-lucide="sparkles" class="w-2.5 h-2.5 text-secondary-light"></i>
                                {{ $feat }}
                            </span>
                        @endforeach
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-1 min-w-0 bg-white/5 border border-secondary/15 rounded-2xl p-4">
                            <p class="text-2xl font-bold text-white">200<span class="text-secondary">+</span></p>
                            <p class="text-[10px] text-white/40 font-semibold mt-1 uppercase tracking-wider">Anggota JSM
                            </p>
                        </div>
                        <div class="flex-1 min-w-0 bg-white/5 border border-secondary/15 rounded-2xl p-4">
                            <p class="text-2xl font-bold text-white">3</p>
                            <p class="text-[10px] text-white/40 font-semibold mt-1 uppercase tracking-wider">Program
                                ekonomi</p>
                        </div>
                    </div>
                    <button onclick="openModal('modalJSM')"
                        class="inline-flex items-center gap-2 text-sm font-semibold py-2.5 px-6 border-none rounded-full cursor-pointer transition-all duration-200 bg-secondary text-accent hover:bg-secondary-light hover:translate-y-[-1px] hover:shadow-lg hover:shadow-secondary/20 active:scale-95 no-underline">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        Gabung JSM
                    </button>
                </div>
                <div class="prog-emoji-wrap flex justify-center">
                    <div
                        class="w-full aspect-square max-w-[240px] rounded-3xl flex items-center justify-center text-7xl relative bg-secondary/10 border border-secondary/20">
                        <i data-lucide="store" class="w-16 h-16 text-white opacity-80 z-10"></i>
                        <div
                            class="absolute -top-3 -right-3 bg-white/10 backdrop-blur-md border border-secondary/20 rounded-2xl py-2 px-3 text-[10px] font-bold text-white flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                            Jaringan aktif
                        </div>
                        <div
                            class="absolute -bottom-3 -left-3 bg-secondary rounded-2xl py-2 px-3.5 text-[10px] font-bold text-accent shadow-lg shadow-secondary/20">
                            UMKM Halal <i data-lucide="hand-helping" class="w-3.5 h-3.5 inline ml-0.5"></i>
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