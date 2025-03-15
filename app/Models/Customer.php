<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'id_customer';
    public $incrementing = true;
    protected $fillable = [
        'nama', 'alamat', 'nomor_hp_1', 'nomor_hp_2', 'kelurahan', 'kecamatan',
        'kota', 'tanggal_lahir', 'jenis_kelamin', 'tipe_pelanggan', 'jenis_pelanggan', 'model_mobil',
        'nomor_rangka', 'pekerjaan', 'tenor', 'tanggal_gatepass', 'id_cabang', 'salesman',
        'sumber_data', 'progress', 'alasan'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'id_cabang', 'id');
    }
}

