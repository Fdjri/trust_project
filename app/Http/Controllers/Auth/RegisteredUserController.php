<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration form (only accessible by admin).
     */
    public function create(): View
    {
        // Pastikan hanya admin yang bisa melihat form registrasi
        if (!Auth::user() || !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        // Kirim daftar role ke form jika perlu
        $roles = Role::pluck('name', 'name');

        return view('auth.register', compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Pastikan hanya admin yang bisa mendaftarkan user baru
        if (!Auth::user() || !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'exists:roles,name'], // Role harus ada di tabel roles
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role ke user
        $user->assignRole($request->role);

        event(new Registered($user));

        return redirect()->route('admin.dashboard')->with('success', 'User berhasil didaftarkan.');
    }
}
