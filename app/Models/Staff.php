<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    protected $table = 'staffs';

    public function admins()
    {
        return $this->belongsTo(Admin::class, 'id_creator');
    }
    public function branches()
    {
        return $this->belongsTo(Branch::class, 'id_branch');
    }
}
