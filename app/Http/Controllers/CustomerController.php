<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Imports\CustomerImport;
use App\Exports\CustomerExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'alamat' => 'nullable|string',
                'nomor_hp_1' => 'required|string|max:15',
                'nomor_hp_2' => 'nullable|string|max:15',
                'kelurahan' => 'nullable|string|max:255',
                'kecamatan' => 'nullable|string|max:255',
                'kota' => 'nullable|string|max:255',
                'tanggal_lahir' => 'nullable|date',
                'jenis_kelamin' => 'nullable|in:L,P',
                'tipe_pelanggan' => 'nullable|in:first buyer,replacement,additional',
                'jenis_pelanggan' => 'nullable|in:retail,fleet',
                'model_mobil' => 'nullable|string|max:255',
                'nomor_rangka' => 'nullable|string|max:255',
                'pekerjaan' => 'nullable|string|max:255',
                'tenor' => 'nullable|integer|min:1',
                'tanggal_gatepass' => 'nullable|date',
                'id_cabang' => 'required|string|exists:branches,id',
                'salesman' => 'nullable|string|max:255',
                'sumber_data' => 'nullable|string|max:255',
                'progress' => 'nullable|in:pending,tidak ada,SPK',
                'alasan' => 'nullable|string',
            ]);

            $customer = Customer::create($validatedData);

            return response()->json(['message' => 'Customer berhasil ditambahkan', 'data' => $customer], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function update(Request $request, $id_customer)
    {
        $customer = Customer::findOrFail($id_customer);

        try {
            $validatedData = $request->validate([
                'nama' => 'sometimes|required|string|max:255',
                'alamat' => 'nullable|string',
                'nomor_hp_1' => 'sometimes|required|string|max:15',
                'nomor_hp_2' => 'nullable|string|max:15',
                'kelurahan' => 'nullable|string|max:255',
                'kecamatan' => 'nullable|string|max:255',
                'kota' => 'nullable|string|max:255',
                'tanggal_lahir' => 'nullable|date',
                'jenis_kelamin' => 'nullable|in:L,P',
                'tipe_pelanggan' => 'nullable|in:first buyer,replacement,additional',
                'jenis_pelanggan' => 'nullable|in:retail,fleet',
                'model_mobil' => 'nullable|string|max:255',
                'nomor_rangka' => 'nullable|string|max:255',
                'pekerjaan' => 'nullable|string|max:255',
                'tenor' => 'nullable|integer|min:1',
                'tanggal_gatepass' => 'nullable|date',
                'id_cabang' => 'sometimes|required|string|exists:branches,id',
                'salesman' => 'nullable|string|max:255',
                'sumber_data' => 'nullable|string|max:255',
                'progress' => 'nullable|in:pending,tidak ada,SPK',
                'alasan' => 'nullable|string',
            ]);

            $customer->update($validatedData);

            return response()->json(['message' => 'Customer berhasil diperbarui', 'data' => $customer]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function destroy($id_customer)
    {
        $customer = Customer::findOrFail($id_customer);
        $customer->delete();

        return response()->json(['message' => 'Customer berhasil dihapus']);
    }

    // ✅ Fungsi Import
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new CustomerImport, $request->file('file'));

        return response()->json(['message' => 'Data Customer berhasil diimpor!'], 200);
    }

    // ✅ Fungsi Export
    public function export()
    {
        return Excel::download(new CustomerExport, 'customers.xlsx');
    }
}
