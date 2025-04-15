<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'histories';

    protected $fillable = [
        'salesman_id',
        'branch_id',
        'periode',
        'total_followups',
        'total_spk',
        'total_pending',
        'total_rejected',
    ];

    public function salesman()
    {
        return $this->belongsTo(User::class, 'salesman_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
