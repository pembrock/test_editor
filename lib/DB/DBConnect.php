<?php

/**
 * Created by PhpStorm.
 * User: pembrock
 * Date: 10.12.17
 * Time: 20:57
 */

namespace Editor\DB;

class DBConnect
{
    protected static $_instance = null;

    public static function instance()
    {
        if ( !isset( self::$_instance ) ) {
            self::$_instance = new DBConnect();
        }
        return self::$_instance;
    }

    public function getConnection()
    {
        $conn = new \PDO(DBConfig::getHost(), DBConfig::getUser(), DBConfig::getPass());
        return $conn;
    }

}