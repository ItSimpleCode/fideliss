<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class TransactionDemande extends Authenticatable
{
    public function clientCards()
    {
        return $this->belongsTo(ClientCards::class, 'id_client_card');
    }
    public function staffs()
    {
        return $this->belongsTo(Staff::class, 'id_money_converter');
    }
}
