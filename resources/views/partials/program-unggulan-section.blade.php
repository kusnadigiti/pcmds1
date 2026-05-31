<link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap"
    rel="stylesheet">

<style>
    #program-unggulan * {
        font-family: 'DM Sans', sans-serif;
        box-sizing: border-box;
    }

    /* Tab pill track */
    .prog-tab-track {
        display: inline-flex;
        background: #f3f4f6;
        border-radius: 99px;
        padding: 4px;
        gap: 2px;
    }

    .prog-tab {
        padding: 8px 22px;
        border-radius: 99px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        background: transparent;
        color: #6b7280;
        cursor: pointer;
        transition: all .25s cubic-bezier(.4, 0, .2, 1);
        white-space: nowrap;
    }

    .prog-tab.active {
        background: #fff;
        color: #111827;
        box-shadow: 0 1px 4px rgba(0, 0, 0, .10), 0 0 0 1px rgba(0, 0, 0, .04);
    }

    .prog-tab:hover:not(.active) {
        color: #374151;
    }

    /* Panel fade */
    .prog-panel {
        display: none;
    }

    .prog-panel.active {
        display: block;
        animation: progFadeUp .35s cubic-bezier(.4, 0, .2, 1) both;
    }

    @keyframes progFadeUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Feature pill */
    .prog-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 500;
        padding: 5px 12px 5px 8px;
        border-radius: 99px;
        border: 1.5px solid;
    }

    /* CTA button */
    .prog-btn {
        display: inline-flex;
        align-items: center;
        gap-8px;
        font-size: 14px;
        font-weight: 600;
        padding: 10px 22px;
        border-radius: 99px;
        border: none;
        cursor: pointer;
        transition: all .2s cubic-bezier(.4, 0, .2, 1);
    }

    .prog-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 20px -4px var(--btn-shadow);
    }

    .prog-btn:active {
        transform: scale(.97);
    }

    /* Stat cards */
    .prog-stat {
        flex: 1;
        min-width: 0;
        background: #f9fafb;
        border-radius: 16px;
        padding: 16px 18px;
        border: 1px solid #f3f4f6;
    }

    /* Big emoji illustration */
    .prog-emoji-wrap {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .prog-emoji-wrap::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 28px;
        opacity: .07;
    }

    .prog-emoji-bg {
        width: 100%;
        aspect-ratio: 1;
        max-width: 240px;
        border-radius: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 96px;
        position: relative;
    }
</style>

