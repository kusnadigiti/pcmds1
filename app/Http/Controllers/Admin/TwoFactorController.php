<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TwoFactorController extends Controller
{
    public function setup()
    {
        $user = Auth::user();

        if ($user->google2fa_enabled) {
            return redirect()->route('bendahara.dashboard');
        }

        if (!$user->google2fa_secret) {
            $google2fa = new Google2FA();
            $user->google2fa_secret = $google2fa->generateSecretKey();
            $user->save();
        }

        $google2fa = new Google2FA();

        $qrCodeUrl = $google2fa->getQRCodeUrl(
            'PCMDurenSawit01',
            $user->email,
            $user->google2fa_secret
        );

        $qrCode = QrCode::size(200)->generate($qrCodeUrl);
        $secretKey = $user->google2fa_secret;

        return view('auth.2fa-setup', compact('qrCode', 'secretKey'));
    }

    public function activate(Request $request)
    {
        $request->validate(['otp' => 'required']);

        $user = Auth::user();
        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey(
            $user->google2fa_secret,
            $request->otp
        );

        if (!$valid) {
            return back()->withErrors(['otp' => 'Kode salah']);
        }

        $user->google2fa_enabled = true;
        $user->save();

        session(['2fa_passed' => true]);

        return redirect()->route('bendahara.dashboard');
    }

    public function index()
    {
        $user = Auth::user();

        if (!$user->google2fa_enabled) {
            return redirect()->route('bendahara.2fa.setup');
        }

        if (session('2fa_passed')) {
            return redirect()->route('bendahara.dashboard');
        }

        return view('auth.2fa');
    }

    public function verify(Request $request)
    {
        $request->validate(['otp' => 'required']);

        $user = Auth::user();

        if (!$user->google2fa_secret) {
            return redirect()
                ->route('bendahara.2fa.setup')
                ->with('error', 'Silakan aktifkan Google Authenticator terlebih dahulu.');
        }

        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey(
            $user->google2fa_secret,
            $request->otp
        );

        if (!$valid) {
            return back()->withErrors(['otp' => 'Kode salah']);
        }

        session(['2fa_passed' => true]);

        return redirect()->route('bendahara.dashboard');
    }
}
