<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class FloorPlans extends Model
{
    protected $table = 'floor_plans';
    
    protected $fillable = ['user_id', 'home_id', 'floor_id', 'image', 'type', 'features'];

    public function floor(){
        return $this->belongsTo('App\Admin\Floor', 'floor_id', 'id');
    }

    public function home(){
        return $this->belongsTo('App\Admin\Homes', 'home_id', 'id');
    }

}
