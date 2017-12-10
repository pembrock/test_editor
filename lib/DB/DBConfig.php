<?php
/**
 * Created by PhpStorm.
 * User: pembrock
 * Date: 10.12.17
 * Time: 21:25
 */

namespace Editor\DB;


class DBConfig
{
    protected static $user = 'root';
    protected static $pass = '';
    protected static $host = 'mysql:host=localhost;dbname=test';

    /**
     * @return string
     */
    public static function getUser(){
        return self::$user;
    }
    /**
     * @return string
     */
    public static function getPass(){
        return self::$pass;
    }
    /**
     * @return string
     */
    public static function getHost()
    {
        return self::$host;
    }
}