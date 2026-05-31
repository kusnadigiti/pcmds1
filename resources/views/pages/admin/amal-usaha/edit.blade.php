<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-medium mb-0.5">Kelola</p>
                <h2 class="text-lg font-bold text-gray-900 dm">Edit Amal Usaha</h2>
            </div>
            <a href="{{ route('admin.amal-usaha.index') }}"
                class="flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-900 transition-all duration-200 font-medium group">
                <svg class="w-3.5 h-3.5 group-hover:-translate-x-1 transition-all" fill="none" stroke="currentColor"
                    stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        .dm { font-family: 'DM Sans', sans-serif; }

        .card-field {
            transition: all .3s cubic-bezier(.4,0,.2,1);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        .card-field::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            opacity: 0;
            transition: opacity .3s ease;
            z-index: 0;
            pointer-events: none;
        }
        .card-field.focused {
            border-color: #000 !important;
            box-shadow: 0 12px 24px rgba(0,0,0,.08), 0 0 0 3px rgba(0,0,0,.05) !important;
            transform: translateY(-2px) !important;
        }
        .card-field.focused::before { opacity: 1; }
        .card-field.focused .icon-badge { background: #000 !important; transform: scale(1.05); }
        .card-field.focused .icon-svg { color: #fff !important; }

        /* Changed state — amber accent */
        .card-field.changed {
            border-color: #f59e0b !important;
            box-shadow: 0 0 0 3px rgba(245,158,11,.08) !important;
        }
        .card-field.changed .icon-badge { background: #fef3c7 !important; }
        .card-field.changed .icon-svg  { color: #d97706 !important; }

        .field-input {
            outline: none;
            background: transparent;
            width: 100%;
            resize: none;
            border: none;
            transition: all .2s ease;
            line-height: 1.4;
            position: relative;
            z-index: 2;
        }
        .field-input::placeholder { color: #a0a0a0; }

        .filled-badge { background: linear-gradient(135deg, #10b981, #059669); color: white; }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(12px) }
            to   { opacity: 1; transform: translateY(0) }
        }
        .au { animation: slideUp .4s cubic-bezier(.4,0,.2,1) both; }
        .d1 { animation-delay: .05s; }
        .d2 { animation-delay: .10s; }
        .d3 { animation-delay: .15s; }
        .d4 { animation-delay: .20s; }
        .d5 { animation-delay: .25s; }
        .d6 { animation-delay: .30s; }

        .field-input.select-custom {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23a0a0a0' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1rem;
            padding-right: 2.5rem;
            -webkit-appearance: none;
            appearance: none;
        }

        /* Changed indicator dot on card */
        .change-dot {
            width: 7px; height: 7px;
            background: #f59e0b;
            border-radius: 50%;
            display: none;
            animation: pulse-dot .8s ease-in-out infinite alternate;
        }
        .card-field.changed .change-dot { display: inline-block; }

        @keyframes pulse-dot {
            from { opacity: .6; transform: scale(.9); }
            to   { opacity: 1;  transform: scale(1.15); }
        }

        form { position: relative; z-index: 2; }
        button[type="submit"] { position: relative; z-index: 10; cursor: pointer; }

        /* Diff badge */
        .diff-old {
            text-decoration: line-through;
            color: #ef4444;
            font-size: .65rem;
        }
        .diff-new {
            color: #10b981;
            font-size: .65rem;
            font-weight: 600;
        }
        .diff-container {
            display: none;
            gap: .25rem;
            align-items: center;
            flex-wrap: wrap;
            margin-top: .25rem;
        }
        .card-field.changed .diff-container { display: flex; }
    </style>

    <div class="bg-gradient-to-br from-slate-50 to-slate-100 dm py-8 px-4 sm:px-6">
        <div class="max-w-5xl mx-auto">

            {{-- Edit Mode Banner --}}
            <div class="flex items-center justify-between mb-8 pb-6 border-b border-slate-200/70">
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="inline-flex items-center gap-1.5 bg-amber-50 border border-amber-200 text-amber-700 text-xs font-semibold px-3 py-1.5 rounded-xl">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Mode Edit
                    </span>
                    <p class="text-xs text-slate-500 font-medium">Mengubah data: <span class="font-semibold text-slate-700">{{ $amalUsaha->nama }}</span></p>
                    <span id="changed-count-badge" class="hidden items-center gap-1 bg-amber-100 text-amber-700 text-xs font-bold px-2.5 py-1 rounded-full">
                        <span id="changed-count">0</span> perubahan
                    </span>
                </div>
                <div class="flex items-center gap-2 bg-slate-900/90 text-white text-xs font-semibold px-4 py-2 rounded-xl shadow-md backdrop-blur-sm">
                    <svg class="w-4 h-4" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="1.5" />
                        <circle id="completion-ring" cx="12" cy="12" r="9" fill="none" stroke="white" stroke-width="1.5"
                            stroke-dasharray="56.5" stroke-dashoffset="56.5"
                            transform="rotate(-90 12 12)" stroke-linecap="round" />
                    </svg>
                    <span id="completion-text" class="min-w-[45px]">0%</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start w-full">

                {{-- ===== EDIT FORM ===== --}}
                <div class="lg:col-span-1">
                    <form action="{{ route('admin.amal-usaha.update', $amalUsaha->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Organisasi --}}
                        <div class="card-field au d1 bg-white/90 backdrop-blur-sm border border-slate-200/70 rounded-2xl p-6 shadow-lg hover:shadow-xl"
                             data-field="organisasi" data-original="{{ $amalUsaha->organisasi_otonom_id }}">
                            <div class="flex items-start gap-4 relative z-10">
                                <div class="icon-badge w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 mt-0.5 transition-all duration-200">
                                    <svg class="w-5 h-5 text-slate-600 icon-svg transition-colors duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0 w-full">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <div class="flex items-center gap-1.5">
                                            <label class="text-sm font-semibold text-slate-900">Organisasi <span class="text-red-500">*</span></label>
                                            <span class="change-dot"></span>
                                        </div>
                                        <span class="filled-badge hidden text-xs px-2 py-0.5 rounded-lg font-bold">✓</span>
                                    </div>
                                    <select name="organisasi_otonom_id" required
                                        class="field-input select-custom text-base text-slate-900 h-12 w-full">
                                        <option value="">Pilih organisasi...</option>
                                        @foreach($organisasiOtonoms as $org)
                                            <option value="{{ $org->id }}"
                                                {{ (old('organisasi_otonom_id', $amalUsaha->organisasi_otonom_id) == $org->id) ? 'selected' : '' }}>
                                                {{ $org->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="diff-container">
                                        <span class="diff-old" data-diff="old"></span>
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        <span class="diff-new" data-diff="new"></span>
                                    </div>
                                    @error('organisasi_otonom_id')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Nama --}}
                        <div class="card-field au d2 bg-white/90 backdrop-blur-sm border border-slate-200/70 rounded-2xl p-6 shadow-lg hover:shadow-xl"
                             data-field="nama" data-original="{{ $amalUsaha->nama }}">
                            <div class="flex items-start gap-4 relative z-10">
                                <div class="icon-badge w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 mt-0.5 transition-all duration-200">
                                    <svg class="w-5 h-5 text-slate-600 icon-svg transition-colors duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0 w-full">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <div class="flex items-center gap-1.5">
                                            <label class="text-sm font-semibold text-slate-900">Nama Amal Usaha <span class="text-red-500">*</span></label>
                                            <span class="change-dot"></span>
                                        </div>
                                        <span class="filled-badge hidden text-xs px-2 py-0.5 rounded-lg font-bold">✓</span>
                                    </div>
                                    <input type="text" name="nama" value="{{ old('nama', $amalUsaha->nama) }}" maxlength="255" required
                                        placeholder="Masukkan nama amal usaha"
                                        class="field-input text-base text-slate-900 h-12 pr-3 w-full" />
                                    <div class="diff-container">
                                        <span class="diff-old" data-diff="old"></span>
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        <span class="diff-new" data-diff="new"></span>
                                    </div>
                                    @error('nama')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Tipe --}}
                        <div class="card-field au d3 bg-white/90 backdrop-blur-sm border border-slate-200/70 rounded-2xl p-6 shadow-lg hover:shadow-xl"
                             data-field="tipe" data-original="{{ $amalUsaha->tipe }}">
                            <div class="flex items-start gap-4 relative z-10">
                                <div class="icon-badge w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 mt-0.5 transition-all duration-200">
                                    <svg class="w-5 h-5 text-slate-600 icon-svg transition-colors duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0 w-full">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <div class="flex items-center gap-1.5">
                                            <label class="text-sm font-semibold text-slate-900">Tipe Bidang <span class="text-red-500">*</span></label>
                                            <span class="change-dot"></span>
                                        </div>
                                        <span class="filled-badge hidden text-xs px-2 py-0.5 rounded-lg font-bold">✓</span>
                                    </div>
                                    <select name="tipe" required
                                        class="field-input select-custom text-base text-slate-900 h-12 w-full">
                                        <option value="">Pilih tipe...</option>
                                        <option value="bidang_sosial"      {{ old('tipe', $amalUsaha->tipe) == 'bidang_sosial'      ? 'selected' : '' }}>Bidang Sosial</option>
                                        <option value="bidang_kesehatan"   {{ old('tipe', $amalUsaha->tipe) == 'bidang_kesehatan'   ? 'selected' : '' }}>Bidang Kesehatan</option>
                                        <option value="bidang_pendidikan"  {{ old('tipe', $amalUsaha->tipe) == 'bidang_pendidikan'  ? 'selected' : '' }}>Bidang Pendidikan</option>
                                    </select>
                                    <div class="diff-container">
                                        <span class="diff-old" data-diff="old"></span>
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        <span class="diff-new" data-diff="new"></span>
                                    </div>
                                    @error('tipe')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="card-field au d4 bg-white/90 backdrop-blur-sm border border-slate-200/70 rounded-2xl p-6 shadow-lg hover:shadow-xl"
                             data-field="deskripsi" data-original="{{ $amalUsaha->deskripsi }}">
                            <div class="flex items-start gap-4 relative z-10">
                                <div class="icon-badge w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 mt-0.5 transition-all duration-200">
                                    <svg class="w-5 h-5 text-slate-600 icon-svg transition-colors duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M4 6h16M4 12h16M4 18h12" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0 w-full">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <div class="flex items-center gap-1.5">
                                            <label class="text-sm font-semibold text-slate-900">Deskripsi</label>
                                            <span class="change-dot"></span>
                                        </div>
                                        <span class="filled-badge hidden text-xs px-2 py-0.5 rounded-lg font-bold">✓</span>
                                    </div>
                                    <textarea name="deskripsi" rows="4"
                                        placeholder="Tulis deskripsi singkat tentang amal usaha ini..."
                                        class="field-input text-base text-slate-900 pr-3 w-full pt-1">{{ old('deskripsi', $amalUsaha->deskripsi) }}</textarea>
                                    <div class="diff-container">
                                        <span class="diff-old" data-diff="old" style="max-width:140px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"></span>
                                        <svg class="w-3 h-3 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        <span class="diff-new" data-diff="new" style="max-width:140px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"></span>
                                    </div>
                                    @error('deskripsi')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Foto --}}
                        <div class="card-field au d5 bg-white/90 backdrop-blur-sm border border-slate-200/70 rounded-2xl p-6 shadow-lg hover:shadow-xl"
                             data-field="foto" data-original="{{ $amalUsaha->foto ?? '' }}">
                            <div class="flex items-start gap-4 relative z-10">
                                <div class="icon-badge w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center mt-0.5 transition-all duration-200">
                                    <svg class="w-5 h-5 text-slate-600 icon-svg transition-colors duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0 w-full">
                                    <div class="flex items-center gap-1.5 mb-1.5">
                                        <label class="text-sm font-semibold text-slate-900">Foto</label>
                                        <span class="change-dot"></span>
                                    </div>

                                    @if($amalUsaha->foto)
                                        <div class="flex items-center gap-3 mb-3 p-3 bg-slate-50 rounded-xl border border-slate-200">
                                            <img src="{{ asset('storage/' . $amalUsaha->foto) }}"
                                                alt="Foto saat ini"
                                                class="w-14 h-14 rounded-xl object-cover border border-slate-200 shadow-sm" />
                                            <div>
                                                <p class="text-xs font-semibold text-slate-700">Foto saat ini</p>
                                                <p class="text-xs text-slate-400">Upload baru untuk mengganti</p>
                                            </div>
                                            <span class="ml-auto inline-flex items-center gap-1 text-emerald-600 text-xs font-medium">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                                                </svg>
                                                Terpasang
                                            </span>
                                        </div>
                                    @endif

                                    <input type="file" name="foto" id="foto-input" accept=".png,.jpg,.jpeg,.webp"
                                        class="text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 w-full" />

                                    {{-- Preview foto baru --}}
                                    <div id="foto-preview-wrap" class="hidden mt-3 p-3 bg-emerald-50 rounded-xl border border-emerald-200">
                                        <p class="text-xs font-semibold text-emerald-700 mb-2 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                            Foto baru dipilih
                                        </p>
                                        <img id="foto-preview" src="" alt="Preview" class="w-20 h-20 rounded-xl object-cover border border-emerald-200 shadow-sm" />
                                    </div>

                                    <p class="text-xs text-slate-400 mt-1.5">
                                        {{ $amalUsaha->foto ? 'Kosongkan jika tidak ingin mengganti foto.' : 'Format: png, jpg, jpeg, webp | Max: 2MB' }}
                                    </p>
                                    @error('foto')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Footer Actions --}}
                        <div class="pt-8 border-t border-slate-200/50 flex flex-col sm:flex-row items-center justify-between gap-3">
                            <span id="footer-status" class="text-xs text-slate-500 font-medium"></span>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.amal-usaha.index') }}"
                                    class="text-xs font-semibold px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 hover:shadow-md transition-all duration-200">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="flex items-center gap-1.5 text-xs font-bold px-6 py-2.5 rounded-xl bg-slate-900 text-white hover:bg-slate-800 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 shadow-md">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- ===== SIDEBAR ===== --}}
                <div class="lg:block hidden lg:sticky lg:top-20 space-y-4 lg:col-span-1 lg:ml-8">

                    {{-- Progress --}}
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest">Progress</p>
                    </div>
                    <div class="bg-white/70 backdrop-blur-sm border border-slate-200/50 rounded-2xl p-5 shadow-lg">
                        <div class="space-y-2 text-xs" id="progress-checklist">
                            @foreach (['organisasi' => 'Organisasi', 'nama' => 'Nama', 'tipe' => 'Tipe', 'deskripsi' => 'Deskripsi'] as $key => $label)
                                <div class="flex items-center justify-between text-slate-700 font-medium" data-check="{{ $key }}">
                                    <span>{{ $label }}</span>
                                    <span class="filled-check hidden text-emerald-600">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                                        </svg>
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Perubahan --}}
                    <div class="bg-amber-50/80 backdrop-blur-sm border border-amber-200/60 rounded-2xl p-5 shadow-sm">
                        <p class="text-xs font-semibold text-amber-700 mb-3 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Data Sebelumnya
                        </p>
                        <div class="space-y-1.5 text-xs text-amber-800">
                            <div class="flex justify-between gap-2">
                                <span class="text-amber-600 shrink-0">Nama</span>
                                <span class="font-medium truncate max-w-[140px]">{{ $amalUsaha->nama }}</span>
                            </div>
                            <div class="flex justify-between gap-2">
                                <span class="text-amber-600 shrink-0">Tipe</span>
                                <span class="font-medium capitalize">{{ str_replace('_', ' ', $amalUsaha->tipe) }}</span>
                            </div>
                            <div class="flex justify-between gap-2">
                                <span class="text-amber-600 shrink-0">Organisasi</span>
                                <span class="font-medium truncate max-w-[120px]">{{ $amalUsaha->organisasiOtonom?->nama ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between gap-2">
                                <span class="text-amber-600 shrink-0">Deskripsi</span>
                                <span class="font-medium truncate max-w-[120px]">{{ $amalUsaha->deskripsi ? Str::limit($amalUsaha->deskripsi, 30) : '-' }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Changed fields log --}}
                    <div id="changes-log" class="hidden bg-white/70 backdrop-blur-sm border border-amber-200/40 rounded-2xl p-5 shadow-sm">
                        <p class="text-xs font-semibold text-amber-700 mb-3 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Field yang Diubah
                        </p>
                        <ul id="changes-list" class="space-y-1.5 text-xs text-slate-600"></ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        const CIRCUMFERENCE = 56.5;

        // Map select values to readable labels
        const tipeLabels = {
            'bidang_sosial': 'Bidang Sosial',
            'bidang_kesehatan': 'Bidang Kesehatan',
            'bidang_pendidikan': 'Bidang Pendidikan',
        };

        // Track which fields changed
        const changedFields = new Set();

        function getSelectLabel(select) {
            const opt = select.options[select.selectedIndex];
            return opt ? opt.text : '';
        }

        function formatDiff(fieldName, oldVal, newVal) {
            if (fieldName === 'tipe') {
                return { old: tipeLabels[oldVal] || oldVal, new: tipeLabels[newVal] || newVal };
            }
            if (fieldName === 'organisasi') {
                // For organisasi, we'll use select text
                return null; // handled separately via select label
            }
            return { old: oldVal, new: newVal };
        }

        function updateCardState(card) {
            const fieldName  = card.dataset.field;
            const originalVal = card.dataset.original;
            const input = card.querySelector('input:not([type=file]):not([type=hidden]), select, textarea');
            if (!input) return;

            const currentVal = input.value;
            const isChanged  = currentVal.toString().trim() !== originalVal.toString().trim();
            const isFilled   = currentVal.toString().trim() !== '';

            // Badge
            const badge = card.querySelector('.filled-badge');
            if (badge) badge.classList.toggle('hidden', !isFilled);

            // Changed state
            if (isChanged) {
                card.classList.add('changed');
                changedFields.add(fieldName);
            } else {
                card.classList.remove('changed');
                changedFields.delete(fieldName);
            }

            // Diff preview
            const diffOld = card.querySelector('[data-diff="old"]');
            const diffNew = card.querySelector('[data-diff="new"]');
            if (diffOld && diffNew && isChanged) {
                if (input.tagName === 'SELECT') {
                    const origOpt = Array.from(input.options).find(o => o.value === originalVal);
                    diffOld.textContent = origOpt ? origOpt.text : originalVal || '(kosong)';
                    diffNew.textContent = getSelectLabel(input);
                } else {
                    const truncate = s => s.length > 35 ? s.slice(0, 35) + '…' : s;
                    diffOld.textContent = originalVal ? truncate(originalVal) : '(kosong)';
                    diffNew.textContent = truncate(currentVal);
                }
            }

            updateChangesLog();
            updateCompletion();
        }

        function updateChangesLog() {
            const log  = document.getElementById('changes-log');
            const list = document.getElementById('changes-list');
            const badge = document.getElementById('changed-count-badge');
            const countEl = document.getElementById('changed-count');

            if (!log || !list) return;

            if (changedFields.size === 0) {
                log.classList.add('hidden');
                badge.classList.add('hidden');
                return;
            }

            log.classList.remove('hidden');
            badge.classList.remove('hidden');
            if (countEl) countEl.textContent = changedFields.size;

            const fieldNames = {
                organisasi: 'Organisasi', nama: 'Nama', tipe: 'Tipe',
                deskripsi: 'Deskripsi', foto: 'Foto',
            };

            list.innerHTML = '';
            changedFields.forEach(f => {
                const li = document.createElement('li');
                li.className = 'flex items-center gap-1.5 text-amber-700 font-medium';
                li.innerHTML = `<span class="w-1.5 h-1.5 bg-amber-400 rounded-full inline-block"></span>${fieldNames[f] || f}`;
                list.appendChild(li);
            });
        }

        function updateCompletion() {
            const org     = document.querySelector('select[name="organisasi_otonom_id"]');
            const nama    = document.querySelector('input[name="nama"]');
            const tipe    = document.querySelector('select[name="tipe"]');
            const desc    = document.querySelector('textarea[name="deskripsi"]');

            const checks = {
                organisasi: org  && org.value  !== '',
                nama:       nama && nama.value.trim() !== '',
                tipe:       tipe && tipe.value !== '',
                deskripsi:  desc && desc.value.trim() !== '',
            };

            const required = ['organisasi','nama','tipe'];
            const filled   = required.filter(k => checks[k]).length;
            const total    = required.length;
            const pct      = Math.round((filled / total) * 100);

            const ring   = document.getElementById('completion-ring');
            const text   = document.getElementById('completion-text');
            const footer = document.getElementById('footer-status');

            if (ring)   ring.style.strokeDashoffset = CIRCUMFERENCE * (1 - pct / 100);
            if (text)   text.textContent = pct + '%';

            const remaining = total - filled;
            if (footer) {
                footer.textContent = remaining === 0
                    ? '✓ Semua field wajib terisi'
                    : remaining + ' field wajib tersisa';
            }

            // Checklist sidebar
            Object.entries(checks).forEach(([key, val]) => {
                const row = document.querySelector(`[data-check="${key}"]`);
                if (!row) return;
                const ic = row.querySelector('.filled-check');
                if (ic) ic.classList.toggle('hidden', !val);
            });

            // Sync badges
            document.querySelectorAll('.card-field').forEach(card => {
                const inputs = card.querySelectorAll('input:not([type=hidden]):not([type=file]):not([type=checkbox]), select, textarea');
                const badge  = card.querySelector('.filled-badge');
                if (!badge || !inputs.length) return;
                let filled = false;
                inputs.forEach(i => { if (i.value && i.value.trim() !== '') filled = true; });
                badge.classList.toggle('hidden', !filled);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Attach events to all card-field inputs
            document.querySelectorAll('.card-field').forEach(card => {
                const inputs = card.querySelectorAll('input:not([type=file]):not([type=hidden]), select, textarea');
                inputs.forEach(input => {
                    input.addEventListener('focus', () => card.classList.add('focused'));
                    input.addEventListener('blur',  () => card.classList.remove('focused'));
                    input.addEventListener('input',  () => updateCardState(card));
                    input.addEventListener('change', () => updateCardState(card));
                });
            });

            // Foto file input
            const fotoInput = document.getElementById('foto-input');
            if (fotoInput) {
                fotoInput.addEventListener('change', function () {
                    const card = this.closest('.card-field');
                    const wrap = document.getElementById('foto-preview-wrap');
                    const preview = document.getElementById('foto-preview');

                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = e => {
                            if (preview) { preview.src = e.target.result; }
                            if (wrap) wrap.classList.remove('hidden');
                        };
                        reader.readAsDataURL(this.files[0]);

                        card.classList.add('changed');
                        changedFields.add('foto');
                        updateChangesLog();
                    } else {
                        if (wrap) wrap.classList.add('hidden');
                        card.classList.remove('changed');
                        changedFields.delete('foto');
                        updateChangesLog();
                    }
                });
            }

            // Initial run to reflect pre-filled values
            updateCompletion();
        });
    </script>
</x-app-layout>
