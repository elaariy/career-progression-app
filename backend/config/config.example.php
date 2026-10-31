<?php

class Config
{
    public static function DB_HOST(){
        return self::get_env('DB_HOST', '127.0.0.1');
    }
    public static function DB_PORT(){
        return self::get_env('DB_PORT', 3306);
    }
    public static function DB_NAME(){
        return self::get_env('DB_NAME', 'career_progression');
    }
    public static function DB_USER(){
        return self::get_env('DB_USER', 'root');
    }
    public static function DB_PASSWORD(){
        return self::get_env('DB_PASSWORD', '');
    }
    public static function get_env($key, $default)
    {
        $value = getenv($key);
        return ($value !== false && trim($value) !== '') ? $value : $default;
    }

}