<section id="program-unggulan" class="py-24 bg-[#FAFAFA]">
    <div class="max-w-5xl mx-auto px-6">

        {{-- ── HEADER ──────────────────────────────────────────── --}}
        <div class="mb-12">
            <span
                class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[.15em] text-emerald-600 mb-3">
                <span class="w-4 h-px bg-emerald-500 inline-block"></span>
                Fokus Gerakan
                <span class="w-4 h-px bg-emerald-500 inline-block"></span>
            </span>
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 leading-tight">
                    Program<br class="hidden sm:block"> Unggulan
                </h2>
                {{-- Tab pills --}}
                <div class="prog-tab-track overflow-x-auto">
                    <button class="prog-tab active" onclick="openProgTab('kajian', this)">
                        Kajian &amp; Tabligh
                    </button>
                    <button class="prog-tab" onclick="openProgTab('pendidikan', this)">
                        Pendidikan Kader
                    </button>
                    <button class="prog-tab" onclick="openProgTab('ekonomi', this)">
                        Ekonomi Umat
                    </button>
                </div>
            </div>
            <div class="mt-6 h-px bg-gray-200"></div>
        </div>

        {{-- ── CONTENT PANELS ──────────────────────────────────── --}}

        {{-- KAJIAN --}}
        <div class="prog-panel active" id="prog-kajian">
            <div class="grid md:grid-cols-2 gap-10 items-center">

                {{-- Left: info --}}
                <div class="space-y-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2 leading-snug">
                            Mencerahkan Umat<br>Melalui Kajian
                        </h3>
                        <p class="text-gray-500 text-[15px] leading-relaxed">
                            Program pembinaan aqidah, ibadah, dan akhlak masyarakat melalui kajian rutin yang konsisten
                            dan terstruktur.
                        </p>
                    </div>

                    {{-- Feature pills --}}
                    <div class="flex flex-wrap gap-2">
                        <span class="prog-pill border-emerald-200 bg-emerald-50 text-emerald-700">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <circle cx="10" cy="10" r="3" />
                            </svg>
                            Kajian Ahad Pagi
                        </span>
                        <span class="prog-pill border-emerald-200 bg-emerald-50 text-emerald-700">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <circle cx="10" cy="10" r="3" />
                            </svg>
                            Kajian Tarjih
                        </span>
                        <span class="prog-pill border-emerald-200 bg-emerald-50 text-emerald-700">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <circle cx="10" cy="10" r="3" />
                            </svg>
                            Pelatihan Mubaligh
                        </span>
                    </div>

                    {{-- Stats row --}}
                    <div class="flex gap-3">
                        <div class="prog-stat">
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $kajianPerTahun }}
                                <span class="text-emerald-500">×</span>
                            </p>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">
                                Kajian tahun {{ $currentYear }}
                            </p>
                        </div>
                        <div class="prog-stat">
                            <p class="text-2xl font-bold text-gray-900">3<span class="text-emerald-500">+</span></p>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Program aktif</p>
                        </div>
                        <div class="prog-stat">
                            <p class="text-2xl font-bold text-gray-900">∞</p>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Terbuka untuk umum</p>
                        </div>
                    </div>

                    <button onclick="openJadwalModal()" class="prog-btn bg-emerald-600 text-white"
                        style="--btn-shadow: rgba(5,150,105,.35)">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <path d="M16 2v4M8 2v4M3 10h18" />
                        </svg>
                        Lihat Jadwal Kajian
                    </button>
                </div>

                {{-- Right: illustration --}}
                <div class="prog-emoji-wrap justify-end">
                    <div class="prog-emoji-bg bg-emerald-50">
                        🎤
                        {{-- Floating badges --}}
                        <div
                            class="absolute -top-3 -right-3 bg-white border border-gray-100 shadow-sm rounded-2xl px-3 py-2 text-xs font-semibold text-gray-700 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Rutin setiap Ahad
                        </div>
                        <div
                            class="absolute -bottom-3 -left-3 bg-emerald-600 text-white shadow-md rounded-2xl px-3 py-2 text-xs font-semibold">
                            Gratis &amp; Terbuka 🙌
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- PENDIDIKAN --}}
        <div class="prog-panel" id="prog-pendidikan">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div class="space-y-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2 leading-snug">
                            Mencetak Generasi<br>yang Tangguh
                        </h3>
                        <p class="text-gray-500 text-[15px] leading-relaxed">
                            Fokus pada peningkatan kualitas pendidikan dan kaderisasi untuk masa depan umat yang lebih
                            baik.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="prog-pill border-sky-200 bg-sky-50 text-sky-700">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <circle cx="10" cy="10" r="3" />
                            </svg>
                            Beasiswa Mentari
                        </span>
                        <span class="prog-pill border-sky-200 bg-sky-50 text-sky-700">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <circle cx="10" cy="10" r="3" />
                            </svg>
                            Digitalisasi Guru
                        </span>
                        <span class="prog-pill border-sky-200 bg-sky-50 text-sky-700">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <circle cx="10" cy="10" r="3" />
                            </svg>
                            Baitul Arqam
                        </span>
                    </div>
                    <div class="flex gap-3">
                        <div class="prog-stat">
                            <p class="text-2xl font-bold text-gray-900">100<span class="text-sky-500">+</span></p>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Penerima beasiswa</p>
                        </div>
                        <div class="prog-stat">
                            <p class="text-2xl font-bold text-gray-900">3</p>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Lembaga pendidikan</p>
                        </div>
                    </div>
                    <button onclick="openModal('modalSekolah')" class="prog-btn bg-sky-600 text-white"
                        style="--btn-shadow: rgba(2,132,199,.35)">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        </svg>
                        Info Sekolah
                    </button>
                </div>
                <div class="prog-emoji-wrap justify-end">
                    <div class="prog-emoji-bg bg-sky-50">
                        📚
                        <div
                            class="absolute -top-3 -right-3 bg-white border border-gray-100 shadow-sm rounded-2xl px-3 py-2 text-xs font-semibold text-gray-700 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-sky-400 animate-pulse"></span>
                            Beasiswa aktif
                        </div>
                        <div
                            class="absolute -bottom-3 -left-3 bg-sky-600 text-white shadow-md rounded-2xl px-3 py-2 text-xs font-semibold">
                            Daftar sekarang 🎓
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- EKONOMI --}}
        <div class="prog-panel" id="prog-ekonomi">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div class="space-y-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2 leading-snug">
                            Kemandirian<br>Ekonomi Umat
                        </h3>
                        <p class="text-gray-500 text-[15px] leading-relaxed">
                            Penguatan ekonomi melalui jaringan saudagar Muhammadiyah yang kuat dan saling mendukung.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="prog-pill border-amber-200 bg-amber-50 text-amber-700">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <circle cx="10" cy="10" r="3" />
                            </svg>
                            Sertifikasi Halal
                        </span>
                        <span class="prog-pill border-amber-200 bg-amber-50 text-amber-700">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <circle cx="10" cy="10" r="3" />
                            </svg>
                            Koperasi Syariah
                        </span>
                        <span class="prog-pill border-amber-200 bg-amber-50 text-amber-700">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <circle cx="10" cy="10" r="3" />
                            </svg>
                            Bazar UMKM
                        </span>
                    </div>
                    <div class="flex gap-3">
                        <div class="prog-stat">
                            <p class="text-2xl font-bold text-gray-900">200<span class="text-amber-500">+</span></p>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Anggota JSM</p>
                        </div>
                        <div class="prog-stat">
                            <p class="text-2xl font-bold text-gray-900">3</p>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Program ekonomi</p>
                        </div>
                    </div>
                    <button onclick="openModal('modalJSM')" class="prog-btn bg-amber-500 text-white"
                        style="--btn-shadow: rgba(245,158,11,.4)">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                        </svg>
                        Gabung JSM
                    </button>
                </div>
                <div class="prog-emoji-wrap justify-end">
                    <div class="prog-emoji-bg bg-amber-50">
                        🏪
                        <div
                            class="absolute -top-3 -right-3 bg-white border border-gray-100 shadow-sm rounded-2xl px-3 py-2 text-xs font-semibold text-gray-700 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                            Jaringan aktif
                        </div>
                        <div
                            class="absolute -bottom-3 -left-3 bg-amber-500 text-white shadow-md rounded-2xl px-3 py-2 text-xs font-semibold">
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
        // hide all panels
        document.querySelectorAll('.prog-panel').forEach(p => p.classList.remove('active'));
        // deactivate all tab buttons
        document.querySelectorAll('.prog-tab').forEach(b => b.classList.remove('active'));
        // show target
        document.getElementById('prog-' + id).classList.add('active');
        btn.classList.add('active');
    }
</script>
