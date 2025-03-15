<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Memproses login user.
     */
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

    /**
     * Mengarahkan user ke dashboard berdasarkan role.
     */
    public function redirectToDashboard()
    {
        $role = auth()->user()->role;

        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'kepala_cabang' => redirect()->route('kc.dashboard'),
            'supervisor' => redirect()->route('spv.dashboard'),
            'salesman' => redirect()->route('sales.dashboard'),
            default => redirect('/'),
        };
    }

}
