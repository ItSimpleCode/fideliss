<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Card extends Authenticatable
{
    use HasFactory;

    public function cards()
    {
        return $this->hasMany(Client::class, 'card_id');
    }
}
