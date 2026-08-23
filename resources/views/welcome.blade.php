@extends('layouts.frontend')

@section('title', 'PCM Duren Sawit 1 | Muhammadiyah Berkemajuan')
@section('meta_description', 'Pimpinan Cabang Muhammadiyah Duren Sawit 1 - Mencerahkan Semesta, Memajukan Duren Sawit. Portal resmi berita, kajian, organisasi otonom, dan amal usaha Muhammadiyah Duren Sawit 1.')
@section('meta_keywords', 'PCM Duren Sawit 1, Muhammadiyah Duren Sawit, Kajian Islam, Amal Usaha Muhammadiyah, Berita Muhammadiyah, Jakarta Timur')
@section('og_image', 'https://i.pinimg.com/564x/29/e9/30/29e9307518d8366f97a6d26e888c6bf4.jpg')

@section('schema')
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@graph": [
        {
          "@@type": "Organization",
          "@@id": "{{ url('/') }}#organization",
          "name": "PCM Duren Sawit 1",
          "alternateName": "Pimpinan Cabang Muhammadiyah Duren Sawit 1",
          "url": "{{ url('/') }}",
          "logo": "https://i.pinimg.com/564x/29/e9/30/29e9307518d8366f97a6d26e888c6bf4.jpg",
          "description": "Pimpinan Cabang Muhammadiyah Duren Sawit 1 - Mencerahkan Semesta, Memajukan Duren Sawit."
        },
        {
          "@@type": "WebSite",
          "@@id": "{{ url('/') }}#website",
          "url": "{{ url('/') }}",
          "name": "PCM Duren Sawit 1",
          "publisher": {
            "@@id": "{{ url('/') }}#organization"
          },
          "inLanguage": "id-ID"
        },
        {
          "@@type": "ItemList",
          "@@id": "{{ url('/') }}#sitelinks",
          "name": "Navigasi Utama",
          "itemListElement": [
            {
              "@@type": "SiteNavigationElement",
              "position": 1,
              "name": "Struktur Organisasi",
              "description": "Bagan dan susunan pimpinan PCM Duren Sawit 1",
              "url": "{{ route('struktur-organisasi') }}"
            },
            {
              "@@type": "SiteNavigationElement",
              "position": 2,
              "name": "Berita & Informasi",
              "description": "Kabar kegiatan dan berita Muhammadiyah Duren Sawit 1",
              "url": "{{ route('berita.all') }}"
            },
            {
              "@@type": "SiteNavigationElement",
              "position": 3,
              "name": "Artikel & Opini",
              "description": "Kajian dan artikel keislaman berkemajuan",
              "url": "{{ route('articles.show-all') }}"
            },
            {
              "@@type": "SiteNavigationElement",
              "position": 4,
              "name": "Amal Usaha Pendidikan",
              "description": "Unit sekolah dan pendidikan Muhammadiyah Duren Sawit 1",
              "url": "{{ route('amal-usaha.by-kategori', 'bidang-pendidikan') }}"
            },
            {
              "@@type": "SiteNavigationElement",
              "position": 5,
              "name": "Amal Usaha Kesehatan",
              "description": "Layanan dan fasilitas kesehatan Muhammadiyah Duren Sawit 1",
              "url": "{{ route('amal-usaha.by-kategori', 'bidang-kesehatan') }}"
            },
            {
              "@@type": "SiteNavigationElement",
              "position": 6,
              "name": "Amal Usaha Kesejahteraan Sosial",
              "description": "Layanan sosial dan pemberdayaan masyarakat",
              "url": "{{ route('amal-usaha.by-kategori', 'bidang-kesejahteraan-sosial') }}"
            }
          ]
        }
      ]
    }
    </script>
@endsection

@section('styles')
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
@endsection

@section('content')
    <main class="flex-1">

        @include('partials.header-section')

        <div class="pt-20 bg-cream">
            <section id="profil">
                @include('partials.profile-section')
            </section>

            <section id="artikel">
                @include('partials.article-section')
            </section>

            <section id="berita">
                @include('partials.berita-section')
            </section>

            <section id="kegiatan">
                @include('partials.program-unggulan-section')
            </section>

            <section>
                @include('partials.jadwal-modal')
            </section>

            <section>
                @include('partials.modal-sekolah')
            </section>

            <section>
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
        </div>

    </main>
@endsection

@section('scripts')
    <script>
        // Handle smooth scrolling
        function handleNav(e, sectionId) {
            if (window.location.pathname === '/') {
                e.preventDefault();
                let targetId = sectionId;
                if (sectionId === 'beranda') {
                    targetId = 'hero-header';
                }
                document.getElementById(targetId)?.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }

        // Scrollspy logic to highlight active navbar item
        document.addEventListener('DOMContentLoaded', function () {
            if (window.location.pathname !== '/') return;

            const sections = [
                { id: 'hero-header', nav: 'beranda' },
                { id: 'profil', nav: 'profil' },
                { id: 'artikel', nav: 'artikel' },
                { id: 'berita', nav: 'berita' },
                { id: 'kegiatan', nav: 'kegiatan' },
                { id: 'organisasi', nav: 'organisasi' },
                { id: 'amal-usaha', nav: 'amal-usaha' },
                { id: 'kontak', nav: 'kontak' }
            ];

            const navLinks = document.querySelectorAll('[data-nav]');

            function makeActive(navName) {
                navLinks.forEach(link => {
                    const isMobile = link.classList.contains('block');

                    if (link.getAttribute('data-nav') === navName) {
                        if (isMobile) {
                            link.classList.remove('text-white/80');
                            link.classList.add('text-secondary', 'bg-secondary/8', 'font-semibold');
                        } else {
                            link.classList.remove('text-white/80', 'font-medium');
                            link.classList.add('text-secondary', 'font-semibold');
                        }
                    } else {
                        if (isMobile) {
                            link.classList.remove('text-secondary', 'bg-secondary/8', 'font-semibold');
                            link.classList.add('text-white/80');
                        } else {
                            link.classList.remove('text-secondary', 'font-semibold');
                            link.classList.add('text-white/80', 'font-medium');
                        }
                    }
                });
            }

            function updateScrollspy() {
                let scrollPosition = window.scrollY || document.documentElement.scrollTop;
                const offset = 120; // accounting for navigation bar height
                let activeNav = 'beranda';

                for (let i = 0; i < sections.length; i++) {
                    const el = document.getElementById(sections[i].id);
                    if (el) {
                        const top = el.offsetTop - offset;
                        const bottom = top + el.offsetHeight;

                        if (scrollPosition >= top && scrollPosition < bottom) {
                            activeNav = sections[i].nav;
                            break;
                        }
                    }
                }

                // Bottom of the page check
                if ((window.innerHeight + window.scrollY) >= document.documentElement.scrollHeight - 50) {
                    activeNav = 'kontak';
                }

                makeActive(activeNav);
            }

            window.addEventListener('scroll', updateScrollspy);
            updateScrollspy(); // Run on load
        });

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

            window.nextSlide = function () {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateSlider();
            }
            window.prevSlide = function () {
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
        document.addEventListener('keydown', function (e) {
            if (e.key !== 'Escape') return;
            document.querySelectorAll('[id^="modal"]').forEach(function (el) {
                if (!el.classList.contains('hidden') || el.style.display !== 'none') {
                    closeModal(el.id);
                }
            });
        });
    </script>
@endsection