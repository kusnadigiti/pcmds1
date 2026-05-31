<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PCM Duren Sawit 01 </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <style>
        html {
            scroll-behavior: smooth;
        }

        /* smooth carousel transition */
        #sliderSistemV2 .carousel-item {
            transition: transform 0.9s ease-in-out, opacity 0.9s ease-in-out;
        }

        /* kasih efek fade + scale biar modern */
        #sliderSistemV2 .carousel-item {
            opacity: 0.4;
            transform: scale(0.98);
        }

        #sliderSistemV2 .carousel-item.active {
            opacity: 1;
            transform: scale(1);
        }

        /* hover effect tombol */
        #sliderSistemV2 .carousel-control-prev-icon,
        #sliderSistemV2 .carousel-control-next-icon {
            transition: all 0.3s ease;
            background-color: rgba(0, 0, 0, 0.6) !important;
        }

        #sliderSistemV2 .carousel-control-prev-icon:hover,
        #sliderSistemV2 .carousel-control-next-icon:hover {
            transform: scale(1.1);
            background-color: rgba(0, 0, 0, 0.8) !important;
        }

        /* smooth text masuk */
        #sliderSistemV2 h2,
        #sliderSistemV2 h5,
        #sliderSistemV2 p,
        #sliderSistemV2 .badge {
            animation: fadeUp 0.8s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col">

    @include('layouts.navigation')

    <main class="flex-1">

        @include('partials.header-section')

        <main class="pt-20 bg-gray-50">
            <section id="profil">
                @include('partials.profile-section')
            </section>

            <section id="artikel">
                @include('partials.article-section')
            </section>

            <section id="berita">
                @include('partials.berita-section')
            </section>

            <section id="program">
                @include('partials.program-unggulan-section')
            </section>

            <section id="profil">
                @include('partials.jadwal-modal')
            </section>

            <section id="profil">
                @include('partials.modal-sekolah')
            </section>

            <section id="profil">
                @include('partials.modal-jsm')
            </section>

            <section id="organisasi">
                @include('partials.organisasi-otonom')
            </section>

            <section id="amal-usaha">
                @include('partials.layanan-section')
            </section>

            <section id="kontak">
                @include('partials.contact-section')
            </section>
        </main>

    </main>

    @include('layouts.footer')

    {{-- Ganti blok <script> yang lama di welcome.blade.php dengan ini --}}
    <script>
        function handleNav(e, sectionId) {
            if (window.location.pathname === '/') {
                e.preventDefault();
                document.getElementById(sectionId)?.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }

        function toggleAcc(id) {
            const content = document.getElementById(id);
            const icon = document.getElementById('icon-' + id);
            if (content.classList.contains('max-h-0')) {
                content.classList.remove('max-h-0', 'opacity-0');
                content.classList.add('max-h-[500px]', 'opacity-100');
                if (icon) icon.style.transform = 'rotate(45deg)';
            } else {
                content.classList.remove('max-h-[500px]', 'opacity-100');
                content.classList.add('max-h-0', 'opacity-0');
                if (icon) icon.style.transform = 'rotate(0deg)';
            }
        }

        // ── Slider ──
        document.addEventListener("DOMContentLoaded", () => {
            let currentIndex = 0;
            const track = document.getElementById("sliderTrack");
            if (!track) return;
            const totalSlides = track.children.length;

            function updateSlider() {
                track.style.transform = `translateX(-${currentIndex * 100}%)`;
            }

            window.nextSlide = function() {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateSlider();
            }
            window.prevSlide = function() {
                currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                updateSlider();
            }

            setInterval(() => nextSlide(), 6000);
        });

        // ── Tab program ──
        function openTab(tabId) {
            document.querySelectorAll('.tab-panel').forEach(el => el.classList.add('hidden'));
            document.getElementById(tabId).classList.remove('hidden');
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-emerald-600', 'text-white');
                btn.classList.add('bg-gray-100');
            });
            event.target.classList.add('bg-emerald-600', 'text-white');
        }

        // ── MODAL — satu fungsi, handle dua jenis modal (hidden class & display:none) ──
        function openModal(id) {
            const el = document.getElementById(id);
            if (!el) return;

            // Hapus hidden (modal lama pakai class hidden)
            el.classList.remove('hidden');
            // Hapus display:none (modal baru pakai style)
            el.style.removeProperty('display');

            // Animasi untuk modal baru (yang punya panel & backdrop)
            const panel = document.getElementById(id + '-panel');
            const backdrop = document.getElementById(id + '-backdrop');
            if (panel) {
                panel.classList.remove('modal-panel-enter');
                void panel.offsetWidth;
                panel.classList.add('modal-panel-enter');
            }
            if (backdrop) {
                backdrop.classList.remove('modal-backdrop-enter');
                void backdrop.offsetWidth;
                backdrop.classList.add('modal-backdrop-enter');
            }

            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            const el = document.getElementById(id);
            if (!el) return;
            el.classList.add('hidden');
            el.style.display = 'none';
            document.body.style.overflow = '';
        }

        // Tutup dengan Escape
        document.addEventListener('keydown', function(e) {
            if (e.key !== 'Escape') return;
            document.querySelectorAll('[id^="modal"]').forEach(function(el) {
                if (!el.classList.contains('hidden') || el.style.display !== 'none') {
                    closeModal(el.id);
                }
            });
        });
    </script>
    </section>

</body>

</html>
