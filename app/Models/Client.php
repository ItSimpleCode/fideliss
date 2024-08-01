<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Client extends Authenticatable
{
    use HasFactory;
    public function clientCards()
    {
        return $this->hasMany(ClientCards::class, 'id_client');
    }
}
