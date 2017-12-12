<?php
/**
 * Created by PhpStorm.
 * User: pembrock
 * Date: 10.12.17
 * Time: 19:26
 */

namespace Editor\Common;


abstract class AbstractAuthorization
{
    abstract function checkAuth();

    abstract function doAuth($login, $password);
}