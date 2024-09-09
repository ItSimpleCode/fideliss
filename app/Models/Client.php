<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authentication;
use \Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Authentication
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'cin',
        'birth_date',
        'phone_number',
        'gender',
        'address',
        'email',
        'optional_name',
        'card_serial',
        'wallet',
        'expiry_date',
        'card_id',
        'agency_id',
        'status',
        'validationKey',
        'creator',
        'creator_admin_id',
        'creator_staff_id'
    ];
}
