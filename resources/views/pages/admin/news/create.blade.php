<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-medium mb-0.5">Manajemen</p>
                <h2 class="text-xl font-bold text-gray-900" style="font-family:'DM Sans',sans-serif">Berita</h2>
            </div>
        </div>
    </x-slot>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        .dm {
            font-family: 'DM Sans', sans-serif;
        }

        .card-field {
            transition: all .3s cubic-bezier(.4, 0, .2, 1);
        }

        .card-field.focused {
            border-color: #000 !important;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, .05), 0 8px 24px rgba(0, 0, 0, .06) !important;
        }

        .card-field.focused .icon-badge {
            background: #000 !important;
        }

        .card-field.focused .icon-svg {
            color: #fff !important;
        }

        .field-input {
            outline: none;
            background: transparent;
            width: 100%;
            resize: none;
        }

        .field-input::placeholder {
            color: #a0a0a0;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(16px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .au {
            animation: slideUp .45s cubic-bezier(.4, 0, .2, 1) both;
        }

        .d1 {
            animation-delay: .05s;
        }

        .d2 {
            animation-delay: .10s;
        }

        .d3 {
            animation-delay: .15s;
        }

        .d4 {
            animation-delay: .20s;
        }

        .d5 {
            animation-delay: .25s;
        }

        .preview-panel {
            position: sticky;
            top: 2rem;
        }
    </style>

    <div class="min-h-screen bg-[#FAFAFA] dm py-10 px-4">
        <div class="max-w-7xl mx-auto">

            {{-- Completion Bar --}}
            <div class="flex items-center justify-between mb-8">
                <p class="text-sm text-gray-500">Isi semua field lalu simpan.</p>
                <div class="flex items-center gap-3 bg-black text-white text-sm font-semibold px-4 py-2 rounded-full">
                    <svg class="w-5 h-5" viewBox="0 0 20 20">
                        <circle cx="10" cy="10" r="8" fill="none" stroke="rgba(255,255,255,0.3)"
                            stroke-width="2" />
                        <circle id="ring-progress" cx="10" cy="10" r="8" fill="none" stroke="white"
                            stroke-width="2" stroke-dasharray="50.27" stroke-dashoffset="50.27"
                            transform="rotate(-90 10 10)" stroke-linecap="round"
                            style="transition:stroke-dashoffset .4s ease" />
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

                    @php
                        $role = auth()->user()->role;
                        $prefix = $role === 'penulis' ? 'penulis' : 'admin';
                    @endphp

                    <form action="{{ route($prefix . '.berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4">

                            {{-- JUDUL --}}
                            <div
                                class="card-field au d1 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Judul Berita</label>
                                            <span
                                                class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓
                                                Diisi</span>
                                        </div>
                                        <input type="text" name="judul" value="{{ old('judul') }}"
                                            placeholder="Masukkan judul berita..."
                                            class="field-input text-base font-medium text-gray-900 border-none py-1"
                                            oninput="sync('preview-title', this.value, 'Judul Berita')" />
                                        @error('judul')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- ISI --}}
                            <div
                                class="card-field au d2 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M4 6h16M4 12h16M4 18h12" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Isi Berita</label>
                                            <span
                                                class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓
                                                Diisi</span>
                                        </div>
                                        <textarea name="isi" rows="5" placeholder="Isi berita..."
                                            class="field-input text-base text-gray-900 border-none py-1"
                                            oninput="sync('preview-content', this.value, 'Isi berita akan tampil di sini...')">{{ old('isi') }}</textarea>
                                        @error('isi')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- KATEGORI --}}
                            <div class="card-field au d3 bg-white border border-gray-200 rounded-2xl p-5">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M4 4h16v16H4zM7 7h10v10H7z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <label class="text-sm font-semibold text-gray-700">Kategori</label>
                                        <input type="hidden" name="kategori" id="kategori" value="dakwah">
                                        <div id="kategoriBtn"
                                            class="mt-2 flex items-center justify-between px-3 py-2 border rounded-xl cursor-pointer hover:border-black transition">
                                            <div class="flex items-center gap-2">
                                                <span id="kategori-dot"
                                                    class="w-2 h-2 rounded-full bg-amber-500"></span>
                                                <span id="kategori-label" class="text-sm font-medium">Dakwah</span>
                                            </div>
                                            <svg id="kategori-arrow" class="w-4 h-4 text-gray-400 transition"
                                                fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M6 9l6 6 6-6" />
                                            </svg>
                                        </div>
                                        <div id="kategoriDropdown"
                                            class="hidden mt-2 border rounded-xl overflow-hidden bg-white shadow-lg">
                                            <div class="kategori-option px-3 py-2 flex items-center gap-2 hover:bg-gray-50 cursor-pointer"
                                                data-value="dakwah" data-color="bg-amber-500" data-label="Dakwah">
                                                <span class="w-2 h-2 rounded-full bg-amber-500"></span><span
                                                    class="text-sm">Dakwah</span>
                                            </div>
                                            <div class="kategori-option px-3 py-2 flex items-center gap-2 hover:bg-gray-50 cursor-pointer"
                                                data-value="pendidikan" data-color="bg-emerald-500"
                                                data-label="Pendidikan">
                                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span><span
                                                    class="text-sm">Pendidikan</span>
                                            </div>
                                            <div class="kategori-option px-3 py-2 flex items-center gap-2 hover:bg-gray-50 cursor-pointer"
                                                data-value="sosial" data-color="bg-sky-500" data-label="Sosial">
                                                <span class="w-2 h-2 rounded-full bg-sky-500"></span><span
                                                    class="text-sm">Sosial</span>
                                            </div>
                                            <div class="kategori-option px-3 py-2 flex items-center gap-2 hover:bg-gray-50 cursor-pointer"
                                                data-value="organisasi" data-color="bg-indigo-500"
                                                data-label="Organisasi">
                                                <span class="w-2 h-2 rounded-full bg-indigo-500"></span><span
                                                    class="text-sm">Organisasi</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- STATUS --}}
                            <div class="card-field au d4 bg-white border border-gray-200 rounded-2xl p-5">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M9 12l2 2 4-4" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <label class="text-sm font-semibold text-gray-700">Status</label>
                                        <input type="hidden" name="status" id="status" value="draft">
                                        <div id="dropdownBtn"
                                            class="mt-2 flex items-center justify-between px-3 py-2 border rounded-xl cursor-pointer hover:border-black transition">
                                            <div class="flex items-center gap-2">
                                                <span id="dot" class="w-2 h-2 rounded-full bg-amber-500"></span>
                                                <span id="label" class="text-sm font-medium">Draft</span>
                                            </div>
                                            <svg id="arrow" class="w-4 h-4 text-gray-400 transition"
                                                fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M6 9l6 6 6-6" />
                                            </svg>
                                        </div>
                                        <div id="dropdown"
                                            class="hidden mt-2 border rounded-xl overflow-hidden bg-white shadow-lg">
                                            <div class="option px-3 py-2 flex items-center gap-2 hover:bg-gray-50 cursor-pointer"
                                                data-value="draft" data-color="bg-amber-500" data-label="Draft">
                                                <span class="w-2 h-2 rounded-full bg-amber-500"></span><span
                                                    class="text-sm">Draft</span>
                                            </div>
                                            <div class="option px-3 py-2 flex items-center gap-2 hover:bg-gray-50 cursor-pointer"
                                                data-value="published" data-color="bg-emerald-500"
                                                data-label="Published">
                                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span><span
                                                    class="text-sm">Published</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- GAMBAR --}}
                            <div class="au d5">
                                <div class="flex items-center justify-between mb-2 px-1">
                                    <label class="text-sm font-semibold text-gray-700">Gambar</label>
                                    <span class="text-xs text-gray-400">Opsional</span>
                                </div>
                                <label for="gambar-input" id="upload-zone"
                                    class="flex flex-col items-center justify-center text-center cursor-pointer border-2 border-dashed border-gray-300 rounded-2xl bg-gray-50 py-10 px-6 transition-all duration-300 hover:border-black hover:bg-white hover:-translate-y-0.5">
                                    <div id="upload-preview-wrap"
                                        class="hidden w-full mb-3 rounded-xl overflow-hidden aspect-video">
                                        <img id="upload-img-preview" src=""
                                            class="w-full h-full object-cover" />
                                    </div>
                                    <div id="upload-placeholder">
                                        <div
                                            class="w-14 h-14 rounded-2xl bg-white border border-gray-200 flex items-center justify-center mb-3 mx-auto">
                                            <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor"
                                                stroke-width="1.5" viewBox="0 0 24 24">
                                                <rect x="3" y="3" width="18" height="18" rx="3" />
                                                <path d="M3 15l5-5 4 4 3-3 6 5" />
                                                <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"
                                                    stroke="none" />
                                            </svg>
                                        </div>
                                        <p class="font-semibold text-gray-900 text-sm mb-0.5">Upload gambar berita</p>
                                        <p class="text-xs text-gray-500">PNG, JPG, WEBP · Maks 2MB</p>
                                    </div>
                                </label>
                                <input type="file" name="gambar" id="gambar-input" accept="image/*"
                                    class="hidden" onchange="handleImage(this)" />
                                @error('gambar')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        {{-- Footer --}}
                        <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-between">
                            <span id="footer-status" class="text-sm text-gray-500">Isi field yang diperlukan</span>
                            <div class="flex items-center gap-2">
                                <a href="{{ route($prefix . '.berita.store') }}"
                                    class="text-sm px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 transition font-medium">Batal</a>
                                <button type="submit"
                                    class="flex items-center gap-2 text-sm px-6 py-2.5 rounded-xl bg-black text-white font-semibold hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/20 transition-all duration-300 active:scale-95">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan Berita
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- ===== RIGHT: LIVE PREVIEW (IDENTIK DENGAN DESIGN ASLI) ===== --}}
                {{-- ===== RIGHT: LIVE PREVIEW (SVG CALENDAR) ===== --}}
                <div class="preview-panel au d2">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Live Preview</p>
                    </div>

                    <div
                        class="group bg-white rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">

                        {{-- IMAGE --}}
                        <div class="overflow-hidden">
                            <img id="preview-img" src=""
                                class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500 hidden" />
                            <div id="img-placeholder"
                                class="w-full h-52 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <div class="flex flex-col items-center gap-2 text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="1.5"
                                        viewBox="0 0 24 24">
                                        <rect x="3" y="3" width="18" height="18" rx="2"
                                            ry="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <polyline points="21,15 16,10 5,21" />
                                    </svg>
                                    <span class="text-sm font-medium">Gambar Berita</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            {{-- KATEGORI + STATUS --}}
                            <div class="flex items-center gap-2 mb-4">
                                <span id="preview-kategori-badge"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200 shadow-sm">
                                    Dakwah
                                </span>
                                <span id="preview-status-badge"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200 shadow-sm">
                                    Draft
                                </span>
                            </div>

                            {{-- JUDUL --}}
                            <h3 id="preview-title"
                                class="font-bold text-xl md:text-lg leading-tight text-gray-900 mb-3 line-clamp-2 hover:text-emerald-600 transition-colors cursor-pointer">
                                Judul Berita Terbaru
                            </h3>

                            {{-- TANGGAL HARI INI --}}
                            <div class="flex items-center gap-2 text-sm text-gray-500 mb-4" id="preview-date">
                                <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2">
                                    </rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span id="current-date">Loading...</span>
                            </div>

                            {{-- ISI --}}
                            <p id="preview-content" class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-6">
                                Isi berita akan tampil di sini secara real-time...
                            </p>

                            {{-- READ MORE --}}
                            <a href="#"
                                class="inline-flex items-center gap-1.5 text-emerald-600 font-semibold text-sm hover:text-emerald-700 hover:underline transition-all group-hover:translate-x-1 duration-200">
                                <span>Baca Selengkapnya</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <p class="text-center text-xs text-gray-400 mt-6 font-medium">Preview berubah real-time saat Anda
                        mengetik</p>
                </div>

            </div>
        </div>
    </div>

    <script>
        function sync(id, val, placeholder) {
            const el = document.getElementById(id);
            if (!el) return;
            el.textContent = val.trim() || placeholder;
            updateCompletion();
        }

        function syncStatus(val) {
            const badge = document.getElementById('preview-status-badge');
            if (val === 'published') {
                badge.className = 'inline-block bg-emerald-100 text-emerald-700 text-xs px-3 py-1 rounded-full';
                badge.textContent = 'Published';
            } else {
                badge.className = 'inline-block bg-amber-100 text-amber-700 text-xs px-3 py-1 rounded-full';
                badge.textContent = 'Draft';
            }
        }

        function syncKategori(val) {
            const badge = document.getElementById('preview-kategori-badge');
            const colors = {
                'dakwah': {
                    bg: 'bg-amber-100 text-amber-700',
                    label: 'Dakwah'
                },
                'pendidikan': {
                    bg: 'bg-emerald-100 text-emerald-700',
                    label: 'Pendidikan'
                },
                'sosial': {
                    bg: 'bg-sky-100 text-sky-700',
                    label: 'Sosial'
                },
                'organisasi': {
                    bg: 'bg-indigo-100 text-indigo-700',
                    label: 'Organisasi'
                }
            };
            const color = colors[val] || colors['dakwah'];
            badge.className = `inline-block ${color.bg} text-xs px-3 py-1 rounded-full`;
            badge.textContent = color.label;
        }

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
                const ph = document.getElementById('img-placeholder');
                img.src = src;
                img.classList.remove('hidden');
                ph.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }

        // Focus states
        document.querySelectorAll('.field-input').forEach(input => {
            const card = input.closest('.card-field');
            if (!card) return;
            input.addEventListener('focus', () => card.classList.add('focused'));
            input.addEventListener('blur', () => card.classList.remove('focused'));
        });

        // Completion ring
        const CIRC = 50.27;

        function updateCompletion() {
            const cards = document.querySelectorAll('.card-field');
            let filled = 0;
            cards.forEach(card => {
                const input = card.querySelector('input,textarea,select');
                const badge = card.querySelector('.filled-badge');
                if (!input || !badge) return;
                const ok = !!input.value.trim();
                if (ok) {
                    filled++;
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            });
            const pct = Math.round((filled / cards.length) * 100);
            document.getElementById('completion-text').textContent = pct + '% Lengkap';
            document.getElementById('ring-progress').style.strokeDashoffset = CIRC * (1 - pct / 100);
            const rem = cards.length - filled;
            document.getElementById('footer-status').innerHTML = rem === 0 ?
                '<span class="text-green-600 font-semibold">✓ Siap disimpan!</span>' :
                rem + ' field yang perlu diisi';
        }

        // Event listeners
        document.querySelectorAll('.field-input').forEach(el => el.addEventListener('input', updateCompletion));
        updateCompletion();

        // Status dropdown
        const statusBtn = document.getElementById('dropdownBtn');
        const statusDropdown = document.getElementById('dropdown');
        const statusLabel = document.getElementById('label');
        const statusDot = document.getElementById('dot');
        const statusInput = document.getElementById('status');
        const statusArrow = document.getElementById('arrow');

        statusBtn.addEventListener('click', () => {
            statusDropdown.classList.toggle('hidden');
            statusArrow.classList.toggle('rotate-180');
        });

        document.querySelectorAll('.option').forEach(opt => {
            opt.addEventListener('click', () => {
                const value = opt.dataset.value;
                const text = opt.dataset.label;
                const color = opt.dataset.color;
                statusLabel.textContent = text;
                statusDot.className = `w-2 h-2 rounded-full ${color}`;
                statusInput.value = value;
                syncStatus(value);
                statusDropdown.classList.add('hidden');
                statusArrow.classList.remove('rotate-180');
            });
        });

        // Kategori dropdown
        const kategoriBtn = document.getElementById('kategoriBtn');
        const kategoriDropdown = document.getElementById('kategoriDropdown');
        const kategoriLabel = document.getElementById('kategori-label');
        const kategoriDot = document.getElementById('kategori-dot');
        const kategoriInput = document.getElementById('kategori');
        const kategoriArrow = document.getElementById('kategori-arrow');

        kategoriBtn.addEventListener('click', () => {
            kategoriDropdown.classList.toggle('hidden');
            kategoriArrow.classList.toggle('rotate-180');
        });

        document.querySelectorAll('.kategori-option').forEach(opt => {
            opt.addEventListener('click', () => {
                const value = opt.dataset.value;
                const text = opt.dataset.label;
                const color = opt.dataset.color;
                kategoriLabel.textContent = text;
                kategoriDot.className = `w-2 h-2 rounded-full ${color}`;
                kategoriInput.value = value;
                syncKategori(value);
                kategoriDropdown.classList.add('hidden');
                kategoriArrow.classList.remove('rotate-180');
            });
        });

        // Close dropdowns
        document.addEventListener('click', (e) => {
            if (!statusBtn.contains(e.target) && !statusDropdown.contains(e.target)) {
                statusDropdown.classList.add('hidden');
                statusArrow.classList.remove('rotate-180');
            }
            if (!kategoriBtn.contains(e.target) && !kategoriDropdown.contains(e.target)) {
                kategoriDropdown.classList.add('hidden');
                kategoriArrow.classList.remove('rotate-180');
            }
        });

        // Format tanggal Indonesia
        function formatTanggalIndonesia(date) {
            const bulan = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            const hari = date.getDate();
            const bulanNama = bulan[date.getMonth()];
            const tahun = date.getFullYear();

            return `${hari} ${bulanNama} ${tahun}`;
        }

        // Set tanggal hari ini saat load
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            document.getElementById('current-date').textContent = formatTanggalIndonesia(today);

            // Update completion setelah DOM ready
            updateCompletion();
        });

        // Update tanggal setiap menit (opsional)
        setInterval(() => {
            const today = new Date();
            document.getElementById('current-date').textContent = formatTanggalIndonesia(today);
        }, 60000);
    </script>

</x-app-layout>
