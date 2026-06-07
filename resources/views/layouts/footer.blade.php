@php
    $contact = \App\Models\Contact::first();

    // Default values jika data belum ada di database
    $address = $contact->address ?? 'Gedung Dakwah Muhammadiyah, Jl. Duren Sawit Raya No. 1, Jakarta Timur';
    $phone = $contact->phone ?? '+6285280136056';
    $email = $contact->email ?? 'info@pcmdurensawit1.or.id';
    $daysStart = $contact->operational_days_start ?? 'Senin';
    $daysEnd = $contact->operational_days_end ?? 'Jumat';
    $hoursStart = $contact ? \Carbon\Carbon::parse($contact->working_hours_start)->format('H:i') : '08:00';
    $hoursEnd = $contact ? \Carbon\Carbon::parse($contact->working_hours_end)->format('H:i') : '18:00';
    $mapsUrl = $contact->google_maps_url ?? 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15864.890283559207!2d106.91659!3d-6.234365!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698cb58ca1ebcb%3A0x59543a4090f070b0!2sDuren%20Sawit%2C%20Kec.%20Duren%20Sawit%2C%20Kota%20Jakarta%20Timur%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1778816259461!5m2!1sid!2sid';
@endphp

<footer id="footer" class="bg-gradient-to-b from-accent-green to-accent text-white/65 pt-16 relative overflow-hidden">
    <div class="islamic-pattern absolute inset-0 opacity-30 pointer-events-none"></div>
    <div
        class="absolute -top-[80px] -right-[80px] w-[300px] h-[300px] rounded-full border border-secondary/10 pointer-events-none">
    </div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- LOGO & DESC -->
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="relative">
                        <div
                            class="absolute -inset-0.5 rounded-full bg-gradient-to-br from-secondary to-primary opacity-60">
                        </div>
                        <img src="https://i.pinimg.com/564x/29/e9/30/29e9307518d8366f97a6d26e888c6bf4.jpg"
                            class="w-10 h-10 rounded-full bg-white p-0.5 relative" alt="Logo">
                    </div>
                    <div>
                        <h4 class="text-white font-extrabold text-sm m-0 mb-0.5">PCM Duren Sawit 1</h4>
                        <span class="text-[10px] text-secondary tracking-widest uppercase">Muhammadiyah</span>
                    </div>
                </div>

                <p class="text-white/45 text-xs leading-relaxed mb-4">
                    Mencerahkan Semesta, Memajukan Duren Sawit.
                </p>
            </div>

            <!-- LINK -->
            <div>
                <h5 class="text-white font-bold mb-3 text-xs uppercase tracking-wider">Tautan Cepat</h5>
                <ul class="list-none p-0 m-0 flex flex-col gap-2">
                    <li><a href="#profil"
                            class="text-white/45 hover:text-secondary text-xs no-underline transition duration-200"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-secondary/70 mr-1 inline-block align-middle shrink-0"></i>
                            Profil Organisasi</a></li>
                    <li><a href="#artikel"
                            class="text-white/45 hover:text-secondary text-xs no-underline transition duration-200"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-secondary/70 mr-1 inline-block align-middle shrink-0"></i>
                            Artikel</a></li>
                    <li><a href="#berita"
                            class="text-white/45 hover:text-secondary text-xs no-underline transition duration-200"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-secondary/70 mr-1 inline-block align-middle shrink-0"></i>
                            Berita</a></li>
                    <li><a href="#program"
                            class="text-white/45 hover:text-secondary text-xs no-underline transition duration-200"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-secondary/70 mr-1 inline-block align-middle shrink-0"></i>
                            Program</a></li>
                    <li><a href="#organisasi"
                            class="text-white/45 hover:text-secondary text-xs no-underline transition duration-200"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-secondary/70 mr-1 inline-block align-middle shrink-0"></i>
                            Organisasi Otonom</a></li>
                    <li><a href="#amal-usaha"
                            class="text-white/45 hover:text-secondary text-xs no-underline transition duration-200"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-secondary/70 mr-1 inline-block align-middle shrink-0"></i>
                            Amal Usaha</a></li>
                </ul>
            </div>

            <!-- CONTACT -->
            <div>
                <h5 class="text-white font-bold mb-3 text-xs uppercase tracking-wider">Hubungi Kami</h5>
                <div class="flex flex-col gap-3">
                    <div class="flex gap-2.5 items-start">
                        <i data-lucide="map-pin" class="w-4 h-4 text-secondary shrink-0 mt-0.5"></i>
                        <p class="text-xs text-white/45 max-w-[180px] leading-relaxed m-0">{{ $address }}</p>
                    </div>
                    <div class="flex gap-2.5 items-center">
                        <i data-lucide="phone" class="w-4 h-4 text-secondary shrink-0"></i>
                        <p class="text-xs text-white/45 m-0">{{ $phone }}</p>
                    </div>
                    <div class="flex gap-2.5 items-center">
                        <i data-lucide="mail" class="w-4 h-4 text-secondary shrink-0"></i>
                        <p class="text-xs text-white/45 m-0">{{ $email }}</p>
                    </div>
                    <div class="flex gap-2.5 items-center">
                        <i data-lucide="clock" class="w-4 h-4 text-secondary shrink-0"></i>
                        <p class="text-xs text-white/45 m-0">{{ $daysStart }} – {{ $daysEnd }}, {{ $hoursStart }} –
                            {{ $hoursEnd }} WIB</p>
                    </div>
                </div>
            </div>

            <!-- MAP -->
            <div>
                <h5 class="text-white font-bold mb-3 text-xs uppercase tracking-wider">Lokasi</h5>
                <div class="rounded-xl overflow-hidden border border-secondary/20 h-36">
                    <iframe src="{{ $mapsUrl }}" width="100%" height="100%" class="border-0" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </div>

        <!-- FOOTER BOTTOM -->
        <div
            class="border-t border-secondary/15 mt-10 py-5 flex flex-col gap-2 justify-between items-center text-[11px] text-white/30 md:flex-row">
            <p class="m-0">© {{ date('Y') }} PCM Duren Sawit 1. All rights reserved.</p>
            <div class="flex flex-wrap justify-center gap-3">
                <a href="#" class="text-white/30 hover:text-secondary no-underline transition duration-200">Kebijakan
                    Privasi</a>
                <a href="#" class="text-white/30 hover:text-secondary no-underline transition duration-200">Syarat &
                    Ketentuan</a>
                <span class="text-secondary/40">Created by @bintang.ydha_</span>
            </div>
        </div>

    </div>
</footer>