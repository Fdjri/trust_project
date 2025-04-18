<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Branch;
use App\Imports\CustomerImport;
use App\Exports\CustomerExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Middleware hanya untuk admin
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Menampilkan form tambah customer
     */
    public function create()
    {
        $branches = Branch::all(); // Ambil semua cabang
        return view('admin.customers.create', compact('branches'));
    }

    /**
     * Menyimpan customer baru
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_hp_1' => 'required|string|max:15',
            'id_cabang' => 'required|string|exists:branches,id',
        ]);

        $customer = Customer::create($validatedData);

        return redirect()->route('admin.customers.index')->with('success', 'Customer berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit customer
     */
    public function edit($id_customer)
    {
        $customer = Customer::findOrFail($id_customer);
        $branches = Branch::all();
        return view('admin.customers.edit', compact('customer', 'branches'));
    }

    /**
     * Mengupdate data customer
     */
    public function update(Request $request, $id_customer)
    {
        $customer = Customer::findOrFail($id_customer);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_hp_1' => 'required|string|max:15',
            'id_cabang' => 'required|string|exists:branches,id',
        ]);

        $customer->update($validatedData);

        return redirect()->route('admin.customers.index')->with('success', 'Customer berhasil diperbarui');
    }

    /**
     * Menghapus customer
     */
    public function destroy($id_customer)
    {
        $customer = Customer::findOrFail($id_customer);
        $customer->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Customer berhasil dihapus');
    }

    /**
     * Import data customer dari Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new CustomerImport, $request->file('file'));

        return redirect()->route('admin.customers.index')->with('success', 'Import data berhasil');
    }

    /**
     * Export data customer ke Excel
     */
    public function export()
    {
        return Excel::download(new CustomerExport, 'customers.xlsx');
    }
}
