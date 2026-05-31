<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[11px] text-gray-400 uppercase tracking-[.12em] font-semibold mb-0.5">Pengaturan</p>
                <h2 class="text-xl text-gray-900">Struktur Organisasi</h2>
            </div>
        </div>
    </x-slot>

    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body, input, button, select { font-family: 'Outfit', sans-serif; }

        .page-wrap { min-height: 100vh; background: #FAFAFA; padding: 20px 16px 100px; }
        .inner { max-width: 1100px; margin: 0 auto; }

        /* ── TABS (mobile only) ── */
        .mob-tabs {
            display: none;
            background: #fff;
            border: 1px solid #f1f5f9;
            border-radius: 14px;
            padding: 4px;
            margin-bottom: 16px;
            gap: 4px;
        }
        .mob-tab {
            flex: 1;
            padding: 8px 12px;
            border-radius: 10px;
            border: none;
            background: transparent;
            font-size: 13px;
            font-weight: 600;
            color: #94a3b8;
            cursor: pointer;
            transition: all .15s;
            font-family: 'Outfit', sans-serif;
        }
        .mob-tab.active {
            background: #0f172a;
            color: #fff;
        }

        /* ── LAYOUT ── */
        .two-col {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 20px;
            align-items: start;
        }

        /* ── LEFT PANEL ── */
        .lp {
            background: #fff;
            border: 1px solid #f1f5f9;
            border-radius: 20px;
            overflow: hidden;
            position: sticky;
            top: 24px;
        }
        .lp-head { padding: 18px 20px 14px; border-bottom: 1px solid #f1f5f9; }
        .lp-head h3 { font-size: 15px; font-weight: 700; color: #0f172a; margin: 0 0 2px; }
        .lp-head p { font-size: 11px; color: #94a3b8; margin: 0; }
        .lp-body { padding: 14px 16px; max-height: calc(100vh - 220px); overflow-y: auto; }

        .lv-grp { margin-bottom: 20px; }
        .lv-grp-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px; }
        .lv-grp-label { font-size: 10px; font-weight: 700; color: #cbd5e1; text-transform: uppercase; letter-spacing: .1em; }

        .btn-add {
            font-size: 11px; font-weight: 600; color: #64748b;
            background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;
            padding: 3px 10px; cursor: pointer; transition: all .15s;
        }
        .btn-add:hover { background: #0f172a; color: #fff; border-color: #0f172a; }

        .mrow {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 11px; border-radius: 13px;
            border: 1px solid #f1f5f9; background: #fafafa;
            margin-bottom: 5px; cursor: pointer; transition: all .15s;
        }
        .mrow:hover { border-color: #e2e8f0; background: #fff; }
        .mrow.active { border-color: #0f172a; background: #fff; box-shadow: 0 0 0 3px rgba(15,23,42,.05); }
        .mrow.isnew { border-color: #93c5fd; border-style: dashed; background: #f0f9ff; }

        .mav {
            width: 34px; height: 34px; border-radius: 50%;
            background: #f1f5f9; border: 1px solid #e2e8f0;
            flex-shrink: 0; overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700; color: #64748b;
        }
        .mav img { width: 100%; height: 100%; object-fit: cover; }

        .minfo { flex: 1; min-width: 0; }
        .mname { font-size: 13px; font-weight: 600; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .mname.dim { color: #cbd5e1; font-weight: 400; font-style: italic; }
        .mrole { font-size: 11px; color: #94a3b8; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        .macts { display: flex; gap: 4px; flex-shrink: 0; }
        .btn-sm {
            font-size: 11px; font-weight: 500; padding: 3px 8px;
            border-radius: 7px; border: 1px solid #e2e8f0;
            background: #fff; cursor: pointer; transition: all .15s; color: #64748b;
        }
        .btn-sm:hover { border-color: #0f172a; color: #0f172a; }
        .btn-sm.del:hover { border-color: #fca5a5; background: #fef2f2; color: #dc2626; }

        .nbadge { font-size: 9px; font-weight: 700; padding: 2px 6px; background: #dbeafe; color: #1d4ed8; border-radius: 6px; flex-shrink: 0; }
        .empty-state { text-align: center; padding: 20px 0; color: #e2e8f0; font-size: 12px; font-style: italic; }

        /* ── INLINE FORM (desktop) ── */
        .iform {
            background: #f8fafc; border: 1px solid #e2e8f0;
            border-radius: 14px; padding: 14px; margin-bottom: 6px;
        }
        .iform-ttl { font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: .1em; margin-bottom: 12px; }

        .av-row { display: flex; align-items: center; gap: 10px; margin-bottom: 11px; }
        .av-circ {
            width: 42px; height: 42px; border-radius: 50%;
            background: #f1f5f9; border: 1.5px dashed #cbd5e1; flex-shrink: 0;
            overflow: hidden; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 700; color: #94a3b8; transition: border-color .15s;
        }
        .av-circ:hover { border-color: #0f172a; }
        .av-circ img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }

        .btn-ph {
            font-size: 11px; font-weight: 500; padding: 4px 11px;
            border-radius: 8px; border: 1px solid #e2e8f0;
            background: #fff; cursor: pointer; display: block; margin-bottom: 4px; transition: all .15s;
        }
        .btn-ph:hover { border-color: #0f172a; }

        .flabel { font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 4px; display: block; }
        .finput {
            width: 100%; background: #fff; border: 1px solid #e2e8f0;
            border-radius: 10px; padding: 8px 11px; font-size: 13px; font-weight: 500;
            color: #0f172a; outline: none; transition: all .15s; margin-bottom: 7px;
            font-family: 'Outfit', sans-serif;
        }
        .finput::placeholder { color: #cbd5e1; font-weight: 400; }
        .finput:focus { border-color: #0f172a; box-shadow: 0 0 0 3px rgba(15,23,42,.05); }

        .fselect {
            width: 100%; background: #fff; border: 1px solid #e2e8f0;
            border-radius: 10px; padding: 8px 11px; font-size: 13px; font-weight: 500;
            color: #0f172a; outline: none; margin-bottom: 7px;
            font-family: 'Outfit', sans-serif; cursor: pointer;
        }
        .faction { display: flex; gap: 6px; margin-top: 4px; }

        .btn-save {
            flex: 1; padding: 9px; border-radius: 10px;
            background: #0f172a; color: #fff; border: none;
            font-size: 12px; font-weight: 700; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 5px;
            transition: opacity .15s; font-family: 'Outfit', sans-serif;
        }
        .btn-save:hover { opacity: .85; }
        .btn-save.loading { opacity: .45; pointer-events: none; }

        .btn-cancel {
            padding: 9px 14px; border-radius: 10px;
            border: 1px solid #e2e8f0; background: #fff;
            font-size: 12px; color: #64748b; cursor: pointer;
            transition: all .15s; font-family: 'Outfit', sans-serif;
        }
        .btn-cancel:hover { border-color: #0f172a; color: #0f172a; }

        /* ── RIGHT / PREVIEW ── */
        .rp {
            background: #fff; border: 1px solid #f1f5f9;
            border-radius: 20px; padding: 28px 20px; min-height: 520px;
        }
        .rp-lbl { font-size: 10px; font-weight: 700; color: #e2e8f0; text-transform: uppercase; letter-spacing: .1em; text-align: center; margin-bottom: 28px; }

        .org-tree { display: flex; flex-direction: column; align-items: center; gap: 0; }
        .org-conn { width: 1px; height: 28px; background: #e2e8f0; }
        .org-lv-wrap { width: 100%; margin-bottom: 0; }
        .org-lv-lbl { font-size: 10px; font-weight: 700; color: #e2e8f0; text-transform: uppercase; letter-spacing: .1em; text-align: center; margin-bottom: 10px; }
        .org-row { display: flex; justify-content: center; gap: 10px; flex-wrap: wrap; min-height: 20px; }
        .org-empty { font-size: 11px; color: #e2e8f0; font-style: italic; text-align: center; padding: 16px 0; width: 100%; }

        .ncard {
            width: 112px; border-radius: 18px; border: 1px solid #f1f5f9;
            background: #fff; padding: 14px 8px 11px; text-align: center;
            cursor: pointer; transition: all .2s; position: relative;
        }
        .ncard:hover { border-color: #0f172a; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,.07); }
        .ncard.lv1 { background: #0f172a; border-color: #0f172a; }
        .ncard.editing { border-color: #3b82f6 !important; border-width: 1.5px; box-shadow: 0 0 0 3px rgba(59,130,246,.12) !important; transform: none !important; }
        .ncard.isnew-c { border-style: dashed; border-color: #93c5fd; }

        .ncard-badge { position: absolute; top: -6px; right: -6px; font-size: 9px; font-weight: 700; padding: 2px 6px; background: #3b82f6; color: #fff; border-radius: 6px; }

        .nav {
            width: 42px; height: 42px; border-radius: 50%; background: #f1f5f9;
            border: 1px solid #e2e8f0; margin: 0 auto 9px; overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; color: #64748b;
        }
        .nav img { width: 100%; height: 100%; object-fit: cover; }
        .ncard.lv1 .nav { background: rgba(255,255,255,.1); border-color: rgba(255,255,255,.12); color: #fff; }

        .nname { font-size: 11px; font-weight: 700; color: #0f172a; line-height: 1.3; margin-bottom: 3px; }
        .ncard.lv1 .nname { color: #fff; }
        .nrole { font-size: 10px; color: #94a3b8; text-transform: uppercase; letter-spacing: .04em; line-height: 1.2; }
        .ncard.lv1 .nrole { color: rgba(255,255,255,.4); }
        .nempty { font-size: 10px; color: #e2e8f0; margin-top: 4px; font-style: italic; }

        /* ── BOTTOM SHEET (mobile edit form) ── */
        .bs-overlay {
            display: none;
            position: fixed; inset: 0; background: rgba(0,0,0,.45);
            z-index: 100; align-items: flex-end;
        }
        .bs-overlay.open { display: flex; }
        .bs-sheet {
            width: 100%; background: #fff;
            border-radius: 20px 20px 0 0;
            padding: 0 0 env(safe-area-inset-bottom, 16px);
            max-height: 92vh; overflow-y: auto;
            animation: slideUp .25s cubic-bezier(.4,0,.2,1);
        }
        @keyframes slideUp {
            from { transform: translateY(100%); }
            to { transform: translateY(0); }
        }
        .bs-handle {
            width: 36px; height: 4px; background: #e2e8f0;
            border-radius: 99px; margin: 12px auto 0;
        }
        .bs-head {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px 12px;
            border-bottom: 1px solid #f1f5f9;
        }
        .bs-head h3 { font-size: 15px; font-weight: 700; color: #0f172a; margin: 0; }
        .bs-close {
            width: 32px; height: 32px; border-radius: 50%;
            background: #f1f5f9; border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; color: #64748b; line-height: 1;
        }
        .bs-body { padding: 16px 20px 24px; }

        /* ── TOAST ── */
        .toast {
            position: fixed; bottom: 28px; left: 50%;
            transform: translateX(-50%) translateY(10px);
            background: #0f172a; color: #fff;
            padding: 10px 22px; border-radius: 999px;
            font-size: 13px; font-weight: 500;
            opacity: 0; pointer-events: none;
            transition: all .3s cubic-bezier(.4,0,.2,1);
            z-index: 200; white-space: nowrap;
        }
        .toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }

        /* ── KEYFRAMES ── */
        @@keyframes pulse-in {
            0%, 100% { box-shadow: 0 0 0 0 rgba(59,130,246,0) }
            50% { box-shadow: 0 0 0 5px rgba(59,130,246,.18) }
        }
        .ncard.isnew-c { animation: pulse-in 1.4s ease 3; }

        @@keyframes flash-green {
            0% { box-shadow: 0 0 0 0 rgba(16,185,129,0) }
            35% { box-shadow: 0 0 0 5px rgba(16,185,129,.25) }
            100% { box-shadow: 0 0 0 0 rgba(16,185,129,0) }
        }
        .saved { animation: flash-green .8s ease forwards; }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .page-wrap { padding: 16px 12px 80px; }
            .mob-tabs { display: flex; }
            .two-col { grid-template-columns: 1fr; gap: 0; }

            .lp {
                border-radius: 16px; position: static;
                display: none;
            }
            .lp.mob-active { display: block; }
            .lp-body { max-height: none; overflow-y: visible; }

            .rp {
                border-radius: 16px; padding: 20px 14px;
                min-height: 300px; display: none;
            }
            .rp.mob-active { display: block; }

            /* hide inline form on mobile — use bottom sheet instead */
            .iform { display: none !important; }

            .ncard { width: 90px; padding: 10px 6px 8px; }
            .nav { width: 36px; height: 36px; font-size: 11px; }
            .nname { font-size: 10px; }
            .nrole { font-size: 9px; }

            .org-conn { height: 18px; }
        }
    </style>

    <div class="page-wrap">
        <div class="inner">

            {{-- Mobile Tab Switch --}}
            <div class="mob-tabs">
                <button class="mob-tab active" onclick="switchTab('list')">Kelola Anggota</button>
                <button class="mob-tab" onclick="switchTab('preview')">Preview Bagan</button>
            </div>

            <div class="two-col">

                {{-- ══ PANEL KIRI ══ --}}
                <div class="lp mob-active" id="panel-list">
                    <div class="lp-head">
                        <h3>Kelola Anggota</h3>
                        <p>Klik baris untuk edit · Preview bagan update otomatis</p>
                    </div>
                    <div class="lp-body">
                        @php
                            $levelLabels = [1 => 'Pimpinan Utama', 2 => 'Sekretariat', 3 => 'Bidang / Divisi'];
                            $byLevel = [];
                            foreach ([1, 2, 3] as $lv) {
                                $byLevel[$lv] = $strukturs->where('peran_level', $lv)->sortBy('urutan')->values();
                            }
                        @endphp

                        @foreach ([1, 2, 3] as $lv)
                            <div class="lv-grp" id="lv-grp-{{ $lv }}">
                                <div class="lv-grp-head">
                                    <span class="lv-grp-label">{{ $levelLabels[$lv] }}</span>
                                    <button class="btn-add" onclick="addMember({{ $lv }})">+ Tambah</button>
                                </div>
                                <div id="mlist-{{ $lv }}">
                                    @forelse($byLevel[$lv] as $item)
                                        <div class="mrow" id="mrow-{{ $item->id }}" data-id="{{ $item->id }}"
                                            data-level="{{ $lv }}" onclick="startEdit('{{ $item->id }}')">
                                            <div class="mav" id="mav-{{ $item->id }}">
                                                @if ($item->image)
                                                    <img src="{{ asset('storage/' . $item->image) }}" alt="">
                                                @else
                                                    {{ strtoupper(substr($item->nama ?? $item->peran, 0, 1)) }}
                                                @endif
                                            </div>
                                            <div class="minfo">
                                                <div class="mname {{ empty($item->nama) ? 'dim' : '' }}" id="mname-{{ $item->id }}">
                                                    {{ $item->nama ?: 'Belum diisi...' }}
                                                </div>
                                                <div class="mrole" id="mrole-{{ $item->id }}">{{ $item->peran }}</div>
                                            </div>
                                            <div class="macts">
                                                <button class="btn-sm" onclick="event.stopPropagation();startEdit('{{ $item->id }}')">Edit</button>
                                                <button class="btn-sm del" onclick="event.stopPropagation();deleteMember('{{ $item->id }}')">Hapus</button>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="empty-state" id="empty-{{ $lv }}">Belum ada · klik + Tambah</div>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- ══ PANEL KANAN / PREVIEW ══ --}}
                <div class="rp" id="panel-preview">
                    <p class="rp-lbl">Preview Bagan — realtime</p>
                    @php
                        $lv1 = $strukturs->where('peran_level', 1)->sortBy('urutan');
                        $lv2 = $strukturs->where('peran_level', 2)->sortBy('urutan');
                        $lv3 = $strukturs->where('peran_level', 3)->sortBy('urutan');
                    @endphp
                    <div class="org-tree">

                        <div class="org-lv-wrap">
                            <div class="org-lv-lbl">Pimpinan Utama</div>
                            <div class="org-row" id="org-lv-1">
                                @forelse($lv1 as $item)
                                    <div class="ncard lv1" id="node-{{ $item->id }}" onclick="startEdit('{{ $item->id }}')">
                                        <div class="nav" id="nav-{{ $item->id }}">
                                            @if ($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="">
                                            @else
                                                {{ strtoupper(substr($item->nama ?? $item->peran, 0, 1)) }}
                                            @endif
                                        </div>
                                        <div class="nname" id="nname-{{ $item->id }}">{{ $item->nama ?: '—' }}</div>
                                        <div class="nrole" id="nrole-{{ $item->id }}">{{ $item->peran }}</div>
                                        @if (!$item->nama)<div class="nempty">Klik untuk isi</div>@endif
                                    </div>
                                @empty
                                    <div class="org-empty" id="org-empty-1">Belum ada data</div>
                                @endforelse
                            </div>
                        </div>

                        <div class="org-conn"></div>

                        <div class="org-lv-wrap">
                            <div class="org-lv-lbl">Sekretariat</div>
                            <div class="org-row" id="org-lv-2">
                                @forelse($lv2 as $item)
                                    <div class="ncard" id="node-{{ $item->id }}" onclick="startEdit('{{ $item->id }}')">
                                        <div class="nav" id="nav-{{ $item->id }}">
                                            @if ($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="">
                                            @else
                                                {{ strtoupper(substr($item->nama ?? $item->peran, 0, 1)) }}
                                            @endif
                                        </div>
                                        <div class="nname" id="nname-{{ $item->id }}">{{ $item->nama ?: '—' }}</div>
                                        <div class="nrole" id="nrole-{{ $item->id }}">{{ $item->peran }}</div>
                                        @if (!$item->nama)<div class="nempty">Klik untuk isi</div>@endif
                                    </div>
                                @empty
                                    <div class="org-empty" id="org-empty-2">Belum ada data</div>
                                @endforelse
                            </div>
                        </div>

                        <div class="org-conn"></div>

                        <div class="org-lv-wrap">
                            <div class="org-lv-lbl">Bidang / Divisi</div>
                            <div class="org-row" id="org-lv-3">
                                @forelse($lv3 as $item)
                                    <div class="ncard" id="node-{{ $item->id }}" onclick="startEdit('{{ $item->id }}')">
                                        <div class="nav" id="nav-{{ $item->id }}">
                                            @if ($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="">
                                            @else
                                                {{ strtoupper(substr($item->nama ?? $item->peran, 0, 1)) }}
                                            @endif
                                        </div>
                                        <div class="nname" id="nname-{{ $item->id }}">{{ $item->nama ?: '—' }}</div>
                                        <div class="nrole" id="nrole-{{ $item->id }}">{{ $item->peran }}</div>
                                        @if (!$item->nama)<div class="nempty">Klik untuk isi</div>@endif
                                    </div>
                                @empty
                                    <div class="org-empty" id="org-empty-3">Belum ada data</div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ══ BOTTOM SHEET (mobile form) ══ --}}
    <div class="bs-overlay" id="bs-overlay" onclick="handleOverlayClick(event)">
        <div class="bs-sheet" id="bs-sheet">
            <div class="bs-handle"></div>
            <div class="bs-head">
                <h3>Edit Anggota</h3>
                <button class="bs-close" onclick="closeForm(true)">×</button>
            </div>
            <div class="bs-body" id="bs-body">
                {{-- form injected here on mobile --}}
            </div>
        </div>
    </div>

    <div class="toast" id="toast"></div>
    <input type="file" id="av-file" accept="image/*" style="display:none">

    <script>
        const CSRF = '{{ csrf_token() }}';
        let activeId = null;
        let newCount = 0;
        let pendingFile = null;
        let pendingSrc = null;
        const isMobile = () => window.innerWidth <= 768;

        const LV_CLASS = { '1': 'lv1', '2': '', '3': '' };

        // ── TAB SWITCH (mobile) ────────────────────
        function switchTab(tab) {
            document.querySelectorAll('.mob-tab').forEach(b => b.classList.remove('active'));
            event.target.classList.add('active');
            document.getElementById('panel-list').classList.toggle('mob-active', tab === 'list');
            document.getElementById('panel-preview').classList.toggle('mob-active', tab === 'preview');
        }

        // ── EDIT ──────────────────────────────────
        function startEdit(id) {
            if (activeId == id && !isMobile()) return;
            closeForm(false);
            activeId = id;
            pendingFile = null;
            pendingSrc = null;
            setHL(id, true);

            if (String(id).startsWith('new-')) {
                const row = document.getElementById(`mrow-${id}`);
                openForm(id, '', row?.dataset.peran || '', null, row?.dataset.level);
            } else {
                fetch(`/admin/struktur-organisasi/${id}`)
                    .then(r => r.json())
                    .then(d => openForm(id, d.nama || '', d.peran || '', d.image ? `/storage/${d.image}` : null, d.peran_level))
                    .catch(() => {
                        const nama = document.getElementById(`mname-${id}`)?.textContent.trim();
                        const peran = document.getElementById(`mrole-${id}`)?.textContent.trim();
                        openForm(id, nama === 'Belum diisi...' ? '' : nama || '', peran || '', null, null);
                    });
            }
        }

        function buildFormHTML(id, nama, peran, imgSrc, level) {
            const avHtml = (pendingSrc || imgSrc)
                ? `<img src="${pendingSrc||imgSrc}" alt="">`
                : `<span>${(nama||peran||'?')[0].toUpperCase()}</span>`;

            return `
            <div class="av-row">
                <div class="av-circ" id="av-pr-${id}" onclick="pickPhoto('${id}')">${avHtml}</div>
                <div>
                    <button class="btn-ph" onclick="pickPhoto('${id}')">Ganti Foto</button>
                    ${(pendingSrc||imgSrc)?`<button class="btn-ph" onclick="clearPhoto('${id}')">Hapus Foto</button>`:''}
                </div>
            </div>
            <label class="flabel">Nama Lengkap</label>
            <input class="finput" id="fin-nama-${id}" value="${esc(nama)}" placeholder="Masukkan nama lengkap..." oninput="liveUp('${id}')">
            <label class="flabel">Jabatan / Peran</label>
            <input class="finput" id="fin-peran-${id}" value="${esc(peran)}" placeholder="Contoh: Ketua, Sekretaris...">
            <label class="flabel">Level</label>
            <select class="fselect" id="fin-level-${id}">
                <option value="1" ${level==1?'selected':''}>Level 1 — Pimpinan Utama</option>
                <option value="2" ${level==2?'selected':''}>Level 2 — Sekretariat</option>
                <option value="3" ${level==3?'selected':''}>Level 3 — Bidang / Divisi</option>
            </select>
            <div class="faction">
                <button class="btn-cancel" onclick="closeForm(true)">Batal</button>
                <button class="btn-save" id="sbtn-${id}" onclick="saveEdit('${id}')">
                    <svg style="width:12px;height:12px" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                    Simpan
                </button>
            </div>`;
        }

        function openForm(id, nama, peran, imgSrc, level) {
            const row = document.getElementById(`mrow-${id}`);
            if (!row) return;

            if (isMobile()) {
                // Bottom sheet on mobile
                document.getElementById('bs-body').innerHTML = buildFormHTML(id, nama, peran, imgSrc, level);
                document.getElementById('bs-overlay').classList.add('open');
                setTimeout(() => document.getElementById(`fin-nama-${id}`)?.focus(), 80);
            } else {
                // Inline form on desktop
                document.getElementById(`iform-${id}`)?.remove();
                const f = document.createElement('div');
                f.className = 'iform';
                f.id = `iform-${id}`;
                f.innerHTML = `<div class="iform-ttl">Edit Anggota</div>` + buildFormHTML(id, nama, peran, imgSrc, level);
                row.after(f);
                document.getElementById(`fin-nama-${id}`)?.focus();
            }
        }

        function closeForm(rmNew) {
            if (activeId === null) return;
            document.getElementById(`iform-${activeId}`)?.remove();
            document.getElementById('bs-overlay').classList.remove('open');
            document.getElementById('bs-body').innerHTML = '';
            if (rmNew) {
                const row = document.getElementById(`mrow-${activeId}`);
                const node = document.getElementById(`node-${activeId}`);
                if (row?.classList.contains('isnew')) row.remove();
                if (node?.classList.contains('isnew-c')) node.remove();
            }
            setHL(activeId, false);
            activeId = null;
            pendingFile = null;
            pendingSrc = null;
        }

        function handleOverlayClick(e) {
            if (e.target === document.getElementById('bs-overlay')) closeForm(true);
        }

        function setHL(id, on) {
            document.getElementById(`mrow-${id}`)?.classList.toggle('active', on);
            const node = document.getElementById(`node-${id}`);
            if (node) node.classList.toggle('editing', on);
            if (on && !isMobile()) node?.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        // ── LIVE UPDATE ────────────────────────────
        function liveUp(id) {
            const nama = document.getElementById(`fin-nama-${id}`)?.value || '';
            const peran = document.getElementById(`fin-peran-${id}`)?.value || '';
            const nn = document.getElementById(`nname-${id}`);
            if (nn) nn.textContent = nama || '—';
            const nr = document.getElementById(`nrole-${id}`);
            if (nr) nr.textContent = peran;
            const na = document.getElementById(`nav-${id}`);
            if (na && !pendingSrc && !na.querySelector('img')) na.textContent = (nama || peran || '?')[0].toUpperCase();
            const mn = document.getElementById(`mname-${id}`);
            if (mn) { mn.textContent = nama || 'Belum diisi...'; mn.classList.toggle('dim', !nama); }
            const mr = document.getElementById(`mrole-${id}`);
            if (mr) mr.textContent = peran;
            countUp();
        }

        // ── SAVE ───────────────────────────────────
        function saveEdit(id) {
            const btn = document.getElementById(`sbtn-${id}`);
            const nama = document.getElementById(`fin-nama-${id}`)?.value.trim() || '';
            const peran = document.getElementById(`fin-peran-${id}`)?.value.trim() || '';
            const level = document.getElementById(`fin-level-${id}`)?.value;
            const row = document.getElementById(`mrow-${id}`);
            const isNew = row?.classList.contains('isnew');

            if (btn) { btn.classList.add('loading'); btn.innerHTML = 'Menyimpan...'; }

            const fd = new FormData();
            fd.append('_token', CSRF);
            fd.append('nama', nama);
            fd.append('peran', peran);
            if (level) fd.append('peran_level', level);
            if (pendingFile) fd.append('image', pendingFile);
            if (!isNew) fd.append('_method', 'PUT');

            fetch(isNew ? `/admin/struktur-organisasi` : `/admin/struktur-organisasi/${id}`, {
                method: 'POST',
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
                body: fd
            })
            .then(r => r.json())
            .then(data => {
                if (!data.success) throw new Error();
                const rid = data.id || id;

                if (isNew && data.id) {
                    ['mrow','mav','mname','mrole','node','nav','nname','nrole','iform'].forEach(p => {
                        const el = document.getElementById(`${p}-${id}`);
                        if (el) el.id = `${p}-${data.id}`;
                    });
                    document.getElementById(`mrow-${data.id}`)?.setAttribute('onclick', `startEdit('${data.id}')`);
                    document.getElementById(`node-${data.id}`)?.setAttribute('onclick', `startEdit('${data.id}')`);
                    activeId = data.id;
                }

                const node = document.getElementById(`node-${rid}`);
                if (node && level) {
                    const targetRow = document.getElementById(`org-lv-${level}`);
                    if (targetRow && !targetRow.contains(node)) targetRow.appendChild(node);
                    node.classList.toggle('lv1', level === '1' || level === 1);
                }

                row?.classList.remove('isnew');
                node?.classList.remove('isnew-c');

                if (pendingSrc) {
                    [`nav-${rid}`, `mav-${rid}`].forEach(eid => {
                        const el = document.getElementById(eid);
                        if (el) el.innerHTML = `<img src="${pendingSrc}" alt="">`;
                    });
                }

                if (node) { node.classList.add('saved'); setTimeout(() => node.classList.remove('saved'), 900); }
                if (level) removeEmptyState(level);

                document.getElementById(`iform-${rid}`)?.remove();
                document.getElementById('bs-overlay').classList.remove('open');
                document.getElementById('bs-body').innerHTML = '';
                setHL(rid, false);
                activeId = null; pendingFile = null; pendingSrc = null;
                countUp();
                toast('✓ ' + (data.message || 'Berhasil disimpan'));
            })
            .catch(() => {
                if (btn) {
                    btn.classList.remove('loading');
                    btn.innerHTML = '<svg style="width:12px;height:12px" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg> Simpan';
                }
                toast('Gagal menyimpan, coba lagi');
            });
        }

        // ── ADD ────────────────────────────────────
        function addMember(level) {
            closeForm(true);
            const tid = `new-${++newCount}`;
            const defPeran = ['','Ketua','Anggota','Bidang Baru'][level] || 'Anggota';

            const mlist = document.getElementById(`mlist-${level}`);
            removeEmptyState(level);
            const row = document.createElement('div');
            row.className = 'mrow isnew';
            row.id = `mrow-${tid}`;
            row.dataset.level = level;
            row.dataset.peran = defPeran;
            row.setAttribute('onclick', `startEdit('${tid}')`);
            row.innerHTML = `
            <div class="mav" id="mav-${tid}">+</div>
            <div class="minfo">
                <div class="mname dim" id="mname-${tid}">Anggota baru...</div>
                <div class="mrole" id="mrole-${tid}">${defPeran}</div>
            </div>
            <span class="nbadge">Baru</span>`;
            mlist.appendChild(row);

            const orgRow = document.getElementById(`org-lv-${level}`);
            removeEmptyState(level);
            const node = document.createElement('div');
            node.className = `ncard isnew-c${level==='1'||level==1?' lv1':''}`;
            node.id = `node-${tid}`;
            node.setAttribute('onclick', `startEdit('${tid}')`);
            node.innerHTML = `
            <div class="ncard-badge">Baru</div>
            <div class="nav" id="nav-${tid}">+</div>
            <div class="nname" id="nname-${tid}">—</div>
            <div class="nrole" id="nrole-${tid}">${defPeran}</div>
            <div class="nempty">Isi di panel kiri</div>`;
            orgRow.appendChild(node);

            row.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            activeId = tid;
            row.classList.add('active');
            node.classList.add('editing');
            openForm(tid, '', defPeran, null, level);
        }

        // ── DELETE ─────────────────────────────────
        function deleteMember(id) {
            if (!confirm('Hapus anggota ini?')) return;
            if (activeId == id) closeForm(false);

            fetch(`/admin/struktur-organisasi/${id}`, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json' }
            })
            .then(r => r.json())
            .then(data => {
                if (!data.success) throw new Error(data.message || 'Gagal');
                const row = document.getElementById(`mrow-${id}`);
                const node = document.getElementById(`node-${id}`);
                const level = row?.dataset.level;
                row?.remove();
                document.getElementById(`iform-${id}`)?.remove();
                node?.remove();
                if (level) checkEmptyState(level);
                countUp();
                toast('✓ ' + (data.message || 'Anggota berhasil dihapus'));
            })
            .catch(() => toast('✗ Gagal menghapus anggota'));
        }

        // ── FOTO ───────────────────────────────────
        function pickPhoto(id) {
            const inp = document.getElementById('av-file');
            inp._id = id;
            inp.click();
        }
        document.getElementById('av-file').addEventListener('change', function() {
            const file = this.files?.[0];
            if (!file) return;
            pendingFile = file;
            const r = new FileReader();
            r.onload = e => {
                pendingSrc = e.target.result;
                const id = this._id;
                [`av-pr-${id}`, `nav-${id}`, `mav-${id}`].forEach(eid => {
                    const el = document.getElementById(eid);
                    if (el) el.innerHTML = `<img src="${pendingSrc}" alt="">`;
                });
            };
            r.readAsDataURL(file);
            this.value = '';
        });

        function clearPhoto(id) {
            pendingFile = null; pendingSrc = null;
            const init = (document.getElementById(`fin-nama-${id}`)?.value || '?')[0].toUpperCase();
            [`av-pr-${id}`, `nav-${id}`, `mav-${id}`].forEach(eid => {
                const el = document.getElementById(eid);
                if (el) el.innerHTML = `<span>${init}</span>`;
            });
        }

        // ── EMPTY STATE HELPERS ────────────────────
        function removeEmptyState(level) {
            document.getElementById(`empty-${level}`)?.remove();
            document.getElementById(`org-empty-${level}`)?.remove();
        }

        function checkEmptyState(level) {
            const mlist = document.getElementById(`mlist-${level}`);
            if (mlist && !mlist.querySelector('.mrow')) {
                const d = document.createElement('div');
                d.className = 'empty-state'; d.id = `empty-${level}`;
                d.textContent = 'Belum ada · klik + Tambah';
                mlist.appendChild(d);
            }
            const orgRow = document.getElementById(`org-lv-${level}`);
            if (orgRow && !orgRow.querySelector('.ncard')) {
                const d = document.createElement('div');
                d.className = 'org-empty'; d.id = `org-empty-${level}`;
                d.textContent = 'Belum ada data';
                orgRow.appendChild(d);
            }
        }

        // ── UTILS ──────────────────────────────────
        function countUp() {
            const n = document.querySelectorAll('.mname:not(.dim)').length;
            const el = document.getElementById('total-count');
            if (el) el.textContent = n;
        }

        function toast(msg) {
            const t = document.getElementById('toast');
            t.textContent = msg; t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 2800);
        }

        function esc(s) {
            return (s||'').replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
        }

        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeForm(true); });
    </script>

</x-app-layout>
