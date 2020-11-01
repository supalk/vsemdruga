<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //public $timestamps = false;

    public function groups()
    {
        return $this->belongsToMany('App\Models\Group', 'role_groups', 'role_id', 'group_id');
    }
}
