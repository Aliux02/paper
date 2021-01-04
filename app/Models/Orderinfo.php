<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderinfo extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo('App\Models\Orderinfo','order_id', 'id');
    }
}
