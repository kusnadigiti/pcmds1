@extends('layouts.colormag')

@section('title', 'Hubungi Kami — PCM Duren Sawit 1')
@section('meta_description', 'Alamat, telepon, email, jam operasional, dan lokasi Pimpinan Cabang Muhammadiyah Duren Sawit 1.')
@section('meta_keywords', 'Kontak PCM Duren Sawit 1, Alamat Muhammadiyah Duren Sawit, Hubungi PCM Duren Sawit 1')
@section('og_image', asset('images/logo.png'))

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

    // Format nomor WhatsApp
    $waPhone = preg_replace('/[^0-9]/', '', $phone);
    if (strpos($waPhone, '0') === 0) {
        $waPhone = '62' . substr($waPhone, 1);
    }
@endphp

@section('content')
    <div class="cm-inner px-2.5">

        {{-- Breadcrumb --}}
        <nav aria-label="Breadcrumb" class="text-[12px] text-[#888888] mb-4">
            <a href="/" class="text-[#2e9e5b] no-underline hover:text-[#268a4f] cm-transition">Beranda</a>
            <span class="mx-1">/</span> Hubungi Kami
        </nav>

        {{-- Header --}}
        <h1 class="cm-widget-title !text-[22px]"><span>Hubungi Kami</span></h1>
        <p class="text-[13px] text-[#777777] mt-[-6px] mb-[25px]">
            Ada pertanyaan? Kami siap membantu. Tim kami akan merespons pesan Anda di hari kerja.
        </p>

        {{-- Kartu info kontak --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[15px] mb-[30px]">
            <div class="bg-white border border-[#eaeaea] cm-card-shadow p-5 border-t-2 !border-t-[#2e9e5b]">
                <i data-lucide="map-pin" class="w-6 h-6 text-[#2e9e5b]"></i>
                <h3 class="text-[13px] font-bold text-[#333333] uppercase tracking-wide mt-3 mb-1.5">Alamat</h3>
                <p class="text-[13px] text-[#555555] leading-relaxed m-0">{{ $address }}</p>
            </div>
            <div class="bg-white border border-[#eaeaea] cm-card-shadow p-5 border-t-2 !border-t-[#2e9e5b]">
                <i data-lucide="phone" class="w-6 h-6 text-[#2e9e5b]"></i>
                <h3 class="text-[13px] font-bold text-[#333333] uppercase tracking-wide mt-3 mb-1.5">Telepon / WhatsApp</h3>
                <a href="https://wa.me/{{ $waPhone }}" target="_blank" rel="noopener"
                    class="text-[13px] text-[#2e9e5b] no-underline hover:text-[#268a4f] hover:underline cm-transition">{{ $phone }}</a>
            </div>
            <div class="bg-white border border-[#eaeaea] cm-card-shadow p-5 border-t-2 !border-t-[#2e9e5b]">
                <i data-lucide="mail" class="w-6 h-6 text-[#2e9e5b]"></i>
                <h3 class="text-[13px] font-bold text-[#333333] uppercase tracking-wide mt-3 mb-1.5">Email</h3>
                <a href="mailto:{{ $email }}"
                    class="text-[13px] text-[#2e9e5b] no-underline hover:text-[#268a4f] hover:underline break-all cm-transition">{{ $email }}</a>
            </div>
            <div class="bg-white border border-[#eaeaea] cm-card-shadow p-5 border-t-2 !border-t-[#2e9e5b]">
                <i data-lucide="clock" class="w-6 h-6 text-[#2e9e5b]"></i>
                <h3 class="text-[13px] font-bold text-[#333333] uppercase tracking-wide mt-3 mb-1.5">Jam Operasional</h3>
                <p class="text-[13px] text-[#555555] leading-relaxed m-0">{{ $daysStart }} - {{ $daysEnd }}, {{ $hoursStart }} - {{ $hoursEnd }} WIB</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[70.17%_1fr] gap-[30px] items-start pb-5">

            {{-- ══ FORM KONTAK ══ --}}
            <div class="min-w-0">
                <h3 class="cm-widget-title"><span>Kirim Pesan</span></h3>
                <div class="bg-white border border-[#eaeaea] cm-card-shadow p-5 md:p-7">
                    <form onsubmit="kirimKeWA(event)" class="flex flex-col gap-4">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1.5">
                                <label for="nama" class="text-[12px] font-semibold text-[#333333]">Nama</label>
                                <input type="text" id="nama" placeholder="Nama lengkap"
                                    class="w-full border border-[#cccccc] rounded-none px-3 py-2.5 text-[14px] text-[#333333] focus:outline-none focus:border-[#2e9e5b] cm-transition"/>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label for="asal" class="text-[12px] font-semibold text-[#333333]">Asal / Instansi</label>
                                <input type="text" id="asal" placeholder="Organisasi / pribadi"
                                    class="w-full border border-[#cccccc] rounded-none px-3 py-2.5 text-[14px] text-[#333333] focus:outline-none focus:border-[#2e9e5b] cm-transition"/>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="subjek" class="text-[12px] font-semibold text-[#333333]">Subjek</label>
                            <input type="text" id="subjek" placeholder="Perihal pesan"
                                class="w-full border border-[#cccccc] rounded-none px-3 py-2.5 text-[14px] text-[#333333] focus:outline-none focus:border-[#2e9e5b] cm-transition"/>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="pesan" class="text-[12px] font-semibold text-[#333333]">Pesan</label>
                            <textarea id="pesan" rows="6" placeholder="Tuliskan pesan Anda di sini..."
                                class="w-full border border-[#cccccc] rounded-none px-3 py-2.5 text-[14px] text-[#333333] focus:outline-none focus:border-[#2e9e5b] resize-y cm-transition"></textarea>
                        </div>

                        <div>
                            <button type="submit"
                                class="inline-flex items-center gap-2 bg-[#2e9e5b] hover:bg-[#268a4f] text-white text-[13px] font-bold uppercase tracking-wide px-6 py-3 border-0 rounded-[3px] cursor-pointer cm-transition">
                                Kirim via WhatsApp <i data-lucide="send" class="w-4 h-4"></i>
                            </button>
                            <p class="text-[12px] text-[#888888] mt-3 mb-0">Pesan akan dibuka melalui aplikasi WhatsApp Anda.</p>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ══ PETA ══ --}}
            <aside class="min-w-0">
                <h3 class="cm-widget-title"><span>Lokasi Kami</span></h3>
                <div class="border border-[#eaeaea] cm-card-shadow">
                    <iframe src="{{ $mapsUrl }}" width="100%" height="380" class="border-0 block w-full"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        title="Peta lokasi PCM Duren Sawit 1"></iframe>
                </div>
            </aside>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function kirimKeWA(event) {
            event.preventDefault();
            const nama = document.getElementById('nama').value.trim();
            const asal = document.getElementById('asal').value.trim();
            const subjek = document.getElementById('subjek').value.trim();
            const pesan = document.getElementById('pesan').value.trim();

            if (!nama || !pesan) {
                alert('Mohon isi nama dan pesan terlebih dahulu.');
                return;
            }

            const teks =
                'Halo, saya ' + nama +
                (asal ? ' dari ' + asal : '') + '.\n\n' +
                (subjek ? 'Subjek: ' + subjek + '\n\n' : '') +
                pesan;

            const url = 'https://wa.me/{{ $waPhone }}?text=' + encodeURIComponent(teks);
            window.open(url, '_blank');
        }
    </script>
@endsection
