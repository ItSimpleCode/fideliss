<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Transaction extends Authenticatable
{
    public function clientCards()
    {
        return $this->belongsTo(ClientCards::class, 'id_client_card');
    }
}
