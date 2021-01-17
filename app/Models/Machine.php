<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this -> hasMany('App\Models\Order','machine_id', 'id');
    }

    
}
