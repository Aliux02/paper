<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    use HasFactory;

  
    public function info()
    {
        return $this -> hasMany('App\Models\Info','paper_id', 'id');
    }


}
