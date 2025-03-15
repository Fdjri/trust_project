<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionExpireOnClose
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('session_start')) {
            Session::put('session_start', now());
        }

        // Cek apakah session sudah habis karena browser ditutup
        if (!Session::has('session_start')) {
            Auth::logout();
            Session::invalidate();
            return redirect('/login')->with('message', 'Sesi Anda telah berakhir.');
        }

        return $next($request);
    }
}
