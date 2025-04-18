<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class KcController extends Controller
{
    /**
     * Konstruktor middleware hanya untuk kepala cabang
     */
    public function __construct()
    {
        $this->middleware('role:kepala_cabang'); // hanya kepala cabang yang bisa mengakses controller ini
    }

    /**
     * Menampilkan daftar customer yang ada di cabang tertentu
     */
    public function indexCustomer()
    {
        $user = Auth::user(); // Ambil user yang sedang login
        $customers = Customer::where('id_cabang', $user->id_cabang)->get(); // Ambil semua customer berdasarkan cabang

        return view('kc.cust.index', compact('customers'));
    }

    /**
     * Menampilkan form untuk menambah customer
     */
    public function createCustomer()
    {
        $branches = Branch::all(); // Ambil semua cabang
        return view('kc.cust.create', compact('branches'));
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

        Customer::create($validatedData);

        return redirect()->route('kc.customers.index')->with('success', 'Customer berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit customer
     */
    public function editCustomer($id_customer)
    {
        $customer = Customer::findOrFail($id_customer); // Cari customer berdasarkan ID
        $branches = Branch::all(); // Ambil semua cabang
        return view('kc.cust.edit', compact('customer', 'branches'));
    }

    /**
     * Mengupdate data customer
     */
    public function updateCustomer(Request $request, $id_customer)
    {
        $customer = Customer::findOrFail($id_customer);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_hp_1' => 'required|string|max:15',
            'id_cabang' => 'required|string|exists:branches,id',
        ]);

        $customer->update($validatedData);

        return redirect()->route('kc.customers.index')->with('success', 'Customer berhasil diperbarui');
    }

    /**
     * Menghapus customer
     */
    public function destroyCustomer($id_customer)
    {
        $customer = Customer::findOrFail($id_customer);
        $customer->delete();

        return redirect()->route('kc.customers.index')->with('success', 'Customer berhasil dihapus');
    }

    /**
     * Menampilkan dashboard kepala cabang
     */
    public function dashboard()
    {
        return view('kc.sales.dashboard'); // Menampilkan dashboard sales untuk kepala cabang
    }

    /**
     * Menampilkan laporan berdasarkan customer dan salesman
     */
    public function showReport()
    {
        // Anda bisa menyesuaikan dengan laporan yang diinginkan
        $sales = User::role('salesman')->where('id_cabang', Auth::user()->id_cabang)->get();
        return view('kc.laporan.index', compact('sales'));
    }

}
