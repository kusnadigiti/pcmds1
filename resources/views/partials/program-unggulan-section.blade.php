<section id="program-unggulan" class="bg-accent py-24 relative">
    <div class="max-w-5xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="mb-12">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6">
                <div>
                    <span class="section-label section-label-light">Program &amp; Kegiatan</span>
                    <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl leading-[1.15] text-white">
                        Program Unggulan
                    </h2>
                </div>
                {{-- Tab pills --}}
                <div class="inline-flex bg-white/5 border border-white/10 rounded-lg p-0.5 gap-0.5">
                    <button
                        class="prog-tab py-2 px-4 rounded-md text-sm font-semibold border-none cursor-pointer transition-all duration-200 whitespace-nowrap bg-white/10 text-white"
                        onclick="openProgTab('kajian', this)">
                        Kajian &amp; Tabligh
                    </button>
                    <button
                        class="prog-tab py-2 px-4 rounded-md text-sm font-semibold border-none cursor-pointer transition-all duration-200 whitespace-nowrap bg-transparent text-white/40 hover:text-white/70"
                        onclick="openProgTab('pendidikan', this)">
                        Pendidikan Kader
                    </button>
                    <button
                        class="prog-tab py-2 px-4 rounded-md text-sm font-semibold border-none cursor-pointer transition-all duration-200 whitespace-nowrap bg-transparent text-white/40 hover:text-white/70"
                        onclick="openProgTab('ekonomi', this)">
                        Ekonomi Umat
                    </button>
                </div>
            </div>
        </div>

        {{-- CONTENT PANELS --}}

        {{-- KAJIAN --}}
        <div class="prog-panel" id="prog-kajian">
            <div class="grid md:grid-cols-2 gap-12 items-start">

                <div class="space-y-6">
                    <div>
                        <h3 class="font-display text-2xl lg:text-3xl text-white mb-3 leading-snug">
                            Mencerahkan Umat<br>Melalui Kajian
                        </h3>
                        <p class="text-white/50 text-sm leading-relaxed">
                            Program pembinaan aqidah, ibadah, dan akhlak masyarakat melalui kajian rutin yang konsisten
                            dan terstruktur.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @foreach (['Kajian Ahad Pagi', 'Kajian Tarjih', 'Pelatihan Mubaligh'] as $feat)
                            <span class="inline-flex items-center gap-1.5 text-xs font-medium py-1 px-3 border border-white/10 text-white/70 rounded-lg">
                                {{ $feat }}
                            </span>
                        @endforeach
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                            <p class="text-xl font-bold text-white">{{ $kajianPerTahun }}<span class="text-secondary text-sm ml-0.5">×</span></p>
                            <p class="text-[10px] text-white/35 font-semibold mt-1 uppercase tracking-wider">Kajian {{ $currentYear }}</p>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                            <p class="text-xl font-bold text-white">3<span class="text-secondary text-sm ml-0.5">+</span></p>
                            <p class="text-[10px] text-white/35 font-semibold mt-1 uppercase tracking-wider">Program aktif</p>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                            <p class="text-xl font-bold text-white">∞</p>
                            <p class="text-[10px] text-white/35 font-semibold mt-1 uppercase tracking-wider">Terbuka</p>
                        </div>
                    </div>

                    <button onclick="openJadwalModal()"
                        class="inline-flex items-center gap-2 text-sm font-semibold py-2.5 px-6 border-none rounded-lg cursor-pointer transition-all duration-200 bg-primary text-white hover:bg-primary-light no-underline">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        Lihat Jadwal Kajian
                    </button>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-2xl p-8 flex flex-col items-center justify-center text-center">
                    <i data-lucide="mic" class="w-12 h-12 text-white/60 mb-4"></i>
                    <p class="text-white/80 font-semibold text-sm mb-1">Kajian Rutin</p>
                    <p class="text-white/40 text-xs">Setiap Ahad Pagi &middot; Gratis &amp; Terbuka untuk Umum</p>
                </div>
            </div>
        </div>

        {{-- PENDIDIKAN --}}
        <div class="prog-panel hidden" id="prog-pendidikan">
            <div class="grid md:grid-cols-2 gap-12 items-start">
                <div class="space-y-6">
                    <div>
                        <h3 class="font-display text-2xl lg:text-3xl text-white mb-3 leading-snug">
                            Mencetak Generasi<br>yang Tangguh
                        </h3>
                        <p class="text-white/50 text-sm leading-relaxed">
                            Fokus pada peningkatan kualitas pendidikan dan kaderisasi untuk masa depan umat yang lebih
                            baik.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach (['Beasiswa Mentari', 'Digitalisasi Guru', 'Baitul Arqam'] as $feat)
                            <span class="inline-flex items-center gap-1.5 text-xs font-medium py-1 px-3 border border-white/10 text-white/70 rounded-lg">
                                {{ $feat }}
                            </span>
                        @endforeach
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                            <p class="text-xl font-bold text-white">100<span class="text-secondary text-sm ml-0.5">+</span></p>
                            <p class="text-[10px] text-white/35 font-semibold mt-1 uppercase tracking-wider">Penerima beasiswa</p>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                            <p class="text-xl font-bold text-white">3</p>
                            <p class="text-[10px] text-white/35 font-semibold mt-1 uppercase tracking-wider">Lembaga pendidikan</p>
                        </div>
                    </div>
                    <button onclick="openModal('modalSekolah')"
                        class="inline-flex items-center gap-2 text-sm font-semibold py-2.5 px-6 border-none rounded-lg cursor-pointer transition-all duration-200 bg-secondary text-accent hover:bg-secondary-light no-underline">
                        <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                        Info Sekolah
                    </button>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8 flex flex-col items-center justify-center text-center">
                    <i data-lucide="book-open" class="w-12 h-12 text-white/60 mb-4"></i>
                    <p class="text-white/80 font-semibold text-sm mb-1">Pendidikan Kader</p>
                    <p class="text-white/40 text-xs">Beasiswa aktif &middot; 3 lembaga pendidikan</p>
                </div>
            </div>
        </div>

        {{-- EKONOMI --}}
        <div class="prog-panel hidden" id="prog-ekonomi">
            <div class="grid md:grid-cols-2 gap-12 items-start">
                <div class="space-y-6">
                    <div>
                        <h3 class="font-display text-2xl lg:text-3xl text-white mb-3 leading-snug">
                            Kemandirian<br>Ekonomi Umat
                        </h3>
                        <p class="text-white/50 text-sm leading-relaxed">
                            Penguatan ekonomi melalui jaringan saudagar Muhammadiyah yang kuat dan saling mendukung.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach (['Sertifikasi Halal', 'Koperasi Syariah', 'Bazar UMKM'] as $feat)
                            <span class="inline-flex items-center gap-1.5 text-xs font-medium py-1 px-3 border border-white/10 text-white/70 rounded-lg">
                                {{ $feat }}
                            </span>
                        @endforeach
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                            <p class="text-xl font-bold text-white">200<span class="text-secondary text-sm ml-0.5">+</span></p>
                            <p class="text-[10px] text-white/35 font-semibold mt-1 uppercase tracking-wider">Anggota JSM</p>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                            <p class="text-xl font-bold text-white">3</p>
                            <p class="text-[10px] text-white/35 font-semibold mt-1 uppercase tracking-wider">Program ekonomi</p>
                        </div>
                    </div>
                    <button onclick="openModal('modalJSM')"
                        class="inline-flex items-center gap-2 text-sm font-semibold py-2.5 px-6 border-none rounded-lg cursor-pointer transition-all duration-200 bg-secondary text-accent hover:bg-secondary-light no-underline">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        Gabung JSM
                    </button>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8 flex flex-col items-center justify-center text-center">
                    <i data-lucide="store" class="w-12 h-12 text-white/60 mb-4"></i>
                    <p class="text-white/80 font-semibold text-sm mb-1">Ekonomi Umat</p>
                    <p class="text-white/40 text-xs">Jaringan UMKM halal &middot; 200+ anggota aktif</p>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    function openProgTab(id, btn) {
        document.querySelectorAll('.prog-panel').forEach(p => p.classList.add('hidden'));
        document.querySelectorAll('.prog-tab').forEach(b => {
            b.classList.remove('bg-white/10', 'text-white');
            b.classList.add('bg-transparent', 'text-white/40');
        });
        document.getElementById('prog-' + id).classList.remove('hidden');
        btn.classList.add('bg-white/10', 'text-white');
        btn.classList.remove('bg-transparent', 'text-white/40');
    }
</script>
