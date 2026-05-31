<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-medium mb-0.5">Manajemen</p>
                <h2 class="text-xl font-bold text-gray-900" style="font-family:'DM Sans',sans-serif">Jadwal Kajian</h2>
            </div>
            <a href="{{ route('admin.program-kajian') }}"
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

        /* Style native date/time inputs */
        input[type="date"].field-input,
        input[type="time"].field-input {
            -webkit-appearance: none;
            appearance: none;
            color: #111827;
        }

        input[type="date"].field-input::-webkit-calendar-picker-indicator,
        input[type="time"].field-input::-webkit-calendar-picker-indicator {
            opacity: 0.4;
            cursor: pointer;
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

        .d1 { animation-delay: .05s; }
        .d2 { animation-delay: .10s; }
        .d3 { animation-delay: .15s; }
        .d4 { animation-delay: .20s; }
        .d5 { animation-delay: .25s; }

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
                        <circle cx="10" cy="10" r="8" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="2" />
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

                    <form action="{{ route('admin.jadwal-kajian.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">

                            {{-- NAMA KEGIATAN --}}
                            <div class="card-field au d1 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Nama Kegiatan</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}"
                                            placeholder="Masukkan nama kajian..."
                                            class="field-input text-base font-medium text-gray-900 border-none py-1"
                                            oninput="sync('preview-title', this.value, 'Nama Kegiatan')" />
                                        @error('nama_kegiatan')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- TANGGAL --}}
                            <div class="card-field au d2 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <rect x="3" y="4" width="18" height="18" rx="2" />
                                            <path d="M16 2v4M8 2v4M3 10h18" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Tanggal</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <input type="date" name="tanggal" value="{{ old('tanggal') }}"
                                            class="field-input text-base text-gray-900 border-none py-1"
                                            oninput="syncTanggal(this.value)" />
                                        @error('tanggal')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- WAKTU --}}
                            <div class="card-field au d3 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="9" />
                                            <path d="M12 7v5l3 3" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Waktu</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <input type="time" name="waktu" value="{{ old('waktu') }}"
                                            class="field-input text-base text-gray-900 border-none py-1"
                                            oninput="syncWaktu(this.value)" />
                                        @error('waktu')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- LOKASI --}}
                            <div class="card-field au d4 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M12 21s-6-5.686-6-10a6 6 0 1112 0c0 4.314-6 10-6 10z" />
                                            <circle cx="12" cy="11" r="2" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Lokasi</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                                            placeholder="Masukkan lokasi kegiatan..."
                                            class="field-input text-base text-gray-900 border-none py-1"
                                            oninput="sync('preview-lokasi', this.value, 'Lokasi belum diisi')" />
                                        @error('lokasi')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- DESKRIPSI --}}
                            <div class="card-field au d5 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M4 6h16M4 12h16M4 18h12" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Deskripsi</label>
                                            <span class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓ Diisi</span>
                                        </div>
                                        <textarea name="deskripsi" rows="4" placeholder="Deskripsi singkat kegiatan kajian..."
                                            class="field-input text-base text-gray-900 border-none py-1"
                                            oninput="sync('preview-deskripsi', this.value, 'Deskripsi kegiatan akan tampil di sini...')">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
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
                                <a href="{{ route('admin.program-kajian') }}"
                                    class="text-sm px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 transition font-medium">Batal</a>
                                <button type="submit"
                                    class="flex items-center gap-2 text-sm px-6 py-2.5 rounded-xl bg-black text-white font-semibold hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/20 transition-all duration-300 active:scale-95">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan Jadwal
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

                    {{-- Jadwal Card Preview --}}
                    <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden shadow-sm">

                        {{-- Top accent bar --}}
                        <div class="h-1.5 w-full bg-gradient-to-r from-emerald-400 via-teal-400 to-cyan-400"></div>

                        <div class="p-6 space-y-5">

                            {{-- Badge + Title --}}
                            <div class="space-y-2">
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Kajian
                                </span>
                                <h3 id="preview-title" class="text-xl font-semibold text-gray-900 leading-snug">
                                    Nama Kegiatan
                                </h3>
                            </div>

                            {{-- Meta info --}}
                            <div class="space-y-2.5">

                                {{-- Tanggal --}}
                                <div class="flex items-center gap-3 text-sm text-gray-600">
                                    <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <rect x="3" y="4" width="18" height="18" rx="2" />
                                            <path d="M16 2v4M8 2v4M3 10h18" />
                                        </svg>
                                    </div>
                                    <span id="preview-tanggal" class="text-gray-400 italic">Tanggal belum diisi</span>
                                </div>

                                {{-- Waktu --}}
                                <div class="flex items-center gap-3 text-sm text-gray-600">
                                    <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="9" />
                                            <path d="M12 7v5l3 3" />
                                        </svg>
                                    </div>
                                    <span id="preview-waktu" class="text-gray-400 italic">Waktu belum diisi</span>
                                </div>

                                {{-- Lokasi --}}
                                <div class="flex items-center gap-3 text-sm text-gray-600">
                                    <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M12 21s-6-5.686-6-10a6 6 0 1112 0c0 4.314-6 10-6 10z" />
                                            <circle cx="12" cy="11" r="2" />
                                        </svg>
                                    </div>
                                    <span id="preview-lokasi" class="text-gray-400 italic">Lokasi belum diisi</span>
                                </div>

                            </div>

                            {{-- Divider --}}
                            <div class="border-t border-gray-100"></div>

                            {{-- Deskripsi --}}
                            <p id="preview-deskripsi" class="text-gray-500 text-sm leading-relaxed line-clamp-3 italic">
                                Deskripsi kegiatan akan tampil di sini...
                            </p>

                            {{-- CTA --}}
                            <div class="flex items-center gap-2 text-sm font-semibold text-gray-900 pt-1">
                                Lihat Detail →
                            </div>

                        </div>
                    </div>

                    <p class="text-center text-xs text-gray-300 mt-3">Preview berubah real-time saat Anda mengetik</p>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Generic text sync
        function sync(id, val, placeholder) {
            const el = document.getElementById(id);
            if (!el) return;
            const trimmed = val.trim();
            el.textContent = trimmed || placeholder;
            if (trimmed) {
                el.classList.remove('text-gray-400', 'italic');
                el.classList.add('text-gray-900');
            } else {
                el.classList.add('text-gray-400', 'italic');
                el.classList.remove('text-gray-900');
            }
            updateCompletion();
        }

        // Tanggal: format to Indonesian locale
        function syncTanggal(val) {
            const el = document.getElementById('preview-tanggal');
            if (!el) return;
            if (val) {
                const d = new Date(val + 'T00:00:00');
                el.textContent = d.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                el.classList.remove('text-gray-400', 'italic');
                el.classList.add('text-gray-600');
            } else {
                el.textContent = 'Tanggal belum diisi';
                el.classList.add('text-gray-400', 'italic');
                el.classList.remove('text-gray-600');
            }
            updateCompletion();
        }

        // Waktu: format to HH.MM WIB
        function syncWaktu(val) {
            const el = document.getElementById('preview-waktu');
            if (!el) return;
            if (val) {
                const [h, m] = val.split(':');
                el.textContent = `${h}.${m} WIB`;
                el.classList.remove('text-gray-400', 'italic');
                el.classList.add('text-gray-600');
            } else {
                el.textContent = 'Waktu belum diisi';
                el.classList.add('text-gray-400', 'italic');
                el.classList.remove('text-gray-600');
            }
            updateCompletion();
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
                const input = card.querySelector('input, textarea, select');
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
            document.getElementById('footer-status').innerHTML = rem === 0
                ? '<span class="text-green-600 font-semibold">✓ Siap disimpan!</span>'
                : rem + ' field yang perlu diisi';
        }

        document.querySelectorAll('.field-input').forEach(el => el.addEventListener('input', updateCompletion));
        updateCompletion();
    </script>

</x-app-layout>
