<?php

namespace App\Toodo;


class BaseBody
{
    public static function getParam($params, $key, $defaultValue = '')
    {
        return isset($params[$key]) ? $params[$key] : $defaultValue;
    }

    public static function signCode($body, $secret)
    {

    }
}