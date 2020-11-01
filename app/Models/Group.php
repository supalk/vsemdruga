<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    /**
     * Найти Id группы по кодоывому идентификатору
     * @param $code
     * @return bool|mixed
     */
    public static function getId($code)
    {
        if (empty($code)) return false;
        $instance = new static;
        $rez = $instance->where('code', $code)->value('id');
        if (!$rez) {
            return false;
        }
        return $rez;
    }
}
