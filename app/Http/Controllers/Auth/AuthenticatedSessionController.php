<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

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

    public function redirectToDashboard()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'kepala_cabang') {
            return redirect()->route('kc.dashboard');
        } elseif ($user->role === 'supervisor') {
            return redirect()->route('spv.dashboard');
        } elseif ($user->role === 'salesman') {
            return redirect()->route('sales.dashboard');
        }

        return redirect()->route('dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
