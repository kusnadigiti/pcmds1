<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-medium mb-0.5">Manajemen</p>
                <h2 class="text-xl font-bold text-gray-900" style="font-family:'DM Sans',sans-serif">Edit Hero Section</h2>
            </div>
            <a href="{{ route('admin.banner.index') }}"
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
        .card-field.focused .icon-svg { color: #fff !important; }

        .field-input {
            outline: none;
            background: transparent;
            width: 100%;
        }
        .field-input::placeholder { color: #a0a0a0; }

        textarea.field-input { resize: none; }

        @keyframes slideUp {
            from { opacity:0; transform:translateY(16px) }
            to   { opacity:1; transform:translateY(0) }
        }
        .au { animation: slideUp .45s cubic-bezier(.4,0,.2,1) both; }
        .d1 { animation-delay: .05s; }
        .d2 { animation-delay: .10s; }
        .d3 { animation-delay: .15s; }
        .d4 { animation-delay: .20s; }

        .preview-panel { position: sticky; top: 2rem; }

        /* Image upload drop zone */
        .drop-zone {
            border: 2px dashed #e5e7eb;
            border-radius: 1rem;
            transition: all .3s ease;
            cursor: pointer;
        }
        .drop-zone:hover, .drop-zone.dragover {
            border-color: #000;
            background: #f9f9f9;
        }
        .drop-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        /* Hero card preview */
        .hero-preview-card {
            position: relative;
            border-radius: 1.5rem;
            overflow: hidden;
            aspect-ratio: 16/7;
            background: linear-gradient(135deg, #1a1a1a 0%, #3a3a3a 100%);
        }
        .hero-preview-card img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.6;
        }
        .hero-preview-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 1.5rem;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 60%);
        }

        /* Edit badge */
        .edit-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.2rem 0.6rem;
            border-radius: 999px;
            letter-spacing: 0.04em;
        }
    </style>

    <div class="min-h-screen bg-[#FAFAFA] dm py-10 px-4">
        <div class="max-w-7xl mx-auto">

            {{-- Completion Bar --}}
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-3">
                    <p class="text-sm text-gray-500">Edit dan simpan perubahan Anda.</p>
                    <span class="edit-indicator">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        Mode Edit
                    </span>
                </div>
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

                    <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">

                            {{-- IMAGE UPLOAD --}}
                            <div class="card-field au d1 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                            <circle cx="8.5" cy="8.5" r="1.5"/>
                                            <polyline points="21 15 16 10 5 21"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-3">
                                            <label class="text-sm font-semibold text-gray-700">Banner / Gambar</label>
                                            <span class="filled-badge text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>

                                        {{-- Current image info --}}
                                        @if ($banner->image)
                                            <div id="current-image-info" class="flex items-center gap-3 mb-3 p-2.5 bg-gray-50 rounded-xl">
                                                <img src="{{ asset('storage/' . $banner->image) }}" alt="Current" class="w-12 h-12 object-cover rounded-lg shrink-0">
                                                <div class="min-w-0 flex-1">
                                                    <p class="text-xs font-semibold text-gray-600">Gambar saat ini</p>
                                                    <p class="text-xs text-gray-400 truncate">{{ basename($banner->image) }}</p>
                                                </div>
                                                <button type="button" onclick="clearCurrentImage()" class="text-gray-400 hover:text-red-500 transition shrink-0">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif

                                        <div class="drop-zone relative flex flex-col items-center justify-center py-8 px-4 text-center" id="drop-zone">
                                            <input type="file" name="image" id="image-input" accept="image/jpg,image/jpeg,image/png,image/webp" onchange="handleImageChange(event)">
                                            <div id="drop-placeholder">
                                                <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <p class="text-sm text-gray-400 font-medium">
                                                    @if($banner->image)
                                                        Klik untuk ganti gambar
                                                    @else
                                                        Klik atau drag gambar ke sini
                                                    @endif
                                                </p>
                                                <p class="text-xs text-gray-300 mt-1">JPG, PNG, WEBP · Maks. 2MB</p>
                                            </div>
                                            <div id="drop-preview" class="hidden w-full">
                                                <img id="image-preview-thumb" src="" alt="Preview" class="w-full h-32 object-cover rounded-xl mb-2">
                                                <p id="image-filename" class="text-xs text-gray-500 font-medium truncate"></p>
                                            </div>
                                        </div>
                                        @error('image')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- TAGLINE --}}
                            <div class="card-field au d2 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Tagline <span class="text-gray-400 font-normal">(opsional)</span></label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <input type="text" name="tagline" value="{{ old('tagline', $banner->tagline) }}"
                                            placeholder="Contoh: Muhammadiyah Berkemajuan"
                                            class="field-input text-base font-medium text-gray-900 border-none py-1"
                                            oninput="syncTagline(this.value)" maxlength="255"/>
                                        @error('tagline')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- TITLE --}}
                            <div class="card-field au d3 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M4 6h16M4 12h16M4 18h7"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Judul</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <input type="text" name="title" value="{{ old('title', $banner->title) }}"
                                            placeholder="Masukkan judul hero section..."
                                            class="field-input text-base font-medium text-gray-900 border-none py-1"
                                            oninput="syncTitle(this.value)" maxlength="255"/>
                                        @error('title')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- DESCRIPTION --}}
                            <div class="card-field au d4 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M4 6h16M4 10h16M4 14h12M4 18h8"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Deskripsi <span class="text-gray-400 font-normal">Wajib Diisi</span></label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <textarea name="description" rows="4"
                                            placeholder="Contoh: Menjadi pilar dakwah"
                                            class="field-input text-base text-gray-900 border-none py-1"
                                            oninput="syncDescription(this.value)">{{ old('description', $banner->description) }}</textarea>
                                        @error('description')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Footer --}}
                        <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-between">
                            <span id="footer-status" class="text-sm text-gray-500">Isi field yang diperlukan</span>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.banner.index') }}"
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

                    {{-- Hero Card Preview --}}
                    <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden shadow-sm p-4">

                        {{-- Hero Banner Preview --}}
                        <div class="hero-preview-card mb-4">
                            <img id="preview-banner-img"
                                src="{{ $banner->image ? asset('storage/' . $banner->image) : '' }}"
                                alt="Banner Preview"
                                class="{{ $banner->image ? '' : 'hidden' }}">
                            <div id="preview-banner-placeholder" class="absolute inset-0 flex items-center justify-center" style="{{ $banner->image ? 'display:none' : '' }}">
                                <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="hero-preview-overlay">
                                <p id="preview-tagline"
                                    class="text-xs font-semibold text-white/70 uppercase tracking-widest mb-1 {{ $banner->tagline ? '' : 'hidden' }}">
                                    {{ old('tagline', $banner->tagline) }}
                                </p>
                                <h3 id="preview-title" class="text-white text-lg font-bold leading-tight">
                                    {{ old('title', $banner->title) ?: 'Judul Hero Section' }}
                                </h3>
                                <p id="preview-desc"
                                    class="text-white/60 text-xs mt-1 line-clamp-2 {{ $banner->description ? '' : 'hidden' }}">
                                    {{ old('description', $banner->description) }}
                                </p>
                            </div>
                        </div>

                        {{-- Meta info --}}
                        <div class="space-y-2">
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50">
                                <div class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs text-gray-400 font-medium">Tagline</p>
                                    <p id="preview-tagline-meta" class="text-sm text-gray-700 font-medium truncate">
                                        {{ old('tagline', $banner->tagline) ?: '—' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50">
                                <div class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M4 6h16M4 12h16M4 18h7"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs text-gray-400 font-medium">Judul</p>
                                    <p id="preview-title-meta" class="text-sm text-gray-700 font-medium truncate">
                                        {{ old('title', $banner->title) ?: '—' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50">
                                <div class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M4 6h16M4 10h16M4 14h12M4 18h8"/>
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs text-gray-400 font-medium">Deskripsi</p>
                                    <p id="preview-desc-meta" class="text-sm text-gray-700 font-medium line-clamp-3">
                                        {{ old('description', $banner->description) ?: '—' }}
                                    </p>
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
        // ── Existing image state ───────────────────────────────────
        // Track whether the existing image is still active
        // (will be false if user removes it or uploads a new one)
        let hasExistingImage = {{ $banner->image ? 'true' : 'false' }};

        function clearCurrentImage() {
            hasExistingImage = false;
            document.getElementById('current-image-info')?.remove();

            // Hide banner preview
            const img = document.getElementById('preview-banner-img');
            img.src = '';
            img.classList.add('hidden');
            document.getElementById('preview-banner-placeholder').style.display = '';

            // Reset drop zone text
            document.querySelector('#drop-placeholder p.text-sm').textContent = 'Klik atau drag gambar ke sini';

            updateCompletion();
        }

        // ── Image upload ───────────────────────────────────────────
        function handleImageChange(event) {
            const file = event.target.files[0];
            if (!file) return;

            // Hide current image info if replacing
            document.getElementById('current-image-info')?.remove();
            hasExistingImage = false;

            const reader = new FileReader();
            reader.onload = function(e) {
                const src = e.target.result;

                // Show drop preview thumbnail
                document.getElementById('drop-placeholder').classList.add('hidden');
                document.getElementById('drop-preview').classList.remove('hidden');
                document.getElementById('image-preview-thumb').src = src;
                document.getElementById('image-filename').textContent = file.name;

                // Show hero banner preview
                const img = document.getElementById('preview-banner-img');
                img.src = src;
                img.classList.remove('hidden');
                document.getElementById('preview-banner-placeholder').style.display = 'none';

                updateCompletion();
            };
            reader.readAsDataURL(file);
        }

        // Drag & drop
        const dz = document.getElementById('drop-zone');
        dz.addEventListener('dragover', e => { e.preventDefault(); dz.classList.add('dragover'); });
        dz.addEventListener('dragleave', () => dz.classList.remove('dragover'));
        dz.addEventListener('drop', e => {
            e.preventDefault();
            dz.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            if (file) {
                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('image-input').files = dt.files;
                handleImageChange({ target: { files: [file] } });
            }
        });

        // ── Tagline sync ───────────────────────────────────────────
        function syncTagline(val) {
            const trimmed = val.trim();
            const el = document.getElementById('preview-tagline');
            const meta = document.getElementById('preview-tagline-meta');
            if (trimmed) {
                el.textContent = trimmed;
                el.classList.remove('hidden');
                meta.textContent = trimmed;
            } else {
                el.classList.add('hidden');
                meta.textContent = '—';
            }
            updateCompletion();
        }

        // ── Title sync ─────────────────────────────────────────────
        function syncTitle(val) {
            const trimmed = val.trim();
            document.getElementById('preview-title').textContent = trimmed || 'Judul Hero Section';
            document.getElementById('preview-title-meta').textContent = trimmed || '—';
            updateCompletion();
        }

        // ── Description sync ───────────────────────────────────────
        function syncDescription(val) {
            const trimmed = val.trim();
            const el = document.getElementById('preview-desc');
            const meta = document.getElementById('preview-desc-meta');
            if (trimmed) {
                el.textContent = trimmed;
                el.classList.remove('hidden');
                meta.textContent = trimmed;
            } else {
                el.classList.add('hidden');
                meta.textContent = '—';
            }
            updateCompletion();
        }

        // ── Focus states ───────────────────────────────────────────
        document.querySelectorAll('.field-input').forEach(input => {
            const card = input.closest('.card-field');
            if (!card) return;
            input.addEventListener('focus', () => card.classList.add('focused'));
            input.addEventListener('blur', () => card.classList.remove('focused'));
        });

        // ── Completion ring ────────────────────────────────────────
        const CIRC = 50.27;

        function updateCompletion() {
            const cards = document.querySelectorAll('.card-field');
            let filled = 0;

            cards.forEach(card => {
                const input = card.querySelector('input[type="text"], input[type="email"], input[type="file"], textarea, select');
                const badge = card.querySelector('.filled-badge');

                if (!input || !badge) return;

                let ok = false;
                if (input.type === 'file') {
                    // For image: OK if new file selected OR existing image still present
                    ok = (input.files && input.files.length > 0) || hasExistingImage;
                } else {
                    ok = !!input.value.trim();
                }

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

            // Check if required title field is filled
            const titleFilled = !!document.querySelector('input[name="title"]')?.value.trim();
            document.getElementById('footer-status').innerHTML = titleFilled
                ? '<span class="text-green-600 font-semibold">✓ Siap disimpan!</span>'
                : '<span>Field <strong>Judul</strong> wajib diisi</span>';
        }

        document.querySelectorAll('.field-input').forEach(el => el.addEventListener('input', updateCompletion));

        // ── Init: run completion on page load with existing data ───
        updateCompletion();
    </script>

</x-app-layout>
