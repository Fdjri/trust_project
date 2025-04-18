<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController; // Pastikan ini ditambahkan
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\KcController;
use App\Http\Controllers\SpvController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FollowUpController;

// 🏠 **Route Utama: Jika belum login, arahkan ke login. Jika sudah login, arahkan ke dashboard.**
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// ✅ **Halaman Login**
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

// ✅ **Proses Login**
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// ✅ **Proses Logout**
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// 🎯 **Redirect Dashboard Sesuai Role**
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthenticatedSessionController::class, 'redirectToDashboard'])->name('dashboard');
    
    // Admin Routes
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::resource('customers', AdminController::class);
        Route::get('/customers/export', [AdminController::class, 'export'])->name('admin.customers.export');
        Route::post('/customers/import', [AdminController::class, 'import'])->name('admin.customers.import');
    });

    // KC (Kepala Cabang) Routes
    Route::middleware('role:kepala_cabang')->prefix('kc')->group(function () {
        Route::resource('customers', KcController::class);
        Route::get('/laporan', [KcController::class, 'showLaporan'])->name('kc.laporan.index');
        Route::get('/laporan/create/{customerId}', [KcController::class, 'createFollowUp'])->name('kc.laporan.create');
        Route::post('/laporan/{customerId}', [KcController::class, 'storeFollowUp'])->name('kc.laporan.store');
    });

    // SPV (Supervisor) Routes
    Route::middleware('role:supervisor')->prefix('spv')->group(function () {
        Route::get('/laporan', [SpvController::class, 'showLaporan'])->name('spv.laporan.index');
    });

    // Sales Routes
    Route::middleware('role:salesman')->prefix('sales')->group(function () {
        Route::get('/dashboard', [SalesController::class, 'dashboard'])->name('sales.dashboard');
        Route::get('/cust', [SalesController::class, 'showCustomers'])->name('sales.cust.index');
        Route::get('/cust/create', [SalesController::class, 'createCustomer'])->name('sales.cust.create');
        Route::post('/cust', [SalesController::class, 'storeCustomer'])->name('sales.cust.store');
        Route::get('/cust/edit/{id}', [SalesController::class, 'editCustomer'])->name('sales.cust.edit');
        Route::put('/cust/{id}', [SalesController::class, 'updateCustomer'])->name('sales.cust.update');
        Route::get('/cust/{id}', [SalesController::class, 'showCustomerDetail'])->name('sales.cust.show');
        
        // Laporan Follow-up
        Route::get('/laporan', [SalesController::class, 'showFollowUp'])->name('sales.laporan.index');
        Route::get('/laporan/create/{customerId}', [SalesController::class, 'createFollowUp'])->name('sales.laporan.create');
        Route::post('/laporan/{customerId}', [SalesController::class, 'storeFollowUp'])->name('sales.laporan.store');
    });
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
