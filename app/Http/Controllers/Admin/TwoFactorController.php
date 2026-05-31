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

        $google2fa = new Google2FA();
        $secret = $google2fa->generateSecretKey();

        $user->google2fa_secret = $secret;
        $user->save();

        $qrCodeUrl = $google2fa->getQRCodeUrl(
            'PCMDurenSawit01',
            $user->email,
            $secret
        );

        $qrCode = QrCode::size(200)->generate($qrCodeUrl);

        return view('auth.2fa-setup', compact('qrCode'));
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
        return view('auth.2fa');
    }

    public function verify(Request $request)
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

        session(['2fa_passed' => true]);

        return redirect()->route('bendahara.dashboard');
    }
}
