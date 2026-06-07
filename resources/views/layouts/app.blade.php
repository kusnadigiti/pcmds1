<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PCM Duren Sawit 01') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-100 min-h-screen">

    {{-- Wrapper flex: sidebar kiri, konten kanan --}}
    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Konten utama --}}
        <div class="flex flex-col flex-1 min-w-0">

            {{-- Mobile Topbar --}}
            <div class="flex items-center justify-between md:hidden bg-white border-b border-gray-200 px-4 py-2.5 sticky top-0 z-40">
                <div class="flex items-center gap-2.5">
                    <button class="p-2 -ml-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none cursor-pointer" onclick="toggleSidebar()">
                        <svg width="20" height="20" viewBox="0 0 18 18" fill="none">
                            <line x1="2" y1="4.5" x2="16" y2="4.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                            <line x1="2" y1="9" x2="16" y2="9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                            <line x1="2" y1="13.5" x2="16" y2="13.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                        </svg>
                    </button>
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-emerald-600 rounded-lg flex items-center justify-center">
                            <svg width="14" height="14" viewBox="0 0 18 18" fill="none">
                                <rect x="2" y="2" width="6" height="6" rx="1.5" fill="white" fill-opacity="0.9" />
                                <rect x="10" y="2" width="6" height="6" rx="1.5" fill="white" fill-opacity="0.5" />
                                <rect x="2" y="10" width="6" height="6" rx="1.5" fill="white" fill-opacity="0.5" />
                                <rect x="10" y="10" width="6" height="6" rx="1.5" fill="white" fill-opacity="0.9" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-gray-950 text-xs leading-none">PCM Duren Sawit 01</span>
                            <span class="text-[9px] text-gray-400 mt-0.5 leading-none">Admin Panel</span>
                        </div>
                    </div>
                </div>
            </div>

            @isset($header)
                <header class="bg-white shadow shrink-0">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1">
                {{ $slot }}
            </main>

        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>

</html>
