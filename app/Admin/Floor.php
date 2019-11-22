<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $table = 'floors';

    public function home(){
        return $this->belongsTo('App\Admin\Homes', 'home_id','id');
    }

    public function features(){
        return $this->hasMany('App\Admin\Features', 'floor_id');
    }

    public function featureList(){
        return $this->hasMany('App\Admin\Features', 'floor_id');
    }
    
}