<x-guest-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;700&family=Amiri:wght@400;700&display=swap');
@import url('https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css');

body {
    background: #f5f2eb !important;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Lato', sans-serif;
}

.login-card {
    display: flex;
    width: 100%;
    max-width: 860px;
    min-height: 560px;
    border-radius: 16px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 8px 40px rgba(0,0,0,0.1);
}

/* LEFT PANEL */
.login-left {
    width: 42%;
    background: #1a3a2a;
    padding: 2.5rem 2rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    overflow: hidden;
}
.login-left::before {
    content: '';
    position: absolute;
    top: -60px; left: -60px;
    width: 200px; height: 200px;
    border-radius: 50%;
    border: 1px solid rgba(212,175,55,0.15);
}
.login-left::after {
    content: '';
    position: absolute;
    bottom: -80px; right: -80px;
    width: 240px; height: 240px;
    border-radius: 50%;
    border: 1px solid rgba(212,175,55,0.12);
}
.geo-pattern {
    position: absolute;
    inset: 0;
    opacity: 0.04;
    background-image: repeating-linear-gradient(45deg, #d4af37 0, #d4af37 1px, transparent 0, transparent 50%);
    background-size: 18px 18px;
}
.mosque-icon {
    position: relative;
    z-index: 1;
    text-align: center;
    margin-bottom: 1rem;
}
.mosque-icon svg { width: 72px; height: 72px; }
.left-brand { position: relative; z-index: 1; }
.left-brand .org-name {
    font-family: 'Amiri', serif;
    font-size: 12px;
    color: #d4af37;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 6px;
    opacity: 0.85;
}
.left-brand h1 {
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    font-weight: 700;
    color: #f0ead6;
    line-height: 1.3;
    margin-bottom: 6px;
}
.left-brand .subtitle {
    font-size: 12px;
    color: rgba(240,234,214,0.5);
    letter-spacing: 1px;
    font-weight: 300;
}
.left-quote { position: relative; z-index: 1; }
.divider-line {
    width: 36px; height: 1px;
    background: rgba(212,175,55,0.35);
    margin-bottom: 1rem;
}
.left-quote p {
    font-family: 'Amiri', serif;
    font-size: 17px;
    color: rgba(212,175,55,0.8);
    line-height: 1.7;
    margin-bottom: 6px;
    font-style: italic;
}
.left-quote .quran-ref {
    font-size: 11px;
    color: rgba(240,234,214,0.4);
    letter-spacing: 1px;
}

/* RIGHT PANEL */
.login-right {
    flex: 1;
    padding: 2.5rem 2.5rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: #fff;
}
.login-right h2 {
    font-family: 'Playfair Display', serif;
    font-size: 24px;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 4px;
}
.gold-accent { color: #d4af37; }
.login-tagline {
    font-size: 13px;
    color: #888;
    margin-bottom: 2rem;
    font-weight: 300;
}
.ornament {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 1.75rem;
}
.ornament-line { flex: 1; height: 0.5px; background: #e0ddd6; }
.ornament-star { color: #d4af37; font-size: 14px; }

/* FORM OVERRIDES */
.form-group-pcm { margin-bottom: 1.25rem; }
.form-group-pcm label {
    display: block;
    font-size: 11px !important;
    font-weight: 700 !important;
    color: #888 !important;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 6px;
}
.input-wrap-pcm { position: relative; }
.input-wrap-pcm i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 16px;
    color: #aaa;
    pointer-events: none;
    z-index: 1;
}
.input-wrap-pcm input {
    width: 100% !important;
    padding: 10px 12px 10px 38px !important;
    border: 1px solid #e0ddd6 !important;
    border-radius: 8px !important;
    font-size: 14px !important;
    font-family: 'Lato', sans-serif !important;
    background: #faf9f7 !important;
    color: #1a1a1a !important;
    box-shadow: none !important;
    transition: border-color 0.2s, box-shadow 0.2s;
    outline: none;
}
.input-wrap-pcm input::placeholder { color: #bbb; }
.input-wrap-pcm input:focus {
    border-color: #2d6a4f !important;
    box-shadow: 0 0 0 3px rgba(45,106,79,0.1) !important;
    background: #fff !important;
}

.row-opts {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 1rem;
    margin-bottom: 1.5rem;
}
.remember-label {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 13px;
    color: #666;
    cursor: pointer;
}
.remember-label input[type=checkbox] {
    accent-color: #2d6a4f;
    width: 14px; height: 14px;
    border-radius: 4px;
}
.forgot-link {
    font-size: 12px !important;
    color: #2d6a4f !important;
    text-decoration: none !important;
    letter-spacing: 0.3px;
}
.forgot-link:hover { text-decoration: underline !important; }

.btn-pcm-login {
    width: 100% !important;
    padding: 12px !important;
    background: #1a3a2a !important;
    color: #f0ead6 !important;
    border: none !important;
    border-radius: 8px !important;
    font-family: 'Lato', sans-serif !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    cursor: pointer;
    display: flex !important;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: background 0.2s;
    box-shadow: none !important;
}
.btn-pcm-login:hover { background: #2d6a4f !important; }

.bottom-note {
    margin-top: 1.5rem;
    text-align: center;
    font-size: 11px;
    color: #aaa;
    letter-spacing: 0.5px;
}
.bottom-note span { color: #2d6a4f; font-weight: 700; }

@media (max-width: 600px) {
    .login-left { display: none; }
    .login-card { max-width: 100%; }
    .login-right { padding: 2rem 1.5rem; }
}
</style>

<div class="login-card">

    {{-- LEFT PANEL --}}
    <div class="login-left">
        <div class="geo-pattern"></div>

        <div class="left-brand">
            <div class="mosque-icon">
                <svg viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="36" cy="14" rx="6" ry="8" stroke="#d4af37" stroke-width="1.2" fill="none"/>
                    <line x1="36" y1="6" x2="36" y2="2" stroke="#d4af37" stroke-width="1.2"/>
                    <circle cx="36" cy="2" r="1.5" fill="#d4af37"/>
                    <path d="M10 42 Q36 24 62 42" stroke="#d4af37" stroke-width="1.2" fill="none"/>
                    <rect x="8" y="42" width="56" height="22" rx="2" stroke="#d4af37" stroke-width="1.2" fill="none"/>
                    <rect x="29" y="48" width="14" height="16" rx="7" stroke="#d4af37" stroke-width="1" fill="none"/>
                    <rect x="14" y="48" width="10" height="10" rx="2" stroke="rgba(212,175,55,0.5)" stroke-width="0.8" fill="none"/>
                    <rect x="48" y="48" width="10" height="10" rx="2" stroke="rgba(212,175,55,0.5)" stroke-width="0.8" fill="none"/>
                    <line x1="8" y1="64" x2="64" y2="64" stroke="#d4af37" stroke-width="1.2"/>
                </svg>
            </div>
            <div class="org-name">PCM Muhammadiyah</div>
            <h1>Duren Sawit 01</h1>
            <div class="subtitle">Portal Manajemen Masjid</div>
        </div>

        <div class="left-quote">
            <div class="divider-line"></div>
            <p>"إِنَّمَا يَعْمُرُ مَسَاجِدَ اللَّهِ مَنْ آمَنَ بِاللَّهِ"</p>
            <div class="quran-ref">QS. At-Taubah: 18</div>
        </div>
    </div>

    {{-- RIGHT PANEL --}}
    <div class="login-right">
        <h2>Selamat Datang <span class="gold-accent">✦</span></h2>
        <p class="login-tagline">Masuk untuk mengelola kegiatan masjid</p>

        <div class="ornament">
            <div class="ornament-line"></div>
            <div class="ornament-star">✦</div>
            <div class="ornament-line"></div>
        </div>

        {{-- Session Status --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="form-group-pcm">
                <x-input-label for="email" :value="__('Email')" />
                <div class="input-wrap-pcm">
                    <i class="ti ti-mail" aria-hidden="true"></i>
                    <x-text-input id="email" type="email" name="email"
                        :value="old('email')"
                        placeholder="nama@email.com"
                        required autofocus autocomplete="username" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Password --}}
            <div class="form-group-pcm">
                <x-input-label for="password" :value="__('Kata Sandi')" />
                <div class="input-wrap-pcm">
                    <i class="ti ti-lock" aria-hidden="true"></i>
                    <x-text-input id="password" type="password" name="password"
                        placeholder="••••••••"
                        required autocomplete="current-password" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Remember Me & Forgot Password --}}
            <div class="row-opts">
                <label class="remember-label" for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>{{ __('Ingat saya') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        {{ __('Lupa kata sandi?') }}
                    </a>
                @endif
            </div>

            {{-- Submit --}}
            <x-primary-button class="btn-pcm-login">
                <i class="ti ti-login" aria-hidden="true"></i>
                {{ __('Masuk') }}
            </x-primary-button>

        </form>

        <p class="bottom-note">
            Sistem Portal <span>PCM Muhammadiyah Duren Sawit 01</span>
        </p>
    </div>

</div>

</x-guest-layout>
