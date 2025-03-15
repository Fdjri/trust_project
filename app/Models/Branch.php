<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];
    public $incrementing = false;
    protected $keyType = 'string';

    public function customers()
    {
        return $this->hasMany(Customer::class, 'branch_id', 'id');
    }
}
