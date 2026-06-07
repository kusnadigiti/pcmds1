<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Autentikasi Dua Faktor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            DEFAULT: '#0d5c3a',
                            light: '#167a4e',
                        },
                        secondary: {
                            DEFAULT: '#D4A017',
                            light: '#e8b820',
                        },
                        accent: {
                            DEFAULT: '#0f1923',
                            green: '#0d2818',
                        },
                        cream: '#f8f5ee',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #f8f5ee;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23D4A017' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .otp-input { letter-spacing: .3em; font-family: 'Courier New', monospace; }
        .otp-input:focus { outline: none; box-shadow: 0 0 0 3px rgba(13, 92, 58, .15); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-12 font-sans">

    <div class="w-full max-w-md">

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-secondary/20 px-8 py-10">

            {{-- Header --}}
            <div class="flex flex-col items-center text-center mb-8">
                <div class="w-14 h-14 bg-primary/5 border border-primary/10 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-gray-900">Aktifkan Autentikasi Dua Faktor</h1>
                <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                    Tingkatkan keamanan akun Anda dengan menggunakan Google Authenticator atau Authy.
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
                <div class="p-3 border border-secondary/20 rounded-xl bg-white mb-2 inline-block shadow-sm">
                    {!! $qrCode !!}
                </div>
                <p class="text-xs text-gray-400">Pindai QR code ini menggunakan aplikasi autentikator Anda</p>
            </div>

            {{-- Steps --}}
            <ol class="space-y-3 mb-6">
                @foreach ([
                    'Pasang Google Authenticator atau Authy di ponsel Anda',
                    'Buka aplikasi lalu pilih "Tambah Akun" dan pindai QR code di atas',
                    'Masukkan 6 digit kode yang muncul di aplikasi pada kolom di bawah',
                ] as $i => $step)
                    <li class="flex items-start gap-3 text-sm text-gray-600 leading-relaxed">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-primary/5 text-primary text-xs font-bold flex items-center justify-center border border-primary/10 mt-0.5">
                            {{ $i + 1 }}
                        </span>
                        <span>{{ $step }}</span>
                    </li>
                @endforeach
            </ol>

            <hr class="border-gray-100 mb-6">

            {{-- Form --}}
            <form method="POST" action="{{ route('bendahara.2fa.activate') }}">
                @csrf

                <label class="block text-xs font-semibold text-gray-600 mb-2">
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
                           focus:border-primary focus:bg-white
                           transition-colors duration-150
                           @error('otp') border-red-400 bg-red-50 @enderror"
                >

                <button
                    type="submit"
                    class="mt-4 w-full h-11 bg-primary hover:bg-primary-light active:scale-[.98]
                           text-white text-sm font-semibold rounded-xl cursor-pointer
                           flex items-center justify-center gap-2
                           transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
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
                    <summary class="text-xs text-gray-400 hover:text-primary transition-colors cursor-pointer select-none text-center list-none font-medium">
                        Tidak bisa memindai? Masukkan kode secara manual ↓
                    </summary>
                    <div class="mt-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-center">
                        <p class="text-[10px] uppercase font-bold tracking-wider text-gray-400 mb-1">Kunci Rahasia (Secret Key)</p>
                        <code class="text-xs font-mono font-semibold text-gray-800 tracking-widest select-all break-all">
                            {{ $secretKey }}
                        </code>
                    </div>
                </details>
            @endif

        </div>

        {{-- Footer --}}
        <p class="text-center text-xs text-gray-400 mt-6">
            Butuh bantuan?
            <a href="{{ route('bendahara.dashboard') }}" class="text-primary hover:underline font-semibold">Kembali ke dashboard</a>
        </p>

    </div>

</body>
</html>
