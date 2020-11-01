<?php
/**
 * Created by PhpStorm.
 * User: SuprunAK
 * Date: 02.10.17
 * Time: 11:36
 */

namespace App\Helpers;


final class Tokens {

    public static function getToken($arr=15) {
        if (!is_array($arr))
            $arr=[$arr];
        $token='';
        $raz='';
        foreach($arr as $val){
            $token.= $raz.self::getRND($val);
            $raz='-';
        }
        return $token;
    }

    public static function getRNDInt($length){
        $x = '';
        for($i = 1; $i <= $length; $i++){
            $x .= random_int(0,9);
        }
        return $x;
    }

    private static function getRND($length=15)
    {
        //$token = bin2hex(random_bytes($length));
        //$token = md5(uniqid(rand(), true));
        $token = openssl_random_pseudo_bytes($length);
        return bin2hex($token);
    }

} 