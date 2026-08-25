@extends('layouts.colormag')

@section('title', 'Struktur Organisasi | PCM Duren Sawit 1')
@section('meta_description', 'Bagan dan susunan Pimpinan Cabang Muhammadiyah Duren Sawit 1 beserta jajaran ketua, sekretaris, bendahara, dan majelis.')
@section('meta_keywords', 'Struktur Organisasi, Pengurus PCM Duren Sawit 1, Muhammadiyah Duren Sawit, Pimpinan Cabang')
@section('og_image', asset('images/logo.png'))

@section('styles')
    <style>
        /* ─── Org Chart ─── */
        .org-scroll { overflow-x: auto; padding-bottom: 20px; }

        .org-tree {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 700px;
            padding: 10px 40px 30px;
        }

        .org-tier {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .v-line { width: 1px; height: 36px; background: rgba(46,158,91,0.25); flex-shrink: 0; }

        .branch-row {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            position: relative;
            width: 100%;
        }

        .branch-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 10px;
        }

        .h-line {
            position: absolute;
            top: 0;
            height: 1px;
            background: rgba(46,158,91,0.25);
            pointer-events: none;
        }

        .tier-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #2e9e5b;
            margin-bottom: 0;
            align-self: center;
        }
        .tier-label::before,
        .tier-label::after {
            content: '';
            display: block;
            width: 24px;
            height: 1px;
            background: rgba(46,158,91,0.2);
        }

        .org-card {
            width: 136px;
            padding: 20px 14px 16px;
            background: #ffffff;
            border: 1px solid #eaeaea;
            border-radius: 3px;
            text-align: center;
            cursor: default;
            transition: border-color 0.3s linear, transform 0.3s linear, box-shadow 0.3s linear;
            opacity: 0;
            transform: translateY(16px);
        }
        .org-card.visible { opacity: 1; transform: translateY(0); }
        .org-card:hover {
            border-color: #2e9e5b;
            transform: translateY(-4px);
            box-shadow: 0 1px 6px 0 rgba(46,158,91,0.18);
        }

        .org-card.lv1 { width: 156px; padding: 24px 16px 20px; border-top: 3px solid #2e9e5b; }

        .org-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            margin: 0 auto 12px;
            overflow: hidden;
            background: #eaf5ee;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 700;
            color: #2e9e5b;
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }
        .org-card.lv1 .org-avatar {
            width: 60px;
            height: 60px;
            font-size: 19px;
            background: #2e9e5b;
            color: #ffffff;
            margin-bottom: 14px;
        }
        .org-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .org-card:hover .org-avatar { transform: scale(1.05); }

        .org-name {
            font-size: 13px;
            font-weight: 700;
            color: #333333;
            line-height: 1.3;
            margin-bottom: 6px;
        }
        .org-card.lv1 .org-name { font-size: 14px; }

        .org-role {
            font-size: 11px;
            font-weight: 500;
            color: #888888;
            line-height: 1.3;
        }
        .org-card.lv1 .org-role { font-size: 12px; }

        .lv1-badge {
            display: inline-block;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #ffffff;
            background: #2e9e5b;
            padding: 3px 10px;
            border-radius: 3px;
            margin-bottom: 14px;
        }

        @media (prefers-reduced-motion: reduce) {
            .org-card { opacity: 1; transform: none; transition: none; }
        }
    </style>
@endsection

@section('content')
    <div class="cm-inner px-2.5">

        {{-- Breadcrumb --}}
        <nav aria-label="Breadcrumb" class="text-[12px] text-[#888888] mb-4">
            <a href="/" class="text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">Beranda</a>
            <span class="mx-1">/</span> Struktur Organisasi
        </nav>

        {{-- Header --}}
        <h1 class="cm-widget-title !text-[22px]"><span>Struktur Organisasi</span></h1>
        <p class="text-[13px] text-[#777777] mt-[-6px] mb-[25px]">
            Susunan kepengurusan periode aktif PCM Duren Sawit 1.
        </p>

        {{-- Kartu org chart --}}
        <div class="bg-white border border-[#eaeaea] cm-card-shadow mb-[20px]">
            <section class="py-10">
                <div class="org-scroll">
                    <div class="org-tree" id="org-tree">

                        @php
                            $lv1 = $strukturs->where('peran_level', 1);
                            $lv2 = $strukturs->where('peran_level', 2);
                            $lv3 = $strukturs->where('peran_level', 3);
                        @endphp

                        {{-- LEVEL 1: PIMPINAN --}}
                        @if($lv1->count())
                        <div class="org-tier" id="tier-lv1">
                            <div class="branch-row" id="row-lv1">
                                @foreach($lv1 as $i => $item)
                                <div class="branch-col">
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

                        @if($lv1->count() && $lv2->count())
                        <div class="v-line"></div>
                        @endif

                        {{-- LEVEL 2: SEKRETARIAT & BENDAHARA --}}
                        @if($lv2->count())
                        <div class="org-tier" id="tier-lv2">
                            <div class="tier-label">Sekretariat &amp; Bendahara</div>
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

                        @if($lv2->count() && $lv3->count())
                        <div class="v-line"></div>
                        @endif

                        {{-- LEVEL 3: MAJELIS & LEMBAGA --}}
                        @if($lv3->count())
                        <div class="org-tier" id="tier-lv3">
                            <div class="tier-label">Majelis &amp; Lembaga</div>
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
        </div>
    </div>
@endsection

@section('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        // Garis horizontal penghubung kartu dalam satu baris
        function drawHLines() {
            ['row-lv1', 'row-lv2', 'row-lv3'].forEach(function (rowId) {
                var row = document.getElementById(rowId);
                if (!row) return;

                var cols = row.querySelectorAll('.branch-col');
                if (cols.length < 2) return;

                var rowRect = row.getBoundingClientRect();
                var firstRect = cols[0].getBoundingClientRect();
                var lastRect  = cols[cols.length - 1].getBoundingClientRect();

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
            document.querySelectorAll('.h-line').forEach(function (el) { el.remove(); });
            drawHLines();
        });

        // Animasi masuk dengan IntersectionObserver + stagger delay
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
@endsection
