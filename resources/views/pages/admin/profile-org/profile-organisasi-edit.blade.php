<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-medium mb-0.5">Pengaturan</p>
                <h2 class="text-xl font-bold text-gray-900" style="font-family:'DM Sans',sans-serif">Profile Organisasi</h2>
            </div>
            <a href="{{ url()->previous() }}"
                class="flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900 transition font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        .dm { font-family: 'DM Sans', sans-serif; }
        .card-field { transition: all .3s cubic-bezier(.4,0,.2,1); }
        .card-field.focused { border-color:#000!important; box-shadow:0 0 0 3px rgba(0,0,0,.05),0 8px 24px rgba(0,0,0,.06)!important; }
        .card-field.focused .icon-badge { background:#000!important; }
        .card-field.focused .icon-svg   { color:#fff!important; }
        .field-input { outline:none; background:transparent; width:100%; resize:none; }
        .field-input::placeholder { color:#a0a0a0; }
        .acc-body { max-height:0; opacity:0; overflow:hidden; transition:max-height .4s ease,opacity .3s ease; }
        .acc-body.open { max-height:400px; opacity:1; }
        @keyframes slideUp { from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)} }
        .au  { animation:slideUp .45s cubic-bezier(.4,0,.2,1) both; }
        .d1  { animation-delay:.05s; } .d2 { animation-delay:.10s; }
        .d3  { animation-delay:.15s; } .d4 { animation-delay:.20s; }
        .d5  { animation-delay:.25s; }
        .preview-panel { position:sticky; top:2rem; }
    </style>

    <div class="min-h-screen bg-[#FAFAFA] dm py-10 px-4">
        <div class="max-w-7xl mx-auto">

            {{-- completion bar --}}
            <div class="flex items-center justify-between mb-8">
                <p class="text-sm text-gray-500">Ubah field yang ingin diperbarui lalu simpan.</p>
                <div class="flex items-center gap-3 bg-black text-white text-sm font-semibold px-4 py-2 rounded-full">
                    <svg class="w-5 h-5" viewBox="0 0 20 20">
                        <circle cx="10" cy="10" r="8" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="2"/>
                        <circle id="ring-progress" cx="10" cy="10" r="8" fill="none" stroke="white" stroke-width="2"
                            stroke-dasharray="50.27" stroke-dashoffset="50.27"
                            transform="rotate(-90 10 10)" stroke-linecap="round"
                            style="transition:stroke-dashoffset .4s ease"/>
                    </svg>
                    <span id="completion-text">0% Lengkap</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

                {{-- ===== LEFT: FORM ===== --}}
                <div>
                    <form action="{{ route('admin.profile-organisasi.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">

                            {{-- Nama --}}
                            <div class="card-field au d1 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4z"/></svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Nama Organisasi</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <input type="text" name="nama"
                                            value="{{ old('nama', $profile->nama) }}"
                                            placeholder="Nama lengkap organisasi..."
                                            class="field-input text-base font-medium text-gray-900 border-none py-1"
                                            oninput="sync('preview-nama',this.value,'PCM / Nama Organisasi')"/>
                                        @error('nama')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Tagline --}}
                            <div class="card-field au d2 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Tagline</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <input type="text" name="tagline"
                                            value="{{ old('tagline', $profile->tagline) }}"
                                            placeholder="Slogan singkat organisasi..."
                                            class="field-input text-base text-gray-900 border-none py-1"
                                            oninput="sync('preview-tagline',this.value,'Tagline organisasi...')"/>
                                        @error('tagline')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Visi --}}
                            <div class="card-field au d3 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/></svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Visi</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <textarea name="visi" rows="3"
                                            placeholder="Pernyataan visi organisasi..."
                                            class="field-input text-base text-gray-900 border-none py-1"
                                            oninput="sync('preview-visi',this.value,'Visi organisasi akan tampil di sini...')"
                                        >{{ old('visi', $profile->visi) }}</textarea>
                                        @error('visi')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Misi --}}
                            <div class="card-field au d4 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Misi</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <textarea name="misi" rows="4"
                                            placeholder="Satu baris per poin misi..."
                                            class="field-input text-base text-gray-900 border-none py-1"
                                            oninput="syncMisi(this.value)"
                                        >{{ old('misi', $profile->misi) }}</textarea>
                                        @error('misi')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Image --}}
                            <div class="au d5">
                                <div class="flex items-center justify-between mb-2 px-1">
                                    <label class="text-sm font-semibold text-gray-700">Logo / Gambar</label>
                                </div>

                                {{-- Gambar existing --}}
                                @if($profile->image)
                                    <div class="relative group rounded-2xl overflow-hidden border border-gray-200 aspect-video mb-2" id="existing-image-wrap">
                                        <img id="existing-img" src="{{ asset('storage/'.$profile->image) }}" class="w-full h-full object-cover"/>
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-between p-4">
                                            <label for="image-input" class="bg-white text-black text-sm font-semibold px-4 py-2 rounded-lg cursor-pointer hover:bg-gray-100 transition">Ganti Gambar</label>
                                            <button type="button" onclick="removeImage()" class="bg-red-500 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-red-600 transition">Hapus</button>
                                        </div>
                                    </div>
                                    {{-- hidden input untuk hapus gambar --}}
                                    <input type="hidden" name="remove_image" id="remove-image-flag" value="0">
                                @endif

                                {{-- Upload zone (hanya tampil jika tidak ada gambar, atau setelah dihapus) --}}
                                <label for="image-input" id="upload-zone"
                                    class="{{ $profile->image ? 'hidden' : '' }} flex flex-col items-center justify-center text-center cursor-pointer border-2 border-dashed border-gray-300 rounded-2xl bg-gray-50 py-10 px-6 transition-all duration-300 hover:border-black hover:bg-white hover:-translate-y-0.5">
                                    <div id="upload-preview-wrap" class="hidden w-full mb-3 rounded-xl overflow-hidden aspect-video">
                                        <img id="upload-img-preview" src="" class="w-full h-full object-cover"/>
                                    </div>
                                    <div id="upload-placeholder">
                                        <div class="w-14 h-14 rounded-2xl bg-white border border-gray-200 flex items-center justify-center mb-3 mx-auto">
                                            <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="3"/><path d="M3 15l5-5 4 4 3-3 6 5"/><circle cx="8.5" cy="8.5" r="1.5" fill="currentColor" stroke="none"/></svg>
                                        </div>
                                        <p class="font-semibold text-gray-900 text-sm mb-0.5">Upload logo atau gambar</p>
                                        <p class="text-xs text-gray-500">PNG, JPG, WEBP · Maks 2MB</p>
                                    </div>
                                </label>
                                <input type="file" name="image" id="image-input" accept="image/*" class="hidden" onchange="handleImage(this)"/>
                                @error('image')<p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>@enderror
                            </div>

                        </div>

                        {{-- Footer --}}
                        <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-between">
                            <span id="footer-status" class="text-sm text-gray-500">Ubah field yang ingin diperbarui</span>
                            <div class="flex items-center gap-2">
                                <a href="{{ url()->previous() }}" class="text-sm px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 transition font-medium">Batal</a>
                                <button type="submit" class="flex items-center gap-2 text-sm px-6 py-2.5 rounded-xl bg-black text-white font-semibold hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/20 transition-all duration-300 active:scale-95">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                                    Perbarui
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

                        {{-- cover image --}}
                        <div class="relative w-full h-52 bg-gradient-to-br from-emerald-50 to-emerald-100 flex items-center justify-center overflow-hidden">
                            @if($profile->image)
                                <img id="preview-cover" src="{{ asset('storage/'.$profile->image) }}" class="w-full h-full object-cover"/>
                                <div id="cover-placeholder" class="hidden flex flex-col items-center gap-2 text-emerald-300">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="3"/><path d="M3 15l5-5 4 4 3-3 6 5"/></svg>
                                    <span class="text-xs font-medium">Gambar akan tampil di sini</span>
                                </div>
                            @else
                                <img id="preview-cover" src="" class="w-full h-full object-cover hidden"/>
                                <div id="cover-placeholder" class="flex flex-col items-center gap-2 text-emerald-300">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="3"/><path d="M3 15l5-5 4 4 3-3 6 5"/></svg>
                                    <span class="text-xs font-medium">Gambar akan tampil di sini</span>
                                </div>
                            @endif
                            <div class="absolute bottom-4 right-4 bg-white px-4 py-3 rounded-2xl shadow-lg border-l-4 border-emerald-600">
                                <h4 class="text-emerald-600 font-bold text-sm">Dakwah</h4>
                                <p class="text-gray-400 text-xs">Berkemajuan</p>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center gap-2 text-emerald-600 font-semibold uppercase text-xs mb-2">
                                <span class="w-1.5 h-1.5 bg-emerald-600 rounded-full"></span>
                                Profil Organisasi
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-1 leading-snug">
                                Mengenal Lebih Dekat<br>
                                <span id="preview-nama" class="text-emerald-700">{{ $profile->nama ?? 'PCM / Nama Organisasi' }}</span>
                            </h2>
                            <p id="preview-tagline" class="text-gray-400 text-sm mb-5 transition-all duration-200">
                                {{ $profile->tagline ?? 'Tagline organisasi...' }}
                            </p>

                            {{-- Accordion Visi --}}
                            <div class="space-y-3">
                                <div class="border border-gray-100 rounded-2xl overflow-hidden">
                                    <button type="button" onclick="toggleAcc('acc-visi','ic-visi')"
                                        class="w-full flex items-center justify-between px-4 py-3 font-semibold text-gray-800 text-sm">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/></svg>
                                            Visi Persyarikatan
                                        </span>
                                        <span id="ic-visi" class="text-gray-400 text-lg leading-none transition-transform duration-300">+</span>
                                    </button>
                                    <div id="acc-visi" class="acc-body px-4 text-gray-600 text-sm leading-relaxed">
                                        <p id="preview-visi" class="pb-4">{{ $profile->visi ?? 'Visi organisasi akan tampil di sini...' }}</p>
                                    </div>
                                </div>

                                {{-- Accordion Misi --}}
                                <div class="border border-gray-100 rounded-2xl overflow-hidden">
                                    <button type="button" onclick="toggleAcc('acc-misi','ic-misi')"
                                        class="w-full flex items-center justify-between px-4 py-3 font-semibold text-gray-800 text-sm">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
                                            Misi Utama Kami
                                        </span>
                                        <span id="ic-misi" class="text-gray-400 text-lg leading-none transition-transform duration-300">+</span>
                                    </button>
                                    <div id="acc-misi" class="acc-body px-4 text-gray-600 text-sm leading-relaxed">
                                        <div id="preview-misi" class="pb-4 space-y-1">
                                            @if($profile->misi)
                                                @foreach(explode("\n", $profile->misi) as $line)
                                                    @if(trim($line))<p>• {{ trim($line) }}</p>@endif
                                                @endforeach
                                            @else
                                                <p class="text-gray-400">Misi akan tampil di sini...</p>
                                            @endif
                                        </div>
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
        // ── Sync preview ──────────────────────────────────────────
        function sync(id, val, placeholder) {
            const el = document.getElementById(id);
            if (!el) return;
            el.textContent = val.trim() || placeholder;
            el.classList.toggle('text-gray-400', !val.trim());
            el.classList.toggle('text-emerald-700', !!val.trim() && id === 'preview-nama');
            updateCompletion();
        }

        function syncMisi(val) {
            const c = document.getElementById('preview-misi');
            const lines = val.split('\n').map(l => l.trim()).filter(Boolean);
            c.innerHTML = lines.length
                ? lines.map(l => `<p>• ${l}</p>`).join('')
                : '<p class="text-gray-400">Misi akan tampil di sini...</p>';
            updateCompletion();
        }

        // ── Image upload ──────────────────────────────────────────
        function handleImage(input) {
            const file = input.files?.[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const src = e.target.result;
                // left side preview
                document.getElementById('upload-img-preview').src = src;
                document.getElementById('upload-preview-wrap').classList.remove('hidden');
                document.getElementById('upload-placeholder').classList.add('hidden');
                // right side preview cover
                const cover = document.getElementById('preview-cover');
                const ph    = document.getElementById('cover-placeholder');
                cover.src = src;
                cover.classList.remove('hidden');
                ph && ph.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }

        // ── Remove existing image ─────────────────────────────────
        function removeImage() {
            // sembunyikan gambar existing
            const wrap = document.getElementById('existing-image-wrap');
            if (wrap) wrap.classList.add('hidden');
            // set flag hapus
            const flag = document.getElementById('remove-image-flag');
            if (flag) flag.value = '1';
            // tampilkan upload zone
            document.getElementById('upload-zone').classList.remove('hidden');
            // reset preview cover
            const cover = document.getElementById('preview-cover');
            cover.src = '';
            cover.classList.add('hidden');
            const ph = document.getElementById('cover-placeholder');
            ph && ph.classList.remove('hidden');
        }

        // ── Accordion ─────────────────────────────────────────────
        function toggleAcc(id, iconId) {
            const body = document.getElementById(id);
            const icon = document.getElementById(iconId);
            const open = body.classList.toggle('open');
            if (icon) icon.style.transform = open ? 'rotate(45deg)' : 'rotate(0deg)';
        }

        // ── Focus states ──────────────────────────────────────────
        document.querySelectorAll('.field-input').forEach(input => {
            const card = input.closest('.card-field');
            if (!card) return;
            input.addEventListener('focus', () => card.classList.add('focused'));
            input.addEventListener('blur',  () => card.classList.remove('focused'));
        });

        // ── Completion ring ───────────────────────────────────────
        const CIRC = 50.27;
        function updateCompletion() {
            const cards = document.querySelectorAll('.card-field');
            let filled = 0;
            cards.forEach(card => {
                const input = card.querySelector('input,textarea');
                const badge = card.querySelector('.filled-badge');
                if (!input || !badge) return;
                const ok = !!input.value.trim();
                if (ok) { filled++; badge.classList.remove('hidden'); }
                else    { badge.classList.add('hidden'); }
            });
            const pct = Math.round((filled / cards.length) * 100);
            document.getElementById('completion-text').textContent = pct + '% Lengkap';
            document.getElementById('ring-progress').style.strokeDashoffset = CIRC * (1 - pct / 100);
            const rem = cards.length - filled;
            document.getElementById('footer-status').innerHTML = rem === 0
                ? '<span class="text-green-600 font-semibold">✓ Siap diperbarui!</span>'
                : rem + ' field yang perlu diisi';
        }

        document.querySelectorAll('.field-input').forEach(el => el.addEventListener('input', updateCompletion));

        // ── Init: jalankan saat page load biar state langsung kedeteksi ──
        updateCompletion();
        // sync preview dari nilai existing di DB
        (function initPreview() {
            const nama    = document.querySelector('[name="nama"]');
            const tagline = document.querySelector('[name="tagline"]');
            const visi    = document.querySelector('[name="visi"]');
            const misi    = document.querySelector('[name="misi"]');
            if (nama)    sync('preview-nama',    nama.value,    'PCM / Nama Organisasi');
            if (tagline) sync('preview-tagline', tagline.value, 'Tagline organisasi...');
            if (visi)    sync('preview-visi',    visi.value,    'Visi organisasi akan tampil di sini...');
            if (misi)    syncMisi(misi.value);
        })();
    </script>

</x-app-layout>
