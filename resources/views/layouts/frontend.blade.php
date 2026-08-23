<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0d5c3a">

    <!-- Primary SEO Meta Tags -->
    <title>@yield('title', 'PCM Duren Sawit 1 | Muhammadiyah Berkemajuan')</title>
    <meta name="description" content="@yield('meta_description', 'Pimpinan Cabang Muhammadiyah Duren Sawit 1 - Mencerahkan Semesta, Memajukan Duren Sawit. Update informasi, berita, kajian, program unggulan, dan layanan sosial.')">
    <meta name="keywords" content="@yield('meta_keywords', 'PCM Duren Sawit 1, Muhammadiyah Duren Sawit, Kajian Islam, Amal Usaha Muhammadiyah, Berita Muhammadiyah, Duren Sawit, Organisasi Islam')">
    <meta name="author" content="@yield('meta_author', 'PCM Duren Sawit 1')">
    <meta name="robots" content="@yield('meta_robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1')">
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Open Graph / Facebook / WhatsApp / LinkedIn -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'PCM Duren Sawit 1 | Muhammadiyah Berkemajuan')">
    <meta property="og:description" content="@yield('meta_description', 'Pimpinan Cabang Muhammadiyah Duren Sawit 1 - Mencerahkan Semesta, Memajukan Duren Sawit. Update informasi, berita, kajian, program unggulan, dan layanan sosial.')">
    <meta property="og:image" content="@yield('og_image', 'https://i.pinimg.com/564x/29/e9/30/29e9307518d8366f97a6d26e888c6bf4.jpg')">
    <meta property="og:image:secure_url" content="@yield('og_image', 'https://i.pinimg.com/564x/29/e9/30/29e9307518d8366f97a6d26e888c6bf4.jpg')">
    <meta property="og:site_name" content="PCM Duren Sawit 1">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('title', 'PCM Duren Sawit 1 | Muhammadiyah Berkemajuan')">
    <meta name="twitter:description" content="@yield('meta_description', 'Pimpinan Cabang Muhammadiyah Duren Sawit 1 - Mencerahkan Semesta, Memajukan Duren Sawit. Update informasi, berita, kajian, program unggulan, dan layanan sosial.')">
    <meta name="twitter:image" content="@yield('og_image', 'https://i.pinimg.com/564x/29/e9/30/29e9307518d8366f97a6d26e888c6bf4.jpg')">

    @yield('meta')
    @stack('meta')

    <!-- JSON-LD Structured Data -->
    @yield('schema')
    @stack('schema')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>

    <style>
        :root {
            --primary: #0d5c3a;
            --primary-light: #167a4e;
            --primary-rgb: 13,92,58;

            --secondary: #D4A017;
            --secondary-light: #e8b820;
            --secondary-rgb: 212,160,23;

            --accent: #0f1923;
            --accent-green: #0d2818;
            --accent-rgb: 15,25,35;

            --bg-cream: #f8f5ee;
            --text-dark: #1a1a1a;
        }

        html { scroll-behavior: smooth; }
    </style>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                            display: ['"DM Serif Display"', 'Georgia', 'serif'],
                        },
                        colors: {
                            primary: '#0d5c3a',
                            'primary-light': '#167a4e',
                            secondary: '#D4A017',
                            'secondary-light': '#e8b820',
                            accent: '#0f1923',
                            cream: '#f8f5ee',
                        }
                    }
                }
            }
        </script>
    @endif

    @stack('styles')
    @yield('styles')
</head>
<body class="min-h-screen flex flex-col bg-cream text-gray-900 antialiased">

    @include('layouts.navigation')

    <main class="flex-1">
        @yield('content')
    </main>

    @include('layouts.footer')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
    @yield('scripts')
</body>
</html>
