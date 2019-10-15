<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $table = 'settings';
    protected $fillable = ['id', 'logo', 'address', 'phone1', 'phone2', 'email', 'map'];
}
