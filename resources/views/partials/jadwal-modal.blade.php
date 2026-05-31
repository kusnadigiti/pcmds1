{{-- ═══════════════════════════════════════════════════════════
     MODAL 1 — JADWAL KAJIAN (3 terdekat)
     Trigger: openJadwalModal()
     ═══════════════════════════════════════════════════════════ --}}
<div
    id="modalJadwal"
    role="dialog" aria-modal="true" aria-labelledby="modalJadwalTitle"
    class="fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-6 opacity-0 pointer-events-none"
    style="transition:opacity .3s cubic-bezier(.4,0,.2,1)"
>
    <div onclick="closeJadwalModal()" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

    <div
        id="modalJadwalPanel"
        class="relative z-10 w-full sm:max-w-2xl max-h-[92dvh] sm:max-h-[85vh]
               bg-white sm:rounded-3xl rounded-t-3xl rounded-b-none
               shadow-2xl shadow-black/20 flex flex-col overflow-hidden
               translate-y-8 sm:translate-y-0 sm:scale-95"
        style="transition:transform .35s cubic-bezier(.34,1.56,.64,1),opacity .3s ease"
    >
        {{-- Accent bar --}}
        <div class="h-1 w-full bg-gradient-to-r from-emerald-400 via-teal-400 to-cyan-300 shrink-0"></div>

        {{-- Drag handle mobile --}}
        <div class="flex justify-center pt-3 pb-1 sm:hidden shrink-0">
            <div class="w-10 h-1 rounded-full bg-gray-200"></div>
        </div>

        {{-- Header --}}
        <div class="flex items-start justify-between px-6 pt-4 pb-5 border-b border-gray-100 shrink-0">
            <div>
                <p class="text-xs font-bold uppercase tracking-[.15em] text-emerald-600 mb-0.5">Kegiatan Terdekat</p>
                <h2 id="modalJadwalTitle" class="text-2xl font-bold text-gray-900" style="font-family:'DM Sans',sans-serif">
                    Jadwal Kajian
                </h2>
            </div>
            <button onclick="closeJadwalModal()"
                class="w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition shrink-0 mt-0.5"
                aria-label="Tutup">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Body --}}
        <div class="overflow-y-auto flex-1 px-6 py-5 space-y-3">

            @forelse($jadwals as $index => $jadwal)

            {{-- Card --}}
            <div
                class="jadwal-card group relative flex gap-4 p-4 rounded-2xl border border-gray-100
                       hover:border-emerald-200 hover:bg-emerald-50/40 transition-all duration-300 cursor-pointer"
                onclick="toggleJadwalDetail({{ $index }})"
                style="animation:slideUpCard .4s cubic-bezier(.4,0,.2,1) {{ $index * 80 }}ms both"
            >
                {{-- "Terdekat" pill on first item --}}
                @if($index === 0)
                <div class="absolute -top-2.5 left-4 flex items-center gap-1 bg-emerald-500 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-sm shadow-emerald-300">
                    <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse inline-block"></span>
                    Paling Dekat
                </div>
                @endif

                {{-- Date badge --}}
                <div class="shrink-0 flex flex-col items-center justify-center w-14 h-14 rounded-2xl
                            bg-emerald-600 text-white text-center shadow-md shadow-emerald-200 mt-1">
                    <span class="text-lg font-bold leading-none">
                        {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d') }}
                    </span>
                    <span class="text-[10px] font-semibold uppercase tracking-wide opacity-80 mt-0.5">
                        {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('M') }}
                    </span>
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-2">
                        <h4 class="font-semibold text-gray-900 text-base leading-snug group-hover:text-emerald-700 transition pr-2">
                            {{ $jadwal->nama_kegiatan }}
                        </h4>
                        <svg id="chevron-{{ $index }}"
                            class="w-4 h-4 text-gray-400 shrink-0 transition-transform duration-300 mt-0.5"
                            fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </div>

                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-1.5">
                        <span class="flex items-center gap-1 text-xs text-gray-500">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>
                            </svg>
                            {{ \Carbon\Carbon::parse($jadwal->waktu)->format('H.i') }} WIB
                        </span>

                        @if($jadwal->lokasi)
                        <span class="flex items-center gap-1 text-xs text-gray-500">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M12 21s-6-5.686-6-10a6 6 0 1112 0c0 4.314-6 10-6 10z"/>
                                <circle cx="12" cy="11" r="2"/>
                            </svg>
                            {{ $jadwal->lokasi }}
                        </span>
                        @endif

                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700">
                            {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l') }}
                        </span>

                        {{-- Countdown badge --}}
                        @php
                            $diff = today()->diffInDays(\Carbon\Carbon::parse($jadwal->tanggal), false);
                        @endphp
                        @if($diff === 0)
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-100 text-amber-700">Hari ini!</span>
                        @elseif($diff === 1)
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-orange-100 text-orange-700">Besok</span>
                        @elseif($diff > 1)
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-gray-100 text-gray-500">{{ $diff }} hari lagi</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Expandable deskripsi --}}
            @if($jadwal->deskripsi)
            <div id="detail-{{ $index }}" class="overflow-hidden max-h-0 transition-all duration-300 ease-in-out px-1">
                <div class="flex gap-3 pb-2 pt-1 pl-[4.5rem]">
                    <div class="w-px bg-emerald-200 shrink-0 rounded-full self-stretch ml-px"></div>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $jadwal->deskripsi }}</p>
                </div>
            </div>
            @endif

            @empty

            <div class="py-16 text-center">
                <div class="w-20 h-20 rounded-3xl bg-gray-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <path d="M16 2v4M8 2v4M3 10h18"/>
                    </svg>
                </div>
                <p class="font-semibold text-gray-400 text-sm">Belum ada jadwal kajian</p>
                <p class="text-xs text-gray-300 mt-1">Segera hadir — pantau terus!</p>
            </div>

            @endforelse
        </div>

        {{-- Footer --}}
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/60 shrink-0 flex items-center justify-between gap-3">
            <button
                onclick="closeJadwalModal(); openKalenderModal()"
                class="flex items-center gap-2 text-sm font-semibold px-5 py-2.5 rounded-xl
                       border-2 border-emerald-600 text-emerald-700
                       hover:bg-emerald-600 hover:text-white
                       transition-all duration-300 active:scale-95"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <path d="M16 2v4M8 2v4M3 10h18"/>
                </svg>
                Lihat Kalender Penuh
            </button>
            <button
                onclick="closeJadwalModal()"
                class="text-sm font-semibold px-5 py-2.5 rounded-xl bg-black text-white
                       hover:-translate-y-0.5 hover:shadow-lg hover:shadow-black/20
                       transition-all duration-300 active:scale-95"
            >
                Tutup
            </button>
        </div>
    </div>
