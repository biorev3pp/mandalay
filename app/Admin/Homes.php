<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Homes extends Model
{
    protected $table = 'homes';

    public function floors(){
        return $this->hasMany('App\Admin\Floor', 'home_id');
    }

}
