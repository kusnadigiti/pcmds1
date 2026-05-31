<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        .dash-wrap, .dash-wrap * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .dash-wrap { padding: 2rem 1rem; }
        .dash-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; }
        .dash-greeting h1 { font-size: 1.5rem; font-weight: 600; color: #1a1a1a; margin: 0 0 4px; }
        .dash-greeting p { font-size: 0.875rem; color: #6b7280; margin: 0; }
        .dash-clock-wrap { text-align: right; }
        .dash-clock { font-size: 2rem; font-weight: 700; color: #1a1a1a; font-variant-numeric: tabular-nums; line-height: 1; }
        .dash-date-str { font-size: 0.75rem; color: #6b7280; margin-top: 2px; }

        /* Stat cards */
        .stat-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1rem; margin-bottom: 1.75rem; }
        .stat-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 1.25rem; position: relative; overflow: hidden; transition: box-shadow 0.2s; }
        .stat-card:hover { box-shadow: 0 4px 12px rgba(0, 0, 0, 0.07); }
        .stat-card .sc-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px; font-size: 1.1rem; }
        .stat-card .sc-label { font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 6px; }
        .stat-card .sc-value { font-size: 2rem; font-weight: 700; color: #111827; line-height: 1; margin-bottom: 8px; }
        .stat-card .sc-badge { display: inline-flex; align-items: center; gap: 4px; font-size: 0.7rem; font-weight: 600; padding: 3px 8px; border-radius: 20px; }
        .badge-teal { background: #d1fae5; color: #065f46; }
        .badge-blue { background: #dbeafe; color: #1e40af; }
        .badge-amber { background: #fef3c7; color: #92400e; }
        .badge-gray { background: #f3f4f6; color: #374151; }
        .badge-purple { background: #ede9fe; color: #5b21b6; }
        .badge-rose { background: #ffe4e6; color: #9f1239; }
        .sc-accent { position: absolute; right: -10px; bottom: -10px; font-size: 5rem; opacity: 0.04; }

        /* Main grid */
        .main-grid { display: grid; grid-template-columns: 1fr 300px; gap: 1.25rem; margin-bottom: 1.25rem; }
        .section-label { font-size: 0.7rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 0.75rem; }

        /* Card base */
        .card { background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 1.25rem; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
        .card-title { font-size: 0.9rem; font-weight: 600; color: #111827; }
        .card-link { font-size: 0.75rem; color: #6b7280; text-decoration: none; cursor: pointer; }
        .card-link:hover { color: #059669; }

        /* Activity feed */
        .activity-item { display: flex; align-items: flex-start; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f3f4f6; }
        .activity-item:last-child { border-bottom: none; padding-bottom: 0; }
        .activity-icon { width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 0.9rem; }
        .activity-body { flex: 1; min-width: 0; }
        .activity-body p { font-size: 0.8rem; color: #374151; line-height: 1.5; margin: 0 0 2px; }
        .activity-body p strong { color: #111827; font-weight: 600; }
        .activity-body span { font-size: 0.7rem; color: #9ca3af; }
        .activity-time { font-size: 0.7rem; color: #9ca3af; flex-shrink: 0; }

        /* Sholat */
        .sholat-row { display: flex; align-items: center; justify-content: space-between; padding: 9px 0; border-bottom: 1px solid #f3f4f6; }
        .sholat-row:last-child { border-bottom: none; }
        .sholat-row.active { background: #ecfdf5; margin: 0 -1.25rem; padding: 9px 1.25rem; border-radius: 8px; border-bottom: none; }
        .sholat-name { font-size: 0.82rem; color: #374151; display: flex; align-items: center; gap: 8px; }
        .sholat-row.active .sholat-name { color: #065f46; font-weight: 600; }
        .sholat-time { font-size: 0.85rem; font-weight: 600; color: #374151; }
        .sholat-row.active .sholat-time { color: #059669; }
        .pulse-dot { width: 7px; height: 7px; border-radius: 50%; background: #10b981; flex-shrink: 0; animation: pulse 2s infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; transform: scale(1) } 50% { opacity: 0.5; transform: scale(1.3) } }

        /* Progress */
        .prog-item { margin-bottom: 1rem; }
        .prog-item:last-child { margin-bottom: 0; }
        .prog-header { display: flex; justify-content: space-between; font-size: 0.8rem; color: #374151; margin-bottom: 6px; }
        .prog-header span:last-child { color: #9ca3af; font-size: 0.75rem; }
        .prog-track { height: 5px; background: #f3f4f6; border-radius: 3px; overflow: hidden; }
        .prog-fill { height: 100%; border-radius: 3px; transition: width 1s ease; }

        /* Announcements */
        .announce-item { display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f3f4f6; }
        .announce-item:last-child { border-bottom: none; }
        .announce-date-box { text-align: center; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 10px; flex-shrink: 0; min-width: 46px; }
        .announce-date-box strong { display: block; font-size: 1.1rem; font-weight: 700; color: #111827; line-height: 1; }
        .announce-date-box span { font-size: 0.65rem; color: #9ca3af; text-transform: uppercase; }
        .announce-body p { font-size: 0.82rem; font-weight: 600; color: #111827; margin: 0 0 3px; }
        .announce-body small { font-size: 0.72rem; color: #6b7280; }

        /* Quick actions */
        .qa-grid { display: grid; grid-template-columns: repeat(6, minmax(0, 1fr)); gap: 10px; }
        .qa-btn { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 10px; padding: 14px 8px; text-align: center; cursor: pointer; text-decoration: none; transition: all 0.15s; display: flex; flex-direction: column; align-items: center; gap: 8px; }
        .qa-btn:hover { background: #fff; border-color: #d1d5db; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); transform: translateY(-1px); }
        .qa-btn i { font-size: 1.3rem; color: #6b7280; }
        .qa-btn span { font-size: 0.72rem; font-weight: 500; color: #374151; line-height: 1.3; }

        /* Second row */
        .bottom-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem; }

        /* ── Modal ── */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.45);
            backdrop-filter: blur(3px);
            z-index: 999;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; pointer-events: none;
            transition: opacity 0.2s;
        }
        .modal-overlay.open { opacity: 1; pointer-events: all; }
        .modal-box {
            background: #fff; border-radius: 16px;
            width: 100%; max-width: 520px; max-height: 80vh;
            display: flex; flex-direction: column;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            transform: translateY(14px) scale(0.98);
            transition: transform 0.22s ease, opacity 0.22s ease;
            margin: 1rem;
        }
        .modal-overlay.open .modal-box { transform: translateY(0) scale(1); }
        .modal-head {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #f3f4f6;
            flex-shrink: 0;
        }
        .modal-head h3 { font-size: 0.95rem; font-weight: 600; color: #111827; margin: 0; font-family: 'Plus Jakarta Sans', sans-serif; }
        .modal-badge { font-size: 0.68rem; font-weight: 600; background: #f3f4f6; color: #6b7280; padding: 2px 8px; border-radius: 20px; margin-left: 8px; }
        .modal-close {
            width: 28px; height: 28px; border-radius: 8px;
            border: none; background: #f3f4f6; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; color: #6b7280;
            transition: background 0.15s;
            flex-shrink: 0;
        }
        .modal-close:hover { background: #e5e7eb; color: #111827; }
        .modal-body { overflow-y: auto; padding: 0.25rem 1.25rem 1.25rem; flex: 1; }
        .modal-body .activity-item:last-child { border-bottom: none; }

        /* Responsive */
        @media (max-width: 768px) {
            .stat-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .main-grid { grid-template-columns: 1fr; }
            .bottom-grid { grid-template-columns: 1fr; }
            .qa-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        }
    </style>

    {{-- ── MODAL SEMUA AKTIVITAS ── --}}
    <div class="modal-overlay" id="modal-aktivitas" role="dialog" aria-modal="true" aria-labelledby="modal-title">
        <div class="modal-box">
            <div class="modal-head">
                <div style="display:flex;align-items:center">
                    <h3 id="modal-title">Semua Aktivitas</h3>
                    <span class="modal-badge" id="modal-count">0</span>
                </div>
                <button class="modal-close" id="modal-close-btn" aria-label="Tutup">✕</button>
            </div>
            <div class="modal-body" id="modal-activity-list">
                {{-- diisi JS --}}
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dash-wrap">

                {{-- ===== HEADER ===== --}}
                <div class="dash-header">
                    <div class="dash-greeting">
                        <h1>Ahlan wa sahlan, {{ Auth::user()->name ?? 'Admin' }} 👋</h1>
                        <p id="hijri-date">Memuat tanggal hijriyah...</p>
                    </div>
                    <div class="dash-clock-wrap">
                        <div class="dash-clock" id="live-clock">--:--:--</div>
                        <div class="dash-date-str">Waktu Indonesia Barat (WIB)</div>
                    </div>
                </div>

                {{-- ===== STAT CARDS ===== --}}
                <p class="section-label">Ringkasan</p>
                <div class="stat-grid">
                    <div class="stat-card">
                        <div class="sc-icon" style="background:#d1fae5">📰</div>
                        <div class="sc-label">Total Berita</div>
                        <div class="sc-value">{{ $totalBerita ?? 0 }}</div>
                        <span class="sc-badge badge-teal">{{ $beritaPublish ?? 0 }} terpublikasi</span>
                        <div class="sc-accent">📰</div>
                    </div>
                    <div class="stat-card">
                        <div class="sc-icon" style="background:#dbeafe">📄</div>
                        <div class="sc-label">Total Artikel</div>
                        <div class="sc-value">{{ $totalArtikel ?? 0 }}</div>
                        <span class="sc-badge badge-blue">{{ $artikelPublish ?? 0 }} terpublikasi</span>
                        <div class="sc-accent">📄</div>
                    </div>
                    <div class="stat-card">
                        <div class="sc-icon" style="background:#ede9fe">👥</div>
                        <div class="sc-label">Pengurus Aktif</div>
                        <div class="sc-value">{{ $totalPengurus ?? 0 }}</div>
                        <span class="sc-badge badge-purple">{{ $totalOrganisasi ?? 0 }} organisasi</span>
                        <div class="sc-accent">👥</div>
                    </div>
                    <div class="stat-card">
                        <div class="sc-icon" style="background:#fef3c7">🕌</div>
                        <div class="sc-label">Kajian Bulan Ini</div>
                        <div class="sc-value">{{ $totalKajianBulanIni ?? 0 }}</div>
                        <span class="sc-badge badge-amber">{{ $kajianMendatang ?? 0 }} mendatang</span>
                        <div class="sc-accent">🕌</div>
                    </div>
                </div>

                {{-- ===== MAIN GRID: ACTIVITY + SHOLAT ===== --}}
                <div class="main-grid">
                    <div>
                        <p class="section-label">Aktivitas terbaru</p>
                        <div class="card">
                            <div class="card-header">
                                <span class="card-title">Log Aktivitas</span>
                                <span class="card-link" id="btn-lihat-semua" onclick="openModalAktivitas()">Lihat semua →</span>
                            </div>
                            @php
                                $activities = $aktivitas ?? collect([
                                    ['module' => 'Artikel',    'bg' => '#dbeafe', 'text' => 'Artikel <strong>"Keutamaan Sholat Berjamaah"</strong> diterbitkan',              'time' => '2j lalu'],
                                    ['module' => 'Pengurus',   'bg' => '#d1fae5', 'text' => 'Pengurus baru ditambahkan: <strong>Ustadz Ahmad Fauzi</strong>',                 'time' => '5j lalu'],
                                    ['module' => 'Kajian',     'bg' => '#fef3c7', 'text' => 'Jadwal kajian <strong>"Fiqih Muamalah"</strong> ditambahkan untuk 15 Mei',       'time' => '1h lalu'],
                                    ['module' => 'Berita',     'bg' => '#ffe4e6', 'text' => 'Berita <strong>"Pelantikan Pengurus IPM"</strong> dipublikasikan',               'time' => '2h lalu'],
                                    ['module' => 'Organisasi', 'bg' => '#ecfdf5', 'text' => 'Profil organisasi <strong>PCM Kota</strong> diperbarui',                         'time' => '3h lalu'],
                                ]);
                            @endphp

                            {{-- Data untuk modal (semua aktivitas, termasuk lebih dari 5) --}}
                            @php
                                $allActivities = $semuaAktivitas ?? $activities;
                            @endphp
                            <script>
                                const ALL_ACTIVITIES = @json($allActivities);
                            </script>

                            @foreach ($activities->take(5) as $act)
                                <div class="activity-item">
                                    <div class="activity-icon" style="background: {{ $act['bg'] ?? '#f3f4f6' }}">
                                        @php
                                            $iconSvg = match ($act['module']) {
                                                'Artikel' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M7 4h10l2 2v14H5V6l2-2z"/></svg>',
                                                'Pengurus' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="#16a34a" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c2.21 0 4-1.79 4-4S14.21 3 12 3 8 4.79 8 7s1.79 4 4 4zm0 2c-4 0-6 2-6 3v1h12v-1c0-1-2-3-6-3z"/></svg>',
                                                'Kajian' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="#d97706" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10m-12 8h14a2 2 0 002-2V7H3v10a2 2 0 002 2z"/></svg>',
                                                'Berita' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="#e11d48" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path stroke-linecap="round" d="M7 8h10M7 12h6"/></svg>',
                                                'Organisasi' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="#059669" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M9 8h6m-6 4h6m-7 9V3h8v18"/></svg>',
                                                default => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="#6b7280" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>',
                                            };
                                        @endphp
                                        {!! $iconSvg !!}
                                    </div>
                                    <div class="activity-body">
                                        <p>{!! $act['text'] !!}</p>
                                        <span>{{ $act['module'] ?? '' }}</span>
                                    </div>
                                    <div class="activity-time">{{ $act['time'] ?? '' }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <p class="section-label">Jadwal sholat hari ini</p>
                        <div class="card">
                            <div class="card-header">
                                <span class="card-title">Waktu Sholat</span>
                                <span style="font-size:0.72rem; color:#9ca3af">📍 Jakarta</span>
                            </div>
                            <div id="sholat-container"></div>
                        </div>
                    </div>
                </div>

                {{-- ===== BOTTOM GRID: PROGRESS + PENGUMUMAN ===== --}}
                <div class="bottom-grid">
                    <div>
                        <p class="section-label">Progres konten</p>
                        <div class="card">
                            @php
                                $progItems = [
                                    ['label' => 'Berita terpublikasi',  'val' => $beritaPublish ?? 18,  'total' => $totalBerita ?? 24,          'color' => '#10b981'],
                                    ['label' => 'Artikel terpublikasi', 'val' => $artikelPublish ?? 12, 'total' => $totalArtikel ?? 18,         'color' => '#3b82f6'],
                                    ['label' => 'Kajian terlaksana',    'val' => $kajianTerlaksana ?? 6,'total' => $totalKajianBulanIni ?? 8,   'color' => '#f59e0b'],
                                    ['label' => 'Pengurus aktif',       'val' => $totalPengurus ?? 28,  'total' => $totalPengurusAll ?? 32,     'color' => '#8b5cf6'],
                                ];
                            @endphp
                            @foreach ($progItems as $prog)
                                @php $pct = $prog['total'] > 0 ? round(($prog['val'] / $prog['total']) * 100) : 0; @endphp
                                <div class="prog-item">
                                    <div class="prog-header">
                                        <span>{{ $prog['label'] }}</span>
                                        <span>{{ $prog['val'] }} / {{ $prog['total'] }}</span>
                                    </div>
                                    <div class="prog-track">
                                        <div class="prog-fill" style="width: {{ $pct }}%; background: {{ $prog['color'] }};"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <p class="section-label">Kegiatan mendatang</p>
                        <div class="card">
                            @php
                                $jadwalMendatang = $mendatang ?? collect([
                                    (object)['nama_kegiatan' => 'Kajian Ahad Pagi: Tafsir Al-Mulk', 'tanggal' => '2025-05-12', 'waktu' => '07:00', 'lokasi' => 'Masjid Utama'],
                                    (object)['nama_kegiatan' => 'Fiqih Muamalah Kontemporer',        'tanggal' => '2025-05-15', 'waktu' => '19:30', 'lokasi' => 'Aula Lt. 2'],
                                    (object)['nama_kegiatan' => 'Rapat Pleno Pengurus PCM',          'tanggal' => '2025-05-18', 'waktu' => '09:00', 'lokasi' => 'Sekretariat'],
                                    (object)['nama_kegiatan' => 'Bakti Sosial & Donor Darah',        'tanggal' => '2025-05-22', 'waktu' => '08:00', 'lokasi' => 'Halaman Masjid'],
                                ]);
                            @endphp
                            @foreach ($jadwalMendatang as $jadwal)
                                <div class="announce-item">
                                    <div class="announce-date-box">
                                        <strong>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d') }}</strong>
                                        <span>{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('M') }}</span>
                                    </div>
                                    <div class="announce-body">
                                        <p>{{ $jadwal->nama_kegiatan }}</p>
                                        <small>{{ $jadwal->lokasi }} · {{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} WIB</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                @if (Auth::user()->role !== 'penulis')

                <p class="section-label">Aksi cepat</p>
                <div class="card">
                    <div class="qa-grid">
                        <a href="{{ route('admin.articles.create') }}" class="qa-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12h6m-6 4h6M7 4h10l2 2v14H5V6l2-2z"/></svg>
                            <span>Tambah Artikel</span>
                        </a>
                        <a href="{{ route('admin.berita.create') }}" class="qa-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M7 8h10M7 12h6"/></svg>
                            <span>Tambah Berita</span>
                        </a>
                        <a href="{{ route('admin.jadwal-kajian.create') }}" class="qa-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#9333ea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            <span>Jadwal Kajian</span>
                        </a>
                        <a href="{{ route('admin.pengurus.create') }}" class="qa-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a6.5 6.5 0 0 1 13 0"/></svg>
                            <span>Tambah Pengurus</span>
                        </a>
                        <a href="{{ route('admin.organisasi-otonom.create') }}" class="qa-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0ea5e9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M16 3h-8v4h8V3z"/></svg>
                            <span>Tambah Organisasi</span>
                        </a>
                        <a href="{{ route('admin.profile-organisasi') }}" class="qa-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a7.97 7.97 0 0 0 .1-6l2-2-2-2-2 2a8 8 0 0 0-6 0l-2-2-2 2 2 2a8 8 0 0 0 0 6l-2 2 2 2 2-2a8 8 0 0 0 6 0l2 2 2-2-2-2z"/></svg>
                            <span>Profil Masjid</span>
                        </a>
                    </div>
                </div>
                @endif


            </div>
        </div>
    </div>

    <script>
        // ── Live clock WIB ──
        function updateClock() {
            const wib = new Date(new Date().toLocaleString('en-US', { timeZone: 'Asia/Jakarta' }));
            const pad = n => String(n).padStart(2, '0');
            document.getElementById('live-clock').textContent =
                pad(wib.getHours()) + ':' + pad(wib.getMinutes()) + ':' + pad(wib.getSeconds());
        }
        updateClock();
        setInterval(updateClock, 1000);

        // ── Tanggal Hijriyah ──
        try {
            const now = new Date();
            const greg = new Intl.DateTimeFormat('id-ID', { weekday:'long', day:'numeric', month:'long', year:'numeric' }).format(now);
            let hijri = '';
            try { hijri = ' · ' + new Intl.DateTimeFormat('id-ID-u-ca-islamic', { day:'numeric', month:'long', year:'numeric' }).format(now) + ' H'; } catch(e) {}
            document.getElementById('hijri-date').textContent = greg + hijri;
        } catch(e) {}

        // ── Modal Aktivitas ──
        const ICON_MAP = {
            'Artikel':    { bg: '#dbeafe', svg: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M7 4h10l2 2v14H5V6l2-2z"/></svg>' },
            'Pengurus':   { bg: '#d1fae5', svg: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#16a34a" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c2.21 0 4-1.79 4-4S14.21 3 12 3 8 4.79 8 7s1.79 4 4 4zm0 2c-4 0-6 2-6 3v1h12v-1c0-1-2-3-6-3z"/></svg>' },
            'Kajian':     { bg: '#fef3c7', svg: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#d97706" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10m-12 8h14a2 2 0 002-2V7H3v10a2 2 0 002 2z"/></svg>' },
            'Berita':     { bg: '#ffe4e6', svg: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#e11d48" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path stroke-linecap="round" d="M7 8h10M7 12h6"/></svg>' },
            'Organisasi': { bg: '#ecfdf5', svg: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#059669" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M9 8h6m-6 4h6m-7 9V3h8v18"/></svg>' },
        };

        function buildActivityItem(act) {
            const mod = act.module || '';
            const map = ICON_MAP[mod] || { bg: '#f3f4f6', svg: '' };
            const bg  = act.bg || map.bg;
            return `
                <div class="activity-item">
                    <div class="activity-icon" style="background:${bg}">${map.svg}</div>
                    <div class="activity-body">
                        <p>${act.text || ''}</p>
                        <span>${mod}</span>
                    </div>
                    <div class="activity-time">${act.time || ''}</div>
                </div>`;
        }

        function openModalAktivitas() {
            const overlay = document.getElementById('modal-aktivitas');
            const list    = document.getElementById('modal-activity-list');
            const count   = document.getElementById('modal-count');

            const data = typeof ALL_ACTIVITIES !== 'undefined' ? ALL_ACTIVITIES : [];
            count.textContent = data.length + ' entri';
            list.innerHTML = data.length
                ? data.map(buildActivityItem).join('')
                : '<p style="font-size:0.8rem;color:#9ca3af;text-align:center;padding:2rem 0">Belum ada aktivitas.</p>';

            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModalAktivitas() {
            document.getElementById('modal-aktivitas').classList.remove('open');
            document.body.style.overflow = '';
        }

        document.getElementById('modal-close-btn').addEventListener('click', closeModalAktivitas);
        document.getElementById('modal-aktivitas').addEventListener('click', function(e) {
            if (e.target === this) closeModalAktivitas();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModalAktivitas();
        });

        // ── Jadwal Sholat via Aladhan API (Jakarta) ──
        const SHOLAT_KEYS = [
            { key: 'Fajr',    label: 'Subuh',   icon: '🌙' },
            { key: 'Sunrise', label: 'Syuruq',  icon: '🌅' },
            { key: 'Dhuhr',   label: 'Dzuhur',  icon: '☀️' },
            { key: 'Asr',     label: 'Ashar',   icon: '🌤️' },
            { key: 'Maghrib', label: 'Maghrib', icon: '🌇' },
            { key: 'Isha',    label: 'Isya',    icon: '🌙' },
        ];

        let sholatTimes = [];

        function getActiveSholat() {
            const wib = new Date(new Date().toLocaleString('en-US', { timeZone: 'Asia/Jakarta' }));
            const cur = wib.getHours() * 60 + wib.getMinutes();
            let active = 0;
            sholatTimes.forEach((s, i) => {
                const [h, m] = s.time.split(':').map(Number);
                if (cur >= h * 60 + m) active = i;
            });
            return active;
        }

        function renderSholat() {
            const container = document.getElementById('sholat-container');
            if (sholatTimes.length === 0) {
                container.innerHTML = '<p style="font-size:0.8rem;color:#9ca3af;text-align:center;padding:1.25rem 0">⏳ Memuat jadwal sholat...</p>';
                return;
            }
            const active = getActiveSholat();
            container.innerHTML = sholatTimes.map((s, i) => `
                <div class="sholat-row ${i === active ? 'active' : ''}">
                    <div class="sholat-name">
                        ${i === active ? '<span class="pulse-dot"></span>' : `<span style="font-size:0.85rem">${s.icon}</span>`}
                        ${s.label}
                    </div>
                    <div class="sholat-time">${s.time}</div>
                </div>
            `).join('');
        }

        async function fetchSholatJakarta() {
            renderSholat();
            try {
                const wib  = new Date(new Date().toLocaleString('en-US', { timeZone: 'Asia/Jakarta' }));
                const dd   = String(wib.getDate()).padStart(2, '0');
                const mm   = String(wib.getMonth() + 1).padStart(2, '0');
                const yyyy = wib.getFullYear();
                const url  = `https://api.aladhan.com/v1/timingsByCity/${dd}-${mm}-${yyyy}?city=Jakarta&country=Indonesia&method=20`;
                const res  = await fetch(url);
                const json = await res.json();
                if (json.code !== 200) throw new Error('API error');
                const t = json.data.timings;
                sholatTimes = SHOLAT_KEYS.map(k => ({
                    label: k.label, icon: k.icon,
                    time: t[k.key].substring(0, 5),
                }));
                renderSholat();
                setInterval(renderSholat, 60000);
            } catch (err) {
                console.error('Gagal fetch jadwal sholat:', err);
                document.getElementById('sholat-container').innerHTML =
                    '<p style="font-size:0.8rem;color:#ef4444;text-align:center;padding:1rem 0">⚠️ Gagal memuat jadwal.<br>Periksa koneksi internet.</p>';
            }
        }

        fetchSholatJakarta();
    </script>

</x-app-layout>
