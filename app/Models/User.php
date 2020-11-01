<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email', 'password','role_id','org_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Связь с ролью
     * @return HasOne
     */
    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id','role_id');
    }

    /**
     * Связь с организацией
     * @return HasOne
     */
    public function organization()
    {
        return $this->hasOne('App\Models\Lib_organization', 'id','org_id');
    }

}
