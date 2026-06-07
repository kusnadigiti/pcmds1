{{-- ═══════════════════════════════════════════════════════════════
CONTACT SECTION — Cream theme, fully styled with Tailwind CSS
═══════════════════════════════════════════════════════════════ --}}

@php
    $contact = \App\Models\Contact::first();

    // Default values jika data belum ada di database
    $address = $contact->address ?? 'Gedung Dakwah Muhammadiyah, Jl. Duren Sawit Raya No. 1, Jakarta Timur';
    $phone = $contact->phone ?? '+6285280136056';
    $email = $contact->email ?? 'info@pcmdurensawit1.or.id';
    $daysStart = $contact->operational_days_start ?? 'Senin';
    $daysEnd = $contact->operational_days_end ?? 'Jumat';
    $hoursStart = $contact ? \Carbon\Carbon::parse($contact->working_hours_start)->format('H:i') : '08:00';
    $hoursEnd = $contact ? \Carbon\Carbon::parse($contact->working_hours_end)->format('H:i') : '16:00';
    $mapsUrl = $contact->google_maps_url ?? 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15864.890283559207!2d106.91659!3d-6.234365!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698cb58ca1ebcb%3A0x59543a4090f070b0!2sDuren%20Sawit%2C%20Kec.%20Duren%20Sawit%2C%20Kota%20Jakarta%20Timur%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1778816259461!5m2!1sid!2sid';

    // Format nomor WhatsApp (hanya angka, ganti 0 di depan dengan 62)
    $waPhone = preg_replace('/[^0-9]/', '', $phone);
    if (strpos($waPhone, '0') === 0) {
        $waPhone = '62' . substr($waPhone, 1);
    }
@endphp

<section id="kontak" class="bg-cream py-20 relative overflow-hidden">
    {{-- Background pattern --}}
    <div class="islamic-pattern absolute inset-0 opacity-[0.35] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">

        <div class="mb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight text-gray-900 m-0">
                    Ada pertanyaan?<br>
                    <span class="text-primary">Kami siap</span><br>
                    membantu.
                </h2>
                <p class="text-sm text-gray-600 leading-relaxed max-w-sm">
                    Jangan ragu untuk menghubungi kami. Tim kami akan merespons pesan Anda secepatnya di hari kerja.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            <div class="lg:col-span-3 bg-white border border-primary/10 rounded-2xl p-8 shadow-xl shadow-primary/5">
                <form onsubmit="kirimKeWA(event)" class="flex flex-col gap-5">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[10px] uppercase tracking-wider text-gray-400">Nama</label>
                            <input type="text" id="nama" placeholder="Nama lengkap"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[10px] uppercase tracking-wider text-gray-400">Asal / Instansi</label>
                            <input type="text" id="asal" placeholder="Organisasi / pribadi"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] uppercase tracking-wider text-gray-400">Subjek</label>
                        <input type="text" id="subjek" placeholder="Perihal pesan"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] uppercase tracking-wider text-gray-400">Pesan</label>
                        <textarea id="pesan" rows="5" placeholder="Tuliskan pesan Anda di sini..."
                            class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition resize-none"></textarea>
                    </div>

                    <button type="submit"
                        class="self-start inline-flex items-center gap-2 py-2.5 px-6 bg-gradient-to-r from-primary to-primary-light text-white font-bold text-sm border-none rounded-full cursor-pointer shadow-lg shadow-primary/20 transition duration-200 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30 active:scale-95">
                        Kirim via WhatsApp
                        <i data-lucide="send" class="w-4 h-4"></i>
                    </button>

                </form>

                <script>
                    function kirimKeWA(e) {
                        e.preventDefault();

                        const nama = document.getElementById('nama').value.trim();
                        const asal = document.getElementById('asal').value.trim();
                        const subjek = document.getElementById('subjek').value.trim();
                        const pesan = document.getElementById('pesan').value.trim();

                        if (!nama || !pesan) {
                            alert('Nama dan pesan wajib diisi.');
                            return;
                        }

                        const nomorWA = '{{ $waPhone }}';

                        const teks =
                            `Assalamu'alaikum, PCM Duren Sawit 1.
\n*Nama*: ${nama}
*Asal/Instansi*: ${asal || '-'}
*Subjek*: ${subjek || '-'}
\n*Pesan*:
${pesan}`;

                        const url = `https://wa.me/${nomorWA}?text=${encodeURIComponent(teks)}`;
                        window.open(url, '_blank');
                    }
                </script>
            </div>

            <div class="lg:col-span-2 flex flex-col gap-4">

                <div class="bg-white border border-primary/10 rounded-2xl p-5 flex gap-4">
                    <div
                        class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0 text-primary">
                        <i data-lucide="map-pin" class="w-5 h-5 text-primary"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-gray-400 mb-1">Alamat</p>
                        <p class="text-sm text-gray-700 leading-relaxed">{!! nl2br(e($address)) !!}</p>
                    </div>
                </div>

                <div class="bg-white border border-primary/10 rounded-2xl p-5 flex gap-4">
                    <div
                        class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0 text-primary">
                        <i data-lucide="phone" class="w-5 h-5 text-primary"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-gray-400 mb-1">Telepon</p>
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $phone }}</p>
                    </div>
                </div>

                <div class="bg-white border border-primary/10 rounded-2xl p-5 flex gap-4">
                    <div
                        class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0 text-primary">
                        <i data-lucide="mail" class="w-5 h-5 text-primary"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-gray-400 mb-1">Email</p>
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $email }}</p>
                    </div>
                </div>

                <div class="bg-white border border-secondary/15 rounded-2xl p-5 flex gap-4">
                    <div
                        class="w-10 h-10 rounded-xl bg-secondary/10 flex items-center justify-center flex-shrink-0 text-secondary">
                        <i data-lucide="clock" class="w-5 h-5 text-secondary"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-gray-400 mb-1">Jam Operasional</p>
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $daysStart }} –
                            {{ $daysEnd }}<br>{{ $hoursStart }} – {{ $hoursEnd }} WIB</p>
                    </div>
                </div>

            </div>
        </div>

        {{-- Map --}}
        <div
            class="mt-6 rounded-2xl overflow-hidden border-2 border-primary/15 h-64 md:h-80 shadow-xl shadow-primary/5">
            <iframe src="{{ $mapsUrl }}" width="100%" height="100%" class="border-0" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </div>
</section>