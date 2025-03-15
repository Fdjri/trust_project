<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Customer::select([
            'nama', 'alamat', 'nomor_hp_1', 'nomor_hp_2', 'kelurahan', 'kecamatan',
            'kota', 'tanggal_lahir', 'jenis_kelamin', 'tipe_pelanggan', 'jenis_pelanggan',
            'model_mobil', 'nomor_rangka',
            'pekerjaan', 'tenor', 'tanggal_gatepass', 'id_cabang', 'salesman',
            'sumber_data', 'progress', 'alasan'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Nama', 'Alamat', 'Nomor HP 1', 'Nomor HP 2', 'Kelurahan', 'Kecamatan',
            'Kota', 'Tanggal Lahir', 'Jenis Kelamin', 'Tipe Pelanggan', 'Jenis Pelanggan',
            'Model Mobil', 'Nomor Rangka',
            'Pekerjaan', 'Tenor', 'Tanggal Gatepass', 'ID Cabang', 'Salesman',
            'Sumber Data', 'Progress', 'Alasan'
        ];
    }
}
