<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-medium mb-0.5">Manajemen</p>
                <h2 class="text-xl font-bold text-gray-900" style="font-family:'DM Sans',sans-serif">Artikel</h2>
            </div>
            <a href="{{ route('admin.articles') }}"
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

                    <form action="{{ route($prefix . '.articles.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4">

                            {{-- TITLE --}}
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
                                            <label class="text-sm font-semibold text-gray-700">Judul Artikel</label>
                                            <span
                                                class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓
                                                Diisi</span>
                                        </div>
                                        <input type="text" name="title" value="{{ old('title') }}"
                                            placeholder="Masukkan judul artikel..."
                                            class="field-input text-base font-medium text-gray-900 border-none py-1"
                                            oninput="sync('preview-title', this.value, 'Judul Artikel')" />
                                        @error('title')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- AUTHOR --}}
                            <div
                                class="card-field au d2 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                            <circle cx="12" cy="7" r="4" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Penulis</label>
                                            <span
                                                class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓
                                                Diisi</span>
                                        </div>
                                        <input type="text" name="author" value="{{ old('author') }}"
                                            placeholder="Nama penulis..."
                                            class="field-input text-base text-gray-900 border-none py-1"
                                            oninput="sync('preview-author', this.value, 'Unknown')" />
                                        @error('author')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- CONTENT --}}
                            <div
                                class="card-field au d3 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
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
                                            <label class="text-sm font-semibold text-gray-700">Konten</label>
                                            <span
                                                class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓
                                                Diisi</span>
                                        </div>
                                        <textarea name="content" rows="5" placeholder="Isi artikel..."
                                            class="field-input text-base text-gray-900 border-none py-1"
                                            oninput="sync('preview-content', this.value, 'Isi artikel akan tampil di sini...')">{{ old('content') }}</textarea>
                                        @error('content')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
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

                                        <!-- hidden -->
                                        <input type="hidden" name="status" id="status" value="draft">

                                        <!-- trigger -->
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

                                        <!-- dropdown -->
                                        <div id="dropdown"
                                            class="hidden mt-2 border rounded-xl overflow-hidden bg-white shadow-lg">

                                            <div class="option px-3 py-2 flex items-center gap-2 hover:bg-gray-50 cursor-pointer"
                                                data-value="draft" data-color="bg-amber-500" data-label="Draft">
                                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                                <span class="text-sm">Draft</span>
                                            </div>

                                            <div class="option px-3 py-2 flex items-center gap-2 hover:bg-gray-50 cursor-pointer"
                                                data-value="published" data-color="bg-emerald-500"
                                                data-label="Published">
                                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                                <span class="text-sm">Published</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- THUMBNAIL --}}
                            <div class="au d5">
                                <div class="flex items-center justify-between mb-2 px-1">
                                    <label class="text-sm font-semibold text-gray-700">Thumbnail</label>
                                    <span class="text-xs text-gray-400">Opsional</span>
                                </div>
                                <label for="thumbnail-input" id="upload-zone"
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
                                        <p class="font-semibold text-gray-900 text-sm mb-0.5">Upload thumbnail artikel
                                        </p>
                                        <p class="text-xs text-gray-500">PNG, JPG, WEBP · Maks 2MB</p>
                                    </div>
                                </label>
                                <input type="file" name="thumbnail" id="thumbnail-input" accept="image/*"
                                    class="hidden" onchange="handleImage(this)" />
                                @error('thumbnail')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        {{-- Footer --}}
                        <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-between">
                            <span id="footer-status" class="text-sm text-gray-500">Isi field yang diperlukan</span>
                            <div class="flex items-center gap-2">
                                <a href="{{ route($prefix . '.articles') }}"
                                    class="text-sm px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 transition font-medium">Batal</a>
                                <button type="submit"
                                    class="flex items-center gap-2 text-sm px-6 py-2.5 rounded-xl bg-black text-white font-semibold hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/20 transition-all duration-300 active:scale-95">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan Artikel
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

                    {{-- Article Card Preview --}}
                    <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden shadow-sm">

                        <div class="grid grid-cols-12 lg:min-h-[220px]">

                            {{-- IMAGE --}}
                            <div
                                class="col-span-12 lg:col-span-5 h-52 lg:h-full overflow-hidden relative bg-gradient-to-br from-neutral-100 to-neutral-200 flex items-center justify-center">
                                <img id="preview-img" src=""
                                    class="hidden w-full h-full object-cover absolute inset-0" />
                                <div id="img-placeholder" class="flex flex-col items-center gap-2 text-neutral-300">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5"
                                        viewBox="0 0 24 24">
                                        <rect x="3" y="3" width="18" height="18" rx="3" />
                                        <path d="M3 15l5-5 4 4 3-3 6 5" />
                                    </svg>
                                    <span class="text-xs font-medium">Thumbnail</span>
                                </div>
                            </div>

                            {{-- CONTENT --}}
                            <div class="col-span-12 lg:col-span-7 p-6 flex flex-col justify-center space-y-3 min-w-0">

                                <div class="flex items-center gap-2">
                                    <span id="preview-status-badge"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full bg-amber-100 text-amber-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Draft
                                    </span>
                                </div>

                                <span id="preview-author" class="text-sm text-neutral-500">Unknown</span>

                                <h3 id="preview-title" class="text-xl font-medium text-neutral-900 leading-snug">
                                    Judul Artikel
                                </h3>

                                <p id="preview-content" class="text-neutral-600 text-sm line-clamp-3 break-all">
                                    Isi artikel akan tampil di sini...
                                </p>

                                <div class="flex items-center gap-2 text-sm font-medium text-neutral-900 pt-1">
                                    Read More →
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
        function sync(id, val, placeholder) {
            const el = document.getElementById(id);
            if (!el) return;
            el.textContent = val.trim() || placeholder;
            updateCompletion();
        }

        function syncStatus(val) {
            const badge = document.getElementById('preview-status-badge');
            if (val === 'published') {
                badge.className =
                    'inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-700';
                badge.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Published';
            } else {
                badge.className =
                    'inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full bg-amber-100 text-amber-700';
                badge.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Draft';
            }
            updateCompletion();
        }

        function handleImage(input) {
            const file = input.files?.[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const src = e.target.result;
                // left upload zone
                document.getElementById('upload-img-preview').src = src;
                document.getElementById('upload-preview-wrap').classList.remove('hidden');
                document.getElementById('upload-placeholder').classList.add('hidden');
                // right preview
                const img = document.getElementById('preview-img');
                const ph = document.getElementById('img-placeholder');
                img.src = src;
                img.classList.remove('hidden');
                ph && ph.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }

        // focus states
        document.querySelectorAll('.field-input').forEach(input => {
            const card = input.closest('.card-field');
            if (!card) return;
            input.addEventListener('focus', () => card.classList.add('focused'));
            input.addEventListener('blur', () => card.classList.remove('focused'));
        });

        // completion ring
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

        document.querySelectorAll('.field-input').forEach(el => el.addEventListener('input', updateCompletion));
        updateCompletion();


        const btn = document.getElementById('dropdownBtn');
        const dropdown = document.getElementById('dropdown');
        const label = document.getElementById('label');
        const dot = document.getElementById('dot');
        const input = document.getElementById('status');
        const arrow = document.getElementById('arrow');

        // toggle
        btn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        });

        // pilih option
        document.querySelectorAll('.option').forEach(opt => {
            opt.addEventListener('click', () => {
                const value = opt.dataset.value;
                const text = opt.dataset.label;
                const color = opt.dataset.color;

                // update UI
                label.textContent = text;
                dot.className = `w-2 h-2 rounded-full ${color}`;

                // update input
                input.value = value;

                // update preview (biar nyambung sama sistem kamu)
                syncStatus(value);

                // close
                dropdown.classList.add('hidden');
                arrow.classList.remove('rotate-180');
            });
        });

        document.addEventListener('click', (e) => {
            if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
                arrow.classList.remove('rotate-180');
            }
        });
    </script>

</x-app-layout>
