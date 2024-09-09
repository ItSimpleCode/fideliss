<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Agency extends Authenticatable
{
    protected $table = 'agencies';
    protected $fillable = ['name', 'address'];

    public function staffs()
    {
        return $this->hasMany(Staff::class, 'agency_id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'agency_id');
    }
}
