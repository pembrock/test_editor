<?php
/**
 * Created by PhpStorm.
 * User: pembrock
 * Date: 10.12.17
 * Time: 19:26
 */

namespace Editor\Common;


interface IAuthorization
{
    public function checkAuth();

    public function doAuth();

    public function saveSession($uid);

    public function clearSession();
}