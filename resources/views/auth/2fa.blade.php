<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Dua Faktor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .otp-input { letter-spacing: .35em; font-family: 'Courier New', monospace; }
        .otp-input:focus { outline: none; box-shadow: 0 0 0 3px rgba(37,99,235,.2); }

        @keyframes pulse-ring {
            0%   { transform: scale(.95); opacity: .7; }
            70%  { transform: scale(1);   opacity: 0;  }
            100% { transform: scale(.95); opacity: 0;  }
        }
        .timer-pulse::before {
            content: '';
            display: block;
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #22c55e;
            animation: pulse-ring 2s ease-out infinite;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-12">

    <div class="w-full max-w-sm">

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-8 py-10">

            {{-- Header --}}
            <div class="flex flex-col items-center text-center mb-8">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 8.25h3m-3 3.75h3m-3 3.75h3"/>
                    </svg>
                </div>
                <h1 class="text-xl font-semibold text-gray-900">Verifikasi Dua Faktor</h1>
                <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                    Masukkan kode 6 digit dari aplikasi autentikator Anda untuk melanjutkan.
                </p>
            </div>

            {{-- Error --}}
            @if ($errors->any())
                <div class="flex items-start gap-3 bg-red-50 border border-red-100 text-red-700 rounded-xl px-4 py-3 mb-6 text-sm">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                    </svg>
                    <span>{{ $errors->first('otp') }}</span>
                </div>
            @endif

            {{-- Info box --}}
            <div class="flex items-start gap-3 bg-blue-50 border border-blue-100 rounded-xl px-4 py-3 mb-6">
                <svg class="w-4 h-4 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                </svg>
                <p class="text-xs text-blue-700 leading-relaxed">
                    Kode berlaku selama <strong class="font-semibold">30 detik</strong>.
                    Gunakan kode terbaru yang muncul di aplikasi Anda.
                </p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('bendahara.2fa.check') }}">
                @csrf

                <label for="otp" class="block text-xs font-medium text-gray-600 mb-2">
                    Kode OTP
                </label>

                <input
                    type="number"
                    id="otp"
                    name="otp"
                    value="{{ old('otp') }}"
                    placeholder="● ● ● ● ● ●"
                    maxlength="6"
                    inputmode="numeric"
                    autocomplete="one-time-code"
                    autofocus
                    required
                    class="otp-input w-full h-14 text-center text-2xl font-bold border rounded-xl px-4
                           text-gray-900 bg-gray-50 placeholder-gray-300
                           border-gray-200 hover:border-gray-300
                           focus:border-blue-400 focus:bg-white
                           transition-colors duration-150
                           @error('otp') border-red-400 bg-red-50 @enderror"
                >

                {{-- Timer indicator --}}
                <div class="flex items-center gap-2 mt-3 mb-5">
                    <span class="timer-pulse flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-green-500 inline-block"></span>
                    </span>
                    <span class="text-xs text-gray-400" id="timer-text">Kode diperbarui setiap 30 detik</span>
                    <span class="ml-auto text-xs font-mono font-semibold text-gray-500" id="timer-count">--</span>
                </div>

                <button
                    type="submit"
                    class="w-full h-11 bg-blue-600 hover:bg-blue-700 active:scale-[.98]
                           text-white text-sm font-medium rounded-xl
                           flex items-center justify-center gap-2
                           transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                    </svg>
                    Verifikasi Sekarang
                </button>
            </form>

            {{-- Back link --}}
            <div class="mt-5 text-center">
                <a
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="text-xs text-gray-400 hover:text-gray-600 transition-colors"
                >
                    ← Kembali ke halaman login
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                    @csrf
                </form>
            </div>

        </div>

        {{-- Branding --}}
        <p class="text-center text-xs text-gray-400 mt-6">
            Dilindungi dengan autentikasi dua faktor &middot;
            <span class="text-gray-500 font-medium">Sistem Bendahara</span>
        </p>

    </div>

    {{-- TOTP countdown timer --}}
    <script>
        (function () {
            const el = document.getElementById('timer-count');
            if (!el) return;
            function update() {
                const secs = 30 - (Math.floor(Date.now() / 1000) % 30);
                el.textContent = secs + 's';
                el.className = secs <= 5
                    ? 'ml-auto text-xs font-mono font-semibold text-red-500'
                    : 'ml-auto text-xs font-mono font-semibold text-gray-500';
            }
            update();
            setInterval(update, 1000);
        })();
    </script>

</body>
</html>
