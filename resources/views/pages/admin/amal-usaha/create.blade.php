<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-medium mb-0.5">Manajemen</p>
                <h2 class="text-xl font-bold text-gray-900" style="font-family:'DM Sans',sans-serif">Amal Usaha</h2>
            </div>
            <a href="{{ route('admin.amal-usaha.index') }}"
                class="flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900 transition font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        .dm { font-family: 'DM Sans', sans-serif; }

        .card-field { transition: all .3s cubic-bezier(.4,0,.2,1); }

        .card-field.focused {
            border-color: #000 !important;
            box-shadow: 0 0 0 3px rgba(0,0,0,.05), 0 8px 24px rgba(0,0,0,.06) !important;
        }
        .card-field.focused .icon-badge { background: #000 !important; }
        .card-field.focused .icon-svg  { color: #fff !important; }

        .field-input {
            outline: none;
            background: transparent;
            width: 100%;
            resize: none;
        }
        .field-input::placeholder { color: #a0a0a0; }

        @keyframes slideUp {
            from { opacity:0; transform:translateY(16px) }
            to   { opacity:1; transform:translateY(0) }
        }
        .au  { animation: slideUp .45s cubic-bezier(.4,0,.2,1) both; }
        .d1  { animation-delay:.05s; }
        .d2  { animation-delay:.10s; }
        .d3  { animation-delay:.15s; }
        .d4  { animation-delay:.20s; }
        .d5  { animation-delay:.25s; }
        .d6  { animation-delay:.30s; }

        .preview-panel { position: sticky; top: 2rem; }

        /* tipe pill */
        .tipe-pill { cursor:pointer; transition: all .2s; }
        .tipe-pill.active { background:#000; color:#fff; }
        .tipe-pill:not(.active) { background:#f3f4f6; color:#374151; }
        .tipe-pill:not(.active):hover { background:#e5e7eb; }
    </style>

    <div class="min-h-screen bg-[#FAFAFA] dm py-10 px-4">
        <div class="max-w-7xl mx-auto">

            {{-- Completion Bar --}}
            <div class="flex items-center justify-between mb-8">
                <p class="text-sm text-gray-500">Isi semua field lalu simpan.</p>
                <div class="flex items-center gap-3 bg-black text-white text-sm font-semibold px-4 py-2 rounded-full">
                    <svg class="w-5 h-5" viewBox="0 0 20 20">
                        <circle cx="10" cy="10" r="8" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="2"/>
                        <circle id="ring-progress" cx="10" cy="10" r="8" fill="none" stroke="white"
                            stroke-width="2" stroke-dasharray="50.27" stroke-dashoffset="50.27"
                            transform="rotate(-90 10 10)" stroke-linecap="round"
                            style="transition:stroke-dashoffset .4s ease"/>
                    </svg>
                    <span id="completion-text">0% Lengkap</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

                {{-- ===== LEFT: FORM ===== --}}
                <div>
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-2xl">
                            <div class="font-semibold mb-2">Terjadi kesalahan:</div>
                            <ul class="list-disc list-inside text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.amal-usaha.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4">

                            {{-- ORGANISASI ORTONOM --}}
                            <div class="card-field au d1 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M3 21V7l9-4 9 4v14"/>
                                            <path d="M9 21V12h6v9"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Organisasi Ortonom</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <select name="organisasi_otonom_id" id="select-orgs"
                                            class="field-input text-base text-gray-900 border-none py-1"
                                            onchange="syncOrg(this)">
                                            <option value="" disabled selected>Pilih organisasi ortonom...</option>
                                            @foreach($organisasiOtonoms as $org)
                                                <option value="{{ $org->id }}" {{ old('organisasi_otonom_id') == $org->id ? 'selected' : '' }}>
                                                    {{ $org->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('organisasi_otonom_id')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- NAMA --}}
                            <div class="card-field au d2 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Nama Amal Usaha</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <input type="text" name="nama" value="{{ old('nama') }}"
                                            placeholder="Masukkan nama amal usaha..."
                                            class="field-input text-base font-medium text-gray-900 border-none py-1"
                                            oninput="sync('preview-nama', this.value, 'Nama Amal Usaha')"/>
                                        @error('nama')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- DESKRIPSI --}}
                            <div class="card-field au d3 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M4 6h16M4 12h16M4 18h12"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Deskripsi</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <textarea name="deskripsi" rows="4" placeholder="Deskripsi singkat amal usaha..."
                                            class="field-input text-base text-gray-900 border-none py-1"
                                            oninput="sync('preview-deskripsi', this.value, 'Deskripsi akan tampil di sini...')">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- TIPE --}}
                            <div class="card-field au d4 bg-white border border-gray-200 rounded-2xl p-5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-3">
                                            <label class="text-sm font-semibold text-gray-700">Tipe Bidang</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <input type="hidden" name="tipe" id="tipe-input" value="{{ old('tipe', 'bidang_sosial') }}">
                                        <div class="flex flex-wrap gap-2">
                                            @php
                                                $tipes = [
                                                    'bidang_sosial'      => ['label' => 'Bidang Sosial',      'icon' => '🤝'],
                                                    'bidang_kesehatan'   => ['label' => 'Bidang Kesehatan',   'icon' => '🏥'],
                                                    'bidang_pendidikan'  => ['label' => 'Bidang Pendidikan',  'icon' => '🎓'],
                                                ];
                                            @endphp
                                            @foreach($tipes as $value => $meta)
                                                <button type="button"
                                                    class="tipe-pill text-sm font-semibold px-4 py-2 rounded-xl {{ old('tipe', 'bidang_sosial') === $value ? 'active' : '' }}"
                                                    data-value="{{ $value }}"
                                                    onclick="selectTipe(this, '{{ $meta['label'] }}')">
                                                    {{ $meta['icon'] }} {{ $meta['label'] }}
                                                </button>
                                            @endforeach
                                        </div>
                                        @error('tipe')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- FOTO --}}
                            <div class="au d5">
                                <div class="flex items-center justify-between mb-2 px-1">
                                    <label class="text-sm font-semibold text-gray-700">Foto</label>
                                    <span class="text-xs text-gray-400">Opsional</span>
                                </div>
                                <label for="foto-input" id="upload-zone"
                                    class="flex flex-col items-center justify-center text-center cursor-pointer border-2 border-dashed border-gray-300 rounded-2xl bg-gray-50 py-10 px-6 transition-all duration-300 hover:border-black hover:bg-white hover:-translate-y-0.5">
                                    <div id="upload-preview-wrap" class="hidden w-full mb-3 rounded-xl overflow-hidden aspect-video">
                                        <img id="upload-img-preview" src="" class="w-full h-full object-cover"/>
                                    </div>
                                    <div id="upload-placeholder">
                                        <div class="w-14 h-14 rounded-2xl bg-white border border-gray-200 flex items-center justify-center mb-3 mx-auto">
                                            <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <rect x="3" y="3" width="18" height="18" rx="3"/>
                                                <path d="M3 15l5-5 4 4 3-3 6 5"/>
                                                <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor" stroke="none"/>
                                            </svg>
                                        </div>
                                        <p class="font-semibold text-gray-900 text-sm mb-0.5">Upload foto amal usaha</p>
                                        <p class="text-xs text-gray-500">PNG, JPG, WEBP · Maks 2MB</p>
                                    </div>
                                </label>
                                <input type="file" name="foto" id="foto-input" accept="image/*" class="hidden" onchange="handleImage(this)"/>
                                @error('foto')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        {{-- Footer --}}
                        <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-between">
                            <span id="footer-status" class="text-sm text-gray-500">Isi field yang diperlukan</span>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.amal-usaha.index') }}"
                                    class="text-sm px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 transition font-medium">Batal</a>
                                <button type="submit"
                                    class="flex items-center gap-2 text-sm px-6 py-2.5 rounded-xl bg-black text-white font-semibold hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/20 transition-all duration-300 active:scale-95">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Simpan Amal Usaha
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- ===== RIGHT: LIVE PREVIEW ===== --}}
                <div class="preview-panel au d2">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Live Preview</p>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden shadow-sm">
                        <div class="grid grid-cols-12 lg:min-h-[220px]">

                            {{-- IMAGE --}}
                            <div class="col-span-12 lg:col-span-5 h-52 lg:h-full overflow-hidden relative bg-gradient-to-br from-neutral-100 to-neutral-200 flex items-center justify-center">
                                <img id="preview-img" src="" class="hidden w-full h-full object-cover absolute inset-0"/>
                                <div id="img-placeholder" class="flex flex-col items-center gap-2 text-neutral-300">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <rect x="3" y="3" width="18" height="18" rx="3"/>
                                        <path d="M3 15l5-5 4 4 3-3 6 5"/>
                                    </svg>
                                    <span class="text-xs font-medium">Foto</span>
                                </div>
                            </div>

                            {{-- CONTENT --}}
                            <div class="col-span-12 lg:col-span-7 p-6 flex flex-col justify-center space-y-3 min-w-0">

                                <div class="flex items-center gap-2 flex-wrap">
                                    <span id="preview-tipe-badge"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full bg-blue-100 text-blue-700">
                                        🤝 Bidang Sosial
                                    </span>
                                    <span id="preview-org-badge"
                                        class="inline-flex items-center text-xs font-medium px-2.5 py-1 rounded-full bg-gray-100 text-gray-600">
                                        Organisasi Ortonom
                                    </span>
                                </div>

                                <h3 id="preview-nama" class="text-xl font-medium text-neutral-900 leading-snug">
                                    Nama Amal Usaha
                                </h3>

                                <p id="preview-deskripsi" class="text-neutral-600 text-sm line-clamp-3 break-all">
                                    Deskripsi akan tampil di sini...
                                </p>

                                <div class="flex items-center gap-2 text-sm font-medium text-neutral-900 pt-1">
                                    Lihat Detail →
                                </div>

                            </div>
                        </div>
                    </div>

                    <p class="text-center text-xs text-gray-300 mt-3">Preview berubah real-time saat Anda mengetik</p>
                </div>

            </div>
        </div>
    </div>

    <script>
        // ── sync helpers ──────────────────────────────────────────────
        function sync(id, val, placeholder) {
            const el = document.getElementById(id);
            if (!el) return;
            el.textContent = val.trim() || placeholder;
            updateCompletion();
        }

        function syncOrg(select) {
            const text = select.options[select.selectedIndex]?.text || 'Organisasi Ortonom';
            document.getElementById('preview-org-badge').textContent = text;
            updateCompletion();
        }

        const TIPE_META = {
            bidang_sosial:     { label:'Bidang Sosial',     icon:'🤝', bg:'bg-blue-100',   text:'text-blue-700' },
            bidang_kesehatan:  { label:'Bidang Kesehatan',  icon:'🏥', bg:'bg-red-100',    text:'text-red-700'  },
            bidang_pendidikan: { label:'Bidang Pendidikan', icon:'🎓', bg:'bg-amber-100',  text:'text-amber-700'},
        };

        function selectTipe(btn, label) {
            document.querySelectorAll('.tipe-pill').forEach(p => p.classList.remove('active'));
            btn.classList.add('active');
            const value = btn.dataset.value;
            document.getElementById('tipe-input').value = value;
            // update preview badge
            const m = TIPE_META[value];
            const badge = document.getElementById('preview-tipe-badge');
            badge.className = `inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full ${m.bg} ${m.text}`;
            badge.textContent = `${m.icon} ${m.label}`;
            updateCompletion();
        }

        // ── image ────────────────────────────────────────────────────
        function handleImage(input) {
            const file = input.files?.[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const src = e.target.result;
                document.getElementById('upload-img-preview').src = src;
                document.getElementById('upload-preview-wrap').classList.remove('hidden');
                document.getElementById('upload-placeholder').classList.add('hidden');
                const img = document.getElementById('preview-img');
                img.src = src;
                img.classList.remove('hidden');
                document.getElementById('img-placeholder')?.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }

        // ── focus states ─────────────────────────────────────────────
        document.querySelectorAll('.field-input').forEach(input => {
            const card = input.closest('.card-field');
            if (!card) return;
            input.addEventListener('focus', () => card.classList.add('focused'));
            input.addEventListener('blur',  () => card.classList.remove('focused'));
        });

        // ── completion ring ──────────────────────────────────────────
        const CIRC = 50.27;

        function updateCompletion() {
            const cards = document.querySelectorAll('.card-field');
            let filled = 0;
            cards.forEach(card => {
                const input = card.querySelector('input:not([type=hidden]),textarea,select');
                const badge = card.querySelector('.filled-badge');
                if (!input || !badge) return;
                const ok = !!input.value.trim();
                badge.classList.toggle('hidden', !ok);
                if (ok) filled++;
            });
            const pct = Math.round((filled / cards.length) * 100);
            document.getElementById('completion-text').textContent = pct + '% Lengkap';
            document.getElementById('ring-progress').style.strokeDashoffset = CIRC * (1 - pct / 100);
            const rem = cards.length - filled;
            document.getElementById('footer-status').innerHTML = rem === 0
                ? '<span class="text-green-600 font-semibold">✓ Siap disimpan!</span>'
                : rem + ' field yang perlu diisi';
        }

        document.querySelectorAll('.field-input').forEach(el => el.addEventListener('input', updateCompletion));
        updateCompletion();

        // init preview tipe badge on load
        const initTipe = document.getElementById('tipe-input').value;
        if (initTipe && TIPE_META[initTipe]) {
            const m = TIPE_META[initTipe];
            const badge = document.getElementById('preview-tipe-badge');
            badge.className = `inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full ${m.bg} ${m.text}`;
            badge.textContent = `${m.icon} ${m.label}`;
        }
    </script>

</x-app-layout>
