<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureBendahara2FA
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!$user->google2fa_enabled) {
            return redirect()->route('bendahara.2fa.setup');
        }

        if (!session('2fa_passed')) {
            return redirect()->route('bendahara.2fa.verify');
        }

        return $next($request);
    }
}
