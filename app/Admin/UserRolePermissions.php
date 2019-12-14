<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class UserRolePermissions extends Model
{
    protected $table = 'user_role_permissions';

    protected $fillable = ['role_id', 'module_id', 'plus', 'modify', 'view', 'trash'];

}
