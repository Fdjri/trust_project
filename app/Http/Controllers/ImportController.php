<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportController extends Controller
{
    public function importExcel(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls'
    ]);

    $file = $request->file('file');
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getPathname());
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();

    foreach ($rows as $index => $row) {
        if ($index == 0) continue; // Lewati header

        Customer::create([
            'branch_id' => auth()->user()->branch_id, // Ambil ID cabang sebagai string
            'name' => $row[0],
            'phone' => $row[1],
            'email' => $row[2] ?? null,
            'address' => $row[3] ?? null,
        ]);
    }

    return back()->with('success', 'Data berhasil diimpor!');
}

}
