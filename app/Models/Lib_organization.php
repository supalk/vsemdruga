<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lib_organization extends Model
{
    //protected $table="lib_organizations";

    /**
     * Связь с административными районами
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function district()
    {
        return $this->hasOne('App\Models\Lib_district', 'id','district_id');
    }

    public function pets()
    {
        return $this->hasMany('App\Models\Pet',  'id', 'shelter_id');
    }


}
