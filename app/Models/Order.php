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
            echo 'class="onPrint"';
        }
        if ($this->status == 1) {
            echo 'class="donePrint"';
        }
        if ($this->status == 2) {
            echo 'class="onRewind"';
        }
        if ($this->status == 3) {
            echo 'class="onPack"';
        }
    }
}
