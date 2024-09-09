<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Transaction extends Authenticatable
{

    protected $fillable = [
        'actor',
        'admin_id',
        'client_id',
        'staff_id',
        'points',
        'description'
    ];

}
