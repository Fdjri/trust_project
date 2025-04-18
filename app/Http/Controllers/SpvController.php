<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FollowUp;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpvController extends Controller
{
    /**
     * Middleware hanya untuk supervisor
     */
    public function __construct()
    {
        $this->middleware('role:supervisor');
    }

    /**
     * Menampilkan dashboard supervisor
     */
    public function dashboard()
    {
        // Menampilkan data atau statistik untuk dashboard supervisor
        // Misalnya jumlah customer yang di follow-up oleh salesman
        $salesman = Sales::where('supervisor_id', Auth::id())->get();
        return view('spv.sales.dashboard', compact('salesman'));
    }

    /**
     * Menampilkan daftar akun supervisor (bisa untuk melihat atau mengedit data akun supervisor)
     */
    public function index()
    {
        $supervisors = User::role('supervisor')->get();
        return view('spv.akun.index', compact('supervisors'));
    }

    /**
     * Menampilkan form untuk mengedit akun supervisor
     */
    public function edit($id)
    {
        $supervisor = User::findOrFail($id);
        return view('spv.akun.edit', compact('supervisor'));
    }

    /**
     * Menyimpan perubahan pada akun supervisor
     */
    public function update(Request $request, $id)
    {
        $supervisor = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $supervisor->id,
            'password' => 'nullable|min:6',
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        }

        $supervisor->update($validatedData);

        return redirect()->route('spv.akun.index')->with('success', 'Akun supervisor berhasil diperbarui');
    }

    /**
     * Menampilkan daftar customer yang dikelola oleh supervisor
     */
    public function showCustomers()
    {
        // Menampilkan daftar customer yang diikuti oleh supervisor
        $customers = Customer::where('supervisor_id', Auth::id())->get();
        return view('spv.cust.index', compact('customers'));
    }

    /**
     * Menampilkan form untuk menambahkan customer baru
     */
    public function createCustomer()
    {
        return view('spv.cust.create');
    }

    /**
     * Menyimpan customer baru
     */
    public function storeCustomer(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_hp_1' => 'required|string|max:15',
            'id_cabang' => 'required|string|exists:branches,id',
        ]);

        $customer = Customer::create($validatedData);
        return redirect()->route('spv.cust.index')->with('success', 'Customer berhasil ditambahkan');
    }

    /**
     * Menampilkan laporan follow-up
     */
    public function showFollowUp()
    {
        // Menampilkan laporan follow-up berdasarkan supervisor
        $followups = FollowUp::where('supervisor_id', Auth::id())->get();
        return view('spv.laporan.index', compact('followups'));
    }

    /**
     * Menampilkan detail customer
     */
    public function showCustomerDetail($id)
    {
        $customer = Customer::findOrFail($id);
        return view('spv.cust.show', compact('customer'));
    }
}
