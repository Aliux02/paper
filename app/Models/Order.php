<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function machine()
    {
        return $this->belongsTo('App\Models\Machine','machine_id', 'id');
    }

    public function orderInfo()
    {
        return $this->hasMany('App\Models\Orderinfo','order_id', 'id');
    }

    public function color()
    {
        if ($this->status == 10) {
            echo 'style=""';
        }
        if ($this->status == 0) {
            echo 'style="background-color:yellow"';
        }
        if ($this->status == 1) {
            echo 'style="background-color:green"';
        }
        if ($this->status == 2) {
            echo 'style="background-color:blue"';
        }
        if ($this->status == 3) {
            echo 'style="background-color:red"';
        }
    }
}
