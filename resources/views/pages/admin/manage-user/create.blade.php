<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-medium mb-0.5">Manajemen</p>
                <h2 class="text-xl font-bold text-gray-900" style="font-family:'DM Sans',sans-serif">Akun</h2>
            </div>
            <a href="{{ route('admin.manage-user') }}"
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

        .preview-panel {
            position: sticky;
            top: 2rem;
        }

        /* password toggle */
        .pw-wrap {
            position: relative;
        }

        .pw-toggle {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            color: #9ca3af;
            transition: color .2s;
        }

        .pw-toggle:hover {
            color: #111;
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

                    <form action="{{ route('admin.manage-user.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">

                            {{-- NAME --}}
                            <div
                                class="card-field au d1 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
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
                                            <label class="text-sm font-semibold text-gray-700">Nama</label>
                                            <span
                                                class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓
                                                Diisi</span>
                                        </div>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            placeholder="Masukkan nama lengkap..."
                                            class="field-input text-base font-medium text-gray-900 border-none py-1"
                                            oninput="syncName(this.value)" />
                                        @error('name')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- EMAIL --}}
                            <div
                                class="card-field au d2 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path
                                                d="M4 4h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                            <polyline points="22,6 12,13 2,6" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Email</label>
                                            <span
                                                class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓
                                                Diisi</span>
                                        </div>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            placeholder="contoh@email.com..."
                                            class="field-input text-base text-gray-900 border-none py-1"
                                            oninput="syncEmail(this.value)" />
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- PASSWORD --}}
                            <div
                                class="card-field au d3 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <rect x="3" y="11" width="18" height="11" rx="2"
                                                ry="2" />
                                            <path d="M7 11V7a5 5 0 0110 0v4" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Password</label>
                                            <span
                                                class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">✓
                                                Diisi</span>
                                        </div>
                                        <div class="pw-wrap">
                                            <input type="password" name="password" id="password-input"
                                                placeholder="Min. 6 karakter..."
                                                class="field-input text-base text-gray-900 border-none py-1 pr-8" />
                                            <button type="button" class="pw-toggle" id="pw-toggle-btn"
                                                onclick="togglePassword()" title="Tampilkan/sembunyikan password">
                                                <!-- eye icon -->
                                                <svg id="eye-icon" class="w-5 h-5" fill="none"
                                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                    <circle cx="12" cy="12" r="3" />
                                                </svg>
                                                <!-- eye-off icon -->
                                                <svg id="eye-off-icon" class="w-5 h-5 hidden" fill="none"
                                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path
                                                        d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24" />
                                                    <line x1="1" y1="1" x2="23"
                                                        y2="23" />
                                                </svg>
                                            </button>
                                        </div>
                                        @error('password')
                                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- ROLE: selalu admin --}}
                            {{-- ROLE --}}
                            <div
                                class="card-field au d4 bg-white border border-gray-200 rounded-2xl p-5 hover:border-gray-300 hover:shadow-lg hover:shadow-black/5">
                                <div class="flex items-start gap-4">

                                    {{-- ICON --}}
                                    <div
                                        class="icon-badge w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-500 icon-svg" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path
                                                d="M12 12c2.761 0 5-2.239 5-5S14.761 2 12 2 7 4.239 7 7s2.239 5 5 5z" />
                                            <path d="M5 22v-2a7 7 0 0114 0v2" />
                                        </svg>
                                    </div>

                                    {{-- CONTENT --}}
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="text-sm font-semibold text-gray-700">Role</label>
                                            <span
                                                class="filled-badge hidden text-xs font-semibold bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-md">
                                                ✓ Dipilih
                                            </span>
                                        </div>

                                        <select name="role"
                                            class="field-input w-full text-base text-gray-900 border-none py-1 bg-transparent">

                                            <option value="">-- Pilih Role --</option>

                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                                Admin
                                            </option>

                                            {{-- <option value="superadmin"
                                                {{ old('role') == 'superadmin' ? 'selected' : '' }}>
                                                Super Admin
                                            </option> --}}

                                            <option value="penulis" {{ old('role') == 'penulis' ? 'selected' : '' }}>
                                                Penulis
                                            </option>

                                            <option value="bendahara"
                                                {{ old('role') == 'bendahara' ? 'selected' : '' }}>
                                                Bendahara
                                            </option>
                                        </select>

                                        @error('role')
                                            <p class="text-red-500 text-xs mt-1 font-medium">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Footer --}}
                        <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-between">
                            <span id="footer-status" class="text-sm text-gray-500">Isi field yang diperlukan</span>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.manage-user') }}"
                                    class="text-sm px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 transition font-medium">Batal</a>
                                <button type="submit"
                                    class="flex items-center gap-2 text-sm px-6 py-2.5 rounded-xl bg-black text-white font-semibold hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/20 transition-all duration-300 active:scale-95">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan Akun
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

                    {{-- User Card Preview --}}
                    <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden shadow-sm">
                        <div class="p-6">

                            {{-- Avatar + Name + Role --}}
                            <div class="flex items-center gap-4 mb-5">
                                <div id="preview-avatar"
                                    class="w-14 h-14 rounded-2xl bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center text-xl font-bold text-gray-500 shrink-0 transition-all duration-300">
                                    ?
                                </div>
                                <div class="min-w-0">
                                    <h3 id="preview-name" class="text-lg font-semibold text-gray-900 truncate">Nama
                                        Akun</h3>
                                    <span id="preview-role-badge"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full bg-violet-100 text-violet-700 mt-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-violet-500"></span>
                                        Admin
                                    </span>
                                </div>
                            </div>

                            <div class="space-y-3">
                                {{-- Email row --}}
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path
                                                d="M4 4h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                            <polyline points="22,6 12,13 2,6" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-400 font-medium">Email</p>
                                        <p id="preview-email" class="text-sm text-gray-700 font-medium truncate">—</p>
                                    </div>
                                </div>

                                {{-- Password row --}}
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <rect x="3" y="11" width="18" height="11" rx="2"
                                                ry="2" />
                                            <path d="M7 11V7a5 5 0 0110 0v4" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-400 font-medium">Password</p>
                                        <p id="preview-password"
                                            class="text-sm text-gray-700 font-medium tracking-widest">——</p>
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
        // ── Name sync ──────────────────────────────────────────────
        function syncName(val) {
            const trimmed = val.trim();
            const nameEl = document.getElementById('preview-name');
            const avatarEl = document.getElementById('preview-avatar');

            nameEl.textContent = trimmed || 'Nama Akun';

            if (trimmed) {
                const initials = trimmed.split(' ').slice(0, 2).map(w => w[0].toUpperCase()).join('');
                avatarEl.textContent = initials;
                avatarEl.className =
                    'w-14 h-14 rounded-2xl flex items-center justify-center text-xl font-bold shrink-0 transition-all duration-300 bg-gradient-to-br from-gray-800 to-gray-600 text-white';
            } else {
                avatarEl.textContent = '?';
                avatarEl.className =
                    'w-14 h-14 rounded-2xl flex items-center justify-center text-xl font-bold text-gray-500 shrink-0 transition-all duration-300 bg-gradient-to-br from-gray-200 to-gray-300';
            }
            updateCompletion();
        }

        // ── Email sync ─────────────────────────────────────────────
        function syncEmail(val) {
            document.getElementById('preview-email').textContent = val.trim() || '—';
            updateCompletion();
        }

        // ── Password sync (mask) ───────────────────────────────────
        document.getElementById('password-input').addEventListener('input', function() {
            const len = this.value.length;
            document.getElementById('preview-password').textContent = len > 0 ?
                '•'.repeat(Math.min(len, 12)) :
                '——';
            updateCompletion();
        });

        // ── Password toggle ────────────────────────────────────────
        function togglePassword() {
            const inp = document.getElementById('password-input');
            const eye = document.getElementById('eye-icon');
            const eyeOff = document.getElementById('eye-off-icon');
            if (inp.type === 'password') {
                inp.type = 'text';
                eye.classList.add('hidden');
                eyeOff.classList.remove('hidden');
            } else {
                inp.type = 'password';
                eye.classList.remove('hidden');
                eyeOff.classList.add('hidden');
            }
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
    </script>

</x-app-layout>
