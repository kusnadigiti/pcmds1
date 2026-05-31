{{-- ═══════════════════════════════════════════════
    MODAL JSM — drop anywhere in your Blade layout
    Dipanggil via: openModal('modalJSM')
═══════════════════════════════════════════════ --}}

<div
    id="modalJSM"
    class="fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4"
    style="display: none !important;"
    aria-modal="true"
    role="dialog"
    aria-labelledby="modalJSMTitle"
>
    {{-- Backdrop --}}
    <div
        id="modalJSM-backdrop"
        class="absolute inset-0 bg-black/40 backdrop-blur-[2px]"
        onclick="closeModal('modalJSM')"
    ></div>

    {{-- Panel --}}
    <div
        id="modalJSM-panel"
        class="relative w-full sm:max-w-lg bg-white rounded-t-3xl sm:rounded-3xl overflow-hidden shadow-2xl"
        style="max-height: 92dvh; overflow-y: auto;"
    >

        {{-- ── TOP BAR ── --}}
        <div class="flex items-start justify-between px-6 pt-6 pb-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-[.15em] text-amber-500 mb-1">Ekonomi Umat</p>
                <h2 id="modalJSMTitle" class="text-xl font-bold text-gray-900 leading-tight">
                    Gabung Jaringan Saudagar
                </h2>
                <p class="text-sm text-gray-400 mt-0.5">Perluas jaringan, perkuat ekonomi jamaah</p>
            </div>
            <button
                onclick="closeModal('modalJSM')"
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

        {{-- ── DESKRIPSI ── --}}
        <div class="px-6 pt-4 pb-2">
            <p class="text-sm text-gray-500 leading-relaxed">
                Bergabunglah dengan ekosistem bisnis warga Muhammadiyah untuk memperluas jaringan dan memperkuat ekonomi jamaah.
            </p>
        </div>

        {{-- ── KEUNTUNGAN ── --}}
        <div class="px-6 pt-3 pb-4 space-y-3">
            <p class="text-[11px] font-bold uppercase tracking-[.12em] text-gray-400">Keuntungan menjadi anggota</p>

            {{-- Item 1 --}}
            <div class="flex items-start gap-3 p-3 rounded-2xl bg-amber-50/60 border border-amber-100">
                <span class="flex-shrink-0 w-8 h-8 rounded-xl bg-amber-100 flex items-center justify-center mt-0.5">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                </span>
                <div>
                    <p class="text-[13px] font-semibold text-gray-800 mb-0.5">Networking Bisnis</p>
                    <p class="text-[12px] text-gray-500 leading-relaxed">Terhubung dengan ribuan pengusaha Muhammadiyah di seluruh Indonesia.</p>
                </div>
            </div>

            {{-- Item 2 --}}
            <div class="flex items-start gap-3 p-3 rounded-2xl bg-amber-50/60 border border-amber-100">
                <span class="flex-shrink-0 w-8 h-8 rounded-xl bg-amber-100 flex items-center justify-center mt-0.5">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                        <path d="M12 6v6l4 2"/>
                    </svg>
                </span>
                <div>
                    <p class="text-[13px] font-semibold text-gray-800 mb-0.5">Akses Modal &amp; Pasar</p>
                    <p class="text-[12px] text-gray-500 leading-relaxed">Informasi kemitraan, permodalan syariah, dan perluasan pasar produk.</p>
                </div>
            </div>

            {{-- Item 3 --}}
            <div class="flex items-start gap-3 p-3 rounded-2xl bg-amber-50/60 border border-amber-100">
                <span class="flex-shrink-0 w-8 h-8 rounded-xl bg-amber-100 flex items-center justify-center mt-0.5">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 20h9M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/>
                    </svg>
                </span>
                <div>
                    <p class="text-[13px] font-semibold text-gray-800 mb-0.5">Pelatihan Bisnis</p>
                    <p class="text-[12px] text-gray-500 leading-relaxed">Workshop manajemen, branding, dan digitalisasi usaha secara rutin.</p>
                </div>
            </div>
        </div>

        {{-- ── SYARAT ── --}}
        <div class="mx-6 mb-5 p-4 rounded-2xl bg-gray-50 border border-gray-100">
            <p class="text-[11px] font-bold uppercase tracking-[.12em] text-gray-400 mb-3">Persyaratan utama</p>
            <div class="space-y-2">
                @foreach([
                    'Memiliki usaha (Mikro, Kecil, Menengah, atau Besar)',
                    'Berkomitmen pada nilai-nilai Ekonomi Syariah',
                    'Memiliki Kartu Tanda Anggota Muhammadiyah (NBM)',
                ] as $syarat)
                <div class="flex items-start gap-2.5">
                    <span class="flex-shrink-0 w-4 h-4 rounded-full bg-amber-100 flex items-center justify-center mt-0.5">
                        <svg class="w-2.5 h-2.5 text-amber-600" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7"/>
                        </svg>
                    </span>
                    <span class="text-[13px] text-gray-600">{{ $syarat }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ── FORM NAMA (opsional, biar pesan WA lebih personal) ── --}}
        <div class="mx-6 mb-5">
            <label class="block text-[11px] font-bold uppercase tracking-[.12em] text-gray-400 mb-2">
                Nama kamu (opsional)
            </label>
            <input
                id="jsm-nama"
                type="text"
                placeholder="contoh: Budi Santoso"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition"
            >
        </div>

        {{-- ── FOOTER ACTIONS ── --}}
        <div class="px-6 pb-6 flex flex-col sm:flex-row gap-3">
            <button
                onclick="closeModal('modalJSM')"
                class="flex-1 sm:flex-none px-5 py-2.5 rounded-full border border-gray-200 text-sm font-semibold text-gray-500 hover:border-gray-300 hover:text-gray-700 transition-colors"
            >
                Nanti Saja
            </button>
            <button
                onclick="daftarJSMviaWA()"
                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold transition-colors shadow-sm shadow-amber-200"
            >
                {{-- WhatsApp icon --}}
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                    <path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.553 4.112 1.523 5.842L.057 23.215a.75.75 0 00.928.928l5.373-1.466A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.907 0-3.694-.497-5.243-1.365l-.375-.217-3.884 1.059 1.059-3.884-.217-.375A9.956 9.956 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                </svg>
                Daftar via WhatsApp
            </button>
        </div>

    </div>
</div>

<script>
function daftarJSMviaWA() {
    const nama  = (document.getElementById('jsm-nama').value || '').trim();
    // const nomor = '6285280136056'; // Ganti dengan nomor WA tujuan
    const nomor = '+6285280136056'; // Ganti dengan nomor WA tujuan

    const pesan = nama
        ? `Assalamu'alaikum, saya *${nama}* ingin mendaftarkan diri sebagai anggota Jaringan Saudagar Muhammadiyah (JSM). Mohon informasi lebih lanjut mengenai prosedur pendaftaran. Jazakumullahu Khayran.`
        : `Assalamu'alaikum, saya ingin mendaftarkan diri sebagai anggota Jaringan Saudagar Muhammadiyah (JSM). Mohon informasi lebih lanjut mengenai prosedur pendaftaran. Jazakumullahu Khayran.`;

    const url = `https://wa.me/${nomor}?text=${encodeURIComponent(pesan)}`;
    window.open(url, '_blank', 'noopener,noreferrer');
}
</script>
