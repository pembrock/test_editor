<?php

/**
 * Created by PhpStorm.
 * User: pembrock
 * Date: 10.12.17
 * Time: 19:29
 */

use Editor\Common\Authorization;
use Editor\DB\DBConnect;

class User
{
    private $db;

    function __construct()
    {
        $this->db = DBConnect::instance()->getConnection();
    }
}