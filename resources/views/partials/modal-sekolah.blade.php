{{-- ═══════════════════════════════════════════════
    MODAL SEKOLAH — drop anywhere in your Blade layout
    Dipanggil via: openModal('modalSekolah')
═══════════════════════════════════════════════ --}}

{{-- ── OVERLAY ── --}}
<div
    id="modalSekolah"
    class="fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4"
    style="display: none !important;"
    aria-modal="true"
    role="dialog"
    aria-labelledby="modalSekolahTitle"
>
    {{-- Backdrop --}}
    <div
        id="modalSekolah-backdrop"
        class="absolute inset-0 bg-black/40 backdrop-blur-[2px]"
        onclick="closeModal('modalSekolah')"
    ></div>

    {{-- Panel --}}
    <div
        id="modalSekolah-panel"
        class="relative w-full sm:max-w-2xl bg-white rounded-t-3xl sm:rounded-3xl overflow-hidden shadow-2xl"
        style="max-height: 92dvh; overflow-y: auto;"
    >

        {{-- ── TOP BAR ── --}}
        <div class="flex items-start justify-between px-6 pt-6 pb-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-[.15em] text-sky-500 mb-1">Program Pendidikan</p>
                <h2 id="modalSekolahTitle" class="text-xl font-bold text-gray-900 leading-tight">
                    Pendidikan Muhammadiyah
                </h2>
                <p class="text-sm text-gray-400 mt-0.5">Membentuk generasi unggul &amp; berakhlak mulia</p>
            </div>
            <button
                onclick="closeModal('modalSekolah')"
                class="flex-shrink-0 ml-4 mt-0.5 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors"
                aria-label="Tutup"
            >
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Divider --}}
        <div class="h-px bg-gray-100 mx-6"></div>

        {{-- ── SCHOOL CARDS ── --}}
        <div class="px-6 pt-5 pb-4 grid grid-cols-3 gap-3">

            {{-- SD --}}
            <div class="group flex flex-col items-center text-center p-4 rounded-2xl border border-gray-100 bg-gray-50/60 hover:border-sky-200 hover:bg-sky-50/50 transition-all duration-200 cursor-default">
                <div class="w-11 h-11 rounded-xl bg-sky-100 flex items-center justify-center mb-3 group-hover:bg-sky-200 transition-colors">
                    {{-- Book icon --}}
                    <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M4 19.5A2.5 2.5 0 016.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
                    </svg>
                </div>
                <p class="text-[13px] font-700 text-gray-800 font-bold leading-tight mb-1">SD 08+ Muhammadiyah</p>
                <p class="text-[11px] text-gray-400 leading-snug">Tahfidz Qur'an &amp; Karakter Adab</p>
            </div>

            {{-- SMP --}}
            <div class="group flex flex-col items-center text-center p-4 rounded-2xl border border-gray-100 bg-gray-50/60 hover:border-sky-200 hover:bg-sky-50/50 transition-all duration-200 cursor-default">
                <div class="w-11 h-11 rounded-xl bg-sky-100 flex items-center justify-center mb-3 group-hover:bg-sky-200 transition-colors">
                    {{-- Mortarboard icon --}}
                    <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5-10-5z"/>
                        <path d="M6 12v5c3 2 9 2 12 0v-5"/>
                    </svg>
                </div>
                <p class="text-[13px] font-bold text-gray-800 leading-tight mb-1">SMP 50 Muhammadiyah</p>
                <p class="text-[11px] text-gray-400 leading-snug">Digital Class &amp; Leadership</p>
            </div>

            {{-- SMA/SMK --}}
            <div class="group flex flex-col items-center text-center p-4 rounded-2xl border border-gray-100 bg-gray-50/60 hover:border-sky-200 hover:bg-sky-50/50 transition-all duration-200 cursor-default">
                <div class="w-11 h-11 rounded-xl bg-sky-100 flex items-center justify-center mb-3 group-hover:bg-sky-200 transition-colors">
                    {{-- Chip / CPU icon --}}
                    <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <rect x="7" y="7" width="10" height="10" rx="1"/>
                        <path d="M7 9H5M7 12H5M7 15H5M17 9h2M17 12h2M17 15h2M9 7V5M12 7V5M15 7V5M9 19v-2M12 19v-2M15 19v-2"/>
                    </svg>
                </div>
                <p class="text-[13px] font-bold text-gray-800 leading-tight mb-1"> SMA / SMK 23 Muhammadiyah</p>
                <p class="text-[11px] text-gray-400 leading-snug">Science &amp; Vocational Excellence</p>
            </div>
        </div>

        {{-- ── KEUNGGULAN ── --}}
        <div class="mx-6 mb-5 p-4 rounded-2xl bg-gray-50 border border-gray-100">
            <p class="text-[11px] font-bold uppercase tracking-[.12em] text-gray-400 mb-3">Mengapa memilih kami?</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-2.5 gap-x-4">
                @foreach([
                    'Kurikulum Terintegrasi Al-Islam',
                    'Gedung Representatif & Nyaman',
                    'Ekstrakurikuler Hizbul Wathan',
                    'Beasiswa Prestasi & Kader',
                ] as $item)
                <div class="flex items-center gap-2.5">
                    <span class="flex-shrink-0 w-4 h-4 rounded-full bg-sky-100 flex items-center justify-center">
                        <svg class="w-2.5 h-2.5 text-sky-600" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7"/>
                        </svg>
                    </span>
                    <span class="text-[13px] text-gray-600">{{ $item }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ── FOOTER ACTIONS ── --}}
        <div class="px-6 pb-6 flex flex-col sm:flex-row gap-3">
            <button
                onclick="closeModal('modalSekolah')"
                class="flex-1 sm:flex-none px-5 py-2.5 rounded-full border border-gray-200 text-sm font-600 font-semibold text-gray-500 hover:border-gray-300 hover:text-gray-700 transition-colors"
            >
                Tutup
            </button>
            <a
                href="https://ppdb.muhammadiyah.or.id"
                target="_blank"
                rel="noopener"
                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold transition-colors shadow-sm shadow-sky-200"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 20h9M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/>
                </svg>
                Daftar Sekarang (PPDB)
            </a>
        </div>

    </div>{{-- /panel --}}
