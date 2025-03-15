<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// 🏠 **Route Utama: Jika belum login, tampilkan login. Jika sudah login, ke dashboard sesuai role.**
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : view('auth.login'); 
})->middleware('guest')->name('home');

// ✅ **Halaman Login**
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

// ✅ **Proses Login**
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// ✅ **Proses Logout**
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// 🎯 **Redirect Dashboard Sesuai Role**
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthenticatedSessionController::class, 'redirectToDashboard'])->name('dashboard');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('layouts.admin.dashboard');
        })->name('admin.dashboard');
    });

    Route::middleware(['role:kepala_cabang'])->group(function () {
        Route::get('/kc/dashboard', function () {
            return view('layouts.kc.dashboard');
        })->name('kc.dashboard');
    });

    Route::middleware(['role:supervisor'])->group(function () {
        Route::get('/spv/dashboard', function () {
            return view('layouts.spv.dashboard');
        })->name('spv.dashboard');
    });

    Route::middleware(['role:salesman'])->group(function () {
        Route::get('/sales/dashboard', function () {
            return view('layouts.sales.dashboard');
        })->name('sales.dashboard');
    });
});

// 🔐 **Fitur User yang Sudah Login**
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 👤 **Manajemen Pengguna (Hanya Admin)**
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/customers', [AdminController::class, 'index']);
    Route::post('/customers', [AdminController::class, 'store']);
    Route::put('/customers/{id}', [AdminController::class, 'update']);
    Route::delete('/customers/{id}', [AdminController::class, 'destroy']);
    Route::post('/customers/import', [AdminController::class, 'import']);
    Route::get('/customers/export', [AdminController::class, 'export']);
});

// 📦 **Route untuk Customer (Bisa diakses oleh semua user yang sudah login)**
Route::middleware('auth')->group(function () {
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::put('/customers/{id_customer}', [CustomerController::class, 'update']);
    Route::delete('/customers/{id_customer}', [CustomerController::class, 'destroy']);
    Route::post('/import-customers', [CustomerController::class, 'import'])->name('customers.import');
    Route::get('/export-customers', [CustomerController::class, 'export'])->name('customers.export');
});

// 🔑 **Autentikasi Routes (Login, Register, Logout, dll.)**
require __DIR__.'/auth.php';
