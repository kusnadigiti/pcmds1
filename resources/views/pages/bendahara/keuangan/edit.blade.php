<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-medium mb-0.5">Keuangan</p>
                <h2 class="text-xl font-bold text-gray-900" style="font-family:'DM Sans',sans-serif">Edit Laporan</h2>
            </div>
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
        .card-field.focused .icon-svg   { color: #fff !important; }
        .field-input { outline: none; background: transparent; width: 100%; resize: none; }
        .field-input::placeholder { color: #a0a0a0; }
        @keyframes slideUp {
            from { opacity:0; transform:translateY(16px) }
            to   { opacity:1; transform:translateY(0) }
        }
        .au { animation: slideUp .45s cubic-bezier(.4,0,.2,1) both; }
        .d1 { animation-delay: .05s; }
        .d2 { animation-delay: .10s; }
        .d3 { animation-delay: .15s; }
        .d4 { animation-delay: .20s; }
        .d5 { animation-delay: .25s; }
        .preview-panel { position: sticky; top: 2rem; }
    </style>

    <div class="min-h-screen bg-[#FAFAFA] dm py-10 px-4">
        <div class="max-w-7xl mx-auto">

            {{-- Completion Bar --}}
            <div class="flex items-center justify-between mb-8">
                <p class="text-sm text-gray-500">Edit data laporan lalu simpan.</p>
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

                    <form action="{{ route('bendahara.keuangan.update', $finance->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">

                            {{-- JUDUL --}}
                            <div class="card-field au d1 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Judul Laporan</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <input type="text" name="judul"
                                            value="{{ old('judul', $finance->judul) }}"
                                            placeholder="Masukkan judul laporan keuangan..."
                                            class="field-input text-base font-medium text-gray-900 border-none py-1"
                                            oninput="sync('preview-judul', this.value, 'Judul Laporan')"/>
                                        @error('judul')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- DESKRIPSI --}}
                            <div class="card-field au d2 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M4 6h16M4 12h16M4 18h12"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Deskripsi</label>
                                            <span class="text-xs text-gray-400 font-medium italic">Opsional</span>
                                        </div>
                                        <textarea name="deskripsi" rows="4"
                                            placeholder="Keterangan singkat mengenai laporan ini..."
                                            class="field-input text-base text-gray-900 border-none py-1"
                                            oninput="sync('preview-deskripsi', this.value, 'Deskripsi laporan akan tampil di sini...')">{{ old('deskripsi', $finance->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- KATEGORI --}}
                            <div class="card-field au d3 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Kategori</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Dipilih</span>
                                        </div>

                                        <input type="hidden" name="kategori" id="kategori-input" value="{{ old('kategori', $finance->kategori) }}">

                                        <div id="kategoriBtn"
                                            class="mt-2 flex items-center justify-between px-3 py-2 border rounded-xl cursor-pointer hover:border-black transition">
                                            <div class="flex items-center gap-2">
                                                <span id="kategori-dot" class="w-2 h-2 rounded-full bg-gray-300"></span>
                                                <span id="kategori-label" class="text-sm text-gray-400">-- Pilih Kategori --</span>
                                            </div>
                                            <svg id="kategori-arrow" class="w-4 h-4 text-gray-400 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M6 9l6 6 6-6"/>
                                            </svg>
                                        </div>

                                        <div id="kategori-dropdown" class="hidden mt-2 border rounded-xl overflow-hidden bg-white shadow-lg z-10">
                                            <div class="kategori-opt px-3 py-2.5 flex items-center gap-2 hover:bg-gray-50 cursor-pointer"
                                                data-value="pemasukan" data-label="Pemasukan" data-dot="bg-emerald-500">
                                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                                <span class="text-sm font-medium">Pemasukan</span>
                                            </div>
                                            <div class="kategori-opt px-3 py-2.5 flex items-center gap-2 hover:bg-gray-50 cursor-pointer"
                                                data-value="pengeluaran" data-label="Pengeluaran" data-dot="bg-red-500">
                                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                                <span class="text-sm font-medium">Pengeluaran</span>
                                            </div>
                                        </div>

                                        @error('kategori')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- TANGGAL LAPORAN --}}
                            <div class="card-field au d4 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                            <line x1="16" y1="2" x2="16" y2="6"/>
                                            <line x1="8" y1="2" x2="8" y2="6"/>
                                            <line x1="3" y1="10" x2="21" y2="10"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Tanggal Laporan</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <input type="date" name="tanggal_laporan"
                                            value="{{ old('tanggal_laporan', \Carbon\Carbon::parse($finance->tanggal_laporan)->format('Y-m-d')) }}"
                                            class="field-input text-base text-gray-900 border-none py-1"
                                            oninput="syncTanggal(this.value)"/>
                                        @error('tanggal_laporan')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- FILE PDF --}}
                            <div class="au d5">
                                <div class="flex items-center justify-between mb-2 px-1">
                                    <label class="text-sm font-semibold text-gray-700">File PDF</label>
                                    <span class="text-xs text-gray-400">Opsional · Maks 5MB · Kosongkan jika tidak ingin mengganti</span>
                                </div>

                                {{-- File lama --}}
                                @if ($finance->file)
                                    <div class="mb-3 flex items-center gap-3 bg-white border border-gray-200 rounded-2xl px-4 py-3">
                                        <div class="w-10 h-10 rounded-lg bg-red-50 border border-red-100 flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                <path d="M13 3v5a1 1 0 001 1h5"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-400 mb-0.5">File saat ini</p>
                                            <p class="text-sm font-semibold text-gray-700 truncate">{{ basename($finance->file) }}</p>
                                        </div>
                                        <a href="{{ asset('storage/' . $finance->file) }}" target="_blank"
                                            class="shrink-0 text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg hover:bg-blue-100 transition">
                                            Lihat
                                        </a>
                                    </div>
                                @endif

                                <label for="file-input" id="upload-zone"
                                    class="flex flex-col items-center justify-center text-center cursor-pointer border-2 border-dashed border-gray-300 rounded-2xl bg-gray-50 py-10 px-6 transition-all duration-300 hover:border-black hover:bg-white hover:-translate-y-0.5">

                                    <div id="file-placeholder">
                                        <div class="w-14 h-14 rounded-2xl bg-white border border-gray-200 flex items-center justify-center mb-3 mx-auto">
                                            <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                <path d="M13 3v5a1 1 0 001 1h5"/>
                                            </svg>
                                        </div>
                                        <p class="font-semibold text-gray-900 text-sm mb-0.5">Ganti dengan file PDF baru</p>
                                        <p class="text-xs text-gray-500">PDF · Maks 5MB</p>
                                    </div>

                                    <div id="file-selected" class="hidden w-full">
                                        <div class="flex items-center gap-3 bg-white border border-gray-200 rounded-xl px-4 py-3">
                                            <div class="w-10 h-10 rounded-lg bg-red-50 border border-red-100 flex items-center justify-center shrink-0">
                                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                    <path d="M13 3v5a1 1 0 001 1h5"/>
                                                </svg>
                                            </div>
                                            <div class="text-left min-w-0">
                                                <p id="file-name" class="text-sm font-semibold text-gray-800 truncate">—</p>
                                                <p id="file-size" class="text-xs text-gray-400">—</p>
                                            </div>
                                            <div class="ml-auto shrink-0">
                                                <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">✓ Terpilih</span>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <input type="file" name="file" id="file-input" accept=".pdf"
                                    class="hidden" onchange="handleFile(this)"/>
                                @error('file')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        {{-- Footer --}}
                        <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-between">
                            <span id="footer-status" class="text-sm text-gray-500">Periksa kembali data laporan</span>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('bendahara.keuangan.index') }}"
                                    class="text-sm px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 transition font-medium">Batal</a>
                                <button type="submit"
                                    class="flex items-center gap-2 text-sm px-6 py-2.5 rounded-xl bg-black text-white font-semibold hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/20 transition-all duration-300 active:scale-95">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Simpan Perubahan
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
                        <div class="p-6 space-y-4">

                            <div class="flex items-center justify-between">
                                <span id="preview-kategori-badge"
                                    class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full bg-gray-100 text-gray-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                                    Kategori
                                </span>
                                <span id="preview-tanggal" class="text-xs text-gray-400 font-medium">—</span>
                            </div>

                            <div>
                                <p class="text-xs text-gray-400 font-medium mb-1">Judul Laporan</p>
                                <h3 id="preview-judul" class="text-lg font-semibold text-gray-900 leading-snug">{{ $finance->judul }}</h3>
                            </div>

                            <div>
                                <p class="text-xs text-gray-400 font-medium mb-1">Deskripsi</p>
                                <p id="preview-deskripsi" class="text-sm text-gray-500 line-clamp-3">{{ $finance->deskripsi ?: 'Deskripsi laporan akan tampil di sini...' }}</p>
                            </div>

                            <div class="border-t border-gray-100 pt-4 space-y-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                                            <circle cx="12" cy="7" r="4"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">Penginput</p>
                                        <p class="text-sm font-medium text-gray-700">{{ $finance->user?->name ?? auth()->user()->name }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <div class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            <path d="M13 3v5a1 1 0 001 1h5"/>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-400">File PDF</p>
                                        <p id="preview-file" class="text-sm font-medium text-gray-700 truncate">
                                            {{ $finance->file ? basename($finance->file) : 'Belum dipilih' }}
                                        </p>
                                    </div>
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
        // ── Data awal dari server ──────────────────────────────────
        const initialData = {
            judul:    @json(old('judul', $finance->judul)),
            kategori: @json(old('kategori', $finance->kategori)),
            tanggal:  @json(old('tanggal_laporan', \Carbon\Carbon::parse($finance->tanggal_laporan)->format('Y-m-d'))),
        };

        // ── Generic sync ──────────────────────────────────────────
        function sync(id, val, placeholder) {
            const el = document.getElementById(id);
            if (!el) return;
            el.textContent = val.trim() || placeholder;
            updateCompletion();
        }

        // ── Tanggal sync ──────────────────────────────────────────
        function syncTanggal(val) {
            const el = document.getElementById('preview-tanggal');
            if (!val) { el.textContent = '—'; updateCompletion(); return; }
            const date = new Date(val + 'T00:00:00'); // hindari timezone shift
            el.textContent = date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            updateCompletion();
        }

        // ── Kategori ──────────────────────────────────────────────
        const kategoriColors = {
            pemasukan:   { badge: 'bg-emerald-100 text-emerald-700', dot: 'bg-emerald-500' },
            pengeluaran: { badge: 'bg-red-100 text-red-700',         dot: 'bg-red-500'     },
        };

        const kategoriBtn      = document.getElementById('kategoriBtn');
        const kategoriDropdown = document.getElementById('kategori-dropdown');
        const kategoriLabel    = document.getElementById('kategori-label');
        const kategoriDot      = document.getElementById('kategori-dot');
        const kategoriInput    = document.getElementById('kategori-input');
        const kategoriArrow    = document.getElementById('kategori-arrow');

        function applyKategori(value) {
            if (!value || !kategoriColors[value]) return;
            const opt   = document.querySelector(`.kategori-opt[data-value="${value}"]`);
            const label = opt?.dataset.label ?? value;
            const colors = kategoriColors[value];

            kategoriLabel.textContent = label;
            kategoriLabel.classList.remove('text-gray-400');
            kategoriLabel.classList.add('text-gray-900');
            kategoriDot.className = `w-2 h-2 rounded-full ${opt?.dataset.dot ?? ''}`;
            kategoriInput.value = value;

            const badge = document.getElementById('preview-kategori-badge');
            badge.className = `inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full ${colors.badge}`;
            badge.innerHTML = `<span class="w-1.5 h-1.5 rounded-full ${colors.dot}"></span> ${label}`;
        }

        kategoriBtn.addEventListener('click', () => {
            kategoriDropdown.classList.toggle('hidden');
            kategoriArrow.classList.toggle('rotate-180');
        });

        document.querySelectorAll('.kategori-opt').forEach(opt => {
            opt.addEventListener('click', () => {
                applyKategori(opt.dataset.value);
                kategoriDropdown.classList.add('hidden');
                kategoriArrow.classList.remove('rotate-180');
                updateCompletion();
            });
        });

        document.addEventListener('click', (e) => {
            if (!kategoriBtn.contains(e.target) && !kategoriDropdown.contains(e.target)) {
                kategoriDropdown.classList.add('hidden');
                kategoriArrow.classList.remove('rotate-180');
            }
        });

        // ── File handler ──────────────────────────────────────────
        function handleFile(input) {
            const file = input.files?.[0];
            if (!file) return;
            const sizeMB = (file.size / 1024 / 1024).toFixed(2);

            document.getElementById('file-placeholder').classList.add('hidden');
            document.getElementById('file-selected').classList.remove('hidden');
            document.getElementById('file-name').textContent = file.name;
            document.getElementById('file-size').textContent = sizeMB + ' MB';

            const previewFile = document.getElementById('preview-file');
            previewFile.textContent = file.name;
            previewFile.classList.remove('text-gray-400', 'italic');
            previewFile.classList.add('text-gray-700');

            updateCompletion();
        }

        // ── Focus states ──────────────────────────────────────────
        document.querySelectorAll('.field-input').forEach(input => {
            const card = input.closest('.card-field');
            if (!card) return;
            input.addEventListener('focus', () => card.classList.add('focused'));
            input.addEventListener('blur',  () => card.classList.remove('focused'));
        });

        // ── Completion ring ───────────────────────────────────────
        // Edit: file tidak wajib (sudah ada file lama), jadi 3 required field
        const CIRC = 50.27;

        function updateCompletion() {
            const checks = [
                !!document.querySelector('input[name="judul"]')?.value.trim(),
                !!document.getElementById('kategori-input')?.value,
                !!document.querySelector('input[name="tanggal_laporan"]')?.value,
            ];

            // filled-badge
            document.querySelectorAll('.card-field').forEach(card => {
                const input = card.querySelector('input[name="judul"], input[name="tanggal_laporan"]');
                const badge = card.querySelector('.filled-badge');
                if (!input || !badge) return;
                input.value.trim() ? badge.classList.remove('hidden') : badge.classList.add('hidden');
            });

            const katBadge = document.querySelector('#kategoriBtn')?.closest('.card-field')?.querySelector('.filled-badge');
            if (katBadge) {
                kategoriInput.value ? katBadge.classList.remove('hidden') : katBadge.classList.add('hidden');
            }

            const filled = checks.filter(Boolean).length;
            const total  = checks.length;
            const pct    = Math.round((filled / total) * 100);

            document.getElementById('completion-text').textContent = pct + '% Lengkap';
            document.getElementById('ring-progress').style.strokeDashoffset = CIRC * (1 - pct / 100);

            const rem = total - filled;
            document.getElementById('footer-status').innerHTML = rem === 0
                ? '<span class="text-green-600 font-semibold">✓ Siap disimpan!</span>'
                : rem + ' field yang perlu diisi';
        }

        document.querySelectorAll('.field-input').forEach(el => el.addEventListener('input', updateCompletion));

        // ── Init: hydrate semua state dari data server ────────────
        window.addEventListener('DOMContentLoaded', () => {
            // judul preview
            const judulEl = document.querySelector('input[name="judul"]');
            if (judulEl?.value) sync('preview-judul', judulEl.value, 'Judul Laporan');

            // tanggal preview
            syncTanggal(initialData.tanggal);

            // kategori
            applyKategori(initialData.kategori);

            updateCompletion();
        });
    </script>

</x-app-layout>
