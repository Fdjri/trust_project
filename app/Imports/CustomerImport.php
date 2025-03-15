<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;

class CustomerImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Customer([
            'nama'            => $row['nama'],
            'alamat'          => $row['alamat'] ?? null,
            'nomor_hp_1'      => $row['nomor_hp_1'],
            'nomor_hp_2'      => $row['nomor_hp_2'] ?? null,
            'kelurahan'       => $row['kelurahan'] ?? null,
            'kecamatan'       => $row['kecamatan'] ?? null,
            'kota'            => $row['kota'] ?? null,
            'tanggal_lahir'   => $row['tanggal_lahir'] ?? null,
            'jenis_kelamin'   => $row['jenis_kelamin'] ?? null,
            'tipe_pelanggan'  => $row['tipe_pelanggan'] ?? null,
            'jenis_pelanggan' => $row['jenis_pelanggan'] ?? null,
            'model_mobil'     => $row['model_mobil'] ?? null,
            'nomor_rangka'    => $row['nomor_rangka'] ?? null,
            'pekerjaan'       => $row['pekerjaan'] ?? null,
            'tenor'           => $row['tenor'] ?? null,
            'tanggal_gatepass'=> $row['tanggal_gatepass'] ?? null,
            'id_cabang'       => $row['id_cabang'],
            'salesman'        => $row['salesman'] ?? null,
            'sumber_data'     => $row['sumber_data'] ?? null,
            'progress'        => $row['progress'] ?? 'pending',
            'alasan'          => $row['alasan'] ?? null,
        ]);
    }
}
