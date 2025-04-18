<?php

namespace App\Http\Controllers;

use App\Models\FollowUp;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class FollowUpController extends Controller
{
    /**
     * Menampilkan daftar follow-up untuk customer tertentu.
     */
    public function index($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $followUps = $customer->followUps()->with('salesman')->get(); // Ambil data follow-up yang terkait dengan customer

        return view('sales.laporan.index', compact('followUps', 'customer'));
    }

    /**
     * Menampilkan form untuk membuat follow-up baru.
     */
    public function create($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $salesmen = User::role('salesman')->get(); // Ambil data salesman

        return view('sales.laporan.create', compact('customer', 'salesmen'));
    }

    /**
     * Menyimpan follow-up yang baru dibuat.
     */
    public function store(Request $request, $customerId)
    {
        $request->validate([
            'salesman_id' => 'required|exists:users,id',
            'followup_date' => 'required|date',
            'status' => 'required|in:pending,spk,rejected',
            'channel' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $followUp = new FollowUp([
            'customer_id' => $customerId,
            'salesman_id' => $request->salesman_id,
            'followup_date' => $request->followup_date,
            'status' => $request->status,
            'channel' => $request->channel,
            'notes' => $request->notes,
        ]);

        $followUp->save();

        return redirect()->route('sales.laporan.index', ['customerId' => $customerId])->with('success', 'Follow-up berhasil disimpan');
    }

    /**
     * Menampilkan detail dari follow-up tertentu.
     */
    public function show($followUpId)
    {
        $followUp = FollowUp::with('customer', 'salesman')->findOrFail($followUpId);

        return view('sales.laporan.show', compact('followUp'));
    }

    /**
     * Menampilkan form untuk mengedit follow-up yang sudah ada.
     */
    public function edit($followUpId)
    {
        $followUp = FollowUp::findOrFail($followUpId);
        $salesmen = User::role('salesman')->get(); // Ambil data salesman
        $customer = $followUp->customer;

        return view('sales.laporan.edit', compact('followUp', 'salesmen', 'customer'));
    }

    /**
     * Mengupdate data follow-up.
     */
    public function update(Request $request, $followUpId)
    {
        $request->validate([
            'salesman_id' => 'required|exists:users,id',
            'followup_date' => 'required|date',
            'status' => 'required|in:pending,spk,rejected',
            'channel' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $followUp = FollowUp::findOrFail($followUpId);
        $followUp->update([
            'salesman_id' => $request->salesman_id,
            'followup_date' => $request->followup_date,
            'status' => $request->status,
            'channel' => $request->channel,
            'notes' => $request->notes,
        ]);

        return redirect()->route('sales.laporan.index', ['customerId' => $followUp->customer_id])->with('success', 'Follow-up berhasil diperbarui');
    }

    /**
     * Menghapus follow-up.
     */
    public function destroy($followUpId)
    {
        $followUp = FollowUp::findOrFail($followUpId);
        $followUp->delete();

        return redirect()->back()->with('success', 'Follow-up berhasil dihapus');
    }
}
