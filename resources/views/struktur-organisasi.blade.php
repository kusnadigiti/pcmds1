<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Struktur Organisasi</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
@vite(['resources/css/app.css','resources/js/app.js'])
<style>
/* ─── Reset & Base ─── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #f8f7f4;
    color: #1a1a18;
    min-height: 100vh;
}

/* ─── Hero ─── */
.hero {
    padding: 100px 24px 56px;
    text-align: center;
    border-bottom: 1px solid rgba(26,26,24,0.07);
}

.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #888880;
    margin-bottom: 20px;
}

.hero-eyebrow::before,
.hero-eyebrow::after {
    content: '';
    display: block;
    width: 20px;
    height: 1px;
    background: currentColor;
    opacity: 0.5;
}

.hero h1 {
    font-size: 56px;
    font-weight: 800;
    letter-spacing: -0.035em;
    line-height: 1.0;
    color: #1a1a18;
    margin-bottom: 14px;
}

.hero h1 em {
    font-style: italic;
    font-weight: 300;
    color: #6b6b65;
}

.hero p {
    font-size: 15px;
    color: #888880;
    font-weight: 400;
    max-width: 360px;
    margin: 0 auto;
    line-height: 1.6;
}

/* ─── Main Wrap ─── */
.org-section {
    padding: 60px 16px 100px;
}

/* ─── Scroll Container (supaya bisa geser horizontal di mobile) ─── */
.org-scroll {
    overflow-x: auto;
    padding-bottom: 20px;
}

/* ─── Tree Container ─── */
.org-tree {
    display: flex;
    flex-direction: column;
    align-items: center;
    min-width: 700px;
    padding: 0 40px;
}

/* ─── Setiap level/tier ─── */
.org-tier {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}

/* ─── Garis vertikal penghubung ─── */
.v-line {
    width: 1px;
    height: 36px;
    background: rgba(26,26,24,0.15);
    flex-shrink: 0;
}

/* ─── Area baris kartu + garis horizontal ─── */
.branch-row {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    position: relative;
    width: 100%;
}

/* ─── Kolom per kartu (atas: garis v, bawah: kartu) ─── */
.branch-col {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 0 10px;
}

/* ─── Garis horizontal (digambar JS) ─── */
.h-line {
    position: absolute;
    top: 0;
    height: 1px;
    background: rgba(26,26,24,0.15);
    pointer-events: none;
}

/* ─── Label tier ─── */
.tier-label {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: #aaa9a3;
    margin-bottom: 0;
    align-self: center;
}

.tier-label::before,
.tier-label::after {
    content: '';
    display: block;
    width: 24px;
    height: 1px;
    background: rgba(26,26,24,0.12);
}

/* ─── Kartu ─── */
.org-card {
    width: 136px;
    padding: 20px 14px 16px;
    background: #ffffff;
    border: 1px solid rgba(26,26,24,0.07);
    border-radius: 16px;
    text-align: center;
    cursor: default;
    transition: border-color 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
    /* animasi masuk */
    opacity: 0;
    transform: translateY(16px);
}

.org-card.visible {
    opacity: 1;
    transform: translateY(0);
}

.org-card:hover {
    border-color: rgba(26,26,24,0.18);
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(26,26,24,0.06);
}

/* Level 1 — lebih besar & menonjol */
.org-card.lv1 {
    width: 156px;
    padding: 24px 16px 20px;
    border-color: rgba(26,26,24,0.12);
    border-radius: 20px;
}

/* ─── Avatar ─── */
.org-avatar {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    margin: 0 auto 12px;
    overflow: hidden;
    background: #f0eeea;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: 700;
    color: #888880;
    flex-shrink: 0;
    transition: transform 0.3s ease;
}

.org-card.lv1 .org-avatar {
    width: 60px;
    height: 60px;
    font-size: 19px;
    background: #1a1a18;
    color: #f8f7f4;
    margin-bottom: 14px;
}

.org-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: grayscale(30%);
    transition: filter 0.4s ease;
}

.org-card:hover .org-avatar {
    transform: scale(1.05);
}

.org-card:hover .org-avatar img {
    filter: grayscale(0%);
}

/* ─── Nama & Peran ─── */
.org-name {
    font-size: 13px;
    font-weight: 700;
    color: #1a1a18;
    line-height: 1.3;
    margin-bottom: 6px;
}

.org-card.lv1 .org-name {
    font-size: 14px;
}

.org-role {
    font-size: 11px;
    font-weight: 500;
    color: #aaa9a3;
    line-height: 1.3;
}

.org-card.lv1 .org-role {
    font-size: 12px;
}

/* ─── Badge untuk pimpinan ─── */
.lv1-badge {
    display: inline-block;
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #1a1a18;
    background: #f0eeea;
    padding: 3px 10px;
    border-radius: 20px;
    margin-bottom: 14px;
}

/* ─── Responsive ─── */
@media (max-width: 640px) {
    .hero h1 { font-size: 40px; }
    .hero p { font-size: 14px; }
    .org-section { padding: 40px 8px 80px; }
}
</style>
</head>

<body>

@include('layouts.navigation')

{{-- ── HERO ── --}}
<section class="hero">
    <div class="hero-eyebrow">Kepengurusan Aktif</div>
    <h1>Struktur <em>Organisasi</em></h1>
    <p>Susunan kepengurusan periode aktif yang siap membawa perubahan nyata.</p>
