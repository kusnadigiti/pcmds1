@extends('layouts.frontend')

@section('title', 'PCM Duren Sawit 1 | Muhammadiyah Berkemajuan')

@section('meta')
    <meta name="description" content="Pimpinan Cabang Muhammadiyah Duren Sawit 1 - Mencerahkan Semesta, Memajukan Duren Sawit">
@endsection

@section('styles')
    <style>
        html { scroll-behavior: smooth; }
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
        </div>

    </main>
@endsection

@section('scripts')
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
@endsection
