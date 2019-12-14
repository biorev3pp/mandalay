<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class HomeCommunitySettings extends Model
{
    protected $table = 'home_community_settings';

    protected $fillable = ['home_id', 'community_id'];

    public function community(){
        return $this->belongsTo('App\Admin\Communities', 'community_id', 'id');
    }

    public function home(){
        return $this->belongsTo('App\Admin\Homes', 'home_id', 'id');
    }
}
