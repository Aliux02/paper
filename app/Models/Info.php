<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;



    public function papers()
    {
        return $this -> belongsTo('App\Models\Paper','paper_id', 'id');
    }
    public function create_info()
    {
        $info = new Info();
        $info->kiekis = $paper->kiekis;
        $info->modifikuota = $paper->updated_at;
        $info->paper_id = $paper->id;
        $info->user_name = auth()->user()->name;
        $info->save();
    }

}
