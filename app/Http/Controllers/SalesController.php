<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FollowUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    /**
     * Middleware hanya untuk salesman
     */
    public function __construct()
    {
        $this->middleware('role:salesman');
    }

    /**
     * Menampilkan dashboard salesman
     */
    public function dashboard()
    {
        // Menampilkan data atau statistik untuk dashboard salesman
        // Misalnya jumlah customer yang di follow-up oleh salesman
        $followups = FollowUp::where('salesman_id', Auth::id())->get();
        return view('sales.laporan.dashboard', compact('followups'));
    }

    /**
     * Menampilkan daftar customer yang bisa di follow-up
     */
    public function showCustomers()
    {
        // Menampilkan daftar customer yang dapat di follow-up
        $customers = Customer::where('salesman_id', Auth::id())->get();
        return view('sales.cust.index', compact('customers'));
    }

    /**
     * Menampilkan form untuk menambah customer baru
     */
    public function createCustomer()
    {
        return view('sales.cust.create');
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

        return redirect()->route('sales.cust.index')->with('success', 'Customer berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit data customer
     */
    public function editCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        return view('sales.cust.edit', compact('customer'));
    }

    /**
     * Mengupdate data customer
     */
    public function updateCustomer(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_hp_1' => 'required|string|max:15',
            'id_cabang' => 'required|string|exists:branches,id',
        ]);

        $customer->update($validatedData);

        return redirect()->route('sales.cust.index')->with('success', 'Customer berhasil diperbarui');
    }

    /**
     * Menampilkan detail customer
     */
    public function showCustomerDetail($id)
    {
        $customer = Customer::findOrFail($id);
        return view('sales.cust.show', compact('customer'));
    }

    /**
     * Menampilkan laporan follow-up untuk salesman
     */
    public function showFollowUp()
    {
        // Menampilkan laporan follow-up berdasarkan salesman
        $followups = FollowUp::where('salesman_id', Auth::id())->get();
        return view('sales.laporan.index', compact('followups'));
    }

    /**
     * Menambahkan follow-up untuk customer
     */
    public function createFollowUp($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        return view('sales.laporan.create', compact('customer'));
    }

    /**
     * Menyimpan follow-up untuk customer
     */
    public function storeFollowUp(Request $request, $customerId)
    {
        $validatedData = $request->validate([
            'followup_date' => 'required|date',
            'status' => 'required|in:pending,spk,rejected',
            'channel' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $validatedData['customer_id'] = $customerId;
        $validatedData['salesman_id'] = Auth::id();

        FollowUp::create($validatedData);

        return redirect()->route('sales.laporan.index')->with('success', 'Follow-up berhasil ditambahkan');
    }
}
