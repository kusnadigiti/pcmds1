@php
    $contact = \App\Models\Contact::first();

    $address = $contact->address ?? 'Gedung Dakwah Muhammadiyah, Jl. Duren Sawit Raya No. 1, Jakarta Timur';
    $phone = $contact->phone ?? '+6285280136056';
    $email = $contact->email ?? 'info@pcmdurensawit1.or.id';
    $daysStart = $contact->operational_days_start ?? 'Senin';
    $daysEnd = $contact->operational_days_end ?? 'Jumat';
    $hoursStart = $contact ? \Carbon\Carbon::parse($contact->working_hours_start)->format('H:i') : '08:00';
    $hoursEnd = $contact ? \Carbon\Carbon::parse($contact->working_hours_end)->format('H:i') : '16:00';
    $mapsUrl = $contact->google_maps_url ?? 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15864.890283559207!2d106.91659!3d-6.234365!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698cb58ca1ebcb%3A0x59543a4090f070b0!2sDuren%20Sawit%2C%20Kec.%20Duren%20Sawit%2C%20Kota%20Jakarta%20Timur%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1778816259461!5m2!1sid!2sid';

    $waPhone = preg_replace('/[^0-9]/', '', $phone);
    if (strpos($waPhone, '0') === 0) {
        $waPhone = '62' . substr($waPhone, 1);
    }
@endphp

<section id="kontak" class="bg-cream py-24 relative">
    <div class="max-w-7xl mx-auto px-6">

        <div class="mb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                <div>
                    <span class="section-label section-label-dark">Hubungi Kami</span>
                    <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl leading-[1.15] text-gray-900">
                        Ada pertanyaan?<br>
                        <span class="text-primary">Kami siap</span><br>
                        membantu.
                    </h2>
                </div>
                <p class="text-sm text-gray-500 leading-relaxed max-w-sm">
                    Jangan ragu untuk menghubungi kami. Tim kami akan merespons pesan Anda secepatnya di hari kerja.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            <div class="lg:col-span-3 bg-white border border-gray-200 rounded-xl p-8">
                <form onsubmit="kirimKeWA(event)" class="flex flex-col gap-5">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold">Nama</label>
                            <input type="text" id="nama" placeholder="Nama lengkap"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold">Asal / Instansi</label>
                            <input type="text" id="asal" placeholder="Organisasi / pribadi"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold">Subjek</label>
                        <input type="text" id="subjek" placeholder="Perihal pesan"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold">Pesan</label>
                        <textarea id="pesan" rows="5" placeholder="Tuliskan pesan Anda di sini..."
                            class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition resize-none"></textarea>
                    </div>

                    <button type="submit"
                        class="self-start inline-flex items-center gap-2 py-2.5 px-6 bg-primary text-white font-semibold text-sm border-none rounded-lg cursor-pointer transition duration-200 hover:bg-primary-light active:scale-95">
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

                <div class="bg-white border border-gray-200 rounded-xl p-5 flex gap-4">
                    <div class="w-10 h-10 rounded-lg bg-primary/5 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="map-pin" class="w-5 h-5 text-primary"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-gray-400 mb-1 font-semibold">Alamat</p>
                        <p class="text-sm text-gray-600 leading-relaxed">{!! nl2br(e($address)) !!}</p>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-5 flex gap-4">
                    <div class="w-10 h-10 rounded-lg bg-primary/5 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="phone" class="w-5 h-5 text-primary"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-gray-400 mb-1 font-semibold">Telepon</p>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $phone }}</p>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-5 flex gap-4">
                    <div class="w-10 h-10 rounded-lg bg-primary/5 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="mail" class="w-5 h-5 text-primary"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-gray-400 mb-1 font-semibold">Email</p>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $email }}</p>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-5 flex gap-4">
                    <div class="w-10 h-10 rounded-lg bg-secondary/10 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="clock" class="w-5 h-5 text-secondary"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-gray-400 mb-1 font-semibold">Jam Operasional</p>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $daysStart }} –
                            {{ $daysEnd }}<br>{{ $hoursStart }} – {{ $hoursEnd }} WIB</p>
                    </div>
                </div>

            </div>
        </div>

        {{-- Map --}}
        <div class="mt-6 rounded-xl overflow-hidden border border-gray-200 h-64 md:h-80">
            <iframe src="{{ $mapsUrl }}" width="100%" height="100%" class="border-0" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </div>
</section>