</div>


{{-- ═══════════════════════════════════════════════════════════
     MODAL 2 — KALENDER PENUH
     Trigger: openKalenderModal()
     ═══════════════════════════════════════════════════════════ --}}
<div
    id="modalKalender"
    role="dialog" aria-modal="true" aria-labelledby="modalKalenderTitle"
    class="fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-6 opacity-0 pointer-events-none"
    style="transition:opacity .3s cubic-bezier(.4,0,.2,1)"
>
    <div onclick="closeKalenderModal()" class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

    <div
        id="modalKalenderPanel"
        class="relative z-10 w-full sm:max-w-3xl max-h-[95dvh] sm:max-h-[90vh]
               bg-white sm:rounded-3xl rounded-t-3xl rounded-b-none
               shadow-2xl shadow-black/20 flex flex-col overflow-hidden
               translate-y-8 sm:translate-y-0 sm:scale-95"
        style="transition:transform .35s cubic-bezier(.34,1.56,.64,1),opacity .3s ease"
    >
        {{-- Accent bar --}}
        <div class="h-1 w-full bg-gradient-to-r from-emerald-400 via-teal-400 to-cyan-300 shrink-0"></div>

        {{-- Drag handle mobile --}}
        <div class="flex justify-center pt-3 pb-1 sm:hidden shrink-0">
            <div class="w-10 h-1 rounded-full bg-gray-200"></div>
        </div>

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 pt-4 pb-5 border-b border-gray-100 shrink-0">
            <div class="flex items-center gap-3">
                {{-- Month nav --}}
                <button onclick="kalenderPrev()"
                    class="w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[.15em] text-emerald-600">Kalender Kajian</p>
                    <h2 id="modalKalenderTitle" class="text-xl font-bold text-gray-900" style="font-family:'DM Sans',sans-serif">
                        <span id="kalenderMonthLabel">—</span>
                    </h2>
                </div>
                <button onclick="kalenderNext()"
                    class="w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
            <button onclick="closeKalenderModal()"
                class="w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition"
                aria-label="Tutup">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Calendar grid + list side by side --}}
        <div class="flex-1 overflow-y-auto">
            <div class="grid sm:grid-cols-[1fr_1px_280px] min-h-full">

                {{-- LEFT: Calendar grid --}}
                <div class="p-5">
                    {{-- Day headers --}}
                    <div class="grid grid-cols-7 mb-2">
                        @foreach(['Min','Sen','Sel','Rab','Kam','Jum','Sab'] as $day)
                        <div class="text-center text-[10px] font-bold text-gray-400 uppercase py-1">{{ $day }}</div>
                        @endforeach
                    </div>
                    {{-- Day cells - rendered by JS --}}
                    <div id="kalenderGrid" class="grid grid-cols-7 gap-y-1"></div>
                </div>

                {{-- Divider --}}
                <div class="hidden sm:block bg-gray-100"></div>

                {{-- RIGHT: Event list for selected date --}}
                <div class="px-5 py-5 border-t sm:border-t-0 border-gray-100">
                    <p class="text-xs font-bold uppercase tracking-[.12em] text-gray-400 mb-3" id="kalenderSideTitle">
                        Pilih tanggal
                    </p>
                    <div id="kalenderSideList" class="space-y-3">
                        <div class="text-sm text-gray-300 italic">—</div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Footer --}}
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/60 shrink-0 flex items-center justify-between gap-3">
            <p class="text-xs text-gray-400" id="kalenderTotalLabel">
                {{ $jadwalCount }} total kegiatan terjadwal
            </p>
            <button onclick="closeKalenderModal()"
                class="text-sm font-semibold px-5 py-2.5 rounded-xl bg-black text-white
                       hover:-translate-y-0.5 hover:shadow-lg hover:shadow-black/20
                       transition-all duration-300 active:scale-95">
                Tutup
            </button>
        </div>
    </div>
