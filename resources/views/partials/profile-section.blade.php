 <div class="max-w-7xl mx-auto px-6 lg:px-8">

     <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

         <!-- LEFT IMAGE -->
         <div class="relative">
             <img src="{{ $hero?->image ? asset('storage/' . $hero->image) : 'https://picsum.photos/800/600?grayscale' }}"
                 class="w-full h-full object-cover rounded-3xl shadow-2xl" alt="Gambar Profil Organisasi">

             <!-- floating card -->
             <div
                 class="absolute bottom-6 right-6 bg-white px-5 py-4 rounded-2xl shadow-lg border-l-4 border-emerald-600">
                 <h4 class="text-emerald-600 font-bold text-lg">Dakwah</h4>
                 <p class="text-gray-500 text-sm">Berkemajuan</p>
             </div>
         </div>

         <!-- RIGHT CONTENT -->
         <div>

             <!-- label -->
             <div class="flex items-center gap-2 text-emerald-600 font-semibold uppercase text-sm mb-3">
                 <span class="w-2 h-2 bg-emerald-600 rounded-full"></span>
                 Profil Organisasi
             </div>

             <!-- title -->
             <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-5">
                 Mengenal Lebih Dekat <br>
                 <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                     {{ $hero->nama ?? 'Nama Organisasi' }}
                 </h1>
             </h2>

             <!-- description -->
             <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                 {{ $hero->tagline ?? 'Tagline organisasi' }}
             </p>

             <!-- ACCORDION (simple JS version) -->
             <!-- ACCORDION -->
             <div class="space-y-4">

                 <!-- item 1 -->
                 <div class="border rounded-2xl overflow-hidden bg-white shadow-sm">
                     <button onclick="toggleAcc('visi')"
                         class="w-full flex items-center justify-between px-5 py-4 font-semibold text-gray-800">

                         <span class="flex items-center gap-3">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-eye" viewBox="0 0 16 16">
                                 <path
                                     d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                 <path
                                     d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                             </svg>
                             Visi Persyarikatan
                         </span>

                         <span id="icon-visi" class="transition-transform duration-300">+</span>
                     </button>

                     <div id="visi"
                         class="max-h-0 opacity-0 overflow-hidden px-5 text-gray-600 transition-all duration-500 ease-in-out">
                         <p class="text-black text-lg mb-8 max-w-xl mx-auto lg:mx-0">
                             {{ $hero->visi ?? 'Visi organisasi' }}
                         </p>
                     </div>
                 </div>

                 <!-- item 2 -->
                 <!-- item 2 - Misi -->
                 <div class="border rounded-2xl overflow-hidden bg-white shadow-sm">
                     <button onclick="toggleAcc('misi')"
                         class="w-full flex items-center justify-between px-5 py-4 font-semibold text-gray-800">

                         <span class="flex items-center gap-3">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-rainbow" viewBox="0 0 16 16">
                                 <path
                                     d="M8 4.5a7 7 0 0 0-7 7 .5.5 0 0 1-1 0 8 8 0 1 1 16 0 .5.5 0 0 1-1 0 7 7 0 0 0-7-7m0 2a5 5 0 0 0-5 5 .5.5 0 0 1-1 0 6 6 0 1 1 12 0 .5.5 0 0 1-1 0 5 5 0 0 0-5-5m0 2a3 3 0 0 0-3 3 .5.5 0 0 1-1 0 4 4 0 1 1 8 0 .5.5 0 0 1-1 0 3 3 0 0 0-3-3m0 2a1 1 0 0 0-1 1 .5.5 0 0 1-1 0 2 2 0 1 1 4 0 .5.5 0 0 1-1 0 1 1 0 0 0-1-1" />
                             </svg>
                             Misi Utama Kami
                         </span>

                         <span id="icon-misi" class="transition-transform duration-300">+</span>
                     </button>

                     <div id="misi"
                         class="max-h-0 opacity-0 overflow-hidden px-5 text-gray-600 transition-all duration-500 ease-in-out">
                         <div class="pb-5 space-y-2">
                             @if (!empty($hero->misi ?? null))
                                 @php
                                     $misiPoints = explode("\n", $hero->misi);
                                 @endphp
                                 @foreach ($misiPoints as $point)
                                     @if (trim($point))
                                         <div class="flex items-start gap-2">
                                             <span class="text-emerald-500 text-sm mt-0.5">•</span>
                                             <p class="text-gray-700 text-sm leading-relaxed">{{ trim($point) }}</p>
                                         </div>
                                     @endif
                                 @endforeach
                             @else
                                 <p class="text-gray-400 italic text-sm">Misi organisasi akan ditampilkan di sini...</p>
                             @endif
                         </div>
                     </div>
                 </div>

                 <!-- item 3 -->
                 <div class="border rounded-2xl overflow-hidden bg-white shadow-sm">
                     <button onclick="toggleAcc('pengurus')"
                         class="w-full flex items-center justify-between px-5 py-4 font-semibold text-gray-800">

                         <span class="flex items-center gap-3">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-house" viewBox="0 0 16 16">
                                 <path
                                     d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                             </svg>
                             Pimpinan & Majelis
                         </span>

                         <span id="icon-pengurus" class="transition-transform duration-300">+</span>
                     </button>

                     <div id="pengurus"
                         class="max-h-0 opacity-0 overflow-hidden px-5 text-gray-600 transition-all duration-500 ease-in-out">
                         <div class="pb-5">
                             Roda pergerakan PCM Duren Sawit 1 digerakkan secara kolektif oleh Pimpinan Cabang
                             Muhammadiyah beserta
                             Majelis dan Lembaga.
                             <a href="/struktur-organisasi"
                                 class="block mt-3 text-emerald-600 font-semibold hover:underline">
                                 Lihat Struktur Organisasi →
                             </a>
                         </div>
                     </div>
                 </div>

             </div>

         </div>

     </div>
 </div>
