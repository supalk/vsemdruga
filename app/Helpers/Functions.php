<?php
/**
 * Created by PhpStorm.
 * User: SuprunAK
 * Date: 02.10.17
 * Time: 11:36
 */

namespace App\Helpers;


final class Functions {

    public static  function isJson($string) {
        json_decode($string,true);
        return (json_last_error() == JSON_ERROR_NONE);
    }

} 