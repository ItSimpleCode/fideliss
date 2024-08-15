<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    public function clientcards()
    {
        return $this->hasMany(ClientCards::class, 'id_card');
    }
}
