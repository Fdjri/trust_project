<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Middleware hanya untuk admin
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * Menampilkan daftar user
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan form tambah user
     */
    public function create()
    {
        $roles = Role::all(); // Ambil semua role dari Spatie
        $branches = Branch::all(); // Ambil semua cabang
        return view('admin.users.create', compact('roles', 'branches'));
    }

    /**
     * Menyimpan user baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|string|min:6',
            'id_cabang' => 'nullable|string|exists:branches,id',
            'role' => 'required|string|exists:roles,name', // Role harus valid di database
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_cabang' => $request->id_cabang, // Admin bisa tidak memiliki cabang
        ]);

        $user->assignRole($request->role); // Tetapkan role ke user

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit user
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $branches = Branch::all();
        return view('admin.users.edit', compact('user', 'roles', 'branches'));
    }

    /**
     * Memperbarui data user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $user->id,
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'id_cabang' => 'nullable|string|exists:branches,id',
            'role' => 'required|string|exists:roles,name',
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'id_cabang' => $request->id_cabang,
        ]);

        // Update role user
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Menghapus user, kecuali admin sendiri
     */
    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak bisa menghapus akun Anda sendiri!');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }
}
