<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class UserCommunities extends Model
{
    protected $table = 'user_communities';

    protected $fillable = ['user_id', 'community_id'];

    public function community(){
        return $this->belongsTo('App\Admin\Communities', 'community_id', 'id');
    }

}
