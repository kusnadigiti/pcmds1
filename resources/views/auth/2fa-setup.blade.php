<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Autentikasi Dua Faktor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .otp-input { letter-spacing: .3em; font-family: 'Courier New', monospace; }
        .otp-input:focus { outline: none; box-shadow: 0 0 0 3px rgba(16,185,129,.2); }
    </style>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-12">

    <div class="w-full max-w-md">

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-8 py-10">

            {{-- Header --}}
            <div class="flex flex-col items-center text-center mb-8">
                <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                    </svg>
                </div>
                <h1 class="text-xl font-semibold text-gray-900">Aktifkan Autentikasi Dua Faktor</h1>
                <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                    Tingkatkan keamanan akun bendahara Anda dengan Google Authenticator atau Authy.
                </p>
            </div>

            {{-- Flash success --}}
            @if (session('success'))
                <div class="flex items-start gap-3 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-xl px-4 py-3 mb-6 text-sm">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Error --}}
            @if ($errors->any())
                <div class="flex items-start gap-3 bg-red-50 border border-red-100 text-red-700 rounded-xl px-4 py-3 mb-6 text-sm">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                    </svg>
                    <span>{{ $errors->first('otp') }}</span>
                </div>
            @endif

            {{-- QR Code --}}
            <div class="flex flex-col items-center mb-6">
                <div class="p-3 border border-gray-200 rounded-xl bg-white mb-2 inline-block">
                    {!! $qrCode !!}
                </div>
                <p class="text-xs text-gray-400">Scan QR code ini dengan aplikasi autentikator</p>
            </div>

            {{-- Steps --}}
            <ol class="space-y-2 mb-6">
                @foreach ([
                    'Install Google Authenticator atau Authy di ponsel Anda',
                    'Buka aplikasi lalu pilih "Tambah Akun" dan scan QR code di atas',
                    'Masukkan kode 6 digit yang muncul di aplikasi ke kolom di bawah',
                ] as $i => $step)
                    <li class="flex items-center gap-3 text-sm text-gray-600">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold flex items-center justify-content-center">
                            {{ $i + 1 }}
                        </span>
                        {{ $step }}
                    </li>
                @endforeach
            </ol>

            <hr class="border-gray-100 mb-6">

            {{-- Form --}}
            <form method="POST" action="{{ route('bendahara.2fa.activate') }}">
                @csrf

                <label class="block text-xs font-medium text-gray-600 mb-2">
                    Kode OTP dari aplikasi
                </label>

                <input
                    type="text"
                    name="otp"
                    value="{{ old('otp') }}"
                    placeholder="123 456"
                    maxlength="6"
                    inputmode="numeric"
                    autocomplete="one-time-code"
                    required
                    class="otp-input w-full h-12 text-center text-2xl font-bold tracking-widest border rounded-xl px-4
                           text-gray-900 bg-gray-50 placeholder-gray-300
                           border-gray-200 hover:border-gray-300
                           focus:border-emerald-400 focus:bg-white
                           transition-colors duration-150
                           @error('otp') border-red-400 bg-red-50 @enderror"
                >

                <button
                    type="submit"
                    class="mt-4 w-full h-11 bg-emerald-600 hover:bg-emerald-700 active:scale-[.98]
                           text-white text-sm font-medium rounded-xl
                           flex items-center justify-center gap-2
                           transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Aktifkan 2FA
                </button>
            </form>

            {{-- Manual secret key (collapsed) --}}
            @if (isset($secretKey))
                <details class="mt-5 group">
                    <summary class="text-xs text-gray-400 hover:text-gray-600 cursor-pointer select-none text-center list-none">
                        Tidak bisa scan? Masukkan kode manual ↓
                    </summary>
                    <div class="mt-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-center">
                        <p class="text-xs text-gray-500 mb-1">Secret key</p>
                        <code class="text-sm font-mono font-semibold text-gray-800 tracking-widest select-all break-all">
                            {{ $secretKey }}
                        </code>
                    </div>
                </details>
            @endif

        </div>

        {{-- Footer --}}
        <p class="text-center text-xs text-gray-400 mt-6">
            Butuh bantuan?
            <a href="{{ route('bendahara.dashboard') }}" class="text-emerald-600 hover:underline">Kembali ke dashboard</a>
        </p>

    </div>

</body>
</html>
