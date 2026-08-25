<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Menu Navbar</h2>
    </x-slot>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

    <style>
        .sortable-ghost { opacity: 0.25; border: 2px dashed #93c5fd; background: #eff6ff; }
        .sortable-chosen { box-shadow: 0 4px 16px rgba(0,0,0,0.1); }
        .spin { width: 13px; height: 13px; border: 2px solid rgba(255,255,255,.3); border-top-color: #fff; border-radius: 50%; animation: sp .5s linear infinite; display: inline-block; }
        @keyframes sp { to { transform: rotate(360deg); } }
    </style>

    <div class="max-w-3xl mx-auto px-5 py-8 font-sans">

        {{-- Top bar --}}
        <div class="flex flex-wrap justify-between items-center gap-3 mb-5">
            <div>
                <h1 class="text-xl font-bold text-gray-900 m-0">Kelola Menu Navbar</h1>
                <p class="text-xs text-gray-500 mt-1 m-0">Atur susunan, nama, dan visibilitas menu navigasi situs utama.</p>
            </div>
            <div class="flex gap-2">
                <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-200 text-sm font-semibold py-2 px-3.5 rounded-lg inline-flex items-center gap-1.5 transition-colors" onclick="openPreviewModal()">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                    Lihat Preview
                </button>
                <button class="bg-[#0d5c3a] hover:bg-[#0a4a2d] text-white text-sm font-semibold py-2 px-3.5 rounded-lg inline-flex items-center gap-1.5 transition-colors shadow-sm" onclick="openAddModal(null, null)">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                    Tambah Menu
                </button>
            </div>
        </div>

        {{-- Alert --}}
        @if(session('success'))
            <div class="bg-emerald-100 text-emerald-800 border border-emerald-300 px-4 py-3 rounded-lg text-sm font-medium mb-4 flex items-center gap-2">
                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 flex-shrink-0"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Unsaved order bar --}}
        <div id="unsaved-bar" class="hidden bg-amber-50 border border-amber-300 rounded-lg px-4 py-2.5 mb-4 items-center justify-between gap-2 text-sm text-amber-800 font-medium">
            <span class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 flex-shrink-0 animate-ping"></span> 
                Ada perubahan urutan menu yang belum disimpan
            </span>
            <button class="bg-[#0d5c3a] hover:bg-[#0a4a2d] text-white text-[13px] font-semibold py-1 px-3 rounded-md transition-colors shadow-sm" id="save-btn" onclick="saveOrder()">Simpan Urutan</button>
        </div>

        {{-- Menu tree --}}
        @if($menus->isEmpty())
            <div class="text-center py-10 px-4 text-gray-400 bg-white border border-gray-200 rounded-xl">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-10 h-10 mx-auto mb-2.5 opacity-40"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <p class="text-sm m-0">Belum ada menu. Klik <strong class="font-semibold text-gray-600">"Tambah Menu"</strong> untuk mulai.</p>
            </div>
        @else
            <ul class="space-y-1.5" id="root-list">
                @foreach($menus as $m)
                    @php
                        $isOrtomMenu = Str::contains(strtolower($m->label), 'otonom');
                    @endphp
                    <li class="bg-white border border-gray-200 rounded-xl transition-shadow hover:shadow-sm overflow-hidden {{ !$m->is_visible ? 'opacity-50' : '' }}" data-id="{{ $m->id }}" id="n-{{ $m->id }}">
                        <div class="flex items-center gap-2 px-2.5 py-2 min-h-[44px]">
                            <span class="cursor-grab text-gray-300 flex-shrink-0 flex grip hover:text-gray-400" title="Geser untuk mengatur urutan">
                                <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><circle cx="9" cy="5" r="1.5"/><circle cx="15" cy="5" r="1.5"/><circle cx="9" cy="12" r="1.5"/><circle cx="15" cy="12" r="1.5"/><circle cx="9" cy="19" r="1.5"/><circle cx="15" cy="19" r="1.5"/></svg>
                            </span>
                            <div class="flex-1 min-w-0">
                                <div class="text-[14px] font-semibold text-gray-900 truncate node-name flex items-center gap-1.5">
                                    {{ $m->label }}
                                </div>
                                <div class="text-[11px] text-gray-400 truncate mt-px node-url">
                                    @if($isOrtomMenu)
                                        Sub-menu diambil otomatis dari database Data Organisasi
                                    @else
                                        {{ $m->url ?: 'Dropdown' }}
                                    @endif
                                </div>
                            </div>
                            @if($isOrtomMenu)
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wide flex-shrink-0 bg-emerald-100 text-emerald-800 border border-emerald-200">Ortom DB</span>
                            @elseif($m->children->isNotEmpty())
                                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-full uppercase tracking-wide flex-shrink-0 bg-violet-100 text-violet-700">Dropdown</span>
                            @else
                                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-full uppercase tracking-wide flex-shrink-0 bg-blue-100 text-blue-700">Link</span>
                            @endif

                            @if(!$m->is_visible)
                                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-full uppercase tracking-wide flex-shrink-0 bg-gray-100 text-gray-400">Hidden</span>
                            @endif

                            <div class="flex gap-1 flex-shrink-0 ml-1">
                                @if($isOrtomMenu)
                                    <a href="{{ route('admin.organisasi-otonom') }}" title="Kelola Isi Organisasi Otonom" class="w-[28px] h-[28px] rounded-md border border-emerald-200 flex items-center justify-center cursor-pointer bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors">
                                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"/><path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"/></svg>
                                    </a>
                                @endif

                                <button class="w-[28px] h-[28px] rounded-md border border-gray-200 flex items-center justify-center cursor-pointer bg-white transition-colors text-gray-500 hover:bg-gray-100 hover:text-gray-900" title="Edit Label/Link" onclick="openEditModal({{ $m->id }},'{{ addslashes($m->label) }}','{{ addslashes($m->url ?? '') }}',{{ $m->open_new_tab ? 'true' : 'false' }})">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
                                </button>
                                <button class="w-[28px] h-[28px] rounded-md border flex items-center justify-center cursor-pointer bg-white transition-colors hover:bg-gray-100 {{ !$m->is_visible ? 'border-gray-100 text-gray-300 hover:text-gray-600' : 'border-gray-200 text-gray-500 hover:text-gray-900' }}" title="{{ $m->is_visible ? 'Sembunyikan dari Navbar' : 'Tampilkan di Navbar' }}" onclick="toggleVis({{ $m->id }},this)">
                                    @if($m->is_visible)
                                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                                    @else
                                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd"/><path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.064 7 9.542 7 .847 0 1.669-.105 2.454-.303z"/></svg>
                                    @endif
                                </button>
                                <button class="w-[28px] h-[28px] rounded-md border border-violet-200 flex items-center justify-center cursor-pointer bg-white transition-colors text-violet-600 hover:bg-violet-50" title="Tambah sub-menu manual" onclick="openAddModal({{ $m->id }},'{{ addslashes($m->label) }}')">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                                </button>
                                <button class="w-[28px] h-[28px] rounded-md border border-red-100 flex items-center justify-center cursor-pointer bg-white transition-colors text-red-500 hover:bg-red-50" title="Hapus menu" onclick="openDelModal({{ $m->id }},'{{ addslashes($m->label) }}',{{ $m->children->count() }})">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                </button>
                            </div>
                        </div>

                        {{-- Children --}}
                        @if($m->children->isNotEmpty())
                            <ul class="pl-8 pr-2.5 pb-2 pt-0.5 border-t border-gray-100" id="kids-{{ $m->id }}" data-pid="{{ $m->id }}">
                                @foreach($m->children as $c)
                                    <li class="bg-gray-50 border border-gray-200 rounded-lg mb-1 {{ !$c->is_visible ? 'opacity-50' : '' }} kid-node" data-id="{{ $c->id }}" id="n-{{ $c->id }}">
                                        <div class="flex items-center gap-2 px-2 py-1.5">
                                            <span class="cursor-grab text-gray-300 flex-shrink-0 flex grip hover:text-gray-400">
                                                <svg viewBox="0 0 24 24" fill="currentColor" class="w-3.5 h-3.5"><circle cx="9" cy="5" r="1.5"/><circle cx="15" cy="5" r="1.5"/><circle cx="9" cy="12" r="1.5"/><circle cx="15" cy="12" r="1.5"/><circle cx="9" cy="19" r="1.5"/><circle cx="15" cy="19" r="1.5"/></svg>
                                            </span>
                                            <div class="flex-1 min-w-0">
                                                <div class="text-[13px] font-semibold text-gray-800 truncate node-name">{{ $c->label }}</div>
                                                <div class="text-[11px] text-gray-400 truncate mt-px node-url">{{ $c->url ?: '—' }}</div>
                                            </div>
                                            @if(!$c->is_visible)<span class="text-[9px] font-bold px-1.5 py-0.5 rounded-full uppercase tracking-wide flex-shrink-0 bg-gray-100 text-gray-400">Hidden</span>@endif
                                            <div class="flex gap-1 flex-shrink-0 ml-1">
                                                <button class="w-[24px] h-[24px] rounded flex items-center justify-center cursor-pointer transition-colors text-gray-400 hover:bg-gray-200 hover:text-gray-800" title="Edit" onclick="openEditModal({{ $c->id }},'{{ addslashes($c->label) }}','{{ addslashes($c->url ?? '') }}',{{ $c->open_new_tab ? 'true' : 'false' }})">
                                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
                                                </button>
                                                <button class="w-[24px] h-[24px] rounded flex items-center justify-center cursor-pointer transition-colors {{ !$c->is_visible ? 'text-gray-300 hover:bg-gray-200 hover:text-gray-600' : 'text-gray-400 hover:bg-gray-200 hover:text-gray-800' }}" title="{{ $c->is_visible ? 'Sembunyikan' : 'Tampilkan' }}" onclick="toggleVis({{ $c->id }},this)">
                                                    @if($c->is_visible)
                                                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                                                    @else
                                                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3"><path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd"/><path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.064 7 9.542 7 .847 0 1.669-.105 2.454-.303z"/></svg>
                                                    @endif
                                                </button>
                                                <button class="w-[24px] h-[24px] rounded flex items-center justify-center cursor-pointer transition-colors text-red-400 hover:bg-red-50 hover:text-red-600" title="Hapus" onclick="openDelModal({{ $c->id }},'{{ addslashes($c->label) }}',0)">
                                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <ul class="pl-8 pr-2.5 pb-2 pt-0.5 border-t border-gray-100 min-h-0 hidden" id="kids-{{ $m->id }}" data-pid="{{ $m->id }}"></ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif

        {{-- Help tip --}}
        <div class="mt-4 p-3.5 bg-emerald-50 rounded-xl border border-emerald-200">
            <p class="text-xs text-emerald-800 m-0 leading-relaxed">
                <strong>Tips:</strong> Geser icon titik-titik untuk mengubah posisi/urutan menu. Klik tombol mata untuk menyembunyikan/menampilkan menu pada navigasi utama situs. Menu <strong>Organisasi Otonom</strong> memuat daftar ortom aktif secara otomatis dari database.
            </p>
        </div>

    </div>{{-- /container --}}


    {{-- ═══════ MODAL: Tambah ═══════ --}}
    <div class="fixed inset-0 bg-black/50 z-[9990] flex items-center justify-center backdrop-blur-sm transition-opacity hidden" id="m-add" onclick="if(event.target===this)closeModal('m-add')">
        <div class="bg-white rounded-2xl w-[95%] max-w-md shadow-2xl overflow-hidden transform transition-all">
            <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-base font-bold text-gray-900 m-0" id="add-title">Tambah Menu</h3>
                <button type="button" class="w-7 h-7 rounded-md border border-gray-200 bg-gray-50 flex items-center justify-center cursor-pointer text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors" onclick="closeModal('m-add')">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                </button>
            </div>
            <form action="{{ route('admin.navbar-menu.store') }}" method="POST">
                @csrf
                <input type="hidden" name="parent_id" id="add-pid">
                <div class="p-5">
                    <div id="add-pinfo" class="hidden mb-3">
                        <span class="inline-block bg-violet-50 text-violet-600 text-xs font-semibold px-2.5 py-1 rounded-md border border-violet-100">
                            Sub-menu dari: <span id="add-pname"></span>
                        </span>
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Nama Menu <span class="text-red-500">*</span></label>
                        <input type="text" name="label" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-900 focus:border-[#0d5c3a] focus:ring-2 focus:ring-[#0d5c3a]/10 outline-none transition-all shadow-sm" placeholder="Contoh: Tentang Kami" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Link / URL</label>
                        <input type="text" name="url" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-900 focus:border-[#0d5c3a] focus:ring-2 focus:ring-[#0d5c3a]/10 outline-none transition-all shadow-sm" placeholder="/tentang  atau  /#bagian  atau  https://...">
                        <div class="text-[11px] text-gray-500 mt-1">Kosongkan jika hanya sebagai grup dropdown.</div>
                    </div>
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="open_new_tab" value="1" class="w-4 h-4 rounded border-gray-300 text-[#0d5c3a] focus:ring-[#0d5c3a]"> 
                        <span class="text-[13px] font-medium text-gray-700 group-hover:text-gray-900">Buka di tab baru</span>
                    </label>
                </div>
                <div class="px-5 py-3.5 bg-gray-50 border-t border-gray-100 flex justify-end gap-2">
                    <button type="button" class="bg-white hover:bg-gray-100 text-gray-700 border border-gray-300 text-sm font-semibold py-2 px-4 rounded-lg transition-colors" onclick="closeModal('m-add')">Batal</button>
                    <button type="submit" class="bg-[#0d5c3a] hover:bg-[#0a4a2d] text-white text-sm font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ═══════ MODAL: Edit ═══════ --}}
    <div class="fixed inset-0 bg-black/50 z-[9990] flex items-center justify-center backdrop-blur-sm transition-opacity hidden" id="m-edit" onclick="if(event.target===this)closeModal('m-edit')">
        <div class="bg-white rounded-2xl w-[95%] max-w-md shadow-2xl overflow-hidden transform transition-all">
            <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-base font-bold text-gray-900 m-0">Edit Menu</h3>
                <button type="button" class="w-7 h-7 rounded-md border border-gray-200 bg-gray-50 flex items-center justify-center cursor-pointer text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors" onclick="closeModal('m-edit')">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                </button>
            </div>
            <form id="edit-form" method="POST">
                @csrf @method('PUT')
                <div class="p-5">
                    <div class="mb-4">
                        <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Nama Menu <span class="text-red-500">*</span></label>
                        <input type="text" name="label" id="e-label" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-900 focus:border-[#0d5c3a] focus:ring-2 focus:ring-[#0d5c3a]/10 outline-none transition-all shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Link / URL</label>
                        <input type="text" name="url" id="e-url" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-900 focus:border-[#0d5c3a] focus:ring-2 focus:ring-[#0d5c3a]/10 outline-none transition-all shadow-sm" placeholder="Kosongkan untuk dropdown">
                    </div>
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="open_new_tab" id="e-tab" value="1" class="w-4 h-4 rounded border-gray-300 text-[#0d5c3a] focus:ring-[#0d5c3a]"> 
                        <span class="text-[13px] font-medium text-gray-700 group-hover:text-gray-900">Buka di tab baru</span>
                    </label>
                </div>
                <div class="px-5 py-3.5 bg-gray-50 border-t border-gray-100 flex justify-end gap-2">
                    <button type="button" class="bg-white hover:bg-gray-100 text-gray-700 border border-gray-300 text-sm font-semibold py-2 px-4 rounded-lg transition-colors" onclick="closeModal('m-edit')">Batal</button>
                    <button type="submit" class="bg-[#0d5c3a] hover:bg-[#0a4a2d] text-white text-sm font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ═══════ MODAL: Hapus ═══════ --}}
    <div class="fixed inset-0 bg-black/50 z-[9990] flex items-center justify-center backdrop-blur-sm transition-opacity hidden" id="m-del" onclick="if(event.target===this)closeModal('m-del')">
        <div class="bg-white rounded-2xl w-[95%] max-w-sm shadow-2xl overflow-hidden transform transition-all">
            <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center bg-red-50/50">
                <h3 class="text-base font-bold text-red-600 m-0">Hapus Menu</h3>
                <button type="button" class="w-7 h-7 rounded-md border border-red-200 bg-red-50 flex items-center justify-center cursor-pointer text-red-400 hover:bg-red-100 hover:text-red-600 transition-colors" onclick="closeModal('m-del')">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                </button>
            </div>
            <div class="p-6 text-center">
                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center mx-auto mb-4 border border-red-200">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 text-red-600"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                </div>
                <p class="text-[15px] font-bold text-gray-900 m-0 mb-1.5">Hapus "<span id="del-name"></span>"?</p>
                <p id="del-warn" class="hidden text-sm text-red-600 font-medium m-0 mb-1.5"><strong id="del-cnt"></strong> sub-menu juga akan ikut terhapus.</p>
                <p class="text-[13px] text-gray-500 m-0">Tindakan ini tidak bisa dibatalkan.</p>
            </div>
            <form id="del-form" method="POST">
                @csrf @method('DELETE')
                <div class="px-5 py-3.5 bg-gray-50 border-t border-gray-100 flex justify-end gap-2">
                    <button type="button" class="bg-white hover:bg-gray-100 text-gray-700 border border-gray-300 text-sm font-semibold py-2 px-4 rounded-lg transition-colors" onclick="closeModal('m-del')">Batal</button>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ═══════ PREVIEW POPUP ═══════ --}}
    <div class="fixed inset-0 bg-black/60 z-[9995] flex flex-col items-center justify-center backdrop-blur-md transition-opacity hidden" id="m-preview" onclick="if(event.target===this)closeModal('m-preview')">
        <div class="bg-white rounded-2xl w-[95%] max-w-4xl shadow-2xl overflow-hidden transform transition-all">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-base font-bold text-gray-900 m-0 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Live Preview Navbar
                </h3>
                <button type="button" class="w-8 h-8 rounded-md border border-gray-200 bg-gray-50 flex items-center justify-center cursor-pointer text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors" onclick="closeModal('m-preview')">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                </button>
            </div>
            <div class="p-6 bg-gray-50 max-h-[80vh] overflow-y-auto">
                {{-- Desktop --}}
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 m-0">Desktop</p>
                <div class="bg-[#0d5c3a] rounded-xl px-5 h-16 flex items-center gap-1.5 shadow-lg overflow-hidden border border-black/10" id="prev-desktop"></div>

                {{-- Mobile --}}
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mt-8 mb-3 m-0 text-center">Mobile</p>
                <div class="mt-4 bg-[#0a1e12] rounded-xl p-4 max-w-sm mx-auto shadow-lg border border-black/20" id="prev-mobile"></div>
            </div>
        </div>
    </div>


    <script>
    /* ── helpers ─────────────────────────────────────────────────────────── */
    function closeModal(id) { 
        var el = document.getElementById(id);
        if (el) {
            el.classList.add('hidden');
            document.body.style.overflow = ''; 
        }
    }
    
    function openModal(id)  { 
        var el = document.getElementById(id);
        if (el) {
            el.classList.remove('hidden'); 
            document.body.style.overflow = 'hidden'; 
        }
    }
    
    document.addEventListener('keydown', function(e) { 
        if (e.key === 'Escape') ['m-add','m-edit','m-del','m-preview'].forEach(closeModal); 
    });

    /* ── Add ─────────────────────────────────────────────────────────────── */
    function openAddModal(pid, pname) {
        document.getElementById('add-pid').value = pid || '';
        var info = document.getElementById('add-pinfo');
        if (pid) { 
            info.classList.remove('hidden'); 
            document.getElementById('add-pname').textContent = pname; 
            document.getElementById('add-title').textContent = 'Tambah Sub-menu'; 
        } else { 
            info.classList.add('hidden');  
            document.getElementById('add-title').textContent = 'Tambah Menu'; 
        }
        openModal('m-add');
    }

    /* ── Edit ────────────────────────────────────────────────────────────── */
    function openEditModal(id, label, url, tab) {
        document.getElementById('edit-form').action = '/admin/navbar-menu/' + id;
        document.getElementById('e-label').value = label;
        document.getElementById('e-url').value = url;
        document.getElementById('e-tab').checked = tab;
        openModal('m-edit');
    }

    /* ── Delete ──────────────────────────────────────────────────────────── */
    function openDelModal(id, label, cnt) {
        document.getElementById('del-form').action = '/admin/navbar-menu/' + id;
        document.getElementById('del-name').textContent = label;
        var w = document.getElementById('del-warn');
        if (cnt > 0) { 
            w.classList.remove('hidden'); 
            document.getElementById('del-cnt').textContent = cnt; 
        } else { 
            w.classList.add('hidden'); 
        }
        openModal('m-del');
    }

    /* ── Toggle visibility ───────────────────────────────────────────────── */
    function toggleVis(id, btn) {
        var tok = document.querySelector('meta[name="csrf-token"]');
        fetch('/admin/navbar-menu/' + id + '/toggle', { 
            method: 'PATCH', 
            headers: { 'X-CSRF-TOKEN': tok ? tok.content : '', 'Accept': 'application/json' } 
        })
        .then(function(r) { return r.json(); })
        .then(function(d) {
            if (!d.success) return;
            var el = document.getElementById('n-' + id);
            if (d.is_visible) {
                el.classList.remove('opacity-50'); 
                btn.title = 'Sembunyikan dari Navbar';
                btn.className = 'w-[28px] h-[28px] rounded-md border flex items-center justify-center cursor-pointer bg-white transition-colors hover:bg-gray-100 border-gray-200 text-gray-500 hover:text-gray-900';
                if(btn.classList.contains('w-[24px]')) {
                    btn.className = 'w-[24px] h-[24px] rounded flex items-center justify-center cursor-pointer transition-colors text-gray-400 hover:bg-gray-200 hover:text-gray-800';
                }
                btn.innerHTML = '<svg viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>';
            } else {
                el.classList.add('opacity-50'); 
                btn.title = 'Tampilkan di Navbar';
                btn.className = 'w-[28px] h-[28px] rounded-md border flex items-center justify-center cursor-pointer bg-white transition-colors hover:bg-gray-100 border-gray-100 text-gray-300 hover:text-gray-600';
                if(btn.classList.contains('w-[24px]')) {
                    btn.className = 'w-[24px] h-[24px] rounded flex items-center justify-center cursor-pointer transition-colors text-gray-300 hover:bg-gray-200 hover:text-gray-600';
                }
                btn.innerHTML = '<svg viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd"/><path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.064 7 9.542 7 .847 0 1.669-.105 2.454-.303z"/></svg>';
            }
            if(btn.classList.contains('w-[24px]')) {
                 btn.querySelector('svg').classList.remove('w-3.5', 'h-3.5');
                 btn.querySelector('svg').classList.add('w-3', 'h-3');
            }
        });
    }

    /* ── Sortable ────────────────────────────────────────────────────────── */
    function dirty() { 
        document.getElementById('unsaved-bar').classList.remove('hidden'); 
        document.getElementById('unsaved-bar').classList.add('flex'); 
    }

    var root = document.getElementById('root-list');
    if (root) {
        Sortable.create(root, { handle: '.grip', animation: 150, ghostClass: 'sortable-ghost', chosenClass: 'sortable-chosen', onEnd: dirty });
    }
    document.querySelectorAll('[id^="kids-"]').forEach(function(el) {
        Sortable.create(el, { handle: '.grip', animation: 150, ghostClass: 'sortable-ghost', onEnd: dirty });
    });

    /* ── Save order ──────────────────────────────────────────────────────── */
    function saveOrder() {
        var btn = document.getElementById('save-btn');
        var orig = btn.innerHTML;
        btn.innerHTML = '<span class="spin"></span> Menyimpan...'; btn.disabled = true;

        var items = [], ord = 0;
        document.querySelectorAll('#root-list > li').forEach(function(el) {
            ord++;
            items.push({ id: +el.dataset.id, order: ord, parent_id: null });
            var kids = el.querySelector('[id^="kids-"]');
            if (kids) {
                var so = 0;
                kids.querySelectorAll('li').forEach(function(k) {
                    so++;
                    items.push({ id: +k.dataset.id, order: so, parent_id: +el.dataset.id });
                });
            }
        });

        var tok = document.querySelector('meta[name="csrf-token"]');
        fetch('{{ route("admin.navbar-menu.reorder") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': tok ? tok.content : '', 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify({ items: items })
        })
        .then(function(r) { return r.json(); })
        .then(function(d) { 
            if (d.success) { 
                document.getElementById('unsaved-bar').classList.add('hidden'); 
                document.getElementById('unsaved-bar').classList.remove('flex'); 
                toast('Urutan berhasil disimpan', true); 
            } 
        })
        .catch(function() { toast('Gagal menyimpan urutan', false); })
        .finally(function() { btn.innerHTML = orig; btn.disabled = false; });
    }

    /* ── Preview ─────────────────────────────────────────────────────────── */
    function openPreviewModal() {
        buildPreview();
        openModal('m-preview');
    }

    function buildPreview() {
        var dt = document.getElementById('prev-desktop');
        var mb = document.getElementById('prev-mobile');
        dt.innerHTML = ''; mb.innerHTML = '';

        // Desktop logo
        dt.innerHTML += '<div class="flex items-center gap-2 mr-4 flex-shrink-0"><div class="w-7 h-7 rounded-md bg-white/10 flex-shrink-0"></div><div><div class="text-[12px] font-bold text-white whitespace-nowrap">PCM Duren Sawit 1</div><div class="text-[8px] text-yellow-500/90 uppercase tracking-widest whitespace-nowrap">Muhammadiyah Berkemajuan</div></div></div>';

        // Read menu tree from DOM
        var nodes = document.querySelectorAll('#root-list > li');
        nodes.forEach(function(el) {
            var isDim = el.classList.contains('opacity-50');
            var nameEl = el.querySelector(':scope > div .node-name');
            if (!nameEl) return;
            var name = nameEl.textContent.trim();
            var kids = el.querySelector('[id^="kids-"]');
            var isOrtom = name.toLowerCase().includes('otonom');
            var hasKids = (kids && kids.querySelectorAll('li').length > 0) || isOrtom;

            // Desktop item
            var di = document.createElement('div');
            di.className = 'px-3 py-1.5 rounded-md text-[12px] font-medium text-white/70 whitespace-nowrap flex-shrink-0 flex items-center gap-1';
            if(isDim) { di.className += ' opacity-30 line-through'; }
            di.textContent = name;
            if(hasKids) {
                 var arr = document.createElement('span');
                 arr.textContent = '▾'; arr.className = 'text-[9px] opacity-50';
                 di.appendChild(arr);
            }
            dt.appendChild(di);

            // Mobile item
            if (hasKids) {
                var mg = document.createElement('div');
                mg.className = 'px-3 py-2 text-[13px] text-white/50 flex justify-between items-center';
                if(isDim) { mg.className += ' opacity-30 line-through'; }
                mg.textContent = name;
                var arr2 = document.createElement('span');
                arr2.textContent = '▾'; arr2.className = 'text-[10px] opacity-40';
                mg.appendChild(arr2);
                mb.appendChild(mg);

                if (isOrtom && (!kids || kids.querySelectorAll('li').length === 0)) {
                    ['Aisyiyah', 'Pemuda Muhammadiyah', 'Nasyiatul Aisyiyah', 'Hizbul Wathan', 'Tapak Suci'].forEach(function(o) {
                        var mc = document.createElement('div');
                        mc.className = 'px-3 py-1.5 pl-6 text-[12px] text-white/30';
                        if(isDim) mc.className += ' opacity-30 line-through';
                        mc.textContent = o;
                        mb.appendChild(mc);
                    });
                } else if (kids) {
                    kids.querySelectorAll('li').forEach(function(k) {
                        var cn = k.querySelector('.node-name');
                        var mc = document.createElement('div');
                        mc.className = 'px-3 py-1.5 pl-6 text-[12px] text-white/30';
                        if (k.classList.contains('opacity-50')) { mc.className += ' opacity-30 line-through'; }
                        mc.textContent = cn ? cn.textContent.trim() : '';
                        mb.appendChild(mc);
                    });
                }
            } else {
                var mi = document.createElement('div');
                mi.className = 'px-3 py-2 text-[13px] text-white/50 rounded-md';
                if(isDim) { mi.className += ' opacity-30 line-through'; }
                mi.textContent = name;
                mb.appendChild(mi);
            }
        });

        // Desktop spacer + CTA
        dt.innerHTML += '<div class="flex-1"></div><div class="bg-yellow-500/90 text-gray-900 text-[11px] font-bold py-1.5 px-3 rounded-md whitespace-nowrap flex-shrink-0">Dashboard</div>';
    }

    /* ── Toast ───────────────────────────────────────────────────────────── */
    function toast(msg, success) {
        var t = document.createElement('div');
        t.className = 'fixed bottom-5 right-5 z-[99999] px-4 py-2.5 rounded-lg text-sm font-semibold shadow-lg transition-all transform translate-y-0 opacity-100 ';
        t.className += success ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-red-100 text-red-800 border border-red-300';
        t.textContent = msg;
        document.body.appendChild(t);
        setTimeout(function() { 
            t.classList.add('translate-y-2', 'opacity-0');
            setTimeout(function() { t.remove(); }, 300);
        }, 3000);
    }
    </script>
</x-app-layout>
