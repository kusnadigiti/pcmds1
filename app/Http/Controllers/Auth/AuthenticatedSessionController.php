<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        if (auth()->check()) {

            $role = auth()->user()->role;

            if ($role === 'superadmin') {
                return redirect()->route('superadmin.dashboard');
            }

            if ($role === 'penulis') {
                return redirect()->route('penulis.dashboard');
            }

            if ($role === 'bendahara') {
                return redirect()->route('bendahara.dashboard');
            }

            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $role = auth()->user()->role;

        if ($role === 'admin' || $role === 'superadmin') {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        if ($role === 'penulis') {
            return redirect()->intended(route('penulis.dashboard', absolute: false));
        }

        if($role === 'bendahara') {
            session(['2fa_passed' => false]);
            return redirect()->route('bendahara.2fa.verify');
        }

        return redirect('/');
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
