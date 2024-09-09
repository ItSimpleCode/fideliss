<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PendingTransaction extends Authenticatable
{

    protected $fillable = [
        'accepted',
        'rejected',
    ];

    public function staffs()
    {
        return $this->belongsTo(Staff::class, 'id_money_converter');
    }
}
