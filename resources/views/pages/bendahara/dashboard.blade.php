<x-app-layout>
    <div class="p-6 md:p-8 bg-gray-50 min-h-screen font-sans text-gray-800">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 text-sm font-medium shadow-sm">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error') || $errors->any())
            <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center gap-3 text-sm font-medium shadow-sm">
                <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 shrink-0"></i>
                <span>{{ session('error') ?? $errors->first() }}</span>
            </div>
        @endif

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Dasbor Keuangan</h1>
                <p class="text-sm text-gray-500 mt-1 flex items-center gap-1.5">
                    <i data-lucide="calendar" class="w-4 h-4 text-gray-400"></i>
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <div class="flex items-center gap-3 flex-wrap">
                <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-800 border border-amber-200 text-xs font-bold px-3.5 py-1.5 rounded-full uppercase tracking-wider">
                    <i data-lucide="shield-check" class="w-3.5 h-3.5 text-amber-600"></i> Bendahara
                </span>
                <div class="flex gap-2">
                    <a href="{{ route('bendahara.keuangan.create') }}" class="inline-flex items-center gap-1.5 bg-emerald-700 hover:bg-emerald-800 text-white font-semibold text-sm py-2 px-4 rounded-xl shadow-md shadow-emerald-700/10 transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0 no-underline">
                        <i data-lucide="plus" class="w-4 h-4"></i> Upload PDF
                    </a>
                    <a href="{{ route('bendahara.keuangan.index') }}" class="inline-flex items-center gap-1.5 bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 font-semibold text-sm py-2 px-4 rounded-xl shadow-sm transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0 no-underline">
                        <i data-lucide="files" class="w-4 h-4"></i> Semua Laporan
                    </a>
                </div>
            </div>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {{-- Pemasukan --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm relative overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 border-b-4 border-b-emerald-600">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Total Pemasukan</span>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <i data-lucide="arrow-up-right" class="w-5 h-5"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 leading-none mb-1.5">{{ $totalPemasukan }}</h3>
                <p class="text-xs text-gray-500"><span class="text-emerald-600 font-semibold">laporan</span> pemasukan</p>
            </div>

            {{-- Pengeluaran --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm relative overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 border-b-4 border-b-rose-600">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Total Pengeluaran</span>
                    <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                        <i data-lucide="arrow-down-left" class="w-5 h-5"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 leading-none mb-1.5">{{ $totalPengeluaran }}</h3>
                <p class="text-xs text-gray-500"><span class="text-rose-600 font-semibold">laporan</span> pengeluaran</p>
            </div>

            {{-- Selisih Laporan --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm relative overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 border-b-4 border-b-amber-500">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Selisih Laporan</span>
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <i data-lucide="scale" class="w-5 h-5"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 leading-none mb-1.5">{{ abs($totalPemasukan - $totalPengeluaran) }}</h3>
                <p class="text-xs text-gray-500 flex items-center gap-1">
                    @if($totalPemasukan >= $totalPengeluaran)
                        <span class="text-emerald-600 font-semibold inline-flex items-center gap-0.5"><i data-lucide="arrow-up" class="w-3 h-3"></i> lebih banyak</span> pemasukan
                    @else
                        <span class="text-rose-600 font-semibold inline-flex items-center gap-0.5"><i data-lucide="arrow-down" class="w-3 h-3"></i> lebih banyak</span> pengeluaran
                    @endif
                </p>
            </div>

            {{-- Total Dokumen --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm relative overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 border-b-4 border-b-blue-600">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Total Dokumen</span>
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 leading-none mb-1.5">{{ $totalLaporan }}</h3>
                <p class="text-xs text-gray-500">semua <span class="text-blue-600 font-semibold">laporan</span> keuangan</p>
            </div>
        </div>

        {{-- Main Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT: Tabel Laporan Terbaru --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="flex items-center justify-between p-5 border-b border-gray-100">
                        <h2 class="text-lg font-bold text-gray-950 flex items-center gap-2 m-0">
                            <i data-lucide="clock-3" class="w-5 h-5 text-gray-400"></i> Laporan Terbaru
                        </h2>
                        <a href="{{ route('bendahara.keuangan.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 transition-colors flex items-center gap-0.5 no-underline">
                            Lihat semua <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>

                    @if(isset($laporan) && $laporan->count())
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse text-sm">
                                <thead>
                                    <tr class="bg-gray-50/70 border-b border-gray-100">
                                        <th class="px-5 py-3 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Nama Penginput</th>
                                        <th class="px-5 py-3 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Judul</th>
                                        <th class="px-5 py-3 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Kategori</th>
                                        <th class="px-5 py-3 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Tanggal Laporan</th>
                                        <th class="px-5 py-3 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">File</th>
                                        <th class="px-5 py-3 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($laporan as $row)
                                    <tr class="hover:bg-gray-50/40 transition-colors">
                                        <td class="px-5 py-4">
                                            <div class="font-semibold text-gray-900 leading-snug">{{ $row->user?->name ?? '-' }}</div>
                                            @if($row->created_at)
                                                <div class="text-[11px] text-gray-400 mt-0.5">{{ $row->created_at->format('d M Y') }}</div>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4">
                                            <div class="font-semibold text-gray-900 leading-snug">{{ $row->judul }}</div>
                                            @if($row->deskripsi)
                                                <div class="text-xs text-gray-500 mt-0.5 line-clamp-1 max-w-[200px]">{{ $row->deskripsi }}</div>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4">
                                            @if($row->kategori === 'pemasukan')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                                    Pemasukan
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-600"></span>
                                                    Pengeluaran
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4 text-gray-500 text-xs whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($row->tanggal_laporan)->translatedFormat('d M Y') }}
                                        </td>
                                        <td class="px-5 py-4 text-center">
                                            <a href="{{ Storage::url($row->file) }}" target="_blank" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-200 bg-white text-gray-500 hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-200 transition-all shadow-sm" title="Buka PDF">
                                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                            </a>
                                        </td>
                                        <td class="px-5 py-4 text-center">
                                            <form method="POST" action="{{ route('bendahara.keuangan.destroy', $row->id) }}" onsubmit="return confirm('Hapus laporan ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-200 bg-white text-gray-400 hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 transition-all shadow-sm cursor-pointer" title="Hapus">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-12 text-center">
                            <div class="w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-400 mx-auto mb-4 border border-gray-100">
                                <i data-lucide="folder-open" class="w-7 h-7"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900 mb-1">Belum ada laporan keuangan</h3>
                            <p class="text-xs text-gray-500 mb-4">Mulai kelola kas dengan mengunggah berkas laporan pertama Anda.</p>
                            <a href="{{ route('bendahara.keuangan.create') }}" class="inline-flex items-center gap-1.5 bg-emerald-700 hover:bg-emerald-800 text-white font-semibold text-xs py-2.5 px-4 rounded-xl shadow-md transition-all no-underline">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i> Upload PDF pertama Anda
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- RIGHT: Sidebar --}}
            <div class="space-y-6">

                {{-- Aktivitas Terkini --}}
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="flex items-center justify-between p-5 border-b border-gray-100">
                        <h2 class="text-lg font-bold text-gray-950 flex items-center gap-2 m-0">
                            <i data-lucide="activity" class="w-5 h-5 text-gray-400"></i> Aktivitas Terkini
                        </h2>
                        <a href="{{ route('bendahara.keuangan.index') }}" class="text-xs font-semibold text-emerald-700 hover:text-emerald-800 transition-colors no-underline">
                            Semua
                        </a>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @forelse($recentLaporan ?? [] as $item)
                            <div class="p-4 flex items-start gap-3.5 hover:bg-gray-50/50 transition-colors">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 {{ $item->kategori === 'pemasukan' ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                    @if($item->kategori === 'pemasukan')
                                        <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                                    @else
                                        <i data-lucide="arrow-down-left" class="w-4 h-4"></i>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="text-xs font-semibold text-gray-900 truncate">{{ $item->judul }}</div>
                                    <div class="text-[10px] text-gray-400 mt-0.5">{{ \Carbon\Carbon::parse($item->tanggal_laporan)->diffForHumans() }}</div>
                                </div>
                                <a href="{{ Storage::url($item->file) }}" target="_blank" class="inline-flex items-center gap-1 bg-blue-50 hover:bg-blue-100 text-blue-700 text-[10px] font-bold py-1 px-2.5 rounded-lg border border-blue-200 transition-colors no-underline">
                                    PDF
                                </a>
                            </div>
                        @empty
                            <div class="p-8 text-center text-gray-400">
                                <p class="text-xs m-0">Belum ada aktivitas.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Panduan Bendahara --}}
                <div class="bg-amber-50/30 border border-amber-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-5 border-b border-amber-200/60 bg-amber-50/70">
                        <h2 class="text-lg font-bold text-amber-950 flex items-center gap-2 m-0">
                            <i data-lucide="lightbulb" class="w-5 h-5 text-amber-700"></i> Panduan Bendahara
                        </h2>
                    </div>
                    <ul class="p-5 space-y-4 list-none m-0">
                        <li class="flex gap-2.5 text-xs text-amber-950/80 leading-relaxed">
                            <i data-lucide="folder-up" class="w-4 h-4 text-amber-700 shrink-0 mt-0.5"></i>
                            <span>Upload laporan keuangan dalam format PDF untuk arsip yang rapi.</span>
                        </li>
                        <li class="flex gap-2.5 text-xs text-amber-950/80 leading-relaxed">
                            <i data-lucide="tag" class="w-4 h-4 text-amber-700 shrink-0 mt-0.5"></i>
                            <span>Pastikan kategori <strong class="text-amber-900">Pemasukan</strong> dan <strong class="text-amber-900">Pengeluaran</strong> diisi dengan benar.</span>
                        </li>
                        <li class="flex gap-2.5 text-xs text-amber-950/80 leading-relaxed">
                            <i data-lucide="calendar-range" class="w-4 h-4 text-amber-700 shrink-0 mt-0.5"></i>
                            <span>Isi tanggal laporan sesuai dengan tanggal dokumen resmi.</span>
                        </li>
                        <li class="flex gap-2.5 text-xs text-amber-950/80 leading-relaxed">
                            <i data-lucide="trending-up" class="w-4 h-4 text-amber-700 shrink-0 mt-0.5"></i>
                            <span>Pantau perbandingan laporan secara berkala melalui grafik bulanan.</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
