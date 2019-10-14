<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $table = 'floors';

    public function home(){
        return $this->belongsTo('App\Admin\Homes', 'home_id','id');
    }
}