<x-app-layout>
    <x-slot name="header">Edit Kontak</x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">

        {{-- Error --}}
        @if ($errors->any())
            <div class="mb-6 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-5 py-3.5 text-sm">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                </svg>
                <div>
                    <p class="font-medium mb-1">Terdapat kesalahan:</p>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.contact.update') }}" x-data="contactForm()" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Card: Informasi Kontak --}}
            <div class="bg-white rounded-2xl border border-zinc-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-zinc-100">
                    <h2 class="text-base font-semibold text-zinc-900">Informasi Kontak</h2>
                    <p class="text-xs text-zinc-400 mt-0.5">Data ini akan ditampilkan di footer dan halaman publik</p>
                </div>

                <div class="p-6 space-y-5">

                    {{-- Alamat --}}
                    <div>
                        <label for="address" class="block text-sm font-medium text-zinc-700 mb-1.5">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="address"
                            name="address"
                            rows="3"
                            required
                            class="w-full rounded-lg border border-zinc-200 px-4 py-2.5 text-sm text-zinc-700
                                   focus:outline-none focus:ring-2 focus:ring-zinc-900/10 focus:border-zinc-300
                                   transition-colors resize-none @error('address') border-red-400 @enderror"
                            placeholder="Masukkan alamat lengkap..."
                        >{{ old('address', $contact->address ?? '') }}</textarea>
                    </div>

                    {{-- Telepon & Email --}}
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-zinc-700 mb-1.5">
                                No. Telepon <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone', $contact->phone ?? '') }}"
                                required
                                placeholder="+628xxxxxxxxxx"
                                class="w-full rounded-lg border border-zinc-200 px-4 py-2.5 text-sm text-zinc-700
                                       focus:outline-none focus:ring-2 focus:ring-zinc-900/10 focus:border-zinc-300
                                       transition-colors @error('phone') border-red-400 @enderror"
                            />
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-zinc-700 mb-1.5">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $contact->email ?? '') }}"
                                required
                                placeholder="info@example.com"
                                class="w-full rounded-lg border border-zinc-200 px-4 py-2.5 text-sm text-zinc-700
                                       focus:outline-none focus:ring-2 focus:ring-zinc-900/10 focus:border-zinc-300
                                       transition-colors @error('email') border-red-400 @enderror"
                            />
                        </div>
                    </div>

                    {{-- Hari Operasional --}}
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label for="operational_days_start" class="block text-sm font-medium text-zinc-700 mb-1.5">
                                Hari Mulai Operasional <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="operational_days_start"
                                name="operational_days_start"
                                required
                                class="w-full rounded-lg border border-zinc-200 px-4 py-2.5 text-sm text-zinc-700
                                       focus:outline-none focus:ring-2 focus:ring-zinc-900/10 focus:border-zinc-300
                                       transition-colors bg-white @error('operational_days_start') border-red-400 @enderror"
                            >
                                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                    <option value="{{ $day }}" {{ old('operational_days_start', $contact->operational_days_start ?? '') === $day ? 'selected' : '' }}>
                                        {{ $day }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="operational_days_end" class="block text-sm font-medium text-zinc-700 mb-1.5">
                                Hari Akhir Operasional <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="operational_days_end"
                                name="operational_days_end"
                                required
                                class="w-full rounded-lg border border-zinc-200 px-4 py-2.5 text-sm text-zinc-700
                                       focus:outline-none focus:ring-2 focus:ring-zinc-900/10 focus:border-zinc-300
                                       transition-colors bg-white @error('operational_days_end') border-red-400 @enderror"
                            >
                                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                    <option value="{{ $day }}" {{ old('operational_days_end', $contact->operational_days_end ?? '') === $day ? 'selected' : '' }}>
                                        {{ $day }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Jam Kerja --}}
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label for="working_hours_start" class="block text-sm font-medium text-zinc-700 mb-1.5">
                                Jam Mulai <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="time"
                                id="working_hours_start"
                                name="working_hours_start"
                                value="{{ old('working_hours_start', $contact ? \Carbon\Carbon::parse($contact->working_hours_start)->format('H:i') : '') }}"
                                required
                                class="w-full rounded-lg border border-zinc-200 px-4 py-2.5 text-sm text-zinc-700
                                       focus:outline-none focus:ring-2 focus:ring-zinc-900/10 focus:border-zinc-300
                                       transition-colors @error('working_hours_start') border-red-400 @enderror"
                            />
                        </div>
                        <div>
                            <label for="working_hours_end" class="block text-sm font-medium text-zinc-700 mb-1.5">
                                Jam Selesai <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="time"
                                id="working_hours_end"
                                name="working_hours_end"
                                value="{{ old('working_hours_end', $contact ? \Carbon\Carbon::parse($contact->working_hours_end)->format('H:i') : '') }}"
                                required
                                class="w-full rounded-lg border border-zinc-200 px-4 py-2.5 text-sm text-zinc-700
                                       focus:outline-none focus:ring-2 focus:ring-zinc-900/10 focus:border-zinc-300
                                       transition-colors @error('working_hours_end') border-red-400 @enderror"
                            />
                        </div>
                    </div>

                </div>
            </div>

            {{-- Card: Google Maps --}}
            <div class="bg-white rounded-2xl border border-zinc-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-zinc-100">
                    <h2 class="text-base font-semibold text-zinc-900">Google Maps</h2>
                    <p class="text-xs text-zinc-400 mt-0.5">Paste kode embed dari Google Maps untuk menampilkan preview peta</p>
                </div>

                <div class="p-6 space-y-4">
                    <div>
                        <label for="google_maps_url" class="block text-sm font-medium text-zinc-700 mb-1.5">
                            Kode Embed Google Maps
                        </label>
                        <textarea
                            id="google_maps_url"
                            name="google_maps_url"
                            rows="4"
                            x-model="mapsInput"
                            x-on:input="parseSrc()"
                            placeholder='<iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" ...></iframe>'
                            class="w-full rounded-lg border border-zinc-200 px-4 py-2.5 text-sm text-zinc-700 font-mono
                                   focus:outline-none focus:ring-2 focus:ring-zinc-900/10 focus:border-zinc-300
                                   transition-colors resize-none @error('google_maps_url') border-red-400 @enderror"
                        ></textarea>
                        <p class="text-xs text-zinc-400 mt-1.5">
                            Cara mendapatkan: Buka Google Maps → Pilih lokasi → Klik "Bagikan" → Tab "Sematkan peta" → Salin kode <code class="bg-zinc-100 px-1 py-0.5 rounded">&lt;iframe&gt;</code> lalu paste di sini.
                        </p>
                    </div>

                    {{-- Parsed URL Info --}}
                    <div x-show="parsedUrl" x-transition class="flex items-start gap-2.5 bg-emerald-50 border border-emerald-200 rounded-lg px-4 py-3">
                        <svg class="w-4 h-4 text-emerald-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="min-w-0">
                            <p class="text-xs font-medium text-emerald-700 mb-0.5">URL berhasil terdeteksi</p>
                            <p class="text-xs text-emerald-600 truncate" x-text="parsedUrl"></p>
                        </div>
                    </div>

                    {{-- Preview --}}
                    <div>
                        <label class="text-[11px] uppercase tracking-wider font-medium text-zinc-400 mb-2 block">Preview Peta</label>
                        <template x-if="parsedUrl && parsedUrl.length > 10">
                            <div class="rounded-xl overflow-hidden border border-zinc-200 bg-zinc-50">
                                <iframe
                                    :src="parsedUrl"
                                    width="100%"
                                    height="300"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </template>
                        <template x-if="!parsedUrl || parsedUrl.length <= 10">
                            <div class="flex flex-col items-center justify-center h-[300px] rounded-xl border-2 border-dashed border-zinc-200 bg-zinc-50 text-zinc-400">
                                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z"/>
                                </svg>
                                <p class="text-sm">Paste kode embed untuk melihat preview peta</p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.contact.index') }}"
                    class="px-5 py-2.5 text-sm font-medium text-zinc-700 bg-white border border-zinc-200 rounded-lg hover:bg-zinc-50 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium bg-zinc-900 text-white rounded-lg hover:bg-zinc-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

    @push('scripts')
    <script>
        function contactForm() {
            const existingUrl = @json(old('google_maps_url', $contact->google_maps_url ?? ''));
            return {
                mapsInput: existingUrl,
                parsedUrl: existingUrl,

                parseSrc() {
                    const input = this.mapsInput.trim();

                    // Cek apakah input mengandung tag <iframe ... src="...">
                    const match = input.match(/src=["']([^"']+)["']/);
                    if (match) {
                        this.parsedUrl = match[1];
                    } else if (input.startsWith('http')) {
                        // Jika user langsung paste URL biasa
                        this.parsedUrl = input;
                    } else {
                        this.parsedUrl = '';
                    }
                }
            }
        }
    </script>
    @endpush
</x-app-layout>

