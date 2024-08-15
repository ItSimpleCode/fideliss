<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Branch extends Authenticatable
{
    protected $table = 'branchs';
    public function staffs()
    {
        return $this->hasMany(Staff::class, 'id_branch');
    }
    public function clients()
    {
        return $this->hasMany(Client::class, 'id_branch');
    }
}
