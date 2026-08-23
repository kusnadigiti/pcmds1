@php
    $contact = \App\Models\Contact::first();

    $address = $contact->address ?? 'Gedung Dakwah Muhammadiyah, Jl. Duren Sawit Raya No. 1, Jakarta Timur';
    $phone = $contact->phone ?? '+6285280136056';
    $email = $contact->email ?? 'info@pcmdurensawit1.or.id';
    $daysStart = $contact->operational_days_start ?? 'Senin';
    $daysEnd = $contact->operational_days_end ?? 'Jumat';
    $hoursStart = $contact ? \Carbon\Carbon::parse($contact->working_hours_start)->format('H:i') : '08:00';
    $hoursEnd = $contact ? \Carbon\Carbon::parse($contact->working_hours_end)->format('H:i') : '18:00';
    $mapsUrl = $contact->google_maps_url ?? 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15864.890283559207!2d106.91659!3d-6.234365!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698cb58ca1ebcb%3A0x59543a4090f070b0!2sDuren%20Sawit%2C%20Kec.%20Duren%20Sawit%2C%20Kota%20Jakarta%20Timur%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1778816259461!5m2!1sid!2sid';
@endphp

<footer id="footer" class="bg-accent-green text-white/50 pt-16">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- LOGO & DESC --}}
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="https://i.pinimg.com/564x/29/e9/30/29e9307518d8366f97a6d26e888c6bf4.jpg"
                        class="w-10 h-10 rounded-lg" alt="Logo">
                    <div>
                        <h4 class="text-white font-bold text-sm m-0 mb-0.5">PCM Duren Sawit 1</h4>
                        <span class="text-[10px] text-secondary/70 font-medium tracking-wider uppercase">Muhammadiyah</span>
                    </div>
                </div>
                <p class="text-white/35 text-xs leading-relaxed">
                    Mencerahkan Semesta, Memajukan Duren Sawit.
                </p>
            </div>

            {{-- LINK --}}
            <div>
                <h5 class="text-white/80 font-bold mb-4 text-xs uppercase tracking-wider">Tautan Cepat</h5>
                <ul class="list-none p-0 m-0 flex flex-col gap-2.5">
                    <li><a href="#profil" class="text-white/40 hover:text-secondary text-xs no-underline transition duration-200">Profil Organisasi</a></li>
                    <li><a href="#artikel" class="text-white/40 hover:text-secondary text-xs no-underline transition duration-200">Artikel</a></li>
                    <li><a href="#berita" class="text-white/40 hover:text-secondary text-xs no-underline transition duration-200">Berita</a></li>
                    <li><a href="#program" class="text-white/40 hover:text-secondary text-xs no-underline transition duration-200">Program</a></li>
                    <li><a href="#organisasi" class="text-white/40 hover:text-secondary text-xs no-underline transition duration-200">Organisasi Otonom</a></li>
                    <li><a href="#amal-usaha" class="text-white/40 hover:text-secondary text-xs no-underline transition duration-200">Amal Usaha</a></li>
                </ul>
            </div>

            {{-- CONTACT --}}
            <div>
                <h5 class="text-white/80 font-bold mb-4 text-xs uppercase tracking-wider">Hubungi Kami</h5>
                <div class="flex flex-col gap-3">
                    <div class="flex gap-2.5 items-start">
                        <i data-lucide="map-pin" class="w-4 h-4 text-secondary/60 shrink-0 mt-0.5"></i>
                        <p class="text-xs text-white/40 max-w-[180px] leading-relaxed m-0">{{ $address }}</p>
                    </div>
                    <div class="flex gap-2.5 items-center">
                        <i data-lucide="phone" class="w-4 h-4 text-secondary/60 shrink-0"></i>
                        <p class="text-xs text-white/40 m-0">{{ $phone }}</p>
                    </div>
                    <div class="flex gap-2.5 items-center">
                        <i data-lucide="mail" class="w-4 h-4 text-secondary/60 shrink-0"></i>
                        <p class="text-xs text-white/40 m-0">{{ $email }}</p>
                    </div>
                    <div class="flex gap-2.5 items-center">
                        <i data-lucide="clock" class="w-4 h-4 text-secondary/60 shrink-0"></i>
                        <p class="text-xs text-white/40 m-0">{{ $daysStart }} – {{ $daysEnd }}, {{ $hoursStart }} –
                            {{ $hoursEnd }} WIB</p>
                    </div>
                </div>
            </div>

            {{-- MAP --}}
            <div>
                <h5 class="text-white/80 font-bold mb-4 text-xs uppercase tracking-wider">Lokasi</h5>
                <div class="rounded-xl overflow-hidden border border-white/10 h-36">
                    <iframe src="{{ $mapsUrl }}" width="100%" height="100%" class="border-0" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </div>

        <div class="border-t border-white/10 mt-10 py-5 flex flex-col gap-2 justify-between items-center text-[11px] text-white/25 md:flex-row">
            <p class="m-0">&copy; {{ date('Y') }} PCM Duren Sawit 1. All rights reserved.</p>
            <div class="flex flex-wrap justify-center gap-3">
                <span>Created by @bintang.ydha_ &amp; @ramtxh</span>
            </div>
        </div>

    </div>
</footer>
