<?php

class Env
{
    public static function DB_HOST()
    {
        return Env::get_env("DB_HOST", "localhost");
    }
    public static function DB_USERNAME()
    {
        return Env::get_env("DB_USERNAME", "root");
    }
    public static function DB_PASSWORD()
    {
        return Env::get_env("DB_PASSWORD", "root");
    }
    public static function DB_SCHEME()
    {
        return Env::get_env("DB_SCHEME", "signlanguage");
    }
    public static function DB_PORT()
    {
        return Env::get_env("DB_PORT", "3307");
    }
  
    public static function jwtSecret()
    {
        return Env::get_env("JWT_SECRET", "ezcb9s8UcF");
    }

    


  //isto !!
    public static function get_env($name, $default)
    {
        return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
    }
}