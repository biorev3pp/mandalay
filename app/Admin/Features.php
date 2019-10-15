<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    protected $table = 'features';

    public function floor(){
        return $this->belongsTo('App\Admin\Floor', 'floor_id','id');
    }
}