</div>


{{-- ═══════════════════════════════════════════════════════════
     STYLES
     ═══════════════════════════════════════════════════════════ --}}
<style>
    @keyframes slideUpCard {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Modal open states */
    #modalJadwal.is-open,
    #modalKalender.is-open {
        opacity: 1;
        pointer-events: auto;
    }
    #modalJadwal.is-open #modalJadwalPanel,
    #modalKalender.is-open #modalKalenderPanel {
        transform: translateY(0) scale(1);
        opacity: 1;
    }

    body.modal-open { overflow: hidden; }

    /* Calendar day cell */
    .kal-day {
        aspect-ratio: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 500;
        color: #374151;
        transition: background .15s, color .15s;
        position: relative;
        gap: 2px;
    }
    .kal-day:hover { background: #f0fdf4; color: #059669; }
    .kal-day.today { background: #ecfdf5; color: #059669; font-weight: 700; }
    .kal-day.today::after {
        content: '';
        position: absolute;
        bottom: 4px;
        left: 50%;
        transform: translateX(-50%);
        width: 4px; height: 4px;
        border-radius: 50%;
        background: #059669;
    }
    .kal-day.has-event .kal-dot { display: block; }
    .kal-dot {
        display: none;
        width: 5px; height: 5px;
        border-radius: 50%;
        background: #10b981;
        flex-shrink: 0;
    }
    .kal-day.selected {
        background: #059669 !important;
        color: #fff !important;
        font-weight: 700;
    }
    .kal-day.selected .kal-dot { background: #fff; display: block; }
    .kal-day.other-month { color: #d1d5db; cursor: default; }
    .kal-day.other-month:hover { background: transparent; color: #d1d5db; }

    .kal-event-card {
        animation: slideUpCard .3s cubic-bezier(.4,0,.2,1) both;
    }
</style>


{{-- ═══════════════════════════════════════════════════════════
     SCRIPT
     ═══════════════════════════════════════════════════════════ --}}
<script>
// ── Data dari Blade ──────────────────────────────────────────
const JADWAL_DATA = @json($jadwalJson);

// index by date string
const JADWAL_BY_DATE = {};
JADWAL_DATA.forEach(j => {
    if (!JADWAL_BY_DATE[j.tanggal]) JADWAL_BY_DATE[j.tanggal] = [];
    JADWAL_BY_DATE[j.tanggal].push(j);
});

// ── MODAL 1 helpers ──────────────────────────────────────────
function openJadwalModal() {
    const m = document.getElementById('modalJadwal');
    document.body.classList.add('modal-open');
    m.classList.add('is-open');
}

function closeJadwalModal() {
    _closeModal('modalJadwal', 'modalJadwalPanel');
}

// ── MODAL 2 helpers ──────────────────────────────────────────
let kalenderYear, kalenderMonth, kalenderSelected = null;

function openKalenderModal() {
    const now = new Date();
    kalenderYear  = now.getFullYear();
    kalenderMonth = now.getMonth(); // 0-indexed
    renderKalender();
    const m = document.getElementById('modalKalender');
    document.body.classList.add('modal-open');
    m.classList.add('is-open');
}

function closeKalenderModal() {
    _closeModal('modalKalender', 'modalKalenderPanel');
}

function _closeModal(modalId, panelId) {
    const modal = document.getElementById(modalId);
    const panel = document.getElementById(panelId);
    panel.style.transform = 'translateY(24px) scale(0.97)';
    panel.style.opacity   = '0';
    modal.style.opacity   = '0';
    setTimeout(() => {
        modal.classList.remove('is-open');
        panel.style.cssText = '';
        modal.style.opacity = '';
        document.body.classList.remove('modal-open');
    }, 300);
}

// ── Kalender render ──────────────────────────────────────────
const ID_MONTHS = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

function renderKalender() {
    document.getElementById('kalenderMonthLabel').textContent =
        ID_MONTHS[kalenderMonth] + ' ' + kalenderYear;

    const grid = document.getElementById('kalenderGrid');
    grid.innerHTML = '';

    const today    = new Date();
    const firstDay = new Date(kalenderYear, kalenderMonth, 1);
    const lastDay  = new Date(kalenderYear, kalenderMonth + 1, 0);

    // leading blanks (Sunday = 0)
    const startDow = firstDay.getDay();
    for (let i = 0; i < startDow; i++) {
        grid.appendChild(blankCell());
    }

    for (let d = 1; d <= lastDay.getDate(); d++) {
        const dateStr = `${kalenderYear}-${String(kalenderMonth + 1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
        const isToday = (d === today.getDate() && kalenderMonth === today.getMonth() && kalenderYear === today.getFullYear());
        const hasEv   = !!JADWAL_BY_DATE[dateStr];
        const isSel   = dateStr === kalenderSelected;

        const cell = document.createElement('div');
        cell.className = 'kal-day' +
            (isToday ? ' today' : '') +
            (hasEv   ? ' has-event' : '') +
            (isSel   ? ' selected' : '');
        cell.innerHTML = `<span>${d}</span><span class="kal-dot"></span>`;

        if (hasEv) {
            cell.onclick = () => selectKalDate(dateStr, d);
        }

        grid.appendChild(cell);
    }

    // trailing blanks to complete last row
    const total = startDow + lastDay.getDate();
    const trailing = (7 - (total % 7)) % 7;
    for (let i = 0; i < trailing; i++) grid.appendChild(blankCell());

    // if previously selected date is in this month, re-render side
    if (kalenderSelected && kalenderSelected.startsWith(`${kalenderYear}-${String(kalenderMonth + 1).padStart(2,'0')}`)) {
        renderSide(kalenderSelected);
    } else {
        document.getElementById('kalenderSideTitle').textContent = 'Pilih tanggal';
        document.getElementById('kalenderSideList').innerHTML = '<div class="text-sm text-gray-300 italic">—</div>';
    }
}

function blankCell() {
    const d = document.createElement('div');
    d.className = 'kal-day other-month';
    return d;
}

function selectKalDate(dateStr, dayNum) {
    kalenderSelected = dateStr;
    renderKalender();
    renderSide(dateStr);
}

function renderSide(dateStr) {
    const events = JADWAL_BY_DATE[dateStr] || [];
    const d = new Date(dateStr + 'T00:00:00');
    const label = d.toLocaleDateString('id-ID', { weekday:'long', day:'numeric', month:'long' });
    document.getElementById('kalenderSideTitle').textContent = label;

    const list = document.getElementById('kalenderSideList');
    list.innerHTML = '';

    if (!events.length) {
        list.innerHTML = '<p class="text-sm text-gray-400 italic">Tidak ada kegiatan</p>';
        return;
    }

    events.forEach((ev, i) => {
        const card = document.createElement('div');
        card.className = 'kal-event-card bg-emerald-50 border border-emerald-100 rounded-2xl p-3 space-y-1.5';
        card.style.animationDelay = (i * 60) + 'ms';
        card.innerHTML = `
            <p class="text-sm font-semibold text-gray-900 leading-snug">${ev.nama_kegiatan}</p>
            <div class="flex flex-wrap gap-x-3 gap-y-1">
                <span class="flex items-center gap-1 text-xs text-emerald-700">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>
                    </svg>
                    ${ev.waktu.replace(':','.')} WIB
                </span>
                ${ev.lokasi ? `<span class="flex items-center gap-1 text-xs text-gray-500">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 21s-6-5.686-6-10a6 6 0 1112 0c0 4.314-6 10-6 10z"/>
                        <circle cx="12" cy="11" r="2"/>
                    </svg>
                    ${ev.lokasi}
                </span>` : ''}
            </div>
            ${ev.deskripsi ? `<p class="text-xs text-gray-500 leading-relaxed pt-0.5">${ev.deskripsi}</p>` : ''}
        `;
        list.appendChild(card);
    });
}

function kalenderPrev() {
    kalenderMonth--;
    if (kalenderMonth < 0) { kalenderMonth = 11; kalenderYear--; }
    renderKalender();
}
function kalenderNext() {
    kalenderMonth++;
    if (kalenderMonth > 11) { kalenderMonth = 0; kalenderYear++; }
    renderKalender();
}

// ── Accordion (modal 1) ──────────────────────────────────────
const openDetails = new Set();
function toggleJadwalDetail(index) {
    const detail  = document.getElementById(`detail-${index}`);
    const chevron = document.getElementById(`chevron-${index}`);
    if (!detail) return;
    if (openDetails.has(index)) {
        detail.style.maxHeight = detail.scrollHeight + 'px';
        requestAnimationFrame(() => detail.style.maxHeight = '0');
        chevron?.classList.remove('rotate-180');
        openDetails.delete(index);
    } else {
        detail.style.maxHeight = detail.scrollHeight + 'px';
        chevron?.classList.add('rotate-180');
        openDetails.add(index);
        detail.addEventListener('transitionend', () => {
            if (openDetails.has(index)) detail.style.maxHeight = 'none';
        }, { once: true });
    }
}

// ── Escape closes any open modal ─────────────────────────────
document.addEventListener('keydown', e => {
    if (e.key !== 'Escape') return;
    if (document.getElementById('modalKalender').classList.contains('is-open')) closeKalenderModal();
    else if (document.getElementById('modalJadwal').classList.contains('is-open')) closeJadwalModal();
});
</script>
