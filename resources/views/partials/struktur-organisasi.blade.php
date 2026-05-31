<section id="struktur-organisasi" class="relative py-32 bg-white overflow-hidden">

    <!-- Background subtle gradient blur -->
    <div class="absolute -top-40 -left-40 w-[500px] h-[500px] bg-gray-200 rounded-full blur-[120px] opacity-40"></div>
    <div class="absolute -bottom-40 -right-40 w-[500px] h-[500px] bg-gray-200 rounded-full blur-[120px] opacity-40"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">

        <!-- Header -->
        <div class="text-center mb-28">
            <p class="text-[11px] tracking-[0.4em] uppercase text-gray-400 mb-6">
                Organisasi
            </p>

            <h2 class="font-serif text-6xl md:text-7xl leading-[1.05] tracking-tight text-gray-900">
                Struktur <br>
                <em class="italic">Kepengurusan</em>
            </h2>
        </div>

        @php
            $lv1 = $strukturs->where('peran_level',1);
            $lv2 = $strukturs->where('peran_level',2);
            $lv3 = $strukturs->where('peran_level',3);
        @endphp

        <!-- ================= LEVEL 1 ================= -->
        <div class="mb-40">

            <div class="text-center mb-16">
                <p class="text-[11px] tracking-[0.4em] uppercase text-gray-400">
                    Pimpinan Utama
                </p>
            </div>

            <div class="flex justify-center flex-wrap gap-20">

                @foreach($lv1 as $item)
                <div class="org-card opacity-0 translate-y-16 transition-all duration-700 ease-[cubic-bezier(.22,1,.36,1)] w-[260px] text-center">

                    <div class="relative w-[120px] h-[120px] mx-auto mb-6 rounded-full overflow-hidden bg-gray-100">
                        @if($item->image)
                            <img src="{{ asset('storage/'.$item->image) }}"
                                 class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-700 ease-[cubic-bezier(.22,1,.36,1)] hover:scale-110">
                        @endif
                    </div>

                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                        {{ $item->nama }}
                    </h3>

                    <p class="text-[11px] tracking-[0.25em] uppercase text-gray-400">
                        {{ $item->peran }}
                    </p>

                </div>
                @endforeach

            </div>
        </div>

        <!-- Connector -->
        <div class="w-px h-24 bg-gray-200 mx-auto mb-32"></div>

        <!-- ================= LEVEL 2 ================= -->
        <div class="mb-40">

            <div class="text-center mb-16">
                <p class="text-[11px] tracking-[0.4em] uppercase text-gray-400">
                    Sekretariat
                </p>
            </div>

            <div class="flex justify-center flex-wrap gap-20">

                @foreach($lv2 as $item)
                <div class="org-card opacity-0 translate-y-16 transition-all duration-700 ease-[cubic-bezier(.22,1,.36,1)] w-[240px] text-center">

                    <div class="relative w-[110px] h-[110px] mx-auto mb-6 rounded-full overflow-hidden bg-gray-100">
                        @if($item->image)
                            <img src="{{ asset('storage/'.$item->image) }}"
                                 class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-700 ease-[cubic-bezier(.22,1,.36,1)] hover:scale-110">
                        @endif
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        {{ $item->nama }}
                    </h3>

                    <p class="text-[11px] tracking-[0.25em] uppercase text-gray-400">
                        {{ $item->peran }}
                    </p>

                </div>
                @endforeach

            </div>
        </div>

        <!-- Connector -->
        <div class="w-px h-24 bg-gray-200 mx-auto mb-32"></div>

        <!-- ================= LEVEL 3 ================= -->
        <div>

            <div class="text-center mb-16">
                <p class="text-[11px] tracking-[0.4em] uppercase text-gray-400">
                    Bidang / Divisi
                </p>
            </div>

            <div class="flex justify-center flex-wrap gap-16">

                @foreach($lv3 as $item)
                <div class="org-card opacity-0 translate-y-16 transition-all duration-700 ease-[cubic-bezier(.22,1,.36,1)] w-[220px] text-center">

                    <div class="relative w-[100px] h-[100px] mx-auto mb-5 rounded-full overflow-hidden bg-gray-100">
                        @if($item->image)
                            <img src="{{ asset('storage/'.$item->image) }}"
                                 class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-700 ease-[cubic-bezier(.22,1,.36,1)] hover:scale-110">
                        @endif
                    </div>

                    <h3 class="text-base font-semibold text-gray-900 mb-1">
                        {{ $item->nama }}
                    </h3>

                    <p class="text-[10px] tracking-[0.25em] uppercase text-gray-400">
                        {{ $item->peran }}
                    </p>

                </div>
                @endforeach

            </div>
        </div>

    </div>

    <!-- Scroll Reveal Animation -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const cards = document.querySelectorAll('.org-card');

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if(entry.isIntersecting){
                        entry.target.classList.remove('opacity-0','translate-y-16');
                        entry.target.classList.add('opacity-100','translate-y-0');
                    }
                });
            }, { threshold: 0.15 });

            cards.forEach(card => observer.observe(card));

        });
    </script>

</section>
