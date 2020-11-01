<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{

    /**
     * Связь с видом
     * @return HasOne
     */
    public function kind()
    {
        return $this->hasOne('App\Models\Lib_kind', 'id','kind_id');
    }

    /**
     * Связь с видом
     * @return HasOne
     */
    public function breed()
    {
        return $this->hasOne('App\Models\Lib_breed', 'id','breed_id');
    }
}
