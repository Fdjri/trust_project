<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Saat membuka website, langsung diarahkan ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Redirect setelah login sesuai dengan role
Route::middleware(['auth'])->get('/dashboard', [AuthenticatedSessionController::class, 'redirectToDashboard'])->name('dashboard');

// Dashboard masing-masing peran
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
    return view('layouts.admin.dashboard');
})->name('admin.dashboard');

Route::middleware(['auth', 'role:kepala_cabang'])->get('/kc/dashboard', function () {
    return view('layouts.kc.dashboard');
})->name('kc.dashboard');

Route::middleware(['auth', 'role:supervisor'])->get('/supervisor/dashboard', function () {
    return view('layouts.kc.dashboard'); // Sesuaikan jika supervisor punya halaman berbeda
})->name('supervisor.dashboard');

Route::middleware(['auth', 'role:salesman'])->get('/sales/dashboard', function () {
    return view('layouts.sales.dashboard');
})->name('sales.dashboard');

// Middleware untuk fitur yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manajemen Pengguna (Hanya Admin)
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });
});

// Route khusus Admin
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/customers', [AdminController::class, 'index']);
    Route::post('/customers', [AdminController::class, 'store']);
    Route::put('/customers/{id}', [AdminController::class, 'update']);
    Route::delete('/customers/{id}', [AdminController::class, 'destroy']);
    Route::post('/customers/import', [AdminController::class, 'import']);
    Route::get('/customers/export', [AdminController::class, 'export']);
});

// Route untuk customer (bisa diakses oleh semua role yang memiliki akses)
Route::middleware('auth')->group(function () {
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::put('/customers/{id_customer}', [CustomerController::class, 'update']);
    Route::delete('/customers/{id_customer}', [CustomerController::class, 'destroy']);
    Route::post('/import-customers', [CustomerController::class, 'import'])->name('customers.import');
    Route::get('/export-customers', [CustomerController::class, 'export'])->name('customers.export');
});

require __DIR__.'/auth.php';
