@props([
    'columns' => [],
    'rows' => [],
    'title' => 'Data Table',
    'perPage' => 10,
    'addUrl' => null,
    'editUrl' => null,
    'deleteUrl' => null,
    'rowKey' => 'id',
])

@push('styles')
    <style>
        [x-cloak] {
            display: none !important;
        }

        .dt-row-anim {
            animation: dt-row-in 0.18s ease both;
        }

        @keyframes dt-row-in {
            from {
                opacity: 0;
                transform: translateY(4px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dt-checkbox {
            appearance: none;
            width: 16px;
            height: 16px;
            border: 1.5px solid #d1d5db;
            border-radius: 4px;
            cursor: pointer;
            position: relative;
        }

        .dt-checkbox:checked {
            background-color: #09090b;
            border-color: #09090b;
        }

        .dt-checkbox:checked::after {
            content: '';
            position: absolute;
            left: 3px;
            top: 0px;
            width: 5px;
            height: 9px;
            border: 2px solid white;
            border-top: none;
            border-left: none;
            transform: rotate(40deg);
        }

        .dt-table-wrap {
            overflow-x: auto;
        }

        /* Modal styles */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            max-width: 420px;
            width: 90%;
            animation: modalPop 0.2s ease;
        }

        @keyframes modalPop {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Toast animation */
        .toast-show {
            animation: toastIn 0.3s ease;
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .toast-hide {
            animation: toastOut 0.3s ease;
        }

        @keyframes toastOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }
    </style>
@endpush

<div class="w-full font-sans text-sm text-zinc-900" x-data="dataTable" x-init="init({{ json_encode($columns) }}, {{ json_encode($rows) }}, {{ (int) $perPage }}, '{{ $editUrl }}', '{{ $deleteUrl }}', '{{ $rowKey }}')" x-cloak>

    {{-- Top Bar --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-4">
        <div class="relative w-full sm:w-72">
            <input type="text" x-model.debounce.300ms="search" @input="currentPage = 1" placeholder="Cari..."
                class="w-full pl-9 pr-4 py-2 text-sm bg-white border border-zinc-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-zinc-900/10" />
        </div>
        <div class="flex items-center gap-2 shrink-0">
            @if ($addUrl)
                <a href="{{ $addUrl }}"
                    class="flex items-center gap-1.5 px-3 py-2 text-sm bg-zinc-900 text-white rounded-lg hover:bg-zinc-800">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Tambah Data</span>
                </a>
            @endif
        </div>
    </div>

    {{-- Selected baris info --}}
    <div x-show="selected.length > 0" x-transition
        class="flex items-center justify-between mb-3 px-4 py-2.5 bg-zinc-900 text-white rounded-lg text-sm">
        <span><span x-text="selected.length"></span> baris dipilih</span>
        <div class="flex items-center gap-2">
            <button @click="openDeleteSelectedModal()"
                class="px-3 py-1 rounded-md bg-red-500 hover:bg-red-400 transition text-xs font-medium">Hapus</button>
            <button @click="selected = []"
                class="px-3 py-1 rounded-md bg-white/10 hover:bg-white/20 transition text-xs">Batal</button>
        </div>
    </div>

    {{-- Table --}}
    <div class="dt-table-wrap rounded-t-xl border border-zinc-200 bg-white overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-zinc-100 bg-zinc-50">
                    <th class="w-10 px-4 py-3"><input type="checkbox" class="dt-checkbox" :checked="isAllChecked"
                            @change="toggleAll($event.target.checked)" /></th>
                    <template x-for="col in columns" :key="col.key">
                        <th class="px-4 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wide"
                            :class="col.sortable ? 'cursor-pointer hover:text-zinc-900' : ''"
                            @click="col.sortable && sort(col.key)">
                            <span x-text="col.label"></span>
                        </th>
                    </template>
                    <th class="w-20 px-4 py-3 text-center text-xs font-medium text-zinc-500 uppercase tracking-wide">
                        AKSI</th>
                </tr>
            </thead>
            <tbody>
                <template x-if="paginatedRows.length === 0">
                    <tr>
                        <td :colspan="columns.length + 2" class="py-16 text-center text-zinc-400">Tidak ada data
                            ditemukan</td>
                    </tr>
                </template>
                <template x-for="(row, i) in paginatedRows" :key="i">
                    <tr class="border-b border-zinc-50 hover:bg-zinc-50/60 dt-row-anim"
                        :class="selected.includes(row[rowKey]) ? 'bg-zinc-50' : ''">
                        <td class="px-4 py-3"><input type="checkbox" class="dt-checkbox" :value="row[rowKey]"
                                x-model="selected" /></td>

                        <template x-for="col in columns" :key="col.key">
                            <td class="px-4 py-3">
                                <!-- Kondisi untuk FOTO/GAMBAR -->
                                <template
                                    x-if="col.key === 'image' || col.key === 'thumbnail' || col.key === 'gambar' || col.key === 'logo' || col.key === 'foto'">
                                    <img :src="row[col.key]" alt="image"
                                        class="w-10 h-10 object-cover rounded-md border border-zinc-200"
                                        onerror="this.src='https://ui-avatars.com/api/?name='+encodeURIComponent(row.nama || 'User')+'&background=0D8ABC&color=fff'">
                                </template>

                                <template x-if="col.key === 'file'">
                                    <a :href="row[col.key]" target="_blank"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition text-xs font-medium">

                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 0 0 2-2V7.5L13.5 2H7a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 2v6h6" />
                                        </svg>

                                        <span>Lihat PDF</span>
                                    </a>
                                </template>

                                <!-- Kondisi khusus untuk urutan dengan badge -->
                                <template x-if="col.key === 'urutan'">
                                    <span
                                        class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold bg-slate-100 text-slate-600 rounded-full">
                                        <span x-text="row[col.key] ?? 0"></span>
                                    </span>
                                </template>

                                <!-- Kondisi untuk teks BIASA (BUKAN foto, BUKAN urutan) -->
                                <template
                                    x-if="col.key !== 'image' && col.key !== 'thumbnail' && col.key !== 'gambar' && col.key !== 'logo' && col.key !== 'foto' && col.key !== 'urutan' && col.key !== 'file'">

                                    <span class="text-zinc-700"
                                        x-text="col.key === 'tanggal' ? formatTanggal(row[col.key]) : col.key === 'is_active' ? (row[col.key] ? 'Aktif' : 'Tidak Aktif') :
                                        (col.key === 'periode_mulai' || col.key === 'periode_selesai') ? (row[col.key] || '-') : truncate(row[col.key], 80)">
                                    </span>
                                </template>
                            </td>
                        </template>

                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a :href="editUrl.replace('{id}', row[rowKey])"
                                    class="p-1.5 rounded-md text-blue-600 hover:bg-blue-50 transition-colors"
                                    title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <button @click="openDeleteModal(row)"
                                    class="p-1.5 rounded-md text-red-600 hover:bg-red-50 transition-colors"
                                    title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="flex items-center justify-between border border-t-0 border-zinc-200 bg-white px-4 py-3 sm:px-6 rounded-b-xl">
        <div class="flex flex-1 justify-between sm:hidden">
            <button @click="currentPage > 1 ? currentPage-- : null" :disabled="currentPage === 1"
                class="relative inline-flex items-center rounded-md border border-zinc-300 bg-white px-4 py-2 text-xs font-medium text-zinc-700 hover:bg-zinc-50 hover:text-zinc-900 disabled:bg-zinc-50 disabled:text-zinc-400 disabled:border-zinc-200 disabled:cursor-not-allowed transition-colors">
                Sebelumnya
            </button>
            <button @click="currentPage < totalPages ? currentPage++ : null" :disabled="currentPage === totalPages"
                class="relative ml-3 inline-flex items-center rounded-md border border-zinc-300 bg-white px-4 py-2 text-xs font-medium text-zinc-700 hover:bg-zinc-50 hover:text-zinc-900 disabled:bg-zinc-50 disabled:text-zinc-400 disabled:border-zinc-200 disabled:cursor-not-allowed transition-colors">
                Berikutnya
            </button>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-xs text-zinc-700">
                    Menampilkan
                    <span class="font-medium" x-text="filteredRows.length > 0 ? (currentPage - 1) * perPage + 1 : 0"></span>
                    sampai
                    <span class="font-medium" x-text="Math.min(currentPage * perPage, filteredRows.length)"></span>
                    dari
                    <span class="font-medium" x-text="filteredRows.length"></span>
                    hasil
                </p>
            </div>
            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <button @click="currentPage = 1" :disabled="currentPage === 1"
                        class="relative inline-flex items-center rounded-l-md px-2.5 py-2 text-zinc-500 bg-white border border-zinc-300 hover:bg-zinc-50 hover:text-zinc-800 focus:z-20 focus:outline-none disabled:bg-zinc-50 disabled:text-zinc-300 disabled:border-zinc-200 disabled:cursor-not-allowed transition-colors">
                        <span class="sr-only">First</span>
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-left-icon lucide-chevrons-left"><path d="m11 17-5-5 5-5"/><path d="m18 17-5-5 5-5"/></svg>
                    </button>
                    <button @click="currentPage > 1 ? currentPage-- : null" :disabled="currentPage === 1"
                        class="relative inline-flex items-center px-2.5 py-2 text-zinc-500 bg-white border border-zinc-300 hover:bg-zinc-50 hover:text-zinc-800 focus:z-20 focus:outline-none disabled:bg-zinc-50 disabled:text-zinc-300 disabled:border-zinc-200 disabled:cursor-not-allowed transition-colors">
                        <span class="sr-only">Previous</span>
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left-icon lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
                    </button>
                    
                    <span class="relative inline-flex items-center px-4 py-2 text-xs font-semibold text-zinc-700 bg-white border border-zinc-300 focus:outline-none gap-1">
                        Halaman <span class="mx-1 text-zinc-900 font-bold" x-text="currentPage"></span> dari <span class="ml-1 text-zinc-900 font-bold" x-text="totalPages || 1"></span>
                    </span>

                    <button @click="currentPage < totalPages ? currentPage++ : null" :disabled="currentPage === totalPages"
                        class="relative inline-flex items-center px-2.5 py-2 text-zinc-500 bg-white border border-zinc-300 hover:bg-zinc-50 hover:text-zinc-800 focus:z-20 focus:outline-none disabled:bg-zinc-50 disabled:text-zinc-300 disabled:border-zinc-200 disabled:cursor-not-allowed transition-colors">
                        <span class="sr-only">Next</span>
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                    <button @click="currentPage = totalPages" :disabled="currentPage === totalPages"
                        class="relative inline-flex items-center rounded-r-md px-2.5 py-2 text-zinc-500 bg-white border border-zinc-300 hover:bg-zinc-50 hover:text-zinc-800 focus:z-20 focus:outline-none disabled:bg-zinc-50 disabled:text-zinc-300 disabled:border-zinc-200 disabled:cursor-not-allowed transition-colors">
                        <span class="sr-only">Last</span>
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-right-icon lucide-chevrons-right"><path d="m6 18 5-5-5-5"/><path d="m13 18 5-5-5-5"/></svg>
                    </button>
                </nav>
            </div>
        </div>
    </div>

    {{-- ==================== MODAL DELETE SINGLE ==================== --}}
    <div x-show="deleteModal.show" x-cloak class="modal-backdrop">
        <div class="modal-content">
            <div class="p-6">
                <div class="text-center">
                    <div class="mx-auto w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 mb-2">Hapus Data</h3>
                    <p class="text-sm text-zinc-500 mb-6">Apakah Anda yakin ingin menghapus data ini? Tindakan ini
                        tidak
                        dapat dibatalkan.</p>
                    <div class="flex gap-3 justify-center">
                        <button @click="deleteModal.show = false"
                            class="px-4 py-2 text-sm font-medium text-zinc-700 bg-zinc-100 rounded-lg hover:bg-zinc-200 transition">
                            Batal
                        </button>
                        <button @click="confirmDelete()"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                            Ya, Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== MODAL DELETE MULTIPLE ==================== --}}
    <div x-show="deleteSelectedModal.show" x-cloak class="modal-backdrop">
        <div class="modal-content">
            <div class="p-6">
                <div class="text-center">
                    <div class="mx-auto w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 mb-2">Hapus Data</h3>
                    <p class="text-sm text-zinc-500 mb-6">Apakah Anda yakin ingin menghapus <span
                            x-text="selected.length"></span> data yang dipilih? Tindakan ini tidak dapat dibatalkan.
                    </p>
                    <div class="flex gap-3 justify-center">
                        <button @click="deleteSelectedModal.show = false"
                            class="px-4 py-2 text-sm font-medium text-zinc-700 bg-zinc-100 rounded-lg hover:bg-zinc-200 transition">
                            Batal
                        </button>
                        <button @click="confirmDeleteSelected()"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                            Ya, Hapus Semua
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== TOAST NOTIFICATION ==================== --}}
    <div x-show="toast.show" x-cloak class="fixed bottom-5 right-5 z-50"
        :class="toast.show ? 'toast-show' : 'toast-hide'">
        <div class="flex items-center gap-3 px-4 py-3 bg-white rounded-lg shadow-lg border border-zinc-200">
            <div class="w-5 h-5 rounded-full bg-green-500 flex items-center justify-center">
                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <span class="text-sm text-zinc-700" x-text="toast.message"></span>
            <button @click="toast.show = false" class="ml-2 text-zinc-400 hover:text-zinc-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
    function dataTable() {
        return {
            columns: [],
            allRows: [],
            rowKey: 'id',
            perPage: 10,
            currentPage: 1,
            search: '',
            sortKey: '',
            sortDir: 'asc',
            selected: [],
            editUrl: '',
            deleteUrl: '',
            deleteModal: {
                show: false,
                row: null
            },
            deleteSelectedModal: {
                show: false
            },
            toast: {
                show: false,
                message: '',
                timer: null
            },

            init(cols, rows, perPage, editUrl, deleteUrl, rowKey) {

                this.columns = cols;
                this.allRows = rows;
                this.perPage = perPage;
                this.editUrl = editUrl;
                this.deleteUrl = deleteUrl;
                this.rowKey = rowKey;
            },

            truncate(text, length = 50) {
                if (!text) return '';
                if (text.length <= length) return text;
                return text.substring(0, length) + '...';
            },

            get filteredRows() {
                let r = this.allRows.filter(row => {
                    if (!this.search) return true;
                    return Object.values(row).some(v => String(v).toLowerCase().includes(this.search
                        .toLowerCase()));
                });
                if (this.sortKey) {
                    r.sort((a, b) => {
                        let av = String(a[this.sortKey] || '');
                        let bv = String(b[this.sortKey] || '');
                        return this.sortDir === 'asc' ? av.localeCompare(bv) : bv.localeCompare(av);
                    });
                }
                return r;
            },

            formatTanggal(dateString) {
                if (!dateString) return '';

                let date = new Date(dateString);

                return date.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                });
            },

            get totalPages() {
                return Math.ceil(this.filteredRows.length / this.perPage);
            },

            get paginatedRows() {
                let start = (this.currentPage - 1) * this.perPage;
                return this.filteredRows.slice(start, start + this.perPage);
            },

            get isAllChecked() {
                return this.paginatedRows.length > 0 && this.paginatedRows.every(r => this.selected.includes(r[this
                    .rowKey]))
            },

            sort(key) {
                if (this.sortKey === key) {
                    this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc';
                } else {
                    this.sortKey = key;
                    this.sortDir = 'asc';
                }
            },

            toggleAll(checked) {
                if (checked) {
                    let keys = this.paginatedRows.map(r => r[this.rowKey]);
                    this.selected = [...new Set([...this.selected, ...keys])];
                } else {
                    this.selected = this.selected.filter(
                        s => !this.paginatedRows.map(r => r[this.rowKey]).includes(s)
                    );
                }
            },

            showToast(message) {
                if (this.toast.timer) clearTimeout(this.toast.timer);
                this.toast.message = message;
                this.toast.show = true;
                this.toast.timer = setTimeout(() => {
                    this.toast.show = false;
                }, 3000);
            },

            openDeleteModal(row) {
                this.deleteModal.row = row;
                this.deleteModal.show = true;
            },

            openDeleteSelectedModal() {
                if (this.selected.length === 0) return;
                this.deleteSelectedModal.show = true;
            },

            confirmDelete() {
                let row = this.deleteModal.row;
                let url = this.deleteUrl.replace('{id}', row[this.rowKey]);

                fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.deleteModal.show = false;
                        if (data.success) {
                            this.allRows = this.allRows.filter(
                                r => r[this.rowKey] !== row[this.rowKey]
                            );
                            this.selected = this.selected.filter(
                                s => s !== row[this.rowKey]
                            );
                            this.showToast('Data berhasil dihapus');
                            if (this.paginatedRows.length === 0 && this.currentPage > 1) this.currentPage--;
                        } else {
                            this.showToast('Gagal menghapus data');
                        }
                    })
                    .catch(err => {
                        this.deleteModal.show = false;
                        this.showToast('Terjadi kesalahan server');
                        console.error(err);
                    });
            },

            confirmDeleteSelected() {
                let ids = [...this.selected];
                let promises = ids.map(id => {
                    let url = this.deleteUrl.replace('{id}', id);
                    return fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });
                });

                Promise.all(promises)
                    .then(responses => {
                        this.deleteSelectedModal.show = false;
                        let allSuccess = responses.every(r => r.ok);
                        if (allSuccess) {
                            this.allRows = this.allRows.filter(
                                r => !ids.includes(r[this.rowKey])
                            );
                            this.selected = [];
                            this.showToast(` ${ids.length} data berhasil dihapus`);
                            if (this.paginatedRows.length === 0 && this.currentPage > 1) this.currentPage--;
                        } else {
                            this.showToast('Gagal menghapus beberapa data');
                        }
                    })
                    .catch(err => {
                        this.deleteSelectedModal.show = false;
                        this.showToast('❌ Terjadi kesalahan server');
                        console.error(err);
                    });
            },

        }
    }
</script>
