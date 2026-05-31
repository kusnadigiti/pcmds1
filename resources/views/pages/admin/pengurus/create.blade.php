<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-medium mb-0.5">Kelola</p>
                <h2 class="text-lg font-bold text-gray-900 dm">Tambah Pengurus Baru</h2>
            </div>
            <a href="{{ route('admin.pengurus.index') }}"
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
        .dm {
            font-family: 'DM Sans', sans-serif;
        }

        .card-field {
            transition: all .3s cubic-bezier(.4, 0, .2, 1);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .card-field::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            opacity: 0;
            transition: opacity .3s ease;
            z-index: 1;
            pointer-events: none;
        }

        .card-field.focused {
            border-color: #000 !important;
            box-shadow: 0 12px 24px rgba(0, 0, 0, .08), 0 0 0 3px rgba(0, 0, 0, .05) !important;
            transform: translateY(-2px) !important;
        }

        .card-field.focused::before {
            opacity: 1;
        }

        .card-field.focused .icon-badge {
            background: #000 !important;
            transform: scale(1.05);
        }

        .card-field.focused .icon-svg {
            color: #fff !important;
        }

        .field-input {
            outline: none;
            background: transparent;
            width: 100%;
            resize: none;
            border: none;
            transition: all .2s ease;
            line-height: 1.4;
        }

        .field-input::placeholder {
            color: #a0a0a0;
        }

        .filled-badge {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(12px)
            }
            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .au {
            animation: slideUp .4s cubic-bezier(.4, 0, .2, 1) both;
        }

        .d1 { animation-delay: .05s; }
        .d2 { animation-delay: .10s; }
        .d3 { animation-delay: .15s; }
        .d4 { animation-delay: .20s; }
        .d5 { animation-delay: .25s; }
        .d6 { animation-delay: .30s; }
        .d7 { animation-delay: .35s; }
        .d8 { animation-delay: .40s; }

        .toggle-group {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .field-input.select-custom {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23a0a0a0' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1rem;
            padding-right: 2.5rem;
        }

        form { position: relative; z-index: 2; }
        button[type="submit"] { position: relative; z-index: 10; cursor: pointer; }
    </style>

    <div class="bg-gradient-to-br from-slate-50 to-slate-100 dm py-8 px-4 sm:px-6">
        <div class="max-w-5xl mx-auto">

            {{-- Compact Completion Header --}}
            <div class="flex items-center justify-between mb-8 pb-6 border-b border-slate-200/70">
                <p class="text-xs text-slate-500 font-medium">Lengkapi form untuk hasil terbaik</p>
                <div class="flex items-center gap-2 bg-slate-900/90 text-white text-xs font-semibold px-4 py-2 rounded-xl shadow-md backdrop-blur-sm">
                    <svg class="w-4 h-4" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="1.5" />
                        <circle id="completion-ring" cx="12" cy="12" r="9" fill="none" stroke="white" stroke-width="1.5" stroke-dasharray="56.5" stroke-dashoffset="56.5" transform="rotate(-90 12 12)" stroke-linecap="round" />
                    </svg>
                    <span id="completion-text" class="min-w-[45px]">0%</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start w-full">

                {{-- ===== MAIN FORM ===== --}}
                <div class="lg:col-span-1">
                    <form action="{{ route('admin.pengurus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        {{-- Organisasi --}}
                        <div class="card-field au d1 bg-white/90 backdrop-blur-sm border border-slate-200/70 rounded-2xl p-6 shadow-lg hover:shadow-xl">
                            <div class="flex items-start gap-4 relative z-10">
                                <div class="icon-badge w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-5 h-5 text-slate-600 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0 w-full">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <label class="text-sm font-semibold text-slate-900">Organisasi <span class="text-red-500">*</span></label>
                                        <span class="filled-badge hidden text-xs px-2 py-0.5 rounded-lg font-bold">✓</span>
                                    </div>
                                    <select name="organisasi_otonom_id" required
                                        class="field-input text-base text-slate-900 h-12 pr-10 w-full select-custom"
                                        onchange="updateField(this.closest('.card-field'), this.value)">
                                        <option value="">Pilih organisasi...</option>
                                        @foreach($organisasis as $org)
                                            <option value="{{ $org->id }}" {{ old('organisasi_otonom_id') == $org->id ? 'selected' : '' }}>
                                                {{ $org->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('organisasi_otonom_id')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Nama --}}
                        <div class="card-field au d2 bg-white/90 backdrop-blur-sm border border-slate-200/70 rounded-2xl p-6 shadow-lg hover:shadow-xl">
                            <div class="flex items-start gap-4 relative z-10">
                                <div class="icon-badge w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-5 h-5 text-slate-600 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0 w-full">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <label class="text-sm font-semibold text-slate-900">Nama Lengkap <span class="text-red-500">*</span></label>
                                        <span class="filled-badge hidden text-xs px-2 py-0.5 rounded-lg font-bold">✓</span>
                                    </div>
                                    <input type="text" name="nama" value="{{ old('nama') }}" maxlength="200" required
                                        placeholder="Masukkan nama lengkap"
                                        class="field-input text-base text-slate-900 h-12 pr-3 w-full"
                                        oninput="updateField(this.closest('.card-field'), this.value)" />
                                    @error('nama')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Jabatan & Level --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 au d3">
                            <div class="card-field bg-white/90 backdrop-blur-sm border border-slate-200/70 rounded-2xl p-6 shadow-lg hover:shadow-xl">
                                <div class="flex items-start gap-4 relative z-10">
                                    <div class="icon-badge w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 mt-0.5">
                                        <svg class="w-5 h-5 text-slate-600 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0 w-full">
                                        <div class="flex items-center justify-between mb-1.5">
                                            <label class="text-sm font-semibold text-slate-900">Jabatan <span class="text-red-500">*</span></label>
                                            <span class="filled-badge hidden text-xs px-2 py-0.5 rounded-lg font-bold">✓</span>
                                        </div>
                                        <input type="text" name="jabatan" value="{{ old('jabatan') }}" maxlength="100" required
                                            placeholder="Contoh: Ketua, Sekretaris"
                                            class="field-input text-base text-slate-900 h-12 pr-3 w-full"
                                            oninput="updateField(this.closest('.card-field'), this.value)" />
                                    </div>
                                </div>
                            </div>

                            <div class="card-field bg-white/90 backdrop-blur-sm border border-slate-200/70 rounded-2xl p-6 shadow-lg hover:shadow-xl">
                                <div class="flex items-start gap-4 relative z-10">
                                    <div class="icon-badge w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 mt-0.5">
                                        <svg class="w-5 h-5 text-slate-600 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M3 6h18M9 6v12m6-12v12M4 21h16a2 2 0 002-2V5a2 2 0 00-2-2H4a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0 w-full">
                                        <div class="flex items-center justify-between mb-1.5">
                                            <label class="text-sm font-semibold text-slate-900">Level <span class="text-red-500">*</span></label>
                                            <span class="filled-badge hidden text-xs px-2 py-0.5 rounded-lg font-bold">✓</span>
                                        </div>
                                        <select name="level" required
                                            class="field-input text-base text-slate-900 h-12 pr-10 w-full select-custom"
                                            onchange="updateField(this.closest('.card-field'), this.value)">
                                            <option value="">Pilih level...</option>
                                            <option value="inti" {{ old('level') == 'inti' ? 'selected' : '' }}>Inti</option>
                                            <option value="majelis" {{ old('level') == 'majelis' ? 'selected' : '' }}>Majelis</option>
                                            <option value="lembaga" {{ old('level') == 'lembaga' ? 'selected' : '' }}>Lembaga</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Bidang --}}
                        <div class="card-field au d4 bg-white/90 backdrop-blur-sm border border-slate-200/70 rounded-2xl p-6 shadow-lg hover:shadow-xl">
                            <div class="flex items-start gap-4 relative z-10">
                                <div class="icon-badge w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-slate-600 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0 w-full">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <label class="text-sm font-semibold text-slate-900">Bidang</label>
                                        <span class="filled-badge hidden text-xs px-2 py-0.5 rounded-lg font-bold">✓</span>
                                    </div>
                                    <input type="text" name="bidang" value="{{ old('bidang') }}" maxlength="100"
                                        placeholder="Contoh: Pendidikan, Kesehatan"
                                        class="field-input text-base text-slate-900 h-12 pr-3 w-full"
                                        oninput="updateField(this.closest('.card-field'), this.value)" />
                                </div>
                            </div>
                        </div>

                        {{-- Periode Mulai & Selesai --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 au d5">
                            <div class="card-field bg-white/90 backdrop-blur-sm border border-slate-200/70 rounded-2xl p-6 shadow-lg hover:shadow-xl">
                                <div class="flex items-start gap-4 relative z-10">
                                    <div class="icon-badge w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center mt-0.5">
                                        <svg class="w-5 h-5 text-slate-600 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0 w-full">
                                        <div class="flex items-center justify-between mb-1.5">
                                            <label class="text-sm font-semibold text-slate-900">Periode Mulai <span class="text-red-500">*</span></label>
                                            <span class="filled-badge hidden text-xs px-2 py-0.5 rounded-lg font-bold">✓</span>
                                        </div>
                                        <input type="number" name="periode_mulai" value="{{ old('periode_mulai') }}" required
                                            placeholder="2024" min="1900" max="2100"
                                            class="field-input text-base text-slate-900 h-12 pr-3 w-full"
                                            oninput="updateField(this.closest('.card-field'), this.value)" />
                                        @error('periode_mulai')
                                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-field bg-white/90 backdrop-blur-sm border border-slate-200/70 rounded-2xl p-6 shadow-lg hover:shadow-xl">
                                <div class="flex items-start gap-4 relative z-10">
                                    <div class="icon-badge w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center mt-0.5">
                                        <svg class="w-5 h-5 text-slate-600 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0 w-full">
                                        <div class="flex items-center justify-between mb-1.5">
                                            <label class="text-sm font-semibold text-slate-900">Periode Selesai <span class="text-red-500">*</span></label>
                                            <span class="filled-badge hidden text-xs px-2 py-0.5 rounded-lg font-bold">✓</span>
                                        </div>
                                        <input type="number" name="periode_selesai" value="{{ old('periode_selesai') }}" required
                                            placeholder="2029" min="1900" max="2100"
                                            class="field-input text-base text-slate-900 h-12 pr-3 w-full"
                                            oninput="updateField(this.closest('.card-field'), this.value)" />
                                        @error('periode_selesai')
                                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- No HP & Email --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 au d6">
                            <div class="card-field bg-white/90 backdrop-blur-sm border border-slate-200/70 rounded-2xl p-6 shadow-lg hover:shadow-xl">
                                <div class="flex items-start gap-4 relative z-10">
                                    <div class="icon-badge w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center mt-0.5">
                                        <svg class="w-5 h-5 text-slate-600 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0 w-full">
                                        <label class="text-sm font-semibold text-slate-900 mb-1.5 block">No. HP</label>
                                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" maxlength="20"
                                            placeholder="08123456789"
                                            class="field-input text-base text-slate-900 h-12 pr-3 w-full"
                                            oninput="updateField(this.closest('.card-field'), this.value)" />
                                        @error('no_hp')
                                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-field bg-white/90 backdrop-blur-sm border border-slate-200/70 rounded-2xl p-6 shadow-lg hover:shadow-xl">
                                <div class="flex items-start gap-4 relative z-10">
                                    <div class="icon-badge w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center mt-0.5">
                                        <svg class="w-5 h-5 text-slate-600 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0 w-full">
                                        <label class="text-sm font-semibold text-slate-900 mb-1.5 block">Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}" maxlength="100"
                                            placeholder="email@example.com"
                                            class="field-input text-base text-slate-900 h-12 pr-3 w-full"
                                            oninput="updateField(this.closest('.card-field'), this.value)" />
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Urutan --}}
                        <div class="card-field au d7 bg-white/90 backdrop-blur-sm border border-slate-200/70 rounded-2xl p-6 shadow-lg hover:shadow-xl">
                            <div class="flex items-start gap-4 relative z-10">
                                <div class="icon-badge w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-slate-600 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0 w-full">
                                    <label class="text-sm font-semibold text-slate-900 mb-1.5 block">Urutan Tampil</label>
                                    <input type="number" name="urutan" value="{{ old('urutan', 0) }}" min="0"
                                        placeholder="0 (paling atas)"
                                        class="field-input text-base text-slate-900 h-12 pr-3 w-full"
                                        oninput="updateField(this.closest('.card-field'), this.value)" />
                                    <p class="text-xs text-slate-400 mt-1">Semakin kecil angka, semakin atas tampilannya</p>
                                </div>
                            </div>
                        </div>

                        {{-- Foto --}}
                        <div class="card-field au d7 bg-white/90 backdrop-blur-sm border border-slate-200/70 rounded-2xl p-6 shadow-lg hover:shadow-xl">
                            <div class="flex items-start gap-4 relative z-10">
                                <div class="icon-badge w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-slate-600 icon-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0 w-full">
                                    <label class="text-sm font-semibold text-slate-900 mb-1.5 block">Foto</label>
                                    <input type="file" name="foto" accept=".png,.jpg,.jpeg"
                                        class="text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200" />
                                    <p class="text-xs text-slate-400 mt-1">Format: png, jpg | Max: 2MB</p>
                                    @error('foto')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Status Toggle --}}
                        <div class="card-field au d8 bg-gradient-to-r from-slate-50 to-slate-100 border border-slate-200/60 rounded-2xl p-6 shadow-lg hover:shadow-xl">
                            <div class="flex items-center justify-between relative z-10">
                                <div>
                                    <div class="text-sm font-semibold text-slate-900">Status Aktif</div>
                                    <div class="text-xs text-slate-500">Tampil di halaman publik</div>
                                </div>
                                <label class="relative z-20 inline-flex items-center cursor-pointer group">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" id="status-toggle" name="is_active" value="1"
                                        {{ old('is_active', true) ? 'checked' : '' }} class="sr-only toggle-checkbox">
                                    <div id="toggle-slider"
                                        class="toggle-group w-11 h-6 bg-slate-200 rounded-full transition-all duration-300 ease-in-out relative overflow-hidden group-hover:shadow-md">
                                        <span id="toggle-knob"
                                            class="w-5 h-5 bg-white rounded-full shadow-sm absolute left-0.5 top-0.5 transition-all duration-300 ease-in-out block transform-gpu"></span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- Footer Actions --}}
                        <div class="pt-8 border-t border-slate-200/50 flex flex-col sm:flex-row items-center justify-between gap-3">
                            <span id="footer-status" class="text-xs text-slate-500 font-medium">8 field wajib</span>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.pengurus.index') }}"
                                    class="text-xs font-semibold px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 hover:shadow-md transition-all duration-200">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="flex items-center gap-1.5 text-xs font-bold px-6 py-2.5 rounded-xl bg-slate-900 text-white hover:bg-slate-800 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 shadow-md">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- ===== MINI PROGRESS ===== --}}
                <div class="lg:block hidden lg:sticky lg:top-20 space-y-4 lg:col-span-1 lg:ml-8">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest">Progress</p>
                    </div>
                    <div class="bg-white/70 backdrop-blur-sm border border-slate-200/50 rounded-2xl p-5 shadow-lg">
                        <div class="space-y-2 text-xs">
                            @foreach (['organisasi' => 'Organisasi', 'nama' => 'Nama', 'jabatan' => 'Jabatan', 'level' => 'Level', 'periode' => 'Periode', 'status' => 'Status'] as $key => $label)
                                <div class="flex items-center justify-between text-slate-700 font-medium">
                                    <span>{{ $label }}</span>
                                    <span class="filled-check hidden flex items-center gap-1 text-emerald-600 text-xs">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                                        </svg>
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const CIRCUMFERENCE = 56.5;

        function updateField(card, value) {
            const badge = card.querySelector('.filled-badge');
            const isFilled = value !== null && value !== undefined && value.toString().trim().length > 0;

            if (badge) {
                badge.classList.toggle('hidden', !isFilled);
            }
            updateCompletion();
        }

        function updateToggleVisual(checkbox) {
            const toggleSlider = checkbox.parentElement.querySelector('#toggle-slider') || checkbox.closest('label')?.querySelector('#toggle-slider');
            const toggleKnob = checkbox.parentElement.querySelector('#toggle-knob') || checkbox.closest('label')?.querySelector('#toggle-knob');

            if (checkbox.checked) {
                if (toggleSlider) toggleSlider.classList.add('bg-emerald-600');
                if (toggleSlider) toggleSlider.classList.remove('bg-slate-200');
                if (toggleKnob) toggleKnob.style.transform = 'translateX(20px)';
            } else {
                if (toggleSlider) toggleSlider.classList.remove('bg-emerald-600');
                if (toggleSlider) toggleSlider.classList.add('bg-slate-200');
                if (toggleKnob) toggleKnob.style.transform = 'translateX(0px)';
            }
        }

        function toggleStatus(checkbox) {
            const card = checkbox.closest('.card-field');
            updateToggleVisual(checkbox);
            updateField(card, checkbox.checked ? '1' : '0');
        }

        function updateCompletion() {
            let filledCount = 0;

            const organisasiSelect = document.querySelector('select[name="organisasi_otonom_id"]');
            if (organisasiSelect && organisasiSelect.value !== '') filledCount++;

            const namaInput = document.querySelector('input[name="nama"]');
            if (namaInput && namaInput.value.trim() !== '') filledCount++;

            const jabatanInput = document.querySelector('input[name="jabatan"]');
            if (jabatanInput && jabatanInput.value.trim() !== '') filledCount++;

            const levelSelect = document.querySelector('select[name="level"]');
            if (levelSelect && levelSelect.value !== '') filledCount++;

            const periodeMulai = document.querySelector('input[name="periode_mulai"]');
            const periodeSelesai = document.querySelector('input[name="periode_selesai"]');
            if (periodeMulai && periodeMulai.value.trim() !== '' && periodeSelesai && periodeSelesai.value.trim() !== '') {
                filledCount++;
            }

            const statusCheckbox = document.getElementById('status-toggle');
            if (statusCheckbox && statusCheckbox.checked) filledCount++;

            const totalFields = 6;
            const pct = Math.round((filledCount / totalFields) * 100);

            const completionText = document.getElementById('completion-text');
            const completionRing = document.getElementById('completion-ring');
            const footerStatus = document.getElementById('footer-status');

            if (completionText) completionText.textContent = pct + '%';
            if (completionRing) completionRing.style.strokeDashoffset = CIRCUMFERENCE * (1 - pct / 100);
            if (footerStatus) footerStatus.textContent = (totalFields - filledCount) + ' field wajib tersisa';

            updateProgressChecklist({
                organisasi: filledCount >= 1,
                nama: filledCount >= 2,
                jabatan: filledCount >= 3,
                level: filledCount >= 4,
                periode: filledCount >= 5,
                status: filledCount >= 6
            });
        }

        function updateProgressChecklist(states) {
            const checks = document.querySelectorAll('.filled-check');
            if (checks[0]) checks[0].classList.toggle('hidden', !states.organisasi);
            if (checks[1]) checks[1].classList.toggle('hidden', !states.nama);
            if (checks[2]) checks[2].classList.toggle('hidden', !states.jabatan);
            if (checks[3]) checks[3].classList.toggle('hidden', !states.level);
            if (checks[4]) checks[4].classList.toggle('hidden', !states.periode);
            if (checks[5]) checks[5].classList.toggle('hidden', !states.status);
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.field-input').forEach(input => {
                const card = input.closest('.card-field');
                input.addEventListener('focus', () => card.classList.add('focused'));
                input.addEventListener('blur', () => card.classList.remove('focused'));
                input.addEventListener('input', () => updateField(card, input.value));
            });

            document.querySelectorAll('select').forEach(select => {
                select.addEventListener('change', e => updateField(e.target.closest('.card-field'), e.target.value));
            });

            const statusCheckbox = document.getElementById('status-toggle');
            if (statusCheckbox) {
                const statusCard = statusCheckbox.closest('.card-field');
                updateToggleVisual(statusCheckbox);
                statusCheckbox.addEventListener('change', function() {
                    toggleStatus(this);
                    statusCard.classList.add('focused');
                    setTimeout(() => statusCard.classList.remove('focused'), 200);
                });
            }

            updateCompletion();
        });
    </script>
</x-app-layout>
