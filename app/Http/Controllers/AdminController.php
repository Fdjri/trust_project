<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Imports\CustomerImport;
use App\Exports\CustomerExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    // Menampilkan semua customer dari semua cabang
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    // Menyimpan customer baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_hp_1' => 'required|string|max:15',
            'id_cabang' => 'required|string|exists:branches,id',
        ]);

        $customer = Customer::create($request->all());

        return response()->json(['message' => 'Customer berhasil ditambahkan', 'data' => $customer], 201);
    }

    // Mengupdate data customer
    public function update(Request $request, $id_customer)
    {
        $customer = Customer::findOrFail($id_customer);
        $customer->update($request->all());

        return response()->json(['message' => 'Customer berhasil diperbarui', 'data' => $customer]);
    }

    // Menghapus customer
    public function destroy($id_customer)
    {
        $customer = Customer::findOrFail($id_customer);
        $customer->delete();

        return response()->json(['message' => 'Customer berhasil dihapus']);
    }

    // Import data customer dari Excel
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new CustomerImport, $request->file('file'));

        return response()->json(['message' => 'Import data berhasil']);
    }

    // Export data customer ke Excel
    public function export()
    {
        return Excel::download(new CustomerExport, 'customers.xlsx');
    }
}
