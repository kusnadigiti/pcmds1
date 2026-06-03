<x-app-layout>
    <x-slot name="header">Kelola Kontak</x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">

        {{-- Flash success --}}
        @if (session('success'))
            <div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-5 py-3.5 text-sm">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($contact)
            {{-- Header Card --}}
            <div class="bg-white rounded-2xl border border-zinc-200 overflow-hidden">

                {{-- Top Bar --}}
                <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-zinc-900 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-semibold text-zinc-900">Informasi Kontak</h2>
                            <p class="text-xs text-zinc-400">Data kontak organisasi yang ditampilkan di halaman publik</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.contact.edit') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium bg-zinc-900 text-white rounded-lg hover:bg-zinc-800 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931z"/>
                        </svg>
                        Edit Kontak
                    </a>
                </div>

                {{-- Detail Grid --}}
                <div class="grid md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-zinc-100">

                    {{-- Left: Info --}}
                    <div class="p-6 space-y-5">

                        {{-- Alamat --}}
                        <div>
                            <label class="text-[11px] uppercase tracking-wider font-medium text-zinc-400 mb-1.5 block">Alamat</label>
                            <div class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-zinc-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                </svg>
                                <p class="text-sm text-zinc-700 leading-relaxed">{{ $contact->address }}</p>
                            </div>
                        </div>

                        {{-- Telepon --}}
                        <div>
                            <label class="text-[11px] uppercase tracking-wider font-medium text-zinc-400 mb-1.5 block">No. Telepon</label>
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-zinc-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                                </svg>
                                <p class="text-sm text-zinc-700 font-mono">{{ $contact->phone }}</p>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="text-[11px] uppercase tracking-wider font-medium text-zinc-400 mb-1.5 block">Email</label>
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-zinc-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                </svg>
                                <p class="text-sm text-zinc-700">{{ $contact->email }}</p>
                            </div>
                        </div>

                        {{-- Hari Operasional --}}
                        <div>
                            <label class="text-[11px] uppercase tracking-wider font-medium text-zinc-400 mb-1.5 block">Hari Operasional</label>
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-zinc-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                </svg>
                                <p class="text-sm text-zinc-700">{{ $contact->operational_days_start }} – {{ $contact->operational_days_end }}</p>
                            </div>
                        </div>

                        {{-- Jam Kerja --}}
                        <div>
                            <label class="text-[11px] uppercase tracking-wider font-medium text-zinc-400 mb-1.5 block">Jam Kerja</label>
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-zinc-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-sm text-zinc-700">
                                    {{ \Carbon\Carbon::parse($contact->working_hours_start)->format('H:i') }}
                                    –
                                    {{ \Carbon\Carbon::parse($contact->working_hours_end)->format('H:i') }} WIB
                                </p>
                            </div>
                        </div>

                    </div>

                    {{-- Right: Google Maps Preview --}}
                    <div class="p-6">
                        <label class="text-[11px] uppercase tracking-wider font-medium text-zinc-400 mb-3 block">Preview Lokasi Google Maps</label>
                        @if ($contact->google_maps_url)
                            <div class="rounded-xl overflow-hidden border border-zinc-200 bg-zinc-50">
                                <iframe
                                    src="{{ $contact->google_maps_url }}"
                                    width="100%"
                                    height="320"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center h-[320px] rounded-xl border-2 border-dashed border-zinc-200 bg-zinc-50 text-zinc-400">
                                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z"/>
                                </svg>
                                <p class="text-sm">Belum ada URL Google Maps</p>
                            </div>
                        @endif
                    </div>

                </div>

                {{-- Terakhir diperbarui --}}
                <div class="px-6 py-3 bg-zinc-50 border-t border-zinc-100 text-xs text-zinc-400">
                    Terakhir diperbarui: {{ $contact->updated_at->translatedFormat('d F Y, H:i') }} WIB
                </div>

            </div>
        @else
            {{-- Belum ada data --}}
            <div class="bg-white rounded-2xl border border-zinc-200 p-12 text-center">
                <svg class="w-12 h-12 text-zinc-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                </svg>
                <h3 class="text-lg font-semibold text-zinc-700 mb-1">Belum Ada Data Kontak</h3>
                <p class="text-sm text-zinc-400 mb-6">Silakan tambahkan informasi kontak untuk ditampilkan di halaman publik.</p>
                <a href="{{ route('admin.contact.edit') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium bg-zinc-900 text-white rounded-lg hover:bg-zinc-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    Tambah Data Kontak
                </a>
            </div>
        @endif

    </div>
</x-app-layout>