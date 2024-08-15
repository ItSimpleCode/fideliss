<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientCards extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
    public function cards()
    {
        return $this->belongsTo(Card::class, 'id_card');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id_client_card');
    }
}