</div>{{-- /overlay --}}


{{-- ═══════════════════════════════════════════════
    SCRIPT — letakkan sekali saja, idealnya di layout utama.
    openModal() & closeModal() bisa dipakai untuk semua modal.
═══════════════════════════════════════════════ --}}
@once
<style>
    @keyframes modalSlideUp {
        from { opacity: 0; transform: translateY(24px) scale(.98); }
        to   { opacity: 1; transform: translateY(0)    scale(1);   }
    }
    @keyframes modalFadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }
    .modal-panel-enter  { animation: modalSlideUp .3s cubic-bezier(.16,1,.3,1) both; }
    .modal-backdrop-enter { animation: modalFadeIn .25s ease both; }
</style>

<script>
function openModal(id) {
    const overlay = document.getElementById(id);
    if (!overlay) return;
    overlay.style.removeProperty('display');
    // Tambah kelas animasi
    const panel    = document.getElementById(id + '-panel');
    const backdrop = document.getElementById(id + '-backdrop');
    if (panel)    { panel.classList.remove('modal-panel-enter');    void panel.offsetWidth;    panel.classList.add('modal-panel-enter'); }
    if (backdrop) { backdrop.classList.remove('modal-backdrop-enter'); void backdrop.offsetWidth; backdrop.classList.add('modal-backdrop-enter'); }
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    const overlay = document.getElementById(id);
    if (!overlay) return;
    overlay.style.display = 'none';
    document.body.style.overflow = '';
}

// Tutup dengan Escape
document.addEventListener('keydown', function(e) {
    if (e.key !== 'Escape') return;
    document.querySelectorAll('[id^="modal"]').forEach(function(el) {
        if (el.style.display !== 'none') closeModal(el.id);
    });
});
</script>
@endonce