</section>

{{-- ── ORG CHART ── --}}
<section class="org-section">
    <div class="org-scroll">
        <div class="org-tree" id="org-tree">

            @php
                $lv1 = $strukturs->where('peran_level', 1);
                $lv2 = $strukturs->where('peran_level', 2);
                $lv3 = $strukturs->where('peran_level', 3);
            @endphp

            {{-- ── LEVEL 1: PIMPINAN ── --}}
            @if($lv1->count())
            <div class="org-tier" id="tier-lv1">
                <div class="branch-row" id="row-lv1">
                    @foreach($lv1 as $i => $item)
                    <div class="branch-col">
                        {{-- Garis vertikal di atas kartu (kecuali baris pertama, tidak ada garis dari atas) --}}
                        <div class="v-line" style="background: transparent;"></div>
                        <div class="org-card lv1" data-delay="{{ $loop->index * 80 }}">
                            <div class="lv1-badge">Pimpinan</div>
                            <div class="org-avatar">
                                @if($item->image)
                                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->nama }}">
                                @else
                                    {{ strtoupper(substr($item->nama, 0, 1)) }}{{ strtoupper(substr(strstr($item->nama, ' '), 1, 1)) }}
                                @endif
                            </div>
                            <div class="org-name">{{ $item->nama }}</div>
                            <div class="org-role">{{ $item->peran }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- ── CONNECTOR LV1 → LV2 ── --}}
            @if($lv1->count() && $lv2->count())
            <div class="v-line"></div>
            @endif

            {{-- ── LEVEL 2: SEKRETARIAT & BENDAHARA ── --}}
            @if($lv2->count())
            <div class="org-tier" id="tier-lv2">
                <div class="tier-label" style="margin-bottom: 0;">Sekretariat &amp; Bendahara</div>
                <div class="v-line" style="height: 20px;"></div>
                <div class="branch-row" id="row-lv2">
                    @foreach($lv2 as $item)
                    <div class="branch-col">
                        <div class="v-line"></div>
                        <div class="org-card lv2" data-delay="{{ $loop->index * 80 }}">
                            <div class="org-avatar">
                                @if($item->image)
                                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->nama }}">
                                @else
                                    {{ strtoupper(substr($item->nama, 0, 1)) }}{{ strtoupper(substr(strstr($item->nama, ' '), 1, 1)) }}
                                @endif
                            </div>
                            <div class="org-name">{{ $item->nama }}</div>
                            <div class="org-role">{{ $item->peran }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- ── CONNECTOR LV2 → LV3 ── --}}
            @if($lv2->count() && $lv3->count())
            <div class="v-line"></div>
            @endif

            {{-- ── LEVEL 3: BIDANG & DIVISI ── --}}
            @if($lv3->count())
            <div class="org-tier" id="tier-lv3">
                <div class="tier-label" style="margin-bottom: 0;">Bidang &amp; Divisi</div>
                <div class="v-line" style="height: 20px;"></div>
                <div class="branch-row" id="row-lv3">
                    @foreach($lv3 as $item)
                    <div class="branch-col">
                        <div class="v-line"></div>
                        <div class="org-card lv3" data-delay="{{ $loop->index * 60 }}">
                            <div class="org-avatar">
                                @if($item->image)
                                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->nama }}">
                                @else
                                    {{ strtoupper(substr($item->nama, 0, 1)) }}{{ strtoupper(substr(strstr($item->nama, ' '), 1, 1)) }}
                                @endif
                            </div>
                            <div class="org-name">{{ $item->nama }}</div>
                            <div class="org-role">{{ $item->peran }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // 1. Gambar garis horizontal yang menghubungkan kartu dalam satu baris
    function drawHLines() {
        ['row-lv1', 'row-lv2', 'row-lv3'].forEach(function (rowId) {
            var row = document.getElementById(rowId);
            if (!row) return;

            var cols = row.querySelectorAll('.branch-col');
            if (cols.length < 2) return;

            var rowRect = row.getBoundingClientRect();
            var firstRect = cols[0].getBoundingClientRect();
            var lastRect  = cols[cols.length - 1].getBoundingClientRect();

            // Titik tengah kolom pertama & terakhir
            var leftX  = firstRect.left  + firstRect.width  / 2 - rowRect.left;
            var rightX = lastRect.left   + lastRect.width   / 2 - rowRect.left;

            var hl = document.createElement('div');
            hl.className = 'h-line';
            hl.style.left  = leftX  + 'px';
            hl.style.width = (rightX - leftX) + 'px';
            row.appendChild(hl);
        });
    }

    drawHLines();
    window.addEventListener('resize', function () {
        // Hapus h-line lama lalu gambar ulang
        document.querySelectorAll('.h-line').forEach(function (el) { el.remove(); });
        drawHLines();
    });

    // 2. Animasi masuk dengan IntersectionObserver + stagger delay
    var cards = document.querySelectorAll('.org-card');
    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                var delay = parseInt(entry.target.dataset.delay || 0);
                setTimeout(function () {
                    entry.target.classList.add('visible');
                }, delay);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });

    cards.forEach(function (card) { observer.observe(card); });

});
</script>

</body>
</html>
