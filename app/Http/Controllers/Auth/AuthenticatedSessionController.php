<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'username' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        return $this->redirectToDashboard();
    }

    private function redirectToDashboard()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('kepala_cabang')) {
            return redirect()->route('kc.dashboard');
        } elseif ($user->hasRole('supervisor')) {
            return redirect()->route('spv.dashboard');
        } elseif ($user->hasRole('salesman')) {
            return redirect()->route('sales.dashboard');
        }

        return redirect()->route('dashboard');
    }
}
