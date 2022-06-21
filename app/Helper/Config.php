<?php

namespace Helper;

class Config
{
    const CONFIG_BASE = __DIR__ . "/../../config/";
    public static function get($source)
    {
        $data = explode('.', $source);
        $config = include self::CONFIG_BASE . "{$data[0]}.php";
        array_shift($data);
        foreach ($data as $item) {
            if (isset($config[$item])){
                $config = $config[$item];
            } else {
                return null;
            }
        }

        return $config;
    }

    public static function __callstatic($method, $arguments)
    {
        return self::get($method . '.' . $arguments[0]);
    }
}